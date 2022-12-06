$(document).ready(function (){

    $('.add-btn').on('click', function (event){

        event.preventDefault();
        let product = $(this).parent().parent()
        let id = product.find('.p-id');
        let name = product.find('.p-name');
        let price = product.find('.p-price');
        let qty = product.find('.quantity');

        let addToCartBtn = $(this);

        if(product.find(qty).val() === '' || product.find(qty).val() === '0'){
            Swal.fire({
                icon: 'error',
                title: 'Quantity',
                text: 'Quantity field is required.',
                confirmButtonColor: '#198754'
            })
        }else {
            let priceArray = price.val().split(':')
            $.ajax({
                type: 'post',
                url: SITE_URL + 'home_controller/createCart',
                dataType: 'json',
                data: {
                    'id': id.text(),
                    'qty': qty.val(),
                    'qtyType' : priceArray[0],
                    'price': priceArray[1],
                    'name' : name.text(),
                },

                beforeSend: function () {

                },
                complete: function () {

                },
                success: function (data) {

                    let status = data.status;
                    let countItems = data.countItems;
                    let message = data.message;
                    if (Number(status) === 1 ){
                        Swal.fire({
                            icon: 'success',
                            title: 'Product Added In Item List.',
                            text: `${name.text()} is added into item list`,
                            confirmButtonColor: '#198754',
                        })
                        $('.cart-count').text(`${countItems}`)
                        qty.val('');
                    }else if (Number(status) === 2){
                        Swal.fire({
                            icon: 'success',
                            title: 'Product Added In Item List.',
                            text: name.text()+message,
                            confirmButtonColor: '#198754',
                        })
                    }

                },
                error: function (error) {

                }
            });
        }
    })
})