@extends('layouts.app')
@section('content')
<form action="{{route('product.edit')}}" class="col-md-6" method="post" enctype="multipart/form-data">
        <!-- Cross Site Request Forgery-->
        {{csrf_field()}}
        <input type="hidden" name="id" value="{{$product->id}}">
        <div class="col-md-4 form-group">
            <span>Product Name</span>
            <input type="text" name="name" value="{{$product->name}}" class="form-control">
            @error('name')
                <span class="text-danger">{{$message}}</span>
            @enderror
        </div>

        <div class="col-md-4 form-group">
            <span>Category</span>
            <select name="category" id="category" > 
                <option value="Select a category" disabled selected class="form-control">Select a Category</option>
                @foreach ($categories as $category)
                    @if( $product->c_id == $category->id)
                        <option selected value="{{ $category->id }}" class="form-control">{{ $category->name }}</option>
                    @else
                        <option value="{{ $category->id }}" class="form-control">{{ $category->name }}</option>
                    @endif
                @endforeach 
            </select><br>
            @error('category')
                <span class="text-danger">{{$message}}</span>
            @enderror
        </div>

        <div class="col-md-4 form-group">
            <span>Price</span>
            <input type="text" name="price" value="{{$product->price}}" class="form-control">
            @error('price')
                <span class="text-danger">{{$message}}</span>
            @enderror
        </div>
        <div class="col-md-4 form-group">
            <span>Quantity</span>
            <input name="quantity" type=text value="{{$product->quantity}}" class="form-control">
            @error('quantity')
                <span class="text-danger">{{$message}}</span>
            @enderror
        </div>

        <div class="col-md-4 form-group">
            <span>Description</span>
            <input type="text" name="description" value="{{$product->description}}" class="form-control">
            @error('description')
                <span class="text-danger">{{$message}}</span>
            @enderror
        </div>

        <div class="col-md-4 form-group">
            <span>Product stock date</span>
            <input type="date" name="stockDate" value="{{$product->stock_date}}" class="form-control">
            @error('stockDate')
                <span class="text-danger">{{$message}}</span>
            @enderror
        </div>

        <div class="col-md-4 form-group">  
                <img src="{{ asset('storage/product_images/'.$product->image) }}" width="80px" height="90px" alt="">
                <span>Upload image</span>
                <input type="file" name="image" class="form-control">
                @error('image')
                    <span class="text-danger">{{$message}}</span>
                @enderror
        </div><br>
        <input type="submit" class="btn btn-success" value="Add" >
    </form>



@endsection

