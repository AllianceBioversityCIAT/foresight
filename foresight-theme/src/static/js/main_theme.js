const slider = document.querySelector('.slider-row')
let isDown = false
let startX
let scrollLeft

if (slider) {
    slider.addEventListener('mousedown', (e) => {
        isDown = true
        slider.classList.add('active')
        startX = e.pageX - slider.offsetLeft
        scrollLeft = slider.scrollLeft
    })
    slider.addEventListener('mouseleave', (_) => {
        isDown = false
        slider.classList.remove('active')
    })
    slider.addEventListener('mouseup', (_) => {
        isDown = false
        slider.classList.remove('active')
    })
    slider.addEventListener('mousemove', (e) => {
        if (!isDown) return
        e.preventDefault()
        const x = e.pageX - slider.offsetLeft
        const SCROLL_SPEED = 1
        const walk = (x - startX) * SCROLL_SPEED
        slider.scrollLeft = scrollLeft - walk
    })
}

;(function ($) {
    if ($('#search-page').length) {
        $('.btn-link-icon').click(function () {
            var $classButton = $('.btn-link-icon')

            if ($(this).hasClass('collapsed')) {
                $classButton.find('i').removeClass('icon-expand-arrow-open')
                $classButton.find('i').addClass('icon-expand-arrow-closed')
                $(this).find('i').removeClass('icon-expand-arrow-closed')
                $(this).find('i').addClass('icon-expand-arrow-open')
            } else {
                $(this).find('i').removeClass('icon-expand-arrow-open')
                $(this).find('i').addClass('icon-expand-arrow-closed')
            }
        })

        $('.btn-result').click(function () {
            var idCard = $(this).data('card')

            $(idCard).toggleClass('collapse')

            if ($(idCard).hasClass('collapse')) {
                $(this).find('i').removeClass('icon-expand-arrow-open')
                $(this).find('i').addClass('icon-expand-arrow-closed')
            } else {
                $(this).find('i').removeClass('icon-expand-arrow-closed')
                $(this).find('i').addClass('icon-expand-arrow-open')
            }
        })

        $('.btn-sidebar-collapsed').click(function () {
            var idCard = $(this).data('card')

            $(idCard).toggleClass('collapse-sidebar')
            $('#button-collapse-sidebar').toggleClass('collapse-button')

            if ($(idCard).hasClass('collapse-sidebar')) {
                $(this).find('i').removeClass('icon-arrow-left')
                $(this).find('i').addClass('icon-arrow-right')
            } else {
                $(this).find('i').removeClass('icon-arrow-right')
                $(this).find('i').addClass('icon-arrow-left')
            }
        })
    }

    $('.carousel-full-slick').slick({
        slidesToShow: 1,
        slidesToScroll: 1,
        infinite: true,
        autoplay: false,
        autoplaySpeed: 3000,
        speed: 1000,
        dots: true,
        prevArrow: $('.caroulse-full-prev'),
        nextArrow: $('.caroulse-full-next'),
    })
})(jQuery)
