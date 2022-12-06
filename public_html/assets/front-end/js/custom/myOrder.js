$(document).ready(function () {
    $(document).on('click', '.cancel-order-btn', function (e){
        e.preventDefault();
        let obj = $(this);
        let id = obj.data('id');
        $.ajax({
            type: 'post',
            url: SITE_URL + 'cancelClientOrder',
            data:{
                'id': id,
            },
            success: function (data){
                let responseJson = JSON.parse(data);
                let status = responseJson.status;
                let message = responseJson.message;
                if (Number(status) === 1){
                    Swal.fire({
                        icon: 'success',
                        title: 'Canceled',
                        html: message,
                        confirmButtonColor: '#198754',
                    }).then((result) => {
                        if (result.isConfirmed){
                            window.location.href = SITE_URL + 'myOrder';
                        }
                    })
                }else{
                    Swal.fire({
                        icon: 'error',
                        title: 'Canceled',
                        html: message,
                        confirmButtonColor: '#198754',
                    })
                }
            }
        })
    });
})