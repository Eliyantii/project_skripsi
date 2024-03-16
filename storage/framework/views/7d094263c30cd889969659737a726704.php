<?php $__currentLoopData = $carts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cart): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
    <?php $totalHarga= 0; ?>
        <div id="cart_row_<?php echo e($cart->id); ?>">
        <?php $__currentLoopData = $cart->cartDetails; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cartDetail): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <?php $totalHarga += $cartDetail->product->price * $cartDetail->unit ?>
            <div class="row px-4 mt-3" id="cart_detail_<?php echo e($cartDetail->cart_id); ?><?php echo e($cartDetail->product_id); ?>">
                <div class="cart-data-container col border-end border-2">
                    <div class="row">
                        <div class="col-4 p-0">
                            <img src="/assets/users/products/<?php echo e($cartDetail->product->imageUser->thumbnail); ?>"
                                class="img-fluid rounded" style="width: 12rem">
                        </div>
                        <div class="col-8">
                            <p class="p-0 m-0 fw-bold fs-5"><?php echo e($cartDetail->product->brand); ?>

                                <?php echo e(ucwords($cartDetail->product->name)); ?></p>
                            <p class="p-0 m-0 fw-semibold"><span class="text-muted">Tahun</span>
                                <?php echo e($cartDetail->product->year); ?></p>
                            <p class="fw-semibold"><span class="text-muted">Transmisi</span>
                                <?php echo e($cartDetail->product->transmission); ?></p>
                            <p class="text-end fw-bold">Rp<?php echo e(number_format($cartDetail->product->price, 2, ',','.')); ?></p>
                        </div>
                    </div>
                </div>
                <div class="col">
                    <div class="d-flex justify-content-between mb-3">
                        <form action="/karuniamotor/cart/deleteProduct" method="POST">
                            <?php echo csrf_field(); ?>
                            <?php echo method_field('DELETE'); ?>
                            <input type="hidden" value="<?php echo e($cart->id); ?>" name="cartId">
                            <input type="hidden" value="<?php echo e($cartDetail->product_id); ?>" name="productId">
                            <button class="text-danger fw-semibold p-0 btn-ubah-profil" data-bs-toggle="modal"
                                data-bs-target="#ubahDataProfil">
                                <i class="bi bi-trash3"></i>
                            </button>
                        </form>
                        <p class="fw-bold fs-5 text-end pb-0 mb-0">Subtotal</p>
                    </div>
                    <div class="d-flex justify-content-end align-items-center">
                        <span for="unit" class="me-2 fw-semibold">Unit</span>
                        <input type="number" name="unit" id="unit" class="text-end rounded border border-1 border-dark"
                            value="<?php echo e($cartDetail->unit); ?>"
                            onchange="updateProductUnit('<?php echo e(csrf_token()); ?>', '<?php echo e($cart->id); ?>', '<?php echo e($cartDetail->product_id); ?>', this.value);">
                    </div>
                    <div class="d-flex justify-content-end">
                        <p class="fw-bold text-muted me-2">Subtotal</p>
                        <p class="text-end fw-bold text-danger"
                            id="product_subtotal_<?php echo e($cartDetail->cart_id); ?><?php echo e($cartDetail->product_id); ?>">
                            Rp<?php echo e(number_format($cartDetail->product->price * $cartDetail->unit, 2, ',','.')); ?></p>
                    </div>
                </div>
            </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        <div class="d-flex justify-content-end">
            <p class="fw-bold text-muted me-2">Total</p>
            <p class="text-end fw-bold text-danger" id="total_price_<?php echo e($cart->id); ?>">
                Rp<?php echo e(number_format($totalHarga, 2, ',','.')); ?></p>
        </div>
        <div class="d-flex justify-content-end">
            <form action="<?php echo e(route('deleteAllCart')); ?>" method="POST">
                <?php echo csrf_field(); ?>
                <?php echo method_field('DELETE'); ?>
                <input type="hidden" value="<?php echo e($cart->id); ?>" name="cartId">
                <button type="submit" class="btn btn-danger btn-sm me-2">Hapus</button>
            </form>
            <a href="/karuniamotor/checkout/<?php echo e($cart->id); ?>" class="btn btn-primary btn-sm">Checkout</a>
        </div>
    </div>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
<?php /**PATH D:\Skripsi\program\karunia-motor-eli\karuniaApp\resources\views/user/component/dataKeranjang.blade.php ENDPATH**/ ?>