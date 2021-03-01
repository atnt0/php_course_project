
let matchQueryLocation = '/product/photo/editPositionsForProduct';
if( window.location.pathname.substr(0, matchQueryLocation.length) == matchQueryLocation ){
    console.log('this is sortable for edit positions photos');


    $(document).ready(function () {
        let sortable = $('[data-table="sortable"] > tbody');

        console.log('sortable: ', sortable);

        sortable.sortable({
            handle: '.icon-move',
            onDragStart: function ($item, container, _super) {
                // Duplicate items of the no drop area
                if(!container.options.drop)
                    $item.clone().insertAfter($item);
                _super($item, container);
            },
            stop: function(event, ui) {
                var parameters = sortable.sortable('toArray');

                console.log('parameters: ', parameters);



                return;

                // $.post("studentPosition.php",{value:parameters},function(result){
                //     alert(result);
                // });
            }
        });
    });


    // $(document).ready(function () {
    //
    //     // $('div').css({'background-color': 'red'});
    //     $('.sortable').sortable({ cursor: 'move', axis: 'y', update: function () {
    //             var order = $(this).sortable('toArray');
    //             $.post('{{ URL::route('Sliders::sort') }}', { order: order })
    //         }
    //     });
    // });

}
