<?php

namespace App\Http\Controllers;

use App\Http\Requests\Account\Passwords\DemandeResetPasswordRequest;
use App\Http\Requests\Account\Passwords\ResetPasswordRequest;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Str;

class AccountController extends Controller
{
    public function __construct(){
        $this->middleware('auth:api')->only(['verificationSent','verificationVerify']);
        $this->middleware('guest')->only(['requestPassword','resetPassword']);
    }
    public function requestPassword(DemandeResetPasswordRequest $request){
        $status = Password::sendResetLink(
            $request->only('email')
        );
        return response()->json(["message" => __($status)]);
        
    }
    public function resetPassword(ResetPasswordRequest $request){
        $status = Password::reset(
            $request->only('token','email','password'),
            function (User $user , string $password){
                $user->forceFill([
                    "password" => Hash::make($password)
                ])->setRememberToken(Str::random(50));
                $user->save();
            }
        );
        return response()->json(["message" => __($status)]);
    }
    public function verificationVerify(EmailVerificationRequest $request){
        $request->fulfill();
        return response()->json([
            "message" => "Your email has been verified"
        ]);
    }
    public function verificationSent(Request $request){
        $request->user()->sendEmailVerificationNotification();
 
        return response()->json([
            'message' => 'Verification link sent!'
        ]);
    }
}
