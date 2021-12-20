<nav class="navbar navbar-main navbar-expand-lg px-0 mx-4 shadow-none border-radius-xl" id="navbarBlur" navbar-scroll="true">
  <div class="container-fluid py-1 px-3">
 
    <div class="collapse navbar-collapse mt-sm-0 mt-2 me-md-0 me-sm-4" id="navbar">
      <div class="ms-md-auto pe-md-3 d-flex align-items-center">
        <div class="input-group input-group-outline">
          <label class="form-label">Type here...</label>
          <input type="text" class="form-control">
        </div>
      </div>
      <div class="user-header">
                <div class="user-header-content account-header">
                    @if(Auth::check())
                    <div class="btn-group">
                        <button type="button" class="btn btn-danger dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            {{Auth::user()->name}}
                        </button>
                        <div class="dropdown-menu">
                            <a class="dropdown-item" href="#">Trang cá nhân</a>
                            <a class="dropdown-item" href="{{route('Logout')}}">Đăng xuất</a>
                        </div>
                    </div>
                    @else
                    <div class="btn-group">
                        <button type="button" class="btn btn-danger dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Tài khoản
                        </button>
                        <div class="dropdown-menu">
                            <a class="dropdown-item" href="{{route('Login')}}">Đăng nhập</a>
                            <a class="dropdown-item" href="{{route('Register')}}">Đăng ký</a>
                        </div>
                    </div>
                    @endif
                </div>

            </div>
    </div>
  </div>
</nav>