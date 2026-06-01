@extends('layouts.admin')

@section('title', 'Tambah Barang - PromoDiskon')
@section('page-title', 'Tambah Barang')
@section('page-desc', 'Masukkan data produk untuk promo.')

@section('content')
    @if ($errors->any())
        <div class="alert danger">
            <strong>Periksa kembali input Anda.</strong>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form method="post" action="{{ route('admin.products.store') }}" class="form-card" enctype="multipart/form-data">
        @csrf
        <div class="form-grid">
            <div class="form-group">
                <label for="name">Nama Produk</label>
                <input id="name" type="text" name="name" value="{{ old('name') }}" required>
            </div>
            <div class="form-group">
                <label for="brand">Brand</label>
                <input id="brand" type="text" name="brand" value="{{ old('brand') }}" required>
            </div>
            <div class="form-group">
                <label for="category">Kategori</label>
                <input id="category" type="text" name="category" value="{{ old('category') }}" placeholder="Audio, Wearable, Power">
            </div>
            <div class="form-group">
                <label for="weight_grams">Berat (gram)</label>
                <input id="weight_grams" type="number" name="weight_grams" value="{{ old('weight_grams') }}" required>
            </div>
            <div class="form-group">
                <label for="price">Harga</label>
                <input id="price" type="number" name="price" value="{{ old('price') }}" required>
            </div>
            <div class="form-group">
                <label for="discount_percent">Persentase Diskon</label>
                <input id="discount_percent" type="number" name="discount_percent" value="{{ old('discount_percent', 0) }}" min="0" max="90">
            </div>
            <div class="form-group">
                <label for="discount_valid_until">Masa Berlaku Diskon</label>
                <input id="discount_valid_until" type="date" name="discount_valid_until" value="{{ old('discount_valid_until') }}">
            </div>
            <div class="form-group form-group-full">
                <label>Gambar Produk</label>
                <div class="dropzone" id="dropzone">
                    <input id="image" type="file" name="image" accept="image/*" class="dropzone-input">
                    <div class="dropzone-body" id="dropzone-body">
                        <div class="dropzone-icon">
                            <svg width="36" height="36" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"/><polyline points="17 8 12 3 7 8"/><line x1="12" y1="3" x2="12" y2="15"/></svg>
                        </div>
                        <p class="dropzone-title">Tarik & letakkan gambar di sini</p>
                        <p class="dropzone-hint">atau <span class="dropzone-browse">klik untuk memilih file</span></p>
                        <p class="dropzone-formats">JPG, PNG, WEBP — maks. 4 MB</p>
                    </div>
                    <div class="dropzone-preview-wrap" id="dropzone-preview" style="display:none">
                        <img class="dropzone-preview-img" id="dropzone-preview-img" alt="Preview">
                        <button type="button" class="dropzone-remove" id="dropzone-remove" title="Hapus gambar">
                            <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><line x1="18" y1="6" x2="6" y2="18"/><line x1="6" y1="6" x2="18" y2="18"/></svg>
                        </button>
                        <p class="dropzone-filename" id="dropzone-filename"></p>
                    </div>
                </div>
            </div>
            <div class="form-group form-group-full">
                <label for="description">Deskripsi</label>
                <textarea id="description" name="description" rows="4">{{ old('description') }}</textarea>
            </div>
            <div class="form-group form-group-full">
                <label class="checkbox">
                    <input type="checkbox" name="is_active" value="1" {{ old('is_active', 1) ? 'checked' : '' }}>
                    <span>Aktifkan produk</span>
                </label>
            </div>
        </div>
        <div class="form-footer">
            <button class="btn btn-primary" type="submit">Simpan Produk</button>
            <a class="btn btn-ghost" href="{{ route('admin.products.index') }}">Batal</a>
        </div>
    </form>
@endsection

@push('scripts')
<script>
(function () {
    const dropzone   = document.getElementById('dropzone');
    const input      = document.getElementById('image');
    const body       = document.getElementById('dropzone-body');
    const previewWrap= document.getElementById('dropzone-preview');
    const previewImg = document.getElementById('dropzone-preview-img');
    const filenameTx = document.getElementById('dropzone-filename');
    const removeBtn  = document.getElementById('dropzone-remove');

    function showPreview(file) {
        if (!file || !file.type.startsWith('image/')) return;
        const reader = new FileReader();
        reader.onload = (e) => {
            previewImg.src = e.target.result;
            filenameTx.textContent = file.name + ' (' + (file.size / 1024).toFixed(0) + ' KB)';
            body.style.display = 'none';
            previewWrap.style.display = 'flex';
            dropzone.classList.add('has-preview');
        };
        reader.readAsDataURL(file);
    }

    function clearPreview() {
        input.value = '';
        previewImg.src = '';
        filenameTx.textContent = '';
        previewWrap.style.display = 'none';
        body.style.display = 'flex';
        dropzone.classList.remove('has-preview', 'drag-over');
    }

    dropzone.addEventListener('click', (e) => {
        if (e.target === removeBtn || removeBtn.contains(e.target)) return;
        input.click();
    });

    input.addEventListener('change', () => {
        if (input.files[0]) showPreview(input.files[0]);
    });

    removeBtn.addEventListener('click', (e) => {
        e.stopPropagation();
        clearPreview();
    });

    dropzone.addEventListener('dragover', (e) => {
        e.preventDefault();
        dropzone.classList.add('drag-over');
    });

    dropzone.addEventListener('dragleave', (e) => {
        if (!dropzone.contains(e.relatedTarget)) {
            dropzone.classList.remove('drag-over');
        }
    });

    dropzone.addEventListener('drop', (e) => {
        e.preventDefault();
        dropzone.classList.remove('drag-over');
        const file = e.dataTransfer.files[0];
        if (file) {
            const dt = new DataTransfer();
            dt.items.add(file);
            input.files = dt.files;
            showPreview(file);
        }
    });
})();
</script>
@endpush
