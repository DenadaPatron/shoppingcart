<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Slider;
use App\Models\Product;
use App\Models\Category;
use App\Cart;
use Session;

class ClientController extends Controller
{
    public function home(){

        $sliders = Slider::All()->where('status', 1);
        $products = Product::All()->where('status', 1);
        return view('client.home')->with('sliders', $sliders)->with('products', $products);
    }

    public function shop(){
        $categories = Category::All();
        $products = Product::All();
        return view('client.shop')->with('categories', $categories)->with('products', $products);
    }

    public function cart(){
        return view('client.cart');
    }

    public function checkout(){
        return view('client.checkout');
    }

    public function login(){
        return view('client.login');
    }

    public function signup(){
        return view('client.signup');
    }

    public function orders(){
        return view('admin.orders');
    }

    public function addtocart($id){
        $product = Product::find($id);
         
        $oldCart = session()->has('cart') ? session()->get('cart') : null;
        $cart = new Cart($oldCart);
        $cart ->add($product, $id);
        Session::put('cart', $cart);

        // dd(Session::get('cart'));
        return back()->with('status', 'Product added to cart successfully');

    }
}
