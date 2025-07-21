<section class="blog py-5" id="barang">
    <div class="container">
      <div class="d-flex flex-wrap justify-content-between align-items-center mt-5 mb-3">
        <h4 class="text-uppercase">Kategori</h4>
        <h4 class="text-uppercase">Barang</h4>

      </div>
      <div class="row">

      <form method="GET" action="{{ url('/') }}" class="mb-4">
        <div class="input-group">
            <select name="kategori" class="form-select" onchange="this.form.submit()">
            <option value="" class="text-uppercase">Kategori</option>
            @foreach($kategoriFilter as $item)
                <option value="{{ $item->kategori }}" class="text-uppercase" {{ request('kategori') == $item->kategori ? 'selected' : '' }}>
                    {{ ucfirst($item->kategori) }}
                </option>
            @endforeach
            </select>
        </div>
        </form>

    @foreach ($barang as $item)
        <div class="col-md-4">
            <article class="post-item">
                <div class="post-image">
                    <a href="#">
                        <img src="{{ asset('storage/' . $item->foto) }}" alt="image" class="post-grid-image img-fluid">
                    </a>
                </div>
                <div class="post-content d-flex flex-wrap gap-2 my-3">
                    <div class="post-meta text-uppercase fs-6 text-secondary">
                        <span class="post-category">{{ $item->kategori }} /</span>
                        <span class="meta-day"> {{ now()->format('M d, Y') }}</span>
                    </div>
                    <h5 class="post-title text-uppercase">
                        <a href="#">{{ $item->nama_barang }}</a>
                    </h5>
                    <p>Stok: {{ $item->stok }}</p>
                </div>
            </article>
        </div>
    @endforeach


      </div>
    </div>
  </section>