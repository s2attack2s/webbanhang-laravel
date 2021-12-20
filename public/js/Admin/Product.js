$(document).ready(function () {
    $("#checkAll").click(function () {
        $(".checkItem").prop("checked", this.checked);
    });
    $("#Deletes").click(function (e) {
        e.preventDefault();
        var allids = [];
        $("input:checkbox[name=ids]:checked").each(function () {
            count = allids.push($(this).val());
        });
        $(".loading-index").css("display", "block");
        $.ajax({
            url: "/admin/deletes-product",
            type: "get",
            data: {
                _token: $("#input[name=_token]").val(),
                ids: allids,
            },
            success: function (response) {
                document.getElementById("message-success").innerHTML =
                    "Xóa thành công!";
                setTimeout(function () {
                    document.getElementById("message-success").innerHTML = "";
                }, 4000);
                window.location.reload();
            },
            error: function (e) {},
        });
    });

    $("#form-product").validate({
        rules: {
            name: {
                required: true,
            },
            img: {
                required: true,
            },
            price: {
                required: true,
                number: true,
                min: 1,
            },
            quantity: {
                required: true,
                number: true,
                min: 1,
            },
             description: {
                required: true,
            },
        },
        messages: {
            name: {
                required: "Vui lòng nhập tên sản phẩm",
            },
            img: {
                required: "Hình ảnh không được để trống",
            },
            price: {
                required: "Vui lòng nhập giá sản phẩm",
                number: "Giá phải là kiểu số",
                min: "Giá tiền vui lòng lớn hơn 0",
            },
            quantity: {
                required: "Vui lòng nhập số lượng",
                number: "Số lượng phải là kiểu số",
                min: "Số lượng nhập vào phải lớn hơn 0",
            },
             description: {
                required: "Vui lòng mô tả về sản phẩm",
            },
        },

        submitHandler: function (form) {
            form.submit();
        },
    });
});
