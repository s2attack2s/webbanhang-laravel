@extends('welcome')

@section('title', 'Danh sách đơn hàng')

@section('css')
<link href="/css/Home/Cart.css" rel="stylesheet" />
@stop

@section('scripts')
<script src="/js/Home/Index.js" type="text/javascript"></script>
<script src="/js/Home/ReadNumber.js" type="text/javascript"></script>
@stop

@section('body')
<section class="cart-section">
    <div class="container">
        <div class="link">
            <a href="{{route('Home')}}"><i class="bi bi-house"></i> <span>Trang chủ</span></a> / <a href="{{route('Cart')}}"> <span>Giỏ hàng</span></a> / <span disabled>Lịch sử mua sắm</span>
        </div>

        <div class="tabs effect-1">
            <!-- tab-title -->
            <input type="radio" id="tab-1" name="tab-effect-1" checked="checked">
            <span>Tất cả</span>

            <input type="radio" id="tab-2" name="tab-effect-1">
            <span>Đang chờ xác nhận</span>

            <input type="radio" id="tab-3" name="tab-effect-1">
            <span>Đang giao hàng</span>

            <input type="radio" id="tab-4" name="tab-effect-1">
            <span>Giao hàng thành công</span>

            <input type="radio" id="tab-5" name="tab-effect-1">
            <span>Đã hủy</span>

            <!-- tab-content -->
            <div class="tab-content">
                <section id="tab-item-1">
                    <div class="cart-layout">
                        <table class="table">
                            <thead class="thead-dark">
                                <tr>
                                    <th class="key none">STT</th>
                                    <th class="img">Hình ảnh</th>
                                    <th class="name">Sản phẩm</th>
                                    <th class="quantity">Số lượng</th>
                                    <th class="total">Thành tiền</th>
                                    <th class="status">Trạng thái</th>
                                    <th class="destroy">Hùy đơn</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($dataAll as $key => $datas)
                                <tr id="sid{{$loop->iteration}}">
                                    <td class="key none">{{$loop->iteration}}</td>
                                    <td class="img"><img src="https://docs.google.com/uc?id={{$datas->img}}"></td>
                                    <td class="name">{{$datas->name}}</td>
                                    <td class="quantity">{{number_format($datas->oQuantity)}}</td>
                                    <td class="total">{{number_format($datas->oTotal)}} vnđ</td>
                                    <td class="status">
                                        @if($datas->oStatus == 0)
                                        @if($datas->tStatus == 0)
                                        <p>Đang chờ xác nhận</p>
                                        @elseif($datas->tStatus == 1)
                                        <p>Đang giao hàng</p>
                                        @else
                                        <p>Giao hàng thành công</p>
                                        @endif
                                        @else
                                        <p>Đã hủy</p>
                                        @endif
                                    </td>
                              
                                    @if($datas->tStatus == 0 && $datas->oStatus == 0)
                                    <td class="destroy"><a href="{{route('DestroyOrder', ['id' => $datas->id])}}"><button class="btn btn-danger"><i class="bi bi-bag-x"></i></button></a></td>
                               @else
                               <td class="destroy"><button class="btn btn-danger" disabled><i class="bi bi-bag-x"></i></button></td>
                               @endif
                                </tr>
                                @endforeach

                            </tbody>
                        </table>
                    </div>
                </section>
                <section id="tab-item-2">
                    <div class="cart-layout">
                        <table class="table">
                            <thead class="thead-dark">
                                <tr>
                                    <th class="key none">STT</th>
                                    <th class="img">Hình ảnh</th>
                                    <th class="name">Sản phẩm</th>
                                    <th class="quantity">Số lượng</th>
                                    <th class="total">Thành tiền</th>
                                    <th class="status">Trạng thái</th>
                                    <th class="destroy">Hùy đơn</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($dataConfirm as $key => $datas)
                                <tr id="sid{{$loop->iteration}}">
                                    <td class="key none">{{$loop->iteration}}</td>
                                    <td class="img"><img src="https://docs.google.com/uc?id={{$datas->img}}"></td>
                                    <td class="name">{{$datas->name}}</td>
                                    <td class="quantity">{{number_format($datas->oQuantity)}}</td>
                                    <td class="total">{{number_format($datas->oTotal)}} vnđ</td>
                                    <td class="status">

                                         @if($datas->oStatus != 2)
                                        @if($datas->tStatus == 0)
                                        <p>Đang chờ xác nhận</p>
                                        @elseif($datas->tStatus == 1)
                                        <p>Đang giao hàng</p>
                                        @else
                                        <p>Giao hàng thành công</p>
                                        @endif
                                        @else
                                        <p>Đã hủy</p>
                                        @endif
                                    </td>
                                    <td class="destroy"><a href="{{route('DestroyOrder', ['id' => $datas->id])}}"><button class="btn btn-danger"><i class="bi bi-bag-x"></i></button></a></td>
                                </tr>
                                @endforeach

                            </tbody>
                        </table>
                    </div>
                </section>
                <section id="tab-item-3">
                    <div class="cart-layout">
                        <table class="table">
                            <thead class="thead-dark">
                                <tr>
                                    <th class="key none">STT</th>
                                    <th class="img">Hình ảnh</th>
                                    <th class="name">Sản phẩm</th>
                                    <th class="quantity">Số lượng</th>
                                    <th class="total">Thành tiền</th>
                                    <th class="status">Trạng thái</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($dataDe as $key => $datas)
                                <tr id="sid{{$loop->iteration}}">
                                    <td class="key none">{{$loop->iteration}}</td>
                                    <td class="img"><img src="https://docs.google.com/uc?id={{$datas->img}}"></td>
                                    <td class="name">{{$datas->name}}</td>
                                    <td class="quantity">{{number_format($datas->oQuantity)}}</td>
                                    <td class="total">{{number_format($datas->oTotal)}} vnđ</td>
                                    <td class="status">
                                        @if($datas->tStatus == 0)
                                        <p>Đang chờ xác nhận</p>
                                        @elseif($datas->tStatus == 1)
                                        <p>Đang giao hàng</p>
                                        @else
                                        <p>Giao hàng thành công</p>
                                        @endif
                                    </td>
                                </tr>
                                @endforeach

                            </tbody>
                        </table>
                    </div>

                </section>
                <section id="tab-item-4">
                    <div class="cart-layout">
                        <table class="table">
                            <thead class="thead-dark">
                                <tr>
                                    <th class="key none">STT</th>
                                    <th class="img">Hình ảnh</th>
                                    <th class="name">Sản phẩm</th>
                                    <th class="quantity">Số lượng</th>
                                    <th class="total">Thành tiền</th>
                                    <th class="status">Trạng thái</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($dataOk as $key => $datas)
                                <tr id="sid{{$loop->iteration}}">
                                    <td class="key none">{{$loop->iteration}}</td>
                                    <td class="img"><img src="https://docs.google.com/uc?id={{$datas->img}}"></td>
                                    <td class="name">{{$datas->name}}</td>
                                    <td class="quantity">{{number_format($datas->oQuantity)}}</td>
                                    <td class="total">{{number_format($datas->oTotal)}} vnđ</td>
                                    <td class="status">
                                        @if($datas->tStatus == 0)
                                        <p>Đang chờ xác nhận</p>
                                        @elseif($datas->tStatus == 1)
                                        <p>Đang giao hàng</p>
                                        @else
                                        <p>Giao hàng thành công</p>
                                        @endif
                                    </td>
                                </tr>
                                @endforeach

                            </tbody>
                        </table>
                    </div>
                </section>
                <section id="tab-item-5">
                <div class="cart-layout">
                        <table class="table">
                            <thead class="thead-dark">
                                <tr>
                                    <th class="key none">STT</th>
                                    <th class="img">Hình ảnh</th>
                                    <th class="name">Sản phẩm</th>
                                    <th class="quantity">Số lượng</th>
                                    <th class="total">Thành tiền</th>
                                    <th class="status">Trạng thái</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($dataDestroy as $key => $datas)
                                <tr id="sid{{$loop->iteration}}">
                                    <td class="key none">{{$loop->iteration}}</td>
                                    <td class="img"><img src="https://docs.google.com/uc?id={{$datas->img}}"></td>
                                    <td class="name">{{$datas->name}}</td>
                                    <td class="quantity">{{number_format($datas->oQuantity)}}</td>
                                    <td class="total">{{number_format($datas->oTotal)}} vnđ</td>
                                    <td class="status">
                                        Đã hủy
                                    </td>
                                </tr>
                                @endforeach

                            </tbody>
                        </table>
                    </div>
                </section>
            </div>
        </div>

    </div>
</section>
@stop