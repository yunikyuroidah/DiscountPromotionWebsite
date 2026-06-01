@extends('layouts.admin')

@section('title', 'Dashboard - PromoDiskon')
@section('page-title', 'Dashboard')
@section('page-desc', 'Ringkasan admin, barang, dan pengunjung.')

@section('content')
    <div class="stats-grid">
        <div class="stat-card">
            <span>Total Admin</span>
            <strong>{{ $adminCount }}</strong>
            <p>Jumlah akun admin aktif.</p>
        </div>
        <div class="stat-card">
            <span>Total Barang</span>
            <strong>{{ $productCount }}</strong>
            <p>Produk yang terdaftar di promo.</p>
        </div>
        <div class="stat-card">
            <span>Pengunjung Bulan Ini</span>
            <strong>{{ $visitorCount }}</strong>
            <p>Pengunjung yang tercatat di bulan terpilih.</p>
        </div>
    </div>

    <div class="card chart-card">
        <div class="chart-header">
            <div>
                <h3>Grafik Pengunjung</h3>
                <p>Sumbu X menampilkan tanggal 1, 15, dan akhir bulan.</p>
            </div>
            <form method="get" action="{{ route('admin.dashboard') }}">
                <select name="month" onchange="this.form.submit()">
                    @foreach ($monthOptions as $option)
                        <option value="{{ $option['value'] }}" {{ $selectedMonth === $option['value'] ? 'selected' : '' }}>
                            {{ $option['label'] }}
                        </option>
                    @endforeach
                </select>
            </form>
        </div>
        <div class="chart-body">
            <canvas id="visitorChart" height="120"></canvas>
        </div>
    </div>
@endsection

@push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        const chartEl = document.getElementById('visitorChart');
        if (chartEl) {
            const ctx = chartEl.getContext('2d');
            new Chart(ctx, {
                type: 'line',
                data: {
                    labels: @json($chartLabels),
                    datasets: [{
                        label: 'Pengunjung',
                        data: @json($chartData),
                        borderColor: '#2f5ff7',
                        backgroundColor: 'rgba(47, 95, 247, 0.12)',
                        fill: true,
                        tension: 0.4,
                        pointRadius: 4,
                        pointBackgroundColor: '#2f5ff7'
                    }]
                },
                options: {
                    plugins: {
                        legend: { display: false }
                    },
                    scales: {
                        x: {
                            grid: { display: false }
                        },
                        y: {
                            beginAtZero: true,
                            ticks: { precision: 0 }
                        }
                    }
                }
            });
        }
    </script>
@endpush
