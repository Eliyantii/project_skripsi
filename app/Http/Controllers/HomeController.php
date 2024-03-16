<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Notification;
use App\Models\Product;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Request;

class HomeController extends Controller
{
    public function viewHome() {
        // Produk terbaru
        $latestProducts = Product::latest()->where('status', 'Penjualan')->filter(request(['search']))->paginate(10)->withQueryString();

        // Semua produk
        $products = Product::latest()->where('status', 'Penjualan')->filter(request(['search']))->paginate(20)->withQueryString();

        $notifications = Notification::latest()->where('user_2', Auth::user()->id)->get();

        $countNotif = 0;
        foreach ($notifications as $notif) {
            $countNotif++;
        }

        return view('beranda', [
            'products'=>$products,
            'latestProducts'=>$latestProducts,
            'notifications'=>$notifications,
            'countNotif'=>$countNotif,
        ]);
    }

    public function viewDetailProduct(Product $product) {
        $currentDate = Carbon::now();
        
        $parseDate = date('Y-m-d', strtotime($currentDate));
        
        $imageCount = $product->imageUser->productImages->count();

        $notifications = Notification::latest()->where('user_2', Auth::user()->id)->get();

        $countNotif = 0;
        foreach ($notifications as $notif) {
            $countNotif++;
        }

        return view('home.detailProduk', [
            'product'=>$product->load('imageUser'),
            'imageCount'=>$imageCount,
            'countNotif'=>$countNotif,
            'notifications'=>$notifications,
            'currentDate'=>$parseDate,
        ]);
    }

    public function deleteMessage(Notification $message) {
        Notification::where('id', $message->id)->delete();

        return back();
    }

    public function deleteAllMessage(Request $request) {
        DB::table('notifications')->delete();
        return back();
    }
}
