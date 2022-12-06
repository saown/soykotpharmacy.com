$(document).ready(function (){
    $(document).on('submit', '#login-form', function(e){
        e.preventDefault();
        let obj = $(this);
        let method = this.method;
        let action = this.action;
        let data = new FormData(this);
        $.ajax({
            type: method,
            url: action,
            data: data,
            processData: false,
            contentType: false,
            cache: false,
            beforeSend: function (){

            },
            complete: function (){
            },
            success: function (data){
                let responseJson = JSON.parse(data);
                let status = responseJson.status;
                let message = responseJson.message;
                if (Number(status) === 1) {
                    Swal.fire({
                        icon: 'success',
                        title: 'Login',
                        html: message,
                        confirmButtonColor: '#198754',
                    }).then((result) => {
                        if (result.isConfirmed) {
                            window.location.href = SITE_URL + 'myOrder'
                        }
                    })
                }else {
                    Swal.fire({
                        icon: 'error',
                        title: 'Login',
                        html: message,
                        confirmButtonColor: '#198754',
                    })
                }
            },
            error: function (){

            }

        })
    });
})