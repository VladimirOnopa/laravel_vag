@section('header')

<ul class="nav nav-pills">
  <li class="nav-item">
    <a class="nav-link" href="#">Перевозки</a>
  </li>  
  <li class="nav-item">
    <a class="nav-link" href="#">Партнеры</a>
  </li>
  <li class="nav-item dropdown">
    <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">Груз</a>
    <div class="dropdown-menu">
      <a class="dropdown-item" href="{{ route('cargo.index') }}">Добавить груз</a>
      <a class="dropdown-item" href="{{ route('my-cargos') }}">Мои грузы</a>
    </div>
  </li>
  <li class="nav-item">
    <a class="nav-link" href="#">Добавить транспорт</a>
  </li>
  <li class="nav-item">
    <a class="nav-link" href="#">Поиск груза и транспорта</a>
  </li>
</ul>