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
            url: "/admin/deletes-partners",
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

    $("#form-partners").validate({
        rules: {
            name: {
                required: true,
            },
            img: {
                required: true,
            }
           
        },
        messages: {
            name: {
                required: "Vui lòng nhập tên đối tác",
            },
            img: {
                required: "Hình ảnh không được để trống",
            },
           
        },

        submitHandler: function (form) {
            form.submit();
        },
    });
});
