 <nav class="navbar navbar-expand-lg main-navbar">
        <form class="form-inline mr-auto">
          <ul class="navbar-nav mr-3">
            <li><a href="#" data-toggle="sidebar" class="nav-link nav-link-lg"><i class="fas fa-bars"></i></a></li>
            <li><a href="#" data-toggle="search" class="nav-link nav-link-lg d-sm-none"><i class="fas fa-search"></i></a></li>
          </ul>
        
        </form>
        <ul class="navbar-nav navbar-right">
          <li class="dropdown"><a href="#" data-toggle="dropdown" class="nav-link dropdown-toggle nav-link-lg nav-link-user">
            @if (Auth::user()->is_admin == '1')
            <img alt="image" src="{{asset('backendd/img/pp.png')}}" class="rounded-circle mr-1">
            @else
            <img alt="image" src="{{asset('backendd/img/avatar/avatar-3.png')}}" class="rounded-circle mr-1">
            @endif
            <div class="d-sm-none d-lg-inline-block">{{Auth::user()->name}}</div></a>
            <div class="dropdown-menu dropdown-menu-right">
              <div class="dropdown-title">
                @if (Auth::user()->is_admin == '1')
                {{'Admin'}}
                @else 
                {{'Petugas'}}
                @endif
              </div>
              <div class="dropdown-divider"></div>
              <a href=" {{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" class="dropdown-item has-icon text-danger">
                <i class="fas fa-sign-out-alt"></i> Logout
              </a>
              <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                @csrf
            </form>
      
            </div>
          </li>
        </ul>
      </nav>