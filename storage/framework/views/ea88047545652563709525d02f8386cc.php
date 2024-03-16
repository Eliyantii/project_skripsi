

<?php $__env->startSection('option'); ?>
<small class="text-danger"><i>*Pada menu penawaran berfungsi untuk pengguna dalam menawarkan produk yaitu motor kepada
        perusahaan. Produk yang ditawarkan dapat dibeli ataupun ditolak oleh perusahaan.</i></small>

<?php if(session()->has('success')): ?>
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <?php echo e(session('success')); ?>

        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
<?php endif; ?>
<?php if(session()->has('error')): ?>
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <?php echo e(session('error')); ?>

        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
<?php endif; ?>
<div>
    <div class="mb-3 mt-3">
        <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalPenawaran">Buat Penawaran</button>
    </div>
    <?php if($products->isNotEmpty()): ?>
        <div>
            <?php $__currentLoopData = $products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div class="card mb-3" style="max-width: 40rem;">
                    <div class="row g-0">
                        <div class="col-md-5 px-2 py-2">
                            <img src="/assets/users/products/<?php echo e($product->imageUser->thumbnail); ?>" class="img-fluid rounded-start rounded-end" alt="Thumbnail">
                        </div>
                        <div class="col-md-7">
                            <div class="card-body">
                                <div class="d-flex">
                                    <h4 class="card-title text-danger fw-bold"><?php echo e(ucwords($product->brand)); ?> <?php echo e(ucwords($product->name)); ?></h4>
                                    <div class="btn-group mx-2 position-absolute top-0 end-0">
                                        <button class="btn btn-sm border-0 fs-4" type="button" data-bs-toggle="dropdown">
                                            ...
                                        </button>
                                        <ul class="dropdown-menu">
                                            <li><button class="dropdown-item" onclick="showEditProductModal('<?php echo e($product->id); ?>');" <?php echo e(($product->offer_status == null || $product->offer_status == "Menunggu") ? "" : "disabled"); ?>><i class="bi bi-pencil"></i> Edit</button></li>
                                            <li>
                                                <form action="/karuniamotor/profile/offer/delete/<?php echo e($product->id); ?>" method="POST" class="d-inline">
                                                    <?php echo csrf_field(); ?>
                                                    <?php echo method_field('delete'); ?>
                                                    <button class="dropdown-item" type="submit"
                                                        onclick="return confirm('Yakin ingin hapus?')"><i
                                                            class="bi bi-trash3"></i>
                                                        Hapus</button>
                                                </form>
                                            </li>
                                        </ul>
                                    </div>
                                </div>

                                <p class="fw-semibold">Rp<?php echo e(number_format($product->price, 2, ',', '.')); ?></p>
                                <div class="">
                                    <div class="d-flex">
                                        <p class="fw-semibold p-0 m-0 me-2">Tahun</p>
                                        <p class="fw-semibold p-0 m-0 text-muted"><?php echo e($product->year); ?></p>
                                    </div>
                                    <div class="d-flex">
                                        <p class="fw-semibold p-0 m-0 me-2">Model</p>
                                        <p class="fw-semibold p-0 m-0 text-muted"><?php echo e(ucwords($product->transmission)); ?></p>
                                    </div>
                                    <div class="d-flex">
                                        <p class="fw-semibold p-0 m-0 me-2">Status</p>
                                        <p class="fw-semibold p-0 m-0 text-muted"><?php echo e(($product->offer_status == null) ? "Menunggu" : $product->offer_status); ?></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
    <?php else: ?>
        
        <div class="row d-flex justify-content-center align-items-center">
            <div class="col text-center">
                <div class="mt-5">
                    <h4>Penawaran masih kosong <span class="text-danger">&hearts;</span></h4>
                </div>
            </div>
            <div class="col">
                <img src="/assets/data_kosong.jpg" class="img-fluid">
            </div>
        </div>
    <?php endif; ?>
</div>


<div class="editProductModal" id="editProductModal"></div>

<!-- Tambah Penawaran Modal -->
<div class="modal fade" id="modalPenawaran" tabindex="-1" aria-labelledby="modalPenawaranLabel" aria-hidden="true">
    <div class="modal-dialog">
        <form action="<?php echo e(route('storeOffer')); ?>" method="POST" enctype="multipart/form-data" autocomplete="off">
            <?php echo csrf_field(); ?>
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Penawaran</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div>
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
unset($__errorArgs, $__bag); ?>"
                                    id="name" aria-describedby="basic-addon3 basic-addon4" required
                                    value="<?php echo e(old('name')); ?>">
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
                                <input type="text" name="machine_number" class="form-control <?php $__errorArgs = ['machine_number'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                                    id="machine_number" aria-describedby="basic-addon3 basic-addon4" required
                                    value="<?php echo e(old('machine_number')); ?>">
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
                                    id="bpkb_name" aria-describedby="basic-addon3 basic-addon4" required
                                    value="<?php echo e(old('bpkb_name')); ?>">
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
                            <div class="col-6 mb-2">
                                <img src="/assets/letter.jpg" class="img-fluid rounded imgPreview">
                            </div>
                            <div class="input-group">
                                <input type="file" class="form-control" name="bpkb" id="image"
                                        onchange="previewImage()" data-accepted="image/*" data-maxFileSize="4">
                            </div>
                            <?php $__errorArgs = ['bpkb'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                <div class= "mt-2 text-sm text-danger">
                                    <?php echo e($message); ?>

                                </div>
                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                        </div>
                        <div class="mb-4">
                            <p class="mb-2 pb-0">Surat Tanda Nomor Kendaraan (STNK)<span class="text-danger">*</span></p>
                            <div class="col-6 mb-2">
                                <img src="/assets/letter.jpg" class="img-fluid rounded imgPreview">
                            </div>
                            <div class="input-group">
                                <input type="file" class="form-control" name="stnk" id="image"
                                        onchange="previewImage()" data-accepted="image/*" data-maxFileSize="4">
                            </div>
                            <?php $__errorArgs = ['stnk'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                <div class= "mt-2 text-sm text-danger">
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
unset($__errorArgs, $__bag); ?>"
                                    id="price" name="price" aria-describedby="basic-addon3 basic-addon4" required
                                    onkeypress="return hanyaAngka(event)" value="<?php echo e(old('price')); ?>">
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
unset($__errorArgs, $__bag); ?>" id="description" name="description" style="height: 100px"></textarea>
                            </div>
                            <?php $__errorArgs = ['description'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                <div class= "mt-2 text-sm text-danger">
                                    <?php echo e($message); ?>

                                </div>
                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary">Ajukan</button>
                </div>
            </div>
        </form>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('user.profil', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\Development\karunia-motor-eli\karuniaApp\resources\views/user/options/penawaran.blade.php ENDPATH**/ ?>