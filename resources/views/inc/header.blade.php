@section('header')

<ul class="nav">
  <li class="nav-item">
    <a class="nav-link active" href="{{ route('home') }}">Перевозки</a>
  </li>
  <li class="nav-item">
    <a class="nav-link" href="#">Партнеры</a>
  </li>
  <li class="nav-item">
    <a class="nav-link" href="{{ route('add-cargo.index') }}">Добавить груз</a>
  </li>
  <li class="nav-item">
    <a class="nav-link " href="#">Добавить транспорт</a>
  </li>
  <li class="nav-item">
    <a class="nav-link " href="#">Поиск груза и транспорта</a>
  </li>
</ul>
