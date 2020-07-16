@extends('layouts.app')

@section('content')
<div class="container workers">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    Мои сотрудники 
                    @if($data['is_admin'] && !$data['overLimit'])
                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
                          Добавить сотрудника
                        </button>
                    @else
                      <span class="p-3 mb-2 bg-secondary text-white">Превышен лимит количества сотрудников <a href="#" class="btn btn-info">Хотите больше?</a></span>
                    @endif 
                </div>


                <div class="card-body">
                   
                   
                    @if(isset($data['workers']))
                        @foreach ($data['workers'] as $worker)
                            
                       
                            <div class="card @if(Auth::user()->id == $worker->id) current_user border border-primary @endif" >
         
                                <table class="table">
                                  <tbody>
                                    <tr>
                                      <td>{{ Carbon\Carbon::parse($worker->register_date)->format('y.m.d') }}</td>
                                      <td>{{ $worker->name }} {{ $worker->surname }} @if($worker->is_admin)<span class="text-danger"> ({{ __("app.admin") }})</span>  @endif</td>
                                      <td>@if($data['is_admin']) <a href="#">Редактировать</a>  @endif </td>
                                    </tr>
                                    <tr>
                                      <td>Логин:</td>
                                      <td><div class="text-success">{{ $worker->email }} </div></td>
                                      <td><div class="text-success">Был в сети в  {{ Carbon\Carbon::parse($worker->last_active)->format('h:m y.m.d') }} On-line </div></td>
                                    </tr>
                                    <tr>
                                      <td>Контакты:</td>
                                      <td> 
                                            {{ $worker->tel }} 
                                            <span class="text-primary">{{ $worker->email }} </span>
                                            @if(isset($worker->viber))<span > ({{ $worker->viber }})</span>  @endif 
                                            @if(isset($worker->skype))<span > ({{ $worker->skype }})</span>  @endif 
                                            @if(isset($worker->whatsapp))<span > ({{ $worker->whatsapp }})</span>  @endif 
                                        </td>
                                        <td></td>
                                    </tr> 
                                    <tr>
                                      <td>Доступ:</td>
                                      <td>Бесплатный</td>
                                      <td></td>
                                    </tr>
                                  </tbody>
                                </table>

                              
                            </div>


                        @endforeach
                    @endif
                    
                   
                </div>

            </div>
        </div>
    </div>
</div>
@include('inc.invite_from')

@endsection

