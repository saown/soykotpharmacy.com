$(document).ready(function(){

    let links = $('a');
    for (let i = 0 ; i< links.length;i++){
        if (window.location.href === links[i].href){
            links[i].parentElement.classList.add('active')

        }
    }

    let menuBar = $('#menu-bar');
    let menuBtn = $('.menu-btn');
    let logo = $('.logo');
    if(window.screen.width < 1024){
        menuBtn.removeClass('d-none');
        menuBar.css('display','none');
        menuBar.removeClass('me-5');
    }
    if(window.screen.width < 350){
        logo.addClass('ms-2');
        logo.removeClass('ms-5')
        $('.cart-and-m-menu').addClass('me-2').removeClass('me-5');

    }

    menuBtn.click(function (){
        $('.menu-btn').toggleClass('menu-btn-active');
        menuBar.slideToggle();
        $('.search-list').slideUp();
        $('#search').val('');
    })



    // search box
    $(document).on('keyup', '#search', function (e) {
        e.preventDefault();
        let searchAns = $('.search-list .card-body');
        if ($(this).val() !== '') {
            $.ajax({
                url: SITE_URL + 'home_controller/searchBox',
                method: 'post',
                data: {
                    'searchValue': $(this).val()
                },
                beforeSend: function () {
                    $('.search-list').slideDown(function () {
                        searchAns.html(`<li>Loading..</li>`)
                    })
                },
                complete: function (data) {
                },
                success: function (data) {
                    let jsonResponse = JSON.parse(data);
                    if (Number(jsonResponse.status) === 1) {
                        $('.search-list').slideDown(function () {
                            searchAns.html('');
                            jsonResponse.searchValue.forEach(function (item) {
                                let name = item.brand_name.replace(/\(/g,'_').replace(/\)/g,'_')
                                searchAns.append(`<a href="${SITE_URL + 'searchProduct/'}${name}/${item.id}">
                                                        <p class="card-text">${item.brand_name}</p>
                                                  </a><hr>`)
                            })
                        })
                    } else if (Number(jsonResponse.status) === 0) {
                        $('.search-list').slideDown(function () {
                            searchAns.html('');
                            searchAns.html(`<li class="text-danger">${jsonResponse.message}</li>`);
                        })
                    }
                },
                error: function () {

                }
            });
        } else {
            $('.search-list').slideUp(function () {
                searchAns.html('');
            })
        }
    });
    $(document).on('submit', '#searchProducts', function (e) {
        e.preventDefault();
        window.location.href = SITE_URL + 'searchProducts/' + $('#search').val();
    })
    // end search box
});