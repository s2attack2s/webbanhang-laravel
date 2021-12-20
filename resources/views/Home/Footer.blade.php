@if($footer)
<footer>
    <div class="row-footer">
        <div class="site-logo">

            <ul class="main-nav">
                <img src="https://docs.google.com/uc?id={{$footer->img}}" />
            </ul>
        </div>
        <div class="site-links">
            <span>Menu</span>
            <ul class="list-links">
                <li><a href="{{route('Home')}}">Trang chủ</a></li>
                <li><a href="{{route('Product')}}">Sản phẩm</a></li>
                <li><a href="{{route('Contact')}}">Giới thiệu</a></li>
                <li><a href="{{route('Contact')}}">Liên hệ</a></li>

            </ul>
        </div>
        <div class="adr-email">
            <span>Địa chỉ</span>
            <ul class="">
                <li class="location"><a><i class="fas fa-map-pin"></i>{{$footer->address}}</a></li>
                <li class="email"><a href="mailto:{{$footer->email}}?subject=subject text">{{$footer->email}}</a></li>
                <li class="phone"><a href="{{$footer->phone}}?subject=subject text">{{$footer->phone}}</a></li>
            </ul>
        </div>
        <div class="subscribe-form">
            <input type="email" placeholder="Nhập Email của bạn">
            <button type="submit">Đăng ký</button>
            <p>Đăng ký để nhận thông báo về sản phẩm hot của chúng tôi.</p>
        </div>
    </div>
    <hr>
    <div class="row-footer">
        <div class="follow-icons">
            <li><span>Theo dõi chúng tôi tại</span></li>
            <li><a href="{{$footer->facebook}}" target="_blank"><i class="bi bi-facebook"></i></a></li>
        </div>
    </div>
    <div class="row-footer">
        <div class="right-dis">Made with <i style="color: red; font-size: 12px;" class="fas fa-heart"></i> by <strong>Meriem Barhoumi</strong></div>
        <div class="left-dis">Copyright <strong>CodePy</strong> © 2021. All the rights are reserved.</div>
    </div>
</footer>
@endif