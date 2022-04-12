@extends('layouts.app')
@section('content')
    <h1>Product page<h1>
    
<div class="container">
  <div class="row justify-content-start">
  
        @foreach ($products as $product)

        <div class="col-2 card" >
                <img class="card-img-top" width="30px" height="170px" src="{{ asset('storage/product_images/'.$product->image) }}" alt="Card image cap">
                <div class="card-body">
                    <p class="card-text text-center"style="font-size: 20px;">{{$product->name}}<br>
                    <span>Price: BDT{{$product->price}}</span><br>
                    <a href="/addtocart/{{$product->id}}" class="btn btn-primary" style="color:white">Add to Cart</a></p>
                </div>
        </div>

        @endforeach
       
    </div>  
</div >
@endsection