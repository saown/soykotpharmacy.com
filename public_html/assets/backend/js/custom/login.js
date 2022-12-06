$(document).ready(function (){
    $(document).on('submit', '#admin-login-form', function (e){
        e.preventDefault();
        let obj = $(this)
        let action = this.action;
        let method = this.method;
        let data = new FormData(this)
        let btn = $('.login-submit-btn');
        // data.append('csrf_token', csrf_token);
        $.ajax({
            type: method,
            url: action,
            data: data,
            processData: false,
            contentType: false,
            cache: false,
            beforeSend : function (){
               btn.text('Sign in...')
            },
            complete : function (){
                btn.text('Sign in')
            },
            success : function (data){
                let responseJson  = JSON.parse(data);
                let status = responseJson.status;
                let message = responseJson.message;
                let customer_status = responseJson.customer_status;
                if (Number(status) === 1 ){
                    Swal.fire({
                        icon: 'success',
                        title: 'Login',
                        text: message,
                    }).then(function (result) {
                        if (result.isConfirmed){
                            if (Number(customer_status) === 500) {
                                window.location.href = SITE_URL + 'dashboard';
                            }
                        }
                    })
                }else{
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        text: message,
                    })
                }
            },
            error : function (){

            }

        })
    })
})