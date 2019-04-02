@extends('template.shell')
@section('content')
    <style>
        .card-title {height: 50px;overflow: hidden;text-overflow: ellipsis;width: 140px;white-space: nowrap;}
        .cartProds {display: flex;flex-wrap: initial;overflow-x: scroll;overflow-y: auto;background: #ededee;}
    </style>
    <h2 class="mb-5">Checkout</h2>

        <div class="cartProds border rounded">
            @foreach($cart as $key => $item)
                <div class="col-md-2 m-1 card">
                        <img class="card-img-top" src="https://staticmobly.akamaized.net/p/{{$item['img']}}"></img>
                        <div class="card-body px-1">
                            <p class="card-title"><strong class="pdp-name">{{$item['name']}}</strong></p>
                            <p class="card-text">Sku: <strong class="skuVal">{{$key}}</strong></p>
                            <p class="card-text">Valor: <strong>{{$item['price']}}</strong></p>
                            <p class="card-text">Quantidade: <strong>{{$item['quantity']}}</strong></p>
                        </div>
                    </a>
                </div>
            @endforeach
        </div>
    <div class="container">
        <div class="my-5" style="background: #efefef">
            <div class="container checkout">
                <div class="row">
                    <div class="col m-3 text-center">
                        <p>Quantidade total</p>
                        <p class="total-val"><strong>{{$totalQuantity}}</strong></p>
                    </div>
                    <div class="col m-3 text-center">
                        <p>Preço total</p>
                        <p class="total-val"><strong>{{$totalPrice}}</strong></p>
                    </div>
                </div>
            </div>
        </div>


        <br>
        <h4>Dados:</h4>
        {!! Form::open(['method'=>'POST', 'action'=> 'ProductsController@createNewOrder']) !!}
        {{csrf_field()}}
        <div class="form-group">
            {!! Form::label('title', 'Nome:') !!}
            {!! Form::text('name','', ['placeholder'=>'Nome', 'class'=>'form-control']) !!}
            {!! Form::label('title', 'Email:') !!}
            {!! Form::text('email','', ['placeholder'=>'Email@', 'class'=>'form-control']) !!}
            {!! Form::label('title', 'Endereço:') !!}
            {!! Form::text('address','', ['placeholder'=>'Rua, N', 'class'=>'form-control']) !!}
            {!! Form::label('title', 'CEP:') !!}
            {!! Form::text('cep','', ['placeholder'=>'00000-000', 'class'=>'form-control']) !!}
            {!! Form::hidden('total_price',$totalPrice, ['class'=>'form-control']) !!}
            {!! Form::hidden('total_quantity',$totalQuantity, ['class'=>'form-control']) !!}
        </div>
        <br>
        <h4>Endereço de entrega:</h4>

        <div class="form-group">
            {!! Form::label('title', 'Endereço:') !!}
            {!! Form::text('delivery_address','', ['placeholder'=>'Rua, N', 'class'=>'form-control', 'required'=>'required']) !!}
            {!! Form::label('title', 'CEP:') !!}
            {!! Form::text('delivery_cep','', ['placeholder'=>'00000-000', 'class'=>'form-control']) !!}
        </div>

        <p class="alert alert-danger" style="display: none">Preencha ao menos um campo</p>

        {!! Form::button('Gerar Pedido', ['type'=>'submit','class'=>'btn btn-success btn-lg']) !!}
        {!! Form::close() !!}
    </div>



@endsection