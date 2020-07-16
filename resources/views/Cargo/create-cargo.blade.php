@extends('layouts.app')
 
@section('content')

<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/css/bootstrap-select.min.css">

<!-- Latest compiled and minified JavaScript -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/js/bootstrap-select.min.js"></script>

<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">{{ __('Добавление заявки на перевозку груза укажите пожалуйста населенные пункты погрузки и выгрузки, параметры груза и контактную информацию') }}</div>

                <div class="card-body" style="font-size: 14px;">

                    <form method="POST" action="{{ route('add-cargo.index') }}">
                        @csrf

                        <div class="form-group row">
                            
                            <div class="col-md-6">
                                 <!-- Дата погрузки -->
                                <div class="d-flex">
                                    <label for="date_from" class="col-md-3 col-form-label text-md-left">{{ __('Погрузка: с') }}</label>
                                    <input id="date_from" type="date" class="form-control col-md-3 @error('date_from') is-invalid @enderror" name="date_from" value="{{ old('date_from') }}" required autocomplete="date_from" autofocus>

                                    @error('date_from')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror


                                    <label for="date_to" class="col-md-2 col-form-label text-md-left">{{ __('по') }}</label>
                                    <input id="date_to" type="date" class="form-control col-md-3 @error('date_to') is-invalid @enderror" name="date_to" value="{{ old('date_to') }}" required autocomplete="date_to" autofocus>

                                    @error('date_to')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                 <!-- Место погрузки -->
                                <div class="d-flex">
                                    <label for="cargo_from" class="col-md-5 col-form-label text-md-left">{{ __('Нас. пункт погрузки:') }}</label>
                                    <input id="cargo_from" type="text" class="form-control " name="cargo_from[1]" value="{{ old('cargo_from[1]') }}" required autocomplete="date_from" autofocus>
                                </div>
                                @error('cargo_from.*')
                                     <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror


                                <div class="d-flex">
									<a  data-toggle="collapse" href="#collapse1" role="button" aria-expanded="false" aria-controls="collapse1">2 место погрузки</a>
									<div class="collapse" id="collapse1">
									    <input id="cargo_from" type="text" class="form-control " name="cargo_from[2]" value="{{ old('cargo_from[2]') }}"  autocomplete="date_from" autofocus>
									</div>
								</div>
                                <div class="d-flex">
									<a  data-toggle="collapse" href="#collapse2" role="button" aria-expanded="false" aria-controls="collapse2">3 место погрузки</a>
									<div class="collapse" id="collapse2">
									    <input id="cargo_from" type="text" class="form-control " name="cargo_from[3]" value="{{ old('cargo_from[3]') }}"  autocomplete="date_from" autofocus>
									</div>
								</div>
                                <div class="d-flex">
									<a  data-toggle="collapse" href="#collapse3" role="button" aria-expanded="false" aria-controls="collapse3">4 место погрузки</a>
									<div class="collapse" id="collapse3">
									    <input id="cargo_from" type="text" class="form-control " name="cargo_from[4]" value="{{ old('cargo_from[4]') }}"  autocomplete="date_from" autofocus>
									</div>
								</div>
                                <div class="d-flex">
									<a  data-toggle="collapse" href="#collapse4" role="button" aria-expanded="false" aria-controls="collapse4">5 место погрузки</a>
									<div class="collapse" id="collapse4">
									    <input id="cargo_from" type="text" class="form-control " name="cargo_from[5]" value="{{ old('cargo_from[5]') }}"  autocomplete="date_from" autofocus>
									</div>
								</div>  
								<div class="d-flex">
									<a  data-toggle="collapse" href="#collapse6" role="button" aria-expanded="false" aria-controls="collapse6">6 место погрузки</a>
									<div class="collapse" id="collapse6">
									    <input id="cargo_from" type="text" class="form-control " name="cargo_from[6]" value="{{ old('cargo_from[6]') }}"  autocomplete="date_from" autofocus>
									</div>
								</div>
                                <div class="d-flex">
									<a  data-toggle="collapse" href="#collapse7" role="button" aria-expanded="false" aria-controls="collapse7">7 место погрузки</a>
									<div class="collapse" id="collapse7">
									    <input id="cargo_from" type="text" class="form-control " name="cargo_from[7]" value="{{ old('cargo_from[7]') }}"  autocomplete="date_from" autofocus>
									</div>
								</div>

                            </div>

                            <div class="col-md-6">
                                <div>
                                    <h5 class="text-md-left">Выгрузка</h5>
                                </div>
                                <div class="d-flex">
                                    <label for="cargo_to" class="col-md-5 col-form-label text-md-left">{{ __('Нас. пункт выгрузки:') }}</label>
                                    <input id="cargo_to" type="text" class="form-control " name="cargo_to[1]" value="{{ old('cargo_to[1]') }}" required autocomplete="cargo_to" autofocus>
                                </div>
                                  @error('cargo_to.*')
                                     <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                                <div class="d-flex">
									<a  data-toggle="collapse" href="#collapse_to1" role="button" aria-expanded="false" aria-controls="collapse_to1">2 место выгрузки</a>
									<div class="collapse" id="collapse_to1">
									    <input  type="text" class="form-control " name="cargo_to[2]" value="{{ old('cargo_to[2]') }}"  autocomplete="cargo_to" autofocus>
									</div>
								</div>
                                <div class="d-flex">
									<a  data-toggle="collapse" href="#collapse_to2" role="button" aria-expanded="false" aria-controls="collapse_to2">3 место выгрузки</a>
									<div class="collapse" id="collapse_to2">
									    <input  type="text" class="form-control " name="cargo_to[3]" value="{{ old('cargo_to[3]') }}"  autocomplete="cargo_to" autofocus>
									</div>
								</div>
                                <div class="d-flex">
									<a  data-toggle="collapse" href="#collapse_to3" role="button" aria-expanded="false" aria-controls="collapse_to3">4 место выгрузки</a>
									<div class="collapse" id="collapse_to3">
									    <input  type="text" class="form-control " name="cargo_to[4]" value="{{ old('cargo_to[4]') }}"  autocomplete="cargo_to" autofocus>
									</div>
								</div>
                                <div class="d-flex">
									<a  data-toggle="collapse" href="#collapse_to4" role="button" aria-expanded="false" aria-controls="collapse_to4">5 место выгрузки</a>
									<div class="collapse" id="collapse_to4">
									    <input  type="text" class="form-control " name="cargo_to[5]" value="{{ old('cargo_to[5]') }}"  autocomplete="cargo_to" autofocus>
									</div>
								</div>  
								<div class="d-flex">
									<a  data-toggle="collapse" href="#collapse_to5" role="button" aria-expanded="false" aria-controls="collapse_to5">6 место выгрузки</a>
									<div class="collapse" id="collapse_to5">
									    <input  type="text" class="form-control " name="cargo_to[6]" value="{{ old('cargo_to[6]') }}"  autocomplete="cargo_to" autofocus>
									</div>
								</div>
                                <div class="d-flex">
									<a  data-toggle="collapse" href="#collapse_to6" role="button" aria-expanded="false" aria-controls="collapse_to6">7 место выгрузки</a>
									<div class="collapse" id="collapse_to6">
									    <input  type="text" class="form-control " name="cargo_to[7]" value="{{ old('cargo_to[7]') }}"  autocomplete="cargo_to" autofocus>
									</div>
								</div>
                            </div>

                        </div>

                        <div class="form-group row">
                            
                            <div class="col-md-6">
                                 <!-- Грузы  -->
                                <div class="d-flex">
                                    <label for="date_from" class="col-md-4 col-form-label text-md-left">{{ __('Характер груза:') }}</label>
                                    <select class="selectpicker" name='cargo_type'>
                                    @foreach($data['cargoList'] as $cargo)
                                         <option value="{{$cargo->id}}">{{$cargo->name}}</span></li>
                                    @endforeach
 
                                    @error('date_from')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror

                                    </div>
                                    <div class="d-flex">
                                        <label for="weight" class="col-md-4 col-form-label text-md-left">{{ __('вес груза (т):') }}</label>
                                        <input id="weight" type="number" class="form-control col-md-4 @error('weight') is-invalid @enderror" name="weight" value="{{ old('weight') }}" required autocomplete="weight" autofocus>

                                        @error('weight')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>

                                    <div class="d-flex">
                                        <label for="size" class="col-md-4 col-form-label text-md-left">{{ __('объем груза (м³):') }}</label>
                                        <input id="size" type="number" class="form-control col-md-4 @error('size') is-invalid @enderror" name="size" value="{{ old('size') }}" required autocomplete="size" autofocus>

                                        @error('size')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>

                                    <div class="d-flex">
                                        <label for="price" class="col-md-5 col-form-label text-md-left">{{ __('Стоимость перевозки:') }}</label>
                                        <input id="price" type="number" class="form-control col-md-4 @error('price') is-invalid @enderror" name="price" value="{{ old('price') }}" required autocomplete="price" autofocus>

                                        @error('price')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>


                               <div class="col-md-6">
                                    
                                    <div class="d-flex">
                                        <label for="transport_type" class="col-md-4 col-form-label text-md-left">{{ __('Тип транспорта:') }}</label>
                                        
                                         <select class="selectpicker col-md-4" name="transport_type" id="transport_type">
                                             @foreach($data['transport_type'] as $transport)
                                                 <option value="{{$transport->id}}">{{$transport->name}}</span></li>
                                            @endforeach
                                        </select>

                                        @error('transport_type')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror

                                    </div>

                                    <div class="d-flex">
                                        <label for="transport_count" class="col-md-4 col-form-label text-md-left">{{ __('Кол-во машин:   ') }}</label>
                                        <input id="transport_count" type="number" class="form-control col-md-4 @error('transport_count') is-invalid @enderror" name="transport_count" value="{{ old('transport_count') }}" required autocomplete="transport_count" autofocus>

                                        @error('transport_count')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>

                                    <div>
                                        <h5>Указать размеры груза, в метрах </h5>
                                        <div class="d-flex">
                                            <label for="gabarit_cargo_length" class="col-md-2 col-form-label text-md-left">{{ __('длина :') }}</label>
                                            <input id="gabarit_cargo_length" type="number" class="form-control col-md-2 @error('gabarit_cargo_length') is-invalid @enderror" name="gabarit_cargo_length" value="{{ old('gabarit_cargo_length') }}" required  autofocus>

                                            @error('gabarit_cargo_length')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror

                                            <label for="gabarit_cargo_width" class="col-md-2 col-form-label text-md-left">{{ __('ширина:') }}</label>
                                            <input id="gabarit_cargo_width" type="number" class="form-control col-md-2 @error('gabarit_cargo_width') is-invalid @enderror" name="gabarit_cargo_width" value="{{ old('gabarit_cargo_width') }}" required  autofocus>

                                            @error('gabarit_cargo_width')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror

                                            <label for="gabarit_cargo_height" class="col-md-2 col-form-label text-md-left">{{ __('высота:') }}</label>
                                            <input id="gabarit_cargo_height" type="number" class="form-control col-md-2 @error('gabarit_cargo_height') is-invalid @enderror" name="gabarit_cargo_height" value="{{ old('gabarit_cargo_height') }}" required  autofocus>

                                            @error('gabarit_cargo_height')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>

                                </div>
                            </div>


                        </div>



                        <div class="form-group row">
                            
                            <div class="col-md-6">
                                 <!-- Название компании -->
                                <div class="d-flex">
                                    <label for="company_name" class="col-md-5 col-form-label text-md-left">{{ __('Название компании:') }}</label>
                                    <input id="company_name" type="text" class="form-control col-md-4 @error('company_name') is-invalid @enderror" name="company_name" value="{{ old('company_name') }}" required autocomplete="company_name" autofocus>

                                    @error('company_name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror

                                </div>
                                 <!-- Контактное лицо: -->

                                <div class="d-flex">
                                    <label for="company_name_client" class="col-md-5 col-form-label text-md-left">{{ __('Контактное лицо:') }}</label>
                                    <input id="company_name_client" type="text" class="form-control col-md-4 @error('company_name_client') is-invalid @enderror" name="company_name_client" value="{{ old('company_name_client') }}" required autocomplete="company_name_client" autofocus>

                                    @error('company_name_client')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                            </div>

                            <div class="col-md-6">
          
                                <div class="d-flex align-items-lg-center">
                               
                                    <label for="tel" class="col-md-6 col-form-label text-md-left">{{ __('Телефон:') }} {{ $data['user']['tel']}}</label>
                                    <input id="tel" type="checkbox" class=" @error('tel') is-invalid @enderror" name="tel" value="{{ $data['user']['tel']}}" required autocomplete="tel">
                                    @error('tel')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                @if(!empty($data['user']['tel_second']))
                                    <div class="d-flex align-items-lg-center">
                                        <label for="tel_second" class="col-md-6 col-form-label text-md-left">{{ $data['user']['tel_second']}}</label>
                                        <input id="tel_second" type="checkbox" class=" @error('tel') is-invalid @enderror" name="tel_second" value="{{ $data['user']['tel_second']}}" required autocomplete="tel">
                                        @error('tel_second')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                @endif

                                <div class="d-flex align-items-lg-center">
                               
                                    <label for="email" class="col-md-6 col-form-label text-md-left">{{ __('Email:') }} {{ $data['user']['email']}}</label>
                                    <input id="email" type="checkbox" class=" @error('email') is-invalid @enderror" name="email" value="{{ $data['user']['email']}}" required autocomplete="email">
                                    @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                        </div>
                        <div class="form-group row px-3">
                            <div class="col-md-12">
                                <p class="text-secondary">
                                    Дополнительная информация 
                                    <a class="btn btn-primary" data-toggle="collapse" href="#collapseExample" role="button" aria-expanded="false" aria-controls="collapseExample">
                                        Указать
                                    </a>
                                </p>
                                
                            </div>
                        </div>


                        <div class="collapse" id="collapseExample">
                            <div class="container-fluid">
                                <div class="row">
                                  <div class="col-md-2">
                                    <div class="col-md-12 px-0">
                                    <h6>Документы</h6>
                                    </div>
                                    <div class="col-md-12 px-0">
                                        <label for="cmr" class="text-md-left">{{ __('cmr') }}</label>
                                        <input id="cmr" type="checkbox"  name="cmr" value="" >
                                    </div>
                                    <div class="col-md-12 px-0">
                                        <label for="tir" class="text-md-left">{{ __('tir') }}</label>
                                        <input id="tir" type="checkbox"  name="tir" value="" >
                                    </div>
                                    <div class="col-md-12 px-0">
                                        <label for="t1" class="text-md-left">{{ __('t1') }}</label>
                                        <input id="t1" type="checkbox"  name="t1" value="" >
                                        </div>
                                    <div class="col-md-12 px-0">
                                        <label for="t2" class="text-md-left">{{ __('t2') }}</label>
                                        <input id="t2" type="checkbox"  name="t2" value="" >
                                    </div>
                                    <div class="col-md-12 px-0">
                                        <select name="adr" id="adr_select">
                                            <option value="1">1</option>
                                            <option value="2">2</option>
                                            <option value="3">3</option>
                                            <option value="4">4</option>
                                            <option value="5">5</option>
                                        </select>
                                    </div>
                                    <div class="col-md-12 px-0">
                                        <label for="sanpassport" class="text-md-left">{{ __('Санпаспорт') }}</label>
                                        <input id="sanpassport" type="checkbox"  name="sanpassport" value="" >
                                    </div>
                                    <div class="col-md-12 px-0">
                                        <label for="customs-doc" class="text-md-left">{{ __('Тамож. свидет.') }}</label>
                                        <input id="customs-doc" type="checkbox"  name="customs-doc" value="" >
                                    </div>
                                    <div class="col-md-12 px-0">
                                        <label for="customs-control" class="text-md-left">{{ __('Тамож. контроль') }}</label>
                                        <input id="customs-control" type="checkbox"  name="customs-control" value="" >
                                    </div>

                                  </div>
                                  <div class="col-md-6 row">
                                   <div class="col-md-6 px-0"> <h6>Погрузка</h6></div>
                                    <div class="col-md-6 px-0">
                                        <label for="cmr" class="text-md-left">{{ __('Боковая') }}</label>
                                        <input id="cmr" type="checkbox"  name="cmr" value="" >
                                    </div>
                                    <div class="col-md-6 px-0">
                                        <label for="tir" class="text-md-left">{{ __('Верхняя') }}</label>
                                        <input id="tir" type="checkbox"  name="tir" value="" >
                                    </div>
                                    <div class="col-md-6 px-0">
                                        <label for="t1" class="text-md-left">{{ __('Задняя') }}</label>
                                        <input id="t1" type="checkbox"  name="t1" value="" >
                                        </div>
                                    <div class="col-md-6 px-0">
                                        <label for="t2" class="text-md-left">{{ __('Растентовка') }}</label>
                                        <input id="t2" type="checkbox"  name="t2" value="" >
                                    </div>
                                    <div class="col-md-6 px-0">
                                        <label for="adr" class="text-md-left">{{ __('Пломба') }}</label>
                                        <input id="adr" type="checkbox"  name="adr" value="" >
                                    </div>
                                    <div class="col-md-6 px-0">
                                        <label for="sanpassport" class="text-md-left">{{ __('Полуприцеп') }}</label>
                                        <input id="sanpassport" type="checkbox"  name="sanpassport" value="" >
                                    </div>
                                    <div class="col-md-6 px-0">
                                        <label for="customs-doc" class="text-md-left">{{ __('Сцепка') }}</label>
                                        <input id="customs-doc" type="checkbox"  name="customs-doc" value="" >
                                    </div>
                                    <div class="col-md-6 px-0">
                                        <label for="pnevmo" class="text-md-left">{{ __('Пневмоход') }}</label>
                                        <input id="pnevmo" type="checkbox"  name="customs-control" value="" >
                                    </div>
                                    <div class="col-md-6 px-0">
                                        <label for="gidro" class="text-md-left">{{ __('Гидроборт') }}</label>
                                        <input id="gidro" type="checkbox"  name="customs-control" value="" >
                                    </div>
                                    <div class="col-md-6 px-0">
                                        <label for="shtor" class="text-md-left">{{ __('Штора') }}</label>
                                        <input id="shtor" type="checkbox"  name="customs-control" value="" >
                                    </div>
                                    <div class="col-md-6 px-0">
                                        <label for="piramida" class="text-md-left">{{ __('Пирамида') }}</label>
                                        <input id="piramida" type="checkbox"  name="customs-control" value="" >
                                    </div>
                                    <div class="col-md-6 px-0">
                                        <label for="obresh" class="text-md-left">{{ __('Обрешетка') }}</label>
                                        <input id="obresh" type="checkbox"  name="customs-control" value="" >
                                    </div>
                                    <div class="col-md-6 px-0">
                                        <label for="manipulate" class="text-md-left">{{ __('Манипулятор') }}</label>
                                        <input id="manipulate" type="checkbox"  name="manipulate" value="" >
                                    </div>

                                </div>
                                  <div class="col-md-2">
                                     <div class="col-md-12 px-0">
                                        <h6>Условия</h6>
                                    </div>
                                    <div class="col-md-12 px-0">
                                        <label for="pnevmo" class="text-md-left">{{ __('Температура') }}</label>
                                        <input id="pnevmo" type="checkbox"  name="customs-control" value="" >
                                    </div>
                                    <div class="col-md-12 px-0">
                                        <label for="gidro" class="text-md-left">{{ __('Крюки') }}</label>
                                        <input id="gidro" type="checkbox"  name="customs-control" value="" >
                                    </div>
                                    <div class="col-md-12 px-0">
                                        <label for="shtor" class="text-md-left">{{ __(' Кол. паллет') }}</label>
                                        <input id="shtor" type="checkbox"  name="customs-control" value="" >
                                    </div>
                                    <div class="col-md-12 px-0">
                                        <label for="piramida" class="text-md-left">{{ __('Тип паллет    ') }}</label>
                                        <select name="type" id="">
                                            <option value="1">1</option>
                                            <option value="2">2</option>
                                        </select>
                                    </div>
                                    <div class="col-md-12 px-0">
                                        <label for="obresh" class="text-md-left">{{ __('Ремни') }}</label>
                                        <input id="obresh" type="checkbox"  name="customs-control" value="" >
                                        <input id="obresh" type="text"  name="customs-control" value="" >
                                    </div>
                                    <div class="col-md-12 px-0">
                                        <label for="manipulate" class="text-md-left">{{ __('Съемн. стойки') }}</label>
                                        <input id="manipulate" type="checkbox"  name="manipulate" value="" >
                                    </div>
                                    <div class="col-md-12 px-0">
                                        <label for="manipulate" class="text-md-left">{{ __('Жесткий борт') }}</label>
                                        <input id="manipulate" type="checkbox"  name="manipulate" value="" >
                                    </div>
                                    <div class="col-md-12 px-0">
                                        <label for="manipulate" class="text-md-left">{{ __('Деревянный пол') }}</label>
                                        <input id="manipulate" type="checkbox"  name="manipulate" value="" >
                                    </div>
                                    <div class="col-md-12 px-0">
                                        <label for="manipulate" class="text-md-left">{{ __('Рога (коники)') }}</label>
                                        <input id="manipulate" type="checkbox"  name="manipulate" value="" >
                                    </div>
                                    <div class="col-md-12 px-0">
                                        <label for="manipulate" class="text-md-left">{{ __('Мега') }}</label>
                                        <input id="manipulate" type="checkbox"  name="manipulate" value="" >
                                    </div>
                                    <div class="col-md-12 px-0">
                                        <label for="manipulate" class="text-md-left">{{ __('Jumbo') }}</label>
                                        <input id="manipulate" type="checkbox"  name="manipulate" value="" >
                                    </div>
                                </div>
                                  <div class="col-md-2"><h6>Дополнительно</h6></div>
                                  
                                </div>
                            </div>
                          </div>

                          
                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Разместить') }}
                                </button>
                            </div>
                        </div>


                    </form>


                </div>
            </div>
        </div>
    </div>
</div>
@endsection
