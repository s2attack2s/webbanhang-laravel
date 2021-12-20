<section class="free-ship-section">
    <div class="container">
        <div class="title"> <i class="bi bi-star"></i> Đối tác</div>
        <div class="tabs7 free-ship">
         
            @foreach($partner as $partners)
            <img src="https://docs.google.com/uc?id={{$partners->img}}" alt="{{$partners->name}}">
            @endforeach
       
        </div>
        </div>
        <div class="content-free-ship">
            <div>
                <h2>Miễn phí vận chuyển</h2>
                <hr>
                <p>cho đơn hàng trên 500k</p>
                <hr>
                <h2>Áp dụng trên toàn quốc</h2>
            </div>

     
    </div>
</section>