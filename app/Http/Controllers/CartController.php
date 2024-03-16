<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\CartDetail;
use App\Models\Notification;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;

class CartController extends Controller
{
    public function viewCart(Request $request) {
        $notifications = Notification::where('user_2', Auth::user()->id)->get();

        $countNotif = 0;
        foreach ($notifications as $notif) {
            $countNotif++;
        }

        $carts = Cart::where('user_id', Auth::user()->id)->where('cart_type', 'NORMAL_CART')->paginate(20);

        if ($request->ajax() && $request->page) {
            $view = view('user.component.dataKeranjang',[
                'countNotif'=>$countNotif,
                'notifications'=>$notifications,
            ]);
            
            return response()->json(['html'=>$view]);
        }

        return view('user.keranjang', [
            'carts'=>$carts,
            'countNotif'=>$countNotif,
            'notifications'=>$notifications,
        ]);
    }

    public function store(Request $request) {
        $rules = [
            'user_card'=>['image', 'file', 'max:4096'],
            'user_family_card'=>['image', 'file', 'max:4096'],
            'unit'=>['required'],
            'date_taken'=>['required'],
        ];

        $messages = [
            'requried'=>'Kolom harus diisi!',
            'image'=>'File harus berupa gambar (*.jpg, *.png, *.jpeg).',
            'max'=>'Gambar maksimal :max KB',
            'file'=>'Harus berupa file!'
        ];

        $validatedData = $request->validate($rules, $messages);

        if ($validatedData['unit'] > 1) {
           throw ValidationException::withMessages([
                'unit'=>'Setiap pembelian hanya boleh 1 unit.',
            ]);
        }

        $ktpPath = 'assets/users/ktp';
        $kkPath = 'assets/users/kk';
        $ktpImage = $request->file('user_card');
        $kkImage = $request->file('user_family_card');

        $currDate = Carbon::now()->toDateString();
        $dateTaken = Carbon::parse($validatedData['date_taken'])->toDateString();

        if ($currDate > $dateTaken) {
            throw ValidationException::withMessages([
                'date_taken'=>'Tanggal sudah lewat.',
            ]);
        }

        if ($ktpImage != null) {
            $fileName = time().'-'.str_replace(' ', '-', $ktpImage->getClientOriginalExtension());
            $ktpImage->move($ktpPath, $fileName);

            $validatedData['user_card'] = $fileName;
        }

        if ($kkImage != null) {
            $fileName = time().'-'.str_replace(' ', '-', $kkImage->getClientOriginalName());
            $kkImage->move($kkPath, $fileName);

            $validatedData['user_family_card'] = $fileName;
        }

        $productJSON = json_decode($request->product);

        if ($validatedData['unit'] > $productJSON->stock) {
            return back()->with('error', 'Produk sudah ada di keranjang.');
        }

        // Ambil user cart
        $cart = Cart::where('user_id', Auth::user()->id)
                        ->where('cart_type', 'NORMAL_CART')
                        ->first();

        if (empty($cart)) {
            // Buat Keranjang Baru
            $cart = new Cart();
            $cart->user_id = Auth::user()->id;
            $cart->owner_id = $productJSON->user_id;
            $cart->save();
        }

        $cartDetail = CartDetail::where('cart_id', $cart->id)
                                    ->where('product_id', $productJSON->id)
                                    ->first();

        if (empty($cartDetail)) {
            DB::table('cart_details')->insert([
                'cart_id'=>$cart->id,
                'product_id'=>$productJSON->id,
                'unit'=>$validatedData['unit'],
                'date_taken'=>$validatedData['date_taken'],
                'user_card'=>$validatedData['user_card'],
                'user_family_card'=>$validatedData['user_family_card']
            ]);
        } else {
            if (strval((intval($validatedData['unit']) + $cartDetail->unit)) > $productJSON->stock) {
                return back()->with('error', 'Jumlah unit tidak boleh lebih besar dari stok.');
            }

            $unit = $cartDetail->unit + $validatedData['unit'];

            DB::table('cart_details')
                ->where('cart_id', $cart->id)
                ->where('product_id', $productJSON->id)
                ->update(['unit'=>$unit]);
        }

        return redirect('/karuniamotor/cart')->with('success', 'Berhasil menambahkan produk.');
    }

    public function deleteAllCart() {
        DB::table('carts')->where('user_id', Auth::user()->id)->delete();
        return back();
    }

    public function deleteProductInCart(Request $request) {
        CartDetail::where('cart_id', $request->cartId)
                    ->where('product_id', $request->productId)
                    ->delete();

        $cart = Cart::where('id', $request->cartId)->first();

        if ($cart->cartDetails->isEmpty()) {
            Cart::destroy($cart->id);
        }

        return back();
    }

    public function deleteCart(Request $request) {
        $cartId = $request->cartId;

        Cart::destroy($cartId);
        return back()->with('success', 'Berhasil menghapus keranjang.');
    }
}
