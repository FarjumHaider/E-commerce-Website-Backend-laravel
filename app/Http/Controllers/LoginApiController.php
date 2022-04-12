<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use App\Models\Admin;
use App\Models\Employee;
use App\Models\Token;
use Illuminate\Support\Str;
use DateTime;

class LoginApiController extends Controller
{
    public function loginApiSubmit(Request $request){

        // return "ok";
        $validator = Validator::make($request->all(),
            [
                'username'=>'required|min:3|max:20',
                'password'=>'required'

            ],
            [

                'username.required'=>'Username required',
                'password.required'=>'Password required'
            ]
        );

        if ($validator->fails()) 
        {
            return response()->json([
                'status'=>422,
                'errors'=>$validator->messages()
            ]);
        }
        
        else{
            $admin = Admin::where('uname',$request->username)->where('password',$request->password)->first();
            $employee = Employee::where('uname',$request->username)->where('password',$request->password)->first();
            if($admin)
            {
                
                
                $api_token = Str::random(64);
                
                $token = new Token();
               
                $token->userid = $admin->id;
                
                $token->token = $api_token;
                // return  $token->token;
                $token->created_at = new DateTime();
                
                $token->save();
               
                //return  "ok";
                //return $token;
                return response()->json([
                    "status"=>200,
                    "token"=> $token->token,
                    "fname"=> $admin->f_name,
                    "lname"=> $admin->l_name,
                    "role"=> "Admin",
                ]);
            }
              
            elseif($employee)
            {
                
                
                $api_token = Str::random(64);
                
                $token = new Token();
               
                $token->userid = $employee->id;
                
                $token->token = $api_token;
                // return  $token->token;
                $token->created_at = new DateTime();
                
                $token->save();
               
                //return  "ok";
                //return $token;
                return response()->json([
                    "status"=>200,
                    "token"=> $token->token,
                    "fname"=> $employee->f_name,
                    "lname"=> $employee->l_name,
                    "role"=> "Employee",
                ]);
            }
            return response()->json([
                "status"=>500,
                "message"=>"Invalid user",
            ]);
        }


        

    }
}
