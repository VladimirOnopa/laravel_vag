<div class="container">
  @if(Session::has('success_remove') )
    <div class="alert alert-success" role="alert">
        {{ session('success_remove') }}
    </div>
  @elseif(Session::has('success_update'))
      <div class="alert alert-success" role="alert">
          {{ session('success_update') }}
      </div>
  @elseif(Session::has('success_add'))
      <div class="alert alert-success" role="alert">
          {{ session('success_add') }}
      </div>
  @elseif(Session::has('success_deactivate'))
      <div class="alert alert-success" role="alert">
          {{ session('success_deactivate') }}
      </div>
  @endif
</div>

<nav class="container navbar cargo_nav navbar-expand-lg navbar-light bg-light">
  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item {{ (request()->is('my-cargos')) ? 'active' : '' }}">
        <a class="nav-link" href="/my-cargos">Активные <span class="sr-only">(current)</span></a>
      </li>
      <li class="nav-item {{ (request()->is('my-cargos-archive')) ? 'active' : '' }}">
        <a class="nav-link" href="/my-cargos-archive">Архив</a>
      </li>
      
    </ul>
  </div>
</nav>

