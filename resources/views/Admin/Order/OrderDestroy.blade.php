@extends('admin')

@section('title', 'Đơn hàng đã hủy')

@section('css')
<link href="/css/Admin/User.css" rel="stylesheet" />
@stop

@section('scripts')
<script src="/js/Admin/User.js" type="text/javascript"></script>
@stop

@section('body')
<section class="Users">
    <h3>Danh sách đơn hàng bị hủy: ({{$count}})</h3>
    <table>
        <thead>
            <tr>
                <th>STT</th>
                <th>Tên sản phẩm</th>
                <th>Số lượng</th>
                <th>Người hủy</th>
                <th>Ngày hủy</th>
            </tr>
        </thead>
        <tbody>
            @foreach($order as $key => $orders)
            <tr id="sid{{$loop->iteration}}">
                <td>{{$loop->iteration}}</td>
                <td>{{$orders->name}}</td>
                <td>{{$orders->quantity}}</td>
                <td>{{$orders->nameUser}}</td>
                <td>{!! date('d/m/Y', strtotime($orders->updated_at)) !!}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
    {{$order->links(("pagination::bootstrap-4"))}}
</section>
@stop