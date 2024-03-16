<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Karunia Motor</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
  </head>
  <body>
    <div class="p-3 border border-3 border-dark bg-white m-1">
        <header class="text-end border-bottom border-dark border-1">
            <p class="fs-4 fw-bold text-danger p-0 mb-0">KARUNIA MOTOR</p>
            <p class="fw-semibold p-0 mt-0 mb-0">Jl. Aji Melayu No. 19-20, Sintang</p>
            <p class="fw-semibold p-0 mt-0"><span class="text-muted">Telp:</span> (0565) 21103</p>
        </header>
        <div class="mt-3 ps-2">
            <h3 class="text-center mb-4">Bukti Pembelian Motor</h3>
            <div class="mb-3">
                <h4 class="text-danger">Identitas Pemilik</h4>
                <div class="ps-2">
                    <div class="d-flex justify-content-between">
                        <div>
                            <p class="fw-semibold text-muted">Nama</p>
                        </div>
                        <div class="text-start">
                            <p class="fw-semibold"><?php echo e(ucwords($user->name)); ?></p>
                        </div>
                    </div>
                    <div class="d-flex justify-content-between">
                        <div>
                            <p class="fw-semibold text-muted">Alamat</p>
                        </div>
                        <div class="text-start">
                            <p class="fw-semibold"><?php echo e(ucwords($user->address)); ?></p>
                        </div>
                    </div>
                    <div class="d-flex justify-content-between">
                        <div>
                            <p class="fw-semibold text-muted">Email</p>
                        </div>
                        <div class="text-start">
                            <p class="fw-semibold"><?php echo e($user->email); ?></p>
                        </div>
                    </div>
                    <div class="d-flex justify-content-between">
                        <div>
                            <p class="fw-semibold text-muted">Nomor Telepon</p>
                        </div>
                        <div class="text-start">
                            <p class="fw-semibold"><?php echo e($user->phone); ?></p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="mb-3">
                <h4 class="text-danger">Identitas Kendaraan</h4>
                <div class="ps-2">
                    <div class="d-flex justify-content-between">
                        <div>
                            <p class="fw-semibold text-muted">Merek</p>
                        </div>
                        <div class="text-start">
                            <p class="fw-semibold"><?php echo e(ucwords($historyProduct->brand)); ?></p>
                        </div>
                    </div>
                    <div class="d-flex justify-content-between">
                        <div>
                            <p class="fw-semibold text-muted">Nama</p>
                        </div>
                        <div class="text-start">
                            <p class="fw-semibold"><?php echo e(ucwords($historyProduct->name)); ?></p>
                        </div>
                    </div>
                    <div class="d-flex justify-content-between">
                        <div>
                            <p class="fw-semibold text-muted">Tahun</p>
                        </div>
                        <div class="text-start">
                            <p class="fw-semibold"><?php echo e($historyProduct->year); ?></p>
                        </div>
                    </div>
                    <div class="d-flex justify-content-between">
                        <div>
                            <p class="fw-semibold text-muted">No. Rangka</p>
                        </div>
                        <div class="text-start">
                            <p class="fw-semibold"><?php echo e(strtoupper($historyProduct->frame_number)); ?></p>
                        </div>
                    </div>
                    <div class="d-flex justify-content-between">
                        <div>
                            <p class="fw-semibold text-muted">No. Mesin</p>
                        </div>
                        <div class="text-start">
                            <p class="fw-semibold"><?php echo e(strtoupper($historyProduct->machine_number)); ?></p>
                        </div>
                    </div>
                    <div class="d-flex justify-content-between">
                        <div>
                            <p class="fw-semibold text-muted">Harga</p>
                        </div>
                        <div class="text-start">
                            <p class="fw-semibold">Rp<?php echo e(number_format($historyProduct->price, 2, ',','.')); ?></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <footer class="border-top border-1 border-dark mt-3">
            <div class="d-flex mt-3">
                <div>
                    <p class="fw-bold">Perhatian : </p>
                </div>
                <div>
                    <ul>
                        <li>Bukti pembelian ini adalah bukti yang sah.</li>
                        <li>Segala jenis bukti pembelian selain bukti ini dianggap tidak sah.</li>
                        <li>Tunjukan bukti pembelian ini untuk pengambilan motor pada Showroom.</li>
                    </ul>
                </div>
            </div>
        </footer>
    </div>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>

    <script type="text/javascript">
        window.print();
    </script>
  </body>
</html><?php /**PATH D:\Skripsi\program\karunia-motor-eli\karuniaApp\resources\views/user/options/faktur.blade.php ENDPATH**/ ?>