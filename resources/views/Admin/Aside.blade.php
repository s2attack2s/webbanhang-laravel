<aside class="sidenav navbar navbar-vertical navbar-expand-xs border-0 border-radius-xl my-3 fixed-start ms-3   bg-gradient-dark" id="sidenav-main">
  <div class="sidenav-header">
    <i class="fas fa-times p-3 cursor-pointer text-white opacity-5 position-absolute end-0 top-0 d-none d-xl-none" aria-hidden="true" id="iconSidenav"></i>
    <a class="navbar-brand m-0" href="{{route('HomeAdmin')}}" target="_blank">
      <img src="/assets/img/logo-ct.png" class="navbar-brand-img h-100" alt="main_logo">
      <span class="ms-1 font-weight-bold text-white">Material Dashboard 2</span>
    </a>
  </div>
  <hr class="horizontal light mt-0 mb-2">
  <div class="collapse navbar-collapse  w-auto  max-height-vh-100" id="sidenav-collapse-main">
    <ul class="navbar-nav">
      <li class="nav-item li-full">
        <a class="nav-link text-white active bg-gradient-primary" href="{{route('HomeAdmin')}}">

          <span class="nav-link-text ms-1">Dashboard</span>
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link text-white item-full" data-toggle="collapse" data-parent="#accordion" href="#category">
          <span class="nav-link-text ms-1"><i class="bi bi-tags"></i> Danh mục</span> <i class="bi bi-caret-down-fill"></i>
        </a>
        <div id="category" class="panel-collapse collapse">
          <a class="nav-link text-white " href="{{route('CateAdmin')}}">
            <i class="bi bi-list-task"></i> <span class="nav-link-text ms-1">Danh sách thể loại</span>
          </a>
          <a class="nav-link text-white " href="{{route('ViewAddCate')}}">
            <i class="bi bi-plus-circle"></i> <span class="nav-link-text ms-1">Thêm mới</span>
          </a>

        </div>
      </li>
      <li class="nav-item">
        <a class="nav-link text-white item-full" data-toggle="collapse" data-parent="#accordion" href="#product">
          <span class="nav-link-text ms-1"><i class="bi bi-box"></i></i> Sản phẩm</span> <i class="bi bi-caret-down-fill"></i>
        </a>
        <div id="product" class="panel-collapse collapse">
          <a class="nav-link text-white " href="{{route('ProductAdmin')}}">
            <i class="bi bi-list-task"></i> <span class="nav-link-text ms-1">Danh sách sản phẩm</span>
          </a>
          <a class="nav-link text-white " href="{{route('ViewAddProduct')}}">
            <i class="bi bi-plus-circle"></i> <span class="nav-link-text ms-1">Thêm mới</span>
          </a>

        </div>
      </li>

    

      <li class="nav-item">
        <a class="nav-link text-white item-full" data-toggle="collapse" data-parent="#accordion" href="#order">
        <i class="bi bi-cart2"></i> <span class="nav-link-text ms-1">Đơn hàng</span> <i class="bi bi-caret-down-fill"></i>
        </a>
        <div id="order" class="panel-collapse collapse">
          <a class="nav-link text-white " href="{{route('ViewOrderConfirm')}}">
            <span class="nav-link-text ms-1"><i class="bi bi-cart-dash"></i> Chưa xác nhận</span>
          </a>
          <a class="nav-link text-white "  href="{{route('ViewOrderDelivery')}}">
            <span class="nav-link-text ms-1"><i class="bi bi-cart-check-fill"></i>  Đang giao</span>
          </a>
          <a class="nav-link text-white "  href="{{route('ViewOrderOk')}}">
            <span class="nav-link-text ms-1"><i class="bi bi-cart-check-fill"></i>  Hoàn thành</span>
          </a>
          <a class="nav-link text-white " href="{{route('ViewOrderDestroy')}}">
            <span class="nav-link-text ms-1"><i class="bi bi-cart-x"></i> Đã hủy</span>
          </a>
        </div>
      </li>

      <li class="nav-item">
        <a class="nav-link text-white item-full" href="{{route('ContactAdmin')}}">
          <span class="nav-link-text ms-1"><i class="bi bi-person-lines-fill"></i> Liên hệ <sup>{{$number}}</sup></span>
        </a>
      </li>

      <li class="nav-item">
        <a class="nav-link text-white item-full" data-toggle="collapse" data-parent="#accordion" href="#user">
          <span class="nav-link-text ms-1"><i class="bi bi-person-circle"></i> Tài khoản</span> <i class="bi bi-caret-down-fill"></i>
        </a>
        <div id="user" class="panel-collapse collapse">
          <a class="nav-link text-white " href="{{route('AccountUser')}}">
          <i class="bi bi-person-check-fill"></i> <span class="nav-link-text ms-1">Khách hàng</span>
          </a>
          <a class="nav-link text-white " href="{{route('AccountAdmin')}}">
          <i class="bi bi-person-dash-fill"></i><span class="nav-link-text ms-1">Quản trị viên</span>
          </a>

        </div>
      </li>

      <li class="nav-item mt-3">
        <h6 class="ps-4 ms-2 text-uppercase text-xs text-white font-weight-bolder opacity-8">Cài đặt trang</h6>
      </li>
      <li class="nav-item">
        <a class="nav-link text-white item-full" data-toggle="collapse" data-parent="#accordion" href="#slider">
          <span class="nav-link-text ms-1"><i class="bi bi-sliders"></i> Slider</span> <i class="bi bi-caret-down-fill"></i>
        </a>
        <div id="slider" class="panel-collapse collapse">
          <a class="nav-link text-white " href="{{route('SliderAdmin')}}">
            <i class="bi bi-list-task"></i> <span class="nav-link-text ms-1">Danh sách Slider</span>
          </a>
          <a class="nav-link text-white " href="{{route('ViewAddSlider')}}">
            <i class="bi bi-plus-circle"></i> <span class="nav-link-text ms-1">Thêm mới</span>
          </a>

        </div>
      </li>

      <li class="nav-item">
        <a class="nav-link text-white item-full" data-toggle="collapse" data-parent="#accordion" href="#partners">
          <span class="nav-link-text ms-1"><i class="bi bi-people"></i> Đối tác</span> <i class="bi bi-caret-down-fill"></i>
        </a>
        <div id="partners" class="panel-collapse collapse">
          <a class="nav-link text-white " href="{{route('PartnersAdmin')}}">
            <i class="bi bi-list-task"></i> <span class="nav-link-text ms-1">Danh sách</span>
          </a>
          <a class="nav-link text-white " href="{{route('ViewAddPartners')}}">
            <i class="bi bi-plus-circle"></i> <span class="nav-link-text ms-1">Thêm mới</span>
          </a>

        </div>
      </li>

      <li class="nav-item">
        <a class="nav-link text-white item-full" data-toggle="collapse" data-parent="#accordion" href="#info">
          <span class="nav-link-text ms-1"><i class="bi bi-info-circle-fill"></i>Thông tin</span> <i class="bi bi-caret-down-fill"></i>
        </a>
        <div id="info" class="panel-collapse collapse">
          <a class="nav-link text-white " href="{{route('InfoAdmin')}}">
            <i class="bi bi-list-task"></i> <span class="nav-link-text ms-1">Danh sách</span>
          </a>
          <a class="nav-link text-white " href="{{route('ViewAddInfo')}}">
            <i class="bi bi-plus-circle"></i> <span class="nav-link-text ms-1">Thêm mới</span>
          </a>

        </div>
      </li>



    </ul>
  </div>
</aside>