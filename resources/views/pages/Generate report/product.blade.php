@extends('layouts.app')
@section('content')
<form action="" class="col-md-6" method="post" enctype="multipart/form-data">
        <!-- Cross Site Request Forgery-->
        {{csrf_field()}}
        

        <div class="col-md-4 form-group">
            <span>From date</span>
            <input type="date" name="fromDate" placeholder="To date" value="{{old('stockDate')}}" class="form-control">
            @error('stockDate')
                <span class="text-danger">{{$message}}</span>
            @enderror
        </div>

        <div class="col-md-4 form-group">
            <span>To date</span>
            <input type="date" name="toDate" placeholder="To date" value="{{old('stockDate')}}" class="form-control">
            @error('stockDate')
                <span class="text-danger">{{$message}}</span>
            @enderror
        </div>


        <input type="submit" class="btn btn-success" value="Search" >
    </form>

    <table class="table table-borded">
        <tr>
            <th>Image</th>
            <th>Product Name</th>
            <th>Category</th>
            <th>Price</th>
            <th>Quantity</th>
            <th>Description</th>
            <th>stock date</th>
            <th></th>
        </tr>
        @foreach($products as $product)
            <tr>
                <td>
                    <img src="{{ asset('storage/product_images/'.$product->image) }}" width="80px" height="90px" alt="">
                </td>
                <td>{{$product->name}}</td>
                <td>{{$product->Category->name}}</td>
                <td>{{$product->price}}</td>
                <td>{{$product->quantity}}</td>
                <td>{{$product->description}}</td>
                <td>{{$product->stock_date}}</td>
                
                <td><a href="/product/edit/{{$product->id}}/{{$product->name}}">Edit</a></td>
                <td><a href="/product/delete/{{$product->id}}/{{$product->name}}">Delete</a></td>
            </tr>
        @endforeach
    </table>

@endsection

