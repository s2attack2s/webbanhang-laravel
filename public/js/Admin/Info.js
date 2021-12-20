$(document).ready(function () {
    $("#checkAll").click(function () {
        $(".checkItem").prop("checked", this.checked);
    });

    $("#form-info").validate({
        rules: {
            img: {
                required: true,
            },
            email: {
                required: true,
                email: true,
            },
            phone: {
                required: true,
                number: true,
            },
             address: {
                required: true,
            },
            facebook: {
                url: true,
            },
        },
        messages: {
            img: {
                required: "Hình ảnh không được để trống",
            },
            email: {
                required: "Vui lòng nhập Email",
                email: "Email không đúng định dạng",

            },
            phone: {
                required: "Vui lòng nhập số điện thoại",
                number: "Số điện thoại phải là kiểu số",
    
            },
            address: {
                required: "Vui lòng địa chỉ",
            },
            facebook: {
             
                url: "Url không hợp lệ",
            },
        },

        submitHandler: function (form) {
            form.submit();
        },
    });
});
