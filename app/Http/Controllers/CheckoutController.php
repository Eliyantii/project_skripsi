<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\CartDetail;
use App\Models\Notification;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class CheckoutController extends Controller
{
    public function viewCheckout(Cart $cart) {
        if ($cart->user_id != Auth::user()->id) {
            return abort(404);
        }

        $notifications = Notification::where('user_2', Auth::user()->id)->get();

        $countNotif = 0;
        foreach ($notifications as $notif) {
            $countNotif++;
        }

        return view('user.checkout.checkout', [
            'cart'=>$cart,
            'countNotif'=>$countNotif,
            'notifications'=>$notifications,
        ]);
    }

    public function store(Request $request, Cart $cart) {
        return $this->makePayment($cart);
    }

    private function makePayment(Cart $cart) {
        // Set your Merchant Server Key
        \Midtrans\Config::$serverKey = env('MIDTRANS_SERVER_KEY');
        // Set to Development/Sandbox Environment (default). Set to true for Production Environment (accept real transaction).
        \Midtrans\Config::$isProduction = false;
        // Set sanitization on (default)
        \Midtrans\Config::$isSanitized = true;
        // Set 3DS transaction for credit card to true
        \Midtrans\Config::$is3ds = true;

        $cartDetails = CartDetail::where('cart_id', $cart->id)->get();
        $itemsDetails = $this->composeItemDetails($cartDetails);
        $orderId = (string) Str::uuid();

        $params = array(
            'transaction_details' => array(
                'order_id' => $orderId
            ),
            'enabled_payments'=> array(
                'credit_card',
                'bca_va',
                'bni_va',
                'bri_va',
                'permata_va',
            ),
            'customer_details' => array(
                'first_name' => Auth::user()->name,
                'phone' => Auth::user()->phone,
            ),
            'item_details'=> $itemsDetails,
            'expiry'=>array(
                'start_time' => Carbon::parse(now())->translatedFormat('Y-m-d H:i:s').'+0700',
                'unit' => 'day',
                'duration' => 1
            ),
            'callbacks' => array (
                'finish' => 'http://127.0.0.1:8000/karuniamotor/profile/transaction/snap?checkout='."&application_fee="."2000"."&administration_fee="."3000"
            )
        );
        
        $snapToken = \Midtrans\Snap::getSnapToken($params);
        return $snapToken;
    }

    private function composeItemDetails(Collection $cartDetails) {
        $products = array();

        foreach ($cartDetails as $cartDetail) {
            $products[] = [
                'id'=>$cartDetail->product->id,
                'price'=>$cartDetail->product->price * $cartDetail->unit,
                'quantity'=>$cartDetail->unit,
                'name'=>$cartDetail->product->name,
                'merchant_name'=>'Karunia Motor',
            ];
        }

        $products[] = [
            'name'=>'Biaya Jasa Aplikasi',
            'price'=>2000,
            'quantity'=>1,
            'id'=>"BT001",
        ];

        $products[] = [
            'name'=>'Biaya Administrasi',
            'price'=>3000,
            'quantity'=>1,
            'id'=>"BT002",
        ];

        return $products;
    } 
}
