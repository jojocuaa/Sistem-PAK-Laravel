@extends('admin.dashboard')

@section('admin')
<div class="page-content">

    {{-- HEADER --}}
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h4 class="mb-1">👋 Selamat Datang</h4>
            <p class="text-muted">Dashboard Sistem Penilaian Angka Kredit</p>
        </div>
    </div>

    {{-- STAT CARD MANUAL --}}
    <div class="row">

        <div class="col-md-3 mb-3">
            <div class="card shadow-sm">
                <div class="card-body">
                    <h6 class="text-muted">Total Pegawai</h6>
                    <h3 class="fw-bold">128</h3>
                </div>
            </div>
        </div>

        <div class="col-md-3 mb-3">
            <div class="card shadow-sm">
                <div class="card-body">
                    <h6 class="text-muted">Pengajuan PAK</h6>
                    <h3 class="fw-bold">54</h3>
                </div>
            </div>
        </div>

        <div class="col-md-3 mb-3">
            <div class="card shadow-sm">
                <div class="card-body">
                    <h6 class="text-muted">Disetujui</h6>
                    <h3 class="fw-bold text-success">32</h3>
                </div>
            </div>
        </div>

        <div class="col-md-3 mb-3">
            <div class="card shadow-sm">
                <div class="card-body">
                    <h6 class="text-muted">Ditolak</h6>
                    <h3 class="fw-bold text-danger">22</h3>
                </div>
            </div>
        </div>

    </div>

    {{-- CHART MANUAL --}}
    <div class="row mt-3">

        <div class="col-md-8">
            <div class="card shadow-sm">
                <div class="card-body">
                    <h6 class="card-title">Statistik Pengajuan (Manual)</h6>
                    <canvas id="chartPengajuan"></canvas>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card shadow-sm">
                <div class="card-body">
                    <h6 class="card-title">Distribusi Status</h6>
                    <canvas id="chartStatus"></canvas>
                </div>
            </div>
        </div>

    </div>

</div>

{{-- Chart.js --}}
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
document.addEventListener("DOMContentLoaded", function () {

    // LINE CHART (MANUAL)
    new Chart(document.getElementById('chartPengajuan'), {
        type: 'line',
        data: {
            labels: ['Jan','Feb','Mar','Apr','Mei','Jun'],
            datasets: [{
                label: 'Jumlah Pengajuan',
                data: [5, 9, 7, 12, 8, 13],
                borderWidth: 2,
                tension: 0.4
            }]
        }
    });

    // DOUGHNUT CHART (MANUAL)
    new Chart(document.getElementById('chartStatus'), {
        type: 'doughnut',
        data: {
            labels: ['Disetujui', 'Ditolak'],
            datasets: [{
                data: [32, 22]
            }]
        }
    });

});
</script>
@endsection
