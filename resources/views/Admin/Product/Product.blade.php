@extends('admin')

@section('title', 'Danh mục')

@section('css')
<link href="/css/Admin/Product.css" rel="stylesheet" />
@stop

@section('scripts')
<script src="/js/Admin/Product.js" type="text/javascript"></script>
@stop

@section('body')
<section class="product">
    <h3>Danh sách sản phẩm: ({{$count}})</h3>
    <button class="btn btn-danger Deletes" id="Deletes">Xóa nhiều</button>
    <p id="message-success"></p>
    <table>
        <thead>
            <tr>
                <th class="checkbox"><input type="checkbox" id="checkAll" /></th>
                <th>STT</th>
                <th>Hình ảnh</th>
                <th>Tên</th>
                <th>Số lượng kho</th>
                <th>Giá</th>
                <th>Ngày tạo</th>
                <th>Tùy chọn</th>
            </tr>
        </thead>
        <tbody>
            @foreach($product as $key => $products)
            <tr id="sid{{$loop->iteration}}">
                <td class="checkbox"><input type="checkbox" class="checkItem" name="ids" value="{{$products->id}}" /></td>
                <td>{{$loop->iteration}}</td>
                <td><img src="https://docs.google.com/uc?id={{$products->img}}" ></td>
                <td>{{$products->name}}</td>
                <td>{{$products->quantity}}</td>
                <td>{{number_format($products->price)}} vnđ</td>
                <td> {!! date('d/m/Y', strtotime($products->created_at)) !!}</td>
                <td>
                    <a href="{{route('ViewEditProduct', ['id' => $products->id])}}">
                        <button class="btn btn-primary">Sửa</button>
                    </a>
                    <a href="{{route('Delete', ['id' => $products->id])}}">
                        <button class="btn btn-danger">Xóa</button>
                    </a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    {{$product->links(("pagination::bootstrap-4"))}}
</section>
@stop