<nav class="navbar navbar-expand-lg bg-light text-uppercase fs-6 py-1 px-2 border-bottom align-items-center">
    <div class="container-fluid">
      <div class="row justify-content-between align-items-center w-100">

        <div class="col-auto">
          <a class="navbar-brand text-white" href="index.html">
            <svg width="112" height="45" viewBox="0 0 112 45" xmlns="http://www.w3.org/2000/svg" fill="#111">
              <path>
                <img src="{{asset('frontend/images/iventaries.png')}}" alt="" width="30%" height="30%" style="float: left;">
            </svg>
          </a>
        </div>

        <div class="col-auto">
          <button class="navbar-toggler" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasNavbar"
            aria-controls="offcanvasNavbar">
            <span class="navbar-toggler-icon"></span>
          </button>

          <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasNavbar"
            aria-labelledby="offcanvasNavbarLabel">
            <div class="offcanvas-header">
              <h5 class="offcanvas-title" id="offcanvasNavbarLabel">Menu</h5>
              <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas"
                aria-label="Close"></button>
            </div>

            <div class="offcanvas-body">
              <ul class="navbar-nav justify-content-end flex-grow-1 gap-1 gap-md-5 pe-3">
              <li class="nav-item">
                  <a class="nav-link" href="{{route('welcome')}}">Beranda</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="#tentang">Tentang</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="#ruangan">Ruangan</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="#barang">Barang</a>
                </li>
              </ul>
            </div>
          </div>
        </div>
      </div>

    </div>
  </nav>