<?php

namespace App;


class Cart
{
    public $items;

    public function __construct($prevCart)
    {
        if($prevCart != null){
            $this->items = $prevCart->items;
        }else{
            $this->items = [];
        }
    }



    public function addItem($id){
        $product = Product::where('id',$id)->first();
        $price = $product->final_price;
        $name = $product->name;
        $img = $product->image;

        if(array_key_exists($id,$this->items)){
            $productToAdd = $this->items[$id];
            $productToAdd['quantity']++;
        }else{
            $productToAdd = ['price'=> $price, 'name'=> $name, 'img'=> $img, 'quantity'=> 1];
        }
        $this->items[$id] = $productToAdd;
    }


}