@extends('admin')

@section('title', !$data ? __('Thêm mới') : __('Cập nhật'))

@section('css')
<link href="/css/Admin/Partners.css" rel="stylesheet" />
@stop

@section('scripts')
<script src="/js/Admin/Partners.js" type="text/javascript"></script>
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
<section class="partners">
    <h3>{{!$data ? __('Thêm mới') : __('Cập nhật')}}</h3>
    <form class="form-partners" id="form-partners" method="post" action="{{!$data ? route('AddPartners') : route('UpdatePartners', ['id' => $data->id])}}" enctype="multipart/form-data">
        @csrf
        @if($errors->any())
        <p class="error">{{$errors->first()}}</p>
        @endif


        <div class="text-field">
            <label for="name">Tên đối tác</label>
            <input type="text" name="name" id="name" placeholder="Tên đối tác" value="{{isset($data)?$data->name:''}}" />
        </div>

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







        <div class="input-group input-group-outline">
            <button class="btn btn-primary button-partners" type="submit" id="submit-partners">{{!$data ? __('Thêm mới') : __('Cập nhật')}}</button>
        </div>

    </form>

</section>
@stop