/**
 * Single image carousel
 */
export const single_image_carousel = ($) => {
    const galleryThumbs = new Swiper('.wps-lv-426-woo-gallery-thumbs', {
        spaceBetween: 12,
        slidesPerView: 5,
        freeMode: true,
        watchSlidesVisibility: true,
        watchSlidesProgress: true,
    });
    const galleryTop = new Swiper('.wps-lv-426-woo-gallery-main', {
        spaceBetween: 12,
        navigation: {
            nextEl: '.swiper-button-next',
            prevEl: '.swiper-button-prev',
        },
        thumbs: {
            swiper: galleryThumbs
        }
    });

    $('[data-fancybox="wps-woo-product-gallery"]').fancybox();
}
