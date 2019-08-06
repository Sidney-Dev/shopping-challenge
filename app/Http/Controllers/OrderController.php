<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Order;
use App\User;
Use DB;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    //
    public function index(){

        if(Auth::check()){
            $order = Order::whereUserId(Auth::id())->get();
            if(empty($order)){

                return "empty";
            } else {
                return response()->json($order, 200);
            }
        } else {
            return "not_logged"; 
        }
    }

    public function is_logged(){
        if(Auth::check()){
          //  return "is_logged";


            return response()->json([
                'user' => User::whereId(Auth::id())->first(),
                'is_logged' => 'is_logged'

            ], 200);

        } else {
            return "not_logged";
        }
    }


    public function list_order($order = null){

        $orders = DB::table('products')->whereIn('id', $order)->get();
    
        return $orders;
    }

    public function confirm_order(Request $request){

       /* $request->product_id = '1';
        $request->user_id = '12';*/

        $order = new Order;
        $order->product_id = $request->product_id;
        $order->user_id = Auth::id();

        $order->save();

        return "Success";
    }

    /**
     * Show all the products ordered by a user
     */
    public function show(){

        $orders = DB::table('orders')->distinct()->whereUserId(Auth::id())->get(['product_id']);

        $p = [];

        foreach($orders as $order){
            array_push($p, $order->product_id);
          
        }

        $products = DB::table('products')->whereIn('id', $p)->get();

        return view('orders', compact('products'));
    }

}
