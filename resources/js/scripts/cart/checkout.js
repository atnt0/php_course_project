

$(document).ready(function(){

    $('.container').on('click', '[data-submit="checkout"]', function(event) {
        return;
        event.preventDefault();

        let el = $(this);

        let _token_input = $('[name="_token"]');

        let form = el.parents('form');
        let formElem = form.get(0);

        let action = form.attr('action');
        let _token = _token_input.val();

        let formData = new FormData(formElem);
        // formData.append('_token', _token);

        for(var pair of formData.entries()) {
            console.log(pair[0]+ ' => '+ pair[1], );
        }


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
                console.log('data: ', data);
            }
        });


    });

});
