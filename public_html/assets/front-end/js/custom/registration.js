$(document).ready(function (){
    $(document).on('submit', '#registration-form', function (e){
        e.preventDefault();
        let method = this.method;
        let action = this.action;
        let data = new FormData(this);
        let btn = $('.signup-form-btn');
        $.ajax({
            type: method,
            url: action,
            data: data,
            processData: false,
            contentType: false,
            cache: false,
            beforeSend: function (){
                btn.text('signing...');
            },
            complete: function (){
                btn.text('Sign Up');
            },
            success: function (data){
                let responseJson = JSON.parse(data);
                let status = responseJson.status;
                let message = responseJson.message;
                if (Number(status) === 1){
                    Swal.fire({
                        icon: 'success',
                        title: 'Registration',
                        html: message,
                        confirmButtonColor: '#157347',
                    }).then((result) =>{
                        if(result.isConfirmed){
                            window.location.href = SITE_URL + 'profile';
                        }
                    })
                }else {
                    Swal.fire({
                        icon: 'error',
                        title: 'Registration',
                        html: message,
                        confirmButtonColor: '#157347',
                    })
                }
            },
            error: function (){

            }
        })
    })
})