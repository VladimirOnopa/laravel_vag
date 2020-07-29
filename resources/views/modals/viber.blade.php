<!-- Modal -->
<div class="modal fade" id="viber_add" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Добавить Viber</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form class="invite_form" method="POST" action="{{route('add_viber')}}" >
            {{ csrf_field() }}

            <div class="form-group">
              <label for="viber">Введите ваш номер Viber </label>
              <input type="tel" name="viber" class="form-control" id="viber"  placeholder="Телефон">
            </div>
            <div class="text-info msg"></div>
            <button type="submit" class="btn btn-primary">Добавить</button>
            
        </form>     
      </div>
    </div>
  </div>
</div>
