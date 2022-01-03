<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;

class CategoryController extends Controller
{
    public function createCategory(){
        return view('pages.categories.create');
    }

    public function search(Request $request){

        if($request->search != "")
        {
            $output="";
            $search = $request->search;


            $categories = Category::where('name','LIKE',"%$search%")->get();
    
            if ( count( $categories ) > 0 )
            {
                $output = "<table class='table table-borded'>
                <tr>
                    <th>Name</th>
                    <th></th>
                </tr>";
                foreach($categories as $category)
                {
                    $output.=
                            "<tr> 
                                <td>$category->name</td>
                                <td><a href='/category/edit/$category->id/$category->name'>Edit</a></td>  
                                <td><a href='/category/delete/$category->id/$category->name'>Delete</a></td>   
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


    public function createSubmit(Request $request){
        
        $this->validate(
            $request,
            [
                'name'=>'required|min:2|max:50',               

            ],
            [
                'name.required'=>'Name required',
                'name.min'=>'The name should be minimum of 2 characters',
                'name.max'=>'Name should be less than 50 charcters',

            ]
        );

        $var = new Category();
        $var->name= $request->name;
        $var->save();
        return redirect()->route('category.list');
    }

    public function categoryList(){

        $categories = Category::all();
        return view('pages.categories.list')->with('categories',$categories);
    }

    public function categoryEdit(Request $request){
        $id = $request->id;
        $category = Category::where('id',$id)->first();

        return view('pages.categories.edit')->with('category', $category);

    }

    public function editSubmit(Request $request){
        $var = Category::where('id',$request->id)->first();
        $var->name= $request->name;
        $var->save();
        return redirect()->route('category.list');


    }

    public function delete(Request $request){
        $var = Category::where('id',$request->id)->first();
        $var->delete();
        return redirect()->route('category.list');
    }
}
