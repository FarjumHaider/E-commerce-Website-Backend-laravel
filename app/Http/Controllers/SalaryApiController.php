<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Employee;
use App\Models\Salary;
use Illuminate\Support\Facades\Validator;

class SalaryApiController extends Controller
{
    public function salaryPayingApiList(){

        return Employee::all();
    }

    public function salaryPayedList(){

        return  Salary::all();
        
    }

    //salary paying in form
    public function salaryPaying(Request $request){
       
        $id = $request->id;
        return Employee::where('id',$id)->first();

       ;

    }

    public function payingSubmit(Request $request){

        $validator = Validator::make($request->all(), [
                'payDate'=>'required',
                'fname'=>'required|min:5|max:50',
                'lname'=>'required|min:5|max:50',
                'username'=>'required|min:5|max:20',                           
                'phone'=>'required|regex:/^([0-9\s\-\+\(\)]*)$/',
                'salary'=>'required|numeric',              
                'amount'=>'required|lte:salary'

            ],
            [
                'fname.required'=>'First name required',
                'fname.min'=>'First name should be more than 5 charcters',
                'fname.max'=>'First name should be less than 50 charcters',
                'lname.required'=>'last name required',
                'lname.min'=>'Fast name should be more than 5 charcters',
                'lname.max'=>'Fast name should be less than 50 charcters',
                
                'username.required'=>'Username required',
                
                'payDate.required'=>'DOB required',
                'salary.required'=>'Salary required',
                'salary.numeric'=>'Salary should be a number',

                'amount.lte'=>'Amount should be less than or equal to salary'

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
            $salary=$request->salary;
            $paid=$request->amount;
            $due=$salary-$paid;
    
            $var = new Salary();
            $var->f_name= $request->fname;
            $var->l_name = $request->lname;
            $var->uname = $request->username;
            $var->phone = $request->phone;
            $var->salary = $request->salary;
            $var->paid = $request->amount;
            $var->due = $due;
            $var->payment_date = $request->payDate;
    
    
            $var->save();
    
            return response()->json([
                "status"=>200,
                "message"=>"Salary Added Successfully",
            ]);
        }

    }

    //Deu paying form
    public function salaryPayingDue(Request $request){
       
        $id = $request->id;
        return Salary::where('id',$id)->first();

       

    }

    public function payingDueSubmit(Request $request){


        $validator = Validator::make($request->all(), [
                'payDate'=>'required',
            
                'currentPaid'=>'required|lte:due'

            ],
            [

                
                'payDate.required'=>'DOB required',
                'currentPaid.lte'=>'Amount must be less than or equal to due amount'

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
            $previousDue=$request->due;
            $previousPaid=$request->previousPaid;
            $currentPaid=$request->currentPaid;
    
            $newDue=$previousDue-$currentPaid;
            $totalPaid=$previousPaid+$currentPaid;
    
    
    
            $var = Salary::where('id',$request->id)->first();
    
            $var->paid = $totalPaid;
            $var->due = $newDue;
            $var->payment_date = $request->payDate;
    
            
            $var->save();
            return response()->json([
                "status"=>200,
                "message"=>"Salary Added Successfully",
            ]);

        }
        //----
      


    }
}
