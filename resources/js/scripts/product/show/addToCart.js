

$(document).ready(function(){

    // $('[data-add-to-cart-product-id]').click(function(event){
    $('.container').on('click', '[data-add-to-cart-product-id]', function(event) {
        event.preventDefault();

        let el = $(this);
        let parent = el.parents('.block_add_to_cart');

        let _token_input = $('[name="_token"]');

        let atc_product_uuid_input = parent.find('[name="product_uuid"]');
        let atc_product_quantity_input = $('[name="product_quantity"]');

        let action = el.attr('href');
        let _token = _token_input.val();
        let atc_product_uuid = atc_product_uuid_input.val();
        let atc_product_quantity = atc_product_quantity_input.val();

        atc_product_quantity = parseInt(atc_product_quantity, 10);
        atc_product_quantity = atc_product_quantity >= 1 ? atc_product_quantity  : 1;
        atc_product_quantity_input.val(atc_product_quantity);

        if( typeof _token_input === undefined )
            return;

        let formData = new FormData();
        formData.append('_token', _token);
        formData.append('product_uuid', atc_product_uuid); // [product_uuid]
        formData.append('product_quantity', atc_product_quantity); // [quantity]

        $.ajax({
            type: 'POST',
            url: action,
            data: formData,
            processData: false,
            contentType: false,
            statusCode: {
                419: function(eee) {
                    alert('Try again');
                    console.log('Try again', eee);
                },
            },
            success: function (data) {

            }
        });

    });

});
