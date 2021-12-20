@extends('welcome')

@section('title', 'Trang chủ')

@section('css')
<link href="/css/Home/Index.css" rel="stylesheet" />
@stop

@section('scripts')
<script src="/js/Home/Index.js" type="text/javascript"></script>

@stop

@section('body')
@include('Home.Slider')
<section class="index-section">
    <div class="index-product-hot">
        <div class="container index-container">
            @if($productNew)
            <div class="title">
                <i class="bi bi-tags"></i>
                <p>Sản phẩm mới nhất</p>
                <img src="/img/hot.webp" />
            </div>
            <div class="product-hot">

                @foreach($productNew as $productNews)
                <div class="card">
                    <a href="{{route('ProductDetails', ['id' => $productNews->id])}}">

                        <img src="https://docs.google.com/uc?id={{$productNews->img}}" alt="{{$productNews->name}}" />
                        <div class="card-body">
                            <div class="row">
                                <div class="card-title">
                                    <h4>{{$productNews->name}}</h4>
                                    <h3>${{number_format($productNews->price)}}</h3>
                                </div>
                            </div>
                            <hr />
                            <p class="description">
                                {!! $productNews->description !!}
                            </p>
                        </div>
                    </a>
                </div>

                @endforeach

            </div>
            @endif
        </div>

    </div>
    <div class="container index-product">
        @include('Home.LayoutProduct')
        @if($product)
        <a href="{{route('Product')}}"> <button class="btn btn-primary">Xem thêm</button></a>
        @endif
    </div>
</section>
@stop