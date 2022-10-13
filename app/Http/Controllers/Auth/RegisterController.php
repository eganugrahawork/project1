<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Mail\RegisterMail;
use App\Providers\RouteServiceProvider;
use App\Models\User;
use App\Models\UserDetail;
use App\Models\UserToken;
use Carbon\Carbon;
// use DateTime;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
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
    protected function create(Request $request)
    {
        return $this->ConfirmMailRegistration($request);
    //    dd($request);



        // return User::create([
        //     'username' => strtolower($data['username']),
        //     'email' => $data['email'],
        //     'id_detail_user' => $detailUser['id'],
        //     'id_role' => $data['id_role'],
        //     'password' => Hash::make($data['password']),
        // ]);
    }

    public function ConfirmMailRegistration($data){

        $token = rand(112389231321, 152389231321);
        $details = [
            'title' => "Confirm Registration Loccana",
            'body' => 'Account for '.$data->name,
            'url' => url('/register_verify?email='.$data->email.'&token='.$token)

        ];

        Mail::to($data->email)->send(new RegisterMail($details));
        $data['token'] = $token;
        $data['username'] = 'demo-'.substr($data->email, 0, strrpos($data->email, '@'));
        $this->createUser($data);

        // dd($token);
        return redirect('/login')->with('success', 'Check Your Email');
    }

    public function createUser($data){
        UserToken::create(['email'=> $data->email, 'token' => $data->token]);
        return User::create([
            'username' => $data->username,
            'email' => $data->email,
            'name' => $data->name,
            'address' => $data->address,
            'id_role' => 1,
            'image' => "img-users/default.png",
            'no_hp' => $data->no_hp,
            'type_user_id' => $data->type_user_id,
            'type_account_id' => $data->type_account_id,
            'is_active' => 0
        ]);
    }

    public function register_verify(Request $request){
        $isavailable = UserToken::where(['email' => $request->email, 'token' => $request->token])->first();
        // dd(rand(112389231321, 152389231321));
        if($isavailable){
            $tgl_skrg = Carbon::now();
            // $tgl_skrg = date_create("2022-10-14 14:52:17");
            $tgl_dibuat = $isavailable->created_at;
            $selisih = date_diff( $tgl_dibuat, $tgl_skrg);
            if($selisih->d > 0){
                UserToken::where(['id' => $isavailable->id])->delete();
                User::where(['email' => $request->email])->delete();

                return redirect('/login')->with('fail', 'Token Expired, Try Registration Back');
            }else{
                return view('auth.registerverify', ['user'=> User::where(['email' => $request->email])->first()]);
            }
        }else{
            return view('admin.blocked');
        }


    }

    public function update(Request $request){
        UserToken::where(['email' => $request->email])->delete();
        User::where(['email' => $request->email])->update(['password' => Hash::make($request->password), 'is_active' => 1]);
        return redirect('/login')->with('success', 'Your Account Already to User');
    }

}
