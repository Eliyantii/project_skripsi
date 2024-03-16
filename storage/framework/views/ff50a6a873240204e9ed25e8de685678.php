<div class="modal fade" id="paymentModal" tabindex="-1" aria-labelledby="paymentModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <form action="/karuniamotor/dashboard/cash-tempo/pay/<?php echo e($cashTempo->id); ?>" method="POST">
        <?php echo csrf_field(); ?>
        <div class="modal-content">
        <div class="modal-header">
            <h1 class="modal-title fs-5" id="exampleModalLabel">Pembayaran</h1>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <p class="text-danger fw-semibold fs-5"><span class="text-muted fs-5">Sisa : </span>Rp<?php echo e(number_format($cashTempo->remaining_total, 2, ',', '.')); ?></p>
            <p class="fw-semibold"><span class="text-muted">Tenggat : </span><?php echo e(($cashTempo->status == "Belum Lunas") ? date('d, M Y', strtotime($cashTempo->due_date)) : "Lunas"); ?></p>
            <hr class="my-3">
                <div class="mb-3">
                    <label for="pay" class="form-label fw-semibold">Jumlah Bayar<span class="text-danger">*</span></label>
                    <div class="input-group">
                        <input type="number" class="form-control" id="pay" name="pay" aria-describedby="basic-addon3 basic-addon4">
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                <button type="submit" class="btn btn-primary">Simpan</button>
            </div>
        </div>
    </form>
  </div>
</div><?php /**PATH D:\Development\karunia-motor-eli\karuniaApp\resources\views/dashboard/modals/payCashTempo.blade.php ENDPATH**/ ?>