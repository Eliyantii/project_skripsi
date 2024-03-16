

<?php $__env->startSection('js'); ?>
<script src="/js/order.js"></script>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
<div class="row rounded bg-white py-3 mx-5 mt-5 d-flex justify-content-start flex-md-row flex-column">
    <div class="col-md bg-white overflow-hidden border-2 border p-0 m-0 mx-3 rounded" style="max-height: 20rem">
        <div id="carouselExampleIndicators" class="carousel slide" data-bs-ride="carousel">
            <div class="carousel-indicators">
                <?php for($i = 0; $i < $imageCount; $i++): ?>
                    <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="<?php echo e($i); ?>" class="active" aria-current="true" aria-label="Slide <?php echo e($i); ?>"></button>
                <?php endfor; ?>
            </div>
            <div class="carousel-inner overflow-hidden" style="max-height: 18rem">
                <?php $__currentLoopData = $product->imageUser->productImages; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index=>$productImage): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <div class="carousel-item <?php echo e(($index == 0) ? 'active' : ''); ?> overflow-hidden" style="max-height: 315px">
                        <img src="/assets/users/products/<?php echo e($productImage->image); ?>" class="d-block w-100 rounded img-fluid" style="max-width: 40rem; max-height: 288px">
                    </div>   
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
            <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators"
                data-bs-slide="prev">
                <span class="carousel-control-prev-icon bg-dark" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators"
                data-bs-slide="next">
                <span class="carousel-control-next-icon bg-dark" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
            </button>
        </div>
    </div>
    <div class="col bg-white p-4">
        <h3 class="fw-bold mb-0 pb-0"><?php echo e($product->brand); ?> <?php echo e($product->name); ?></h3>
        <h2 class="fw-bold mb-0 pb-0 text-danger">Rp<?php echo e(number_format($product->price, 2, ',','.')); ?></h2>
        <p class="fw-bold m-0 p-0 mb-3"><?php echo e($product->condition); ?></p>
        <div class="d-flex">
            <p class="fw-bold me-2 text-muted mt-0 mb-0 p-0">Tahun</p>
            <p class="fw-bold m-0 p-0 text-danger"><?php echo e($product->year); ?></p>
        </div>
        <div class="d-flex">
            <p class="fw-bold me-2 text-muted mt-0 mb-0 p-0 ">Nomor Mesin</p>
            <p class="fw-bold m-0 p-0 text-danger"><?php echo e(ucwords($product->machine_number)); ?></p>
        </div>
        <div class="d-flex">
            <p class="fw-bold me-2 text-muted mt-0 mb-0 p-0 ">Nomor Rangka</p>
            <p class="fw-bold m-0 p-0 text-danger"><?php echo e(ucwords($product->frame_number)); ?></p>
        </div>
        <div class="d-flex">
            <p class="fw-bold me-2 text-muted mt-0 mb-0 p-0 ">Status BPKB</p>
            <p class="fw-bold m-0 p-0 text-danger"><?php echo e(($product->bpkb_name != null) ? "Ya" : "Tidak"); ?></p>
        </div>
        <div class="d-flex">
            <p class="fw-bold me-2 text-muted mt-0 mb-0 p-0 ">Stok</p>
            <p class="fw-bold m-0 p-0 text-danger"><?php echo e($product->stock); ?> Unit</p>
        </div>
        <div class="d-flex">
            <p class="fw-bold me-2 text-muted mt-0 mb-0 p-0 ">Transmisi</p>
            <p class="fw-bold m-0 p-0 text-danger"><?php echo e($product->transmission); ?></p>
        </div>
    </div>
</div>
<div class="bg-white mx-5 mt-2 p-3 rounded">
    <div class="border-bottom border-1 pb-2 mb-3">
        <h3>Form Pembelian Motor</h3>
    </div>
    <?php if(session()->has('error')): ?>
        <div class="mx-3 alert alert-danger alert-dismissible fade show" role="alert">
            <?php echo e(session('error')); ?>

            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    <?php endif; ?>
    <form action="/karuniamotor/cart" method="POST" enctype="multipart/form-data" autocomplete="off">
        <?php echo csrf_field(); ?>
        <div class="px-3">
            <input type="hidden" name="product" value="<?php echo e($product); ?>">
            <small class="text-danger"><i>*Pembelian motor pada website hanya khusus pembelian secara Cash, jika ingin membeli secara Cash Tempo harap untuk ke showroom</i></small>
            <div class="mb-3 mt-3">
                <div class="mb-3">
                    <label for="date_taken" class="form-label fw-semibold">Tanggal Pengambilan Unit<span
                            class="text-danger">*</span></label>
                    <div class="input-group">
                        <input type="date" class="form-control <?php $__errorArgs = ['date_taken'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" id="date_taken" name="date_taken" value="<?php echo e(old('date_taken', $currentDate)); ?>" required>
                    </div>
                    <?php $__errorArgs = ['date_taken'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                    <div class="mt-2 text-sm text-danger">
                        <?php echo e($message); ?>

                    </div>
                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                </div>
                <div class="mb-3">
                    <label for="unit" class="form-label fw-semibold">Unit Pembelian<span
                            class="text-danger">*</span></label>
                    <div class="input-group">
                        <input type="number" class="form-control <?php $__errorArgs = ['unit'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" id="unit" name="unit" required value="<?php echo e(old('unit', '1')); ?>">
                    </div>
                    <?php $__errorArgs = ['unit'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                    <div class="mt-2 text-sm text-danger">
                        <?php echo e($message); ?>

                    </div>
                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                </div>
            </div>
            <div class="row mt-3 mb-3 justify-content-center align-items-center">
                <div class="col-md-6 mb-3 text-center">
                    <p class="fw-semibold">Kartu Tanda Penduduk (KTP)<span class="text-danger">*</span></p>
                    <div class="mb-2">
                        <img src="/assets/ilustrasi_ktp.jpg" class="img-fluid rounded imgPreviewKTP">
                    </div>
                    <input type="file" id="imageKTP" class="d-none" name="user_card" onchange="previewImageKTP()">
                    <label for="imageKTP" class="btn bg-danger text-white p-1 col-12 text-center rounded mt-0">Pilih Foto</label>
                </div>
                <div class="col-md-6 mb-3 text-center">
                    <p class="fw-semibold">Kartu Keluarga (KK)<span class="text-danger">*</span></p>
                    <div class="mb-2">
                        <img src="/assets/ilustrasi_kartu_keluarga.jpg" class="img-fluid rounded imgPreviewKK">
                    </div>
                    <input type="file" id="imageKK" class="d-none <?php $__errorArgs = ['user_family_card'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" name="user_family_card" onchange="previewImageKK()">
                    <label for="imageKK" class="btn bg-danger text-white p-1 col-12 text-center rounded mt-0">Pilih Foto</label>
                    <?php $__errorArgs = ['user_family_card'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                    <div class="mt-2 text-sm text-danger">
                        <?php echo e($message); ?>

                    </div>
                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                </div>
            </div>
            <div class="d-grid gap-2 mt-5">
                <button class="btn btn-danger" type="submit">Masukan Keranjang</button>
            </div>
            
        </div>
    </form>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('home.layouts.utama', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\Skripsi\program\karunia-motor-eli\karuniaApp\resources\views/home/detailProduk.blade.php ENDPATH**/ ?>