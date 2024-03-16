<header class="navbar sticky-top flex-md-nowrap p-0 shadow bg-danger" data-bs-theme="dark">
    <a class="navbar-brand col-md-3 col-lg-2 me-0 px-3 fs-6 text-white" href="#">Karunia Motor</a>
    <ul class="navbar-nav flex-row d-md-none">
        <li class="nav-item text-nowrap">
            <button class="nav-link px-3 text-white" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarSearch" aria-controls="navbarSearch" aria-expanded="false"
                aria-label="Toggle search"><svg class="bi"><use xlink:href="#search" /></svg>
            </button>
        </li>
        <li class="nav-item text-nowrap">
            <button class="nav-link px-3 text-white" type="button" data-bs-toggle="offcanvas"
                data-bs-target="#sidebarMenu" aria-controls="sidebarMenu" aria-expanded="false"
                aria-label="Toggle navigation">
                <svg class="bi"><use xlink:href="#list" /></svg>
            </button>
        </li>
    </ul>
    <div id="navbarSearch" class="navbar-search w-100 collapse">
        <?php if(Request::is('karuniamotor/dashboard/supplier*')): ?>
            <input class="form-control w-100 rounded-0 border-0 bg-danger" type="search" name="keyword" placeholder="Search" aria-label="Search" onkeyup="manageDashboardSearch(this.value);">
        <?php else: ?>
            <input class="form-control w-100 rounded-0 border-0 bg-danger" type="search" placeholder="Search" aria-label="Search" disabled>
        <?php endif; ?>
    </div>
</header>
<?php /**PATH D:\Skripsi\program\karunia-motor-eli\karuniaApp\resources\views/dashboard/layouts/header.blade.php ENDPATH**/ ?>