@extends('template.shell')

@section('content')
    <style>
        .pdp-img{max-width: 400px;margin: auto;display: block; }
        .pdp-price-anchor { color: #999;}
        .pdp-price-final { font-size: 20px; color: green;}
    </style>

    <div class="container">
        <div class="row">
            <div class="col">
                <img class="pdp-img border rounded" src="https://staticmobly.akamaized.net/p/{{$product->image}}" />
            </div>
            <div class="col">
                <h2 class="pdp-name">{{$product->name}}</h2>
                <p class="pdp-sku">Sku: {{$product->id}}</p>
                <p class="pdp-price-anchor"><s>De {{$product->anchor_price}}</s></p>
                <p class="pdp-price-final">por {{$product->final_price}}</p>
                <a href="{{route('AddToCart', ['id'=>$product->id])}}" class="btn btn-success btn-lg mt-4">Comprar</a>
            </div>
        </div>
        <div class="row mt-5">
            <div class="col">
                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum</p>
            </div>
        </div>
    </div>



@endsection