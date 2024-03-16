<div class="modal fade" tabindex="-1" id="popUpModal" aria-hidden="true">
  <div class="modal-dialog modal-xl modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <div>
            <h5 class="modal-title">Detail Transaksi</h5>
            <p><?php echo e($transaction->getFormatedTransactionDateWithTime()); ?></p>
        </div>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <div class="mb-3">
            <p class="fs-5 fw-bold">Detail Pelanggan</p>
            <div class="row">
                <div class="col">
                    <p class="fw-semibold text-muted">Nama Pelanggan</p>
                </div>
                <div class="col">
                    <p class="text-end fw-semibold"><?php echo e($transaction->user->name); ?></p>
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <p class="fw-semibold text-muted">Nomor Telepon Pelanggan</p>
                </div>
                <div class="col">
                    <p class="text-end fw-semibold"><?php echo e($transaction->user->phone); ?></p>
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <p class="fw-semibold text-muted">Alamat Pelanggan</p>
                </div>
                <div class="col">
                    <p class="text-end fw-semibold"><?php echo e($transaction->user->address); ?></p>
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <p class="fw-semibold text-muted">Metode Pembayaran</p>
                </div>
                <div class="col">
                    <p class="text-end fw-semibold"><?php echo e(Str::replace("_", " ", Str::upper($transaction->payment_type))); ?></p>
                </div>
            </div>
            <div class="row justify-content-start align-items-center px-3">
                <div class="col card border-0 mb-2 me-2" style="max-width: 20rem;">
                    <img src="/assets/users/ktp/<?php echo e($transaction->user_card); ?>" class="img-fluid card-img-top" alt="...">
                    <div class="card-body">
                        <p class="card-text fw-bold fs-5">Kartu Tanda Penduduk (KTP)</p>
                    </div>
                </div>
                <div class="col card border-0" style="max-width: 20rem;">
                    <img src="/assets/users/kk/<?php echo e($transaction->user_family_card); ?>" class="img-fluid card-img-top">
                    <div class="card-body">
                        <p class="card-text fw-bold fs-5">Kartu Keluarga (KK)</p>
                    </div>
                </div>
            </div>
        </div>
        <hr class="">
        <div class="mb-3">
            <p class="fs-5 fw-bold">Detail Produk</p>
            <?php $totalItem = 0; ?>
            <?php $__currentLoopData = $transaction->transactionDetails; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $detail): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <?php $totalItem ++; ?>
                <div class="row">
                    <div class="col me-2" style="max-width: 13rem;">
                        <img src="/assets/users/products/<?php echo e($detail->historyPurchase->image); ?>" class="img-fluid rounded">
                    </div>
                    <div class="col p-0 m-0">
                        <p class="fw-bold ps-0 ms-0 py-0 my-0"><?php echo e(ucwords($detail->historyPurchase->brand)); ?> <?php echo e(ucwords($detail->historyPurchase->name)); ?></p>
                        <p class="fw-semibold my-0 py-0 ps-0 ms-0"><span class="text-muted">Unit : </span><?php echo e($detail->unit); ?>x</p>
                        <p class="fw-semibold my-0 py-0 ps-0 ms-0"><span class="text-muted">Harga : </span>Rp<?php echo e(number_format($detail->historyPurchase->price, 2, ',', '.')); ?></p>
                        <p class="fw-semibold my-0 py-0 ps-0 ms-0"><span class="text-muted">Subtotal : </span>Rp<?php echo e(number_format($detail->historyPurchase->price * $detail->unit, 2, ',', '.')); ?></p>
                    </div>
                </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
        <hr class="">
        <div class="mb-3">
            <p class="fs-5 fw-bold">Status Transaksi</p>
            <div class="row">
                <div class="col">
                    <p class="fw-semibold text-muted">Jumlah item</p>
                </div>
                <div class="col">
                    <p class="text-end fw-semibold"><?php echo e(number_format($totalItem, 0, ',','.')); ?>x</p>
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <p class="fw-semibold text-muted">Status Pembayaran</p>
                </div>
                <div class="col">
                    <p class="text-end fw-semibold"><?php echo e($transaction->status); ?></p>
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <p class="fw-bold text-muted">Total Transaksi</p>
                </div>
                <div class="col">
                    <p class="text-end fw-bold">Rp<?php echo e(number_format($transaction->gross_amount, 2, ',','.')); ?></p>
                </div>
            </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
      </div>
    </div>
  </div>
</div><?php /**PATH D:\Development\karunia-motor-eli\karuniaApp\resources\views/user/modals/detailTransaksiModal.blade.php ENDPATH**/ ?>