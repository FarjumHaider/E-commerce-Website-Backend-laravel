<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use App\Models\Deliveryman;

class DeliveryManController extends Controller
{

    public function search(Request $request){

        if($request->search != "")
        {
            $output="";
            $search = $request->search;


            $deliveryMans = Deliveryman::where('f_name','LIKE',"%$search%")
                    ->orWhere('l_name','LIKE',"%$search%")
                    ->orWhere('uname','LIKE',"%$search%")
                    ->get();
    
            if ( count( $deliveryMans ) > 0 )
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
                foreach($deliveryMans as $deliveryMan)
                {
                    $output.=
                            "<tr> 
                                <td><img src='/storage/deliveryMans_images/$deliveryMan->image' width='70px' height='70px' alt=''></td>
                                <td>$deliveryMan->f_name</td>
                                <td>$deliveryMan->l_name</td>
                                <td>$deliveryMan->email</td>
                                <td>$deliveryMan->phone</td>
                                <td>$deliveryMan->dob</td>
                                <td>$deliveryMan->gender</td>
                                <td>$deliveryMan->joining_date</td>
                                <td>$deliveryMan->address</td>
                                <td><a href='/deliveryMans/edit/$deliveryMan->id/$deliveryMan->f_name'>Edit</a></td>  
                                <td><a href='/deliveryMans/delete/$deliveryMan->id/$deliveryMan->f_name'>Delete</a></td>   
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

    



    public function createDeliveryMan(){
        return view('pages.deliveryMan.create');
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

        $var = new Deliveryman();
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
            $file->move('storage/deliveryMans_images/',$filename);
            $var->image = $filename;
        }
        $var->save();

        // return redirect()->route('productlist');   

        return redirect()->route('deliveryMan.list');
    }

    public function deliveryManList(){

        $deliveryMans = Deliveryman::all();
        return view('pages.deliveryMan.list')->with('deliveryMans',$deliveryMans);
    }

    public function deliveryManEdit(Request $request){
        $id = $request->id;
        $deliveryMan = Deliveryman::where('id',$id)->first();

        return view('pages.deliveryMan.edit')->with('deliveryMan', $deliveryMan);

    }

    public function editSubmit(Request $request){
        $var = Deliveryman::where('id',$request->id)->first();
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
            $destination = 'storage/deliveryMans_images/'.$var->image;
            if(File::exists($destination))
            {
                File::delete($destination);
            }
            $file = $request->file('image');
            $extension = $file->getClientOriginalExtension();
            $filename = time().'.'.$extension;
            $file->move('storage/deliveryMans_images/',$filename);
            $var->image = $filename;
        }
        
        $var->save();
        return redirect()->route('deliveryMan.list');


    }

    public function delete(Request $request){
        $var = Deliveryman::where('id',$request->id)->first();
        $destination = 'storage/deliveryMans_images/'.$var->image;
        if(File::exists($destination))
        {
            File::delete($destination);
        }
        $var->delete();
        return redirect()->route('deliveryMan.list');
    }
}
