<nav class="navbar navbar-expand-lg navbar-light bg-light">
  <div class="container-fluid">
    <a class="navbar-brand" href="{{url('/')}}">Ecom</a>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <div class="search-bar">
        <div class="search-input-wrapper">
          <form action="{{url('/search-product')}}" method="post">
            @csrf
            <a href="" class="link-search" target="_blank" hidden></a>
            <input class="search-input" name="product_name" type="text" placeholder="Type to search.." required>
            <div class="autocom-box">
              <!-- here list are inserted from javascript -->
            </div>
            <button type="submit" class="icon"><i class="fas fa-search"></i></button>
          </form>
        </div>
      </div>
      <ul class="navbar-nav nav-ma">
        <li class="nav-item">
          <a class="nav-link active " aria-current="page" href="#">Home</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="{{ url('category') }}">Category</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="{{ url('/cart') }}">
            Cart
            <span class="badge badge-pill bg-primary cart-count">0</span>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="{{ url('/wishlist') }}">
            Wishlist
            <span class="badge badge-pill bg-success wishlist-count">0</span>
          </a>
        </li>
        @guest
        @if (Route::has('login'))
        <li class="nav-item">
          <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
        </li>
        @endif
  
        @if (Route::has('register'))
        <li class="nav-item">
          <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
        </li>
        @endif
        @else
        <li class="nav-item dropdown">
          
          
          <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown"
            aria-expanded="false">
            <img src="{{Auth::user()->avatar?asset('assets/uploads/avatar/'.Auth::user()->avatar):asset('assets/uploads/avatar/user.png')}}" alt="mdo" width="32" height="32" class="rounded-circle">
          </a>
          <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
            <li><a class="dropdown-item" href="{{url('/profile')}}">My Profile</a></li>
            <li><a class="dropdown-item" href="{{url('/my-orders')}}">My Orders</a></li>
            <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
                                                       document.getElementById('logout-form').submit();">
              {{ __('Logout') }}
            </a>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
              @csrf
            </form>
          </ul>
        </li>
  
        @endguest
      </ul>
    </div>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
      aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>


  </div>
  </div>
</nav>