<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\UserController;
use App\Models\Transaction;
use App\Models\User;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/
Route::post('/karuniamotor/logout', [AuthController::class, 'logout']);

Route::middleware(['guest'])->group(function() {
    Route::prefix('karuniamotor')->group(function() {

        // Rute untuk daftar
        Route::get('/register', [AuthController::class, 'viewRegister'])->name('register');
        Route::post('/register', [AuthController::class, 'register']);
        
        // Rute autentikasi login dan logout
        Route::get('/login', [AuthController::class, 'viewLogin'])->middleware('guest')->name('login');
        Route::post('/login', [AuthController::class, 'login']);
        
        // Rute lupa kata sandi
        Route::get('/forgot-password', [AuthController::class, 'viewForgotPassword'])->middleware('guest');
        Route::post('/karuniamotor/forgot-password', [AuthController::class, 'checkUserEmail'])->name('checkEmail');
        Route::get('/forgot-password/reset-password/{user_id}', [AuthController::class, 'viewResetPassword'])->name('resetPassword');
        Route::post('/forgot-password/reset-password/{user_id}', [AuthController::class, 'updatePassword']);
    });
});


Route::middleware(['auth'])->group(function () {

    // Rute untuk menampilkan halaman beranda
    Route::get('/', [HomeController::class, 'viewHome'])->name('home');
    
    // Rute hapus semua pesan
    Route::delete('/karuniamotor/message/delete/all', [HomeController::class, 'deleteAllMessage'])->name('deleteAllMessage');

    // Rute hapus semua data di keranjang
    Route::delete('/karuniamotor/cart/delete/deleteCart', [CartController::class, 'deleteCart'])->name('deleteAllCart');

    Route::prefix('karuniamotor')->group(function () {
        // Rute hapus pesan
        Route::delete('/message/delete/{message}', [HomeController::class, 'deleteMessage']);

        // Rute untuk menampilkan detail produk
        Route::get('/detail/{product}', [HomeController::class, 'viewDetailProduct']);

        // Rute untuk menampilkan keranjang
        Route::prefix('cart')->group(function() {
            Route::get('', [CartController::class, 'viewCart']);
            Route::post('', [CartController::class, 'store']);
            Route::delete('/deleteAll', [CartController::class, 'deleteAllCart']);
            Route::delete('/deleteProduct', [CartController::class, 'deleteProductInCart']);
        });

        
        Route::prefix('profile')->group(function () {
            // Rute Penjualan
            Route::get('/transaction/snap', [TransactionController::class, 'viewProfile']);
            Route::get('/transaction/detail/{transaction}', [TransactionController::class, 'salesTransactionDetailPopUp']);
            Route::post('/transaction/offer/reject/{product}', [TransactionController::class, 'rejectOffer']);
            Route::post('/transaction/offer/accept/{product}', [TransactionController::class, 'acceptOffer']);
            Route::post('/transaction/cancel/{transaction}', [TransactionController::class, 'cancelPayment'])->name('cancelPayment');
            Route::get('/transaction/snap/filter', [TransactionController::class, 'filterTransactionHistory']);
            Route::get('/transaction/snap/invoice/{transaction}/download', [TransactionController::class, 'viewInvoice'])->name('viewInvoice');

            // handle snap callback
            Route::post('/transaction/snap', [TransactionController::class, 'snapHandler']);

            // Rute untuk penawaran
            Route::get('/offer', [UserController::class, 'viewOffer']);
            Route::post('/offer/add', [UserController::class, 'storeOffer'])->name('storeOffer');
            Route::delete('/offer/delete/{product}', [UserController::class, 'deleteOffer']);
            Route::get('/offer/edit/{product}', [UserController::class, 'viewEditOffer']);
            Route::put('/offer/edit/{product}', [UserController::class, 'editOffer']);

            // Ubah Sandi
            Route::get('/change-password', [UserController::class, 'viewChangePassword']);
            Route::put('/{user_id}/change-password', [UserController::class, 'editPassword']);
            Route::put('/{user_id}/change-profile', [UserController::class, 'editProfile']);
        });

        // Rute untuk checkout
        Route::get('/checkout/{cart}', [CheckoutController::class, 'viewCheckout']);
        Route::post('/checkout/{cart}', [CheckoutController::class, 'store']);
    });
});

// Rute menampilkan dashboard untuk admin
Route::middleware(['admin', 'auth'])->group(function() {
    Route::prefix('karuniamotor')->group(function() {
        Route::prefix('dashboard')->group(function() {
            Route::get('', [AdminController::class, 'viewDashboard'])->name('dashboard');
            Route::get('/filter', [AdminController::class, 'filterSalesReport']);

            // Supplier
            Route::get('/supplier', [AdminController::class, 'viewSupplier']);
            Route::get('/supplier/add', [AdminController::class, 'viewAddSupplier']);
            Route::post('/supplier/add', [AdminController::class, 'storeSupplier']);
            Route::get('/supplier/detail/{supplier}', [AdminController::class, 'viewSupplierDetail']);
            Route::get('/supplier/report/download', [AdminController::class, 'downloadSupplierReport']);
            Route::get('/supplier/search', [AdminController::class, 'searchSupplier']);

            // Produk
            Route::get('/product', [AdminController::class, 'viewProduct']);
            Route::get('/product/add', [AdminController::class, 'viewAddProduct']);
            Route::post('/product/add', [AdminController::class, 'postProduct']);
            Route::delete('/product/delete/{product}', [AdminController::class, 'deleteProduct']);
            Route::get('/product/{product}/edit', [AdminController::class, 'viewEditProduct']);
            Route::put('/product/{product}/edit', [AdminController::class, 'editProduct']);
            Route::get('/product/report/download', [AdminController::class, 'downloadProductReport']);
            

            // Transaksi
            Route::get('/transaction-list', [AdminController::class, 'viewTransactionList']);
            Route::get('/transaction-list/pending', [AdminController::class, 'viewPendingTransactionList']);
            Route::get('/transaction-list/detail/pop-up/{transaction}', [AdminController::class, 'salesDetailPopUp']);
            Route::post('/transaction-list/order/accept/{transaction}', [AdminController::class, 'accOrder']);
            Route::post('/transaction-list/order/reject/{transaction}', [AdminController::class, 'rejectOrder']);
            Route::get('/transaction-list/report/download', [AdminController::class, 'downloadTransactionReport']);
            

            // Cash Tempo
            Route::get('/cash-tempo', [AdminController::class, 'viewCashTempoList']);
            Route::get('/cash-tempo/form', [AdminController::class, 'viewFormCashTempo']);
            Route::post('/cash-tempo/form/add', [AdminController::class, 'storeCashTempo']);
            Route::get('/cash-tempo/pop-up/{cashTempo}', [AdminController::class, 'viewPaymentCashTempo']);
            Route::post('/cash-tempo/pay/{cashTempo}', [AdminController::class, 'payCashTempo']);

            // Penawaran
            Route::get('/offer', [AdminController::class, 'viewOfferList']);
            Route::get('/offer/pending', [AdminController::class, 'viewOfferListPending']);
            Route::post('/offer/reject/{product}', [AdminController::class, 'rejectOffer']);
            Route::post('/offer/accept/{product}', [AdminController::class, 'acceptOffer']);
            Route::get('/offer/bid/pop-up/{product}', [AdminController::class, 'viewBidPopUp']);
            Route::post('/offer/bid/{product}', [AdminController::class, 'storeBidProduct']);
            Route::get('/offer/detail/pop-up/{product}', [AdminController::class, 'showDetailOffer']);
        });
    });
});





