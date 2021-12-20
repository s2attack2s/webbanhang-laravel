@extends('admin')

@section('title', !$data ? __('Thêm mới') : __('Cập nhật'))

@section('css')
<link href="/css/Admin/Product.css" rel="stylesheet" />
@stop

@section('scripts')
<script src="/js/Admin/Product.js" type="text/javascript"></script>
<script>
    function readURL(input) {
        if (input.files && input.files[0]) {

            var reader = new FileReader();

            reader.onload = function(e) {
                $('.image-upload-wrap').hide();
                $('.file-upload-content-data').hide();
                $('.file-upload-image').attr('src', e.target.result);
                $('.file-upload-content').show();

                $('.image-title').html(input.files[0].name);
            };

            reader.readAsDataURL(input.files[0]);

        } else {
            removeUpload();
        }
    }
</script>
@stop

@section('body')
<section class="product">
    <h3>{{!$data ? __('Thêm mới') : __('Cập nhật')}}</h3>
    <form class="form-product" id="form-product" method="post" action="{{!$data ? route('AddProduct') : route('UpdateProduct', ['id' => $data->id])}}" enctype="multipart/form-data">
        @csrf
        @if($errors->any())
        <p class="error">{{$errors->first()}}</p>
        @endif

        <div class="text-field">
                <label for="name">Tên sản phẩm</label>
                <input type="text" name="name" id="name" placeholder="Tên sản phẩm" value="{{isset($data)?$data->name:''}}" />
            </div>

        <div class="form-group-1">
            <div class="file-upload">

                <button class="file-upload-btn" type="button" onclick="$('.file-upload-input').trigger( 'click' )">Add Image</button>

                <div class="image-upload-wrap">
                    <input class="file-upload-input" type='file' name="img" onchange="readURL(this);" accept="image/*" />
                    <img class="file-upload-image" src="https://docs.google.com/uc?id={{isset($data)?$data->img:'#'}}" alt="Chưa có file được chọn" />
                </div>

                <div class="file-upload-content">
                    <img class="file-upload-image" src="https://docs.google.com/uc?id={{isset($data)?$data->img:''}}" alt="#" />
                </div>

            </div>

            <div class="text-field">
                <label for="description">Mô tả</label>
                <textarea name="description" id="description" placeholder="Mô tả" rows="5">{{isset($data)?$data->description:''}}</textarea>
            </div>
        </div>
        <div class="form-group">
            <div class="text-field">
                <label for="quantity">Số lượng</label>
                <input type="text" name="quantity" id="quantity" placeholder="Số lượng" value="{{isset($data)?$data->quantity:''}}" />
            </div>
            <div class="text-field">
                <label for="price">Giá (vnđ)</label>
                <input type="text" name="price" id="price" placeholder="Giá" value="{{isset($data)?$data->price:''}}" />
            </div>
            <div class="text-field">
                <label for="categoryId">Danh mục</label>
                <select name="categoryId" id="categoryId">
                    @foreach($category as $categorys)
                    <option value="{{$categorys->id}}">{{$categorys->name}}</option>
                    @endforeach
                </select>
            </div>
        </div>





        <div class="input-group input-group-outline">
            <button class="btn btn-primary button-product" type="submit" id="submit-product">{{!$data ? __('Thêm mới') : __('Cập nhật')}}</button>
        </div>

    </form>

</section>
@stop