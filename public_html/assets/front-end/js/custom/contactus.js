$(document).ready(function(){
    $(document).on('submit','.contact-form',function(e){
        e.preventDefault();
        let obj = $(this);
        let method = this.method;
        let action = this.action;
        let data = new FormData(this);
        let btn = $('.contact-from-btn');
        $.ajax({
            type: method,
            url: action,
            data: data,
            processData: false,
            contentType: false,
            cache: false,
            beforeSend: function (){
                btn.text(`Sending...`);
            },
            complete: function (){
                btn.html(`<svg width="15" height="15" viewBox="0 0 15 15" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M13.9996 1L6.84961 8.15" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                <path d="M14 1L9.45 14L6.85 8.15L1 5.55L14 1Z" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
            </svg>Send`)
            },
            success: function (data){
                let responseJson = JSON.parse(data);
                let status = responseJson.status;
                let message = responseJson.message;
                if (Number(status) === 1){
                    Swal.fire({
                        icon: 'success',
                        title: 'Message',
                        html: message,
                        confirmButtonColor: '#198754'
                    }).then((result)=>{
                        if(result.isConfirmed){
                            let link = window.location.href;
                            window.location.replace(link);
                        }
                    });
                }else{
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        html: message,
                        confirmButtonColor: '#198754'
                    })
                }
            },
            error: function (){

            }
        })
    });
});