@extends('welcome')

@section('title')
{{$productDetail->name}}
@stop

@section('css')
<link href="/css/Home/ProductDetails.css" rel="stylesheet" />
@stop

@section('scripts')
<script src="/js/Home/ProductDetails.js" type="text/javascript"></script>
@stop

@section('body')
<section class="product-details">
    <div class="container">
        <div class="link">
            <a href="{{route('Home')}}"><i class="bi bi-house"></i> <span>Trang chủ</span></a> / <a href="{{route('Product')}}"><span>Sản phẩm</span> </a> / <span disabled>Sản phẩm chi tiết</span> / <span> {{$productDetail->name}}</span>
        </div>
        @if($productDetail)
        <section id="services" class="services section-bg">
            <div class="container-fluid">
               
                <div class="row row-sm item">
                    <div class="col-md-6 _boxzoom">

                        <div class="_product-images">
                            <div class="picZoomer">
                                <img class="my_img" src="https://docs.google.com/uc?id={{$productDetail->img}}" alt="{{$productDetail->name}}">
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="_product-detail-content">
                            <p class="_p-name"> {{$productDetail->name}} </p>
                            <div class="_p-price-box">
                                <div class="p-list">
                                    <span class="price"> $ {{$productDetail->price}} </span>
                                </div>
                                <div class="_p-add-cart">
                                    <div class="_p-qty">
                                        <span>Mô tả</span>
                                        <div class="quantity-input">
                                        {!! $productDetail->description !!}
                                            </div>
                                        </div>
                                    </div>
                     
                                    <ul class="spe_ul"></ul>
                                    <div class="_p-qty-and-cart">
                                        <div class="_p-add-cart">
                                            <button class="btn-theme btn buy-btn"  tabindex="0">
                                                Mua ngay
                                            </button>
                                            <button class="btn-theme btn btn-success text-flicker add-to-cart" tabindex="0" data-id="{{$productDetail->id}}">
                                              <i class="bi bi-cart-plus"></i>
                                                    Thêm vào giỏ hàng
                                            </button>
                                         
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
          
                <div class="tabs effect-3">
                    <!-- tab-title -->
                    <input type="radio" id="tab-1" name="tab-effect-3" checked="checked">
                    <span>Chi tiết</span>

                    <input type="radio" id="tab-2" name="tab-effect-3">
                    <span>Đánh giá</span>

                    <div class="line ease"></div>

                    <!-- tab-content -->
                    <div class="tab-content">
                        <section id="tab-item-1">
                            {!! $productDetail->description !!}
                        </section>
                        <section id="tab-item-2">
                            <h1>Two</h1>
                        </section>

                    </div>
                </div>
        </section>
        @endif
        @if($product)
        <div class="product-related">
            <div class="title"> <i class="bi bi-star"></i> Sản phẩm tương tự</div>
            <div class="content">
                @foreach($product as $products)
                <div class="card">
                    <img src="https://docs.google.com/uc?id={{$products->img}}" alt="{{$products->name}}" />
                    <div class="card-body">
                        <div class="row">
                            <div class="card-title">
                                <h4>{{$products->name}}</h4>
                                <h3>${{$products->price}}</h3>
                            </div>
                            <div class="view-btn">
                                <a href="{{route('ProductDetails', ['id' => $products->id])}}"><i class="bi bi-eye"></i></a>
                            </div>
                        </div>
                        <hr />
                        <p>
                            {!! $products->description !!}
                        </p>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
        @endif
    </div>
</section>

@stop