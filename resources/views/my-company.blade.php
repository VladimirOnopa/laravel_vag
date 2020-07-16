@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
          <div class="p-3 mb-2 bg-info text-white">Компания : {{ $data['comp']['company_name'] }}</div>

            <div class="card">
                <div class="card-header">Документы </div>
                <div class="card-body">
                  
                  <div class="alert alert-warning" role="alert">
                    <h4 class="alert-heading">Вы еще не добавили документы компании!</h4>
                    <p>Добавьте документы компании, и вы сможете <b>Добавлять неограниченное количество грузов и транспорта и Получить доступ к информации о грузах и транспорте</b></p>
                    <hr>
                  </div>
                
                </div>
            </div>

            <div class="card">
                <div class="card-header">Контакты</div>
                <div class="card-body"> 
                    <div class="row">

                       <div class="col-md-6">

                        <div class="alert alert-info" role="alert">
                          Телефон : {{ $data['user']['tel'] }}  <i class="far fa-trash-alt"></i>
                        </div>

                         @if(!empty($data['user']['tel_second'])) 
                              <div class="alert alert-info" role="alert">
                                 Дополнительный  телефон  : {{ $data['user']['tel_second'] }} <i class="far fa-trash-alt"></i>
                              </div>
                         @endif 
                         @if(!empty($data['user']['viber'])) 
                              <div class="alert alert-info" role="alert">
                                 Viber  : {{ $data['user']['viber'] }} <i class="far fa-trash-alt"></i>
                              </div>
                         @endif
                         @if(!empty($data['user']['whatsapp'])) 
                              <div class="alert alert-info" role="alert">
                                 Whatsapp  : {{ $data['user']['whatsapp'] }} <i class="far fa-trash-alt"></i>
                              </div>
                         @endif
                         @if(!empty($data['user']['skype'])) 
                              <div class="alert alert-info" role="alert">
                                 Skype  : {{ $data['user']['skype'] }} <i class="far fa-trash-alt"></i>
                              </div>
                         @endif
                       
                          
                       </div>

                        <div class="col-md-6">
                           @if(empty($data['user']['tel_second']) || empty($data['user']['viber']) || empty($data['user']['whatsapp']) || empty($data['user']['skype']) || empty($data['user']['site_url']))
                              
                              <div class="dropdown">
                                    <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Добавить
                                    </button>

                                      <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                        @if(empty($data['user']['site_url'])) <a class="dropdown-item" href="#">Сайт</a>  @endif
                                        @if(empty($data['user']['tel_second'])) <a class="dropdown-item" href="#">Номер телефона</a>  @endif
                                        @if(empty($data['user']['viber'])) <a class="dropdown-item" href="#">Viber</a>  @endif
                                        @if(empty($data['user']['whatsapp'])) <a class="dropdown-item" href="#">Whatsapp</a>  @endif
                                        @if(empty($data['user']['skype'])) <a class="dropdown-item" href="#">Skype</a>  @endif
                                      </div>
                              </div>

                              @endif

                              <div class="alert alert-info" role="alert">
                                 Email: {{ $data['user']['email'] }}
                              </div>
                        </div>
                    </div>

                   
                </div>
            </div>

            <div class="card">
                <div class="card-header">Ваша компания в Laravel</div>
                <div class="card-body">
                    <div class="row">
                       <div class="col-md-6">
                           <div>
                               <div>ДАТА РЕГИСТРАЦИИ В Laravel</div>
                               <div>{{  Carbon\Carbon::parse($data['comp']['created_at'])->format('Y.m.d') }}</div>
                           </div>
                           <div>
                               <div>МОЯ КОМПАНИЯ ДОБАВЛЕНА В  <a href="#">« МОИ ПАРТНЕРЫ»</a></div>
                               <div>Недостаточно информации</div>
                           </div>
                       </div>
                       <div class="col-md-6">
                            <div>
                               <div>РЕЙТИНГ КОМПАНИИ В Laravel</div>
                               <div>Недостаточно информации</div>
                            </div>
                            <div>
                               <div>МОЯ КОМПАНИЯ ДОБАВЛЕНА В  <a href="#">« ЧЕРНЫЕ СПИСКИ»</a></div>
                               <div>Недостаточно информации</div>
                            </div>
                           
                       </div>
                    </div>
                 </div>
            </div>

        </div>

    </div>
</div>
@endsection
