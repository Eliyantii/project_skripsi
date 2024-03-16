

<?php $__env->startSection('option'); ?>
<div class="px-3 py-3">
    <div class="row">
        <div class="col-3">
            <p class="fw-bold fs-5 p-0 m-0">Total Saku</p>
            <div class="rounded p-4 text-center m-0 bg-light shadow">
                <p class="text-dark fw-bold saku fs-4">Rp 8.000.000,00</p>
            </div>
        </div>
        <div class="col-3">
            <p class="fw-bold fs-5 p-0 m-0">Total Penarikan</p>
            <div class="rounded p-4 text-center m-0 bg-light shadow">
                <p class="text-dark fw-bold saku fs-4">Rp 8.000.000,00</p>
            </div>
        </div>

    </div>
    <div class="row mt-3">
        <div class="col-6 text-center d-grid gap-2">
            <button class="btn btn-primary shadow fw-bold" data-bs-toggle="modal" data-bs-target="#tarikSaku">Tarik
                Saku</button>
        </div>
    </div>
</div>



<!-- Modal -->
<div class="modal fade" id="tarikSaku" tabindex="-1" aria-labelledby="tarikSakuLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Penarikan Saku</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="input-group mb-3">
                    <label class="form-label" for="bank">Tujuan Penarikan<span class="text-danger">*</span></label>
                    <div class="input-group">
                        <select class="form-select <?php $__errorArgs = ['bank'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" id="bank" name="bank">
                            <option value="">Pilih</option>
                        </select>
                        <?php $__errorArgs = ['bank'];
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
                </div>
                <div class="input-group mb-3">
                    <label class="form-label p-0 m-0" for="bank_account_number">Nomor Rekening<span class="text-danger">*</span></label>
                    <i class="text-danger p-0 mt-0 mb-1 me-0 ms-0 d-block"><small>*Isi dengan nomor telepon, jika memilih e-wallet (GoPay, ShopeePay, Dana, OVO, dan LinkAja)</small></i>
                    <div class="input-group">
                        <select class="form-select <?php $__errorArgs = ['bank_account_number'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" id="bank_account_number" name="bank_account_number">
                            <option value="">Pilih</option>
                        </select>
                        <?php $__errorArgs = ['bank_account_number'];
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
                </div>
                <div class="mb-3">
                    <label for="valid_name" class="form-label">Nama Rekening Anda<span class="text-danger">*</span></label>
                    <div class="input-group">
                        <input type="text" class="form-control <?php $__errorArgs = ['valid_name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" id="valid_name" name="valid_name" aria-describedby="basic-addon3 basic-addon4" required value="<?php echo e(old('valid_name')); ?>">
                    </div>
                    <?php $__errorArgs = ['valid_name'];
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
                    <label for="amount" class="form-label p-0 m-0">Jumlah Penarikan<span class="text-danger">*</span></label>
                    <i class="text-danger p-0 m-0 d-block"><small>*Minimal jumlah penarikan Rp 5.000</small></i>
                    <div class="input-group">
                        <input type="text" class="form-control <?php $__errorArgs = ['amount'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" id="amount" name="amount" aria-describedby="basic-addon3 basic-addon4" required value="<?php echo e(old('amount')); ?>">
                    </div>
                    <?php $__errorArgs = ['amount'];
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
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batalkan</button>
                <button type="submit" id="sendMoneyBtn" class="btn btn-primary">Cairkan Saku</button>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('user.profil', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\Development\karunia-motor-eli\karuniaApp\resources\views/user/options/saku.blade.php ENDPATH**/ ?>