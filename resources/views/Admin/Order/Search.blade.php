<div>

    <table class="table-search">
        <thead>
            <tr>
                <th class="checkbox"><input type="checkbox" id="checkAll" checked /></th>
                <th>STT</th>
                <th>Hình ảnh</th>
                <th>Tên sản phẩm</th>
                <th>Người mua</th>
                <th>Số lượng</th>
                <th>Thành tiền</th>
                <th>Tùy chọn</th>
            </tr>
        </thead>
        <tbody>
            <input type="hidden" name="transaction_id" id="transaction_id" value="{{$data[0]->transaction_id}}" />
                        @foreach($data as $val)
            <tr id="sid{{$loop->iteration}}">
                <td class="checkbox"><input type="checkbox" class="checkItem" name="ids" value="{{$val->id}}" checked /></td>
                <td>{{$loop->iteration}}</td>
                <td>
                    <img src="https://docs.google.com/uc?id={{$val->img}}" />
                </td>
                <td>{{$val->name}}</td>
                <td>{{$val->nameUser}}</td>
                <td>{{$val->quantity}}</td>
                <td>{{number_format($val->total)}} vnđ</td>
                <td>
                    @if($data[0]->status == 0)
                    <a href="{{route('DeleteOrder', ['id' => $val->id])}}">
                        <button class="btn btn-danger">Hủy đơn</button>
                    </a>
                    @elseif($data[0]->status == 1)
                    Đang giao
                    @else
                    Thành công
                    @endif

                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    @if($data[0]->status == 0)
    <h5>Ghi chú :</h5>
    <p>{{$data[0]->message}}</p>
    <p><strong>Tổng tiền :</strong>{{number_format($data[0]->tTotal)}} vnđ</p>
    <p id="total_number" style="display: none">{{$data[0]->tTotal}}</p>
    <p style="text-transform:capitalize;"><i id="add_total"></i></p>
    <button class="btn btn-primary UpdateOrder">Xác nhận đơn hàng</button>
    @elseif($data[0]->status == 1)
    <button class="btn btn-primary deliveryOrder">Xác nhận giao hàng thành công</button>
    @endif
</div>
<script type="text/javascript">
    $(document).ready(function() {
        $(".UpdateOrder").click(function(e) {
            console.log('dã click');
            e.preventDefault();
            var allids = [];
            let transaction_id = $("#transaction_id").val();
            $("input:checkbox[name=ids]:checked").each(function() {
                count = allids.push($(this).val());
            });
            $(".loading-index").css("display", "block");
            $.ajax({
                url: "/admin/update-order",
                type: "get",
                data: {
                    _token: $("#input[name=_token]").val(),
                    ids: allids,
                    transaction_id: transaction_id,
                },
                success: function(response) {
                    $(".loading-index").css("display", "none");

                    alert('Xác nhận thành công');
                    window.location.reload();
                },
                error: function(e) {
                    $(".loading-index").css("display", "none");
                    console.log(e);
                },
            });
        });
        $(".deliveryOrder").click(function(e) {
            console.log('dã click');
            e.preventDefault();
            var allids = [];
            let transaction_id = $("#transaction_id").val();
            $("input:checkbox[name=ids]:checked").each(function() {
                count = allids.push($(this).val());
            });
            $(".loading-index").css("display", "block");
            $.ajax({
                url: "/admin/delivery-order",
                type: "get",
                data: {
                    _token: $("#input[name=_token]").val(),
                    ids: allids,
                    transaction_id: transaction_id,
                },
                success: function(response) {
                    $(".loading-index").css("display", "none");

                    alert('Xác nhận thành công');
                    window.location.reload();
                },
                error: function(e) {
                    $(".loading-index").css("display", "none");
                    console.log(e);
                },
            });
        });
    });
</script>