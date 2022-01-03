<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use App\Models\Admin;

class AdminController extends Controller
{

    public function search(Request $request){

        if($request->search != "")
        {
            $output="";
            $search = $request->search;


            $admins = Admin::where('f_name','LIKE',"%$search%")
                    ->orWhere('l_name','LIKE',"%$search%")
                    ->orWhere('uname','LIKE',"%$search%")
                    ->get();
    
            if ( count( $admins ) > 0 )
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
                    <th>Joining Date</th>
                    <th>Address</th>
                    <th></th>
                </tr>";
                foreach($admins as $admin)
                {
                    $output.=
                            "<tr> 
                                <td><img src='/storage/admin_images/$admin->image' width='70px' height='70px' alt=''></td>
                                <td>$admin->f_name</td>
                                <td>$admin->l_name</td>
                                <td>$admin->email</td>
                                <td>$admin->phone</td>
                                <td>$admin->dob</td>
                                <td>$admin->gender</td>
                                <td>$admin->joining_date</td>
                                <td>$admin->address</td>
                                <td><a href='/admin/edit/$admin->id/$admin->f_name'>Edit</a></td>  
                                <td><a href='/admin/delete/$admin->id/$admin->f_name'>Delete</a></td>   
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

    



    public function createAdmin(){
        return view('pages.admin.create');
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
                'phone.required'=>'Phone number required',
                'gender.required'=>'Gender required',
                'joiningDate.required'=>'Joining Date required'
            ]
        );

        $var = new Admin();
        $var->f_name= $request->fname;
        $var->l_name = $request->lname;
        $var->uname = $request->username;
        $var->password = $request->password;
        $var->email = $request->email;
        $var->phone = $request->phone;
        $var->dob = $request->dob;
        $var->gender = $request->gender;
        $var->joining_date = $request->joiningDate;
        $var->address = $request->address;

        if($request->hasfile('image'))
        {
            $file = $request->file('image');
            $extension = $file->getClientOriginalExtension();
            $filename = time().'.'.$extension;
            $file->move('storage/admin_images/',$filename);
            $var->image = $filename;
        }
        $var->save();

        // return redirect()->route('productlist');   

        return redirect()->route('admin.list');
    }

    public function adminList(){

        $admins = Admin::all();
        return view('pages.admin.list')->with('admins',$admins);
    }

    public function adminEdit(Request $request){
        $id = $request->id;
        $admin = Admin::where('id',$id)->first();

        return view('pages.admin.edit')->with('admin', $admin);

    }

    public function editSubmit(Request $request){
        $var = Admin::where('id',$request->id)->first();
        $var->f_name= $request->fname;
        $var->l_name = $request->lname;
        $var->uname = $request->username;
        $var->password = $request->password;
        $var->email = $request->email;
        $var->phone = $request->phone;
        $var->dob = $request->dob;
        $var->gender = $request->gender;
        $var->joining_date = $request->joiningDate;
        $var->address = $request->address;
        if($request->hasfile('image'))
        {
            $destination = 'storage/admin_images/'.$var->image;
            if(File::exists($destination))
            {
                File::delete($destination);
            }
            $file = $request->file('image');
            $extension = $file->getClientOriginalExtension();
            $filename = time().'.'.$extension;
            $file->move('storage/admin_images/',$filename);
            $var->image = $filename;
        }
        
        $var->save();
        return redirect()->route('admin.list');


    }

    public function delete(Request $request){
        $var = Admin::where('id',$request->id)->first();
        $destination = 'storage/admin_images/'.$var->image;
        if(File::exists($destination))
        {
            File::delete($destination);
        }
        $var->delete();
        return redirect()->route('admin.list');
    }
}
