<?php

namespace App;


class Cart
{
    public $items; // [ ['id' => ['quantity' => , 'price' => , 'data' =>],....]
//    public $totalQuantity;
//    public $totalPrice;



    public function __construct($prevCart)
    {
        if($prevCart != null){
            $this->items = $prevCart->items;
//            $this->totalQuantity = $prevCart->totalQuantity;
//            $this->totalPrice = $prevCart->totalPrice;


        }else{
            $this->items = [];
//            $this->totalQuantity = 0;
//            $this->totalPrice = 0;

        }

    }



    public function addItem($id){
        $product = Product::where('id',$id)->first();
        $price = $product->final_price;
        $name = $product->name;
        $img = $product->image;




        if(array_key_exists($id,$this->items)){
            //fazer validação pra ver se tem no stock
            $productToAdd = $this->items[$id];
            $productToAdd['quantity']++;



        }else{
            $productToAdd = ['price'=> $price, 'name'=> $name, 'img'=> $img, 'quantity'=> 1/*, 'totalSinglePrice'=> $price, 'data'=>$product*/];
        }

        $this->items[$id] = $productToAdd;


    }


    public function updatePriceAndQunatity(){

        $totalPrice = 0;
        $totalQuanity = 0;

        foreach($this->items as $item){

            $totalQuanity = $totalQuanity + $item['quantity'];
            $totalPrice = $totalPrice + $item['totalSinglePrice'];

        }

        $this->totalQuantity = $totalQuanity;
        $this->totalPrice =  $totalPrice;

    }



}