
$(document).ready(function(){

    // filter input numbers
    $('table').on('keypress', '.block_quantity :input', function(event){
        return /\d/.test(String.fromCharCode(event.keyCode));
    });

    $('table').on('change propertychange input', '.block_quantity :input', function(event){
        let el = $(this);
        let parent = el.parents('.block_quantity');

        let _token_input = $('[name="_token"]');

        let rowParent = el.parents('tr');
        let tableParent = el.parents('table');
        let cq_product_uuid_input = rowParent.find('[data-product-uuid]');
        let product_in_cart_quantity_input = parent.find('[name="product_in_cart_quantity"]');
        let down_product_quantity_btn = parent.find('[name="btn_down_quantity"]');
        let up_product_quantity_btn = parent.find('[name="btn_up_quantity"]');

        let action = parent.attr('data-action');
        let _token = _token_input.val();
        let cq_product_uuid = cq_product_uuid_input.attr('data-product-uuid');
        let cq_product_quantity = product_in_cart_quantity_input.val();

        cq_product_quantity = parseInt(cq_product_quantity, 10);
        cq_product_quantity = cq_product_quantity >= 1 ? cq_product_quantity  : 1;
        product_in_cart_quantity_input.val(cq_product_quantity);

        if( typeof _token_input === undefined )
            return;

        let formData = new FormData();
        formData.append('_token', _token);
        formData.append('product_uuid', cq_product_uuid);
        formData.append('product_quantity', cq_product_quantity);

        $(up_product_quantity_btn, down_product_quantity_btn).attr('disabled', true); // product_in_cart_quantity_input,

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
                $(up_product_quantity_btn).attr('disabled', false); // product_in_cart_quantity_input,
                down_product_quantity_btn.attr('disabled', cq_product_quantity <= 1 );

                if( data.update !== undefined ) {
                    let update = data.update;

                    if( update.product_in_cart !== undefined && update.product_in_cart.fields !== undefined ) {
                        let fields = update.product_in_cart.fields;
                        for (let prop in fields) {
                            if( fields.hasOwnProperty( prop ) )
                                rowParent.find('[data-type="'+ prop +'"] .content').empty().html(fields[prop]);
                        }
                    }

                    if( update.cart !== undefined ) {
                        let cart = update.cart;

                        for (let prop in cart) {
                            if( cart.hasOwnProperty( prop ) )
                                tableParent.find('[data-type="'+ prop +'"] .content').empty().html(cart[prop]);
                        }
                    }
                }
            }
        });
    });


    // events up/down quantity
    $('table').on('click', '.block_quantity [name="btn_down_quantity"], .block_quantity [name="btn_up_quantity"]', function(event){
        event.preventDefault();

        let el = $(this);
        let parent = el.parents('.block_quantity');

        let product_in_cart_quantity_input = parent.find('[name="product_in_cart_quantity"]');

        let down_product_quantity_btn = parent.find('[name="btn_down_quantity"]');

        let up_product_quantity_btn = parent.find('[name="btn_up_quantity"]');


        let oldVal = product_in_cart_quantity_input.val();
        oldVal = parseInt(oldVal, 10);
        let newVal = oldVal;

        if( el.is(down_product_quantity_btn) && product_in_cart_quantity_input.val() > 1) {
            newVal = oldVal - 1;
            product_in_cart_quantity_input.val(newVal);
            product_in_cart_quantity_input.trigger('change');
        }

        if( el.is(up_product_quantity_btn) && product_in_cart_quantity_input.val() >= 0) {
            newVal = oldVal + 1;
            product_in_cart_quantity_input.val(newVal);
            product_in_cart_quantity_input.trigger('change');
        }

        down_product_quantity_btn.attr('disabled', newVal <= 1 );
    });


});
