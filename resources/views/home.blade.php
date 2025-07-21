@extends('template.admin2')
@section('content')
<div class="container-fluid py-6">
  <div class="card shadow-sm rounded-4">
    <div class="card-body">
      <h1>Dashboard</h1>
    </div>

    <div class="row px-4">
      <!-- Statistik Cards -->
      <div class="col-lg-3 col-md-6 col-sm-6 col-12 mb-4">
        <div class="card card-statistic-1">
          <div class="card-icon bg-primary">
            <i class="fas fa-box"></i>
          </div>
          <div class="card-wrap">
            <div class="card-header"><h4>Barang</h4></div>
            <div class="card-body">{{ $totalBarang }}</div>
          </div>
        </div>
      </div>

      <div class="col-lg-3 col-md-6 col-sm-6 col-12 mb-4">
        <div class="card card-statistic-1">
          <div class="card-icon bg-danger">
            <i class="fas fa-door-open"></i>
          </div>
          <div class="card-wrap">
            <div class="card-header"><h4>Ruangan</h4></div>
            <div class="card-body">{{ $totalRuangan }}</div>
          </div>
        </div>
      </div>

      <div class="col-lg-3 col-md-6 col-sm-6 col-12 mb-4">
        <div class="card card-statistic-1">
          <div class="card-icon bg-warning">
            <i class="fas fa-hand-holding"></i>
          </div>
          <div class="card-wrap">
            <div class="card-header"><h4>Peminjaman</h4></div>
            <div class="card-body">{{ $totalPeminjaman }}</div>
          </div>
        </div>
      </div>

      <div class="col-lg-3 col-md-6 col-sm-6 col-12 mb-4">
        <div class="card card-statistic-1">
          <div class="card-icon bg-success">
            <i class="fas fa-undo"></i>
          </div>
          <div class="card-wrap">
            <div class="card-header"><h4>Pengembalian</h4></div>
            <div class="card-body">{{ $totalPengembalian }}</div>
          </div>
        </div>
      </div>
    </div>

    <!-- Statistik dan Aktivitas -->
    <div class="card mt-4">
        <div class="card-header">
            <h5 class="mb-0">Statistik Peminjaman & Pengembalian</h5>
        </div>
        <div class="card-body">
            <canvas id="statistikChart" height="100"></canvas>
        </div>
    </div>

      <!-- peminjaman -->
      <div class="row">
  <!-- Kolom Kiri: Peminjaman -->
  <div class="col-md-6 col-12 mb-4">
    <div class="card">
      <div class="card-header">
        <h4>Peminjaman / Barang Keluar</h4>
      </div>
      <div class="card-body">
        <ul class="list-unstyled list-unstyled-border">
          @foreach ($peminjamanBaru as $data)
          <li class="media mb-3 align-items-center">
            <img class="mr-3 rounded-circle" width="50" src="{{ asset('backendd/img/avatar/avatar-1.png') }}" alt="avatar">
            <div class="media-body">
              <div class="d-flex justify-content-between align-items-center">
                <div class="media-title font-weight-bold">{{ $data->nama_peminjam }}</div>
                @php
                  $statusClass = match($data->status) {
                      'dipinjam' => 'badge-warning',
                      'dikembalikan' => 'badge-success',
                      'dibatalkan' => 'badge-danger',
                      default => 'badge-secondary'
                  };
                @endphp
                <span class="badge {{ $statusClass }} text-capitalize px-3 py-1">{{ $data->status }}</span>
              </div>
              <div class="mt-1">
                @forelse ($data->detail_peminjaman as $detail)
                  <span class="text-small text-muted">
                    {{ $detail->ruangan_barang?->barang?->nama_barang ?? 'Barang tidak ditemukan' }}
                    | {{ $detail->jumlah }}
                  </span><br>
                @empty
                  <span class="text-small text-muted">Tidak ada peminjaman barang</span>
                @endforelse
              </div>
            </div>
          </li>
          @endforeach
        </ul>
        <div class="text-center pt-1 pb-1">
          <a href="{{ route('peminjaman.index') }}" class="btn btn-primary btn-lg btn-round">Lihat Semua</a>
        </div>
      </div>
    </div>
  </div>

  <!-- Kolom Kanan: Pengembalian -->
  <div class="col-md-6 col-12 mb-4">
    <div class="card">
      <div class="card-header">
        <h4>Pengembalian / Barang Masuk</h4>
        <div class="card-header-action">
          <a href="{{ route('pengembalian.index') }}" class="btn btn-danger">Lihat Semua <i class="fas fa-chevron-right"></i></a>
        </div>
      </div>
      <div class="card-body p-0">
        <div class="table-responsive table-invoice">
          <table class="table table-striped mb-0">
            <tr>
              <th>No</th>
              <th>Nama</th>
              <th>Status</th>
              <th>Barang</th>
              <th>Tgl Pengembalian</th>
            </tr>
            @foreach ($pengembalianBaru as $data)
            <tr>
              <td>{{ $loop->iteration }}</td>
              <td>{{ $data->detail_pengembalian->first()->detail_peminjaman->peminjaman->nama_peminjam ?? '-' }}</td>
              <td><div class="badge badge-success">{{ ucfirst($data->status) }}</div></td>
              <td>
                @forelse ($data->detail_pengembalian as $detail)
                  <span class="text-small text-muted">
                    {{ $detail->detail_peminjaman->ruangan_barang->barang->nama_barang ?? 'Barang tidak ditemukan' }}
                    | {{ $detail->detail_peminjaman->jumlah ?? '-' }}
                  </span><br>
                @empty
                  <span class="text-small text-muted">Tidak ada peminjaman barang</span>
                @endforelse
              </td>
              <td>{{ $data->tgl_pengembalian }}</td>
            </tr>
            @endforeach
          </table>
        </div>
      </div>
    </div>
  </div>
</div>

</div>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    const ctx = document.getElementById('statistikChart').getContext('2d');
    const chart = new Chart(ctx, {
        type: 'line',
        data: {
            labels: {!! json_encode($tanggalSeminggu->pluck('tanggal')) !!},
            datasets: [
                {
                    label: 'Peminjaman',
                    data: {!! json_encode($tanggalSeminggu->pluck('peminjaman')) !!},
                    borderColor: 'royalblue',
                    backgroundColor: 'rgba(65, 105, 225, 0.1)',
                    fill: true,
                    tension: 0.4
                },
                {
                    label: 'Pengembalian',
                    data: {!! json_encode($tanggalSeminggu->pluck('pengembalian')) !!},
                    borderColor: 'mediumseagreen',
                    backgroundColor: 'rgba(60, 179, 113, 0.1)',
                    fill: true,
                    tension: 0.4
                }
            ]
        },
        options: {
            responsive: true,
            scales: {
                y: {
                    beginAtZero: true,
                    ticks: {
                        stepSize: 1
                    }
                }
            }
        }
    });
</script>

@endsection
