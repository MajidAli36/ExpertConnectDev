<?php

namespace App\Http\Middleware;

use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use App\Models\User;
use Closure;

class UserLoginAuthenticate
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

        // if(Auth::guest())
            // return view('auth.login');

        


        $emailValidate = Validator::make($request->all(),['email' => 'required|min:6|email' ]);

                    // If validation fail then it's mobile number
        // if($emailValidate->fails())
        //     $user = User::where(['mobile' => $request->user,  'is_active' => 1, 'is_delete' => 0])->first();
        // else
            $user = User::where(['useremail'=> $request->useremail,  'status' => 'Y'])->first();


                    // User not exist and password mismatch
        if( ! ($user &&Hash::check($request->password,$user->password))){
                     // return redirect()->back()->withErrors(['msg' => 'Invalid Username/Password'])->withInput();            
                    return redirect('/');
        }else{        
            //Auth::login($user);
            // session([ 'user_id' => $user->id , 'user' => $user->name, 'active' => 1]);

            return $next($request);
        }
        return  redirect('login');
    }
}
