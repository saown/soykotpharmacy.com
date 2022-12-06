$(document).ready(function(){
    $(document).on('submit','.personal-info-form',function(e){
        e.preventDefault();
        let obj = $(this)
        let action = this.action
        let method = this.method
        let data = new FormData(this)

        $.ajax({
            type: method,
            url: action,
            data: data,
            processData: false,
            contentType: false,
            cache: false,
            beforeSend: function(){

            },
            complete: function (){

            },
            success: function (data){
                let responseJson = JSON.parse(data)
                let status = responseJson.status
                let message = responseJson.message

                if (Number(status) === 1){
                    Swal.fire({
                        icon: 'success',
                        title: 'Personal Info',
                        html: message,
                        confirmButtonColor: '#198754'
                    })
                }else{
                    Swal.fire({
                        icon: 'error',
                        title: 'Personal Info',
                        html: message,
                        confirmButtonColor: '#198754'
                    })
                }
            }
        })
    });

    $(document).on('submit','.password-change-form',function (e){
        e.preventDefault();
        let obj = $(this)
        let action = this.action;
        let method = this.method;
        let data = new FormData(this);
        $.ajax({
            type: method,
            url: action,
            data: data,
            processData: false,
            contentType: false,
            cache: false,
            beforeSend: function(){

            },
            complete: function (){

            },
            success: function (data){
                let responseJson = JSON.parse(data)
                let status = responseJson.status
                let message = responseJson.message

                if (Number(status) === 1){
                    Swal.fire({
                        icon: 'success',
                        title: 'Personal Info',
                        html: message,
                        confirmButtonColor: '#198754'
                    })
                }else{
                    Swal.fire({
                        icon: 'error',
                        title: 'Personal Info',
                        html: message,
                        confirmButtonColor: '#198754'
                    })
                }
            }
        })
    });
})