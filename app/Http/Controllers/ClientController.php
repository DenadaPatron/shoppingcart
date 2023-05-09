<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Slider;
use App\Models\Product;
use App\Models\Category;
use App\Models\Client;
use App\Models\Order;
use App\Cart;
use Illuminate\Support\Facades\Hash;
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

    public function checkout(){
        if(!Session::has('client')){
            return view('client.login');
        }

        if(!Session::has('cart')){
            return view('client.cart');
        }

        return view('client.checkout');
    }

    public function login(){
        return view('client.login');
    }

    public function logout(){
        Session::forget('client');

        return redirect('/');
    }

    public function postcheckout(Request $request){

        $oldCart = session()->has('cart') ? session()->get('cart') : null;
        $cart = new Cart($oldCart);

        $order = new Order();
        $order->name = $request->input('name');
        $order->address = $request->input('address');
        $order->cart = serialize($cart); 

        $order->save();

        Session::forget('cart');

        return redirect('/cart')->with('status', 'Order placed successfully!');
    }

    public function signup(){
        return view('client.signup');
    }

    public function create_account(Request $request){
        $this->validate($request,  ['email' => 'email|required|unique:clients',
                                    'password' => 'required|min:9']);

        $client = new Client();
        $client->email = $request->input('email');
        $client->password = bcrypt($request->input('password'));
        
        $client->save();

        return redirect('/login')->with('status', 'Account created successfully');
    }

    public function access_account(Request $request){
        $this->validate($request,  ['email' => 'email|required',
                                    'password' => 'required|min:9']);

        $client = Client::where('email', $request->input('email'))->first();
        if($client){
            if(Hash::check($request->input('password'), $client->password)){
                Session::put('client', $client);
                return redirect('/admin');
            }else{
                return back()->with('status', 'Bad credentials!')->withInput();

            }
        }else{
            return back()->with('status', 'Bad credentials!')->withInput();
        }
    }

    public function orders(){
        $orders = Order::All();

        $orders->transform(function($order, $key){
            $order->cart = unserialize($order->cart);
            return $order;
        });
        

        return view('admin.orders')->with('orders', $orders);
    }

    public function addtocart($id){
        $product = Product::find($id);
         
        $oldCart = session()->has('cart') ? session()->get('cart') : null;
        $cart = new Cart($oldCart);
        $cart ->add($product, $id);
        Session::put('cart', $cart);

        // dd(Session::get('cart'));
        return back();

    }

    public function update_qty(Request $request, $id){
        //print('the product id is '.$request->id.' And the product qty is '.$request->quantity);
        $oldCart = Session::has('cart')? Session::get('cart'):null;
        $cart = new Cart($oldCart);
        $cart->updateQty($id, $request->quantity);
        Session::put('cart', $cart);

        //dd(Session::get('cart'));
        return back();
    }

    public function cart()
    {
        if (!Session::has('cart')) {
            return view('client.cart');
        }

        $oldCart = session()->has('cart') ? session()->get('cart') : null;
        $cart = new Cart($oldCart);

        return view('client.cart', ['products' => $cart->items, 'totalPrice' => $cart->totalPrice]);
    }

    public function remove_from_cart($id){
        $oldCart = Session::has('cart')? Session::get('cart'):null;
        $cart = new Cart($oldCart);
        $cart->removeItem($id);
       
        if(count($cart->items) > 0){
            Session::put('cart', $cart);
        }
        else{
            Session::forget('cart');
        }

        //dd(Session::get('cart'));
        return back();
    }
    
}
