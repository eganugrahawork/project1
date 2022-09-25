<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\Models\User;
use App\Models\UserDetail;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

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
    protected $redirectTo = RouteServiceProvider::HOME;

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
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'username' => ['required', 'string', 'max:255', 'unique:users,username'],
            'id_role' => ['required', 'integer'],
            'alamat' => ['required', 'string'],
            'nokontak' => ['required', 'string', 'unique:user_details,nokontak'],
            'lokasi' => ['required', 'string'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Models\User
     */
    protected function create(array $data)
    {

        UserDetail::create([
            'nama' => $data['nama'],
            'image' => $data['image'],
            'alamat' => $data['alamat'],
            'nokontak' => $data['nokontak'],
            'lokasi' => $data['lokasi']
        ]);

        $detailUser = UserDetail::latest()->first();



        return User::create([
            'username' => strtolower($data['username']),
            'email' => $data['email'],
            'id_detail_user' => $detailUser['id'],
            'id_role' => $data['id_role'],
            'password' => Hash::make($data['password']),
        ]);
    }
}
