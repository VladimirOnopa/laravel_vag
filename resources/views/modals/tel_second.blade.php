<!-- Modal -->
<div class="modal fade" id="tel_second" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Добавить Телефон</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form class="invite_form" method="POST" action="{{route('add_tel_second')}}" >
            {{ csrf_field() }}

            <div class="form-group">
              <label for="tel_second">Введите ваш номер телефона </label>
              <input type="tel" class="form-control" id="tel_second" name="tel_second"  placeholder="Телефон">
            </div>
            <div class="text-info msg"></div>
            <button type="submit" class="btn btn-primary">Добавить</button>
            
        </form>     
      </div>
    </div>
  </div>
</div>
<!-- <script>
  jQuery( document ).ready(function() {
      jQuery( ".invite_form" ).submit(function( event ) {
        event.preventDefault();
        $.ajax({
            type:'POST',
            url:'/ajax_add_tel_second',
            data:{
              "_token": "{{ csrf_token() }}",
              "tel_second": jQuery('#tel_second').val()
              },
            success:function(data){
               jQuery(".msg").html(data.msg);
            }
         });
      });
  });    
</script>
 -->