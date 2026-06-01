@extends('layouts.public')

@section('title', 'Beranda - PromoDiskon')

@section('content')
    @php
        $formatRupiah = fn ($value) => 'Rp ' . number_format($value, 0, ',', '.');
        $heroEndsAt = $heroProduct?->discount_valid_until;
    @endphp

    <section class="hero container">
        <div class="hero-copy reveal" style="--delay: 0.05s">
            <span class="pill">Promo elektronik pilihan</span>
            <h1>Diskon gadget favorit dengan tampilan rapi dan profesional.</h1>
            <p>Temukan promo terbaru untuk perangkat audio, wearable, dan aksesoris elektronik. Semua informasi dibuat jelas seperti brosur diskon versi digital.</p>
            <div class="hero-actions">
                <a class="btn btn-primary" href="{{ route('promo') }}">Lihat Promo</a>
                <a class="btn btn-ghost" href="#produk-terbaru">Produk Terbaru</a>
            </div>
            <div class="hero-stats">
                <div class="stat">
                    <div class="stat-value">{{ $featuredProducts->count() }}</div>
                    <div class="stat-label">Promo Unggulan</div>
                </div>
                <div class="stat">
                    <div class="stat-value">{{ $latestProducts->count() }}</div>
                    <div class="stat-label">Produk Baru</div>
                </div>
                <div class="stat">
                    <div class="stat-value">30+</div>
                    <div class="stat-label">Brand Terpercaya</div>
                </div>
            </div>
        </div>
        <div class="hero-card reveal" style="--delay: 0.15s">
            @if ($heroProduct)
                <div class="hero-card-head">
                    <span class="badge">Diskon {{ $heroProduct->discount_percent }}%</span>
                    <span class="muted">Berlaku sampai {{ $heroEndsAt ? $heroEndsAt->format('d-m-Y') : '-' }}</span>
                </div>
                <div class="hero-product-image">
                    <img src="{{ route('product.image', $heroProduct) }}" alt="{{ $heroProduct->name }}" class="float">
                </div>
                <div class="hero-card-body">
                    <h3>{{ $heroProduct->name }}</h3>
                    <p class="muted">{{ $heroProduct->brand }} | {{ $heroProduct->category ?? 'Elektronik' }}</p>
                    <div class="price-row">
                        @if ($heroProduct->is_discount_active)
                            <span class="price-old">{{ $formatRupiah($heroProduct->price) }}</span>
                        @endif
                        <span class="price">{{ $formatRupiah($heroProduct->discounted_price) }}</span>
                    </div>
                </div>
            @else
                <div class="hero-card-body">
                    <h3>Produk unggulan segera hadir</h3>
                    <p class="muted">Tambahkan produk di panel admin untuk menampilkan promo di sini.</p>
                    <a class="btn btn-primary" href="{{ route('admin.login') }}">Masuk Admin</a>
                </div>
            @endif
        </div>
    </section>

    <section class="section">
        <div class="container">
            <div class="section-header">
                <div>
                    <span class="section-eyebrow">Kategori</span>
                    <h2>Jelajahi berdasarkan kategori</h2>
                </div>
            </div>
            <div class="category-grid">
                @forelse ($categories as $category)
                    <a
                        class="category-card tone-{{ ($loop->index % 5) + 1 }} reveal"
                        style="--delay: 0.1s"
                        href="{{ route('promo', ['category' => $category]) }}"
                    >
                        <span>{{ $category }}</span>
                        <small>Lihat promo</small>
                    </a>
                @empty
                    @php
                        $fallbackCategories = ['Audio', 'Wearable', 'Power', 'Aksesori', 'Kitchen'];
                    @endphp
                    @foreach ($fallbackCategories as $fallback)
                        <a class="category-card tone-{{ ($loop->index % 5) + 1 }}" href="{{ route('promo', ['category' => $fallback]) }}">
                            <span>{{ $fallback }}</span>
                            <small>Lihat promo</small>
                        </a>
                    @endforeach
                @endforelse
            </div>
        </div>
    </section>

    <section class="section">
        <div class="container">
            <div class="section-header">
                <div>
                    <span class="section-eyebrow">Promo Unggulan</span>
                    <h2>Diskon terbaik minggu ini</h2>
                </div>
                <a class="btn btn-ghost" href="{{ route('promo') }}">Semua Promo</a>
            </div>
            <div class="product-grid">
                @foreach ($featuredProducts as $product)
                    <article class="product-card reveal" style="--delay: 0.1s">
                        <div class="product-media">
                            <img src="{{ route('product.image', $product) }}" alt="{{ $product->name }}">
                            @if ($product->is_discount_active)
                                <span class="badge badge-floating">-{{ $product->discount_percent }}%</span>
                            @endif
                        </div>
                        <div class="product-body">
                            <span class="product-brand">{{ $product->brand }}</span>
                            <h3>{{ $product->name }}</h3>
                            <p class="muted">{{ $product->category ?? 'Elektronik' }}</p>
                            <div class="price-row">
                                @if ($product->is_discount_active)
                                    <span class="price-old">{{ $formatRupiah($product->price) }}</span>
                                @endif
                                <span class="price">{{ $formatRupiah($product->discounted_price) }}</span>
                            </div>
                        </div>
                    </article>
                @endforeach
            </div>
        </div>
    </section>

    <section class="section">
        <div class="container">
            <div class="promo-banner reveal" style="--delay: 0.05s">
                <div>
                    <span class="section-eyebrow">Promo Spesial</span>
                    <h2>Upgrade pengalaman musik dan produktivitas.</h2>
                    <p>Dapatkan diskon ekstra untuk produk pilihan minggu ini.</p>
                </div>
                <div class="promo-banner-action">
                    <a class="btn btn-primary" href="{{ route('promo') }}">Cek Promo</a>
                </div>
            </div>
        </div>
    </section>

    <section class="section" id="produk-terbaru">
        <div class="container">
            <div class="section-header">
                <div>
                    <span class="section-eyebrow">Produk Terbaru</span>
                    <h2>Rekomendasi untukmu</h2>
                </div>
                <a class="btn btn-ghost" href="{{ route('promo') }}">Lihat Semua</a>
            </div>
            <div class="product-grid">
                @foreach ($latestProducts as $product)
                    <article class="product-card reveal" style="--delay: 0.1s">
                        <div class="product-media">
                            <img src="{{ route('product.image', $product) }}" alt="{{ $product->name }}">
                            @if ($product->is_discount_active)
                                <span class="badge badge-floating">-{{ $product->discount_percent }}%</span>
                            @endif
                        </div>
                        <div class="product-body">
                            <span class="product-brand">{{ $product->brand }}</span>
                            <h3>{{ $product->name }}</h3>
                            <p class="muted">{{ $product->category ?? 'Elektronik' }}</p>
                            <div class="price-row">
                                @if ($product->is_discount_active)
                                    <span class="price-old">{{ $formatRupiah($product->price) }}</span>
                                @endif
                                <span class="price">{{ $formatRupiah($product->discounted_price) }}</span>
                            </div>
                        </div>
                    </article>
                @endforeach
            </div>
        </div>
    </section>
@endsection
