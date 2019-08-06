<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use App\User;

class IsLoggedIn
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if(Auth::check()){

            $user = User::whereId(Auth::id())->first();

            $request->session([
                'id' => Auth::id()
            ]);

            $user->update(['is_logged' => true]);
            //create a session with the user_id

            

        } else {

            $request->session()->put([
                'guest1' => 'Session 1',
                'guest2' => 'Session 2'
            ]);

           /* $request->session()->flush();*/

            dd($request->session()->all());

           // DB::table('users')
        }
        return $next($request);

    }
}
