@extends('template.admin2')
@section('content')

<div class="container-fluid py-6">
    <div class="card shadow-sm rounded-4 w-100">
        <div class="card-body">
            <h4 class="card-title mb-3">Pengembalian</h4>
            <div class="card">
                <div class="card-body">
                    @if (session('success'))
                        <div class="alert alert-info alert-dismissiblae fade show" role="alert">
                            {{ session('success') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif
                    @if (session('error'))
                        <div class="alert alert-warning alert-dismissible fade show" role="alert">
                            {{ session('error') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif

                    <form action="{{ route('pengembalian.store') }}" method="POST">
                        @csrf

                        {{-- Nama Peminjam --}}
                        <div class="mb-3">
                            <label>Nama Peminjam</label>
                            <select name="peminjaman_id" id="peminjamanSelect" class="form-control" required>
                                <option disabled selected>pilih peminjam</option>
                                @foreach($pengembalian['peminjaman']->where('status', 'dipinjam') as $peminjaman)
                                    @php
                                        $details = $pengembalian['detail_peminjaman']
                                            ->where('peminjaman_id', $peminjaman->id)
                                            ->values()
                                            ->map(function ($detail) {
                                                return [
                                                    'id' => $detail->id,
                                                    'barang' => $detail->ruangan_barang->barang->nama_barang ?? '-',
                                                    'jumlah' => $detail->jumlah,
                                                    'tanggal' => $detail->peminjaman->tgl_pengembalian,
                                                ];
                                            });
                                    @endphp
                                    <option 
                                        value="{{ $peminjaman->id }}" 
                                        data-detail='@json($details)'
                                    >
                                        {{ $peminjaman->nama_peminjam }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        {{-- Tabel Detail Peminjaman --}}
                        <div class="mb-3">
                            <table class="table table-bordered" id="detailTable" style="display: none;">
                                <thead>
                                    <tr>
                                        <th>Nama Barang</th>
                                        <th>Jumlah Pinjam</th>
                                        <th>Jumlah Dikembalikan</th>
                                        <th>Tanggal Pengembalian</th>
                                        <th>Status</th>
                                    </tr>
                                </thead>
                                <tbody></tbody>
                            </table>
                        </div>

                        {{-- Tanggal Kembali --}}
                        <div class="mb-3">
                            <label>Tanggal Kembali</label>
                            <input type="date" class="form-control" name="tgl_pengembalian" required>
                        </div>

                        {{-- Catatan --}}
                        <div class="mb-3">
                            <label>Catatan</label>
                            <textarea name="catatan" class="form-control"></textarea>
                        </div>
                        
                        <button type="submit" class="btn btn-primary">Simpan Pengembalian</button>
                        <a href="{{ route('pengembalian.index') }}" class="btn btn-secondary">Kembali</a>

                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- Script Dinamis --}}
<script>
    const select = document.getElementById('peminjamanSelect');
    const table = document.getElementById('detailTable');
    const tbody = table.querySelector('tbody');

    select.addEventListener('change', function () {
        const selected = this.options[this.selectedIndex];
        const detailData = selected.getAttribute('data-detail');
        tbody.innerHTML = ''; // clear

        if (detailData) {
            const detailArray = JSON.parse(detailData);

            detailArray.forEach((item, index) => {
                const row = `
                    <tr>
                        <td>${item.barang}</td>
                        <td>${item.jumlah}</td>
                        <td>
                            <input type="number" class="form-control" name="jumlah_dikembalikan[]" min="0" max="${item.jumlah}" value="${item.jumlah}" required>
                            <input type="hidden" name="detail_pinjaman_id[]" value="${item.id}">
                        </td>
                        <td>${item.tanggal}</td>
                        <td>
                            <select name="keterangan[]" class="form-control" required>
                                <option value="normal">Normal</option>
                                <option value="rusak">Rusak</option>
                                <option value="hilang">Hilang</option>
                                <option value="rusak dan hilang">Rusak dan Hilang</option>
                            </select>
                        </td>
                    </tr>
                `;
                tbody.insertAdjacentHTML('beforeend', row);
            });

            table.style.display = 'table';
        } else {
            table.style.display = 'none';
        }
    });
</script>

@endsection
