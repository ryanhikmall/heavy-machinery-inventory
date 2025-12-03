@extends('layouts.app')

@section('content')
<div class="card shadow-sm">
    <div class="card-header d-flex justify-content-between align-items-center">
        <h5 class="mb-0">Riwayat Transaksi</h5>
        <a href="{{ route('transactions.create') }}" class="btn btn-primary btn-sm">+ Transaksi Baru</a>
    </div>
    <div class="card-body">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Tanggal</th>
                    <th>Tipe</th>
                    <th>Barang</th>
                    <th>Jumlah</th>
                    <th>Alat Berat (Unit)</th>
                </tr>
            </thead>
            <tbody>
                @forelse($transactions as $trx)
                <tr>
                    <td>{{ $trx->transaction_date }}</td>
                    <td>
                        @if($trx->type == 'in')
                            <span class="badge bg-success">Masuk (IN)</span>
                        @else
                            <span class="badge bg-warning text-dark">Keluar (OUT)</span>
                        @endif
                    </td>
                    <td>{{ $trx->sparepart->name ?? '-' }}</td>
                    <td>{{ $trx->quantity }}</td>
                    <td>{{ $trx->unit->name ?? '-' }}</td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" class="text-center">Belum ada transaksi.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
        
        {{ $transactions->links() }}
    </div>
</div>
@endsection