

<?php $__env->startSection('content'); ?>
<div class="px-5 py-5">
    <h3 class="text-center fw-bold mb-3"><i class="bi bi-cart2"></i> Keranjang Saya</h3>
    <div class="bg-white px-5 py-3 rounded ">
        <?php if(session()->has('success')): ?>
        <div class="alert alert-success alert-dismissible fade show mb-2" role="alert">
            <?php echo e(session('success')); ?>

            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        <?php endif; ?>
        <?php if(session()->has('error')): ?>
        <div class="alert alert-danger alert-dismissible fade show mb-2" role="alert">
            <?php echo e(session('error')); ?>

            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        <?php endif; ?>
        <?php if($carts->isNotEmpty()): ?>
            <div class="border-bottom border-1 py-2 mb-2">
                <form action="/karuniamotor/cart/deleteAll" method="POST">
                    <?php echo csrf_field(); ?>
                    <?php echo method_field('DELETE'); ?>
                    <button type="submit" class="text-danger fw-semibold p-0 btn-ubah-profil" data-bs-toggle="modal" data-bs-target="#ubahDataProfil">
                        <i class="bi bi-trash3"></i> Hapus Semua
                    </button>
                </form>
            </div>
            <?php echo $__env->make('user.component.dataKeranjang', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        <?php else: ?>
            
            <div class="row d-flex justify-content-center align-items-center">
                <div class="col text-center">
                    <div class="mt-5">
                        <h4>Keranjang masih kosong, belanja yukk..  <span class="text-danger">&hearts;</span></h4>
                    </div>
                </div>
                <div class="col">
                    <img src="/assets/empty.png" class="img-fluid">
                </div>
            </div>
        <?php endif; ?>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('home.layouts.utama', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\Skripsi\program\karunia-motor-eli\karuniaApp\resources\views/user/keranjang.blade.php ENDPATH**/ ?>