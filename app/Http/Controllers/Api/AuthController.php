<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\YourMailable;
use App\Models\User;
use Carbon\Carbon;
use Auth;

class AuthController extends Controller
{
    public function login(Request $request){
        
        $email = $request->email;
        $password = $request->password;
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            return response()->json([
                'success' => false,
                'status' => 301,
                'message' => "Цахим хаягаа шалгана уу!",
                'data' => []
            ]);
        }

        if (!isset($password)) {
            return response()->json([
                'success' => false,
                'status' => 302,
                'message' => "Нууц үгээ оруулна уу",
                'data' => []
            ]);
        }

        $user = User::where("email", $email)->first();

        if (!$user) {
            return response()->json([
                'success' => false,
                'status' => 303,
                'message' => "Бүртгэлтэй хэрэглэгч олдсонгүй",
                'data' => []
            ]);
        }

        if(Auth::attempt(['email' => $email, 'password' => $password])) {
            $user = Auth::user();
            $user->tokens()->delete();
            if ($user->is_active) {
                $user->device_id = $request->device_id;
                $user->save();
                $data = array(
                    'token' => $user->createToken('authToken')->plainTextToken,
                    'user' => $user,
                );
                return response()->json([
                    'success' => true,
                    'status' => 200,
                    'message' => 'Амжилттай нэвтэрлээ.',
                    'data' => $data
                ]);
            }else{
                return response()->json([
                    'success' => false,
                    'status' => 304,
                    'message' => 'Баталгаажуулаагүй хэрэглэгч байна.',
                    'data' => []
                ]);
            }
        }else{
            return response()->json([
                'success' => false,
                'status' => 305,
                'message' => 'Нэвтрэх нэр эсвэл нууц үг буруу байна.',
                'data' => []
            ]);
        }
    }

    public function sendOtp(Request $request) {
        if (!filter_var($request->email, FILTER_VALIDATE_EMAIL)) {
            return response()->json([
                'success' => false,
                'status' => 303,
                'message' => "Цахим хаяг алдаатай байна",
                'data' => []
            ]);
        }
        $email = $request->email;
        $isRegister = true;
        if (isset($request->isRegister)) {
            $isRegister = $request->isRegister;
        }
        
        $check = User::where("email", $email)->count();
        
        $now = Carbon::now();
        $code = random_int(1000, 9999);
        $message = "";
        $status = 200;
        $other = new OtherController;
        $response = 0;
        $m_status = 1;
        if ($check > 0) {
            $user = User::where("email", $email)->first();
                if ($user->expire_date < $now) {
                    if ($user->password != null && $isRegister) {
                        $status = 301;
                        $message = "БүртгэлтэЙ хэрэглэгч байна";
                    }else if ($user->password == null && !$isRegister) {
                        $status = 301;
                        $message = "Бүртгэлгүй хэрэглэгч байна";
                    }else{
                        $user->otp_code = $code;
                        $user->expire_date = $now->copy()->addMinutes(2);
                        $user->save();
                        if (filter_var($request->email, FILTER_VALIDATE_EMAIL)) {
                            if(env('MAIL_USERNAME') != null && env('MAIL_PASSWORD') != null){
                                Mail::to($email)->send(new YourMailable(["code" => $code]));
                            }
                        }
                    }
                    
                }else{
                    $diff = $now->diff($user->expire_date);
                    $formattedDiff = $diff->format('%I:%S');
                    $message = "OTP код $formattedDiff ийн дараа дахин илгээх боломжтой";
                    $status = 301;
                }
        }else{
            if ($isRegister) {
                $user = new User;
                $user->name = $email;
                if (filter_var($request->email, FILTER_VALIDATE_EMAIL)) {
                    $user->email = $email;
                }
                $user->otp_code = $code;
                $user->expire_date = $now->copy()->addMinutes(2);
                $user->save();
                if (filter_var($request->email, FILTER_VALIDATE_EMAIL)) {
                    if(env('MAIL_USERNAME') != null && env('MAIL_PASSWORD') != null){
                        Mail::to($email)->send(new YourMailable(["code" => $code]));
                    }
                    $message = "Амжилттай илгээлээ.";
                }
            }else{
                return response()->json([
                    'success' => false,
                    'status' => 305,
                    'message' => "Бүртгэлгүй хэрэглэгч байна.",
                    'data' => []
                ]);
            }
        }
        
        return response()->json([
            'success' => $m_status == 1 ? ($status == 200 ? true : false) : false,
            'status' => ($m_status == 1 ? $status : 304),
            'message' => $message == "Амжилттай" ? "Амжилттай илгээлээ." : $message,
            'data' => $m_status == 1 ? ($status == 200 ? [
                "email" => $email,
                "otp_code" => $code
            ] : []) : []
        ]);
    }

    
    public function register(Request $request) {
        if (!filter_var($request->email, FILTER_VALIDATE_EMAIL)) {
            return response()->json([
                'success' => false,
                'status' => 304,
                'message' => "Цахим хаяг алдаатай байна",
                'data' => []
            ]);
        }
        if (!isset($request->otp_code) || strlen($request->otp_code) != 4) {
            return response()->json([
                'success' => false,
                'status' => 305,
                'message' => "OTP код алдаатай байна",
                'data' => []
            ]);
        }
        if (!isset($request->password)) {
            return response()->json([
                'success' => false,
                'status' => 307,
                'message' => "Нууц үгээ оруулна уу",
                'data' => []
            ]);
        }
        $name = $request->name;
        $email = $request->email;
        $otpCode = $request->otp_code;
        $password = $request->password;

        $user = User::where("email", $email)->first();
        $now = Carbon::now();
        $status = 301;
        $message = "Бүртгэлгүй хэрэглэгч байна";
        if ($user) {
            if ($user->phone_verified && $user->is_active) {
                $status = 301;
                $message = "Бүртгэлтэй хэрэглэгч байна";
            }else{
                if ($now < $user->expire_date) {
                    if ($user->otp_code == $otpCode) {
                        $status = 200;
                        $user = User::where("email", $email)->first();
                        $user->name = $name;
                        $user->password = bcrypt($request['password']);
                        $user->email_verified_at = now();
                        $user->is_active = true;
                        $user->save();
                        $message = "Бүртгэл амжилттай үүслээ";
                    }else{
                        $status = 302;
                        $message = "OTP код буруу байна";
                    }
                }else{
                    $status = 303;
                    $message = "Хүчинтэй хугацаа дууссан байна";
                }
            }
        }

        return response()->json([
            'success' => $status == 200 ? true : false,
            'status' => $status,
            'message' => $message,
            'data' => $status == 200 ? [
                "validation" => true,
            ] : []
        ]);
    }

    public function forgotPassword(Request $request) {
        $status = 301;
        $message = "Бүртгэлгүй хэрэглэгч байна";
        if (!filter_var($request->email, FILTER_VALIDATE_EMAIL)) {
            return response()->json([
                'success' => false,
                'status' => 302,
                'message' => "Цахим хаяг алдаатай байна",
                'data' => []
            ]);
        }
        if (!isset($request->otp_code) || strlen($request->otp_code) != 4) {
            return response()->json([
                'success' => false,
                'status' => 303,
                'message' => "OTP код алдаатай байна",
                'data' => []
            ]);
        }
        if (!isset($request->password)) {
            return response()->json([
                'success' => false,
                'status' => 304,
                'message' => "Нууц үгээ оруулна уу",
                'data' => []
            ]);
        }
        $email = $request->email;
        $otpCode = $request->otp_code;
        $password = $request->password;
        $now = Carbon::now();
        $user = User::where("email", $email)->first();
        if ($user) {
            if ($now < $user->expire_date) {
                if ($user->otp_code == $otpCode) {
                    $user->password = bcrypt($request['password']);
                    $status = 200;
                    $message = "Нууц үг амжилттай шинэчиллээ";
                }else{
                    $status = 305;
                    $message = "OTP код буруу байна";
                }
            }else{
                $status = 306;
                $message = "Хүчинтэй хугацаа дууссан байна";
            }
        }
        $user->save();

        return response()->json([
            'success' => $status == 200 ? true : false,
            'status' => $status,
            'message' => $message,
            'data' => $status == 200 ? [
                "validation" => true,
            ] : []
        ]);
    }

    public function check(Request $request) {
        $user = $request->user();
        $data = [];
        if ($user) {
            $data = array(
                'token' => $request->token,
                'user' => $user,
            );
        }
        return response()->json([
            'success' => true,
            'status' => 200,
            'message' => 'Амжилттай нэвтэрлээ.',
            'data' => $data
        ]); 
    }
}
