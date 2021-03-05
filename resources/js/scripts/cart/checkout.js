

$(document).ready(function(){

    $('.container').on('click', '[data-submit="checkout"]', function(event) {
        event.preventDefault();

        let el = $(this);

        let form = el.parents('form');
        let formElem = form.get(0);

        let formData = new FormData(formElem);

        for(var pair of formData.entries()) {
            console.log(pair[0]+ ', '+ pair[1], );
        }

    });

});
