<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use App\Models\Admin;
use App\Models\Token;
use Illuminate\Support\Str;
use DateTime;

class LogoutApiController extends Controller
{

    public function logout(Request $request){

        $user_token = $request->tokenkey;
        //  return $user_token;
        $token = Token::where('token',$user_token)->first();
        // return $token;
        // return $token->expired_at;
        $token->expired_at = new DateTime();
        // return $token->expired_at;
        $token->save();

        return response()->json([
            "status"=>200,
            "message"=>"Logout successfully",
        ]);




        

    }
}
