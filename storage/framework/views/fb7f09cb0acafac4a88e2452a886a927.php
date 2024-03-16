

<?php $__env->startSection('bottom_js'); ?>
<script src="/js/penawaran.js"></script>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('main'); ?>
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">Selamat Datang <?php echo e(auth()->user()->name); ?></h1>
</div>
<div>
    <div class="mb-4 border-bottom border-1">
        <div class="d-flex mb-0 pb-0">
            <a href="/karuniamotor/dashboard/supplier"
            class="text-decoration-none ps-0 py-2 pe-2 ms-0 fw-bold <?php echo e(Request::is('karuniamotor/dashboard/supplier') ? 'text-primary' : 'text-danger'); ?>">Daftar
            Supplier</a>
            <div class="border-end border-1 mb-1 mt-1"></div>
            <a href="/karuniamotor/dashboard/supplier/add"
            class="text-decoration-none ps-2 py-2 ms-0 fw-bold <?php echo e(Request::is('karuniamotor/dashboard/supplier/add') ? 'text-primary' : 'text-danger'); ?>">Tambah
            Supplier</a>

            <div class="ms-auto">
                <a href="/karuniamotor/dashboard/supplier/report/download" class="btn btn-danger btn-sm p-2 mb-1 rounded-pill justify-content-end">
                    <i class="bi bi-cloud-arrow-down"></i> Laporan
                </a>
            </div>
        </div>
    </div>
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
    
    <?php echo $__env->yieldContent('option'); ?>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('dashboard.layouts.main', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\Skripsi\program\karunia-motor-eli\karuniaApp\resources\views/dashboard/supplier.blade.php ENDPATH**/ ?>