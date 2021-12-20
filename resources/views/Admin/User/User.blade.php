@extends('admin')

@section('title', 'Khách hàng')

@section('css')
<link href="/css/Admin/User.css" rel="stylesheet" />
@stop

@section('scripts')
<script src="/js/Admin/User.js" type="text/javascript"></script>
@stop

@section('body')
<section class="Users">
    <h3>Danh sách Khách hàng: ({{$count}})</h3>
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
            @foreach($user as $key => $users)
            <tr id="sid{{$loop->iteration}}">
                 <td>{{$loop->iteration}}</td>
                <td>{{$users->name}}</td>
                <td>{!! date('d/m/Y', strtotime($users->created_at)) !!}</td>
                <td><a href="{{route('EditRole', ['id' => $users->id])}}" >Cấp quyền</a></td>
            </tr>
            @endforeach
        </tbody>
    </table>
    {{$user->links(("pagination::bootstrap-4"))}}
</section>
@stop