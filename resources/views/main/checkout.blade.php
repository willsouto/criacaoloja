@extends('template.shell')
<?php
use Illuminate\Support\Facades\Blade;
?>
@section('content')
    <style>
        .pdp-img{max-width: 400px;margin: auto;display: block; }
        .pdp-price-anchor { color: #999;}
        .pdp-price-final { font-size: 20px; color: green;}
    </style>

    <div class="container">
        {!! Form::open(['method'=>'POST'/*, 'action'=> 'JsonController@store'*/]) !!}
        {{csrf_field()}}
        <div class="form-group">
            {!! Form::label('title', 'Nome:') !!}
            {!! Form::text('nome','Nome', ['class'=>'form-control']) !!}
            {!! Form::label('title', 'Email:') !!}
            {!! Form::text('email','Email@', ['class'=>'form-control']) !!}
            {!! Form::label('title', 'Endereço:') !!}
            {!! Form::text('endereco','Rua, N', ['class'=>'form-control']) !!}
            {!! Form::label('title', 'CEP:') !!}
            {!! Form::text('cep','00000-000', ['class'=>'form-control']) !!}
        </div>
        <br>
        <h4>Endereço de entrega:</h4>

        <div class="form-group">
            {!! Form::label('title', 'Nome:') !!}
            {!! Form::text('nome','Nome', ['class'=>'form-control']) !!}
            {!! Form::label('title', 'Email:') !!}
            {!! Form::text('email','Email@', ['class'=>'form-control']) !!}
            {!! Form::label('title', 'Endereço:') !!}
            {!! Form::text('endereco','Rua, N', ['class'=>'form-control']) !!}
            {!! Form::label('title', 'CEP:') !!}
            {!! Form::text('cep','00000-000', ['class'=>'form-control']) !!}
        </div>

        <p class="alert alert-danger" style="display: none">Preencha ao menos um campo</p>

        {!! Form::button('Salvar', ['class'=>'btn btn-primary']) !!}
        {!! Form::close() !!}
    </div>



@endsection