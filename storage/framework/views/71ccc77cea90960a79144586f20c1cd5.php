

<?php $__env->startSection('content'); ?>
<div class="row g-2 d-flex justify-content-between align-items-center">
    <div class="col-6">
        <img src="/assets/Poster_Daftar.png" alt="" class="img-fluid">
    </div>  
    <div class="col-6 justify-center align-content-center">
        <div class="mx-3 my-3 border border-2 border-secondary rounded bg-white p-3">
            <h1 class="text-center fw-bold mb-3">Lupa Kata Sandi</h1>
            <?php if(session()->has('error')): ?>
                <div class="mx-3 alert alert-danger alert-dismissible fade show" role="alert">
                    <?php echo e(session('error')); ?>

                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            <?php endif; ?>
            <form action="<?php echo e(route('checkEmail')); ?>" method="POST" autocomplete="off">
                <?php echo csrf_field(); ?>
                <div class="my-5 px-3">
                    <div class="mb-3">
                        <label for="email" class="form-label fw-semibold mb-0 pb-0">Email Anda<span class="text-danger">*</span></label>
                        <small class="text-danger d-block mt-0 pt-0 mb-2"><i>*Gunakan email saat pertama kali Anda melakukan pendaftaran.</i></small>
                        <div class="input-group">
                            <input type="text" class="form-control <?php $__errorArgs = ['email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" id="email" name="email" required value="<?php echo e(old('email')); ?>">
                        </div>
                        <?php $__errorArgs = ['email'];
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
                    <div class="d-grid gap-2 mt-3">
                        <button class="btn btn-primary" type="submit">Verifikasi Email</button>
                    </div>
                </div>
            </form>
        </div>
    </div>     
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('auth.layouts.utama', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\Development\karunia-motor-eli\karuniaApp\resources\views/auth/lupaSandi.blade.php ENDPATH**/ ?>