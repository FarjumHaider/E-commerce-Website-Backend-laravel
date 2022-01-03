<?php

namespace App\Http\Controllers;
use App\Models\Admin;
use Illuminate\Support\Facades\File;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class AdminApiController extends Controller
{
    //Admin list
    public function AdminApiList(){
        return Admin::all();
    }


    //Admin Delete
    public function AdminAPIdelete(Request $request){
        $id = $request->id;
        $admin = Admin::where('id',$id)->first();
        $destination = 'storage/admin_images/'.$admin->image;
        if(File::exists($destination))
        {
            File::delete($destination);
        }
        $admin->delete();
        return "Deleted";
    }

    //Admin Details
    public function AdminAPIDetails(Request $request){
        $id = $request->id;
        $name = $request->name;
        $admin = Admin::where('id',$id)->where('f_name',$name)->first();
        return $admin;
    }


    //Admin create
    public function AdminAPICreate(Request $request)
    {
        
        $validator = Validator::make($request->all(), [    
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
        
        if ($validator->fails()) 
        {
            return response()->json([
                'status'=>422,
                'errors'=>$validator->messages()
            ]);
        }
        else
        {
            
            $admin = new Admin();
            $admin->f_name= $request->fname;
            $admin->l_name = $request->lname;
            $admin->uname = $request->username;
            $admin->password = $request->password;
            $admin->email = $request->email;
            $admin->phone = $request->phone;
            $admin->dob = $request->dob;
            $admin->gender = $request->gender;
            $admin->joining_date = $request->joiningDate;
            $admin->address = $request->address;
            
            if($request->hasfile('image'))
            {
                $file = $request->file('image');
                $extension = $file->getClientOriginalExtension();
                $filename = time().'.'.$extension;
                $file->move('storage/admin_images/',$filename);
                $admin->image = $filename;
            }

            $admin->save();

            return response()->json([
                "status"=>200,
                "message"=>"Admin Added Successfully",
            ]);

         }

    }


    //Edit Admin
    public function AdminApiEdit(Request $request){
        // return $request->id;
        $id = $request->id;
        $admin = Admin::where('id',$id)->first();
        return $admin;
    }


    //Edit Admin Submit
    public function AdminApiEditSubmit(Request $request){
        
        $admin = Admin::where('id',$request->id)->first();
        $admin->f_name= $request->fname;
        $admin->l_name = $request->lname;
        $admin->uname = $request->username;
        $admin->password = $request->password;
        $admin->email = $request->email;
        $admin->phone = $request->phone;
        $admin->dob = $request->dob;
        $admin->gender = $request->gender;
        $admin->joining_date = $request->joiningDate;
        $admin->address = $request->address;
        if($request->hasfile('image'))
        {
            $destination = 'storage/admin_images/'.$admin->image;
            if(File::exists($destination))
            {
                File::delete($destination);
            }
            $file = $request->file('image');
            $extension = $file->getClientOriginalExtension();
            $filename = time().'.'.$extension;
            $file->move('storage/admin_images/',$filename);
            $admin->image = $filename;
        }
        
        $admin->save();
        return 200;


    }



}
