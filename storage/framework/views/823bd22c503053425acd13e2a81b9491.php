<div class="modal" tabindex="-1" id="popUpModal" aria-hidden="true">
  <div class="modal-dialog modal-l modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Detail Supplier</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body px-3">
        <div class="row mb-3">
            <div class="col">
                <p class="fw-semibold text-muted">Nama Supplier</p>
            </div>
            <div class="col text-end">
                <p class="fw-semibold"><?php echo e($supplier->name); ?></p>
            </div>
        </div>
        <div class="row mb-3">
            <div class="col">
                <p class="fw-semibold text-muted">Alamat Supplier</p>
            </div>
            <div class="col text-end">
                <p class="fw-semibold"><?php echo e($supplier->address); ?></p>
            </div>
        </div>
        <div class="row mb-3">
            <div class="col">
                <p class="fw-semibold text-muted">Provinsi</p>
            </div>
            <div class="col text-end">
                <p class="fw-semibold"><?php echo e($supplier->province); ?></p>
            </div>
        </div>
        <div class="row mb-3">
            <div class="col">
                <p class="fw-semibold text-muted">Kota/Kabupaten</p>
            </div>
            <div class="col text-end">
                <p class="fw-semibold"><?php echo e($supplier->city); ?> (<?php echo e($supplier->postal_code); ?>)</p>
            </div>
        </div>
        <div class="row mb-3">
            <div class="col">
                <p class="fw-semibold text-muted">Email Supplier</p>
            </div>
            <div class="col text-end">
                <p class="fw-semibold"><?php echo e($supplier->email); ?></p>
            </div>
        </div>
        <div class="row mb-3">
            <div class="col">
                <p class="fw-semibold text-muted">Telepon Supplier</p>
            </div>
            <div class="col text-end">
                <p class="fw-semibold"><?php echo e($supplier->phone); ?></p>
            </div>
        </div>
        <div class="row mb-3">
            <div class="col">
                <p class="fw-semibold text-muted">Nomor Rekening</p>
            </div>
            <div class="col text-end">
                <p class="fw-semibold"><?php echo e($supplier->account_number); ?></p>
            </div>
        </div>
        <div class="row mb-3">
            <div class="col">
                <p class="fw-semibold text-muted">Nama Rekening</p>
            </div>
            <div class="col text-end">
                <p class="fw-semibold"><?php echo e($supplier->account_name); ?></p>
            </div>
        </div>
        <div class="row mb-3">
            <div class="col">
                <p class="fw-semibold text-muted">Bank</p>
            </div>
            <div class="col text-end">
                <p class="fw-semibold"><?php echo e($supplier->bank); ?></p>
            </div>
        </div>
        <div class="row mb-3">
            <div class="col">
                <p class="fw-semibold text-muted">NPWP Supplier</p>
            </div>
            <div class="col text-end">
                <p class="fw-semibold"><?php echo e($supplier->tax_number); ?></p>
            </div>
        </div>
        <div class="row mb-3">
            <div class="col">
                <p class="fw-semibold text-muted">Deskripsi</p>
                <pre class="fw-semibold"><?php echo e($supplier->description); ?></pre>
            </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
      </div>
    </div>
  </div>
</div><?php /**PATH D:\Development\karunia-motor-eli\karuniaApp\resources\views/dashboard/modals/detailSupplierModal.blade.php ENDPATH**/ ?>