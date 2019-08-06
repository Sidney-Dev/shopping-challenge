<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\User;

use App\Http\Requests\UserEditRequest;

class UserController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
    }

   /* public function edit(){

        $user = User::whereId(Auth::id())->first();

        return view('profile/edit', compact('user'));
    }
*/
    public function update(Request $request){

        $input = $request->all();

        if($request->password == ''){
            $input = $request->except('password');
        } else {
            $input['password'] = Hash::make($request->password);
        }

        $user = User::whereId(Auth::id())->update($input);

        return response()->json([
            'user' => $user,
            'response' => 'updated'
        ], 200);
    }

}
