


$(document).ready(function(){

    $('[data-table="insert_here"]').on('click', '[data-remove-from-cart-product-id]', function(event){
        event.preventDefault();

        let el = $(this);

        let action = el.attr('href');
        let _token = $('input[name="_token"]').val();

        let rfc_product_uuid = el.attr('data-remove-from-cart-product-id');

        let formData = new FormData();
        formData.append('_token', _token);
        formData.append('remove_from_cart_product_uuid', rfc_product_uuid);

        $.ajax({
            type: 'POST',
            url: action,
            data: formData,
            processData: false,
            contentType: false,
            success: function (data) {
                $('table[data-table="insert_here"]').empty().html(data);
            }
        });
    });


});

