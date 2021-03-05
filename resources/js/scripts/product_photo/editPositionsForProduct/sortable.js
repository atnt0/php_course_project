

$(document).ready(function () {

    $('[data-table="sortable"]').sortable({
        items : "[data-product-id]",
        handle: '.cont_item',
        // revert: true,
        cursor: 'grabbing', // grab
        tolerance: "pointer",
        update : function() {
            let container = $(this);

            let action = container.attr('data-action');
            let _token = container.find('input[name="_token"]').val();

            let formData = new FormData();
            formData.append('_token', _token);

            var postData2 = container.sortable('toArray', {
                attribute: 'data-product-id'
            });

            $.each(postData2, function(index, item){
                formData.append('photos['+ index +']', item);
            });

            $.ajax({
                type: 'POST',
                url: action,
                data: formData,
                processData: false,
                contentType: false,
                success: function (data) {
                    // console.log('return data: ', data);
                }
            });
        }
    });



});


