@extends('template.admin2')
@section('content')
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
<br><br><br>

<div class="table-responsive">
  <table class="table">
    <div>
        <h3>Barang</h3>
    </div>
  @if (session('success'))
    <div class="alert alert-info alert-dismissiblae fade show" role="alert">
        {{session('success')}}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    @endif
    @if (session('fail'))
    <div class="alert alert-warning alert-dismissible fade show" role="alert">
        {{session('fail')}}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    @endif
      <thead class="bg-inverse">
          <tr>
              <th class="text-black">No</th>
              <th class="text-black">Nama Peminjam</th>
              <th class="text-black">Nama Barang Dan Jumlah Pinjaman</th>
              <th class="text-black">Tanggal Dikembalikan</th>
              <th class="text-black">Status</th>
              <th class="text-black">
              </th>
          </tr>
      </thead>
      <tbody>
      @forelse($data as $peminjaman_id => $details)
<tr>
    <td>{{ $loop->iteration }}</td>
    <td>{{ $details->first()->peminjaman->nama_peminjam ?? '-' }}</td>
    <td>
        <ul class="list-group">
            @foreach($details as $item)
                <li class="list-group-item">
                    {{ $item->ruangan_barang->barang->nama_barang ?? '-' }} | <b>{{ $item->jumlah }}</b>
                </li>
            @endforeach
        </ul>
    </td>
    <td>{{ $details->first()->peminjaman->tgl_pengembalian ?? '-' }}</td>
    <td>{{ $details->first()->status }}</td>
    <td>
        <form action="{{ route('detail.destroy', $details->first()->id) }}" method="post">
            <a href="{{ route('detail.edit', $details->first()->id) }}" class="btn btn-sm btn-success">
                <i class="bi bi-pencil"></i>
            </a>
            @csrf
            @method('delete')
            <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Apakah Anda Yakin?')">
                <i class="bi bi-trash"></i>
            </button>
        </form>
    </td>
</tr>
@empty
<tr>
    <td colspan="6" class="text-center">Tidak ada data detail</td>
</tr>
@endforelse

      </tbody>
  </table>
</div>
@endsection
