@extends('layouts.app')
 
@section('title', 'Добавить груз')

@section('content')

<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/css/bootstrap-select.min.css">

<!-- Latest compiled and minified JavaScript -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/js/bootstrap-select.min.js"></script>
<script src="{{ asset('js/cargo.js')}}"></script>

@include('inc.cargo-nav')
@if(isset($data['empty']))

    <div class="container cargo no_request">
        <span>У вас нет актуальных заявок на груз <a href="/cargo">Добавить заявку</a></span>
        <img src={{asset('image/empty-box.png')}} alt="empty">
    </div>

@else

	<div class="container cargo my_cargos_wrapper">

        @foreach($data['cargosList'] as $cargo)
            <div class="item_request_cargo_trans row">
                <div class="col-md-2 datatime">
                   <div>             
                        <span class="title">дата обновления</span> 
                        <span>{{  Carbon\Carbon::parse($cargo->refresh_at)->format('d.m.y') }} {{  Carbon\Carbon::parse($cargo->refresh_at)->format('H:i') }}</span>
                   </div>
                   <div>
                         <span class="title">дата размещения</span> 
                        <span>{{  Carbon\Carbon::parse($cargo->created_at)->format('d.m.y') }} {{  Carbon\Carbon::parse($cargo->created_at)->format('H:i') }}</span>
                   </div>
                </div>
                <div class="col-md-7 main_info">
                    <div class="waypoints">
                        @php
                            $points_source= end($cargo->waypoints_source);
                            $points_target= end($cargo->waypoints_target);
                        @endphp
                        <div>
                            <span>{{ $points_source['country'] }} ,</span>
                            @if(!empty($points_source['region']))
                               <span class="region">{{ $points_source['region'] }} </span>
                            @endif
                            @if(!empty($points_source['city']))
                                <span> {{ $points_source['city'] }} </span>
                            @endif
                        </div>
                        <span>&mdash;</span>
                        <div> 
                            <span>{{ $points_target['country'] }} ,</span>
                            @if(!empty($points_target['region']))
                               <span class="region">{{ $points_target['region'] }} </span>
                            @endif
                            @if(!empty($points_target['city']))
                                <span> {{ $points_target['city'] }} </span>
                            @endif
                        </div>
                    </div>
                    <div class="options_block">
                        <span class="bold">{{ $cargo->transport_body_type }}, </span>
                        <span class="bold">{{ $cargo->cargo_type_name }}, </span>
                        @foreach($cargo->options as $option)
                            @if($option->type == 'checkbox')
                                <span>{{ $option->name }}, </span>
                            @elseif($option->type == 'input')
                                <span>{{ $option->name }}: {{ $option->value }}, </span>
                            @endif
                        @endforeach
                        (
                        <span>длн={{ $cargo->size_l }} </span>
                        <span>шир={{ $cargo->size_w }} </span>
                        <span>выс={{ $cargo->size_h }} </span>
                        )
                    </div>
                    <div class="info_block"> 
                        @if(!empty($cargo->tel))
                            <span>{{ $cargo->tel }}</span>
                        @endif
                        @if(!empty($cargo->tel_second))
                             <span>{{ $cargo->tel_second }}</span>
                        @endif
                        
                        <span><i class="far fa-envelope"></i> {{ $cargo->email }}</span>
                    </div>
                </div>
                <div class="col-md-1 cargo_weight_size">
                    <div>
                        <span>{{ $cargo->weight_max }}т.</span>
                        <span>{{ $cargo->capacity }}м<sup><small>3</small></sup></span>
                    </div>
                </div>
                <div class="col-md-2 actions_links">
                    <div class="dropdown show">
                      <a class="btn btn-secondary dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        действия с заявкой
                      </a>

                      <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                        <a class="dropdown-item" href="/refresh_request/{{$cargo->id}}">
                            Обновить заявку
                            <i class="fas fa-info-circle" data-toggle="tooltip" data-placement="right" title="Поднять вверху списка вашу заявку в общем списке"></i>
                        </a>
                        <a class="dropdown-item" href="/cargo/{{$cargo->id}}/edit">Редактировать заявку</a>
                        <a class="dropdown-item" href="#">Активировать заявку</a>
                        <a class="dropdown-item text-danger" href="/deactivate_request/{{$cargo->id}}">
                            Снять заявку
						</a>
                        <a class="dropdown-item" href="#">
                            <form action="{{ url('cargo', ['id' => $cargo->id]) }}" method="post">
                                <input  type="submit"  onclick="return confirm('Удалить заявку?');" value="Удалить заявку" />
                                <input type="hidden" name="_method" value="delete" />
                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                            </form>  
                        </a>
                      </div>
                    </div>
                </div>
            </div>
        @endforeach
	</div>
@endif

@endsection
