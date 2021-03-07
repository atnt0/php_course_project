$(document).ready(function(){



    $('.container').on('keypress', '[name="price"]', function(event){
        return /\d/.test(String.fromCharCode(event.keyCode));
    });


});
