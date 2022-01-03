<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Employee;

class EmployeeController extends Controller
{
    public function createEmployee(){
        return view('pages.employee.create');
    }

    public function createSubmit(Request $request){

        $this->validate(
            $request,
            [
                'fname'=>'required|min:5|max:50',
                'lname'=>'required|min:5|max:50',
                'address'=>'required|min:5|max:50',
                'email'=>'email',
                'username'=>'required|min:5|max:20',
                'password'=>'required',
                'conpassword'=>'required|same:password',
                'dob'=>'required',
                'phone'=>'required|regex:/^([0-9\s\-\+\(\)]*)$/',
                'salary'=>'required|numeric',
                'gender'=>'required',
                'joiningDate'=>'required',
                'image'=>'required'

            ],
            [
                'fname.required'=>'First name required',
                'fname.min'=>'First name should be more than 5 charcters',
                'fname.max'=>'First name should be less than 50 charcters',
                'lname.required'=>'last name required',
                'lname.min'=>'Fast name should be more than 5 charcters',
                'lname.max'=>'Fast name should be less than 50 charcters',
                'address.required'=>'Address required',
                'email.required'=>'Email required',
                'username.required'=>'Username required',
                'password.required'=>'Password required',
                'conpassword.required'=>'Confirm password required',
                'dob.required'=>'DOB required',
                'salary.required'=>'Salary required',
                'salary.numeric'=>'Salary should be a number',
                'phone.required'=>'Phone number required',
                'gender.required'=>'Gender required',
                'joiningDate.required'=>'Joining Date required',
                'image.required'=>'Image number required',
            ]
        );

        $var = new Employee();
        $var->f_name= $request->fname;
        $var->l_name = $request->lname;
        $var->uname = $request->username;
        $var->password = $request->password;
        $var->email = $request->email;
        $var->phone = $request->phone;
        $var->dob = $request->dob;
        $var->gender = $request->gender;
        $var->salary = $request->salary;
        $var->joining_date = $request->joiningDate;
        $var->address = $request->address;

        if($request->hasfile('image'))
        {
            $file = $request->file('image');
            $extension = $file->getClientOriginalExtension();
            $filename = time().'.'.$extension;
            $file->move('storage/employee_images/',$filename);
            $var->image = $filename;
        }
        $var->save();

        
        return redirect()->route('employee.list');
    }

    public function employeeList(){

        $employees = Employee::all();
        return view('pages.employee.list')->with('employees',$employees);
    }

    public function search(Request $request){

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
                                <td><a href='/employee/edit/$employee->id/$employee->f_name'>Edit</a></td>  
                                <td><a href='/employee/delete/$employee->id/$employee->f_name'>Delete</a></td>   
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

    public function employeeEdit(Request $request){
        $id = $request->id;
        $employee = Employee::where('id',$id)->first();

        return view('pages.employee.edit')->with('employee', $employee);

    }

    public function editSubmit(Request $request){
        $var = Employee::where('id',$request->id)->first();
        $var->f_name= $request->fname;
        $var->l_name = $request->lname;
        $var->uname = $request->username;
        $var->password = $request->password;
        $var->email = $request->email;
        $var->phone = $request->phone;
        $var->dob = $request->dob;
        $var->salary = $request->salary;
        $var->gender = $request->gender;
        $var->joining_date = $request->joiningDate;
        $var->address = $request->address;
        if($request->hasfile('image'))
        {
            $destination = 'storage/employee_images/'.$var->image;
            if(File::exists($destination))
            {
                File::delete($destination);
            }
            $file = $request->file('image');
            $extension = $file->getClientOriginalExtension();
            $filename = time().'.'.$extension;
            $file->move('storage/employee_images/',$filename);
            $var->image = $filename;
        }
        
        $var->save();
        return redirect()->route('employee.list');


    }

    public function delete(Request $request){

        $var = Employee::where('id',$request->id)->first();

        // $destination = 'storage/employee_images/'.$var->image;

        // if(File::exists($destination))
        // {
        //     File::delete($destination);
        // }
        $var->delete();
        return redirect()->route('employee.list');
    }
}
