@extends('layouts.app')
@section('content')
<form action="{{route('product.create')}}" class="col-md-6" method="post" enctype="multipart/form-data">
        <!-- Cross Site Request Forgery-->
        {{csrf_field()}}
        
        <div class="col-md-4 form-group">
            <span>Product Name</span>
            <input type="text" name="name" value="{{old('name')}}" class="form-control">
            @error('name')
                <span class="text-danger">{{$message}}</span>
            @enderror
        </div>

        <div class="col-md-4 form-group">
            <span>Category</span>
            <select name="category" id="category" > 
                <option value="Select a category" disabled selected class="form-control">Select a Category</option>
                @foreach ($categories as $category)
                     <option value="{{ $category->id }}" class="form-control">{{ $category->name }}</option>
                @endforeach 
            </select><br>

            @error('category')
                <span class="text-danger">{{$message}}</span>
            @enderror
        </div>

        <div class="col-md-4 form-group">
            <span>Price</span>
            <input type="text" name="price" value="{{old('price')}}" class="form-control">
            @error('price')
                <span class="text-danger">{{$message}}</span>
            @enderror
        </div>
        <div class="col-md-4 form-group">
            <span>Quantity</span>
            <input name="quantity" type=text value="{{old('quantity')}}" class="form-control">
            @error('quantity')
                <span class="text-danger">{{$message}}</span>
            @enderror
        </div>

        <div class="col-md-4 form-group">
            <span>Description</span>
            <input type="text" name="description" value="{{old('description')}}" class="form-control">
            @error('description')
                <span class="text-danger">{{$message}}</span>
            @enderror
        </div>

        <div class="col-md-4 form-group">
            <span>Product stock date</span>
            <input type="date" name="stockDate" value="{{old('stockDate')}}" class="form-control">
            @error('stockDate')
                <span class="text-danger">{{$message}}</span>
            @enderror
        </div>

        <div class="col-md-4 form-group">
                <span>Upload image</span>
                <input type="file" name="image" value="{{old('image')}}" class="form-control">
                @error('image')
                    <span class="text-danger">{{$message}}</span>
                @enderror
        </div><br>
        <input type="submit" class="btn btn-success" value="Add" >
    </form>



@endsection

