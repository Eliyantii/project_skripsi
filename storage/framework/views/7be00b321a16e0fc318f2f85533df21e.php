<div class="modal" id="popUpModal" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Form Penawaran Harga</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form action="/karuniamotor/dashboard/offer/bid/<?php echo e($product->id); ?>" method="POST">
          <?php echo csrf_field(); ?>
          <div class="modal-body">
            <div class="mb-3">
                <p class="mb-0 fw-bold fs-4">Harga Produk</p>
                <p class="mt-0 fw-semibold fs-5 text-warning">Rp<?php echo e(number_format($product->price, 2, ',', '.')); ?></p>
            </div>
            <div>
                <div class="mb-3">
                    <label for="offer_price" class="form-label">Harga Tawaran</label>
                    <div class="input-group">
                        <input type="number" name="offer_price" class="form-control" id="offer_price" aria-describedby="basic-addon3 basic-addon4" required>
                    </div>
                </div>
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
            <button type="submit" class="btn btn-warning">Tawar</button>
          </div>
      </form>
    </div>
  </div>
</div><?php /**PATH D:\Development\karunia-motor-eli\karuniaApp\resources\views/dashboard/modals/bidModal.blade.php ENDPATH**/ ?>