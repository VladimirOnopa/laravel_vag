@extends('layouts.app')
 
@section('title', 'Добавить груз')

@section('content')

<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/css/bootstrap-select.min.css">

<!-- Latest compiled and minified JavaScript -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/js/bootstrap-select.min.js"></script>
<script src="{{ asset('js/cargo.js')}}"></script>

<div class="container">
    <div class="card cargo_trans_wrapper">
        <div class="card-header">{{ __('Добавление заявки на перевозку груза укажите пожалуйста населенные пункты погрузки и выгрузки, параметры груза и контактную информацию') }}</div>

            <div class="card-body" style="font-size: 14px;">
                @if(Session::has('message_add_info_user'))
                    <div class="alert alert-success" role="alert">
                        {{ session('message_add_info_user') }}
                    </div>
                @endif

                @error('max_locations')
                    <span class="text-danger" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror

                <form method="POST" action="{{ route('cargo.index') }}">
                    @csrf

                    <div class="form-group row border_">
                        
                        <div class="col-md-6">
                             <!-- Дата погрузки -->
                            <div class="d-flex-item">
                                
                                <h5 class="title_">{{ __('Погрузка: с') }}</h5>
                                <input id="date_from" type="text" class="form-control col-md-3 @error('date_from') is-invalid @enderror" name="date_from"  required autocomplete="date_from" >

                                @error('date_from')
                                    <span class="text-danger" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror


                                <label for="date_to" class="col-form-label">{{ __('по') }}</label>
                                <input id="date_to" type="text" class="form-control col-md-3 @error('date_to') is-invalid @enderror" name="date_to" required autocomplete="date_to" >

                                @error('date_to')
                                    <span class="text-danger" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                             <!-- Место погрузки -->

                            <div class="d-flex cargo_trans_city_wrp additional_place">
                                <label for="cargo_from_1" class="col-md-4 col-form-label"><h5 class="title_">{{ __('Нас. пункт погрузки:') }}</h5></label>
                                <div>
                                    <input id="cargo_from_1" type="text" class="form-control cargo_form_location" name="cargo_from_1" value="@if(isset($data['cargoRequestData']->waypoints_source[0]->city)){{$data['cargoRequestData']->waypoints_source[0]->city}}@elseif(isset($data['cargoRequestData']->waypoints_source[0]->region)) {{$data['cargoRequestData']->waypoints_source[0]->region}}@endif" required autocomplete="date_from">
                                </div>
                                <input id="cargo_from" type="hidden" class="form-control " name="cargo_from[1]" value="@if(isset($data['cargoRequestData']->waypoints_source[0]->city_id)) {{$data['cargoRequestData']->waypoints_source[0]->city_id}} @elseif(isset($data['cargoRequestData']->waypoints_source[0]->region_id)) {{$data['cargoRequestData']->waypoints_source[0]->region_id}}@endif" required autocomplete="date_from">
                            </div>
                            @error('cargo_from.*')
                                 <span class="text-danger" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror


                            <div class="d-flex additional_place">
    							<a  class="col-md-4" data-toggle="collapse" href="#collapse1" role="button" aria-expanded="false" aria-controls="collapse1">2 место погрузки</a>
    							<div class="collapse" id="collapse1">
                                    <div>
                                        <input  type="text" class="form-control cargo_form_location" name="cargo_from_2" value="@if(isset($data['cargoRequestData']->waypoints_source[1]->city)){{$data['cargoRequestData']->waypoints_source[1]->city}}@elseif(isset($data['cargoRequestData']->waypoints_source[1]->region)) {{$data['cargoRequestData']->waypoints_source[1]->region}} @endif" autocomplete="date_from">
                                    </div>
    							    <input id="cargo_from" type="hidden" name="cargo_from[2]" value="@if(isset($data['cargoRequestData']->waypoints_source[1]->city_id)){{$data['cargoRequestData']->waypoints_source[1]->city_id}}@elseif(isset($data['cargoRequestData']->waypoints_source[1]->region_id)) {{$data['cargoRequestData']->waypoints_source[1]->region_id}}@endif">
    							</div>
    						</div>
                            <div class="d-flex additional_place hide">
    							<a class="col-md-4"  data-toggle="collapse" href="#collapse2" role="button" aria-expanded="false" aria-controls="collapse2">3 место погрузки</a>
    							<div class="collapse" id="collapse2">
                                    <div>
                                        <input  type="text" class="form-control cargo_form_location" name="cargo_from_3" value="@if(isset($data['cargoRequestData']->waypoints_source[2]->city)){{$data['cargoRequestData']->waypoints_source[2]->city}}@elseif(isset($data['cargoRequestData']->waypoints_source[2]->region)) {{$data['cargoRequestData']->waypoints_source[2]->region}} @endif" autocomplete="date_from">
                                    </div>
                                    <input id="cargo_from" type="hidden" name="cargo_from[3]" value="@if(isset($data['cargoRequestData']->waypoints_source[2]->city_id)){{$data['cargoRequestData']->waypoints_source[2]->city_id}}@elseif(isset($data['cargoRequestData']->waypoints_source[2]->region_id)) {{$data['cargoRequestData']->waypoints_source[2]->region_id}}@endif">
    							</div>
    						</div> 
                            <div class="d-flex additional_place hide">
    							<a class="col-md-4"  data-toggle="collapse" href="#collapse3" role="button" aria-expanded="false" aria-controls="collapse3">4 место погрузки</a>
    							<div class="collapse" id="collapse3">
    							     <div>
                                        <input  type="text" class="form-control cargo_form_location" name="cargo_from_4" value="@if(isset($data['cargoRequestData']->waypoints_source[3]->city)){{$data['cargoRequestData']->waypoints_source[3]->city}}@elseif(isset($data['cargoRequestData']->waypoints_source[3]->region)) {{$data['cargoRequestData']->waypoints_source[3]->region}} @endif" autocomplete="date_from">
                                    </div>
                                    <input id="cargo_from" type="hidden" name="cargo_from[4]" value="@if(isset($data['cargoRequestData']->waypoints_source[3]->city_id)){{$data['cargoRequestData']->waypoints_source[3]->city_id}}@elseif(isset($data['cargoRequestData']->waypoints_source[3]->region_id)) {{$data['cargoRequestData']->waypoints_source[3]->region_id}}@endif">
    							</div>
    						</div>
                            <div class="d-flex additional_place hide">
    							<a class="col-md-4"  data-toggle="collapse" href="#collapse4" role="button" aria-expanded="false" aria-controls="collapse4">5 место погрузки</a>
    							<div class="collapse" id="collapse4">
    							     <div>
                                        <input  type="text" class="form-control cargo_form_location" name="cargo_from_5" value="@if(isset($data['cargoRequestData']->waypoints_source[4]->city)){{$data['cargoRequestData']->waypoints_source[4]->city}}@elseif(isset($data['cargoRequestData']->waypoints_source[4]->region)) {{$data['cargoRequestData']->waypoints_source[4]->region}} @endif" autocomplete="date_from">
                                    </div>
                                    <input id="cargo_from" type="hidden" name="cargo_from[5]" value="@if(isset($data['cargoRequestData']->waypoints_source[4]->city_id)){{$data['cargoRequestData']->waypoints_source[4]->city_id}}@elseif(isset($data['cargoRequestData']->waypoints_source[4]->region_id)) {{$data['cargoRequestData']->waypoints_source[4]->region_id}}@endif">
    							</div>
    						</div>  
    						<div class="d-flex additional_place hide">
    							<a class="col-md-4"  data-toggle="collapse" href="#collapse6" role="button" aria-expanded="false" aria-controls="collapse6">6 место погрузки</a>
    							<div class="collapse" id="collapse6">
    							     <div>
                                        <input  type="text" class="form-control cargo_form_location" name="cargo_from_6" value="@if(isset($data['cargoRequestData']->waypoints_source[5]->city)){{$data['cargoRequestData']->waypoints_source[5]->city}}@elseif(isset($data['cargoRequestData']->waypoints_source[5]->region)) {{$data['cargoRequestData']->waypoints_source[5]->region}} @endif" autocomplete="date_from">
                                    </div>
                                    <input id="cargo_from" type="hidden" name="cargo_from[6]" value="@if(isset($data['cargoRequestData']->waypoints_source[5]->city_id)){{$data['cargoRequestData']->waypoints_source[5]->city_id}}@elseif(isset($data['cargoRequestData']->waypoints_source[5]->region_id)) {{$data['cargoRequestData']->waypoints_source[5]->region_id}}@endif">
    							</div>
    						</div>
                            <div class="d-flex additional_place hide">
    							<a class="col-md-4"  data-toggle="collapse" href="#collapse7" role="button" aria-expanded="false" aria-controls="collapse7">7 место погрузки</a>
    							<div class="collapse" id="collapse7">
    							     <div>
                                        <input  type="text" class="form-control cargo_form_location" name="cargo_from_7" value="@if(isset($data['cargoRequestData']->waypoints_source[6]->city)){{$data['cargoRequestData']->waypoints_source[6]->city}}@elseif(isset($data['cargoRequestData']->waypoints_source[6]->region)) {{$data['cargoRequestData']->waypoints_source[6]->region}} @endif" autocomplete="date_from">
                                    </div>
                                    <input id="cargo_from" type="hidden" name="cargo_from[7]" value="@if(isset($data['cargoRequestData']->waypoints_source[6]->city_id)){{$data['cargoRequestData']->waypoints_source[6]->city_id}}@elseif(isset($data['cargoRequestData']->waypoints_source[6]->region_id)) {{$data['cargoRequestData']->waypoints_source[6]->region_id}}@endif">
    							</div>
    						</div>
                        </div>

                        <div class="col-md-6 unload_block_top additional_place">
                            <h5 class="title_">Выгрузка</h5>
                            <div class="d-flex cargo_trans_city_wrp">
                                <label for="cargo_to" class="col-md-4 col-form-label "><h5 class="title_">{{ __('Нас. пункт выгрузки:') }}</h5></label>
                                <div>
                                    <input  type="text" class="form-control cargo_form_location" name="cargo_to_1" value="@if(isset($data['cargoRequestData']->waypoints_target[0]->city)){{$data['cargoRequestData']->waypoints_target[0]->city}}@elseif(isset($data['cargoRequestData']->waypoints_target[0]->region)) {{$data['cargoRequestData']->waypoints_target[0]->region}} @endif" required autocomplete="date_from">
                                </div>
                                <input id="cargo_to" type="hidden" name="cargo_to[1]" value="@if(isset($data['cargoRequestData']->waypoints_target[0]->city_id)){{$data['cargoRequestData']->waypoints_target[0]->city_id}}@elseif(isset($data['cargoRequestData']->waypoints_target[0]->region_id)) {{$data['cargoRequestData']->waypoints_target[0]->region_id}}@endif">
                            </div>
                              @error('cargo_to.*')
                                 <span class="text-danger" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                            <div class="d-flex additional_place ">
    							<a class="col-md-4" data-toggle="collapse" href="#collapse_to1" role="button" aria-expanded="false" aria-controls="collapse_to1">2 место выгрузки</a>
    							<div class="collapse" id="collapse_to1">
    							    <div>
                                        <input  type="text" class="form-control cargo_form_location" name="cargo_to_2" value="@if(isset($data['cargoRequestData']->waypoints_target[1]->city)){{$data['cargoRequestData']->waypoints_target[1]->city}}@elseif(isset($data['cargoRequestData']->waypoints_target[1]->region)) {{$data['cargoRequestData']->waypoints_target[1]->region}} @endif" autocomplete="date_from">
                                    </div>
                                    <input id="cargo_to" type="hidden" name="cargo_to[2]" value="@if(isset($data['cargoRequestData']->waypoints_target[1]->city_id)){{$data['cargoRequestData']->waypoints_target[1]->city_id}}@elseif(isset($data['cargoRequestData']->waypoints_target[1]->region_id)) {{$data['cargoRequestData']->waypoints_target[1]->region_id}}@endif">
    							</div>
    						</div>
                            <div class="d-flex additional_place hide">
    							<a class="col-md-4" data-toggle="collapse" href="#collapse_to2" role="button" aria-expanded="false" aria-controls="collapse_to2">3 место выгрузки</a>
    							<div class="collapse" id="collapse_to2">
    							    <div>
                                        <input  type="text" class="form-control cargo_form_location" name="cargo_to_3" value="@if(isset($data['cargoRequestData']->waypoints_target[2]->city)){{$data['cargoRequestData']->waypoints_target[2]->city}}@elseif(isset($data['cargoRequestData']->waypoints_target[2]->region)) {{$data['cargoRequestData']->waypoints_target[2]->region}} @endif" autocomplete="date_from">
                                    </div>
                                    <input id="cargo_to" type="hidden" name="cargo_to[3]" value="@if(isset($data['cargoRequestData']->waypoints_target[2]->city_id)){{$data['cargoRequestData']->waypoints_target[2]->city_id}}@elseif(isset($data['cargoRequestData']->waypoints_target[2]->region_id)) {{$data['cargoRequestData']->waypoints_target[2]->region_id}}@endif">
    							</div>
    						</div>
                            <div class="d-flex additional_place hide">
    							<a class="col-md-4" data-toggle="collapse" href="#collapse_to3" role="button" aria-expanded="false" aria-controls="collapse_to3">4 место выгрузки</a>
    							<div class="collapse" id="collapse_to3">
    							    <div>
                                        <input  type="text" class="form-control cargo_form_location" name="cargo_to_4" value="@if(isset($data['cargoRequestData']->waypoints_target[3]->city)){{$data['cargoRequestData']->waypoints_target[3]->city}}@elseif(isset($data['cargoRequestData']->waypoints_target[3]->region)) {{$data['cargoRequestData']->waypoints_target[3]->region}} @endif" autocomplete="date_from">
                                    </div>
                                    <input id="cargo_to" type="hidden" name="cargo_to[4]" value="@if(isset($data['cargoRequestData']->waypoints_target[3]->city_id)){{$data['cargoRequestData']->waypoints_target[3]->city_id}}@elseif(isset($data['cargoRequestData']->waypoints_target[3]->region_id)) {{$data['cargoRequestData']->waypoints_target[3]->region_id}}@endif">
    							</div>
    						</div>
                            <div class="d-flex additional_place hide">
    							<a class="col-md-4" data-toggle="collapse" href="#collapse_to4" role="button" aria-expanded="false" aria-controls="collapse_to4">5 место выгрузки</a>
    							<div class="collapse" id="collapse_to4">
    							   <div>
                                        <input  type="text" class="form-control cargo_form_location" name="cargo_to_5" value="@if(isset($data['cargoRequestData']->waypoints_target[4]->city)){{$data['cargoRequestData']->waypoints_target[4]->city}}@elseif(isset($data['cargoRequestData']->waypoints_target[4]->region)) {{$data['cargoRequestData']->waypoints_target[4]->region}} @endif" autocomplete="date_from">
                                    </div>
                                    <input id="cargo_to" type="hidden" name="cargo_to[5]" value="@if(isset($data['cargoRequestData']->waypoints_target[4]->city_id)){{$data['cargoRequestData']->waypoints_target[4]->city_id}}@elseif(isset($data['cargoRequestData']->waypoints_target[4]->region_id)) {{$data['cargoRequestData']->waypoints_target[4]->region_id}}@endif">
    							</div>
    						</div>  
    						<div class="d-flex additional_place hide">
    							<a class="col-md-4" data-toggle="collapse" href="#collapse_to5" role="button" aria-expanded="false" aria-controls="collapse_to5">6 место выгрузки</a>
    							<div class="collapse" id="collapse_to5">
    							    <div>
                                        <input  type="text" class="form-control cargo_form_location" name="cargo_to_6" value="@if(isset($data['cargoRequestData']->waypoints_target[5]->city)){{$data['cargoRequestData']->waypoints_target[5]->city}}@elseif(isset($data['cargoRequestData']->waypoints_target[5]->region)) {{$data['cargoRequestData']->waypoints_target[5]->region}} @endif" autocomplete="date_from">
                                    </div>
                                    <input id="cargo_to" type="hidden" name="cargo_to[6]" value="@if(isset($data['cargoRequestData']->waypoints_target[5]->city_id)){{$data['cargoRequestData']->waypoints_target[5]->city_id}}@elseif(isset($data['cargoRequestData']->waypoints_target[5]->region_id)) {{$data['cargoRequestData']->waypoints_target[5]->region_id}}@endif">
    							</div>
    						</div>
                            <div class="d-flex additional_place hide">
    							<a class="col-md-4" data-toggle="collapse" href="#collapse_to6" role="button" aria-expanded="false" aria-controls="collapse_to6">7 место выгрузки</a>
    							<div class="collapse" id="collapse_to6">
    							    <div>
                                        <input  type="text" class="form-control cargo_form_location" name="cargo_to_7" value="@if(isset($data['cargoRequestData']->waypoints_target[6]->city)){{$data['cargoRequestData']->waypoints_target[6]->city}}@elseif(isset($data['cargoRequestData']->waypoints_target[6]->region)) {{$data['cargoRequestData']->waypoints_target[6]->region}} @endif" autocomplete="date_from">
                                    </div>
                                    <input id="cargo_to" type="hidden" name="cargo_to[7]" value="@if(isset($data['cargoRequestData']->waypoints_target[6]->city_id)){{$data['cargoRequestData']->waypoints_target[6]->city_id}}@elseif(isset($data['cargoRequestData']->waypoints_target[6]->region_id)) {{$data['cargoRequestData']->waypoints_target[6]->region_id}}@endif">
    							</div>
    						</div>
                        </div>

                    </div>

                    <div class="form-group row border_">
                        
                        <div class="col-md-6 cargo_trans_size_block">
                             <!-- Грузы  -->
                                <div class="d-flex">
                                    <label for="cargo_type" class="col-md-4 col-form-label "> <h5 class="title_">{{ __('Характер груза:') }}</h5></label>
                                    <select class="selectpicker" name='cargo_type'>
                                        @foreach($data['cargoList'] as $cargo)
                                             <option value="{{$cargo->id}}">{{$cargo->name}} </option>
                                        @endforeach
                                     </select>


                                    @error('cargo_type')
                                        <span class="text-danger" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror

                                </div>
                                <div class="d-flex">
                                    <label for="weight" class="col-md-4 col-form-label text-md-left">{{ __('вес груза (т):') }}</label>
                                    <input id="weight" type="number" class="form-control col-md-3 @error('weight') is-invalid @enderror" name="weight" value="@if(isset($data['cargoRequestData']->weight_max)){{$data['cargoRequestData']->weight_max}}@endif" required>

                                    @error('weight')
                                        <span class="text-danger" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                <div class="d-flex">
                                    <label for="capacity" class="col-md-4 col-form-label text-md-left">{{ __('объем груза (м³):') }}</label>
                                    <input id="capacity" type="number" class="form-control col-md-3 @error('capacity') is-invalid @enderror" name="capacity" value="@if(isset($data['cargoRequestData']->capacity)){{$data['cargoRequestData']->capacity}}@endif" required autocomplete="capacity">

                                    @error('capacity')
                                        <span class="text-danger" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                <div class="d-flex show_price_toggle_block">
                                    <h5 class="title_ ">{{ __('Стоимость перевозки:') }}</h5>
                                    <a  data-toggle="collapse" href="#collapseExample2" role="button" aria-expanded="false" aria-controls="collapseExample2" class="collapsed">Указать</a>
                                </div>
                            </div>


                           <div class="col-md-6 cargo_trans_size_block">
                                
                                <div class="d-flex">
                                    <label for="transport_type" class="col-md-4 col-form-label text-md-left">{{ __('Тип транспорта:') }}</label>
                                    
                                     <select class="selectpicker col-md-4" name="transport_type" id="transport_type">
                                         @foreach($data['transport_type'] as $transport)
                                             <option value="{{$transport->id}}">{{$transport->name}}</option>
                                        @endforeach
                                    </select>

                                    @error('transport_type')
                                        <span class="text-danger" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror

                                </div>

                                <div class="d-flex">
                                    <label for="quantity_transport" class="col-md-4 col-form-label">{{ __('Кол-во машин:   ') }}</label>
                                    <input id="quantity_transport" type="number" class="form-control col-md-2 @error('quantity_transport') is-invalid @enderror" name="quantity_transport" value="@if(isset($data['cargoRequestData']->quantity_transport)){{$data['cargoRequestData']->quantity_transport}}@endif" required autocomplete="quantity_transport">

                                    @error('quantity_transport')
                                        <span class="text-danger" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                <div class="size_block">
                                    <h5 class="title_">{{ __('Указать размеры груза, в метрах ') }}</h5>
                                    <div class="d-flex">
                                        <label for="gabarit_cargo_length" class="col-md-2 col-form-label">{{ __('длина :') }}</label>
                                        <input id="gabarit_cargo_length" type="number" class="form-control col-md-2 @error('gabarit_cargo_length') is-invalid @enderror" name="gabarit_cargo_length" value="@if(isset($data['cargoRequestData']->size_l)){{$data['cargoRequestData']->size_l}}@endif" required >

                                        @error('gabarit_cargo_length')
                                            <span class="text-danger" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror

                                        <label for="gabarit_cargo_width" class="col-md-2 col-form-label">{{ __('ширина:') }}</label>
                                        <input id="gabarit_cargo_width" type="number" class="form-control col-md-2 @error('gabarit_cargo_width') is-invalid @enderror" name="gabarit_cargo_width" value="@if(isset($data['cargoRequestData']->size_w)){{$data['cargoRequestData']->size_w}}@endif" required >

                                        @error('gabarit_cargo_width')
                                            <span class="text-danger" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror

                                        <label for="gabarit_cargo_height" class="col-md-2 col-form-label text-md-left">{{ __('высота:') }}</label>
                                        <input id="gabarit_cargo_height" type="number" class="form-control col-md-2 @error('gabarit_cargo_height') is-invalid @enderror" name="gabarit_cargo_height" value="@if(isset($data['cargoRequestData']->size_h)){{$data['cargoRequestData']->size_h}}@endif" required >

                                        @error('gabarit_cargo_height')
                                            <span class="text-danger" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                            </div>
                        </div>

                       

                        <div class="collapse price_block_collapse" id="collapseExample2">
                             <div class="container-fluid">
                                <div class="row">

                                    <div class="col-md-6 show_price_block price_on_block @if(isset($data['cargoRequestData']->price_show) && $data['cargoRequestData']->price_show == 0 )hide @elseif(isset($data['cargoRequestData']->price_show) && $data['cargoRequestData']->price_show == 1) @else hide @endif">
                                        <div class="d-flex align-items-lg-center">
                                            <input type="radio" checked="checked" id="price_show_on" name="price_show" value="1" @if(isset($data['cargoRequestData']->price_show) && $data['cargoRequestData']->price_show == 1 ) checked @endif>
                                            <label for="price_show_on" class="col-md-11 col-form-label ">
                                                <h5 class="title_">{{ __('Указать стоимость перевозки и форму оплаты') }}</h5>
                                            </label>
                                        </div>
                                        
                                        <div class="d-flex align-items-lg-center price_amount_block">
                                            <label for="price_amount" class="col-md-4 col-form-label ">{{ __('Стоимость перевозки:') }}</label>
                                            <input id="price_amount" type="number" class="form-control col-md-2 @error('price_amount') is-invalid @enderror" name="price_amount" value="@if(isset($data['cargoRequestData']->price_amount)){{$data['cargoRequestData']->price_amount}}@endif"  autocomplete="price_amount" placeholder="1000" @if(isset($data['cargoRequestData']->price_show) && $data['cargoRequestData']->price_show == 0 )disabled @elseif(isset($data['cargoRequestData']->price_show) && $data['cargoRequestData']->price_show == 1) @else disabled @endif>
                                            <span class="divider_symbol">/</span>
                                            @error('price_amount')
                                                <span class="text-danger" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                            <select name="currency" id="currency" class="selectpicker">
                                                @foreach($data['currency'] as $option) 
                                                 <option value="{{$option->id}}"@if(isset($data['cargoRequestData']->currency) && $data['cargoRequestData']->currency == $option->id) selected @endif>{{$option->name}}</option>
                                                @endforeach
                                            </select>  
                                            @error('currency')
                                                <span class="text-danger" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                            <select name="payment_per_type" id="payment_per_type" class="selectpicker">
                                                @foreach($data['payment_per_type'] as $option)
                                                 <option value="{{$option->id}}" @if(isset($data['cargoRequestData']->per_type) && $data['cargoRequestData']->per_type == $option->id) selected @endif>{{$option->name}}</option>
                                                @endforeach
                                            </select>
                                            @error('payment_per_type')
                                                <span class="text-danger" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>

                                        <div class="d-flex align-items-lg-center ">
                                            <label for="payment_type" class="col-md-4 col-form-label text-md-left ">{{ __('Форма оплаты:') }}</label>
                                            <select name="payment_type" id="payment_type" class="selectpicker ">
                                                @foreach($data['payment_type'] as $option)
                                                 <option value="{{$option->id}}" @if(isset($data['cargoRequestData']->payment_type) && $data['cargoRequestData']->payment_type == $option->id) selected @endif>{{$option->name}}</option>
                                                @endforeach
                                            </select>
                                            @error('payment_type')
                                                <span class="text-danger" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                            <input id="nds" type="checkbox"  name="nds" value="1"  @if(isset($data['cargoRequestData']->nds)) checked @endif @if(isset($data['cargoRequestData']->price_show) && $data['cargoRequestData']->price_show == 0 ) disabled @elseif(isset($data['cargoRequestData']->price_show) && $data['cargoRequestData']->price_show == 1) @else disabled @endif>
                                            <label for="nds" class="col-md-3 col-form-label text-md-left ">{{ __('с НДС') }}</label>
                                            @error('nds')
                                                <span class="text-danger" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>

                                        <div class="d-flex align-items-lg-center">
                                            <label for="prepay" class="col-md-4 col-form-label text-md-left ">{{ __('Предоплата:') }}</label>
                                            <input id="prepay" type="number" class="form-control col-md-3"  name="prepay" value="@if(isset($data['cargoRequestData']->prepay)){{$data['cargoRequestData']->prepay}}@endif"  @if(isset($data['cargoRequestData']->price_show) && $data['cargoRequestData']->price_show == 0 )disabled @elseif(isset($data['cargoRequestData']->price_show) && $data['cargoRequestData']->price_show == 1) @else disabled @endif> 
                                            <span class="divider_symbol">%</span>
                                            @error('prepay')
                                                <span class="text-danger" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>

                                        <div class="d-flex align-items-lg-center">
                                            <label for="payment_time" class="col-md-4 col-form-label text-md-left ">{{ __('Момент оплаты:') }}</label>
                                            <select name="payment_time" id="payment_time" class="selectpicker">
                                                @foreach($data['payment_moment'] as $option)
                                                 <option value="{{$option->id}}" @if(isset($data['cargoRequestData']->payment_time) && $data['cargoRequestData']->payment_time == $option->id) selected @endif>{{$option->name}}</option>
                                                @endforeach
                                            </select>
                                            @error('payment_time')
                                                <span class="text-danger" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>


                                    </div>
                                    <div class="col-md-6 show_price_block price_off_block @if(isset($data['cargoRequestData']->price_show) && $data['cargoRequestData']->price_show == 1 ) hide @endif">
                                        <div class="d-flex align-items-lg-center">
                                            <input type="radio" name="price_show" id="price_show_off" value="0" @if(isset($data['cargoRequestData']->price_show) && $data['cargoRequestData']->price_show == 0 ) checked @elseif(!isset($data['cargoRequestData']->price_show)) checked @endif>
                                            <label for="price_show_off" class="col-md-11 col-form-label">
                                                <h5 class="title_">{{ __('Не указывать стоимость перевозки(цена договорная)') }}</h5>
                                            </label>
                                        </div>
                                    </div>

                                </div>
                               
                             </div>
                        </div>


                    


                    <div class="form-group row">
                        
                        <div class="col-md-6 notice_block">
                            <label for="notice" class="col-md-3 col-form-label text-md-left"><h5 class="title_">{{ __('Примечания:') }}</h5></label>
                            <textarea class="form-control col-md-12" id="notice" rows="3" name="notice" placeholder="Примечания к заявке / макс. 500 символов">@if(!empty($data['cargoRequestData']->notice)){{$data['cargoRequestData']->notice}}@endif</textarea>
                             @error('notice')
                                <span class="text-danger" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="col-md-4 user_info_block_wrapper">
     
                            <div class="input_wrapper_block">
                                <label for="tel" class="col-md-11 col-form-label text-md-left"> 
                                    <h5 class="title_ ">{{ __('Телефон :') }}</h5> 
                                    <input id="tel" type="checkbox" class=" @error('tel') is-invalid @enderror" name="tel" value="{{ $data['user']['tel']}}" @if(!empty($data['cargoRequestData']->tel)) checked @endif>
                                    {{ $data['user']['tel']}}
                                    @error('tel')
                                        <span class="text-danger" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </label>
                                
                               
                            </div>
                            
                            
                                <div class="input_wrapper_block">
                                    <label for="tel_second" class="col-md-11 col-form-label text-md-left">
                                        <h5 class="title_"></h5>  
                                    @if(!empty($data['user']['tel_second']))                          
                                        <input id="tel_second" type="checkbox" class=" @error('tel_second') is-invalid @enderror" name="tel_second" value="{{ $data['user']['tel_second']}}"  @if(!empty($data['cargoRequestData']->tel_second)) checked @endif>
                                        {{ $data['user']['tel_second']}}
                                        </label>
                                    @else
                                        <div class="add_extra_user_data_block">
                                            <a href="javaScript:void(0);"  data-toggle="modal" data-target="#tel_second">Добавить</a>
                                        </div>
                                    @endif
                                </div>
                                @error('tel_second')
                                    <span class="text-danger" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            

                            <div class="input_wrapper_block">
                                <label for="email" class="col-md-11 col-form-label text-md-left">
                                    <h5 class="title_">{{ __('Email:') }}</h5>
                                    <input id="email" type="checkbox" class=" @error('email') is-invalid @enderror" name="email" value="{{ $data['user']['email']}}" required autocomplete="email" @if(!empty($data['cargoRequestData']->email)) checked @endif> 
                                    {{ $data['user']['email']}}
                                </label>
                                @error('email')
                                    <span class="text-danger" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                           
                            <div class="input_wrapper_block">
                                <label for="viber" class="col-md-11 col-form-label text-md-left">
                                    <h5 class="title_ ">{{ __('Viber :') }}</h5>
                                    @if(!empty($data['user']['viber']))
                                        <input id="viber" type="checkbox" class=" @error('viber') is-invalid @enderror" name="viber" value="{{ $data['user']['viber']}}" @if(!empty($data['cargoRequestData']->viber)) checked @endif>
                                        {{ $data['user']['viber']}}
                                    @else
                                        <a href="javaScript:void(0);"  data-toggle="modal" data-target="#viber_add">Добавить</a>
                                    @endif
                                </label>
                                @error('viber')
                                    <span class="text-danger" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                           
                            <div class="input_wrapper_block">
                                <label for="skype" class="col-md-11 col-form-label text-md-left">
                                    <h5 class="title_ ">{{ __('Skype :') }}</h5>
                                    @if(!empty($data['user']['skype']))
                                        <input id="skype" type="checkbox" class=" @error('skype') is-invalid @enderror" name="skype" value="{{ $data['user']['skype']}}" @if(!empty($data['cargoRequestData']->skype)) checked @endif>
                                        {{ $data['user']['skype']}}
                                    @else
                                        <a href="javaScript:void(0);"  data-toggle="modal" data-target="#skype_add">Добавить</a>
                                    @endif
                                </label>
                                @error('skype')
                                    <span class="text-danger" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="input_wrapper_block">
                                <label for="whatsapp" class="col-md-11 col-form-label text-md-left">
                                    <h5 class="title_ ">{{ __('Whatsapp :') }}</h5>
                                    @if(!empty($data['user']['whatsapp']))
                                        <input id="whatsapp" type="checkbox" class=" @error('whatsapp') is-invalid @enderror" name="whatsapp" value="{{ $data['user']['whatsapp']}}" @if(!empty($data['cargoRequestData']->whatsapp)) checked @endif>
                                        {{ $data['user']['whatsapp']}}
                                    @else
                                        <a href="javaScript:void(0);"  data-toggle="modal" data-target="#whatsapp_add">Добавить</a>
                                    @endif
                                </label>
                                @error('whatsapp')
                                    <span class="text-danger" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                        </div>

                    </div>
                    <div class="form-group row px-3 show_add_info_toggle_block">
                        <div class="col-md-12 d-flex">
                            <h5 class="title_ ">{{ __('Дополнительная информация') }}</h5>
                            <a class="collapsed" data-toggle="collapse" href="#collapseExample" role="button" aria-expanded="false" aria-controls="collapseExample">Указать</a>     
                        </div>
                    </div>
                    <div class="collapse add_info_wrapper" id="collapseExample">
                        <div class="container-fluid">
                            <div class="row">
                              <div class="col-md-2">
                                <div class="col-md-12 px-0"> <h6>Документы</h6></div>

                                 @foreach($data['options'] as $option)
                                    @if($option->group == 'documents') 

                                        @if($option->type == 'checkbox')
                                             <div class="col-md-12 items_add_info">
                                                <input id="option_{{ $option->id }}" type="checkbox"  name="option[{{ $option->id }}]" value="1" @if(isset($data['cargoRequestData'])) @foreach($data['cargoRequestData']->options as $selected) @if( $option->id == $selected->id) checked @endif @endforeach @endif >
                                                <label for="option_{{ $option->id }}" class="text-md-left" style="font-size: 13px;line-height: 12px;">{{ $option->name }}</label>
                                            </div>
                                        @endif
                                        @if($option->type == 'input')
                                            <div class="col-md-12 items_add_info">
                                                <label for="option_{{ $option->id }}" class="text-md-left" style="font-size: 13px;line-height: 12px;">{{ $option->name }}</label>
                                                <input id="option_{{ $option->id }}" type="text"  name="option[{{ $option->id }}]" value='<?php if(isset($data['cargoRequestData'])){
                                                     foreach($data['cargoRequestData']->options as $selected) {
                                                        if($option->id == $selected->id){
                                                            echo $selected->value;
                                                        }
                                                     }
                                                }?>' style="width: 70px;height: 20px;">
                                            </div>
                                        @endif

                                    @endif
                                @endforeach

                              </div>
                              <div class="col-md-5 row">
                               <div class="col-md-6 px-0"> <h6>Погрузка</h6></div>
                               
                                 @foreach($data['options'] as $option)

                                    @if($option->group == 'cargo_load')

                                        @if($option->type == 'checkbox')
                                             <div class="col-md-6 items_add_info">
                                                <input id="option_{{ $option->id }}" type="checkbox"  name="option[{{ $option->id }}]" value="1" @if(isset($data['cargoRequestData'])) @foreach($data['cargoRequestData']->options as $selected) @if( $option->id == $selected->id) checked @endif @endforeach @endif> 
                                                <label for="option_{{ $option->id }}" class="text-md-left" style="font-size: 13px;line-height: 12px;">{{ $option->name }}</label> 
                                            </div>
                                        @endif
                                        @if($option->type == 'input')
                                            <div class="col-md-6 items_add_info">
                                                <label for="option_{{ $option->id }}" class="text-md-left" style="font-size: 13px;line-height: 12px;">{{ $option->name }}</label>
                                                <input id="option_{{ $option->id }}" type="text"  name="option[{{ $option->id }}]" value='<?php if(isset($data['cargoRequestData'])){
                                                     foreach($data['cargoRequestData']->options as $selected) {
                                                        if($option->id == $selected->id){
                                                            echo $selected->value;
                                                        }
                                                     }
                                                }?>' style="width: 70px;height: 20px;">
                                            </div>
                                        @endif

                                    @endif
                                @endforeach

                            </div>
                            <div class="col-md-2">
                                 <div class="col-md-12 px-0">
                                    <h6>Условия</h6>
                                </div>
                                @foreach($data['options'] as $option)

                                    @if($option->group == 'conditions')

                                        @if($option->type == 'checkbox')
                                             <div class="col-md-12 items_add_info">
                                                <input id="option_{{ $option->id }}" type="checkbox"  name="option[{{ $option->id }}]" value="1" @if(isset($data['cargoRequestData'])) @foreach($data['cargoRequestData']->options as $selected) @if( $option->id == $selected->id) checked @endif @endforeach @endif>
                                                <label for="option_{{ $option->id }}" class="text-md-left" style="font-size: 13px;line-height: 12px;">{{ $option->name }}</label>
                                            </div>
                                        @endif
                                        @if($option->type == 'input')
                                            <div class="col-md-12 items_add_info">
                                                <label for="option_{{ $option->id }}" class="text-md-left" style="font-size: 13px;line-height: 12px;">{{ $option->name }}</label>
                                                <input id="option_{{ $option->id }}" type="text"  name="option[{{ $option->id }}]" value='<?php if(isset($data['cargoRequestData'])){
                                                     foreach($data['cargoRequestData']->options as $selected) {
                                                        if($option->id == $selected->id){
                                                            echo $selected->value;
                                                        }
                                                     }
                                                }?>' style="width: 70px;height: 20px;">
                                            </div>
                                        @endif

                                    @endif
                                @endforeach

                            </div>
                            <div class="col-md-3">
                                <div class="col-md-12 px-0">
                                    <h6>Дополнительно</h6>
                                </div>

                                @foreach($data['options'] as $option)

                                    @if($option->group == 'additional')

                                         @if($option->type == 'checkbox')
                                             <div class="col-md-12 items_add_info" >
                                                <input id="option_{{ $option->id }}" type="checkbox"  name="option[{{ $option->id }}]" value="1" @if(isset($data['cargoRequestData'])) @foreach($data['cargoRequestData']->options as $selected) @if( $option->id == $selected->id) checked @endif @endforeach @endif>
                                                <label for="option_{{ $option->id }}" class="text-md-left" style="line-height: 12px;font-size: 13px;">{{ $option->name }}</label>
                                            </div>
                                         @endif
                                         @if($option->type == 'input')
                                            <div class="col-md-12 items_add_info">
                                                <label for="option_{{ $option->id }}" class="text-md-left" style="line-height: 12px;font-size: 13px;">{{ $option->name }}</label>
                                                <input id="option_{{ $option->id }}" type="text"  name="option[{{ $option->id }}]" value='<?php if(isset($data['cargoRequestData'])){
                                                     foreach($data['cargoRequestData']->options as $selected) {
                                                        if($option->id == $selected->id){
                                                            echo $selected->value;
                                                        }
                                                     }
                                                }?>' style="width: 70px;height: 20px;">
                                            </div>
                                         @endif

                                    @endif
                                @endforeach

                            </div>
                              
                            </div>
                        </div>
                    </div>

                      
                    <div class="form-group row submit_block">
                        <div class="col-md-12 ">
                            <button type="submit" class="btn btn-primary">{{ __('Разместить') }}</button>
                        </div>
                    </div>

                </form>
            </div>

        </div>
    </div>
</div>

@include('modals.tel_second')
@include('modals.viber')
@include('modals.skype')
@include('modals.whatsapp')


@endsection
