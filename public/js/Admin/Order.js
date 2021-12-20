$(document).ready(function () {
  
    $(".order-popup").click(function (e) {
        e.preventDefault();
        var ele = $(this);
        $(".loading-index").css("display", "block");
            $.ajax({
                url: "/admin/get-order-confirm/" + ele.attr("data-id"),
                method: "get",
                data: { id: ele.attr("data-id")},
                success: function (response) {
                   $("#show-item").html(response);
                   var DOCSO=function(){var t=["không","một","hai","ba","bốn","năm","sáu","bảy","tám","chín"],r=function(r,n){var o="",a=Math.floor(r/10),e=r%10;return a>1?(o=" "+t[a]+" mươi",1==e&&(o+=" mốt")):1==a?(o=" mười",1==e&&(o+=" một")):n&&e>0&&(o=" lẻ"),5==e&&a>=1?o+=" lăm":4==e&&a>=1?o+=" tư":(e>1||1==e&&0==a)&&(o+=" "+t[e]),o},n=function(n,o){var a="",e=Math.floor(n/100),n=n%100;return o||e>0?(a=" "+t[e]+" trăm",a+=r(n,!0)):a=r(n,!1),a},o=function(t,r){var o="",a=Math.floor(t/1e6),t=t%1e6;a>0&&(o=n(a,r)+" triệu",r=!0);var e=Math.floor(t/1e3),t=t%1e3;return e>0&&(o+=n(e,r)+" ngàn",r=!0),t>0&&(o+=n(t,r)),o};return{doc:function(r){if(0==r)return t[0];var n="",a="";do ty=r%1e9,r=Math.floor(r/1e9),n=r>0?o(ty,!0)+a+n:o(ty,!1)+a+n,a=" tỷ";while(r>0);return n.trim()}}}();

                   var number_read = $('#total_number').text();
                   $('#add_total').append(DOCSO.doc(number_read));
                   $("#checkAll").click(function () {
                    $(".checkItem").prop("checked", this.checked);
                });
                  
                   $(".loading-index").css("display", "none");
                },
                error: function(e){
                    $(".loading-index").css("display", "none");
                }
            });

    });
  
    $(".order-delivery").click(function (e) {
        e.preventDefault();
        var ele = $(this);
        $(".loading-index").css("display", "block");
            $.ajax({
                url: "/admin/get-order-delivery/" + ele.attr("data-id"),
                method: "get",
                data: { id: ele.attr("data-id")},
                success: function (response) {
                   $("#show-item").html(response);
                   var DOCSO=function(){var t=["không","một","hai","ba","bốn","năm","sáu","bảy","tám","chín"],r=function(r,n){var o="",a=Math.floor(r/10),e=r%10;return a>1?(o=" "+t[a]+" mươi",1==e&&(o+=" mốt")):1==a?(o=" mười",1==e&&(o+=" một")):n&&e>0&&(o=" lẻ"),5==e&&a>=1?o+=" lăm":4==e&&a>=1?o+=" tư":(e>1||1==e&&0==a)&&(o+=" "+t[e]),o},n=function(n,o){var a="",e=Math.floor(n/100),n=n%100;return o||e>0?(a=" "+t[e]+" trăm",a+=r(n,!0)):a=r(n,!1),a},o=function(t,r){var o="",a=Math.floor(t/1e6),t=t%1e6;a>0&&(o=n(a,r)+" triệu",r=!0);var e=Math.floor(t/1e3),t=t%1e3;return e>0&&(o+=n(e,r)+" ngàn",r=!0),t>0&&(o+=n(t,r)),o};return{doc:function(r){if(0==r)return t[0];var n="",a="";do ty=r%1e9,r=Math.floor(r/1e9),n=r>0?o(ty,!0)+a+n:o(ty,!1)+a+n,a=" tỷ";while(r>0);return n.trim()}}}();

                   var number_read = $('#total_number').text();
                   $('#add_total').append(DOCSO.doc(number_read));
                   $("#checkAll").click(function () {
                    $(".checkItem").prop("checked", this.checked);
                });
                  
                   $(".loading-index").css("display", "none");
                },
                error: function(e){
                    $(".loading-index").css("display", "none");
                }
            });

    });
    $(".order-ok").click(function (e) {
        e.preventDefault();
        var ele = $(this);
        $(".loading-index").css("display", "block");
            $.ajax({
                url: "/admin/get-order-success/" + ele.attr("data-id"),
                method: "get",
                data: { id: ele.attr("data-id")},
                success: function (response) {
                   $("#show-item").html(response);
                   var DOCSO=function(){var t=["không","một","hai","ba","bốn","năm","sáu","bảy","tám","chín"],r=function(r,n){var o="",a=Math.floor(r/10),e=r%10;return a>1?(o=" "+t[a]+" mươi",1==e&&(o+=" mốt")):1==a?(o=" mười",1==e&&(o+=" một")):n&&e>0&&(o=" lẻ"),5==e&&a>=1?o+=" lăm":4==e&&a>=1?o+=" tư":(e>1||1==e&&0==a)&&(o+=" "+t[e]),o},n=function(n,o){var a="",e=Math.floor(n/100),n=n%100;return o||e>0?(a=" "+t[e]+" trăm",a+=r(n,!0)):a=r(n,!1),a},o=function(t,r){var o="",a=Math.floor(t/1e6),t=t%1e6;a>0&&(o=n(a,r)+" triệu",r=!0);var e=Math.floor(t/1e3),t=t%1e3;return e>0&&(o+=n(e,r)+" ngàn",r=!0),t>0&&(o+=n(t,r)),o};return{doc:function(r){if(0==r)return t[0];var n="",a="";do ty=r%1e9,r=Math.floor(r/1e9),n=r>0?o(ty,!0)+a+n:o(ty,!1)+a+n,a=" tỷ";while(r>0);return n.trim()}}}();

                   var number_read = $('#total_number').text();
                   $('#add_total').append(DOCSO.doc(number_read));
                   $("#checkAll").click(function () {
                    $(".checkItem").prop("checked", this.checked);
                });
                  
                   $(".loading-index").css("display", "none");
                },
                error: function(e){
                    $(".loading-index").css("display", "none");
                }
            });

    });
});
