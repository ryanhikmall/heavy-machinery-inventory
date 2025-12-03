@extends('layouts.app')

@section('content')
<div class="col-md-8 mx-auto">
    <div class="card shadow-sm">
        <div class="card-header bg-primary text-white">
            <h5 class="mb-0">Tambah Sparepart Baru</h5>
        </div>
        <div class="card-body">
            <form action="{{ route('spareparts.store') }}" method="POST">
                @csrf
                
                <!-- Pilihan Kategori -->
                <div class="mb-3">
                    <label class="form-label">Kategori <span class="text-danger">*</span></label>
                    <select name="category_id" class="form-select" required>
                        <option value="">-- Pilih Kategori --</option>
                        @foreach($categories as $cat)
                            <option value="{{ $cat->id }}">{{ $cat->name }}</option>
                        @endforeach
                    </select>
                </div>

                <!-- Input Part Number -->
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Part Number (Kode Barang) <span class="text-danger">*</span></label>
                        <input type="text" name="part_number" class="form-control" placeholder="Contoh: FIL-001" required>
                    </div>
                    
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Nama Barang <span class="text-danger">*</span></label>
                        <input type="text" name="name" class="form-control" placeholder="Contoh: Oil Filter D85" required>
                    </div>
                </div>

                <!-- Input Stok & Lokasi -->
                <div class="row">
                    <div class="col-md-4 mb-3">
                        <label class="form-label">Stok Awal</label>
                        <input type="number" name="stock" class="form-control" value="0" min="0">
                        <small class="text-muted">Biarkan 0 jika barang belum ada.</small>
                    </div>

                    <div class="col-md-4 mb-3">
                        <label class="form-label">Min. Stock Alert <span class="text-danger">*</span></label>
                        <input type="number" name="min_stock" class="form-control" value="5" required>
                        <small class="text-muted">Batas minimal untuk peringatan.</small>
                    </div>

                    <div class="col-md-4 mb-3">
                        <label class="form-label">Satuan</label>
                        <input type="text" name="unit" class="form-control" value="Pcs" placeholder="Pcs/Set/Box">
                    </div>
                </div>

                <div class="mb-3">
                    <label class="form-label">Lokasi Rak (Opsional)</label>
                    <input type="text" name="location" class="form-control" placeholder="Contoh: Rak A-1, Bin 3">
                </div>

                <div class="d-flex justify-content-between mt-4">
                    <a href="{{ route('spareparts.index') }}" class="btn btn-secondary">Batal</a>
                    <button type="submit" class="btn btn-success">Simpan Data</button>
                </div>

            </form>
        </div>
    </div>
</div>
@endsection