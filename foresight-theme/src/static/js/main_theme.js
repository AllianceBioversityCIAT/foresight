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

    $('.cards-slick-slider').slick({
        slidesToShow: 4,
        slidesToScroll: 4,
        infinite: false,
        autoplay: false,
        autoplaySpeed: 3000,
        speed: 1000,
        dots: true,
        prevArrow: $('.cards-slick-prev'),
        nextArrow: $('.cards-slick-next'),
        responsive: [
            {
                breakpoint: 640,
                settings: {
                    slidesToShow: 1,
                    slidesToScroll: 1,
                },
            },
            {
                breakpoint: 768,
                settings: {
                    slidesToShow: 2,
                    slidesToScroll: 2,
                },
            },
            {
                breakpoint: 1024,
                settings: {
                    slidesToShow: 2,
                    slidesToScroll: 2,
                },
            },
            {
                breakpoint: 1280,
                settings: {
                    slidesToShow: 3,
                    slidesToScroll: 3,
                },
            },
        ],
    })

    if ($('#search-posts').length) {
        $('#search-posts').on('change keyup', function () {
            searchPostAjax()
        })
    }

    if ( $('#frm-popular-search').length ){
        $( "#frm-popular-search" ).on( "submit", function( event ) {
            event.preventDefault();
            const btn = this.elements['btn-popular-search'];
            const keyword = this.elements['s'].value.trim();
            if(keyword){
                console.log(keyword);
                btn.disabled = true;
                btn.innerHTML = '<i class="fa-solid fa-circle-notch fa-spin mr-2"></i> SEARCHING...';
                this.submit();
            }
        });
    }
    /**
     * This function performs an ajax query to render the html result on the page.
     */
    function searchPostAjax() {
        var $postName = $('#search-posts').val()
        var $perPage = $('#search-posts').attr('data-per-page')
        console.log($perPage)

        var $data = {
            action: 'more_posts_ajax',
            postName: $postName,
            perPage: $perPage,
        }

        $.ajax({
            type: 'POST',
            url: ajax_object.ajax_url,
            data: $data,
            beforeSend: function () {
                $('.search-load').show()
            },
        }).complete(function (response) {
            $('.search-load').hide()
            $('.posts__col-cards').html(response) // CHANGE THIS!
        })
    }
})(jQuery)
