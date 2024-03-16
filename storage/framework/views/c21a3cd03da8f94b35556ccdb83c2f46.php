<script src="/js/dashboard.js"></script>

<?php if($transactions->isNotEmpty()): ?>
    <table class="table table-sm table-bordered table-hover shadow-sm text-center">
        <thead class="bg-primary text-white">
            <tr>
                <th scope="col">Nomor Transaksi</th>
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
                    <td><?php echo e(date('d/m/Y h:i', strtotime($transaction->transaction_date))); ?></td>
                    <td><?php echo e($transaction->status); ?></td>
                    <td><?php echo e($transaction->owner_response); ?></td>
                    <?php if($transaction->status == 'Dibatalkan'): ?>
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

    <div class="row">
        <div class="col">
            <div class="d-flex justify-content-start">
                <?php echo e($transactions->links()); ?>

            </div>
        </div>
    </div>
<?php else: ?>
    <div class="row mt-3 justify-content-center">
        <div class="col-8 text-center justify-content-center">
            <div class="mt-3 mb-5">
                <h4>Belum Ada Pengguna</h4>
            </div>
            <img src="/assets/empty.png" class="img-fluid">
        </div>
    </div>
<?php endif; ?>
<?php /**PATH D:\Development\karunia-motor-eli\karuniaApp\resources\views/dashboard/options/searchTransaksi.blade.php ENDPATH**/ ?>