<script>
    if ($('.ty-compact-list').length > 4) {
        $('.ty-compact-list:gt(3)').hide();
        $('.show-more').show();
    }

    $('.show-more').on('click', function() {
        //toggle elements with class .ty-compact-list that their index is bigger than 2
        $('.ty-compact-list:gt(3)').toggle();
        //change text of show more element just for demonstration purposes to this demo
        $(this).text() === '{{__('web/def.but_show_more')}}' ? $(this).text('{{__('web/def.but_show_less')}}') : $(this).text('{{__('web/def.but_show_more')}}');
    });


    if ($('.ty-compact-list-units').length > 4) {
        $('.ty-compact-list-units:gt(3)').hide();
        $('.show-more-units').show();
    }

    $('.show-more-units').on('click', function() {
        //toggle elements with class .ty-compact-list that their index is bigger than 2
        $('.ty-compact-list-units:gt(3)').toggle();
        //change text of show more element just for demonstration purposes to this demo
        $(this).text() === '{{__('web/def.but_show_more')}}' ? $(this).text('{{__('web/def.but_show_less')}}') : $(this).text('{{__('web/def.but_show_more')}}');
    });
</script>
