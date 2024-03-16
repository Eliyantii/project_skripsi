<?php $__currentLoopData = $transactions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $transaction): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
    <?php $__currentLoopData = $transaction->transactionDetails; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $transactionDetail): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <div class="card mb-3" style="max-width: 600px;">
            <div class="row g-0">
                <div class="col-md-5 py-2 px-2">
                    <img src="/assets/users/products/<?php echo e($transactionDetail->historyPurchase->image); ?>" class="img-fluid rounded-start rounded-end">
                </div>
                <div class="col-md-7">
                    <div class="card-body mt-0 pt-0">
                        <div class="mb-2">
                            <p class="card-text p-0 m-0"><small class="text-body-secondary">Transaksi terakhir
                                    <?php echo e($transaction->created_at->locale('id')->diffForHumans()); ?></small></p>
                        </div>
                        <div class="mb-1">
                            <h5 class="card-title p-0 m-0 fw-bold">
                                <?php echo e(ucwords($transactionDetail->historyPurchase->brand)); ?>

                                <?php echo e(ucwords($transactionDetail->historyPurchase->name)); ?></h5>
                            <p class="card-text p-0 m-0 fw-bold text-danger">
                                Rp<?php echo e(number_format($transactionDetail->historyPurchase->price, 2, ',', '.')); ?></p>
                            <p class="card-text p-0 m-0 fw-semibold"><span class="text-muted">Unit : </span>
                                <?php echo e($transactionDetail->unit); ?>x</p>
                            <p class="card-text p-0 m-0 fw-semibold"><span class="text-muted">Total : </span>
                                Rp<?php echo e(number_format($transaction->gross_amount, 2, ',', '.')); ?></p>
                        </div>
                        <div class="d-flex justify-content-end mb-0 pb-0">
                            <?php if($transaction->status == "Berhasil" && $transaction->owner_response == "Menunggu"): ?>
                                <p class="fw-bold mb-0"><?php echo e($transaction->owner_response); ?>...</p>
                            <?php elseif($transaction->status == "Tertunda"): ?>
                                <form action="<?php echo e(route('cancelPayment', ['transaction'=>$transaction->id])); ?>" method="POST">
                                    <?php echo csrf_field(); ?>
                                    <button type="submit" class="btn btn-danger me-2">Batal</button>
                                </form>

                                <button type="submit" class="btn btn-success" id="payBtn" onclick="makePayment('<?php echo e($transaction->snap_token); ?>'); return false;">Bayar</button>

                            <?php else: ?>
                                <p class="fw-semibold"><?php echo e($transaction->owner_response); ?></p>
                            <?php endif; ?>
                        </div>
                        <p class="text-end mt-0 pt-0 mb-0 pb-0"><small class="text-body-secondary"><?php echo e(date('d-M-Y H:i:s', strtotime($transaction->updated_at))); ?></small></p>
                    </div>
                </div>
            </div>
        </div>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>


<form id="snapCallbackForm" method="POST">
    <?php echo csrf_field(); ?>
    <input type="hidden" name="snapCallback" id="snapCallback">
    <input type="hidden" name="snapToken" id="snapToken">
</form>
<?php /**PATH D:\Development\karunia-motor-eli\karuniaApp\resources\views/user/options/riwayatPembelian.blade.php ENDPATH**/ ?>