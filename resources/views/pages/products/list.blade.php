
@extends('layouts.app')
@section('content')
    <div class="col-md-9 form-group" >
        <input type="text" name="search" id="search" class="form-control" placeholder="Search.." />
    </div>

    <div id="Content"></div>

    
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
    <script type="text/javascript">
        $("#search").on('keyup',function(){
            
            $value=$(this).val();
            $.ajax({
                    type:'get',
                    url: "{{ route('product.search') }}",
                    data: {'search':$value},
                    success:function(data){
                        console.log(data);
                        $('#Content').html(data);
                    }
            });

        })
    </script>

@endsection

