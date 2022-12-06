$(document).ready(function (){
    $(document).on('click', '.save-new-product', function (e){
        e.preventDefault();
        let brand_name = $('#brand_name').val();
        let brand_type = $('#brand_type').val();
        let brand_weight = $('#brand_weight').val();
        let brand_generic_name = $('#brand_generic_name').val();
        let brand_company_name = $('#brand_company_name').val();
        let price_type0 = $('#price_type0').val();
        let price0 = $('#price0').val();
        let price_type1 = $('#price_type1').val();
        let price1 = $('#price1').val();
        let price_type2 = $('#price_type2').val();
        let price2 = $('#price2').val();
        let price_type3 = $('#price_type3').val();
        let price3 = $('#price3').val();
        let price_type4 = $('#price_type4').val();
        let price4 = $('#price4').val();
        let price_type5 = $('#price_type5').val();
        let price5 = $('#price5').val();

        let data = {
            'brand_name': brand_name,
            'brand_type': brand_type,
            'brand_weight': brand_weight,
            'brand_generic_name': brand_generic_name,
            'brand_company_name': brand_company_name,
            'price_type0': price_type0,
            'price0': price0,
            'price_type1': price_type1,
            'price1': price1,
            'price_type2': price_type2,
            'price2': price2,
            'price_type3': price_type3,
            'price3': price3,
            'price_type4': price_type4,
            'price4': price4,
            'price_type5': price_type5,
            'price5': price5,
        }

        $.ajax({
            type: 'post',
            url : SITE_URL + 'addNewProduct',
            data : data,
            beforeSend: function (){

            },
            complete: function (){

            },
            success: function (data){
                let responseJson = JSON.parse(data);
                let status = responseJson.status;
                let message = responseJson.message;
                if (Number(status) === 1){
                    $('#add-new-product').modal('hide');
                    Swal.fire({
                        icon: 'success',
                        title: 'Add New Product',
                        html: message,
                    }).then((result) => {
                        if(result.isConfirmed){
                            window.location.href
                        }
                    })
                }else {
                    $('#add-new-product').modal('hide');
                    Swal.fire({
                        icon: 'error',
                        title: 'Add New Product',
                        html: message,
                    }).then((result)=>{
                        if(result.isConfirmed){
                            $('#add-new-product').modal('show');
                        }
                    })
                }
            },
            error : function () {

            }
        })
    })

    $(document).on('click','.product-edit-btn', function (e){
        e.preventDefault();
        let obj = $(this);
        let id = obj.data('id');
        $.ajax({
            type: 'post',
            url: SITE_URL + 'singleProduct',
            data: {
                'id' : id
            },
            beforeSend : function (){
                $('.loading').removeClass('d-none');
            },
            complete: function (){
                $('.loading').addClass('d-none');
            },
            success : function (data){
                let id = $('#edit_id');
                let brand_name = $('#edit_brand_name');
                let brand_type = $('#edit_brand_type');
                let brand_weight = $('#edit_brand_weight');
                let brand_generic_name = $('#edit_brand_generic_name');
                let brand_company_name = $('#edit_brand_company_name');
                let price_type0 = $('#edit_price_type0');
                let price0 = $('#edit_price0');
                let price_type1 = $('#edit_price_type1');
                let price1 = $('#edit_price1');
                let price_type2 = $('#edit_price_type2');
                let price2 = $('#edit_price2');
                let price_type3 = $('#edit_price_type3');
                let price3 = $('#edit_price3');
                let price_type4 = $('#edit_price_type4');
                let price4 = $('#edit_price4');
                let price_type5 = $('#edit_price_type5');
                let price5 = $('#edit_price5');
                let responseJson = JSON.parse(data);
                let status = responseJson.status;
                let single_product = responseJson.product[0];
                let message = responseJson.message;
                if (Number(status) === 1){
                    $('#edit-product-modal').modal('show');
                    id.val(single_product.id)
                    brand_name.val(single_product.brand_name)
                    brand_type.val(single_product.brand_type)
                    brand_weight.val(single_product.brand_weight)
                    brand_generic_name.val(single_product.brand_generic_name)
                    brand_company_name.val(single_product.brand_company_name)
                    price_type0.val(single_product.price_type0)
                    price0.val(single_product.price0)
                    price_type1.val(single_product.price_type1)
                    price1.val(single_product.price1)
                    price_type2.val(single_product.price_type2)
                    price2.val(single_product.price2)
                    price_type3.val(single_product.price_type3)
                    price3.val(single_product.price3)
                    price_type4.val(single_product.price_type4)
                    price4.val(single_product.price4)
                    price_type5.val(single_product.price_type5)
                    price5.val(single_product.price5)

                }else{
                    $('#edit-product-modal').modal('hide');
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        text: message

                    })
                }
            },
            error: function (){

            }
        })
    })

    $(document).on('click', '.save-edit-btn', function(e){
        e.preventDefault();
        let obj = $(this);
        let id = $('#edit_id').val();
        let brand_name = $('#edit_brand_name').val();
        let brand_type = $('#edit_brand_type').val();
        let brand_weight = $('#edit_brand_weight').val();
        let brand_generic_name = $('#edit_brand_generic_name').val();
        let brand_company_name = $('#edit_brand_company_name').val();
        let price_type0 = $('#edit_price_type0').val();
        let price0 = $('#edit_price0').val();
        let price_type1 = $('#edit_price_type1').val();
        let price1 = $('#edit_price1').val();
        let price_type2 = $('#edit_price_type2').val();
        let price2 = $('#edit_price2').val();
        let price_type3 = $('#edit_price_type3').val();
        let price3 = $('#edit_price3').val();
        let price_type4 = $('#edit_price_type4').val();
        let price4 = $('#edit_price4').val();
        let price_type5 = $('#edit_price_type5').val();
        let price5 = $('#edit_price5').val();

        let data = {
            'id' : id,
            'brand_name' : brand_name,
            'brand_type' : brand_type,
            'brand_weight' : brand_weight,
            'brand_generic_name' : brand_generic_name,
            'brand_company_name' : brand_company_name,
            'price_type0' : price_type0,
            'price0' : price0,
            'price_type1' : price_type1,
            'price1' : price1,
            'price_type2' : price_type2,
            'price2' : price2,
            'price_type3' : price_type3,
            'price3' : price3,
            'price_type4' : price_type4,
            'price4' : price4,
            'price_type5' : price_type5,
            'price5' : price5,
        }
        console.log(data);
        $.ajax({
            type: 'post',
            url : SITE_URL + 'editProduct',
            data : data,
            cache : false,
            beforeSend : function (){
                obj.text('Saving..')
            },
            complete : function (){
                obj.text('Save Changes')
            },
            success : function (data){
                let responseJson = JSON.parse(data);
                let status = responseJson.status;
                let message = responseJson.message;
                if (Number(status) === 1) {
                    $('#edit-product-modal').modal('hide');
                    Swal.fire({
                        icon: 'success',
                        title: 'Edit Product',
                        text: message,
                    }).then((result) => {
                        if (result.isConfirmed){

                        }
                    })
                }else {
                    Swal.fire({
                        icon: 'error',
                        title: 'Edit Product',
                        text: message,
                    })
                }
            },
            error : function (){

            }
        })
    })

    $(document).on('click', '.product-delete-btn', function (e){
        e.preventDefault();
        let obj = $(this)
        let id = obj.data('id');
        $.ajax({
            type: 'post',
            url: SITE_URL + 'productDelete',
            data: {
                'id' : id
            },
            async:true,
            success:function (data) {
                let responseJson = JSON.parse(data);
                let status = responseJson.status;
                let message = responseJson.message;
                if (Number(status) === 1){
                    Swal.fire({
                        icon: 'success',
                        title: 'Delete',
                        html: message,
                    }).then((result)=>{
                        if (result.isConfirmed){
                            console.log(obj.parent().parent().fadeOut('slow'));
                        }
                    })
                }else{
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        html: message,
                    })
                }
            },
            error:function () {

            }
        })
    });

    $(document).on('submit', '.csv_upload_form', function (e){
        e.preventDefault();
        let action = this.action;
        let method = this.method;
        let data = new FormData(this)
        let btn = $('.csv_upload_form_btn');

        $.ajax({
            type: method,
            url: action,
            data: data,
            processData: false,
            contentType: false,
            cache: false,
            beforeSend: function (){
                btn.text('Uploading...')
            },
            complete: function (){
                btn.text('Upload')
            },
            success: function (data){
                console.log(data)
            }
        })
    })
});