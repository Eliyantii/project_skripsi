<nav class="navbar navbar-expand-lg">
    <div class="container-fluid mx-3">
        <a class="navbar-brand text-white fw-bold" href="/">Karunia Motor</a>

        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
            aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarNav">
            {{-- Responsive side bar untuk ukuran mobile --}}
            <div class="d-lg-none">
                <form class="d-flex my-3" role="search" action="/">
                    @csrf
                    <input class="form-control me-2" type="search" name="search" placeholder="Cari motor..."
                        aria-label="Search" value="{{ request('search') }}">
                    <button class="btn btn-outline-light" type="submit">Cari</button>
                </form>
                <ul class="list-group list-group-flush my-3">
                    <li class="list-group-item fw-bold rounded"><i class="bi bi-person-check"></i>
                        {{ Auth::user()->name }}</li>
                    <li class="list-group-item rounded">
                        <a class="dropdown-item btn" href="/karuniamotor/profile/transaction/snap"><i
                                class="bi bi-person-circle"></i> Profil</a>
                    </li>
                    <li class="list-group-item rounded">
                        <a class="dropdown-item btn" href="/karuniamotor/cart"><i class="bi bi-cart2"></i> Keranjang</a>
                    </li>
                    <li class="list-group-item rounded">
                        <a class="dropdown-item btn" href="/karuniamotor/profile/offer"><i class="bi bi-box2"></i>
                            Penawaran</a>
                    </li>
                    <li class="list-group-item rounded">
                        <button type="button" class="btn dropdown-item position-relative" data-bs-toggle="modal"
                            data-bs-target="#modalPesan">
                            <i class="bi bi-envelope"></i> Pesan
                            <span
                                class="position-absolute top-50 start-100 translate-middle badge rounded-pill bg-danger">{{ ($countNotif > 99) ? '99+' : $countNotif }}</span>
                        </button>
                    </li>
                    <li class="list-group-item rounded">
                        <form action="/karuniamotor/logout" method="POST">
                            @csrf
                            <button class="dropdown-item" type="submit"><i class="bi bi-box-arrow-left"></i>
                                Keluar
                            </button>
                        </form>
                    </li>
                </ul>
            </div>

            {{-- Normal Screen --}}
            <form class="d-none d-lg-flex col-lg-6 ms-lg-auto" role="search" action="/">
                @csrf
                <input class="form-control me-2" type="search" name="search" placeholder="Cari motor..." aria-label="Search" value="{{ request('search') }}">
                <button class="btn btn-outline-light" type="submit">Cari</button>
            </form>
            <div class="btn-group dropstart d-none d-lg-block ms-lg-auto">
                <button type="button" class="btn bg-light dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                    {{ Auth::user()->name }}
                </button>
                <ul class="dropdown-menu">
                    <li class="border-bottom border-1"><a class="dropdown-item btn"
                            href="/karuniamotor/profile/transaction/snap"><i class="bi bi-person-circle"></i> Profil</a>
                    </li>
                    <li class="border-bottom border-1"><a class="dropdown-item btn" href="/karuniamotor/cart"><i
                                class="bi bi-cart2"></i> Keranjang</a></li>
                    <li class="border-bottom border-1"><a class="dropdown-item btn"
                            href="/karuniamotor/profile/offer"><i class="bi bi-box2"></i> Penawaran</a></li>
                    <li class="border-bottom border-1">
                        <button type="button" class="btn dropdown-item position-relative" data-bs-toggle="modal"
                            data-bs-target="#modalPesan">
                            <i class="bi bi-envelope"></i> Pesan
                            <span
                                class="position-absolute top-50 start-100 translate-middle badge rounded-pill bg-danger">{{ ($countNotif > 99) ? '99+' : $countNotif }}</span>
                        </button>
                    </li>
                    <li class="">
                        <form action="/karuniamotor/logout" method="POST">
                            @csrf
                            <button class="dropdown-item" type="submit"><i class="bi bi-box-arrow-left"></i>
                                Keluar</button>
                        </form>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</nav>
