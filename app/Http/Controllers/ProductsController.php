<?php

namespace App\Http\Controllers;
use App\Category;
use App\Product;
use App\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Cart;
use Illuminate\Support\Facades\Session;
use App\Mail\OrderCreatedEmail;



class ProductsController extends Controller
{

//PRODUCTS
    public function allProducts(){
        $products = Product::where('stock', '>', 0)->get();

        return view("main.catalog",compact("products"));
    }

    public function category($cat_name){
        $products = Category::where("name",$cat_name)->first()->products;
        foreach($products as $key => $item){
            if($item['stock'] == 0){
                $products->forget($key);
            }
        }

        return view("main.catalog",compact("products","cat_name"));
    }

    public function productPage($id){
        $product = Product::find($id);
        return view("main.pdp",compact("product"));
    }

    public function searchProducts(Request $request){
        $searchText = $request->get('searchText');
        $products = Product::where('name', 'LIKE',$searchText."%")->get();
        foreach($products as $key => $item){
            if($item['stock'] == 0){
                $products->forget($key);
            }
        }
        return view("main.catalog",compact("products", "searchText"));
    }


//CART
    public function cart(){
        $cart = Session::get('cart');
        if(isset($cart->items)){
            $cart =  $cart->items;
            foreach($cart as $key => $item){
                $stock = Product::find($key)->stock;
                $cart[$key]['stock'] = $stock;
            }
        }
        return view('main.cart',compact("cart"));
    }

    public function addProductToCart(Request $request,$id){
        $prevCart = $request->session()->get('cart');
        $cart = new Cart($prevCart);
        $product = Product::find($id);
        $cart->addItem($id,$product);
        $request->session()->put('cart', $cart);
        //dd($cart);

        return redirect()->route("cart");
    }

    public function removeProductFromCart(Request $request,$id){
        $cart = $request->session()->get("cart");
        if(array_key_exists($id,$cart->items)){
            unset($cart->items[$id]);
        }
        $prevCart = $request->session()->get("cart");
        $updatedCart = new Cart($prevCart);

        $request->session()->put("cart",$updatedCart);
        return redirect()->route('cart');
    }


//AJAX
    public function ajaxRemoveProductFromCart(Request $request,$id){
        $cart = $request->session()->get("cart");
        if(array_key_exists($id,$cart->items)){
            unset($cart->items[$id]);
        }
        $prevCart = $request->session()->get("cart");
        return json_encode($prevCart->items);
    }

    public function AjaxChangeQuantityFromCart(Request $request,$id,$qtt){
        $cart = $request->session()->get("cart");
        if(array_key_exists($id,$cart->items)){
            $cart->items[$id]["quantity"] = $qtt;
        }
        $prevCart = $request->session()->get("cart");
        return json_encode($prevCart->items);
    }


//ORDER
    public function makeOrder(){
        $cart = Session::get('cart')->items;
        $totalPrice = 0;
        $totalQuantity = 0;
            foreach($cart as $prod){
                $prod['price'] = $prod['price'];
                $totalPrice += $prod['price']*$prod['quantity'];
                $totalQuantity += $prod['quantity'];
            }
        return view('main.checkout',compact("cart","totalPrice", "totalQuantity"));
    }


    public function createNewOrder(Request $request){

        $cart = Session::get('cart');

//dd($cart);


        $name = $request->input('name');
        $email = $request->input('email');
        $address = $request->input('address');
        $cep = $request->input('cep');
        $totalPrice = $request->input('total_price');
        $delivery_address = $request->input('address');
        $delivery_cep = $request->input('cep');

        //save user
        $user = new User();
        $user->name = $name;
        $user->email = $email;
        $user->address = $address;
        $user->cep = $cep;
        $user->save();
        $user_id = DB::getPdo()->lastInsertId();

        //save shipping
        $shippingAddress = array("address" => $delivery_address, "cep" => $delivery_cep);
        $saveAddress = DB::table("shipping_address")->insert($shippingAddress);
        $shipping_adress_id = DB::getPdo()->lastInsertId();


        //save order
        $newOrderArray = array("user_id" => $user_id,"shipping_address_id" => $shipping_adress_id, "total_price" => $totalPrice, );
        $created_order = DB::table("orders")->insert($newOrderArray);
        $order_id = DB::getPdo()->lastInsertId();

        //save products
        foreach ($cart->items as $key=>$item) {
            $item_id = $key;
            $item_quantity = $item['quantity'];
            $item_price = $item['price'];
            $newItemsInCurrentOrder = array("order_id" => $order_id, "sku" => $item_id, "quantity" => $item_quantity, "price" => $item_price);

            $subtract_item_from_stock =  DB::table('products')->decrement('stock',$item_quantity);
            $created_order_items = DB::table("order_items")->insert($newItemsInCurrentOrder);
        }

        //resetar cart
        Session::forget("cart");

        return view('main.success', compact('cart'));
    }












/*
    public function womenProducts(){
        $products = DB::table('products')->where('type', "Women")->get();
        return view("womenProducts",compact("products"));
    }



    public function search(Request $request){

        $searchText = $request->get('searchText');
        $products = Product::where('name',"Like",$searchText."%")->paginate(3);
        return view("allproducts",compact("products"));
    }




*/


/*

    public function showCart(){

        $cart = Session::get('cart');

        //cart is not empty
        if($cart){
            return view('cartproducts',['cartItems'=> $cart]);
            //cart is empty
        }else{
            return redirect()->route("allProducts");
        }

    }




    public function deleteItemFromCart(Request $request,$id){

        $cart = $request->session()->get("cart");

        if(array_key_exists($id,$cart->items)){
            unset($cart->items[$id]);

        }

        $prevCart = $request->session()->get("cart");
        $updatedCart = new Cart($prevCart);
        $updatedCart->updatePriceAndQunatity();

        $request->session()->put("cart",$updatedCart);

        return redirect()->route('cartproducts');



    }




    public function increaseSingleProduct(Request $request,$id){


        $prevCart = $request->session()->get('cart');
        $cart = new Cart($prevCart);

        $product = Product::find($id);
        $cart->addItem($id,$product);
        $request->session()->put('cart', $cart);

        //dump($cart);

        return redirect()->route("cartproducts");


    }








    public function decreaseSingleProduct(Request $request,$id){



        $prevCart = $request->session()->get('cart');
        $cart = new Cart($prevCart);

        if( $cart->items[$id]['quantity'] > 1){
            $product = Product::find($id);
            $cart->items[$id]['quantity'] = $cart->items[$id]['quantity']-1;
            $cart->items[$id]['totalSinglePrice'] = $cart->items[$id]['quantity'] *  $product['price'];
            $cart->updatePriceAndQunatity();

            $request->session()->put('cart', $cart);

        }



        return redirect()->route("cartproducts");


    }











    public function checkoutProducts(){

        return view('checkoutproducts');

    }



    public function createNewOrder(Request $request){

        $cart = Session::get('cart');

        $first_name = $request->input('first_name');
        $address = $request->input('address');
        $last_name = $request->input('last_name');
        $zip = $request->input('zip');
        $phone = $request->input('phone');
        $email = $request->input('email');




        //check if user is logged in or not
        $isUserLoggedIn = Auth::check();

        if($isUserLoggedIn){
            //get user id
            $user_id = Auth::id();  //OR $user_id = Auth:user()->id;

        }else{
            //user is guest (not logged in OR Does not have account)
            $user_id = 0;

        }




        //cart is not empty
        if($cart) {
            // dump($cart);
            $date = date('Y-m-d H:i:s');
            $newOrderArray = array("user_id" => $user_id, "status"=>"on_hold","date"=>$date,"del_date"=>$date,"price"=>$cart->totalPrice,
                "first_name"=>$first_name, "address"=> $address, 'last_name'=>$last_name, 'zip'=>$zip,'email'=>$email,'phone'=>$phone);

            $created_order = DB::table("orders")->insert($newOrderArray);
            $order_id = DB::getPdo()->lastInsertId();;


            foreach ($cart->items as $cart_item){
                $item_id = $cart_item['data']['id'];
                $item_name = $cart_item['data']['name'];
                $item_price = $cart_item['data']['price'];
                $newItemsInCurrentOrder = array("item_id"=>$item_id,"order_id"=>$order_id,"item_name"=>$item_name,"item_price"=>$item_price);
                $created_order_items = DB::table("order_items")->insert($newItemsInCurrentOrder);
            }


            //send the email

            //delete cart
            Session::forget("cart");




            $payment_info =  $newOrderArray;
            $payment_info['order_id'] = $order_id;
            $request->session()->put('payment_info',$payment_info);

            //   print_r($newOrderArray);

            return redirect()->route("showPaymentPage");

        }else{

            return redirect()->route("allProducts");


        }



    }




    public function createOrder(){
        $cart = Session::get('cart');

        //cart is not empty
        if($cart) {
            // dump($cart);
            $date = date('Y-m-d H:i:s');
            $newOrderArray = array("status"=>"on_hold","date"=>$date,"del_date"=>$date,"price"=>$cart->totalPrice);
            $created_order = DB::table("orders")->insert($newOrderArray);
            $order_id = DB::getPdo()->lastInsertId();;


            foreach ($cart->items as $cart_item){
                $item_id = $cart_item['data']['id'];
                $item_name = $cart_item['data']['name'];
                $item_price = $cart_item['data']['price'];
                $newItemsInCurrentOrder = array("item_id"=>$item_id,"order_id"=>$order_id,"item_name"=>$item_name,"item_price"=>$item_price);
                $created_order_items = DB::table("order_items")->insert($newItemsInCurrentOrder);
            }

            //delete cart
            Session::forget("cart");
            Session::flush();
            return redirect()->route("allProducts")->withsuccess("Thanks For Choosing Us");

        }else{

            return redirect()->route("allProducts");

        }


    }







    private function sendMail(){

        $user = Auth::user();
        $cart = Session::get('cart');

        if($cart != null && $user != null ){
            Mail::to($user)->send(new OrderCreatedEmail($cart));
        }



    }*/


}






































