<section id="billboard" class="bg-light py-5" id="#ruangan">
    <div class="container">
      <div class="row justify-content-center">
        <h1 class="section-title text-center mt-4" data-aos="fade-up">Iventaries</h1>
        <div class="col-md-6 text-center" data-aos="fade-up" data-aos-delay="300">
          <p>Selamat Datang Di Website Kami!!</p>
        </div>
      </div>
      <div class="row">
        <div class="swiper main-swiper py-4" data-aos="fade-up" data-aos-delay="600">
          <div class="swiper-wrapper d-flex border-animation-left">
        @foreach($ruangan as $data)
            <div class="swiper-slide">
              <div class="banner-item image-zoom-effect">
                <div class="image-holder">
                  <a href="#">
                    <img src="{{asset('storage/' . $data->foto)}}" alt="" class="img-fluid">
                  </a>
                </div>
                <div class="banner-content py-4">
                  <h5 class="element-title text-uppercase">
                    <a href="index.html" class="item-anchor">{{ $data->nama_ruangan }}</a>
                  </h5>
                  <p>{{ $data->deskripsi }}</p>
                  <div class="btn-left">
                    <a href="{{route('ruangan', ['id' => $data->id])}}" class="btn-link fs-6 text-uppercase item-anchor text-decoration-none">Lihat Barang</a>
                  </div>
                </div>
              </div>
            </div>
        @endforeach
          </div>
          <div class="swiper-pagination"></div>
        </div>
        <div class="icon-arrow icon-arrow-left"><svg width="50" height="50" viewBox="0 0 24 24">
            <use xlink:href="#arrow-left"></use>
          </svg></div>
        <div class="icon-arrow icon-arrow-right"><svg width="50" height="50" viewBox="0 0 24 24">
            <use xlink:href="#arrow-right"></use>
          </svg></div>
      </div>
    </div>
  </section>