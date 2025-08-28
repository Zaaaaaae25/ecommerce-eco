@push('styles')
<style>
  .card { border-radius: 15px; box-shadow: 0 0 15px rgba(0,0,0,.1); }
  .badge { padding: 8px 12px; border-radius: 30px; }
</style>
@endpush

@extends('layouts.app')

@section('content')
<div class="container py-5">
  <div class="row">
    {{-- Profile --}}
    <div class="col-md-4 mb-4">
      <div class="card">
        <div class="card-body text-center">
          @php
            $avatar = $user->avatar ?? null;
            if ($avatar && !Str::startsWith($avatar, ['http://','https://'])) {
              $avatar = Storage::url($avatar);
            }
          @endphp

          <img src="{{ $avatar ?: 'https://via.placeholder.com/150' }}"
               alt="Avatar {{ $user->name ?? 'Guest' }}"
               class="rounded-circle mb-3" width="150"
               onerror="this.src='https://via.placeholder.com/150'">

          <h4 class="mb-0">{{ $user->name ?? 'Guest User' }}</h4>
          <p class="text-muted">{{ $user->email ?? 'guest@example.com' }}</p>

          <div class="border-top pt-3">
            <div class="row">
              <div class="col">
                <h6 class="mb-1">Poin Reward</h6>
                <h4 class="mb-0">{{ number_format($user->reward_points ?? 0) }}</h4>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

    {{-- Statistics + History --}}
    <div class="col-md-8">
      {{-- Stats --}}
      <div class="card mb-4">
        <div class="card-header"><h5 class="mb-0">Statistik Pengelolaan Sampah</h5></div>
        <div class="card-body">
          <div class="row text-center g-3">
            <div class="col-md-4">
              <h6 class="text-muted mb-1">Total Sampah Dibeli</h6>
              <h4 class="mb-0">{{ number_format($statistics->total_waste ?? 0, 2) }} kg</h4>
            </div>
            <div class="col-md-4">
              <h6 class="text-muted mb-1">Transaksi Selesai</h6>
              <h4 class="mb-0">{{ number_format($statistics->completed_transactions ?? 0) }}</h4>
            </div>
            <div class="col-md-4">
              <h6 class="text-muted mb-1">Total Kontribusi</h6>
              <h4 class="mb-0">Rp {{ number_format($statistics->total_contribution ?? 0, 0, ',', '.') }}</h4>
            </div>
          </div>
        </div>
      </div>

      {{-- Purchase History --}}
      <div class="card">
        <div class="card-header"><h5 class="mb-0">Riwayat Pembelian</h5></div>
        <div class="card-body">
          <div class="table-responsive">
            <table class="table align-middle">
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
                  <td>{{ optional($purchase->created_at)->format('d M Y') ?: '-' }}</td>
                  <td class="text-monospace">{{ $purchase->transaction_id }}</td>
                  <td>{{ $purchase->items_count }} items</td>
                  <td>Rp {{ number_format($purchase->total, 0, ',', '.') }}</td>
                  <td>
                    <span class="badge bg-{{ $purchase->status_color }}">
                      {{ ucfirst($purchase->status) }}
                    </span>
                  </td>
                </tr>
              @empty
                <tr>
                  <td colspan="5" class="text-center text-muted">Belum ada riwayat pembelian</td>
                </tr>
              @endforelse
              </tbody>
            </table>
          </div>

          {{-- Pagination --}}
          <div class="d-flex justify-content-end mt-3">
            {{ $purchases->withQueryString()->links() }}
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
