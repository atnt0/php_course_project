
// let rEv4 = new RegExp(/^\/product\/[0-9A-F]{8}-[0-9A-F]{4}-4[0-9A-F]{3}-[89AB][0-9A-F]{3}-[0-9A-F]{12}$/i);

if( window.location.pathname.match(new RegExp(/^\/product\/[0-9A-F]{8}-[0-9A-F]{4}-[0-9A-F]{4}-[0-9A-F]{4}-[0-9A-F]{12}$/i)) ) {


    $(document).ready(function(){

        $('[data-add-to-cart-product-id]').click(function(event){
            event.preventDefault();

            let el = $(this);

            let action = el.attr('href');
            let _token = $('input[name="_token"]').val();
            // let atc_product_uuid = $('input[name="add_to_cart[product_uuid]"]').val();
            let atc_product_uuid = $('input[name="add_to_cart_product_uuid"]').val();
            // let atc_quantity = $('input[name="add_to_cart[quantity]"]').val();
            let atc_quantity = $('input[name="add_to_cart_quantity"]').val();

            let formData = new FormData();
            formData.append('_token', _token);
            // formData.append('add_to_cart[product_uuid]', atc_product_uuid);
            formData.append('add_to_cart_product_uuid', atc_product_uuid);
            // formData.append('add_to_cart[quantity]', atc_quantity);
            formData.append('add_to_cart_quantity', atc_quantity);

            $.ajax({
                type: 'POST',
                url: action,
                data: formData,
                processData: false,
                contentType: false,
                success: function (data) {

                }
            });

        });

    });


}
