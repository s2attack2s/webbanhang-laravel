@extends('admin')

@section('title', 'Đơn hàng đã hoàn thành')

@section('css')
<link href="/css/Admin/Order.css" rel="stylesheet" />
@stop

@section('scripts')
<script src="/js/Admin/Order.js" type="text/javascript"></script>
@stop

@section('body')
<section class="Users">
    <div id="show-item">
        <h3>Danh sách đơn hàng thành công: ({{$count}})</h3>
        <table>
            <thead>
                <tr>
                    <th>STT</th>
                    <th>Người mua</th>
                    <th>Số điện thoại</th>
                    <th>Địa chỉ</th>
                    <th>Số lượng</th>
                    <th>Ngày mua</th>
                    <th>Xem chi tiết</th>
                </tr>
            </thead>
            <tbody>
                @foreach($order as $key => $orders)
                <tr id="sid{{$loop->iteration}}">
                    <td>{{$loop->iteration}}</td>
                    <td>{{$orders->name}}</td>
                    <td>{{$orders->phone}}</td>
                    <td>{{$orders->address}}</td>
                    <td>{{$orders->quantity}}</td>
                    <td>{!! date('d/m/Y', strtotime($orders->created_at)) !!}</td>
                    <td>
                        <button class="btn btn-primary order-ok" data-id="{{$orders->id}}"> Xem chi tiết</button>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    {{$order->links(("pagination::bootstrap-4"))}}
</section>
@stop