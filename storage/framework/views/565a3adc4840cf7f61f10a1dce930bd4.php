<div class="sidebar border border-right col-md-3 col-lg-2 p-0 bg-danger">
    <div class="offcanvas-md offcanvas-end bg-danger" tabindex="-1" id="sidebarMenu" aria-labelledby="sidebarMenuLabel">
        <div class="offcanvas-header">
            <h5 class="offcanvas-md offcanvas-end bg-body-danger" tabindex="-1" id="sidebarMenu" aria-labelledby="sidebarMenuLabel">Karunia Motor</h5>
            <button type="button" class="btn-close" data-bs-dismiss="offcanvas" data-bs-target="#sidebarMenu" aria-label="Close"></button>
        </div>
        <div class="offcanvas-body d-md-flex flex-column p-0 pt-lg-3 overflow-y-auto" style="height: 100vh">
            <ul class="nav flex-column">
                <li class="nav-item">
                    <img src="/assets/users/profile/admin.jpg" class="img-fluid rounded-circle ms-3"
                        style="max-width: 8rem">
                </li>
                <li class="nav-item mt-3">
                    <a class="nav-link text-white fw-semibold <?php echo e(Request::is('karuniamotor/dashboard') ? 'shadow' : ''); ?>" aria-current="page" href="/karuniamotor/dashboard">
                        <i class="bi bi-house-door"></i>
                        Beranda
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-white fw-semibold <?php echo e(Request::is('karuniamotor/dashboard/supplier*') ? 'shadow' : ''); ?>" href="/karuniamotor/dashboard/supplier">
                        <i class="bi bi-box2"></i> Supplier
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-white fw-semibold <?php echo e(Request::is('karuniamotor/dashboard/product*') ? 'shadow' : ''); ?>" href="/karuniamotor/dashboard/product">
                        <i class="bi bi-boxes"></i> Produk
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-white fw-semibold <?php echo e(Request::is('karuniamotor/dashboard/transaction-list*') ? 'shadow' : ''); ?>" href="/karuniamotor/dashboard/transaction-list">
                        <i class="bi bi-arrow-left-right"></i> Transaksi
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-white fw-semibold <?php echo e(Request::is('karuniamotor/dashboard/cash-tempo*') ? 'shadow' : ''); ?>" href="/karuniamotor/dashboard/cash-tempo">
                        <i class="bi bi-credit-card"></i> Cash Tempo
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-white fw-semibold <?php echo e(Request::is('karuniamotor/dashboard/offer*') ? 'shadow' : ''); ?>" href="/karuniamotor/dashboard/offer">
                        <i class="bi bi-truck"></i> Penawaran
                    </a>
                </li>
            </ul>
            <hr class="my-2">

            <ul class="nav flex-column mb-2">
                <li class="nav-item">
                    <form action="/karuniamotor/logout" method="POST">
                        <?php echo csrf_field(); ?>
                        <button class="nav-link text-white fw-semibold" type="submit"><i class="bi bi-door-closed"></i>
                            Keluar
                        </button>
                    </form>
                </li>
            </ul>
        </div>
    </div>
</div>
<?php /**PATH D:\Development\karunia-motor-eli\karuniaApp\resources\views/dashboard/layouts/sidebar.blade.php ENDPATH**/ ?>