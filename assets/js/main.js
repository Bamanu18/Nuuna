//ketika tombol btn-menu di klik
const navbarMenu = document.querySelector('.navbar-menu');
document.querySelector('#btn-menu').onclick = () =>{
    navbarMenu.classList.toggle('active');
};

//menu navbar ketika klik di luar menu sidebar maka menu sidebar ketutup
const btnMenu = document.querySelector('#btn-menu');
document.addEventListener('click', function(e){
    if(!btnMenu.contains(e.target) && !navbarMenu.contains(e.target)){
        navbarMenu.classList.remove('active');
    }
});

//menu login & logout ketika klik icon user
const btnUser = document.querySelector('.user');
document.querySelector('#btn-user').onclick = (e) =>{
    btnUser.classList.toggle('active');
    e.preventDefault();
};

// search form
const searchForm = document.querySelector('.search-form');
const searchBox = document.querySelector('#search-box');
document.querySelector('#btn-search').onclick = (e) => {
    searchForm.classList.toggle('active');
    searchBox.focus();
    e.preventDefault();
}

// owl-carousel
$(document).ready(function(){
    $('.hero .owl-carousel').owlCarousel({
        autoplay: true,
        nav: true,
        loop: true,
        dots: false,
        inifinite: true,
        speed: 4000,
        autoplaySpeed: 2500,
        slideToShow: 1,
        items: 1,
        navText: [
            "<i class='fas fa-angle-left'></i>",
            "<i class='fas fa-angle-right'></i>"
        ],
        navContainer: "#owl-nav"
    });
});

// owl-carousel detail-produk
$(document).ready(function(){
    $('.detail-produk .owl-carousel').owlCarousel({
        nav: true,
        loop: true,
        dots: true,
        inifinite: true,
        speed: 4000,
        slideToShow: 1,
        items: 1,
        navText: [
            "<i class='fas fa-angle-left'></i>",
            "<i class='fas fa-angle-right'></i>"
        ],
        navContainer: "#owl-nav"
    });
});

// pagination
function getPageList(totalPage, page, maxLength){
    function rage(start, end){
        return Array.from(Array(end - start +1), (_, i) => i + start);
    }

    var sideWidth = maxLength <9 ? 1 : 2;
    var leftWidth = (maxLength - sideWidth * 2 - 3) >> 1;
    var rightWidth = (maxLength - sideWidth * 2 - 3) >> 1;


    if(totalPage <= maxLength){
        return rage(1, totalPage);
    }

    if(page <= maxLength - sideWidth -1 - rightWidth){
        return rage(1, maxLength - sideWidth -1).concat(0,
            rage(totalPage - sideWidth + 1, totalPage));
    }

    if(page >= totalPage - sideWidth - 1 - rightWidth){
        return rage(1, sideWidth).concat(0,
            rage(totalPage -sideWidth -1 - rightWidth - leftWidth,totalPage));
    }

    return rage(1, sideWidth).concat(0,
        rage(page - leftWidth, page + rightWidth),0,
        rage(totalPage - sideWidth + 1, totalPage));
}

$(function(){
    var numberOfItems = $(".card-produk .card").length;
    var limitPerPage = 6; //jumlah produk di dalam halaman produk
    var totalPage = Math.ceil(numberOfItems / limitPerPage);
    var paginationSize = 5; //jumlah angka di dalam pagination
    var currentPage;

    function showPage(whichPage){
        if(whichPage < 1 || whichPage > totalPage) return false;
        currentPage = whichPage;

        $(".card-produk .card").hide().slice((currentPage - 1)*limitPerPage,
    currentPage*limitPerPage).show();

    $(".pagination li").slice(1, -1).remove();

    getPageList(totalPage,currentPage,paginationSize).forEach(item => {
        $("<li>").addClass("page-item").addClass(item ? "halaman" : "dots")
        .toggleClass("active", item === currentPage)
        .append(

            $("<a>").addClass("page-link").attr({href: "javascript:void(0)"})
        .text(item || "...")).insertBefore(".next");
    });

        $("prev").toggleClass("disabled", currentPage === 1);
        $("prev").toggleClass("disabled", currentPage === totalPage);
        return true
    };

    $(".pagination").append(
        $("<li>").addClass("page-item").addClass("prev")
        .append($("<a>").addClass("page-link").attr({            
            href: "javascript:void(0)"}).text("prev")),

        $("<li>").addClass("page-item").addClass("next")
        .append($("<a>").addClass("page-link").attr({            
            href: "javascript:void(0)"}).text("next")),
        );

    $(".card-produk").show();
    showPage(1);

    $(document).on("click", ".pagination li.halaman:not(.active)",function(){
        return showPage(+$(this).text());
    });

    $(".next").on("click", function(){
        return showPage(currentPage + 1 );
    });
    
    $(".prev").on("click", function(){
        return showPage(currentPage - 1 );
    });
});

