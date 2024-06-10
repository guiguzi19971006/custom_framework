$(function () {
    var navbarUserAreaDropDownHtmlStr = '';

    if (isUserLogin()) {
        navbarUserAreaDropDownHtmlStr += '<li><a href="#" class="dropdown-item">購物車</a></li>';
        navbarUserAreaDropDownHtmlStr += '<li><a href="#" class="dropdown-item">優惠券</a></li>';
        navbarUserAreaDropDownHtmlStr += '<li><a href="#" class="dropdown-item">訂單查詢</a></li>';
    } else {
        navbarUserAreaDropDownHtmlStr += '<li><a href="/users/register" class="dropdown-item">會員註冊</a></li>';
    }

    $('nav ul.dropdown-menu').html(navbarUserAreaDropDownHtmlStr);
});