

<?php $__env->startSection('js'); ?>
<script src="/js/penawaran.js"></script>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
<div class="mx-3 my-3">
    <div class="bg-white px-3 py-2 rounded">
        <div class="row center">
            <div class="col-md-6">
                <div class="row d-flex align-items-center justify-content-center">
                    <div class="col-md-4 mb-3 mb-md-0 text-center">
                        <img src="/assets/users/profile/<?php echo e(Auth::user()->image); ?>" alt="" class="img-thumbnail rounded-circle" style="height: 10rem; width:10rem">
                    </div>
                    <div class="col-md-8">
                        <p class="fw-semibold fs-5 p-0 m-0"><?php echo e(ucwords(Auth::user()->name)); ?></p>
                        <p class="p-0 m-0 fw-semibold text-muted"><i class="bi bi-geo-alt"></i>
                            <?php echo e(ucwords(Auth::user()->subdistrict )); ?>, <?php echo e(ucwords(Auth::user()->province )); ?></p>
                        <button class="text-primary p-0 btn-ubah-profil" data-bs-toggle="modal"
                            data-bs-target="#ubahDataProfil"><i class="bi bi-pencil"></i> Ubah data diri</button>
                    </div>
                </div>
            </div>
            <div class="col-md-6 text-center d-flex justify-content-center align-items-center mt-3">
                <p class="fw-semibold">
                    <i class="bi bi-box2"></i> Total Transaksi <span class="fw-bold text-danger"><?php echo e($count); ?></span>
                </p>
            </div>
        </div>
    </div>

    <div class="bg-white my-2 px-3 py-3 rounded">
        <div class="row">
            <div class="col-4 text-center">
                <a href="/karuniamotor/profile/transaction/snap"
                    class="fw-bold fs-5 text-decoration-none <?php echo e(Request::is('karuniamotor/profile/transaction/snap') ? 'active' : 'text-danger'); ?>"><i
                        class="bi bi-arrow-left-right"></i> Penjualan</a>
            </div>
            <div class="col-4 text-center">
                <a href="/karuniamotor/profile/offer"
                    class="fw-bold fs-5 text-decoration-none <?php echo e(Request::is('karuniamotor/profile/offer') ? 'active' : 'text-danger'); ?>"><i
                        class="bi bi-box2"></i> Penawaran</a>
            </div>
            <div class="col-4 text-center">
                <a href="/karuniamotor/profile/change-password"
                    class="fw-bold fs-5 text-decoration-none <?php echo e(Request::is('karuniamotor/profile/change-password') ? 'active' : 'text-danger'); ?>"><i
                        class="bi bi-key"></i> Ubah Sandi</a>
            </div>
        </div>
    </div>

    <div class="bg-white my-2 px-3 py-2 rounded">
        <?php echo $__env->yieldContent('option'); ?>
    </div>
</div>


<!-- Modal -->
<div class="modal fade" id="ubahDataProfil" tabindex="-1" aria-labelledby="ubahDataProfilLabel" aria-hidden="true">
    <div class="modal-dialog">
        <form action="/karuniamotor/profile/<?php echo e(Auth::user()->id); ?>/change-profile" method="POST" enctype="multipart/form-data" autocomplete="off">
            <?php echo method_field('put'); ?>
            <?php echo csrf_field(); ?>
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Ubah Data Diri</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div>
                        <div class="mb-3">
                            <input type="hidden" name="oldImage" value="<?php echo e(Auth::user()->image); ?>">
                            <p class="fw-semibold">Foto Anda<span class="text-danger">*</span></p>
                            <div class="col-6 mb-2">
                                <?php if(Auth::user()->image): ?>
                                    <img src="/assets/users/profile/<?php echo e(Auth::user()->image); ?>" class="img-fluid rounded imgPreview">
                                <?php else: ?>
                                    <img class="img-fluid rounded imgPreview">
                                <?php endif; ?>
                            </div>
                            <input type="file" id="image" class="d-none" name="image" onchange="previewImage()">
                            <label for="image" class="bg-primary text-white p-1 col-6 text-center rounded mt-0">Pilih Foto</label>
                        </div>
                        <div class="mb-3">
                            <label for="name" class="form-label fw-semibold">Nama<span
                                    class="text-danger">*</span></label>
                            <div class="input-group">
                                <input type="text" class="form-control <?php $__errorArgs = ['name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" id="name" name="name" required value="<?php echo e(old('name',  Auth::user()->name)); ?>">
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
                            <label for="email" class="form-label fw-semibold">Email<span
                                    class="text-danger">*</span></label>
                            <div class="input-group">
                                <input type="text" class="form-control <?php $__errorArgs = ['email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" id="email" name="email" required value="<?php echo e(old('email',  Auth::user()->email)); ?>">
                            </div>
                            <?php $__errorArgs = ['email'];
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
                            <label for="address" class="form-label fw-semibold">Alamat<span
                                    class="text-danger">*</span></label>
                            <div class="form-floating">
                                <div class="input-group">
                                    <input type="text" class="form-control <?php $__errorArgs = ['address'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" id="address" name="address" required value="<?php echo e(old('address', Auth::user()->address)); ?>">
                                </div>
                            </div>
                            <?php $__errorArgs = ['address'];
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
                            <label for="phone" class="form-label fw-semibold">Nomor telepon<span
                                    class="text-danger">*</span></label>
                            <div class="input-group">
                                <input type="text" class="form-control <?php $__errorArgs = ['phone'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" id="phone"
                                    name="phone" required value="<?php echo e(old('phone', Auth::user()->phone)); ?>">
                            </div>
                            <?php $__errorArgs = ['phone'];
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
                            <label for="province" class="form-label fw-semibold">Provinsi<span
                                    class="text-danger">*</span></label>
                            <div class="col">
                                <select class="form-select form-select-md" name="province" id="province" class="<?php $__errorArgs = ['province'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>">
                                    <option value="<?php echo e(old('province', Auth::user()->province)); ?>"><?php echo e(Auth::user()->province); ?></option>
                                </select>
                            </div>
                            <?php $__errorArgs = ['province'];
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
                            <label for="city" class="form-label fw-semibold">Kota/Kabupaten<span class="text-danger">*</span></label>
                            <div class="col">
                                <select class="form-select form-select-md" name="city" id="city" class="<?php $__errorArgs = ['city'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>">
                                    <option value="<?php echo e(old('city', Auth::user()->city)); ?>"><?php echo e(Auth::user()->city); ?></option>
                                </select>
                            </div>
                            <?php $__errorArgs = ['city'];
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
                            <label for="subdistrict" class="form-label fw-semibold">Kecamatan<span class="text-danger">*</span></label>
                            <div class="col">
                                <select class="form-select form-select-md" name="subdistrict" id="subdistrict" class="<?php $__errorArgs = ['subdistrict'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>">
                                    <option value="<?php echo e(old('subdistrict', Auth::user()->subdistrict)); ?>"><?php echo e(Auth::user()->subdistrict); ?></option>
                                </select>
                            </div>
                            <?php $__errorArgs = ['subdistrict'];
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
                            <label for="postal_code" class="form-label fw-semibold">Kode pos<span
                                    class="text-danger">*</span></label>
                            <div class="input-group">
                                <input type="text" class="form-control <?php $__errorArgs = ['postal_code'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                                    id="postal_code" name="postal_code" required
                                    value="<?php echo e(old('postal_code', Auth::user()->postal_code)); ?>">
                            </div>
                            <?php $__errorArgs = ['postal_code'];
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
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batalkan</button>
                    <button type="submit" class="btn btn-primary">Ubah</button>
                </div>
            </div>
        </form>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('home.layouts.utama', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\Development\karunia-motor-eli\karuniaApp\resources\views/user/profil.blade.php ENDPATH**/ ?>