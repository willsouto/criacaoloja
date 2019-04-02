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
        <h2>Pedido criado com sucesso!</h2>
    </div>



@endsection