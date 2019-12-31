<?php

namespace App\Http\Controllers\Admin;

use App\Feedback;
use App\Order;
use App\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AdminController extends Controller
{
    public function index() {
        $products = Product::all();
        $orders = Order::all();
        $feedbacks = Feedback::all();
        return view('admin.home', ['products'=>$products, 'orders'=>$orders, 'feedbacks'=>$feedbacks]);
    }
}
