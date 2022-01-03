<?php

namespace App\Http\Controllers;
use App\Models\Category;
use Illuminate\Support\Facades\File;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CategoryApiController extends Controller
{
    //Category list
    public function CategoryApiList(){
        return Category::all();
    }

    //Category delete
    public function CategoryAPIdelete(Request $request){

        $id = $request->id;
        $category = Category::where('id',$id)->first();
        $category->delete();
        return "Deleted";

    }


    //Add Category
    public function CategoryAPICreate(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|min:2|max:255'
        ],
        [
            'name.required'=>'Name required',
            'name.min'=>'The name should be minimum of 2 characters',
            'name.max'=>'Name should be less than 50 charcters',

        ]
    );
        
        if ($validator->fails()) {
             return response()->json([
                 'status'=>422,
                 'errors'=>$validator->messages()
             ]);
        } 
        else {
            $category = new Category();
            $category->name= $request->name;
            $category->save();
            return response()->json([
            "status"=>200,
            "message"=>"Category Added Successfully",
        ]);
        }
        


    }


    //Edit Category
    public function CategoryApiEdit(Request $request){
        $id = $request->id;
        $name = $request->name;
        $category = Category::where('id',$id)->where('name',$name)->first();

        return $category;

    }


    //Edit Category Submit
    public function CategoryApiEditSubmit(Request $request){
        // return $request->id;
        $category = Category::where('id',$request->id)->first();
        $category->name= $request->name;
        $category->save();
        return 200;


    }
    
}
