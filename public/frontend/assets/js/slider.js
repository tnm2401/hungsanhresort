$('#sliderBanner').owlCarousel({
    loop: true,
    nav: true,
    dots: true,
	autoplay:true,
    autoplayTimeout:5000,
    autoplayHoverPause:true,
    responsive: {
        0: {
            items: 1,
        },
        600: {
            items: 1,
        },
        1000: {
            items: 1,
        }
    }
})
$('#owl-banner').owlCarousel({
    loop: true,
    nav: false,
    dots: false,
	autoplay:true,
    autoplayTimeout:5000,
    autoplayHoverPause:true,
    responsive: {
        0: {
            items: 1,
        },
        600: {
            items: 1,
        },
        1000: {
            items: 1,
        }
    }
})

$('.owl-room').owlCarousel({
    autoplay: true,
    autoplayTimeout: 5000,
    autoplayHoverPause: true,
    loop: true,
    nav: true,
	center: true,
	navText: ["&#10092;","&#10093;"],
    dots: true,
    margin: 30,

    responsive: {
        0: {
            items: 1,
        },
        600: {
            items: 1,
        },
        1000: {

            items: 3,
        }
    }
})
$('.owl-quotes').owlCarousel({

    loop: true,
    dots: false,
    margin: 10,
	nav: true,
	navText: ["&#10092;","&#10093;"],
	autoplay: true,
    autoplayTimeout: 5000,
    autoplayHoverPause: true,
    responsive: {
        0: {
            items: 1,
        },
        600: {
            items: 1,
        },
        1000: {
            items: 4,
			 stagePadding: 40,
			left: -30,
			nav: true,
	navText: ["&#10092;","&#10093;"],
        }
    }
})

$('.owl-about').owlCarousel({
    autoplay: true,
    autoplayTimeout: 5000,
    autoplayHoverPause: true,
    loop: true,
    nav: true,
    dots: false,
    margin: 10,
    responsive: {
        0: {
            items: 1,
        },
        600: {
            items: 1,
        },
        1000: {
            items: 1,
        }
    }
})
$('#sliderRes').owlCarousel({
    loop: true,
    nav: true,
    dots: true,
	autoplay:true,
    autoplayTimeout: 5000,
    autoplayHoverPause:true,
    responsive: {
        0: {
            items: 1,
        },
        600: {
            items: 1,
        },
        1000: {
            items: 1,
        }
    }
})
