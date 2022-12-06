$(document).ready(function(){
    $('.user-icon').click(function (){
        $('.user-menu').slideToggle();
    });

    $(document).on('click', '.clientLogoutBtn',function (e){
        e.preventDefault();
        $.ajax({
            type: 'get',
            url: SITE_URL + 'clientLogout',
            success: function (data){
                let responseJson = JSON.parse(data);
                let status = responseJson.status;
                let message = responseJson.message;
                if (Number(status) === 1){
                    Swal.fire({
                        icon: 'success',
                        title: 'Logout',
                        text: message,
                        confirmButtonColor: '#198754',
                    }).then(function (result){
                       if (result.isConfirmed){
                           window.location.href = SITE_URL;
                       }
                    });
                }
            }
        })
    });
})