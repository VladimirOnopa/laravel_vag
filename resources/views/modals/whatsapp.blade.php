<!-- Modal -->
<div class="modal fade" id="whatsapp_add" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Добавить Whatsapp</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form class="invite_form" method="POST" action="{{route('add_skype')}}" >
            {{ csrf_field() }}

            <div class="form-group">
              <label for="whatsapp">Введите ваш номер Whatsapp </label>
              <input type="tel" name="whatsapp" class="form-control" id="whatsapp"  placeholder="Whatsapp">
            </div>
            <div class="text-info msg"></div>
            <button type="submit" class="btn btn-primary">Добавить</button>
            
        </form>     
      </div>
    </div>
  </div>
</div>
