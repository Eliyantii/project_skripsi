

<?php $__env->startSection('option'); ?>
<div>
    <h4 class="text-danger mb-4">Form Penjualan</h4>
    <form action="/karuniamotor/dashboard/product/add" method="POST" enctype="multipart/form-data" autocomplete="off">
        <?php echo csrf_field(); ?>
        <div class="mb-4">
            <label for="image" class="form-label">Gambar Motor<span class="text-danger">*</span></label>
            <div class="d-inline my-2">
                <div id="preview">
                    <div id="close"></div>
                </div>
            </div>
            <div class="input-group mt-2">
                <input type="file" class="form-control" name="images[]" id="files" multiple
                    onchange="previewMultiImage()" data-accepted="image/*" data-maxFileSize="4">
            </div>
        </div>
        <div class="input-group mb-3">
            <label class="form-label" for="brand">Merek Motor<span class="text-danger">*</span></label>
            <div class="input-group">
                <select class="form-select" id="brand" name="brand">
                    <option value="">Pilih</option>
                </select>
            </div>
        </div>
        <div class="mb-3">
            <label for="name" class="form-label">Nama Motor<span class="text-danger">*</span></label>
            <div class="input-group">
                <input type="text" name="name" class="form-control <?php $__errorArgs = ['name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" id="name"
                    aria-describedby="basic-addon3 basic-addon4" required value="<?php echo e(old('name')); ?>">
            </div>
            <?php $__errorArgs = ['name'];
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
            <label for="plate_number" class="form-label">Nomor Plat<span class="text-danger">*</span></label>
            <div class="input-group">
                <input type="text" name="plate_number" class="form-control <?php $__errorArgs = ['plate_number'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                    id="plate_number" aria-describedby="basic-addon3 basic-addon4" placeholder="KB 98xx XX" required
                    value="<?php echo e(old('plate_number')); ?>">
            </div>
            <?php $__errorArgs = ['plate_number'];
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
            <label for="machine_number" class="form-label">Nomor Mesin<span class="text-danger">*</span></label>
            <div class="input-group">
                <input type="text" name="machine_number"
                    class="form-control <?php $__errorArgs = ['machine_number'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" id="machine_number"
                    aria-describedby="basic-addon3 basic-addon4" required value="<?php echo e(old('machine_number')); ?>">
            </div>
            <?php $__errorArgs = ['machine_number'];
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
            <label for="frame_number" class="form-label">Nomor Rangka<span class="text-danger">*</span></label>
            <div class="input-group">
                <input type="text" name="frame_number" class="form-control <?php $__errorArgs = ['frame_number'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                    id="frame_number" aria-describedby="basic-addon3 basic-addon4" required
                    value="<?php echo e(old('frame_number')); ?>">
            </div>
            <?php $__errorArgs = ['frame_number'];
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
            <label for="bpkb_name" class="form-label">Nama Pemilik BPKB<span class="text-danger">*</span></label>
            <div class="input-group">
                <input type="text" name="bpkb_name" class="form-control <?php $__errorArgs = ['bpkb_name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                    id="bpkb_name" aria-describedby="basic-addon3 basic-addon4" required value="<?php echo e(old('bpkb_name')); ?>">
            </div>
            <?php $__errorArgs = ['bpkb_name'];
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
        <div class="mb-4">
            <p class="mb-2 pb-0">Buku Pemilik Kendaraan Bermotor (BPKB)<span class="text-danger">*</span></p>
            <div class="col-3 mb-2">
                <img src="/assets/letter.jpg" class="img-fluid rounded imgBpkbPreview">
            </div>
            <div class="input-group">
                <input type="file" class="form-control" name="bpkb" id="imageBpkb" onchange="previewBpkbImage()"
                    data-accepted="image/*" data-maxFileSize="4">
            </div>
            <?php $__errorArgs = ['bpkb'];
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
        <div class="mb-4">
            <p class="mb-2 pb-0">Surat Tanda Nomor Kendaraan (STNK)<span class="text-danger">*</span></p>
            <div class="col-3 mb-2">
                <img src="/assets/letter.jpg" class="img-fluid rounded imgStnkPreview">
            </div>
            <div class="input-group">
                <input type="file" class="form-control" name="stnk" id="imageStnk" onchange="previewStnkImage()"
                    data-accepted="image/*" data-maxFileSize="4">
            </div>
            <?php $__errorArgs = ['stnk'];
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
        <div class="input-group mb-3">
            <label class="form-label" for="transmission">Transmisi Motor<span class="text-danger">*</span></label>
            <div class="input-group">
                <select class="form-select" id="transmission" name="transmission">
                    <option selected>Automatic</option>
                    <option value="1">Manual</option>
                </select>
            </div>
        </div>
        <div class="col">
            <div class="mb-3">
                <label for="year" class="form-label">Tahun<span class="text-danger">*</span></label>
                <div class="input-group">
                    <select class="form-select" id="yearpicker" name="year">
                    </select>
                </div>
            </div>
        </div>
        <div class="mb-3">
            <label for="stock" class="form-label">Stok Unit<span class="text-danger">*</span></label>
            <div class="input-group">
                <input type="number" class="form-control <?php $__errorArgs = ['stock'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" id="stock" name="stock"
                    aria-describedby="basic-addon3 basic-addon4" value="1">
            </div>
            <?php $__errorArgs = ['stock'];
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
            <label for="price" class="form-label">Harga<span class="text-danger">*</span></label>
            <div class="input-group">
                <input type="number" class="form-control <?php $__errorArgs = ['price'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" id="price" name="price"
                    aria-describedby="basic-addon3 basic-addon4" required onkeypress="return hanyaAngka(event)"
                    value="<?php echo e(old('price')); ?>">
            </div>
            <?php $__errorArgs = ['price'];
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
            <label for="description" class="form-label fw-semibold">Keterangan<span class="text-danger">*</span></label>
            <div class="form-floating">
                <textarea class="form-control <?php $__errorArgs = ['description'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" id="description"
                    name="description" style="height: 100px"></textarea>
            </div>
            <?php $__errorArgs = ['description'];
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
        <div class="d-grid gap-2 mt-4 mb-3">
            <button class="btn btn-primary" type="submit">Posting</button>
        </div>
    </form>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('dashboard.produk', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\Skripsi\program\karunia-motor-eli\karuniaApp\resources\views/dashboard/options/tambahProduk.blade.php ENDPATH**/ ?>