<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\public_classes\MailTemplate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Password;
use Tymon\JWTAuth\Facades\JWTAuth;

class   ForgotPasswordController extends Controller
{
    public function forgot() {
        $credentials = request()->validate(['email' => 'required|email']);
        $details = User::where('email',$credentials)->first();
        Mail::to('baselosama5005@gmail.com')->send(new \App\Mail\MyTestMail($details));

        return response()->json(["status" => 'success','message'=>"Email is Sent, please check your inbox.","data"=>$details]);
    }
//    public function reset() {
//        dd('sd');
//        $credentials = request()->validate([
//            'email' => 'required|email',
//            'phone_number' => 'required|string',
//            'password' => 'required|string|confirmed'
//        ]);
//
//        $reset_password_status = Password::reset($credentials, function ($user, $password) {
//            $user->password = $password;
//            $user->save();
//        });
//
//        if ($reset_password_status == Password::INVALID_TOKEN) {
//            return response()->json(["msg" => "Invalid token provided"], 400);
//        }
//
//        return response()->json(["msg" => "Password has been successfully changed"]);
//    }
}
