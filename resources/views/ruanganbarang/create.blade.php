@extends('template.admin2')
@section('content')

<div class="container-fluid py-6">
    <div class="card shadow-sm rounded-4 w-100">
        <div class="card-body">
            <h4 class="card-title mb-3">Tambah Ruangan Barang</h4>
            <div class="card">
    <div class="card-body">
        @if (session('success'))
            <div class="alert alert-info alert-dismissiblae fade show" role="alert">
                {{session('success')}}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            @endif
            @if (session('error'))
            <div class="alert alert-warning alert-dismissible fade show" role="alert">
                {{session('error')}}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <form action="{{route('ruanganbarang.store')}}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="row">
                <div class="col-md-12">
                    <div class="form-floating mb-3">
                        <label for="barang_id">Nama Barang</label>
                        <select name="barang_id" class="form-control" id="barangSelect">
                            <option disabled selected>Pilih Barang</option>
                            @foreach($barang as $data)
                                <option value="{{ $data->id }}" data-stok="{{ $data->stok }}">
                                    {{ $data->nama_barang }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-floating mb-3">
                        <label for="stok">Stok</label>
                        <input type="number" class="form-control" id="stok" name="stok" readonly>
                    </div>
                </div>               
                <div class="col-md-12">
                    <div class="form-floating mb-3">
                    <label for="Nama Product">Nama Ruangan</label>
                        <select name="ruangan_id" class="form-control" id="">
                            <option disable selected>Pilih Ruangan</option>
                            @foreach($ruangan as $data)
                                <option value="{{ $data->id }}">{{ $data->nama_ruangan}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-floating mb-3">
                        <label for="">Tanggal Masuk</label>
                        <input type="date" class="form-control" name="tgl_masuk" id="" value="{{ old('tgl_masuk')}}" required>
                        @error('tgl_masuk') 
                        {{ $message }}
                        @enderror
                    </div>
                </div>
                <div class="col-12">
                    <div class="d-md-flex align-items-center" style="float: right">
                        <div>
                            <button type="submit" class="btn btn-primary">
                                <i class="ti ti-send fs-4"></i>
                                Kirim
                            </button> | 
                            <a href="{{ route('ruanganbarang.index') }}" class="btn btn-secondary">Kembali</a>

                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const selectBarang = document.getElementById('barangSelect');
        const inputStok = document.getElementById('stok');

        selectBarang.addEventListener('change', function () {
            const selectedOption = this.options[this.selectedIndex];
            const stok = selectedOption.getAttribute('data-stok');
            inputStok.value = stok ?? '';
        });
    });
</script>

@endsection