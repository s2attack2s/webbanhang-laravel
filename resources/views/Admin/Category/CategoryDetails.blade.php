@extends('admin')

@section('title', !$data ? __('Thêm mới') : __('Cập nhật'))

@section('css')
<link href="/css/Admin/Cate.css" rel="stylesheet" />
@stop

@section('scripts')
<script src="/js/Admin/Cate.js" type="text/javascript"></script>
@stop

@section('body')
<section class="category">
    <h3>{{!$data ? __('Thêm mới') : __('Cập nhật')}}</h3>
    <form class="form-cate" id="form-cate" method="post" action="{{!$data ? route('AddCate') : route('UpdateCate', ['id' => $data->id])}}">
        @csrf
        @if($errors->any())
            <p class="error">{{$errors->first()}}</p>
            @endif
            <div class="text-field">
          <label for="name">Tên danh mục</label>
          <input autocomplete="off" type="text" name="name" id="name" placeholder="Tên danh mục" value="{{isset($data)?$data->name:''}}"/>
        </div>

        <div class="input-group input-group-outline">
            <button class="btn btn-primary button-cate" type="submit" id="submit-cate">{{!$data ? __('Thêm mới') : __('Cập nhật')}}</button>
        </div>

    </form>

</section>
@stop