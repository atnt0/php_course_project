
$(document).ready(function(){

    // filter input numbers
    $('.block_quantity').on('keypress', ':input', function(event){
        return /\d/.test(String.fromCharCode(event.keyCode));
    });


    // events up/down quantity
    $('.block_quantity').on('click', '[name="btn_down_quantity"], [name="btn_up_quantity"]', function(event){
        event.preventDefault();

        let el = $(this);
        let parent = el.parents('.block_quantity');

        let product_quantity_input = parent.find('[name="product_quantity"], [name="quantity"]');
        let down_product_quantity_btn = parent.find('[name="btn_down_quantity"]');
        let up_product_quantity_btn = parent.find('[name="btn_up_quantity"]');

        let oldVal = product_quantity_input.val();
        oldVal = parseInt(oldVal, 10);
        let newVal = oldVal;

        if( el.is(down_product_quantity_btn) && product_quantity_input.val() > 1) {
            newVal = oldVal - 1;
            product_quantity_input.val(newVal);
            product_quantity_input.trigger('change');
        }

        if( el.is(up_product_quantity_btn) && product_quantity_input.val() >= 0) {
            newVal = oldVal + 1;
            product_quantity_input.val(newVal);
            product_quantity_input.trigger('change');
        }

        down_product_quantity_btn.attr('disabled', newVal <= 1 );
    });


});
