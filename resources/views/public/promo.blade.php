@extends('layouts.public')

@section('title', 'Promosi - PromoDiskon')

@section('content')
    @php
        $formatRupiah = fn ($value) => 'Rp ' . number_format($value, 0, ',', '.');
    @endphp

    <section class="promo-hero">
        <div class="container">
            <span class="section-eyebrow">Promosi</span>
            <h1>Semua promo elektronik dalam satu halaman.</h1>
            <p>Filter berdasarkan kategori atau diskon aktif untuk menemukan penawaran terbaik.</p>

            <form class="filter-bar" method="get" action="{{ route('promo') }}">
                <input type="text" name="q" placeholder="Cari nama atau brand" value="{{ request('q') }}">
                <select name="category">
                    <option value="">Semua Kategori</option>
                    @foreach ($categories as $category)
                        <option value="{{ $category }}" {{ request('category') === $category ? 'selected' : '' }}>{{ $category }}</option>
                    @endforeach
                </select>
                <select name="discount">
                    <option value="">Semua Diskon</option>
                    <option value="aktif" {{ request('discount') === 'aktif' ? 'selected' : '' }}>Diskon Aktif</option>
                </select>
                <button class="btn btn-primary" type="submit">Terapkan</button>
            </form>
        </div>
    </section>

    <section class="section">
        <div class="container">
            <div class="product-grid">
                @forelse ($products as $product)
                    <article class="product-card reveal" style="--delay: 0.08s">
                        <div class="product-media">
                            <img src="{{ route('product.image', $product) }}" alt="{{ $product->name }}">
                            @if ($product->is_discount_active)
                                <span class="badge badge-floating">-{{ $product->discount_percent }}%</span>
                            @endif
                        </div>
                        <div class="product-body">
                            <span class="product-brand">{{ $product->brand }}</span>
                            <h3>{{ $product->name }}</h3>
                            <p class="muted">{{ $product->weight_grams }} g | {{ $product->category ?? 'Elektronik' }}</p>
                            <div class="price-row">
                                @if ($product->is_discount_active)
                                    <span class="price-old">{{ $formatRupiah($product->price) }}</span>
                                @endif
                                <span class="price">{{ $formatRupiah($product->discounted_price) }}</span>
                            </div>
                            <div class="promo-meta">
                                <span>Masa berlaku:</span>
                                <strong>{{ $product->discount_valid_until ? $product->discount_valid_until->format('d-m-Y') : '-' }}</strong>
                            </div>
                        </div>
                    </article>
                @empty
                    <div class="empty-state">
                        <h3>Produk tidak ditemukan</h3>
                        <p>Coba ubah filter atau kata kunci pencarian.</p>
                    </div>
                @endforelse
            </div>

            <div class="pagination-wrapper">
                @include('partials.pagination', ['paginator' => $products])
            </div>
        </div>
    </section>
@endsection
