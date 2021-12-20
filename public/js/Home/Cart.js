$(document).ready(function () {
 $(".add-to-cart").click(function (e) {
            e.preventDefault();
            var ele = $(this);
          
                $.ajax({
                    url: "/add-cart/" + ele.attr("data-id"),
                    method: "get",
                    data: { id: ele.attr("data-id")},
                    success: function (response) {
                        $(".alert-cart-success").css("display", "block");
                        $(".alert-cart-success").fadeOut(8000);
                        window.location.reload();
                    }
                });

        });

    });