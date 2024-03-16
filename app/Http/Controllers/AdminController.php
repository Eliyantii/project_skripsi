<?php

namespace App\Http\Controllers;

use App\Exports\ExcelExport;
use App\Exports\ExcelProductExport;
use App\Exports\ExcelSupplierExport;
use App\Http\Controllers\Controller;
use App\Models\CashTempo;
use App\Models\Document;
use App\Models\Image;
use App\Models\Notification;
use App\Models\Product;
use App\Models\ProductImages;
use App\Models\Supplier;
use App\Models\Transaction;
use App\Models\TransactionDetail;
use App\Models\User;
use App\Utils\CommonUtil;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Log;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Validation\ValidationException;

class AdminController extends Controller
{
    public function viewDashboard() {
        $this->authorize('admin');

        DB::statement("SET lc_time_names = 'id_ID';");

        $sales = Transaction::select(DB::raw("COUNT(*) as count"), DB::raw("MONTH(created_at) as month"))
                ->whereYear('created_at', date('Y'))
                ->where('owner_id', Auth::user()->id)
                ->where(function($query) {
                    $query->where('status', 'settlement')
                          ->orWhere('status', 'capture');
                })->where('owner_response', 'Diterima')
                  ->groupBy(DB::raw("month"))
                  ->orderBy('created_at', 'ASC')
                  ->pluck('count', 'month');

        if (count($sales) < 12 && count($sales) >= 0) {
            for ($i = 1; $i <= 12; $i++) {
                if ($sales->has($i) == false) {
                    $sales->put($i, 0);
                }
            }
        }

        $sortedSales = collect($sales)->sortKeys();

        if (request('year')) {
            return response()->json([
                'labels'=>$sortedSales->keys(),
                'data'=>$sortedSales->values(),
                'status'=>"update",
            ]);
        }

        $transactions = Transaction::latest()->where('owner_id', Auth::user()->id)
                                        ->where(function($query) {
                                            $query->where('status', 'settlement')
                                                    ->orWhere('status', 'capture')
                                                    ->orWhere('status', 'refund');
                                        })->where(function($query) {
                                            $query->where('owner_response', 'Diterima')
                                                    ->orWhere('owner_response', 'Ditolak');
                                        })->paginate(5);
                                        
        foreach ($transactions as $transaction) {
            $transaction->status = CommonUtil::$transactionStatus[$transaction->status];
        }

        return view('dashboard.dashboardAdmin', [
            'transactions'=>$transactions,
            'labels'=>$sortedSales->keys(),
            'data'=>$sortedSales->values(),
        ]);
    }

    function filterSalesReport(Request $request) {
        $sales = Transaction::select(DB::raw("COUNT(*) as count"), DB::raw("MONTH(created_at) as month"))
                            ->whereYear('created_at', $request->year)
                            ->where('owner_id', Auth::user()->id)
                            ->where(function($query) {
                                $query->where('status', 'settlement')
                                    ->orWhere('status', 'capture');
                            })->where('owner_response', 'Diterima')
                            ->groupBy(DB::raw("month"))
                            ->orderBy('created_at', 'ASC')
                            ->pluck('count', 'month');
        if (count($sales) < 12 && count($sales) >= 0) {
            for ($i = 1; $i <= 12; $i++) {
                if ($sales->has($i) == false) {
                    $sales->put($i, 0);
                }
            }
        }

        $sortedSales = collect($sales)->sortKeys();

        return response()->json([
            'labels'=>$sortedSales->keys(),
            'data'=>$sortedSales->values(),
            'status'=>"update",
        ]);
    }

    public function postProduct(Request $request) {
        $rules = [
            'plate_number'=>['required', 'max:20', 'min:3'],
            'brand'=>['required', 'max:50'],
            'name'=>['required', 'max:100', 'min:3'],
            'machine_number'=>['required', 'min:3'],
            'frame_number'=>['required', 'min:3'],
            'transmission'=>['required', 'max:10'],
            'bpkb_name'=>['required','max:100', 'min:3'],
            'year'=>['required'],
            'price'=>['required'],
            'description'=>['max:255'],
            'stock'=>['required'],
            'bpkb'=>['image', 'file', 'max:4096'],
            'stnk'=>['image', 'file', 'max:4096']
        ];

        $messages = [
            'required'=>'Kolom harus diisi!',
            'max'=>'Maksimal :max karakter!',
            'min'=>'Minimal :min karakter!',
            'max:4096'=>'Maksimal 4 MB'
        ];

        $validatedData = $request->validate($rules, $messages);

        $product = new Product();
        $product->user_id = Auth::user()->id;
        $product->plate_number = $validatedData['plate_number'];
        $product->brand = $validatedData['brand'];
        $product->name = $validatedData['name'];
        $product->machine_number = $validatedData['machine_number'];
        $product->frame_number = $validatedData['frame_number'];
        $product->bpkb_name = $validatedData['bpkb_name'];
        $product->stock = $validatedData['stock'];
        $product->transmission = $validatedData['transmission'];
        $product->year = $validatedData['year'];
        $product->price = $validatedData['price'];
        $product->description = $validatedData['description'];
        $product->save();

        $doc = new Document();
        $doc->product_id = $product->id;
        $doc->user_id = Auth::user()->id;

        $bpkbPath = 'assets/users/bpkb';
        $stnkPath = 'assets/users/stnk';

        $bpkbFile = $request->file('bpkb');
        $stnkFile = $request->file('stnk');

        if ($bpkbFile != null) {
            $fileName = time().'-'.str_replace(' ', '-', $bpkbFile->getClientOriginalName());
            $bpkbFile->move($bpkbPath, $fileName);

            $doc->bpkb_img = $fileName;
        }

        if ($stnkFile != null) {
            $fileName = time().'-'.str_replace(' ', '-', $stnkFile->getClientOriginalName());
            $stnkFile->move($stnkPath, $fileName);

            $doc->stnk_img = $fileName;
        }

        $doc->save();

        $thumbnail = $request->validate([
            'thumbnail'=>['image', 'file', 'max:4096']
        ]);

        $productId = $product->id;
        $thumbnail['product_id'] = $productId;

        $names = [];
        $path = 'assets/users/products';

        if ($request->file('images')) {
            $files = $request->file('images');

            foreach ($files as $file) {
                $fileName = time() . '-' . str_replace(' ', '-', $file->getClientOriginalName());
                $file->move($path, $fileName);

                array_push($names, $fileName);
            }

            $thumbnail['thumbnail'] = str_replace('"', '', json_encode($names[0]));
        }

        $image = new Image();
        $image->product_id = $thumbnail['product_id'];
        $image->thumbnail = $thumbnail['thumbnail'];
        $image->save();

        $imageId = $image->id;

        $productImages = $request->validate([
            'image'=>['image', 'file', 'max:4096']
        ]);

        foreach ($names as $name) {
            $storeImage = new ProductImages();
            $storeImage->image_id = $imageId;
            $storeImage->image = $productImages['image'] = str_replace('"', '', json_encode($name));
            $storeImage->save();
        }

        return back()->with('success', 'Produk berhasil ditambahkan.');
    }

    public function viewSupplier() {
        $suppliers = Supplier::latest()->paginate(10);

        return view('dashboard.options.daftarSupplier', [
            'suppliers'=>$suppliers,
        ]);
    }

    public function viewAddSupplier() {
        $currDate = Carbon::now();

        $parseDate = date('Y-m-d', strtotime($currDate));

        return view('dashboard.options.tambahSupplier', [
            'date'=>$parseDate,
        ]);
    }

    public function viewProduct() {
        $products = Product::latest()->where('status', "Penjualan")->get();

        return view('dashboard.options.daftarProduk', [
            'products'=>$products,
        ]);
    }

    public function viewAddProduct() {
        return view('dashboard.options.tambahProduk');
    }

    public function viewTransactionList() {
        $transactions = Transaction::latest()->where('owner_id', Auth::user()->id)
                                        ->where(function($query) {
                                            $query->where('status', 'settlement')
                                                    ->orWhere('status', 'capture')
                                                    ->orWhere('status', 'refund');
                                        })->where(function($query) {
                                            $query->where('owner_response', 'Diterima')
                                                    ->orWhere('owner_response', 'Ditolak')
                                                    ->orWhere('owner_response', 'Menunggu');;
                                        })->paginate(10);
                                        
        foreach ($transactions as $transaction) {
            $transaction->status = CommonUtil::$transactionStatus[$transaction->status];
        }

        return view('dashboard.options.daftarTransaksi', [
            'transactions'=>$transactions,
        ]);
    }

    public function viewPendingTransactionList() {
        $transactions = Transaction::latest()->where('owner_id', Auth::user()->id)
                                        ->where(function($query) {
                                            $query->where('status', 'settlement')
                                                    ->orWhere('status', 'capture')
                                                    ->orWhere('status', 'refund');
                                        })->where(function($query) {
                                            $query->where('owner_response', 'Menunggu');;
                                        })->paginate(10);
                                        
        foreach ($transactions as $transaction) {
            $transaction->status = CommonUtil::$transactionStatus[$transaction->status];
        }
        return view('dashboard.options.daftarTransaksiPending', [
            'transactions'=>$transactions
        ]);
    }

    public function salesDetailPopUp(Transaction $transaction, Request $request) {
        if ($request->ajax() == false) {
            return redirect('/karuniamotor/dashboard');
        }
        
        $transaction->status = CommonUtil::$transactionStatus[$transaction->status];

        return view('dashboard.modals.detailTransaksiModal', [
            'transaction'=>$transaction,
        ]);
    }

    function accOrder(Transaction $transaction) {
        User::increaseOwnerBalance(
            $transaction->owner_id,
            $transaction->gross_amount,
            $transaction->application_fee,
            $transaction->administration_fee
        );

        Carbon::setLocale('id');
        $currDate = Carbon::now();
        $currDate->setTimezone('Asia/Jakarta');

        $currentDateTimeFormatted = $currDate->format('Y-m-d H:i:s');

        $transaction->owner_response = "Diterima";
        $transaction->updated_at = $currentDateTimeFormatted;
        $transaction->save();

        $notif = new Notification();
        $notif->user_1 = $transaction->owner_id;
        $notif->user_2 = $transaction->user_id;
        $notif->message = "Selamat, pesanan Anda telah diterima oleh admin. Silahkan hubungi admin untuk informasi lebih detail dan tanggal pengambilan unit motor. Terima kasih.";
        $notif->save();

        return redirect('/karuniamotor/dashboard/transaction-list')->with('success', 'Berhasil menerima transaksi.');
    }

    function rejectOrder(Transaction $transaction) {
        // Tambahkan lagi unit produk
        $transactionDetails = TransactionDetail::where('transaction_id', $transaction->id)->get();
        foreach ($transactionDetails as $transactionDetail) {
            $unit = $transactionDetail->unit;
            $product = Product::find($transactionDetail->historyPurchase->product->id);
            $product->stock += $unit;
            $product->save();
        }

        Carbon::setLocale('id');
        $currDate = Carbon::now();
        $currDate->setTimezone('Asia/Jakarta');
        $currentDateTimeFormatted = $currDate->format('Y-m-d H:i:s');

        $transaction->owner_response = "Ditolak";
        $transaction->updated_at = $currentDateTimeFormatted;
        $transaction->save();

        $notif = new Notification();
        $notif->user_1 = $transaction->owner_id;
        $notif->user_2 = $transaction->user_id;
        $notif->message = "Mohon maaf, Pesanan Anda telah ditolak oleh admin, dikarenakan alasan tertentu. Silahkan hubungi admin untuk informasi lebih detail. Terima kasih.";
        $notif->save();

        return redirect('/karuniamotor/dashboard/transaction-list')->with('success', 'Berhasil menerima transaksi.');
    }

    public function deleteProduct(Product $product){

        // Hapus thumbnail produk di folder public
        File::delete(public_path('assets/users/products/'. $product->imageUser->thumbnail));

        // Hapus gambar-gambar produk di folder public
        foreach ($product->imageUser->productImages as $productImage) {
            File::delete(public_path('assets/users/products/'. $productImage->image));
        }

        $product->delete();

        return redirect('/karuniamotor/dashboard/product')->with('success', 'Berhasil menghapus produk.');
    }

    public function viewEditProduct(Product $product) {
        $product = Product::where('id', $product->id)->first();

        return view('dashboard.modals.editProdukModal',[
            'product'=>$product,
        ]);
    }

    public function viewOfferList() {
        $products = Product::latest()->where('status', "Penawaran")
                    ->paginate(10);

        return view('dashboard.options.daftarPenawaran', [
            'products'=>$products,
        ]);
    }

    public function viewOfferListPending() {
        $products = Product::latest()->where('status', "Penawaran")
                    ->where('offer_status', null)
                    ->paginate(10);

        return view('dashboard.options.daftarPenawaranPending',[
            'products'=>$products,
        ]);
    }

    public function rejectOffer(Product $product) {
        $product = Product::where('id', $product->id)->first();
        
        $product->offer_status = "Ditolak Admin";
        $product->save();

        $notif = new Notification();
        $notif->user_1 = Auth::user()->id;
        $notif->user_2 = $product->user_id;
        $notif->message = "Mohon maaf, Penawaran Anda telah ditolak oleh admin, dikarenakan alasan tertentu. Silahkan hubungi admin untuk informasi lebih detail. Terima kasih.";
        $notif->save();

        return back()->with('success', 'Berhasil menolak tawaran produk.');
    }

    public function acceptOffer(Product $product) {
        $product = Product::where('id', $product->id)->first();

        $product->offer_status = "Diterima Admin";
        $product->save();

        $notif = new Notification();
        $notif->user_1 = Auth::user()->id;
        $notif->user_2 = $product->user_id;
        $notif->message = "Selamat ".$product->user->name. ", Penawaran Anda telah diterima oleh admin. Silahkan hubungi admin untuk informasi lebih detail. Terima kasih.";
        $notif->save();

        return back()->with('success', 'Berhasil menerima tawaran produk.');
    }

    public function storeBidProduct(Request $request, Product $product) {
        $product = Product::Where('id', $product->id)->first();

        $product->offer_price = $request->offer_price;
        $product->offer_status = "Ditawar";
        $product->save();

        $notif = new Notification();
        $notif->user_1 = Auth::user()->id;
        $notif->user_2 = $product->user_id;
        $notif->message = "Selamat ".$product->user->name. ", Penawaran Anda telah ditawar oleh admin. Silahkan hubungi admin untuk informasi lebih detail. Terima kasih.";
        $notif->save();

        return back()->with('success', "Berhasil melakukan penawaran produk.");
    }

    public function viewBidPopUp(Product $product, Request $request) {
        if ($request->ajax() == false) {
            return redirect('/karuniamotor/dashboard');
        }

        $product = Product::where('id', $product->id)->first();

        return view('dashboard.modals.bidModal', [
            'product'=>$product,
        ]);
    }

    public function viewCashTempoList() {
        $cashTempos = CashTempo::latest()->paginate(10);

        return view('dashboard.options.daftarCashTempo', [
            'cashTempos'=>$cashTempos,
        ]);
    }

    public function viewFormCashTempo() {
        $products = Product::latest()->where('user_id', Auth::user()->id)
                            ->where('status', "Penjualan")
                            ->get();

        return view('dashboard.options.formCashTempo', [
            'products'=>$products,
        ]);
    }

    function storeCashTempo(Request $request) {
        $product = Product::where('id', $request->product_id)->first();

        $rules = [
            'customer_name'=>['required', 'max:100', 'min:3'],
            'address'=>['required', 'max:100', 'min:3'],
            'phone'=>['required', 'max:15', 'min:3'],
            'guarantor_phone'=>['required', 'max:15', 'min:3'],
            'work'=>['required', 'max:50', 'min:3'],
            'income'=>['required'],
            'unit'=>['required'],
            'month'=>['required'],
            'dp'=>['required'],
            'interest'=>['required'],
            'user_card'=>['image', 'file', 'max:4096'],
            'user_family_card'=>['image', 'file', 'max:4096'],
            'date_taken'=>['required'],
        ];

        $messages = [
            'required' => 'Kolom harus diisi!',
            'max' => 'Maksimal :max karakter',
            'min' => 'Minimal :min karakter',
            'file' => 'File harus diunggah.',
            'image' => 'File harus berupa gambar.',
            'max:4096' => 'Maksimal size 4 MB',
        ];

        // Tanggal sekarang + 30 hari dari sekarang
        $currentDate = Carbon::now();
        $next30Days = $currentDate->addDays(30);

        $validatedData = $request->validate($rules, $messages);

        $dateTaken = Carbon::parse($validatedData['date_taken']);
        
        if ($dateTaken->greaterThan($currentDate)) {
            throw ValidationException::withMessages([
                'date_taken'=>'Tanggal sudah lewat.',
            ]);
        }

        if ($validatedData['month'] != 3) {
            // Cari total bunga
            $interestToDouble = floatval($validatedData['interest']);
            $totalInterest = round($product->price * $interestToDouble, -3);
    
            // Angsuran
            $installment = round(($product->price * $validatedData['interest'] * pow(1 + $validatedData['interest'], $validatedData['month'])) / (pow(1 + $validatedData['interest'], $validatedData['month']) - 1), -3);
    
            // Total sisa Cash Tempo
            $remainingTotal = round(($installment * $validatedData['month']) - $validatedData['dp'], -3);
        } else {
            // Cari total bunga
            $interestToDouble = floatval($validatedData['interest']);
            $totalInterest = round($product->price * $interestToDouble, -3);

            // Angsuran
            $installment = round($product->price / $validatedData['month'], -3);

            // Total sisa Cash Tempo
            $remainingTotal = round(($installment * $validatedData['month']) - $validatedData['dp'], -3);
        }

        $cashTempo = new CashTempo();
        $cashTempo->id = (string) Str::uuid();
        $cashTempo->product_id = $product->id;
        $cashTempo->customer_name = $validatedData['customer_name'];
        $cashTempo->address = $validatedData['address'];
        $cashTempo->phone = $validatedData['phone'];
        $cashTempo->guarantor_phone = $validatedData['guarantor_phone'];
        $cashTempo->work = $validatedData['work'];
        $cashTempo->income = $validatedData['income'];
        $cashTempo->unit = $validatedData['unit'];
        $cashTempo->month = $validatedData['month'];
        $cashTempo->dp = $validatedData['dp'];
        $cashTempo->interest = $validatedData['interest'];
        $cashTempo->total_interest = $totalInterest;
        $cashTempo->installment = $installment;
        $cashTempo->status = "Belum Lunas";
        $cashTempo->remaining_total = $remainingTotal;

        $pathKTP = 'assets/users/ktp';
        $pathKK = 'assets/users/kk';

        $ktp = $request->file('user_card');
        $kk = $request->file('user_family_card');


        if ($ktp != null) {
            $fileName = time(). '-' .str_replace(' ', '-', $ktp->getClientOriginalName());
            $ktp->move($pathKTP, $fileName);

            $validatedData['user_card'] = $fileName;
        }

        $cashTempo->user_card = $validatedData['user_card'];

        if ($kk != null) {
            $fileName = time(). '-' .str_replace(' ', '-', $kk->getClientOriginalName());
            $kk->move($pathKK, $fileName);

            $validatedData['user_family_card'] = $fileName;
        }

        $cashTempo->user_family_card = $validatedData['user_family_card'];

        $cashTempo->date_taken = $validatedData['date_taken'];
        $cashTempo->due_date = $next30Days;

        $cashTempo->save();

        Product::decreaseProductStock($product->id, $validatedData['unit']);

        $remainingStock = Product::getProductStock($product->id);

        if ($remainingStock == 0) {
            // Jika produk sisa 0, maka hapus produk
            Product::deleteProduct($product->id);
        }

        return back()->with('success', 'Berhasil mengajukan Cash Tempo.');
    }

    public function showDetailOffer(Product $product, Request $request) {
         if ($request->ajax() == false) {
            return redirect('/karuniamotor/dashboard');
        }

        $product = Product::where('id', $product->id)
                            ->where('status', "Penawaran")
                            ->first();

        return view('dashboard.modals.detailOfferModal', [
            'product'=>$product,
        ]);
    }

    public function downloadTransactionReport() {
        return Excel::download(new ExcelExport, 'Laporan_Transaksi.xlsx');
    }

    public function downloadProductReport() {
        return Excel::download(new ExcelProductExport, 'Laporan_Produk.xlsx');
    }

    public function downloadSupplierReport() {
        return Excel::download(new ExcelSupplierExport, 'Laporan_Supplier.xlsx');
    }

    public function viewPaymentCashTempo(Request $request, CashTempo $cashTempo) {
        if ($request->ajax() == false) {
            return redirect('/karuniamotor/dashboard');
        }

        $cashTempo = CashTempo::where('id', $cashTempo->id)->first();

        return view('dashboard.modals.payCashTempo', [
            'cashTempo'=>$cashTempo,
        ]);
    }

    public function payCashTempo(Request $request, CashTempo $cashTempo) {
        $validatedData = $request->validate([
            'pay'=>['required'],        
        ], [
            'pay.required'=>'Kolom harus diisi!',
        ]);

        $cashTempo = CashTempo::where('id', $cashTempo->id)->first();

        $dueDate = Carbon::parse($cashTempo->due_date);

        $cashTempo->dp += $validatedData['pay'];
        $cashTempo->month -= 1;
        $cashTempo->due_date = $dueDate->addDays(30);
        $cashTempo->remaining_total -= $validatedData['pay'];
        $cashTempo->created_at = Carbon::now();

        if ($cashTempo->remaining_total == 0) {
            $cashTempo->status = "Lunas";
        }

        $cashTempo->save();

        return back()->with('success', 'Berhasil membayar');
    }

    public function storeSupplier(Request $request) {
        $rules = [
            'name'=>['required', 'max:100', 'min:3'],
            'address'=>['required', 'max:100', 'min:3'],
            'city'=>['required', 'max:100', 'min:3'],
            'province'=>['required', 'max:100', 'min:3'],
            'postal_code'=>['required', 'max:10'],
            'phone'=>['required', 'max:15', 'min:3'],
            'email'=>['required', 'max:100', 'min:3', 'email:dns'],
            'account_number'=>['required', 'max:50', 'min:3'],
            'account_name'=>['required', 'max:100', 'min:3'],
            'bank'=>['required', 'max:100', 'min:3'],
            'tax_number'=>['required', 'max:100', 'min:3'],
            'description'=>['max:255']
        ];

        $messages = [
            'required'=>'Kolom harus diisi!',
            'max'=>'Maksimal :max karakter',
            'min'=>'Minimal :min karakter',
            'email'=>'Format email tidak valid, example@example.com'
        ];

        $validatedData = $request->validate($rules, $messages);

        $supplier = new Supplier();
        $supplier->id = (string) Str::uuid();
        $supplier->name = $validatedData['name'];
        $supplier->address = $validatedData['address'];
        $supplier->city = $validatedData['city'];
        $supplier->province = $validatedData['province'];
        $supplier->postal_code = $validatedData['postal_code'];
        $supplier->phone = '62'.$validatedData['phone'];
        $supplier->email = $validatedData['email'];
        $supplier->account_number = $validatedData['account_number'];
        $supplier->account_name = $validatedData['account_name'];
        $supplier->bank = $validatedData['bank'];
        $supplier->tax_number = $validatedData['tax_number'];
        $supplier->description = $validatedData['description'];

        try {
            $supplier->save();
            return back()->with('success', 'Berhasil menambahkan data supplier');
        } catch (\Exception $e) {
            Log::error("message : ". $e->getMessage());
            return back()->with('error', 'Gagal menambahkan Supplier!');
        }
    }

    public function viewSupplierDetail(Request $request, Supplier $supplier) {
        if ($request->ajax() == false) {
            return redirect('/karuniamotor/dashboard');
        }

        $supplier = Supplier::where('id', $supplier->id)->first();

        return view('dashboard.modals.detailSupplierModal', [
            'supplier'=>$supplier,
        ]);
    }

    public function searchSupplier(Request $request) {
        if (!$request->ajax()) {
            return redirect('/karuniamotor/dashboard');
        }

        $query = Supplier::latest();

        if ($keyword = $request->input('keyword')) {
            $query->where(function($query) use ($keyword) {
                $query->where('name', 'like', '%'. $keyword. '%')
                    ->orWhere('address', 'like', '%'. $keyword. '%')
                    ->orWhere('email', 'like', '%'. $keyword. '%')
                    ->orWhere('phone', 'like', '%'. $keyword. '%')
                    ->orWhere('city', 'like', '%'. $keyword. '%');
            });
        }

        $suppliers = $query->paginate(10)->withQueryString();

        return view('dashboard.options.searchSupplier', compact('suppliers'));
    }


    function editProduct(Request $request) {
        $rules = [
            'plate_number'=>['required', 'max:20', 'min:3'],
            'brand'=>['required', 'max:50'],
            'name'=>['required', 'max:100', 'min:3'],
            'machine_number'=>['required', 'min:3'],
            'frame_number'=>['required', 'min:3'],
            'transmission'=>['required', 'max:10'],
            'bpkb_name'=>['required','max:100', 'min:3'],
            'year'=>['required'],
            'price'=>['required'],
            'description'=>['max:255'],
            'stock'=>['required'],
            'thumbnail'=>['image', 'file', 'max:4096'],
            'image'=>['image', 'file', 'max:4096'],
            'bpkb'=>['image', 'file', 'max:4096'],
            'stnk'=>['image', 'file', 'max:4096'],
        ];

        $messages = [
            'required'=>'Kolom harus diisi!',
            'max'=>'Maksimal :max',
            'min'=>'Minimal :min',
            'image'=>'Harus gambar *.jpg, *.png, *.jpeg',
            'file'=>'Data harus berupa file',
            'max:4096'=>'Maksimal 4 MB',
        ];

       $validatedData = $request->validate($rules, $messages);

        $product = Product::where('id', $request->productId)->first();
        $product->plate_number = $validatedData['plate_number'];
        $product->brand = $validatedData['brand'];
        $product->name = $validatedData['name'];
        $product->bpkb_name = $validatedData['bpkb_name'];
        $product->machine_number = $validatedData['machine_number'];
        $product->frame_number = $validatedData['frame_number'];
        $product->stock = $validatedData['stock'];
        $product->transmission = $validatedData['transmission'];
        $product->year = $validatedData['year'];
        $product->price = $validatedData['price'];
        $product->description = $validatedData['description'];
        $product->update();

        $document = Document::where('product_id', $product->id)->first();

        $oldBpkb = $request->oldBpkb;
        $oldStnk = $request->oldStnk;

        $bpkbPath = 'assets/users/bpkb';
        $stnkPath = 'assets/users/stnk';

        $bpkbFile = $request->file('bpkb');
        $stnkFile = $request->file('stnk');

        $validatedData['bpkb'] = $oldBpkb;
        $validatedData['stnk'] = $oldStnk;

        if ($bpkbFile != null) {
            File::delete(public_path('assets/users/bpkb/'.$oldBpkb));

            $fileName = time().'-'.str_replace(' ', '-', $bpkbFile->getClientOriginalName());
            $bpkbFile->move($bpkbPath, $fileName);

            $validatedData['bpkb'] = $fileName;
        }

        if ($stnkFile != null) {
            File::delete(public_path('assets/users/stnk/'.$oldStnk));

            $fileName = time().'-'.str_replace(' ', '-', $stnkFile->getClientOriginalName());
            $stnkFile->move($stnkPath, $fileName);

            $validatedData['stnk'] = $fileName;
        }
        
        $document->bpkb_img = $validatedData['bpkb'];
        $document->stnk_img = $validatedData['stnk'];
        $document->update();

        $oldProductImages = json_decode($request->oldProductImages);
        $oldThumbnail = $request->oldImage;

        $names = [];
        $image = Image::where('product_id', $product->id)->first();
        $path = 'assets/users/products';

        $validatedData['thumbnail'] = $oldThumbnail;

        if ($request->file('images')) {
            $files = $request->file('images');

            if ($oldThumbnail && $oldProductImages) {
                foreach ($oldProductImages as $oldProductImage) {
                    File::delete('assets/users/products/'.$oldProductImage->image);
                }
            }

            foreach ($files as $file) {
                $fileName = time() . '-' . str_replace(' ', '-', $file->getClientOriginalName());

                $file->move($path, $fileName);
                array_push($names, $fileName);
            }

            $validatedData['thumbnail'] = str_replace('"', '', json_encode($names[0]));
        }

        $image->thumbnail = $validatedData['thumbnail'];
        $image->update();

        $productImages = ProductImages::where('image_id', $image->id)->get();

        if ($request->file('images') != null) {
            foreach ($productImages as $productImage) {
                $productImage->delete();
            }
    
            foreach ($names as $name) {
                $validatedData['image'] = $name;
                $setProductImage = new ProductImages();
                $setProductImage->image_id = $image->id;
                $setProductImage->image = $validatedData['image'];
                $setProductImage->save();
            }
        }

        return back()->with('success', 'Berhasil mengubah data produk.');
    }
}
