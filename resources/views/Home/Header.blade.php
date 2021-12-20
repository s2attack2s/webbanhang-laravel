<section class="header">
    <div class="container header-container">
        <div class="site-header">
            <div class="site-header-logo">
                @if($footer)
                <img src="https://docs.google.com/uc?id={{$footer->img}}" />
                @endif
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

                <div class="user-header-content cart-header">
                    <a href="{{route('Cart')}}">
                        <i id="cart" class="bi bi-cart">
                            @if($quantityCart)

                            <sup>{{$quantityCart}}</sup>

                            @endif</i>
                    </a>
                </div>
            </div>
        </div>
    </div>
    <div class="menu-header" id="menu-header">


        <div class="container header-container menu-header-container">
            <div class="nav-menu-header">

                <nav class="nav">
                    <div class="icon-menu"> <i class="bi bi-list"></i></div>
                    <ul class="menu">
                        <li class="menu-item">
                            <a href="{{route('Home')}}" class="menu-link">
                                <i class="bi bi-house"></i> Trang chủ
                            </a>

                        </li>
                        <li class="menu-item">
                            <a href="#" class="menu-link">
                                <i class="bi bi-bullseye"></i> Giới thiệu
                            </a>

                        </li>
                        <li class="menu-item">
                            <a href="{{route('Product')}}" class="menu-link">
                                <i class="bi bi-box-seam"></i> Sản phẩm
                            </a>

                        </li>
                        <li class="menu-item">
                            <a href="{{route('Contact')}}" class="menu-link">
                                <i class="bi bi-person-rolodex"></i> Liên hệ
                            </a>
                        </li>

                    </ul>
                </nav>
            </div>
            <div class="menu-header-search">
                <div class="search-input">
                    <form class="form-search" action="{{route('SearchProduct')}}" method="get" role="search">
                        <input type="text" name="name" id="name-search" placeholder="Search for anything" />
                        <button class="btn btn-primary" id="searchProduct" type="submit"><i class="bi bi-search"></i></button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <main class="site-wrapper header-mobile show-menu-mobile" id="show-menu-mobile">
        <i class="icon-menu bi bi-x-octagon"></i>
        <div class="pt-table desktop-768">
            <div class="pt-tablecell page-home relative" style="background-image: url(https://images.unsplash.com/photo-1486870591958-9b9d0d1dda99?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=crop&w=1500&q=80);
    background-position: center;
    background-size: cover;">
                <div class="overlay"></div>

                <div class="container">
                    <div class="row">
                        <div class="col-xs-12 col-md-offset-1 col-md-10 col-lg-offset-2 col-lg-8">
                            <div class="page-title  home text-center">


                            </div>

                            <div class="hexagon-menu clear">
                                <div class="hexagon-item">
                                    <div class="hex-item">
                                        <div></div>
                                        <div></div>
                                        <div></div>
                                    </div>
                                    <div class="hex-item">
                                        <div></div>
                                        <div></div>
                                        <div></div>
                                    </div>
                                    <a href="{{route('Home')}}" class="hex-content">
                                        <span class="hex-content-inner">
                                            <span class="icon">
                                                <i class="fa fa-universal-access"></i>
                                            </span>
                                            <span class="title">Trang chủ</span>
                                        </span>
                                        <i class="bi bi-house"></i> </a>
                                </div>
                                <div class="hexagon-item">
                                    <div class="hex-item">
                                        <div></div>
                                        <div></div>
                                        <div></div>
                                    </div>
                                    <div class="hex-item">
                                        <div></div>
                                        <div></div>
                                        <div></div>
                                    </div>
                                    <a class="hex-content">
                                        <span class="hex-content-inner">
                                            <span class="icon">
                                                <i class="fa fa-bullseye"></i>
                                            </span>
                                            <span class="title">Giới thiệu</span>
                                        </span>
                                        <i class="bi bi-bullseye"></i> </a>
                                </div>
                                <div class="hexagon-item">
                                    <div class="hex-item">
                                        <div></div>
                                        <div></div>
                                        <div></div>
                                    </div>
                                    <div class="hex-item">
                                        <div></div>
                                        <div></div>
                                        <div></div>
                                    </div>
                                    <a href="{{route('Product')}}" class="hex-content">
                                        <span class="hex-content-inner">
                                            <span class="icon">
                                                <i class="fa fa-braille"></i>
                                            </span>
                                            <span class="title">Sản phẩm</span>
                                        </span>
                                        <i class="bi bi-box-seam"></i>
                                    </a>
                                </div>
                                <div class="hexagon-item">
                                    <div class="hex-item">
                                        <div></div>
                                        <div></div>
                                        <div></div>
                                    </div>
                                    <div class="hex-item">
                                        <div></div>
                                        <div></div>
                                        <div></div>
                                    </div>
                                    <a href="{{route('Contact')}}" class="hex-content">
                                        <span class="hex-content-inner">
                                            <span class="icon">
                                                <i class="fa fa-id-badge"></i>
                                            </span>
                                            <span class="title">Liên hệ</span>
                                        </span>
                                        <i class="bi bi-person-rolodex"></i>
                                    </a>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
</section>