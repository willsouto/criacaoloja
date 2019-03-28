<?php
use App\Category;
use App\Product;
$products = Product::all();
$teste = Category::where("name","like", "guarda")->first();

echo $teste;
?>



@extends('template.shell')

@section('content')
    <style>
        p.card-title {
            overflow: hidden;
            height: 46px;
        }
        .card a { text-decoration: none;}
    </style>

    <div class="container">
        <div class="row justify-content-between ">
            @foreach($products as $product)
                <div class="col-md-3 offset-md-1 mb-5 card">
                    <a href="/{{$product->sku}}" class="nounderline">
                        <img class="card-img-top" src="https://staticmobly.akamaized.net/p/{{$product->image}}"></img>
                        <div class="card-body">
                            <p class="card-title">{{$product->name}}</p>
                            <span class="card-text ml-2">De {{$product->anchor_price}}</span>
                            <span class="card-text"><strong>Por {{$product->final_price}}</strong></span>
                            <a href="/criacaoloja/public/produto/{{$product->id}}" class="btn btn-success mt-3">Comprar</a>
                        </div>
                    </a>
                </div>
            @endforeach
        </div>
    </div>



@endsection