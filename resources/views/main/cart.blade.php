@extends('template.shell')

@section('content')
    <style>
        .prod-img { MAX-WIDTH: 120PX;}
        .prods th, .prods .qtd { text-align: center;}
        .prods th, .prods td { vertical-align: middle;}
        .spacer { display: block; margin: 20px 0;}
        .checkout p { margin:0;text-align: center;font-weight: bold;}
        .removeProd span {color: red;background: #fff;font-size: 20px;margin-left: 22px;}
    </style>

    <div class="container mt-5">
        <h2>Carrinho</h2>
    </div>

    @if(!$cart)
        <h2 class="mt-5">Seu carrinho está vazio!   :(</h2>
    @else
    <div class="my-5 checkoutbar" style="background: #efefef">
        <div class="container checkout">
            <div class="row">
                <div class="col m-3">
                    <p>Total a pagar</p>
                    <p class="total-val">00,00</p>
                </div>
                <div class="col m-3">
                    <a href="{{route('makeOrder')}}" class="btn btn-success btn-lg">Ir para pagamento</a>
                </div>
            </div>
        </div>
    </div>




    <div class="container prods">
        <table class="table">
            <tbody>
            @foreach($cart as $key => $item)
                <tr class="prod-row border rounded-lg" id="{{$key}}">
                    <th>{{$item['price']}}</th>
                    <td>
                        <img class="prod-img" src="https://staticmobly.akamaized.net/p/{{$item['img']}}" />
                    </td>
                    <td>
                        <h4 class="pdp-name">{{$item['name']}}</h4>
                        <p class="pdp-sku">Sku: <span class="skuVal">{{$key}}</span> </p>
                    </td>

                    <td class="qtd">
                        <select name="sku" title="Quantidade" class=" form-control">
                            @for ($i = 1; $i <= $item['stock']; $i++)
                            <option value="{{$i}}" @if($i == $item['quantity']) selected="" @endif>{{$i}}</option>
                            @endfor
                        </select>
                    </td>
                    <td class="removeProd">
                        <a href="" class="removeProd"><span class="fa fa-window-close"></span></a>
                    </td>
                </tr>
                <tr class="spacer"></tr>
                @endforeach

            </tbody>
        </table>
    </div>
@endif

<?php
echo '<script>
//        $(".removeProd").click(function(e){
//            e.preventDefault();
//
//            var prodId = $(this).closest("tr").attr("id");
//            $("#"+prodId+", ."+prodId).remove();
//            jQuery.ajax({
//                url: "cart/AjaxRemoveFromCart/" + prodId,
//                method: "get",
//                success: function(data){ console.log(data); }
//            });
//
//            e.stopImmediatePropagation();
//            updateTotal();
//            cartCounter();
//        });



        //remove prod from cart
        $(".removeProd").click(function(e){
            e.preventDefault();
            e.stopImmediatePropagation();
            var prodId = $(this).closest("tr").attr("id");
            $("#"+prodId+", ."+prodId).remove();
            ajaxControllerCall("AjaxRemoveFromCart/"+prodId);
        });

        //change quantity
        $(".prod-row select").change(function(e){
            e.preventDefault();
            e.stopImmediatePropagation();
            var prodId = $(this).closest("tr").attr("id");
            $("."+prodId).find(".quantityValue").text($(this).val());
            ajaxControllerCall("AjaxChangeQuantityFromCart/"+prodId+"/"+$(this).val());

        });

        //ajax call
        function ajaxControllerCall(action){
            jQuery.ajax({
                url: "cart/"+action,
                method: "get",
                success: function(data){ console.log(data); }
            });
            updateTotal();
            cartCounter();
        }

        //update total
        function updateTotal(){
            var total = 0;
            if($(".prod-row").length == 0){
                $(".checkoutbar").hide();
                $("<h2 class=\'mt-5\'>Seu carrinho está vazio!   :(</h2>").insertBefore(".checkoutbar");
            }else{
                $(".prod-row").each(function(){
                    var val = ($(this).find("th").text()).replace(",", ".");
                    var qtd = $(this).find("select").val();
                    total += val*qtd;

                });
                $(".total-val").text(total.toFixed(2));
            }
        }
        updateTotal();
        $(".prod-row select").change(function(){ updateTotal(); });

    </script>';
?>



@endsection