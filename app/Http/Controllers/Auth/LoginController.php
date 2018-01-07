<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Socialite;
use App\User;
use Illuminate\support\facades\Auth;
class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    // /**
    //  * Redirect the user to the google authentication page.
    //  *
    //  * @return \Illuminate\Http\Response
    //  */
    // public function redirectToProvider()
    // {
    //     // dd('asdfasf');
    //     return Socialite::driver('google')->redirect();
        
    // }

    // /**
    //  * Obtain the user information from google.
    //  *
    //  * @return \Illuminate\Http\Response
    //  */
    // public function handleProviderCallback()
    // {
    
    //     $user = Socialite::driver('google')->user();

    //      return $user->name;
    // }

     /**
     * Redirect the user to the facebook authentication page.
     *
     * @return \Illuminate\Http\Response
     */
    public function redirectToProvider()
    {
        // dd('asdfasf');
        return Socialite::driver('facebook')->redirect();
        
    }

    /**
     * Obtain the user information from facebook.
     *
     * @return \Illuminate\Http\Response
     */
    public function handleProviderCallback()
    {
    
        $userSocial = Socialite::driver('facebook')->stateless()->user();

        //  return $user->name;
        $findUser = User::where('email',$userSocial->email)->first();

        if($findUser){
              
            Auth::login($findUser);
        }
        else{
            
            $user = new User;
            $user->name = $userSocial->name;
            $user->email = $userSocial->email;
            $user->password = bcrypt(123456);
            $user->save();
            Auth::login($user);
        }
    }
}



