@extends('welcome')

@section('title', 'Giỏ hàng')

@section('css')
<link href="/css/Home/Cart.css" rel="stylesheet" />
@stop

@section('scripts')
<script src="/js/Home/Index.js" type="text/javascript"></script>
<script src="/js/Home/ReadNumber.js" type="text/javascript"></script>
@stop

@section('body')
<section class="cart-section">
    <div class="container">
        <div class="link">
            <a href="{{route('Home')}}"><i class="bi bi-house"></i> <span>Trang chủ</span></a> / <span disabled>Giỏ hàng</span>
            @if(Auth::check())
         <a href="{{route('HistoryOrder')}}" >  <button class="btn btn-primary history-order">Danh sách đơn hàng</button></a>
            @endif
        </div>
        <div class="cart-layout">
            @if($listSP)
            <div class="cart-info" id="cartInfo">
                @php
                $tongTien = 0;
                @endphp
                @foreach($listSP as $key => $listSPs)
                <div class="cart-items">
                    <a href="{{route('RemoveCart', ['id' => $listSPs->id])}}"> <i class="bi bi-dash-circle"></i></a>

                    <div class="item ">
                        <div class="img">
                            <img src="https://docs.google.com/uc?id={{$listSPs->img}}" alt="{{$listSPs->name}}" />
                            <p class="title">{{$listSPs->name}}</p>
                            <p class="price">
                                <strong>{{number_format($listSPs->price)}} ₫</strong>
                            </p>
                            <div class="number">
                                <label>Số lượng</label>
                                <div class="control">
                                    @php
                                    $thanhTien = $listSPs->price * $cart[$listSPs->id];
                                    $tongTien += $thanhTien;
                                    @endphp
                                    <form action="{{route('UpdateCart', ['id' => $listSPs->id])}}" method="post">
                                        @csrf
                                        <input type="hidden" name="id" value="{{$listSPs->id}}" />
                                        <input type="text" name="quantity" value="{{$cart[$listSPs->id]}}" />
                                        <button type="submit" class="btn btn-primary">Cập nhật</button>
                                    </form>
                                </div>
                            </div>
                        </div>


                    </div>


                </div>
                @endforeach

                <div class="cart-total">
                    <p>Tổng tiền: <strong class="price"> {{number_format($tongTien)}} ₫</strong> </p>
                  <p id="price_number" style="display: none;">{{$tongTien}}</p>
                    <p><i id="add_number"></i></p>

                </div>

            </div>


            <div class="cart-form">
                <p>Thông tin đặt hàng</p>
                <form method="post" action="{{route('Order')}}">
                    @csrf
                    <div class="text-field">
                        <label for="name">Họ tên</label>
                        <input autocomplete="off" type="text" name="name" id="name" placeholder="Enter your username" />
                    </div>

                    <div class="text-field">
                        <label for="phone">Số điện thoại</label>
                        <input autocomplete="off" type="text" name="phone" id="phone" placeholder="Enter your username" />
                    </div>

                    <div class="text-field">
                        <label for="address">Địa chỉ</label>
                        <input autocomplete="off" type="text" name="address" id="address" placeholder="Enter your username" />
                    </div>
               
                    <div class="text-field">
                        <label for="message">Ghi chú</label>
                        <textarea autocomplete="off" type="text" name="message" id="message" placeholder="Enter your username" rows="5"></textarea>
                    </div>
                    <button type="submit" class="btn btn-primary">Đặt hàng</button>
                </form>

            </div>
            @else
            <div class="cart-empty">
                <p> Giỏ hàng trống</p>
             <a href="{{route('Product')}}"  > <button class="btn btn-primary">Mua Hàng</button></a>
            </div>
            @endif
        </div>
    </div>
</section>
@stop