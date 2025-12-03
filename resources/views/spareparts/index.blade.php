@extends('layouts.app')

@section('content')
<div class="card shadow-sm">
    <div class="card-header d-flex justify-content-between align-items-center">
    <h5 class="mb-0">Daftar Stok Sparepart</h5>
    
    @if(Auth::user()->role === 'admin')
        <a href="{{ route('spareparts.create') }}" class="btn btn-primary btn-sm">+ Tambah Barang</a>
    @endif
</div>
    <div class="card-body">
        <table class="table table-hover">
            <thead>
                <tr>
                    <th>Part Number</th>
                    <th>Nama Barang</th>
                    <th>Kategori</th>
                    <th>Stok</th>
                    <th>Lokasi</th>

                    @if(Auth::user()->role === 'admin')
                    <th>Aksi</th>
                    @endif
                </tr>
            </thead>
            <tbody>
    @foreach($spareparts as $item)
    <tr class="{{ $item->stock <= $item->min_stock ? 'table-danger' : '' }}">
        <td>{{ $item->part_number }}</td>
        <td>{{ $item->name }}</td>
        <td>{{ $item->category->name ?? '-' }}</td>
        <td><strong>{{ $item->stock }}</strong></td>
        <td>{{ $item->location }}</td>

        @if(Auth::user()->role === 'admin')
            <td>
                <a href="#" class="btn btn-sm btn-warning">Edit</a>
                
                {{-- <form ...> @csrf @method('DELETE') <button>Hapus</button> </form> --}}
            </td>
        @endif
    </tr>
    @endforeach
</tbody>
        </table>
        
        {{ $spareparts->links() }}
    </div>
</div>
@endsection