<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Employee;
use App\Models\Salary;

class SalaryController extends Controller
{
    public function salaryPayingList(){

        $employees = Employee::all();
        return view('pages.salary.payingList')->with('employees',$employees);
    }


    public function searchPayingList(Request $request){

        if($request->search != "")
        {
            $output="";
            $search = $request->search;


            $employees = Employee::where('f_name','LIKE',"%$search%")
                    ->orWhere('l_name','LIKE',"%$search%")
                    ->orWhere('uname','LIKE',"%$search%")
                    ->get();
    
            if ( count( $employees ) > 0 )
            {
                $output = "<table class='table table-borded'>
                <tr>
                    <th>Image</th>
                    <th>First name</th>
                    <th>Last name</th>
                    <th>Email</th>
                    <th>Phone</th>
                    <th>Date of Birth</th>
                    <th>Gender</th>
                    <th>Salary</th>
                    <th>Joining Date</th>
                    <th>Address</th>
                    <th></th>
                </tr>";
                foreach($employees as $employee)
                {
                    $output.=
                            "<tr> 
                                <td><img src='/storage/employee_images/$employee->image' width='70px' height='70px' alt=''></td>
                                <td>$employee->f_name</td>
                                <td>$employee->l_name</td>
                                <td>$employee->email</td>
                                <td>$employee->phone</td>
                                <td>$employee->dob</td>
                                <td>$employee->gender</td>
                                <td>$employee->salary</td>
                                <td>$employee->joining_date</td>
                                <td>$employee->address</td>
                                <td><a href='/salary/paying/$employee->id/$employee->f_name'>Pay</a></td>  
  
                            </tr>";
                }
    
                $output .= '</table>';
                
            }
            else
            {

                $output .= '<span class="text-danger"> No data found </span>';
            }
            return $output;
        }
        
    }

    public function salaryPaying(Request $request){
       
        $id = $request->id;
        $employee = Employee::where('id',$id)->first();

        return view('pages.salary.paying')->with('employee', $employee);

    }

    public function payingSubmit(Request $request){

        $this->validate(
            $request,
            [
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


        
        return redirect()->route('salary.payedList');
    }


    public function salaryPayedList(){

        $salaries = Salary::all();
        return view('pages.salary.payedList')->with('salaries',$salaries);
    }

    public function salaryPayingDue(Request $request){
       
        $id = $request->id;
        $salary = Salary::where('id',$id)->first();

        return view('pages.salary.payingDue')->with('salary', $salary);

    }

    public function payingDueSubmit(Request $request){


        $this->validate(
            $request,
            [
                'payDate'=>'required',
            
                'currentPaid'=>'required|lte:due'

            ],
            [

                
                'payDate.required'=>'DOB required',
                'currentPaid.lte'=>'Amount must be less than or equal to due amount'

            ]
        );
        //----
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
        return redirect()->route('salary.payedList');


    }

}
