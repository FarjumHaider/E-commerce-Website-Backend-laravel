
@extends('layouts.app')
@section('content')
    <div class="col-md-9 form-group" >
        <input type="text" name="search" id="search" class="form-control" placeholder="Search.." />
    </div>

    <div id="Content"></div>

    
    <table class="table table-borded">
        <tr>
            <th>Customer name</th>
            <th>Phone</th>
            <th>Email</th>
            <th>Address</th>
            <th>Total price</th>
            <th>Status</th>
            <th></th>
        </tr>
        @foreach($orders as $order)
            @if($order->status == "Pending")
                <tr>
                    <td>{{$order->customer->f_name ." ". $order->customer->l_name}}</td>
                    <td>{{$order->customer->phone}}</td>
                    <td>{{$order->customer->email}}</td>
                    <td>{{$order->customer->address}}</td>
                    <td>{{$order->total_price}}</td>
                    <td>{{$order->status}}</td>
                    <td><a href="/order/confirm/{{$order->id}}">Confirm</a></td>
                    <td><a href="/order/delete/{{$order->id}}">Delete</a></td>
                </tr>
            @else
            @endif
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

