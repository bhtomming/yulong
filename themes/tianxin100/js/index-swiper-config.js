$(document).ready(function () {
    var infoSwiper = new Swiper('.swiper-container',{
        loop: true,
        preventLinksPropagation: true,
        autoplay:{
            delay:4000,
            disableOnInteraction: true
        },
        pagination: {
            el: '.swiper-pagination',
        },
        touchMoveStopPropagation: false,
        //effect: 'flip',
    });
    var infoSwiper1 = new Swiper('.swiper-container1',{
        loop: true,
        preventLinksPropagation: true,
        autoplay:{
            delay:4000,
            disableOnInteraction: true
        },
        touchMoveStopPropagation: false,
        effect: 'flip',
        pagination: {
            el: '.swiper-pagination1',
        }
    });
});