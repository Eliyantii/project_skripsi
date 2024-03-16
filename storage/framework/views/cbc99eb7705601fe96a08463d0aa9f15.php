

<?php $__env->startSection('option'); ?>
<?php if($products->isNotEmpty()): ?>
    <div>
            <div class="row">
                <div class="col table-responsive">
                    <table class="table table-sm table-bordered table-hover shadow-sm text-center">
                        <thead class="bg-primary text-white">
                            <tr>
                                <th scope="col">No</th>
                                <th scope="col">Tanggal Penawaran</th>
                                <th scope="col">Harga</th>
                                <th scope="col">Harga Tawar</th>
                                <th scope="col">Status Penawaran</th>
                                <th scope="col">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $__currentLoopData = $products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr class="align-middle" style="cursor: pointer" onclick="showOfferDetailPopUp('<?php echo e($product->id); ?>');">
                                    <td><?php echo e($loop->iteration); ?></td>
                                    <td><?php echo e(date('d/m/Y h:i', strtotime($product->created_at))); ?></td>
                                    <td>Rp<?php echo e(number_format($product->price, 2, ',', '.')); ?></td>
                                    <td><?php echo e(($product->offer_price == null) ? "Rp0" : "Rp". number_format($product->offer_price, 2, ',', '.')); ?></td>
                                    <td><?php echo e(($product->offer_status == null) ? "Menunggu" : $product->offer_status); ?></td>
                                    <td class="d-flex justify-content-center align-items-center"> 
                                        <form action="/karuniamotor/dashboard/offer/reject/<?php echo e($product->id); ?>" method="POST">
                                            <?php echo csrf_field(); ?>
                                            <button type="submit" class="btn btn-danger btn-sm me-1" onclick="event.stopPropagation(); return confirm('Anda yakin ingin menolak penawaran ?');"><i class="bi bi-x-lg"></i></button>
                                        </form>
                                        <button type="submit" class="btn btn-warning btn-sm me-1" onclick="showBidModal('<?php echo e($product->id); ?>');"><i class="bi bi-pencil"></i></button>
                                        <form action="" method="POST">
                                            <?php echo csrf_field(); ?>
                                            <button type="submit" class="btn btn-success btn-sm" onclick="event.stopPropagation(); return confirm('Anda yakin ingin menerima penawaran ?');"><i class="bi bi-check-lg"></i></button>
                                        </form>
                                    </td>
                                </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="row">
                <div class="col">
                    <div class="d-flex justify-content-end">
                        <?php echo e($products->links()); ?>

                    </div>
                </div>
            </div>
    </div>
<?php else: ?>
    
    <div class="row d-flex justify-content-center align-items-center">
        <div class="col text-center">
            <div class="mt-5">
                <h4>Belum ada penawaran <span class="text-danger">&#128517;</span></h4>
            </div>
        </div>
        <div class="col">
            <img src="/assets/data_kosong.jpg" class="img-fluid">
        </div>
    </div>
<?php endif; ?>


<div class="bidModal" id="bidModal"></div>


<div class="offerDetailModal" id="offerDetailModal"></div>
<?php $__env->stopSection(); ?>


<?php echo $__env->make('dashboard.penawaranPelanggan', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\Development\karunia-motor-eli\karuniaApp\resources\views/dashboard/options/daftarPenawaranPending.blade.php ENDPATH**/ ?>