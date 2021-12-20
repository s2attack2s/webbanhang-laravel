@extends('admin')

@section('title', 'Quản trị viên')

@section('css')
<link href="/css/Admin/User.css" rel="stylesheet" />
@stop

@section('scripts')
<script src="/js/Admin/User.js" type="text/javascript"></script>
@stop

@section('body')
<section class="Users">
    <h3>Danh sách quản trị viên: ({{$count}})</h3>
    <table>
        <thead>
            <tr>
                <th>STT</th>
                <th>Họ tên</th>
                <th>Ngày đăng ký</th>
                <th>Tùy chọn</th>
            </tr>
        </thead>
        <tbody>
            @foreach($admin as $key => $admins)
            <tr id="sid{{$loop->iteration}}">
                 <td>{{$loop->iteration}}</td>
                <td>{{$admins->name}}</td>
                <td>{!! date('d/m/Y', strtotime($admins->created_at)) !!}</td>
                <td><a href="{{route('DeleteRole', ['id' => $admins->id])}}" >Xóa quyền truy cập</a></td>
            </tr>
            @endforeach
        </tbody>
    </table>
    {{$admin->links(("pagination::bootstrap-4"))}}
</section>
@stop