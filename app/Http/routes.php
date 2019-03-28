<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

//Route::get('/', function () {
//    return view('welcome');
//});
Route::get('/', ["uses"=>"ProductsController@allProducts", "as"=> "allProducts"]);


//Route::get('/categorias/{cat_name}', function($cat_name){
//    return view('main.catalog', compact('cat_name'));
//});
Route::get('/categorias/{cat_name}', ["uses"=>"ProductsController@category", "as"=> "category"]);


//Route::get('/produto/{prod_id}', function($prod_id){
//    return view('main.pdp', compact('prod_id'));
//});
Route::get('/produto/{prod_id}', ["uses"=>"ProductsController@productPage", "as"=> "productPage"]);


//Route::get('/busca/{term}', function($term){
//    return view('main.search', compact('term'));
//});
Route::get('/busca/', ["uses"=>"ProductsController@searchProducts", "as"=> "searchProducts"]);



//Route::get('/carrinho/', function(){
//    return view('main.cart');
//});
Route::get('/carrinho/', ["uses"=>"ProductsController@cart", "as"=> "cart"]);






//add to cart
Route::get('product/addToCart/{id}',['uses'=>'ProductsController@addProductToCart','as'=>'AddToCart']);

//remove from cart
Route::get('product/removeFromCart/{id}',['uses'=>'ProductsController@removeProductFromCart','as'=>'RemoveFromCart']);

//~~~~
//AJAX
//~~~~
Route::get('/cart/AjaxRemoveFromCart/{id}',['uses'=>'ProductsController@ajaxRemoveProductFromCart','as'=>'AjaxRemoveFromCart']);

Route::get('/cart/AjaxChangeQuantityFromCart/{id}/{qtt}',['uses'=>'ProductsController@ajaxChangeQuantityFromCart','as'=>'AjaxChangeQuantityFromCart']);
