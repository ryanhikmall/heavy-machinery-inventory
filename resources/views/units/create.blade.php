@extends('layouts.app')

@section('content')
<div class="col-md-6 mx-auto">
    <div class="card shadow-sm">
        <div class="card-header bg-primary text-white">Tambah Unit Alat Berat</div>
        <div class="card-body">
            <form action="{{ route('units.store') }}" method="POST">
                @csrf
                <div class="mb-3">
                    <label class="form-label">Kode Unit (Nomor Lambung)</label>
                    <input type="text" name="name" class="form-control" placeholder="Contoh: DT-01, EX-200" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">Model / Tipe Alat</label>
                    <input type="text" name="model" class="form-control" placeholder="Contoh: Komatsu PC200">
                </div>
                <div class="d-flex justify-content-between">
                    <a href="{{ route('units.index') }}" class="btn btn-secondary">Batal</a>
                    <button type="submit" class="btn btn-success">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection