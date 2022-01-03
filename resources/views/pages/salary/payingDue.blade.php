@extends('layouts.app')
@section('content')
    <form action="{{route('salary.payingDue')}}" class="col-md-6" method="post" enctype="multipart/form-data">
        <!-- Cross Site Request Forgery-->
        {{csrf_field()}}
        <input type="hidden" name="id" value="{{$salary->id}}">

        <div class="col-md-4 form-group">
                <span>Payment date</span>
                <input type="date" name="payDate" value="" class="form-control">
                @error('payDate')
                <span class="text-danger">{{$message}}</span>
                @enderror
        </div>

        <div class="col-md-4 form-group">
                <span>First name</span>
                <input type="text" name="fname" value="{{$salary->f_name}}" class="form-control">
                @error('fname')
                    <span class="text-danger">{{$message}}</span>
                @enderror
        </div>

            <div class="col-md-4 form-group">
                <span>Last name</span>
                <input type="text" name="lname" value="{{$salary->l_name}}" class="form-control">
                @error('lname')
                    <span class="text-danger">{{$message}}</span>
                @enderror
            </div>

        <div class="col-md-4 form-group">
            <span>Username</span>
            <input type="text" name="username" value="{{$salary->uname}}"class="form-control">
            @error('username')
                <span class="text-danger">{{$message}}</span>
            @enderror
        </div>

        <div class="col-md-4 form-group">
            <span>Phone</span>
            <input type="text" name="phone" value="{{$salary->phone}}"class="form-control">
            @error('phone')
                <span class="text-danger">{{$message}}</span>
            @enderror
        </div>



        <div class="col-md-4 form-group">
            <span>Salary</span>
            <input type="text" name="salary" value="{{$salary->salary}}" class="form-control">
            @error('salary')
            <span class="text-danger">{{$message}}</span>
            @enderror
        </div>

        <div class="col-md-4 form-group">
            <span>Paid amount</span>
            <input type="text" name="previousPaid" value="{{$salary->paid}}" class="form-control">
            @error('previousPaid')
            <span class="text-danger">{{$message}}</span>
            @enderror
        </div>

        <div class="col-md-4 form-group">
            <span>Due</span>
            <input type="text" name="due" value="{{$salary->due}}" class="form-control">
            @error('due')
            <span class="text-danger">{{$message}}</span>
            @enderror
        </div>
        
        <div class="col-md-4 form-group">
            <span>Enter amount</span>
            <input type="text" name="currentPaid" value="" class="form-control">
            @error('currentPaid')
                <span class="text-danger">{{$message}}</span>
            @enderror
        </div>

       
        <input type="submit" class="btn btn-success" value="Paid" >
    </form>
@endsection