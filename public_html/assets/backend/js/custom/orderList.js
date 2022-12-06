$(document).ready(function (){
    $(document).on('click', '.order-delete-btn', function (e){
        e.preventDefault();
        let obj = $(this);
        let id = obj.data('id')
        Swal.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#696cff',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    type: 'post',
                    url: 'orderDelete',
                    data: {
                        'id': id
                    },
                    success: function (data) {
                        let responseJson = JSON.parse(data);
                        let status = responseJson.status;
                        let message = responseJson.message;
                        if (Number(status) === 1) {
                            Swal.fire({
                                icon: 'success',
                                title: 'Order',
                                text: message,
                            })
                        } else {
                            Swal.fire({
                                icon: 'error',
                                title: 'Order',
                                text: message,
                            })
                        }
                    }
                })
            }
        })
    });

    $(document).on('change', '#status', function (e){
        e.preventDefault();
        let obj = $(this);
        let value = obj.val();
        let id = obj.data('id');

        $.ajax({
            type: 'post',
            url: SITE_URL + 'orderChangeStatus',
            data: {
                'id': id,
                'value': value
            },
            success: function (data){
                let responseJson = JSON.parse(data);
                let status = responseJson.status;
                let message = responseJson.message;
                if (Number(status) === 1) {
                    Swal.fire({
                        icon: 'success',
                        title: 'Order Status',
                        text: message,
                    })
                }else{
                    Swal.fire({
                        icon: 'error',
                        title: 'Order Status',
                        text: message,
                    })
                }
            }
        })
    });

    $(document).on('click','.view-invoice',function (e){
        e.preventDefault();
        let id = $(this).data('id');
        window.location.href = SITE_URL + 'viewInvoice/'+ id;
    })
})