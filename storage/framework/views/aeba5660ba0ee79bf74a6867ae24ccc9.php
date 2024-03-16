

<?php $__env->startSection('option'); ?>
<?php if($transactions->isNotEmpty()): ?>
    <div>
        <div class="row">
            <div class="col table-responsive transaction-list">
                <table class="table table-sm table-bordered table-hover shadow-sm text-center">
                    <thead class="bg-primary text-white">
                        <tr>
                            <th scope="col">Nomor Transaksi</th>
                            <th scope="col">Nama</th>
                            <th scope="col">Tanggal Transaksi</th>
                            <th scope="col">Status</th>
                            <th scope="col">Status Konfirmasi</th>
                            <th scope="col">Total Pemasukan</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $__currentLoopData = $transactions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $transaction): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr style="cursor: pointer" onclick="showSalesTransactionDetailPopUp('<?php echo e($transaction->id); ?>');">
                                <td><?php echo e($transaction->id); ?></td>
                                <td><?php echo e(ucwords($transaction->user->name)); ?></td>
                                <td><?php echo e(date('d/m/Y h:i', strtotime($transaction->transaction_date))); ?></td>
                                <td><?php echo e($transaction->status); ?></td>
                                <td><?php echo e($transaction->owner_response); ?></td>
                                <?php if($transaction->status == 'Dibatalkan' || $transaction->owner_response == "Ditolak"): ?>
                                    <td class="text-muted fw-semibold">
                                        + Rp0
                                    </td>
                                <?php else: ?>
                                    <td class="fw-semibold text-success">
                                        +
                                        Rp<?php echo e(number_format($transaction->gross_amount - $transaction->application_fee, 0, ',', '.')); ?>

                                    </td>
                                <?php endif; ?>
                            </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </tbody>
                </table>
            </div>
        </div>

        <div class="row">
            <div class="col">
                <div class="d-flex justify-content-end">
                    <?php echo e($transactions->links()); ?>

                </div>
            </div>
        </div>
    </div>
<?php else: ?>
    
    <div class="row d-flex justify-content-center align-items-center">
        <div class="col text-center">
            <div class="mt-5">
                <h4>Belum ada transaksi <span class="text-danger">&#128517;</span></h4>
            </div>
        </div>
        <div class="col">
            <img src="/assets/data_kosong.jpg" class="img-fluid">
        </div>
    </div>
<?php endif; ?>


<div class="transactionDetailModal" id="transactionDetailModal"></div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('dashboard.transaksi', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\Development\karunia-motor-eli\karuniaApp\resources\views/dashboard/options/daftarTransaksi.blade.php ENDPATH**/ ?>