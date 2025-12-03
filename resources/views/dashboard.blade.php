@extends('layouts.app')

@section('content')
<div class="row">
    <div class="col-md-4">
        <div class="card text-white bg-primary mb-3">
            <div class="card-body">
                <h5 class="card-title">Total Jenis Barang</h5>
                <h2>{{ $total_items }} Item</h2>
            </div>
        </div>
    </div>

    <div class="col-md-4">
        <div class="card text-white bg-danger mb-3">
            <div class="card-body">
                <h5 class="card-title">Perlu Restock</h5>
                <h2>{{ $low_stock }} Item</h2>
                <p class="card-text">Stok berada di bawah batas minimum.</p>
            </div>
        </div>
    </div>
</div>
@endsection