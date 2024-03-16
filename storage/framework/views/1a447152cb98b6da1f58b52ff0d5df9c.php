

<?php $__env->startSection('option'); ?>
<div class="my-5">
    <form action="/karuniamotor/dashboard/cash-tempo/form/add" method="POST" enctype="multipart/form-data"
        autocomplete="off">
        <?php echo csrf_field(); ?>
        <div class="d-flex flex-wrap">
            <div class="mb-3 col-md-5 px-2">
                <p class="fw-semibold">Kartu Tanda Penduduk (KTP)<span class="text-danger">*</span></p>
                <div class="mb-2">
                    <img src="/assets/ilustrasi_ktp.jpg" class="img-fluid rounded imgPreviewKTP">
                </div>
                <input type="file" id="imageKTP" class="d-none" name="user_card" onchange="previewImageKTP()">
                <label for="imageKTP" class="btn bg-primary text-white p-1 w-100 text-center rounded mt-0">Pilih
                    Foto</label>
            </div>
            <div class="mb-3 col-md-5 px-2">
                <p class="fw-semibold">Kartu Keluarga (KK)<span class="text-danger">*</span></p>
                <div class="mb-2">
                    <img src="/assets/ilustrasi_kartu_keluarga.jpg" class="img-fluid rounded imgPreviewKK">
                </div>
                <input type="file" id="imageKK" class="d-none <?php $__errorArgs = ['user_family_card'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                    name="user_family_card" onchange="previewImageKK()">
                <label for="imageKK" class="btn bg-primary text-white p-1 w-100 text-center rounded mt-0">Pilih
                    Foto</label>
                <?php $__errorArgs = ['user_family_card'];
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

        <div class="mt-5">
            <div class="my-3">
                <p class="fs-5 fw-bold text-danger">Data Motor</p>
            </div>
            <div>
                <div class="input-group mb-3">
                    <label class="form-label fw-semibold" for="product_id">Jenis Motor<span
                            class="text-danger">*</span></label>
                    <div class="input-group">
                        <select class="form-select" id="product_id" name="product_id">
                            <option value="">Pilih</option>
                            <?php if($products->isNotEmpty()): ?>
                                <?php $__currentLoopData = $products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option 
                                        value="<?php echo e($product->id); ?>"
                                        data-plate-number="<?php echo e(strtoupper($product->plate_number)); ?>"
                                        data-machine-number="<?php echo e(strtoupper($product->machine_number)); ?>"
                                        data-frame-number="<?php echo e($product->frame_number); ?>"
                                    >
                                        <?php echo e($product->year); ?>-<?php echo e($product->brand); ?> <?php echo e(ucwords($product->name)); ?> (<?php echo e(strtoupper($product->plate_number)); ?>)
                                    </option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            <?php endif; ?>
                        </select>
                    </div>
                </div>
                <div class="mb-3">
                    <label for="plate_number" class="form-label fw-semibold">Nomor Polisi</label>
                    <div class="input-group">
                        <input type="text" name="plate_number" class="form-control" id="plate_number" aria-describedby="basic-addon3 basic-addon4" disabled>
                    </div>
                </div>
                <div class="mb-3">
                    <label for="machine_number" class="form-label fw-semibold">Nomor Mesin</label>
                    <div class="input-group">
                        <input type="text" class="form-control" id="machine_number" name="machine_number" disabled>
                    </div>
                </div>
                <div class="mb-3">
                    <label for="frame_number" class="form-label fw-semibold">Nomor rangka</label>
                    <div class="input-group">
                        <input type="text" class="form-control" id="frame_number" name="frame_number" disabled>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="mb-3 mt-5">
            <div class="my-2">
                <p class="fw-bold text-danger fs-5">Data Konsumen</p>
            </div>
            <div class="mb-3">
                <label for="customer_name" class="form-label fw-semibold mb-0 pb-0">Nama Lengkap<span
                        class="text-danger">*</span></label>
                <small class="text-danger p-0 m-0 d-block"><i>*Nama harus sesuai KTP</i></small>
                <div class="input-group">
                    <input type="text" class="form-control <?php $__errorArgs = ['customer_name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                        id="customer_name" name="customer_name" required value="<?php echo e(old('customer_name')); ?>">
                </div>
                <?php $__errorArgs = ['customer_name'];
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
                <label for="address" class="form-label fw-semibold">Alamat Lengkap Domisili<span
                        class="text-danger">*</span></label>
                <div class="input-group">
                    <input type="text" class="form-control <?php $__errorArgs = ['address'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" id="address"
                        name="address" required value="<?php echo e(old('address')); ?>">
                </div>
                <?php $__errorArgs = ['address'];
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
                <label for="phone" class="form-label fw-semibold">Nomor Telepon Aktif<span
                        class="text-danger">*</span></label>
                <div class="input-group">
                    <span class="input-group-text" id="basic-addon1">+62</span>
                    <input type="text" class="form-control <?php $__errorArgs = ['phone'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" id="phone" name="phone"
                        placeholder="812xxxxxxxxx" required value="<?php echo e(old('phone')); ?>">
                </div>
                <?php $__errorArgs = ['phone'];
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
                <label for="guarantor_phone" class="form-label fw-semibold">Nomor Telepon Penjamin<span
                        class="text-danger">*</span></label>
                <div class="input-group">
                    <span class="input-group-text" id="basic-addon1">+62</span>
                    <input type="text" class="form-control <?php $__errorArgs = ['guarantor_phone'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                        placeholder="812xxxxxxxxx" id="guarantor_phone" name="guarantor_phone" required
                        value="<?php echo e(old('guarantor_phone')); ?>">
                </div>
                <?php $__errorArgs = ['guarantor_phone'];
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
                <label for="work" class="form-label fw-semibold">Pekerjaan<span class="text-danger">*</span></label>
                <div class="input-group">
                    <input type="text" class="form-control <?php $__errorArgs = ['work'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" id="work" name="work"
                        required value="<?php echo e(old('work')); ?>">
                </div>
                <?php $__errorArgs = ['work'];
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
                <label for="income" class="form-label fw-semibold">Penghasilan<span class="text-danger">*</span></label>
                <div class="input-group">
                    <input type="text" class="form-control <?php $__errorArgs = ['income'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" id="income"
                        name="income" required value="<?php echo e(old('income')); ?>">
                </div>
                <?php $__errorArgs = ['income'];
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
                <label class="form-label fw-semibold" for="month">Jangka Cash Tempo<span
                        class="text-danger">*</span></label>
                <div class="input-group">
                    <select class="form-select" id="month" name="month">
                        <option value="3">3 Bulan</option>
                        <option value="6">6 Bulan</option>
                    </select>
                </div>
            </div>
            <div class="mb-3">
                <label for="dp" class="form-label fw-semibold mb-0">Down Payment (DP)<span
                        class="text-danger">*</span></label>
                <small class="text-danger d-block mt-0 pt-0"><i>*DP harus 50% dari harga motor</i></small>
                <div class="input-group">
                    <input type="number" class="form-control <?php $__errorArgs = ['dp'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" id="dp" name="dp"
                        required value="<?php echo e(old('dp')); ?>">
                </div>
                <?php $__errorArgs = ['dp'];
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
                <label class="form-label fw-semibold" for="interest">Bunga (Per-Bulan)<span
                        class="text-danger">*</span></label>
                <div class="input-group">
                    <select class="form-select" id="interest" name="interest">
                        <option value="0.0">0%</option>
                        <option value="0.05">5%</option>
                        <option value="0.06">6%</option>
                        <option value="0.07">7%</option>
                        <option value="0.08">8%</option>
                        <option value="0.09">9%</option>
                        <option value="0.1">10%</option>
                    </select>
                </div>
            </div>
            <div class="mb-3">
                <label for="unit" class="form-label fw-semibold">Unit Pembelian<span
                        class="text-danger">*</span></label>
                <div class="input-group">
                    <input type="number" class="form-control <?php $__errorArgs = ['unit'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" id="unit" name="unit"
                        required value="<?php echo e(old('unit')); ?>">
                </div>
                <?php $__errorArgs = ['unit'];
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
                <label for="date_taken" class="form-label fw-semibold">Tanggal Pengambilan Unit<span
                        class="text-danger">*</span></label>
                <div class="input-group">
                    <input type="date" class="form-control <?php $__errorArgs = ['date_taken'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" id="date_taken"
                        name="date_taken" value="<?php echo e(old('date_taken')); ?>" required>
                </div>
                <?php $__errorArgs = ['date_taken'];
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

        <div class="d-grid gap-2 my-5">
            <button class="btn btn-primary" type="submit">Pengajuan</button>
        </div>
    </form>
</div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('dashboard.cashTempo', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\Skripsi\program\karunia-motor-eli\karuniaApp\resources\views/dashboard/options/formCashTempo.blade.php ENDPATH**/ ?>