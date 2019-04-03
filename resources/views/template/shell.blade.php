<?php

?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Criação Api</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <script src="http://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
    <script src="https://use.fontawesome.com/9bab8dd6a3.js"></script>
    <style>
        body{margin-top:120px}ul.dropdown-cart{min-width:320px;right:0;left:auto}ul.dropdown-cart li .item{display:block;padding:3px 10px;margin:3px 0}ul.dropdown-cart li .item:hover{background-color:#f3f3f3}ul.dropdown-cart li .item:after{visibility:hidden;display:block;font-size:0;content:" ";clear:both;height:0}ul.dropdown-cart li .item-left{float:left}ul.dropdown-cart li .item-left img,ul.dropdown-cart li .item-left span.item-info{float:left}ul.dropdown-cart li .item-left span.item-info{margin-left:10px}ul.dropdown-cart li .item-left span.item-info span{display:block}ul.dropdown-cart li .item-right{float:right}ul.dropdown-cart li .item-right button{margin-top:14px}.cart-btn{border:1px solid #fff;display:block;border-radius:3px;padding:5px 12px;color:#fff}.remove-from-cart{font-size:17px;margin:12px 0 0;padding:7px 6px 10px;line-height:5px;vertical-align:middle}.dropdown-cart{padding:0;border-radius:6px;overflow:hidden}.dropdown-cart li{border:1px solid #efefef}.dropdown-cart img{max-width:50px;width:20%}ul.dropdown-cart li .item-left span.item-info{float:left;width:67%;margin-left:14px}ul.dropdown-cart li .item{padding:10px;background:#f5f5f5}.cart-btn:hover{color:#ff4600;text-decoration:none}.dropdown-cart a{color:#414141}.dropdown-cart .btn{color:#fff}ul.dropdown-menu.dropdown-cart.show li a:hover>span{background:#dcdcdc}ul.dropdown-menu.dropdown-cart{max-height:450px;overflow-y:scroll}
    </style>
</head>
<body>

<nav class="navbar fixed-top navbar-expand-lg navbar-dark bg-dark">
    <a class="navbar-brand" href="/criacaoloja/public/">Loja</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mr-auto">

            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    Categorias
                </a>
                <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                    <a class="dropdown-item" href="/criacaoloja/public/categorias/sofas">Sofas</a>
                    <a class="dropdown-item" href="/criacaoloja/public/categorias/racks">Racks</a>
                    <a class="dropdown-item" href="/criacaoloja/public/categorias/guarda-roupas">Guarda-roupas</a>
                    <a class="dropdown-item" href="/criacaoloja/public/categorias/paineis">Painéis</a>
                </div>
            </li>
            <li>
                <form action="{{route('searchProducts')}}" method="get" class="form-inline my-2 my-lg-0">
                    <input class="form-control mr-sm-2" name="searchText" type="text" placeholder="Buscar produtos" aria-label="Search">
                    <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Buscar</button>
                </form>
            </li>
        </ul>
        <ul class="nav navbar-nav navbar-right">
            <li class="dropdown">
                <a href="#" class="dropdown-toggle cart-btn" data-toggle="dropdown" role="button" aria-expanded="false"> <span class="fa fa-shopping-cart"></span> <span class="cartCounter"></span> <span class="caret"></span></a>
                <ul class="dropdown-menu dropdown-cart" role="menu">

                    @if(isset(Session::get('cart')->items))
                        @foreach (Session::get('cart')->items as $key => $item)
                        <li class="{{$key}}">
                            <a href="{{route('productPage',['id'=>$key])}}">
                                <span class="item">
                                    <span class="item-left">
                                        <img src="https://staticmobly.akamaized.net/p/{{$item['img']}}" alt="" />
                                        <span class="item-info">
                                            <span>{{$item['name']}}</span>
                                            <span><strong>Quantidade: <span class="quantityValue">{{$item['quantity']}}</span></strong></span>
                                        </span>
                                    </span>
                                </span>
                            </a>
                        </li>
                        @endforeach
                    @endif

                    <li class="divider"></li>
                    <li><a class="text-center btn btn-success btn-block" href="{{route('cart')}}">Ir para carrinho</a></li>
                </ul>
            </li>
        </ul>
    </div>
</nav>


<div class="container mb-5">
    @yield('content')
</div>
<script>
    function cartCounter(){
        var cartCounter = 0;
        $(".dropdown-menu.dropdown-cart li").each(function(){
            cartCounter += $(this).find(".quantityValue").text()*1;
        });
        $(".dropdown-toggle.cart-btn .cartCounter").text(cartCounter);
    }
    cartCounter();
</script>
</body>
</html>