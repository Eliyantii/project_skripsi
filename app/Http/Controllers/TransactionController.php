<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\HistoryProduct;
use App\Models\Notification;
use App\Models\Product;
use App\Models\Transaction;
use App\Models\TransactionDetail;
use App\Models\User;
use App\PaymentMethods\PaymentStrategyContext;
use App\Utils\CommonUtil;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Midtrans\ApiRequestor;

class TransactionController extends Controller
{
    function viewProfile() {
        // Mengambil semua data transaksi
        $transactions = Transaction::where('user_id', Auth::user()->id)
                                            ->orderBy('transaction_date', 'desc')
                                            ->get();
        
        // Menerjemahkan status ke Bahasa Indonesia 
        foreach ($transactions as $transaction) {
            $transaction->status = CommonUtil::$transactionStatus[$transaction->status];        
        }

        // Hitung total transaksi
        $transactionCount = $transactions->count();

        // Mengambil semua data produk dengan status penawaran
        $products = Product::latest()->where('user_id', Auth::user()->id)
                            ->where('status', "Penawaran")
                            ->get();

        // Mengambil data notifikasi
        $notifications = Notification::latest()->where('user_2', Auth::user()->id)->get();

        // Menghitung jumlah data notifikasi
        $countNotif = 0;
        foreach ($notifications as $notif) {
            $countNotif++;
        }


        return view('user.options.penjualan', [
            'transactions'=> $transactions,
            'countNotif'=>$countNotif,
            'notifications'=>$notifications,
            'products'=>$products,
            'count'=>$transactionCount,
        ]);
    }

    function filterTransactionHistory() {
        $transactions = Transaction::where('user_id', Auth::user()->id);
        $status = request('status');

        if ($status == "tertunda") {
            $transactions = $transactions->where('status', 'pending')->orWhere(function($query){
                $query->where('status', 'settlement')
                        ->where('owner_response', 'Menunggu')
                        ->where('user_id', Auth::user()->id);
            })->orWhere(function($query){
                $query->where('status', 'capture')
                        ->where('owner_response', 'Menunggu')
                        ->where('user_id', Auth::user()->id);
            });
        } elseif ($status == "selesai") {
            $transactions = $transactions->where(function($query){
                $query->where('status', 'settlement')
                        ->orWhere('status', 'capture');
            })->where('owner_response', 'Diterima');
        } elseif ($status == "dibatalkan") {
            $transactions = $transactions->where(function($query) {
                $query->where('status', 'cancel')
                        ->orWhere('status', 'deny')
                        ->orWhere('status', 'expire')
                        ->orWhere('status', 'refund')
                        ->orWhere('status', 'failure');
            });
        }

        $transactions = $transactions->orderBy('transaction_date', 'desc')->get();

        foreach ($transactions as $transaction) {
            $transaction->status = CommonUtil::$transactionStatus[$transaction->status];
        }

        $notifications = Notification::where('user_2', Auth::user()->id)->get();

        $countNotif = 0;
        foreach ($notifications as $notif) {
            $countNotif++;
        }


        return view('user.options.riwayatPembelian', [
            'transactions'=>$transactions,
            'countNotif'=>$countNotif,
            'notifications'=>$notifications,
        ])->render();
    } 

    public function pagination(Request $request) {
        $transactions = null;

        if ($request->status == 'selesai') {
            $transactions = Transaction::latest()->where(function($query){
                $query->where('status', 'settlement')->orWhere('status', 'capture');
            })->where('owner_response', 'Diterima');
        } elseif ($request->status == 'semua_status') {
            $transactions = Transaction::latest()->where(function($query){
                $query->where('status', 'settlement')
                        ->orWhere('status', 'capture')
                        ->orWhere('status', 'pending')
                        ->orWhere('status', 'deny')
                        ->orWhere('status', 'cancel')
                        ->orWhere('status', 'expire')
                        ->orWhere('status', 'refund')
                        ->orWhere('status', 'failure');
            });
        } elseif ($request->status == 'tertunda') {
            $transactions = Transaction::latest()->where(function($query){
                $query->where('status', 'pending');
            })->orWhere(function($query){
                $query->where('status', 'settlement')
                        ->where('owner_response', 'Menunggu')
                        ->where('user_id', Auth::user()->id);
            })->orWhere(function($query){
                $query->where('status', 'capture')
                        ->where('owner_response', 'Menunggu')
                        ->where('user_id', Auth::user()->id);
            });
        } else {
            // Jika status dibatalakan
            $transactions = Transaction::latest()->where(function($query){
                $query->where('status', 'cancel')
                        ->where('status', 'deny')
                        ->where('status', 'expire')
                        ->where('status', 'refund')
                        ->where('status', 'failure');
            });
        }

        $transactions = $transactions->where('user_id', Auth::user()->id)->get();

        // Ubah status ke dalam bahasa Indonesia
        foreach ($transactions as $transaction) {
            $transaction->status = CommonUtil::$transactionStatus[$transaction->status];
        }

        $notifications = Notification::where('user_2', Auth::user()->id)->get();

        $countNotif = 0;
        foreach ($notifications as $notif) {
            $countNotif++;
        }

        return view('user.options.penjualan', [
            'transactions'=>$transactions,
            'countNotif'=>$countNotif,
            'notifications'=>$notifications,
        ]);
    }

    function showDetail(Transaction $transaction) {
        if (Auth::user()->id != $transaction->user_id) {
            return abort(404);
        }

        $transaction->status = CommonUtil::$transactionStatus[$transaction->status];

        $notifications = Notification::where('user_2', Auth::user()->id)->get();

        $countNotif = 0;
        foreach ($notifications as $notif) {
            $countNotif++;
        }

        return view('user.options.penjualan', [
            'transaction'=>$transaction,
            'transactionDetails'=>$transaction->transactionDetails,
            'countNotif'=>$countNotif,
            'notifications'=>$notifications,
        ]);
    }

    function snapHandler(Request $request) {
        $snapCallbackJSON = json_decode($request->snapCallback);

        $paymentMethodStrategy = new PaymentStrategyContext($snapCallbackJSON->payment_type);

        $transaction = Transaction::where('id', $request->order_id)->first();

        if ($transaction) {
            $flashMessage = $this->payPendingTransaction($paymentMethodStrategy, $snapCallbackJSON, $transaction);
        } else {
            $flashMessage = $this->payNormalTransaction(
                $request,
                $paymentMethodStrategy,
                $snapCallbackJSON
            );
        }

        return redirect('/karuniamotor/profile/transaction/snap')->with('success', $flashMessage);
    }

    private function payNormalTransaction($request, $paymentMethodStrategy, $snapCallbackJSON) {
        $flashMessage = "Pembayaran Anda gagal!";

        $cart = Cart::where('id', $request->cartId)->first();

        $transaction = new Transaction();
        $transaction->id = $snapCallbackJSON->order_id;
        $transaction->user_id = Auth::user()->id;
        $transaction->owner_id = $cart->owner_id;
        $transaction->midtrans_transaction_id = $snapCallbackJSON->transaction_id;
        $transaction->status = $snapCallbackJSON->transaction_status;
        $transaction->gross_amount = $snapCallbackJSON->gross_amount;
        $transaction->payment_type = $snapCallbackJSON->payment_type;
        $transaction->transaction_date = $snapCallbackJSON->transaction_time;
        $transaction->application_fee = $request->application_fee;
        $transaction->administration_fee = $request->administration_fee;
        $transaction->user_card = $request->user_card;
        $transaction->user_family_card = $request->user_family_card;

        // snapToken digunakan untuk menampilkan pop up pembayaran
        if ($snapCallbackJSON->transaction_status == 'pending') {
            $transaction->snap_token = $request->snapToken;
        }

        // save field unik dengan menyertakan metode pembayaran (payment method)
        $transaction = $paymentMethodStrategy->saveTransactionToDB($transaction, $snapCallbackJSON);

        if ($paymentMethodStrategy->isTransactionSuccess($snapCallbackJSON)) {
            foreach($cart->cartDetails as $cartDetail) {
                Product::decreaseProductStock(
                    $cartDetail->product_id,
                    $cartDetail->unit
                );
            }

            $flashMessage = "Pembayaran berhasil.";

            $notif = new Notification();
            $notif->user_1 = $cart->owner_id;
            $notif->user_2 = Auth::user()->id;
            $notif->message = $flashMessage;
            $notif->save();

        } elseif ($transaction->status = "pending") {
            $flashMessage = "Pembayaran menunggu.";

            $notif = new Notification();
            $notif->user_2 = $cart->owner_id;
            $notif->user_1 = Auth::user()->id;
            $notif->message = $flashMessage;
            $notif->save();
        }

        foreach ($cart->cartDetails as $cartDetail) {
            // Simpan produk yang dibeli ke tabel history_products pada database
            $historyPurchaseProduct = HistoryProduct::create([
                'product_id'=>$cartDetail->product->id,
                'brand'=>$cartDetail->product->brand,
                'name'=>$cartDetail->product->name,
                'year'=>$cartDetail->product->year,
                'machine_number'=>$cartDetail->product->machine_number,
                'frame_number'=>$cartDetail->product->frame_number,
                'price'=>$cartDetail->product->price,
                'image'=>$cartDetail->product->imageUser->thumbnail,
            ]);

            TransactionDetail::create([
                'transaction_id'=>$transaction->id,
                'history_purchase_id'=>$historyPurchaseProduct->id,
                'unit'=>$cartDetail->unit,
            ]);

            $remainingStock = Product::getProductStock($cartDetail->product_id);

            if ($remainingStock == 0) {
                // Jika produk sisa 0, maka hapus produk
                Product::deleteProduct($cartDetail->product_id);
            }
        }

        // Hapus data keranjang pada tabel carts saat transaksi sukses atau tidak
        Cart::destroy($cart->id);
              
        return $flashMessage;
    }

    function paymentHandler(Request $request) {
        $signatureKey = hash(
            "sha512",
            $request->order_id . $request->status_code . $request->gross_amount . env('MIDTRANS_SERVER_KEY')
        );

        if ($signatureKey != $request->signature_key) {
            return abort(404);
        }

        $transaction = Transaction::where('id', $request->order_id)->first();

        if ($request->transaction_status == 'pending' || $transaction->status == 'refund') {
            return;
        }

        $transaction->status = $request->transaction_status;

        if ($request->transaction_status == 'expire') {
            $transaction->owner_response = "Dibatalkan";
        }

        $transaction->save();
    }

    function cancelPayment(Transaction $transaction) {
        try {
            $res = ApiRequestor::post(
                "https://api.sandbox.midtrans.com/v2/" ."$transaction->id". "/cancel",
                env('MIDTRANS_SERVER_KEY'),
                false
            );
        } catch (Exception $e) {
            return redirect('/karuniamotor/profile/transaction/snap')->with('error', 'Gagal membatalkan pembayaran!');
        }

        $transaction->status = $res->transaction_status;
        $transaction->owner_response = "Dibatalkan";
        $transaction->save();

        $notif = new Notification();
        $notif->user_1 = Auth::user()->id;
        $notif->user_2 = $transaction->owner_id;
        $notif->message = "Anda telah membatalkan pembayaran.";
        $notif->save();

        return redirect('/karuniamotor/profile/transaction/snap')->with('success', 'Berhasil membatalkan pesanan.');
    }

    private function payPendingTransaction($paymentMethodStrategy, $snapCallbackJSON, $transaction) {
        $flashMessage = "Pembayaran Anda gagal!";
        
        $transaction->status = $snapCallbackJSON->transaction_status;
        $transaction->save();

        if ($paymentMethodStrategy->isTransactionSuccess($snapCallbackJSON)) {
            foreach ($transaction->transactionDetails as $transactionDetail) {
                Product::decreaseProductStock(
                    $transactionDetail->historyPurchase->product_id,
                    $transactionDetail->unit
                );

                $remainingStock = Product::getProductStock($transactionDetail->historyPurchase->product_id);

                if ($remainingStock == 0) {
                    // Jika produk sisa 0, maka hapus produk
                    Product::deleteProduct($transactionDetail->historyPurchase->product_id);
                }
            }

            $flashMessage = "Pembayaran berhasil.";

        } elseif ($snapCallbackJSON->transaction_status == "pending") {
            $flashMessage = "Menunggu Pembayaran!";
        }

        return $flashMessage;
    }

    function salesTransactionDetailPopUp(Transaction $transaction, Request $request) {
        // Cek ajax request
        if ($request->ajax() == false) {
            return redirect('/');
        }

        $notifications = Notification::where('user_2', Auth::user()->id)->get();

        $countNotif = 0;
        foreach ($notifications as $notif) {
            $countNotif++;
        }

        $transaction->status = CommonUtil::$transactionStatus[$transaction->status];

        return view('user.modals.detailTransaksiModal', [
            "transaction"=>$transaction,
            'notifications'=>$notifications,
            'countNotif'=>$countNotif,
        ]);
    }

    public function rejectOffer(Product $product) {
        $product = Product::where('id', $product->id)->first();
        
        $product->offer_status = "Ditolak Konsumen";
        $product->save();

        return back()->with('success', 'Berhasil menolak tawaran produk.');
    }

    public function acceptOffer(Product $product) {
        $product = Product::where('id', $product->id)->first();
        
        $product->offer_status = "Diterima Konsumen";
        $product->save();

        return back()->with('success', 'Berhasil menerima tawaran produk.');
    }

    public function viewInvoice(Transaction $transaction) {
        $user = User::where('id', $transaction->user_id)->first();
        $transactionDetail = TransactionDetail::where('transaction_id', $transaction->id)->first();

        $historyProduct = HistoryProduct::where('id', $transactionDetail->history_purchase_id)->first();

        return view('user.options.faktur', [
            'user'=>$user,
            'historyProduct'=>$historyProduct,
        ]);
    }
}
