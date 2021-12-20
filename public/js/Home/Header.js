$(document).ready(function () {
    window.addEventListener("load", function () {
        const menuToggle = document.querySelector(".menu-toggle");
        const menuChild = document.querySelectorAll(".has-child > a");
        menuChild?.forEach((el) =>
            el.addEventListener("click", function (e) {
                e.preventDefault();
                const subMenu =
                    e.target?.nextElementSibling?.classList.toggle("show");
            })
        );
        menuToggle?.addEventListener("click", function () {
            const menu = document.querySelector(".menu");
            menu.classList.toggle("show");
        });
    });

  // dùng sự kiện cuộn chuột để bắt thông tin đã cuộn được chiều dài là bao nhiêu.
    $(window).scroll(function(){
    // Nếu cuộn được hơn 150px rồi
        if($(this).scrollTop()>75){
      // Tiến hành show menu ra  
      $("#menu-header").css('width', '100%'); 
      $("#menu-header").css('position', 'fixed');
      $("#menu-header").css('top', '0');
      $("#menu-header").css('z-index', '10');
    $(".scrollTop").css('display', 'block');
        }else{
            $("#menu-header").css('width', '100%'); 
            $("#menu-header").css('position', 'relative');
            $("#menu-header").css('top', 'none');
            $(".scrollTop").css('display', 'none');
        }}
     
    )
    $(".scrollTop").click(function(){
        $("html, body").animate({scrollTop: 0}, 400);
    })
    $(".icon-menu").click(function(){
        $("#show-menu-mobile").toggleClass('show-menu-mobile')
    })
});
