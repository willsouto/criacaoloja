
@extends('template.shell')

@section('content')
<style>
    p.card-title {overflow: hidden;height: 46px;}
    .card a { text-decoration: none;}
    .card > a img {margin-top: -20px;}
    .card > a {max-height: 200px;overflow: hidden;margin-top: 15px;}
</style>
    <div class="container">
        @if(isset($cat_name))
            <h2 class="offset-md-1 mb-5" style="text-transform: capitalize;">{{$cat_name}}</h2>
        @elseif(isset($searchText))
                <h2 class="offset-md-1 mb-5">Você buscou por: <strong>{{$searchText}}</strong></h2>
        @else
            <h2 class="offset-md-1 mb-5">Bem vindo a loja</h2>
        @endif

        <div class="row justify-content-between ">
            @foreach($products as $product)
                <div class="col-md-3 offset-md-1 mb-5 card">
                    <a href="{{route('productPage',['id'=>$product->id])}}" class="nounderline">
                    <img class="card-img-top" src="https://staticmobly.akamaized.net/p/{{$product->image}}"></img>
                        <div class="card-body">
                            <p class="card-title">{{$product->name}}</p>
                            <span class="card-text ml-2">De {{$product->anchor_price}}</span>
                            <span class="card-text"><strong>Por {{$product->final_price}}</strong></span>
                            <a href="{{route('productPage',['id'=>$product->id])}}" class="btn btn-success mt-3">Comprar</a>
                        </div>
                    </a>
                </div>
            @endforeach
        </div>
    </div>



@endsection