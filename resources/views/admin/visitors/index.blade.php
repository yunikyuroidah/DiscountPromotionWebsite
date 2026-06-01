@extends('layouts.admin')

@section('title', 'Riwayat Pengunjung - PromoDiskon')
@section('page-title', 'Riwayat Pengunjung')
@section('page-desc', 'Pantau pengunjung yang membuka halaman promosi.')

@section('content')
    <form class="filter-bar" method="get" action="{{ route('admin.visitors.index') }}">
        <input type="text" name="path" placeholder="Filter path" value="{{ request('path') }}">
        <input type="date" name="date" value="{{ request('date') }}">
        <button class="btn btn-primary" type="submit">Terapkan</button>
    </form>

    <div class="table-card">
        <table class="table">
            <thead>
                <tr>
                    <th>Waktu</th>
                    <th>Path</th>
                    <th>IP</th>
                    <th>User Agent</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($logs as $log)
                    <tr>
                        <td>{{ $log->visited_at->format('d-m-Y H:i') }}</td>
                        <td>{{ $log->path }}</td>
                        <td>{{ $log->ip_address }}</td>
                        <td class="muted">{{ $log->user_agent }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4">
                            <div class="empty-state">
                                <h3>Belum ada data pengunjung</h3>
                                <p>Data akan muncul setelah halaman publik dikunjungi.</p>
                            </div>
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="pagination-wrapper">
        @include('partials.pagination', ['paginator' => $logs])
    </div>
@endsection
