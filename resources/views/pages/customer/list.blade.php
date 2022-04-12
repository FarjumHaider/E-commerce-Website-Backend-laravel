
@extends('layouts.app')
@section('content')

    <div class="col-md-9 form-group" >
        <input type="text" name="search" id="search" class="form-control" placeholder="Search.." />
    </div>

    <div id="Content"></div>
    <table class="table table-borded">
        <tr>
            <th>Image</th>
            <th>Name</th>
            <th>Username</th>
            <th>Email</th>
            <th>Phone</th>
            <th>Address</th>
            <th>Status</th>
            <th></th>
        </tr>
        @foreach($customers as $customer)
            <tr>
                <td>
                    <img src="{{ asset('storage/customer_images/'.$customer->image) }}" width="80px" height="90px" alt="">
                </td>
                <td>{{$customer->f_name ." ".$customer->l_name}}</td>
                <td>{{$customer->uname}}</td>
                <td>{{$customer->email}}</td>
                <td>{{$customer->phone}}</td>
                <td>{{$customer->address}}</td>
                <td>{{$customer->status}}</td>
            
                <td><a href="/customer/active/{{$customer->id}}">Active</a></td>
                <td><a href="/customer/deactive/{{$customer->id}}">Deactive</a></td>
            </tr>
        @endforeach
    </table>

@endsection

