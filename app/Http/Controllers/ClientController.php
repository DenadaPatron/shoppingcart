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
    // retrieves all active sliders and products, and returns the 'client.home' view with the data.
    public function home()
    {
        $sliders = Slider::All()->where('status', 1);
        $products = Product::All()->where('status', 1);
        return view('client.home')->with('sliders', $sliders)->with('products', $products);
    }

    // retrieves all categories and products, and returns the 'client.shop' view with the data.
    public function shop()
    {
        $categories = Category::All();
        $products = Product::All();
        return view('client.shop')->with('categories', $categories)->with('products', $products);
    }

    // returns the appropriate view based on the client's session data (login, cart, or checkout).
    public function checkout()
    {
        if (!Session::has('client')) {
            return view('client.login');
        }

        if (!Session::has('cart')) {
            return view('client.cart');
        }

        return view('client.checkout');
    }

    // returns the 'client.login' view.
    public function login()
    {
        return view('client.login');
    }

    // logs the client out and redirects to the homepage.
    public function logout()
    {
        Session::forget('client');

        return redirect('/');
    }

    // processes the order, saves it to the database, and redirects to the cart view with a success message.
    public function postcheckout(Request $request)
    {
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

    // returns the 'client.signup' view.
    public function signup()
    {
        return view('client.signup');
    }

    // validates the request, creates a new client account, and redirects to the login view with a success message.
    public function create_account(Request $request)
    {
        $this->validate($request,  ['email' => 'email|required|unique:clients',
                                    'password' => 'required|min:9']);

        $client = new Client();
        $client->email = $request->input('email');
        $client->password = bcrypt($request->input('password'));
        
        $client->save();

        return redirect('/login')->with('status', 'Account created successfully');
    }


     //  validates the client's email and password, and either logs them in or redirects back with an error message.
     public function access_account(Request $request)
     {
         $this->validate($request,  ['email' => 'email|required',
                                     'password' => 'required|min:9']);
 
         $client = Client::where('email', $request->input('email'))->first();
         if ($client) {
             if (Hash::check($request->input('password'), $client->password)) {
                 Session::put('client', $client);
                 return redirect('/admin');
             } else {
                 return back()->with('status', 'Bad credentials!')->withInput();
             }
         } else {
             return back()->with('status', 'Bad credentials!')->withInput();
         }
     }
 
     //  retrieves all orders, unserializes the cart data, and returns the 'admin.orders' view with the orders data.
     public function orders()
     {
         $orders = Order::All();
 
         $orders->transform(function ($order, $key) {
             $order->cart = unserialize($order->cart);
             return $order;
         });
 
         return view('admin.orders')->with('orders', $orders);
     }
 
     //  adds a product to the cart and redirects to the 'shop' view.
     public function addtocart($id)
     {
         $product = Product::find($id);
 
         $oldCart = session()->has('cart') ? session()->get('cart') : null;
         $cart = new Cart($oldCart);
         $cart->add($product, $id);
         Session::put('cart', $cart);
 
         return redirect('shop');
     }
 
     //  updates the quantity of a product in the cart and redirects back to the previous view.
     public function update_qty(Request $request, $id)
     {
         $oldCart = Session::has('cart') ? Session::get('cart') : null;
         $cart = new Cart($oldCart);
         $cart->updateQty($id, $request->quantity);
         Session::put('cart', $cart);
 
         return back();
     }
 
     //  returns the 'client.cart' view with the cart data if there's a cart in the session, or an empty cart view if not.
     public function cart()
     {
         if (!Session::has('cart')) {
             return view('client.cart');
         }
 
         $oldCart = session()->has('cart') ? session()->get('cart') : null;
         $cart = new Cart($oldCart);
 
         return view('client.cart', ['products' => $cart->items, 'totalPrice' => $cart->totalPrice]);
     }
 
     //  removes a product from the cart and returns the user back to the previous view.
     public function remove_from_cart($id)
     {
         $oldCart = Session::has('cart') ? Session::get('cart') : null;
         $cart = new Cart($oldCart);
         $cart->removeItem($id);
 
         if (count($cart->items) > 0) {
             Session::put('cart', $cart);
         } else {
             Session::forget('cart');
         }
 
         return back();
     }
    
}
