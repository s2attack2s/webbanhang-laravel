@extends('admin')

@section('title', 'Đối tác')

@section('css')
<link href="/css/Admin/Partners.css" rel="stylesheet" />
@stop

@section('scripts')
<script src="/js/Admin/Partners.js" type="text/javascript"></script>
@stop

@section('body')
<section class="Partners">
    <h3>Danh sách đối tác: ({{$count}})</h3>
    <button class="btn btn-danger Deletes" id="Deletes">Xóa nhiều</button>
    <p id="message-success"></p>
    <table>
        <thead>
            <tr>
                <th class="checkbox"><input type="checkbox" id="checkAll" /></th>
                <th>STT</th>
                <th>Hình ảnh</th>
                <th>Đối tác</th>
                <th>Tùy chọn</th>
            </tr>
        </thead>
        <tbody>
            @foreach($partners as $key => $partner)
            <tr id="sid{{$loop->iteration}}">
                <td class="checkbox"><input type="checkbox" class="checkItem" name="ids" value="{{$partner->id}}" /></td>
                <td>{{$loop->iteration}}</td>
                <td><img src="https://docs.google.com/uc?id={{$partner->img}}"></td>
                <td>{{$partner->name}}</td>
                <td>
                    <a href="{{route('ViewEditPartners', ['id' => $partner->id])}}">
                        <button class="btn btn-primary">Sửa</button>
                    </a>
                    <a href="{{route('Delete', ['id' => $partner->id])}}">
                        <button class="btn btn-danger">Xóa</button>
                    </a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    {{$partners->links(("pagination::bootstrap-4"))}}
</section>
@stop