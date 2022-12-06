$(document).ready(function (){

    $(document).on('click', '.submitOrder', function (event){
        event.preventDefault();
        $.ajax({
            type: 'get',
            url: SITE_URL + 'order',
            success: function (data) {
                let responseJson = JSON.parse(data);
                let status =  responseJson.status;
                let message = responseJson.message;
                if(status === 1){
                    Swal.fire({
                        icon: 'success',
                        html: message,
                        confirmButton: "btn btn-success",
                        confirmButtonColor: '#198754'
                    }).then((re)=>{
                        if (re.isConfirmed){
                            window.location.href = SITE_URL + "Cart_controller";
                        }
                    });
                }else {
                    Swal.fire({
                        icon: 'error',
                        html: message,
                    }).then((res)=>{
                        if(res.isConfirmed){
                        }
                    });
                }
            },
        });
    });

    $(document).on('click', '.edit-shipping-address-btn', function (){
       $('#edit-shipping-info').modal('show');
    });

    $(document).on('click', '.save-edit-shipping-info-btn', function (e){
        e.preventDefault();
        $.ajax({
            type: 'post',
            url: SITE_URL + 'shippingInfo',
            data: {
                'edit_shipping_name' :  $('#edit-shipping-name').val(),
                'edit_shipping_email' : $('#edit-shipping-email').val(),
                'edit_shipping_phone_number' : $('#edit-shipping-phone-number').val(),
                'edit_shipping_address_1' :  $('#edit-shipping-address-1').val(),
                'edit_shipping_address_2' :  $('#edit-shipping-address-2').val(),
                'edit_shipping_district' :  $('#edit-shipping-district').val(),
                'edit_shipping_city' : $('#edit-shipping-city').val(),
                'edit_shipping_post_code' : $('#edit-shipping-post-code').val(),
            },
            success: function (data){
                let responseJson = JSON.parse(data);
                let status = responseJson.status;
                let message = responseJson.message;

                if (Number(status) === 1){
                    $('#edit-shipping-info').modal('hide');
                    Swal.fire({
                        icon: 'success',
                        title: 'Shipping Information',
                        text: message,
                        confirmButtonColor : '#198754',
                    }).then((result)=>{
                        if(result.isConfirmed){

                            $('.shipping-address').html(`
                                <strong>${$('#edit-shipping-name').val()}</strong> : ${$('#edit-shipping-address-1').val()} 
                                ${$('#edit-shipping-address-2').val()}
                            `)
                        }
                    })
                }else {
                    Swal.fire({
                        icon: 'error',
                        title: 'Shipping Information',
                        text: message,
                        confirmButtonColor : '#198754',
                    }).then((result)=>{
                        if (result.isConfirmed){
                            $('#edit-shipping-info').modal('show');
                        }
                    })
                }
            }
        })
    })

    $(document).on('click', '.edit-billing-address-btn', function (){
       $('#edit-billing-info').modal('show');
    });
})