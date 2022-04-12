@extends('layouts.app')
@section('content')
    <table class="table table-bordered">
        <tr>
            <th>S.No</th>
            <th>Price</th>
            <th>Status</th>
            <th>Payment type</th>
        </tr>
        @php
            $i=1;
        @endphp
        
        @foreach($orders as $item)
            <tr>
                <td>{{$i}}</td>
                <td>{{$item->total_price}}</td>
                <td>{{$item->status}}</td>
                <td>{{$item->payment_type}}</td>
                <td><a href="/customer/myorders/details/{{$item->id}}" class="btn btn-info">Details</a></td>
            </tr>
            @php
                $i++;
            @endphp    
        @endforeach
    </table>
@endsection