@extends('layouts.app')
@section('content')
<h1>Order Details</h1>
    <h4>Order Id: {{$order->id}}</h4>
    <h4>Order By: {{$order->customer->f_name ." ".$order->customer->l_name}}</h4>
    <h4>Phone: {{$order->customer->phone}}</h4>
    <h4>Address: {{$order->customer->address}}</h4>

    <table class="table table-bordered">
        <tr>
            <td>Product name</td>
            <td>Unit Price</td>
            <td>Quantity</td>
            <td>Total Price</td>
            
        </tr>
        @php
            $total_qty = 0;
        @endphp
        @foreach($order->orderdetail as $od)
            <tr>
                <td>{{$od->p_name}}</td>
                <td>{{$od->unit_price}}</td>
                <td>{{$od->quantity}}</td>
                <td>{{$od->unit_price * $od->quantity}}</td>
            </tr>
            @php
                $total_qty = $total_qty + $od->quantity;
            @endphp
        @endforeach
        <tr>
                <td></td>
                <td></td>
                <td>Total Quantity:  {{$total_qty}}</td>
                <td>Grand Total:  {{$order->total_price}}</td>

        </tr>
    </table>
@endsection
<!-- 
select p.name, p.image, od.unit_price, od.qty,c.name,c.phone,o.id
from orderdetails od 
left join products p on p.id = od.product_id 
left join orders o on o.id = od.o_id 
left join customers c on c.phone = o.customer_id 
where o.id = 1;
-->