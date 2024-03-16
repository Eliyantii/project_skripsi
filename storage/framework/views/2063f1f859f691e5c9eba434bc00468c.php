<div class="modal" tabindex="-1" id="popUpModal" aria-hidden="true">
  <div class="modal-dialog modal-l modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Detail Penawaran</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <h5 class="text-danger fw-bold">Identitas Penawar</h5>
        <div class="mb-3">
          <p class="fw-semibold mt-0 mb-0"><span class="text-muted">Nama Penawar : </span> <?php echo e(ucwords($product->user->name)); ?></p>
          <p class="fw-semibold mt-0 mb-0"><span class="text-muted">Alamat Penawar : </span> <?php echo e(ucwords($product->user->address)); ?></p>
          <p class="fw-semibold mt-0 mb-0"><span class="text-muted">Nomor Telepon : </span> <?php echo e($product->user->phone); ?></p>
          <p class="fw-semibold mt-0 mb-0"><span class="text-muted">Email Penawar : </span> <?php echo e($product->user->email); ?></p>
        </div>
        <h5 class="text-danger fw-bold">Identitas Produk</h5>
        <div class="">
            <div class="row">
                <?php $__currentLoopData = $product->imageUser->productImages; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $productImage): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <div class="col pe-2 mb-2" style="max-width: 10rem;">
                        <img src="/assets/users/products/<?php echo e($productImage->image); ?>" class="img-fluid rounded">
                    </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
            <div>
                <p class="fw-bold mb-0 fs-5"><?php echo e(ucwords($product->brand)); ?> <?php echo e(ucwords($product->name)); ?></p>
                <p class="fw-semibold mt-0 mb-0"><?php echo e($product->condition); ?></p>
                <p class="fw-semibold mt-0 mb-0"><span class="text-muted">Nomor Plat : </span> <?php echo e(strtoupper($product->plate_number)); ?></p>
                <p class="fw-semibold mt-0 mb-0"><span class="text-muted">Nama BPKB : </span> <?php echo e(ucwords($product->bpkb_name)); ?></p>
                <p class="fw-semibold mt-0 mb-0"><span class="text-muted">Harga : </span> Rp<?php echo e(number_format($product->price, 2, ',', '.')); ?></p>
                <p class="fw-semibold mt-0 mb-0"><span class="text-muted">Nomor Mesin : </span> <?php echo e(strtoupper($product->machine_number)); ?></p>
                <p class="fw-semibold mt-0 mb-0"><span class="text-muted">Nomor Mesin : </span> <?php echo e(strtoupper($product->frame_number)); ?></p>
                <p class="fw-semibold mt-0 mb-0"><span class="text-muted">Transmisi : </span> <?php echo e($product->transmission); ?></p>
                <p class="fw-semibold mt-0 mb-0"><span class="text-muted">Tahun : </span> <?php echo e($product->year); ?></p>
                <div class="row mt-3">
                  <div class="col">
                    <p class="fw-semibold mb-0 pb-0">Buku Pemilik Kendaraan Bermotor (BPKB)</p>
                    <img src="/assets/users/bpkb/<?php echo e($product->document->bpkb_img); ?>" class="img-fluid rounded">
                  </div>
                  <div class="col">
                    <p class="fw-semibold mb-0 pb-0">Surat Tanda Nomor Kendaraan (STNK)</p>
                    <img src="/assets/users/stnk/<?php echo e($product->document->stnk_img); ?>" class="img-fluid rounded">
                  </div>
                </div>
            </div>
        </div>
        <h5 class="text-danger fw-bold mt-3">Penawaran</h5>
        <div>
            <p class="fw-semibold mt-0 mb-0"><span class="text-muted">Harga Tawar : </span> <?php echo e(($product->offer_price == null) ? "Belum ada penawaran harga" : "Rp".number_format($product->offer_price, 2, ',','.')); ?></p>
            <p class="fw-semibold mt-0 mb-0"><span class="text-muted">Status Penawaran : </span><?php echo e(($product->offer_status == null) ? "Menunggu..." : ucwords($product->offer_status)); ?></p>
            <p class="fw-semibold mt-0 mb-0"><span class="text-muted">Tanggal : </span><?php echo e(date('d/m/Y h:i', strtotime($product->created_at))); ?></p>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
      </div>
    </div>
  </div>
</div><?php /**PATH D:\Development\karunia-motor-eli\karuniaApp\resources\views/dashboard/modals/detailOfferModal.blade.php ENDPATH**/ ?>