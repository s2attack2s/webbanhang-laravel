@extends('admin')

@section('title', 'Danh mục')

@section('css')
<link href="/css/Admin/Info.css" rel="stylesheet" />
@stop

@section('scripts')
<script src="/js/Admin/Info.js" type="text/javascript"></script>
@stop

@section('body')
<section class="Info">
    <h3>Thông tin</h3>
      <table>
        <thead>
            <tr>
                <th>Hình ảnh</th>
                <th>Email</th>
                <th>Số điện thoại</th>

                <th>Tùy chọn</th>
            </tr>
        </thead>
        <tbody>
            @foreach($footer as $key => $footers)
            <tr id="sid{{$loop->iteration}}">
                <td><img src="https://docs.google.com/uc?id={{$footers->img}}" ></td>
                <td>{{$footers->email}}</td>
                <td>{{$footers->phone}}</td>
                <td>
                    <a href="{{route('ViewEditInfo', ['id' => $footers->id])}}">
                        <button class="btn btn-primary">Sửa</button>
                    </a>
                    <a href="{{route('Delete', ['id' => $footers->id])}}">
                        <button class="btn btn-danger">Xóa</button>
                    </a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</section>
@stop