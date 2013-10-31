$(function  () {
    var group = $("ol.plholder").sortable({
        group: 'plholder',
        onDrop: function (item, container, _super) {
            //first we execute the normal plugins behaviour
            _super(item, container);

            //where we drop the category
            var parent = $(item).parent();

            //values of the list
            val = $(parent).sortable().sortable('serialize').get();

            //empty UL
            if (val == '[object HTMLUListElement]') {
                val = '';
            }
            else{
                //array of values
                val = val[0].split(',');
            }
            
            //generating the array to send to the server
            var data = {};
            data['order'] = val;

            //saving the order
            $.ajax({
                type: "GET",
                url: $('#ajax_result').data('url'),
                beforeSend: function(text) {
                    $('#ajax_result').text('Saving').removeClass().addClass("label label-warning");
                },
                data: data,
                success: function(text) {
                    $('#ajax_result').text(text).removeClass().addClass("label label-success");
                }               
            });
        
             
        },
        serialize: function (parent, children, isContainer) {
             return isContainer ? children.join() : parent.attr("id");
        },

    })
})

$(function(){
    $('.index-delete').click(function(event) {
          
          $this = $(this);
          if (confirm($this.data('text')))
          {
              $('#'+$this.data('id')).hide("slow");
                return true;
          }
          else event.preventDefault();

    });
});

$(function(){
    var new_url;
    var icons;
    var title;
    $('input[type=radio]').on('click',function()
    {
        new_url = "http://" + window.location.hostname +"/"+ $(this).attr('id').replace('radio_','');
        title = $(this).attr('id').replace('radio_','');
        $('input[name=title]').val(title);
        $('input[name=url]').val(new_url);
    });
    $('#default_links').change(function()
    {
        new_url = "http://" + window.location.hostname +"/" + $('option:selected', this).attr('data-url');
        icons = $('option:selected', this).attr('data-icon');
        title = $('option:selected', this).attr('data-url');
        $('input[name=title]').val(title);
        $('input[name=url]').val(new_url);
        $('input[name=icon]').val(icons);
    });
    $('#menu_type li a').on('click', function(){
        
        if($(this).text() == 'Categories'){
            // $('#url').attr('disabled','disabled');
            $('#default-group').css('display','none');
            $('#categories-group').css('display','block');

        }
        else if($(this).text() == 'Custom'){
            // $('#url').removeAttr('disabled','disabled');
            $('#default-group').css('display','none');
            $('#categories-group').css('display','none');
        }
        else if($(this).text() == 'Default'){
            $('#categories-group').css('display','none');
            $('#default-group').css('display','block');
            // $('#url').removeAttr('disabled','disabled');
        }
    });

});