@extends('layouts.app')

@section('content')
<div class="col-md-8 mx-auto">
    <div class="card shadow">
        <div class="card-header bg-primary text-white">Catat Transaksi Baru</div>
        <div class="card-body">
            <form action="{{ route('transactions.store') }}" method="POST">
                @csrf
                
                <div class="mb-3">
                    <label class="form-label">Jenis Transaksi</label>
                    <select name="type" id="type" class="form-select" onchange="toggleUnit()" required>
                        <option value="in">Barang Masuk (Stok Bertambah)</option>
                        <option value="out">Barang Keluar (Stok Berkurang)</option>
                    </select>
                </div>

                <div class="mb-3">
                    <label class="form-label">Nama Sparepart</label>
                    <select name="sparepart_id" class="form-select" required>
                        <option value="">-- Pilih Barang --</option>
                        @foreach(\App\Models\Sparepart::all() as $part)
                            <option value="{{ $part->id }}">
                                {{ $part->part_number }} - {{ $part->name }} (Sisa Stok: {{ $part->stock }})
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-3">
                    <label class="form-label">Jumlah (Qty)</label>
                    <input type="number" name="quantity" class="form-control" min="1" required>
                </div>

                <div class="mb-3" id="unit_input" style="display:none;">
                    <label class="form-label">Digunakan untuk Unit Alat Berat?</label>
                    <select name="unit_id" class="form-select">
                        <option value="">-- Pilih Unit --</option>
                        @foreach(\App\Models\Unit::all() as $unit)
                            <option value="{{ $unit->id }}">{{ $unit->name }} - {{ $unit->model }}</option>
                        @endforeach
                    </select>
                    <small class="text-muted">Wajib diisi jika barang keluar/dipakai.</small>
                </div>

                <div class="mb-3">
                    <label class="form-label">Tanggal Transaksi</label>
                    <input type="date" name="transaction_date" class="form-control" value="{{ date('Y-m-d') }}" required>
                </div>

                <div class="d-flex justify-content-between">
                    <a href="{{ route('transactions.index') }}" class="btn btn-secondary">Batal</a>
                    <button type="submit" class="btn btn-success">Simpan Transaksi</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    function toggleUnit() {
        var type = document.getElementById('type').value;
        var unitInput = document.getElementById('unit_input');
        if (type === 'out') {
            unitInput.style.display = 'block';
        } else {
            unitInput.style.display = 'none';
        }
    }
</script>
@endsection