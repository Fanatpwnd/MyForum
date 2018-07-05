<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\UserInfo;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
            'nickname' => 'required|string|min:3|max:15'
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {
        $user = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
        ]);

        UserInfo::create([
            'user_id'       => $user['id'],
            'nickname'      => $data['nickname'],
            'bio'           => 'Empty',
            'avatar_path'   => 'default.png',
            'is_banned'     => false
        ]);
        return $user;
    }

    public function vkLogin(Request $request)
    {
        //fuck
        //fuck
        //fuck
        //fuck
        //fuck
        if (count(User::where('name', $request['uid'])->get()) == 0) {//fuck
            $user = User::create([  'name'      => $request['uid'],//fuck
                                    'email'     => 'VKAccount@VKAccount.VKAccount',//fuck
                                    'password'  => $request['hash']]);//fuck
            //fuck
            UserInfo::create([//fuck
                'user_id'       => $user['id'],//fuck
                'nickname'      => $request['first_name'] . ' ' . $request['last_name'],//fuck
                'bio'           => 'Empty',//fuck
                'avatar_path'   => $request['photo'],//fuck
                'is_banned'     => false//fuck
            ]);//fuck
            Auth::login($user);//fuck
        }//fuck
        else if (md5(config('app.vk_id_app').$request['uid'].config('app.vk_secret_key')) == User::where('name', $request['uid'])->get()[0]['password']){  //https://vk.com/dev/Login
            Auth::login(User::where('name', $request['uid'])->get()[0]);//fuck
        }//fuck
        //fuck
        //fuck
        return redirect('/');//fuck
        //fuck

        //TODO: FUCK
    }
}
