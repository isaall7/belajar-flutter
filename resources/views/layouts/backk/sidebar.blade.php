<div class="main-sidebar sidebar-style-2">
        <aside id="sidebar-wrapper">
          <div class="sidebar-brand">
            <a href="index.html">Iventaries</a>
          </div>
          <div class="sidebar-brand sidebar-brand-sm">
            <a href="index.html">St</a>
          </div>
          <ul class="sidebar-menu">
            <li class="menu-header">Halaman</li>
            <li class="dropdown active">
              <a href="#" class="nav-link has-dropdown"><i class="fas fa-fire"></i><span>Index</span></a>
              <ul class="dropdown-menu">
                <li class=active><a class="nav-link" href="{{route('home')}}">Dashboard</a></li>
                <li><a class="nav-link" href="{{route('welcome')}}">Front</a></li>
              </ul>
            </li>
            <li class="menu-header">Halaman</li>
          @if(Auth::user()->is_admin === 1)
            <li class="dropdown">
              <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i class="ion-cube"></i> <span>Ruang/Barang</span></a>
              <ul class="dropdown-menu">
                <li><a class="nav-link" href="{{route('barang.index')}}"> Data Barang</a></li>
                <li><a class="nav-link" href="{{route('ruangan.index')}}">Data Ruangan</a></li>
              </ul>
            </li>
            <li class="dropdown">
              <a href="#" class="nav-link has-dropdown"><i class="bi bi-door-closed"></i> <span>Ruangan</span></a>
              <ul class="dropdown-menu">
                <li><a class="nav-link" href="{{route('ruanganbarang.index')}}">Ruangan barang</a></li>
              </ul>
            </li>
          @endif
            <li class="dropdown">
              <a href="#" class="nav-link has-dropdown"><i class="fas fa-th"></i> <span>Pinjam/kembali</span></a>
              <ul class="dropdown-menu">
                <li><a class="nav-link" href="{{route('peminjaman.index')}}">Data Peminjam</a></li>
                <li><a class="nav-link" href="{{route('pengembalian.index')}}">Data Pengembalian</a></li>
              </ul>
            </li>
          <div class="mt-4 mb-4 p-3 hide-sidebar-mini">
            <a href=" {{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" 
            class="btn btn-primary btn-lg btn-block btn-icon-split">
              <i class="fas fa-rocket"></i> {{ __('Logout') }}
            </a>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                @csrf
            </form>
          </div>        </aside>
      </div>
                                    