<div class="modal fade" id="popUpModal" tabindex="-1" aria-labelledby="popUpModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <form action="/karuniamotor/profile/offer/edit/<?php echo e($product->id); ?>" method="POST" enctype="multipart/form-data" autocomplete="off">
            <?php echo csrf_field(); ?>
            <?php echo method_field('put'); ?>
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Penawaran</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div>
                        <input type="hidden" name="productId" value="<?php echo e($product->id); ?>">
                        <input type="hidden" name="oldImage" value="<?php echo e($product->imageUser->thumbnail); ?>">
                        <input type="hidden" name="oldProductImages" value="<?php echo e($product->imageUser->productImages); ?>">
                        <input type="hidden" name="oldBpkb" value="<?php echo e($product->document->bpkb_img); ?>">
                        <input type="hidden" name="oldStnk" value="<?php echo e($product->document->stnk_img); ?>">
                        <div class="mb-4">
                            <label for="image" class="form-label">Gambar Motor<span class="text-danger">*</span></label>
                            <div class="d-inline my-2">
                                <div id="preview">
                                    <div id="close"></div>
                                </div>
                            </div>
                            <div class="input-group mt-2">
                                <input type="file" class="form-control" name="images[]" id="files" multiple
                                    onchange="previewMultiImage()" data-accepted="image/*" data-maxFileSize="4">
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="plate_number" class="form-label">Nomor Plat<span class="text-danger">*</span></label>
                            <div class="input-group">
                                <input type="text" name="plate_number" class="form-control <?php $__errorArgs = ['plate_number'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                                    id="plate_number" aria-describedby="basic-addon3 basic-addon4" placeholder="KB 98xx XX" required
                                    value="<?php echo e(old('plate_number', strtoupper($product->plate_number))); ?>">
                            </div>
                            <?php $__errorArgs = ['plate_number'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                            <div class="mt-2 text-sm text-danger">
                                <?php echo e($message); ?>

                            </div>
                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                        </div>
                        <div class="input-group mb-3">
                            <label class="form-label" for="brand">Merek Motor<span class="text-danger">*</span></label>
                            <div class="input-group">
                                <select class="form-select" id="brand" name="brand">
                                    <option value="<?php echo e($product->brand); ?>"><?php echo e($product->brand); ?></option>
                                </select>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="name" class="form-label">Nama Motor<span class="text-danger">*</span></label>
                            <div class="input-group">
                                <input type="text" name="name" class="form-control <?php $__errorArgs = ['name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                                    id="name" aria-describedby="basic-addon3 basic-addon4" required
                                    value="<?php echo e(old('name', $product->name)); ?>">
                            </div>
                            <?php $__errorArgs = ['name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                            <div class="mt-2 text-sm text-danger">
                                <?php echo e($message); ?>

                            </div>
                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                        </div>
                        <div class="mb-3">
                            <label for="machine_number" class="form-label">Nomor Mesin<span class="text-danger">*</span></label>
                            <div class="input-group">
                                <input type="text" name="machine_number" class="form-control <?php $__errorArgs = ['machine_number'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                                    id="machine_number" aria-describedby="basic-addon3 basic-addon4" required
                                    value="<?php echo e(old('machine_number', $product->machine_number)); ?>">
                            </div>
                            <?php $__errorArgs = ['machine_number'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                            <div class="mt-2 text-sm text-danger">
                                <?php echo e($message); ?>

                            </div>
                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                        </div>
                        <div class="mb-3">
                            <label for="frame_number" class="form-label">Nomor Rangka<span class="text-danger">*</span></label>
                            <div class="input-group">
                                <input type="text" name="frame_number" class="form-control <?php $__errorArgs = ['frame_number'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                                    id="frame_number" aria-describedby="basic-addon3 basic-addon4" required
                                    value="<?php echo e(old('frame_number', $product->frame_number)); ?>">
                            </div>
                            <?php $__errorArgs = ['frame_number'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                            <div class="mt-2 text-sm text-danger">
                                <?php echo e($message); ?>

                            </div>
                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                        </div>
                        <div class="mb-3">
                            <label for="bpkb_name" class="form-label">Nama Pemilik BPKB<span class="text-danger">*</span></label>
                            <div class="input-group">
                                <input type="text" name="bpkb_name" class="form-control <?php $__errorArgs = ['bpkb_name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                                    id="bpkb_name" aria-describedby="basic-addon3 basic-addon4" required
                                    value="<?php echo e(old('bpkb_name', ucwords($product->bpkb_name))); ?>">
                            </div>
                            <?php $__errorArgs = ['bpkb_name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                <div class="mt-2 text-sm text-danger">
                                    <?php echo e($message); ?>

                                </div>
                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                        </div>
                        <div class="mb-4">
                            <p class="mb-2 pb-0">Buku Pemilik Kendaraan Bermotor (BPKB)<span class="text-danger">*</span></p>
                            <div class="col-6 mb-2">
                                <?php if($product->document->bpkb_img): ?>
                                    <img src="/assets/users/bpkb/<?php echo e($product->document->bpkb_img); ?>" class="img-fluid rounded imgPreview">
                                <?php else: ?>
                                    <img src="/assets/letter.jpg" class="img-fluid rounded imgPreview">
                                <?php endif; ?>
                            </div>
                            <div class="input-group">
                                <input type="file" class="form-control" name="bpkb" id="image"
                                        onchange="previewImage()" data-accepted="image/*" data-maxFileSize="4">
                            </div>
                            <?php $__errorArgs = ['bpkb'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                <div class= "mt-2 text-sm text-danger">
                                    <?php echo e($message); ?>

                                </div>
                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                        </div>
                        <div class="mb-4">
                            <p class="mb-2 pb-0">Surat Tanda Nomor Kendaraan (STNK)<span class="text-danger">*</span></p>
                            <div class="col-6 mb-2">
                                <?php if($product->document->stnk_img): ?>
                                    <img src="/assets/users/stnk/<?php echo e($product->document->stnk_img); ?>" class="img-fluid rounded imgStnkPreview">
                                <?php else: ?>
                                    <img src="/assets/letter.jpg" class="img-fluid rounded imgStnkPreview">
                                <?php endif; ?>
                            </div>
                            <div class="input-group">
                                <input type="file" class="form-control" name="stnk" id="imageStnk" onchange="previewStnkImage()" data-accepted="image/*" data-maxFileSize="4">
                            </div>
                            <?php $__errorArgs = ['stnk'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                <div class= "mt-2 text-sm text-danger">
                                    <?php echo e($message); ?>

                                </div>
                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                        </div>
                        <div class="mb-3">
                            <label for="stock" class="form-label">Stok Unit<span class="text-danger">*</span></label>
                            <input type="hidden" name="stock" value="1">
                            <div class="input-group">
                                <input type="text" class="form-control" aria-describedby="basic-addon3 basic-addon4" value="1" disabled>
                            </div>
                        </div>
                        <div class="input-group mb-3">
                            <label class="form-label" for="transmission">Transmisi Motor<span
                                    class="text-danger">*</span></label>
                            <div class="input-group">
                                <select class="form-select" id="transmission" name="transmission">
                                    <option value="Automatic" <?php echo e(($product->transmission == "Automatic") ? 'selected' : ''); ?>>Automatic</option>
                                    <option value="Manual" <?php echo e(($product->transmission == "Manual") ? 'selected' : ''); ?>>Manual</option>
                                </select>
                            </div>
                        </div>
                        <div class="col">
                            <div class="mb-3">
                                <label for="year" class="form-label">Tahun<span class="text-danger">*</span></label>
                                <div class="input-group">
                                    <select class="form-select" id="yearpicker" name="year">
                                        <option value="<?php echo e($product->year); ?>"><?php echo e($product->year); ?></option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="price" class="form-label">Harga<span class="text-danger">*</span></label>
                            <div class="input-group">
                                <input type="number" class="form-control <?php $__errorArgs = ['price'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                                    id="price" name="price" aria-describedby="basic-addon3 basic-addon4" required
                                    onkeypress="return hanyaAngka(event)" value="<?php echo e(old('price', $product->price)); ?>">
                            </div>
                            <?php $__errorArgs = ['price'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                            <div class="mt-2 text-sm text-danger">
                                <?php echo e($message); ?>

                            </div>
                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                        </div>
                        <div class="mb-3">
                            <label for="description" class="form-label fw-semibold">Keterangan<span class="text-danger">*</span></label>
                            <div class="form-floating">
                                <textarea class="form-control <?php $__errorArgs = ['description'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" id="description" name="description" style="height: 100px"><?php echo e(($product->description != null) ? $product->description : ""); ?></textarea>
                            </div>
                            <?php $__errorArgs = ['description'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                <div class= "mt-2 text-sm text-danger">
                                    <?php echo e($message); ?>

                                </div>
                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary">Ubah</button>
                </div>
            </div>
        </form>
    </div>
</div>

<script>
  $('#popUpModal').on('shown.bs.modal', function () {
    // Jalankan JavaScript saat modal muncul
    var subjectObject = [
      "Honda",
      "Yamaha",
      "Suzuki",
      "Kawasaki",
      "Vespa",
      "TVS",
      "Ducati",
      "Aprilia",
      "KTM",
      "Bajaj",
    ];

    var brandSel = document.getElementById("brand");

    for (var i = 0; i < subjectObject.length; i++) {
      brandSel.options[brandSel.options.length] = new Option(
        subjectObject[i],
        subjectObject[i]
      );
    }

    var yearSel = document.getElementById("yearpicker");
    var currentYear = new Date().getFullYear();

    for (var year = currentYear; year >= currentYear - 50; year--) {
      yearSel.options[yearSel.options.length] = new Option(year, year);
    }

    function hanyaAngka(evt) {
      var charCode = evt.which ? evt.which : event.keyCode;
      if (charCode > 31 && (charCode < 48 || charCode > 57)) return false;
      return true;
    }
  });
</script><?php /**PATH D:\Development\karunia-motor-eli\karuniaApp\resources\views/user/modals/ubahPenawaran.blade.php ENDPATH**/ ?>