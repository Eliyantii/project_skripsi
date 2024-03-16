

<?php $__env->startSection('js'); ?>
    <script src="/js/chart.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chartjs-adapter-date-fns/dist/chartjs-adapter-date-fns.bundle.min.js"></script> 
<?php $__env->stopSection(); ?>

<?php $__env->startSection('main'); ?>
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">Selamat Datang <?php echo e(auth()->user()->name); ?></h1>
</div>

<?php if($transactions->isNotEmpty()): ?>
    <div class="sales-graph row card mb-4 mb-md-5 mx-auto">
        <p class="fw-bold p-3 card-title text-center text-danger">GRAFIK PENJUALAN TAHUN <span id="year" name="year"><?php echo e(date('Y')); ?></span></p>
        <div class="d-flex justify-content-start align-items-start flex-column px-3">
            <div class="">
                <p class="mb-2 fw-bold">Pilih Tahun</p>
            </div>
            <select class="text-center px-5 py-1 border-1 rounded overflow-auto" name="yearpicker" id="yearpicker" onchange="handleFilter(salesChart)">
            </select>
        </div>
        <div class="col card-body" style="height: 50vh">
            <canvas id="sales-chart">
            </canvas>
        </div>
    </div>

    <div class="row">
        <h5 class="fw-bold mb-3">Daftar Transaksi Terbaru</h5>
        <div class="col table-responsive">
            <table class="table table-sm table-bordered table-hover shadow-sm text-center">
                <thead class="bg-primary text-white">
                    <tr class="align-middle">
                        <th scope="col">Nomor Transaksi</th>
                        <th scope="col">Tanggal Transaksi</th>
                        <th scope="col">Status</th>
                        <th scope="col">Status Konfirmasi</th>
                        <th scope="col">Total Pemasukan</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $__currentLoopData = $transactions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $transaction): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr style="cursor: pointer" class="align-middle" onclick="showSalesTransactionDetailPopUp('<?php echo e($transaction->id); ?>');">
                            <td><?php echo e($transaction->id); ?></td>
                            <td><?php echo e(date('d/m/Y h:i', strtotime($transaction->transaction_date))); ?></td>
                            <td><?php echo e($transaction->status); ?></td>
                            <td><?php echo e($transaction->owner_response); ?></td>
                            <?php if($transaction->status == 'Dibatalkan' || $transaction->owner_response == "Ditolak"): ?>
                                <td class="text-muted fw-semibold">
                                    + Rp0
                                </td>
                            <?php else: ?>
                                <td class="fw-semibold text-success">
                                    +
                                    Rp<?php echo e(number_format($transaction->gross_amount - $transaction->application_fee, 0, ',', '.')); ?>

                                </td>
                            <?php endif; ?>
                        </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </tbody>
            </table>
        </div>
    </div>
<?php else: ?>
    
    <div class="row d-flex justify-content-center align-items-center">
        <div class="col text-center">
            <div class="mt-5">
                <h4>Belum ada transaksi <span class="text-danger">&#128517;</span></h4>
            </div>
        </div>
        <div class="col">
            <img src="/assets/data_kosong.jpg" class="img-fluid">
        </div>
    </div>
<?php endif; ?>


<script type="text/javascript">
    var salesChart;
    var transactions = <?php echo e(Js::from($data)); ?>;
    var labels = <?php echo e(Js::from($labels)); ?>;
    var months = [];

    labels.forEach(function(label) {
        const date = new Date();
        date.setMonth(label-1);

        const month = date.toLocaleString('id-ID', { month: 'long' });
        months.push(month);
    });

    const max = transactions.reduce((a, b) => Math.max(a, b), -Infinity);

    const data = {
        labels: months,
        datasets: [{
            label: 'Total Transaksi Per-Bulan',
            backgroundColor: 'rgb(245,5,5)',
            borderColor: 'rgb(245,5,5)',
            data: transactions,
        }]
    };

    const config = {
        type: 'bar',
        data: data,
        options: {
            responsive: true,
            maintainAspectRatio: false,
            animations: {
                tension: {
                    duration: 5000,
                    easing: 'linear',
                    from: 1,
                    to: 0,
                    loop: true
                }
            },
            scales: {
                y: {
                    type: 'linear',
                    min: 0,
                    max: max * 10,
                    beginAtZero: true
                }
            }
        }
    };

    salesChart = new Chart(
        document.getElementById('sales-chart').getContext('2d'),
        config
    );
</script> 
<?php $__env->stopSection(); ?>

<?php echo $__env->make('dashboard.layouts.main', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\Development\karunia-motor-eli\karuniaApp\resources\views/dashboard/dashboardAdmin.blade.php ENDPATH**/ ?>