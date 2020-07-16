<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Пригласите сотрудника</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form class="invite_form" method="POST" action="{{route('ajax_invite')}}" >
        	{{ csrf_field() }}

            <div class="form-group">
              <label for="email_field">Введите Email на который будет отправленно приглашение</label>
              <input type="email" class="form-control" id="email_field" aria-describedby="emailHelp" placeholder="Email">
            </div>
            <div class="text-info msg"></div>
            <button type="submit" class="btn btn-primary">Отправить</button>
            
        </form>		
      </div>
    </div>
  </div>
</div>
<script>
	jQuery( document ).ready(function() {
		jQuery( ".invite_form" ).submit(function( event ) {
		  event.preventDefault();
		  $.ajax({
	          type:'POST',
	          url:'/ajax_invite',
	          data:{
		        "_token": "{{ csrf_token() }}",
		        "email": jQuery('#email_field').val()
		        },
	          success:function(data){
	             jQuery(".msg").html(data.msg);
	          }
	       });
		});
	});
 
	 
</script>
