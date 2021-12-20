<div class="product-all-product">
    <div class="product-product-menu">
        <div class="tabs7 product-tabs7">
            @foreach($category as $key => $categorys)
            <div class="tab-item">
                <a href="{{route('SearchCategory', ['id' => $categorys->id])}}"> {{$categorys->name}}</a>
            </div>
            @endforeach
        </div>
    </div>
    <div class="product-product-detail" id="list-searchProduct">
        @foreach($product as $products)
        @if($products->id != null)

        <div class="card item">

            <img src="https://docs.google.com/uc?id={{$products->img}}" alt="{{$products->name}}" />
            <div class="card-body">
                <div class="row">
                    <div class="card-title">
                        <h4>{{$products->name}}</h4>
                        <h3>${{number_format($products->price)}}</h3>
                    </div>
                </div>
                <hr />
                <p class="description">
                    {!! $products->description !!}
                </p>
                <button class="btn-theme btn btn-success text-flicker add-to-cart" tabindex="0" data-id="{{$products->id}}">
                                              <i class="bi bi-cart-plus"></i>
                                                    Thêm vào giỏ hàng
                                            </button>
            </div>

        </div>

        @else
        <div class="not-search-product">
            <p>
                <strong>Danh mục này hiện tại đang trống</strong>
            </p>
        </div>
        @endif
        @endforeach

    </div>
</div>