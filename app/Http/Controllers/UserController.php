<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Document;
use App\Models\Image;
use App\Models\Notification;
use App\Models\Product;
use App\Models\ProductImages;
use App\Models\Transaction;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function viewOffer() {
        // Mengambil semua data transaksi
        $transactions = Transaction::where('user_id', Auth::user()->id)
                                            ->orderBy('transaction_date', 'desc')
                                            ->get();

        // Hitung total transaksi
        $transactionCount = $transactions->count();

        $products = Product::latest()->where('user_id', Auth::user()->id)->where('status', 'Penawaran')->get();

        $notifications = Notification::where('user_2', Auth::user()->id)->get();

        $countNotif = 0;
        foreach ($notifications as $notif) {
            $countNotif++;
        }

        return view('user.options.penawaran', [
            'countNotif'=>$countNotif,
            'notifications'=>$notifications,
            'products'=>$products,
            'count'=>$transactionCount,
        ]);
    }

    public function viewChangePassword() {
        // Mengambil semua data transaksi
        $transactions = Transaction::where('user_id', Auth::user()->id)
                                            ->orderBy('transaction_date', 'desc')
                                            ->get();

        // Hitung total transaksi
        $transactionCount = $transactions->count();

        $notifications = Notification::latest()->where('user_2', Auth::user()->id)->get();

        $countNotif = 0;
        foreach ($notifications as $notif) {
            $countNotif++;
        }

        return view('user.options.ubahSandi', [
            'countNotif'=>$countNotif,
            'notifications'=>$notifications,
            'count'=>$transactionCount,
        ]);
    }

    function editPassword(Request $request) {
        $request->validate([
            'oldPassword'=>['required'],
            'password'=>['required', 'max:20', 'min:5', 'confirmed'],
        ], [
            'oldPassword.required'=>'Kolom harus diisi!',
            'password.required'=>'Kolom harus diisi!',
            'password.max'=>'Maksimal 20 karakter.',
            'password.min'=>'Minimal 5 karakter.',
            'password.confirmed'=>'Kata sandi tidak sesuai.'
        ]);

        if (Hash::check($request->oldPassword, Auth::user()->password)) {
            User::where('id', Auth::user()->id)->update(['password'=>Hash::make($request->password)]);

            return redirect()->back()->with('success', 'Kata sandi Anda berhasil diubah.');
        }

        return redirect()->back()->with('error', 'Terdapat kesalahan, mohon periksa kembali.');
    }

    function editProfile (Request $request) {
        $user = User::where('id', Auth::user()->id)->first();

        // Cek nomor telepon ada perubahan atau tidak
        if ($request->phone != $user->phone) {
            $phone = ['phone'=>'required|max:15|unique:users'];
            $validatedData = $request->validate($phone);
            $user->phone = $validatedData['phone'];
        }

        // Validasi data perubahan
        $validatedData = $request->validate([
            'name'=>['max:100'],
            'address'=>['max:100'],
            'province'=>['max:100'],
            'city'=>['max:100'],
            'subdistrict'=>['max:100'],
            'postal_code'=>['max:10'],
            'image'=>['image', 'file', 'max:4096'],
        ],[
            'name.max'=>'Maksimal 100 kata.',
            'address.max'=>'Maksimal 100 kata',
            'province.max'=>'Maksimal 100 kata.',
            'city.max'=>'Maksimal 100 kata.',
            'subdistrict.max'=>'Maksimal 100 kata.',
            'postal_code.max'=>'Maksimal 10 angka.',
            'image.file'=>'Harus berupa file.',
            'image.image'=>'Format harus .jpg, .jpeg, dan .png',
            'image.max'=>'Maksimal size gambar 4 MB.'
        ]);

        // Cek jika tidak ada data yang diubah
        if (
            $request->image == $user->image 
            && $request->name == $user->name 
            && $request->address == $user->address 
            && $request->phone == $user->phone 
            && $request->province == $user->province 
            && $request->city == $user->city 
            && $request->subdistrict == $user->subdistrict 
            && $request->postal_code == $user->postal_code)
        {
            return redirect('/karuniamotor/profile/transaction/snap');
        }

        $user->name = $validatedData['name'];
        $user->address = $validatedData['address'];
        $user->province = $validatedData['province'];
        $user->city = $validatedData['city'];
        $user->subdistrict = $validatedData['subdistrict'];
        $user->postal_code = $validatedData['postal_code'];

        $path = 'assets/users/profile';
        $file = $request->file('image');

        if ($file != null) {
            if ($request->oldImage) {
                File::delete(public_path('assets/users/profile/'.$request->oldImage));
            }

            // Simpan gambar ke folder public
            $fileName = time().'-'.$file->getClientOriginalName();
            $file->move($path, $fileName);

            $validatedData['image'] = $fileName;
            $user->image = $validatedData['image'];
        }

        $user->update();

        return redirect('/karuniamotor/profile/transaction/snap');

    }

    public function storeOffer(Request $request) {
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
        ];

        $validatedData = $request->validate($rules, $messages);

        $product = new Product();
        $product->user_id = Auth::user()->id;
        $product->plate_number = $validatedData['plate_number'];
        $product->brand = $validatedData['brand'];
        $product->name = $validatedData['name'];
        $product->machine_number = $validatedData['machine_number'];
        $product->frame_number = $validatedData['frame_number'];
        $product->transmission = $validatedData['transmission'];
        $product->bpkb_name = $validatedData['bpkb_name'];
        $product->year = $validatedData['year'];
        $product->price = $validatedData['price'];
        $product->stock = $validatedData['stock'];
        $product->description = $validatedData['description'];
        $product->status = "Penawaran";
        $product->offer_status = "Menunggu";
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

        return back()->with('success', 'Penawaran berhasil ditambahkan.');

    }

    public function deleteOffer(Product $product) {
        // Hapus thumbnail produk di folder public
        File::delete(public_path('assets/users/products/'. $product->imageUser->thumbnail));

        // Hapus gambar-gambar produk di folder public
        foreach ($product->imageUser->productImages as $productImage) {
            File::delete(public_path('assets/users/products/'. $productImage->image));
        }

        $product->delete();

        return back()->with('success', 'Berhasil menghapus produk penawaran.');
    }

    public function viewEditOffer(Product $product) {
        $product = Product::where('id', $product->id)->first();

        return view('user.modals.ubahPenawaran', [
            'product'=>$product,
        ]);
    }

    public function editOffer(Request $request) {
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
            'stnk'=>['image', 'file', 'max:4096']
        ];

        $messages = [
            'required'=>'Kolom harus diisi!',
            'max'=>'Maksimal :max karakter!',
            'min'=>'Minimal :min karakter!',
            'image'=>'Harus gambar *.jpg, *.png, *.jpeg',
            'file'=>'Data harus berupa file',
            'max:4096'=>'Maksimal 4 MB'
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
        $product->status = "Penawaran";
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

        return back()->with('success', 'Berhasil mengubah data produk penawaran.');
    }
}
