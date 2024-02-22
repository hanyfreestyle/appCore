/**
 * Team Slider
 */
const teamSlider = document.querySelector('.team-slider')
if (teamSlider) {
    const teamSliderInit = new Swiper(teamSlider, {
        loop: true,
        slidesPerView: 1,
        spaceBetween: 10,
        pagination: {
            el: '.team-slider__pagination',
            clickable: true
        },
        breakpoints: {
            768: {
                slidesPerView: 3,
                spaceBetween: 10
            },
            992: {
                slidesPerView: 4
            },
            1200: {
                slidesPerView: 5
            },
            1400: {
                slidesPerView: 6,
                spaceBetween: 10
            }
        }
    })
}

/**
 * Discover New Location Slider
 */
const locationSlider = document.querySelector('.location-slider');
if (locationSlider) {
    const locationSliderInit = new Swiper(locationSlider, {
        loop: true,
        slidesPerView: 1,
        spaceBetween: 16,
        centeredSlides: false,
        centeredSlidesBounds: true,
        pagination: {
            el: '.location-slider__pagination',
            type: 'bullets',
            clickable: true
        },
        breakpoints: {
            768: {
                slidesPerView: 2.5
            },
            992: {
                slidesPerView: 3
            },
            1200: {
                slidesPerView: 4
            },
            1400: {
                slidesPerView: 4.5
            }
        }
    })
}

/**
 * blogh-slider
 */
const bloghSlider = document.querySelector('.blog_slider_style')
if (bloghSlider) {
    const teamSliderInit = new Swiper(bloghSlider, {
        loop: true,
        slidesPerView: 1,
        spaceBetween: 16,
        pagination: {

            el: '.blog_slider_style__pagination',
            clickable: true
        },
        breakpoints: {
            768: {
                slidesPerView: 2,
                spaceBetween: 24
            },
            992: {
                slidesPerView: 2
            },
            1200: {
                slidesPerView: 2
            },
            1400: {
                slidesPerView: 2,
                spaceBetween: 24
            }
        }
    })
}

/**
 * Property Gallery Slider
 */
const propertyGallerySlider = document.querySelector('.property-gallery-slider');
if (propertyGallerySlider) {
    new Swiper(propertyGallerySlider, {
        loop: true,
        slidesPerView: 1,
        spaceBetween: 16,
        centeredSlides: true,
        centeredSlidesBounds: true,
        navigation: {
            nextEl: '.property-gallery-slider__btn-next',
            prevEl: '.property-gallery-slider__btn-prev',
        },
        breakpoints: {
            576: {
                slidesPerView: 2.25
            },
            768: {
                slidesPerView: 2.5
            },
            1200: {
                slidesPerView: 3.25
            }
        }
    })
}
