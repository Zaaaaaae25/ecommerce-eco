<!-- Controller code removed. Place it in app/Http/Controllers/ProfileController.php -->
@extends('layouts.app')

@section('content')
<div class="container py-5">
    <div class="row">
        <!-- User Profile Card -->
        <div class="col-md-4 mb-4">
            <div class="card">
                <div class="card-body text-center">
                    <img src="{{ Auth::user()->avatar ?? 'https://via.placeholder.com/150' }}" class="rounded-circle mb-3" width="150">
                    <h4>{{ Auth::user()->name }}</h4>
                    <p class="text-muted">{{ Auth::user()->email }}</p>
                    <div class="border-top pt-3">
                        <div class="row">
                            <div class="col">
                                <h6>Poin Reward</h6>
                                <h4>{{ Auth::user()->reward_points ?? 0 }}</h4>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Statistics and History -->
        <div class="col-md-8">
            <!-- Waste Management Statistics -->
            <div class="card mb-4">
                <div class="card-header">
                    <h5 class="mb-0">Statistik Pengelolaan Sampah</h5>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-4 text-center">
                            <h6>Total Sampah Dibeli</h6>
                            <h4>{{ $statistics->total_waste ?? 0 }} kg</h4>
                        </div>
                        <div class="col-md-4 text-center">
                            <h6>Transaksi Selesai</h6>
                            <h4>{{ $statistics->completed_transactions ?? 0 }}</h4>
                        </div>
                        <div class="col-md-4 text-center">
                            <h6>Total Kontribusi</h6>
                            <h4>Rp {{ number_format($statistics->total_contribution ?? 0, 0, ',', '.') }}</h4>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Purchase History -->
            <div class="card">
                <div class="card-header">
                    <h5 class="mb-0">Riwayat Pembelian</h5>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Tanggal</th>
                                    <th>ID Transaksi</th>
                                    <th>Item</th>
                                    <th>Total</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($purchases as $purchase)
                                <tr>
                                    <td>{{ $purchase->created_at->format('d M Y') }}</td>
                                    <td>{{ $purchase->transaction_id }}</td>
                                    <td>{{ $purchase->items_count }} items</td>
                                    <td>Rp {{ number_format($purchase->total, 0, ',', '.') }}</td>
                                    <td>
                                        <span class="badge bg-{{ $purchase->status_color }}">
                                            {{ $purchase->status }}
                                        </span>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="5" class="text-center">Belum ada riwayat pembelian</td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('styles')
<style>
    .card {
        border-radius: 15px;
        box-shadow: 0 0 15px rgba(0,0,0,0.1);
    }
    .badge {
        padding: 8px 12px;
        border-radius: 30px;
    }
</style>
@endpush

<!-- Route definition removed. Place it in routes/web.php -->

<!-- Model code removed. Place it in app/Models/Purchase.php -->