@extends('welcome')

@section('title')
@if($categoryDetail)
{{$categoryDetail->name}}
@endif

@stop

@section('css')
<link href="/css/Home/Product.css" rel="stylesheet" />
@stop

@section('scripts')
<script src="/js/Home/FilterCategory.js" type="text/javascript"></script>

@stop

@section('body')
<section class="product-section">
  <div class="container product-container">
    <div class="link">
      <a href="{{route('Home')}}"><i class="bi bi-house"></i> <span>Trang chủ</span></a> / <a href="{{route('Product')}}"> <span>Sản phẩm</span> </a> / <span>{{$categoryDetail->name}}</span>
    </div>
    @if($product)
    @include('Home.LayoutProduct')
    <div class="paginate-product">
      {{$product->links(("pagination::bootstrap-4"))}}
    </div>
    @endif
    <div class="button-filter">
      <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
        <i class="bi bi-funnel-fill"></i>
      </button>
    </div>
    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Lọc sản phẩm</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <div class="content-category">
              <form class="form-fitter" action="/filter-category" role="search" method="get">
                <div class="group-category-search">
                  <input type="number" name="priceForm" id="priceForm" placeholder="Từ" />
                  <input type="number" name="priceTo" id="priceTo" placeholder="Đến" />
                  <input type="hidden" name="categoryId" id="categoryId" value="{{$categoryDetail->id}}" />
                </div>
                <div class="modal-footer">
            <button type="button" class="btn btn-secondary" id="close" data-dismiss="modal">Đóng</button>
            <button type="submit" class="btn btn-primary" id="filter-search">Áp dụng</button>
          </div>
              </form>
            </div>
          </div>
    
        </div>
      </div>
    </div>
  </div>
</section>
@stop