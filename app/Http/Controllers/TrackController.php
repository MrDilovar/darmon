<?php

namespace App\Http\Controllers;

use App\Order;
use Illuminate\Http\Request;
use Validator;

class TrackController extends Controller
{
    public function index()
    {
        return view('guest.track_index');
    }

    public function search(Request $request) {
        return redirect(route('track.show', $request->track));
    }

    public function show(Request $request, $id)
    {
        $validator = Validator::make(
            ['id'=>$id],
            ['id' =>'required|integer|not_in:0']
        );

        if ($validator->fails()) {
            $order = null;
        } else {
            $order = Order::find($id);
        }

        return view('guest.track_show', ['order'=>$order]);
    }
}
