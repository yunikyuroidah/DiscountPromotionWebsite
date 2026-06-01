@extends('layouts.admin')

@section('title', 'Data Barang - PromoDiskon')
@section('page-title', 'Data Barang')
@section('page-desc', 'Kelola data promo dan informasi produk.')

@section('content')
    @php
        $formatRupiah = fn ($value) => 'Rp ' . number_format($value, 0, ',', '.');
    @endphp

    @if (session('success'))
        <div class="alert success">{{ session('success') }}</div>
    @endif

    <div class="toolbar">
        <form class="filter-bar" method="get" action="{{ route('admin.products.index') }}">
            <input type="text" name="q" placeholder="Cari nama, brand, kategori" value="{{ request('q') }}">
            <select name="category">
                <option value="">Semua Kategori</option>
                @foreach ($categories as $category)
                    <option value="{{ $category }}" {{ request('category') === $category ? 'selected' : '' }}>{{ $category }}</option>
                @endforeach
            </select>
            <select name="discount">
                <option value="">Semua Diskon</option>
                <option value="aktif" {{ request('discount') === 'aktif' ? 'selected' : '' }}>Diskon Aktif</option>
                <option value="habis" {{ request('discount') === 'habis' ? 'selected' : '' }}>Diskon Habis</option>
            </select>
            <input type="number" name="min_price" placeholder="Harga min" value="{{ request('min_price') }}">
            <input type="number" name="max_price" placeholder="Harga max" value="{{ request('max_price') }}">
            <button class="btn btn-primary" type="submit">Filter</button>
        </form>
        <a class="btn btn-primary" href="{{ route('admin.products.create') }}">Tambah Barang</a>
    </div>

    <div class="table-card">
        <table class="table">
            <thead>
                <tr>
                    <th>Produk</th>
                    <th>Brand</th>
                    <th>Berat</th>
                    <th>Harga</th>
                    <th>Diskon (%)</th>
                    <th>Masa Diskon</th>
                    <th>Harga Setelah Diskon</th>
                    <th>Status</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($products as $product)
                    <tr>
                        <td>
                            <div class="table-product">
                                <img src="{{ route('product.image', $product) }}" alt="{{ $product->name }}">
                                <div>
                                    <div class="table-product-name">{{ $product->name }}</div>
                                    <div class="muted">{{ $product->category ?? 'Elektronik' }}</div>
                                </div>
                            </div>
                        </td>
                        <td>{{ $product->brand }}</td>
                        <td>{{ $product->weight_grams }} g</td>
                        <td>{{ $formatRupiah($product->price) }}</td>
                        <td>{{ $product->discount_percent }}%</td>
                        <td>{{ $product->discount_valid_until ? $product->discount_valid_until->format('d-m-Y') : '-' }}</td>
                        <td>
                            @if ($product->is_discount_active)
                                <span class="price-old">{{ $formatRupiah($product->price) }}</span>
                            @endif
                            <span class="price">{{ $formatRupiah($product->discounted_price) }}</span>
                        </td>
                        <td>
                            <span class="status {{ $product->is_active ? 'status-active' : 'status-inactive' }}">
                                {{ $product->is_active ? 'Aktif' : 'Nonaktif' }}
                            </span>
                        </td>
                        <td>
                            <div class="table-actions">
                                <a class="btn btn-ghost" href="{{ route('admin.products.edit', $product) }}">Edit</a>
                                <form method="post" action="{{ route('admin.products.destroy', $product) }}" onsubmit="return confirm('Hapus produk ini?')">
                                    @csrf
                                    @method('delete')
                                    <button type="submit" class="btn btn-danger">Hapus</button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="9">
                            <div class="empty-state">
                                <h3>Belum ada produk</h3>
                                <p>Tambahkan produk untuk mulai menampilkan promo.</p>
                            </div>
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="pagination-wrapper">
        @include('partials.pagination', ['paginator' => $products])
    </div>
@endsection
