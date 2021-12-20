@extends('admin')

@section('title', !$data ? __('Thêm mới') : __('Cập nhật'))

@section('css')
<link href="/css/Admin/Info.css" rel="stylesheet" />
@stop

@section('scripts')
<script src="/js/Admin/Info.js" type="text/javascript"></script>
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
<section class="info">
    <h3>{{!$data ? __('Thêm mới') : __('Cập nhật')}}</h3>
    <form class="form-info" id="form-info" method="post" action="{{!$data ? route('AddInfo') : route('UpdateInfo', ['id' => $data->id])}}" enctype="multipart/form-data">
        @csrf
        @if($errors->any())
        <p class="error">{{$errors->first()}}</p>
        @endif

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
            <label for="email">Email</label>
            <input type="text" name="email" id="email" placeholder="Email" value="{{isset($data)?$data->email:''}}" />
        </div>

        <div class="text-field">
            <label for="phone">Số điện thoại</label>
            <input type="text" name="phone" id="phone" placeholder="Số điện thoại" value="{{isset($data)?$data->phone:''}}" />
        </div>

        <div class="text-field">
            <label for="address">Địa chỉ</label>
            <input type="text" name="address" id="address" placeholder="Địa chỉ" value="{{isset($data)?$data->address:''}}" />
        </div>

        <div class="text-field">
            <label for="facebook">Facebook</label>
            <input type="text" name="facebook" id="facebook" placeholder="Facebook" value="{{isset($data)?$data->facebook:''}}" />
        </div>






        <div class="input-group input-group-outline">
            <button class="btn btn-primary button-info" type="submit" id="submit-info">{{!$data ? __('Thêm mới') : __('Cập nhật')}}</button>
        </div>

    </form>

</section>
@stop