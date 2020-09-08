<nav class="main-header navbar navbar-expand navbar-light navbar-white">
    <div class="container">
      <a href="/" class="navbar-brand">
        <img src="{{asset('image/Undip.png')}}" alt="Universitas Diponegoro" class="brand-image img-circle elevation-3"
             style="opacity: .8">
        <span class="brand-text font-weight-light">WELCOME</span>
      </a>

      <!-- Left navbar links -->
      <ul class="navbar-nav">
        <li class="nav-item">
        </li>
        <li class="nav-item d-none d-sm-inline-block">
          <a href="/" class="nav-link">Home</a>
        </li>
      </ul>


      <!-- Right navbar links -->
      <ul class="navbar-nav ml-auto">
        <li class="nav-item">
          @if(Auth::user() == false)
            <a class="nav-link" href="/login">
                <i class="fas fa-sign-in-alt"> </i> Login
            </a>                  
          @else 
            <a class="nav-link" href="/login">
                <i class="fas fa-sign-in-alt"> </i> Admin Panel
            </a>  
          @endif 
        </li>
      </ul>
    </div>
  </nav>