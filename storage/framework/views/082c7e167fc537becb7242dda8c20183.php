

<?php $__env->startSection('option'); ?>
<?php if($suppliers->isNotEmpty()): ?>
    <div>
        <div class="row">
            <div class="col table-responsive supplier-list">
                <table class="table table-sm table-bordered table-hover shadow-sm text-center">
                    <thead class="bg-primary text-white">
                        <tr class="align-middle">
                            <th scope="col">No</th>
                            <th scope="col">Nama</th>
                            <th scope="col">Alamat</th>
                            <th scope="col">Email</th>
                            <th scope="col">Telepon</th>
                            <th scope="col">Kota/Kabupaten</th>
                            <th scope="col">Kode Pos</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $__currentLoopData = $suppliers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $supplier): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr class="align-middle" style="cursor: pointer;" onclick="showSupplierDetail('<?php echo e($supplier->id); ?>');">
                                <td><?php echo e($loop->iteration); ?></td>
                                <td><?php echo e($supplier->name); ?></td>
                                <td><?php echo e($supplier->address); ?></td>
                                <td><?php echo e($supplier->email); ?></td>
                                <td><?php echo e($supplier->phone); ?></td>
                                <td><?php echo e($supplier->city); ?></td>
                                <td><?php echo e($supplier->postal_code); ?></td>
                            </tr>  
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
<?php else: ?>
    
    <div class="row d-flex justify-content-center align-items-center">
        <div class="col text-center">
            <div class="mt-5">
                <h4>Belum ada supplier <span class="text-danger">&#128517;</span></h4>
            </div>
        </div>
        <div class="col">
            <img src="/assets/data_kosong.jpg" class="img-fluid">
        </div>
    </div>
<?php endif; ?>


<div class="supplierDetailModal" id="supplierDetailModal"></div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('dashboard.supplier', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\Skripsi\program\karunia-motor-eli\karuniaApp\resources\views/dashboard/options/daftarSupplier.blade.php ENDPATH**/ ?>