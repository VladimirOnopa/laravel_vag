$(document).ready(function() {
    /*
        Конфигурируем календарь
     */
    $.datepicker.regional['ru'] = {
        monthNames : ['Январь','Февраль','Март','Апрель','Май','Июнь','Июль','Август','Сентябрь','Октябрь','Ноябрь','Декабрь'],
        dayNamesMin : ['Вс','Пн','Вт','Ср','Чт','Пт','Сб'],
        dateFormat: 'yy-mm-dd',
    };

    $.datepicker.setDefaults($.datepicker.regional['ru']);

    $('#date_from').datepicker({
        minDate: 0,
        onSelect: function(selected) {
            $("#date_to").datepicker("option","minDate", selected)
        }
    }).datepicker( 'setDate', new Date());  

    $('#date_to').datepicker({
        minDate: 0,
    }).datepicker( 'setDate', new Date());  

    $(function () {
      $('[data-toggle="tooltip"]').tooltip()
    })

    /*
        скрываем по клику лишние поля городов 
     */
    $( ".additional_place a" ).click(function() {
       
        if( $(this).parent().next().hasClass('hide')){
            if($(".additional_place .collapse.show").length > 5){
                alert("Максимальное количество пунктов загрузки и/или выгрузки не может превышать 8");
                return false;
            } 
            $(this).parent().next().removeClass('hide');

        }else{
            $(this).parent().next().addClass('hide');
            //выключаем колапсы collapse и очищаем value
            $.each($(this).parent().nextAll(), function( index, value ) {
               $(value).find('.collapse').collapse('hide');
               $(value).find('input').val('');
            });
            //скрываем заголовки колапсов collapse
            $.each($(this).parent().nextAll(), function( index, value ) {
                if(!$(value).hasClass('hide')){
                   $(value).addClass('hide');
                }
            });
        }
    });
    /*
        скрываем по клику показ цены и выключаем инпуты
     */
    $('input[type=radio][name=price_show]').change(function() {
        if (this.value == 0) {
            $('.show_price_block').addClass('hide');
            $('.price_block_collapse input[type=number]').val('').attr('disabled','disabled');
            $('.price_block_collapse input[type=checkbox]').val('').attr('disabled','disabled');
            $('.price_off_block').removeClass('hide');
        }else if (this.value == 1) {
            $('.price_off_block').addClass('hide');
            $('.price_on_block').removeClass('hide');
            $('.price_block_collapse input[type=number]').removeAttr('disabled');
            $('.price_block_collapse input[type=checkbox]').removeAttr('disabled');
        }
        
    });
    /*
        Скролим при открытии колапса "цены" и "доп инфо" 
     */
    $('.show_price_toggle_block a,.show_add_info_toggle_block a').on('click', function(e) {
      $('html, body').animate({
            scrollTop: $(".show_price_toggle_block").offset().top
        }, 200);
    });
    /*
        Поиск городов 
     */
    $( ".cargo_form_location" ).keyup(function() {
        var location = this.value;
        var wrapperInput = $(this).parent();
        var wrapperInputMain = $(this).parent().parent();
        if(location.length > 2){
            $.ajax({
                type:'POST',
                url:'/ajax_search_location',
                data:{
                  "_token": $('meta[name="csrf-token"]').attr('content'),
                  "location": location
                },
                success:function(response){
                    var data = response.data;

                    if(data.length>0){
                        var location = '';

                        $.each(data, function( index, value ) {
                            //проверка если область а не город
                            if(value.city_id){
                                data_name = value.city;
                                value.city = value.city+', ';
                            }else{
                                data_name=value.region;
                                value.city = '';
                                value.city_id = value.region_id;
                            }
                            //
                            if(value.region){
                                value.region = value.region+', ';
                            }else{
                                value.region = '';
                            }
                            location += '<li data-id="'+value.city_id+'" data-text="'+data_name+'"><span>'+value.city+'</span>'+value.region+' '+value.country+'</li>';
                        });

                        $(wrapperInput).find(".list_locations").show();
                        if ( $(wrapperInput).find(".list_locations").length ) {
                            $(wrapperInput).find(".list_locations").html(location);
                        }else{
                            $(wrapperInput).append('<ul class="list_locations">'+location+'</ul>');
                        }
                    }
                    //подставлям id города по клику
                    $('.list_locations>li').on('click', function(e) {
                        wrapperInputMain.find('input[type="hidden"]').val($(this).attr('data-id'));
                        wrapperInputMain.find('input[type="text"]').val($(this).attr('data-text'));
                        $( ".list_locations").hide();
                    });
                   
                }
            });
        }
    });

 

});
