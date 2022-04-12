<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Admin;
use App\Models\Employee;
use App\Models\Customer;

class LoginController extends Controller
{
    public function Login(){

        return view('pages.login');
    }

    public function loginSubmit(Request $request){

        $this->validate(
            $request,
            [
                'uname'=>'required|min:3|max:20',
                'password'=>'required'

            ],
            [

                'uname.required'=>'Username required',
                'password.required'=>'Password required'
            ]
        );


        $admin = Admin::where('uname',$request->uname)
                            ->where('password',$request->password)
                            ->first();

        $employee = Employee::where('uname',$request->uname)
        ->where('password',$request->password)
        ->first();

        $customer = Customer::where('uname',$request->uname)
        ->where('password',$request->password)
        ->first();

        if($admin){
            $request->session()->put('user',$admin->f_name);
            session([
                'role' => 'Admin'
            ]);
            return redirect()->route('admin.home');
        }
        elseif($employee){
            $request->session()->put('user',$employee->f_name);
            session([
                'role' => 'Employee',
            ]);
            return redirect()->route('employee.home');
        }
        elseif($customer){
            if($customer->status == "Active")
            {
                $request->session()->put('user',$customer->f_name);
                session([
                    'role' => 'Customer',
                    'Customer_id' => $customer->id,
                ]);
                return redirect()->route('customer.home');
            }
            elseif($customer->status == "Deactive")
            {
                $request->session()->flash(
                    'account_deactive',
                    'Your account was deactivated'
                );
                return redirect()->route('login');
            }
            elseif($customer->status == "Pending")
            {
                $request->session()->flash(
                    'account_pending',
                    'Your request is pending.Please try again later.'
                );
                return redirect()->route('login');
            }

        }

        $request->session()->flash(
            'error',
            'Wrong Login Details'
        );
        return redirect()->route('login');
        // return back()->with('error','Wrong Login Details');
        

    }

    public function logout(){
        session()->forget('user');
        session()->forget('role');
        // $request->session()->flush();
        return redirect()->route('login');
    }
}
