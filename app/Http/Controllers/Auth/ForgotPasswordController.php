<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Mail\ResetPassword;
use App\Models\User;
use App\Models\UserToken;
use Illuminate\Foundation\Auth\SendsPasswordResetEmails;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

class ForgotPasswordController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset emails and
    | includes a trait which assists in sending these notifications from
    | your application to your users. Feel free to explore this trait.
    |
    */

    // use SendsPasswordResetEmails;

    public function show(){
        return view('auth.forgot_password');
    }
    public function sendemail(Request $request){
        $token = rand(112389231321, 152389231321);
        $details = [
            'title' => "Forgot Password Loccana",
            'body' => 'Account for '.$request->email,
            'url' => url('/reset-password?email='.$request->email.'&token='.$token)

        ];

        Mail::to($request->email)->send(new ResetPassword($details));

        UserToken::create(['email' => $request->email, 'token' => $token]);

        return redirect('/login')->with('success', 'Check Your Email to Verify');
    }

    public function checkemail(Request $request){
        $user = User::where(['email'=> $request->value])->first();

        if($user){
            return response()->json(['success'=>true]);
        }else{
            return response()->json(['success'=>false]);
        }
    }

    public function reset_password(Request $request){
       $isAvailable = UserToken::where(['email' => $request->email, 'token' => $request->token])->first();

       if($isAvailable){
            $jam_skrg = Carbon::now();
            $jam_dibuat = $isAvailable->created_at;
            $selisih = date_diff( $jam_dibuat, $jam_skrg);
            // dd($selisih);
            if($selisih->h > 0){
                UserToken::where(['id' => $isAvailable->id])->delete();
                User::where(['email' => $request->email])->delete();

                return redirect('/login')->with('fail', 'Token Expired, Try Back');
            }else{
                return view('auth.reset_password', ['email' => $request->email]);
            }
       }else{
          return view('admin.blocked');
       }
    }

    public function reset_password_submit(Request $request){
        UserToken::where(['email' => $request->email])->delete();
        User::where(['email' => $request->email])->update(['password' => Hash::make($request->password)]);

        return redirect('/login')->with('success', 'Password Updated, please login');
    }
}
