$(document).ready(function (){

    $("input[type='radio']").click(function (){
        let radioValue = $("input[name='paymentOption']:checked").val()
        let parentDiv = $(`#${radioValue}`).parent();
        let nagadParent = $('#nagad').parent();
        let bkashParent = $('#bkash').parent();

        if (radioValue === 'bkash'){
            parentDiv.find('.transactionId').removeClass('d-none');
            parentDiv.find('.transactionId').removeAttr('disabled');
            nagadParent.find('.transactionId').addClass('d-none');
            nagadParent.find('.transactionId').attr('disabled','disabled');
            $('.paymentNumber').text('Bkash Account Number : (+88) 01994084342');
        }else if(radioValue === 'nagad'){
            parentDiv.find('.transactionId').removeClass('d-none');
            parentDiv.find('.transactionId').removeAttr('disabled');
            bkashParent.find('.transactionId').addClass('d-none');
            bkashParent.find('.transactionId').attr('disabled','disabled');
            $('.paymentNumber').text('Nagad Account Number : (+88) 01585395920');
        }else {
            nagadParent.find('.transactionId').addClass('d-none');
            nagadParent.find('.transactionId').attr('disabled','disabled');
            bkashParent.find('.transactionId').addClass('d-none');
            bkashParent.find('.transactionId').attr('disabled','disabled');
            $('.paymentNumber').text('');
        }
    });

    $(document).on('click', '.cart-p-delete-btn', function (event){
        event.preventDefault();
        let obj = $(this);
        let rowID = obj.data('id')
        let parent = obj.parent().parent();
        let pNameAndType = parent.find('.pNameAndType').text();
        $.ajax({
            type : 'post',
            url : SITE_URL + 'cart_controller/deleteCart',
            data : {
                'rowID' : rowID,
                'pNameAndType' : pNameAndType,
                'csrf_token' : csrf_token
            },
            beforeSend: function (){

            },
            complete: function (){

            },
            success: function (data){
                let responseJson = JSON.parse(data);
                let message = responseJson.message;
                let status = responseJson.status;
                let subTotal = responseJson.subTotal;
                let grandTotal = responseJson.grandTotal;
                let countItems = responseJson.countItem;
                let discount = responseJson.discount
                let discountPrice = responseJson.discountPrice
                if (status === 1) {
                    Swal.fire({
                        icon: 'success',
                        html: message,
                        confirmButton: "btn btn-success",
                        confirmButtonColor: '#198754'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            parent.fadeOut();
                            $('.subTotal').text(`${subTotal}`);
                            $('.grandTotal').text(`${grandTotal}`);
                            $('.delivery_fee').text(`${responseJson.delivery_fee}`)
                            $('.discount-percentage').text(`${discount}`);
                            $('.discount-price').text(`${discountPrice}`);
                            $('.cart-count').text(`${countItems}`);

                            if (Number(countItems) === 0){
                                $('tbody').html(`<tr>
                                                        <td colspan="5">
                                                            <div class="alert alert-danger" role="alert">
                                                                <span> Please add product to cart!</span>
                                                            </div>
                                                        </td>
                                                    </tr>
                                `);

                                $('.placeOrderBtn').attr('disabled','disabled');
                            }
                        }
                    })
                }else {
                    Swal.fire({
                        icon: 'error',
                        html: message,
                    })
                }
            }
        })
    });

    $(document).on('change', '.cartQty', function (event){
        event.preventDefault();
        let obj = $(this);
        let rowID = obj.data('id')
        let inputValue = obj.val();
        let parent = obj.parent().parent();
        let totalPrice = parent.find('.totalPrice');
        $.ajax({
            type : 'post',
            url : SITE_URL + 'cart_controller/updateCart',
            data : {
                'rowID' : rowID,
                'qty' : inputValue,
                'csrf_token' : csrf_token
            },
            beforeSend: function (){

            },
            complete: function (){

            },
            success: function (data){
                let responseJson = JSON.parse(data);
                let subTotal = responseJson.subTotal;
                let grandTotal = responseJson.grandTotal;
                let status = responseJson.status;
                let message = responseJson.message;
                let discount = responseJson.discount;
                let discountPrice = responseJson.discountPrice;

                if (status === 1) {
                    totalPrice.text(responseJson.totalPrice + ' tk');
                    $('.subTotal').text(`${subTotal}`)
                    $('.delivery_fee').text(`${responseJson.delivery_fee}`)
                    $('.grandTotal').text(`${grandTotal}`)
                    $('.discount-percentage').text(`${discount}`);
                    $('.discount-price').text(`${discountPrice}`);
                    $('.updateMessage').html(`<div class="alert alert-success alert-dismissible fade show" role="alert">
                                                        ${message}
                                                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                                    </div>`).fadeIn(1000).fadeOut(3000);
                }
            }

        })
    });

    $(document).on('click','.check-out-btn',function (e) {
        // window.location.href = SITE_URL + 'placeOrder';
        e.preventDefault()
            $.ajax({
                type: 'post',
                url: SITE_URL + 'checkOutCheck',
                dataType: false,
                success: function (data){
                    let responseJson = JSON.parse(data);
                    let status = responseJson.status;
                    let message = responseJson.message;
                    if(Number(status) === 1){
                        window.location.href = message
                    }else{
                        Swal.fire({
                            icon: 'error',
                            title: 'Oops...',
                            html: message,
                            confirmButtonColor: '#198754'
                         })
                    }
                }
            })
    })
})