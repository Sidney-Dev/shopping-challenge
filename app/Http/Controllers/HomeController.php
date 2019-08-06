<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\User;
use App\Product;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //$this->middleware('auth');
    }


    public function index(Request $request)
    {
        $clientIP = \Request::ip();

        $user = User::whereId(Auth::id())->first();

        return view('home');

    }
    public function contacts()
    {
        //$user = User::whereId(Auth::id())->first();
        //return view('home', compact('user'));
    }

    public function products(){

        $products = Product::all();

        return response()->json($products, 200);
    }
}
