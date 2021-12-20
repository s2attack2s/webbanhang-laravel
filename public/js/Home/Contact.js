$(document).ready(function () {
    $("#submit-contact").click(function (e) {
        $(".loading-index").css("display", "block");
        e.preventDefault();
        $.ajaxSetup({
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
        });
        let data = $("form").serialize();
        $.ajax({
            type: "post",
            url: "post-contact",
            data: data,
            success: function (data) {
                $(".loading-index").css("display", "none");
                $(".alert-contact-success").css("display", "block");
                $(".alert-contact-success").fadeOut(8000);
            },
            error: function (e) {
                $(".loading-index").css("display", "none");
                $(".alert-contact-error").css("display", "block");
                $(".alert-contact-error").fadeOut(8000);
            },
        });
    });
});
