@extends('layouts.app_email')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Вас пригласили в компанию') }}</div>

                <div class="card-body">
                   
                    {{ __('Перейдите по ссылке для регистрации') }}
                    <a href="{{ $url }}/invite?s={{$code}}&e={{$email}}">Перейти</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
