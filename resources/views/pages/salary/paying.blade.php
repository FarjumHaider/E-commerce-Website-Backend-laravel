@extends('layouts.app')
@section('content')
    <form action="{{route('salary.paying')}}" class="col-md-6" method="post" enctype="multipart/form-data">
        <!-- Cross Site Request Forgery-->
        {{csrf_field()}}
        <input type="hidden" name="id" value="{{$employee->id}}">

        <div class="col-md-4 form-group">
                <span>Payment date</span>
                <input type="date" name="payDate" value="" class="form-control">
                @error('payDate')
                <span class="text-danger">{{$message}}</span>
                @enderror
        </div>

        <div class="col-md-4 form-group">
                <span>First name</span>
                <input type="text" name="fname" value="{{$employee->f_name}}" class="form-control">
                @error('fname')
                    <span class="text-danger">{{$message}}</span>
                @enderror
        </div>

            <div class="col-md-4 form-group">
                <span>Last name</span>
                <input type="text" name="lname" value="{{$employee->l_name}}" class="form-control">
                @error('lname')
                    <span class="text-danger">{{$message}}</span>
                @enderror
            </div>

        <div class="col-md-4 form-group">
            <span>Username</span>
            <input type="text" name="username" value="{{$employee->uname}}"class="form-control">
            @error('username')
                <span class="text-danger">{{$message}}</span>
            @enderror
        </div>

        <div class="col-md-4 form-group">
            <span>Phone</span>
            <input type="text" name="phone" value="{{$employee->phone}}"class="form-control">
            @error('phone')
                <span class="text-danger">{{$message}}</span>
            @enderror
        </div>



        <div class="col-md-4 form-group">
            <span>Salary</span>
            <input type="text" name="salary" value="{{$employee->salary}}" class="form-control">
            @error('salary')
            <span class="text-danger">{{$message}}</span>
            @enderror
        </div>

        
        <div class="col-md-4 form-group">
            <span>Enter amount</span>
            <input type="text" name="amount" value="" class="form-control">
            @error('amount')
                <span class="text-danger">{{$message}}</span>
            @enderror
        </div>

       
        <input type="submit" class="btn btn-success" value="Paid" >
    </form>
@endsection