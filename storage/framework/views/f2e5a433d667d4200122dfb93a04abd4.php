

<?php $__env->startSection('option'); ?>
<div>
    <?php if($cashTempos->isNotEmpty()): ?>
        <div class="row">
            <div class="col table-responsive">
                <table class="table table-sm table-bordered table-hover shadow-sm text-center">
                    <thead class="bg-primary text-white">
                        <tr class="align-middle">
                            <th scope="col">Nomor Transaksi</th>
                            <th scope="col">Tanggal Transaksi</th>
                            <th scope="col">Bayar</th>
                            <th scope="col">Status</th>
                            <th scope="col">Sisa Bulan</th>
                            <th scope="col">Bunga</th>
                            <th scope="col">Angsuran</th>
                            <th scope="col">Total Sisa</th>
                            <th scope="col">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $__currentLoopData = $cashTempos; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cashTempo): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr class="align-middle">
                                <td><?php echo e($cashTempo->id); ?></td>
                                <td><?php echo e(date('d/m/Y h:i', strtotime($cashTempo->date_taken))); ?></td>
                                <td>Rp<?php echo e(number_format($cashTempo->dp, 2, ',', '.')); ?></td>
                                <td><?php echo e(ucwords($cashTempo->status)); ?></td>
                                <td><?php echo e($cashTempo->month); ?></td>
                                <td><?php echo e($cashTempo->interest); ?></td>
                                <td>Rp<?php echo e(number_format($cashTempo->installment)); ?></td>
                                <td>Rp<?php echo e(number_format($cashTempo->remaining_total)); ?></td>
                                <td>
                                    <button class="btn p-0 m-0 rounded-pill fw-semibold <?php echo e(($cashTempo->status == "Lunas") ? "text-danger border-0" : "text-success"); ?>" <?php echo e(($cashTempo->status == "Lunas") ? "disabled" : ""); ?> onclick="payCashTempo('<?php echo e($cashTempo->id); ?>')">Bayar</button>
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
                    <?php echo e($cashTempos->links()); ?>

                </div>
            </div>
        </div>
    <?php else: ?>
        
        <div class="row d-flex justify-content-center align-items-center">
            <div class="col text-center">
                <div class="mt-5">
                    <h4>Belum ada Cash Tempo <span class="text-danger">&#128517;</span></h4>
                </div>
            </div>
            <div class="col">
                <img src="/assets/data_kosong.jpg" class="img-fluid">
            </div>
        </div>
    <?php endif; ?>
</div>


<div class="payPopUpModal" id="payPopUpModal"></div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('dashboard.cashTempo', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\Development\karunia-motor-eli\karuniaApp\resources\views/dashboard/options/daftarCashTempo.blade.php ENDPATH**/ ?>