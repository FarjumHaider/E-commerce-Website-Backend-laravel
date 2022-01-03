<?php

namespace App\Http\Controllers;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Support\Facades\File;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ProductApiController extends Controller
{
    //Product list
    public function ProductApiList(Request $request){

        $products = Product::with('category')->get();
        return $products;

    }


    //Add Product 
    public function ProductAPICreate(Request $request){

        $validator = Validator::make($request->all(),
            [
                'name'=>'required|min:2|max:10',
                'category'=>'required||min:1|not_in:Select a category',
                'price'=>'required|min:0|numeric',
                'quantity'=>'required|numeric',
                'description'=>'required|min:2|max:50',
                'stockDate'=>'required',
                'image'=>'required'

            ],
            [
                'name.required'=>'Product name required',
                'name.min'=>'Name must be greater than 2 charcters',
                'category.required'=>'Product category required',
                'category.not_in'=>'Product category required',
                'price.required'=>'Product price required',
                'price.numeric'=>'Product price should be a number',
                'quantity.required'=>'Product quantity required',
                'quantity.numeric'=>'Product quantity should be a number',
                'description.required'=>'Product description required',
                'stockDate.required'=>'Product stock sate required',
                'image.required'=>'Image required'
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
            $product = new Product();
            $product->name= $request->name;
            $product->c_id = $request->category;
            $product->price = $request->price;
            $product->quantity = $request->quantity;
            $product->description = $request->description;
            $product->stock_date = $request->stockDate;
    
            if($request->hasfile('image'))
            {
                $file = $request->file('image');
                $extension = $file->getClientOriginalExtension();
                $filename = time().'.'.$extension;
                $file->move('storage/product_images/',$filename);
                $product->image = $filename;
            }
            // $product->image = "NULL";
            $product->save();

            return response()->json([
                "status"=>200,
                "message"=>"Product Added Successfully",
            ]);

         }

    }


    //Edit product
    public function ProductApiEdit(Request $request){
        $id = $request->id;
        $product = Product::where('id',$id)->first();
        // $categories = Category::all();

        return $product;

    }

    //Edit Product Submit
    public function ProductApiEditSubmit(Request $request){
        // return $request->pic;
        $product = Product::where('id',$request->id)->first();
        $product->name= $request->name;
        $product->c_id = $request->category;
        $product->price = $request->price;
        $product->quantity = $request->quantity;
        $product->description = $request->description;
        $product->stock_date = $request->stockDate;

        if($request->hasfile('image'))
        {
            $destination = 'storage/product_images/'.$product->image;
            if(File::exists($destination))
            {
                File::delete($destination);
            }
            $file = $request->file('image');
            $extension = $file->getClientOriginalExtension();
            $filename = time().'.'.$extension;
            $file->move('storage/product_images/',$filename);
            $product->image = $filename;
        }
        // $product->image ="Null";
        $product->save();
        return 200;
    }

    //Delete Product
    public function ProductAPIdelete(Request $request){
        $product = Product::where('id',$request->id)->first();
        $destination = 'storage/product_images/'.$product->image;
        if(File::exists($destination))
        {
            File::delete($destination);
        }
        $product->delete();
        return 200;
    }
    

    //Product Details
    public function ProductAPIDetails(Request $request){
        $id = $request->id;
        $name = $request->name;
        $product = Product::where('id',$id)->where('name',$name)->first();
        return $product;
    }

}
