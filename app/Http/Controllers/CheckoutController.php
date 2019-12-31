<?php

namespace App\Http\Controllers;

use App\Order;
use App\OrderProduct;
use Illuminate\Http\Request;
use Gloudemans\Shoppingcart\Facades\Cart;

class CheckoutController extends Controller
{
    public function index() {
        if (Cart::instance('default')->count() == 0) {
            return redirect()->route('shop.index');
        }

        return view('guest.checkout');
    }

    public function store(Request $request) {

        $request->validate([
            'name'=>'required|max:255',
            'phone'=>'required|max:255',
            'address'=>'required|max:255',
            'email'=>'max:255',
            'comment'=>'max:600',
            'contactAgree'=>'required|accepted'
        ]);

        $total = (int)str_replace(' ', '', Cart::subtotal());

        // Insert into orders table
        $order = new Order([
            'name' => $request->name,
            'phone' => $request->phone,
            'address' => $request->address,
            'email' => $request->email,
            'comment' => $request->comment,
            'total' => $total,
        ]);
        $order->save();

        // Insert into order_product table
        foreach (Cart::content() as $item) {
            OrderProduct::create([
                'order_id' => $order->id,
                'product_id' => $item->model->id,
                'quantity' => $item->qty,
            ]);
        }

//        Mail::send(new OrderPlaced($order));

        Cart::instance('default')->destroy();

        return redirect()->route('checkout.thankyou')->with('order', $order);
    }

    public function thankyou() {
        $order = session()->get('order');

        if ($order === null) {
            return redirect()->route('shop.index');
        }

        return view('guest.thankyou', ['order'=>$order]);
    }
}
