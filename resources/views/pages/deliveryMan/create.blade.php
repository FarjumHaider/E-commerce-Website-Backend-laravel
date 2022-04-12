@extends('layouts.app')
@section('content')
    <form action="{{route('deliveryMan.create')}}" class="col-md-6" method="post" enctype="multipart/form-data">
        <!-- Cross Site Request Forgery-->
        {{csrf_field()}}
        
        <div class="col-md-4 form-group">
                <span>First name</span>
                <input type="text" name="fname" value="{{old('fname')}}" class="form-control">
                @error('fname')
                    <span class="text-danger">{{$message}}</span>
                @enderror
            </div>

            <div class="col-md-4 form-group">
                <span>Last name</span>
                <input type="text" name="lname" value="{{old('lname')}}" class="form-control">
                @error('lname')
                    <span class="text-danger">{{$message}}</span>
                @enderror
            </div>

            <div class="col-md-4 form-group">
                <span>Username</span>
                <input type="text" name="username" value="{{old('username')}}"class="form-control">
                @error('username')
                    <span class="text-danger">{{$message}}</span>
                @enderror
            </div>
            <div class="col-md-4 form-group">
                <span>Password</span>
                <input type="password" name="password" value="{{old('password')}}"class="form-control">
                @error('password')
                    <span class="text-danger">{{$message}}</span>
                @enderror
            </div>
            <div class="col-md-4 form-group">
                <span>Confirm Password</span>
                <input type="password" name="conpassword" value="{{old('conpassword')}}" class="form-control">
                @error('conpassword')
                <span class="text-danger">{{$message}}</span>
                @enderror
            </div>

            <div class="col-md-4 form-group">
                <span>Email</span>
                <input type="text" name="email" value="{{old('email')}}"class="form-control">
                @error('email')
                    <span class="text-danger">{{$message}}</span>
                @enderror
            </div>
            <div class="col-md-4 form-group">
                <span>Phone</span>
                <input type="text" name="phone" value="{{old('phone')}}"class="form-control">
                @error('phone')
                    <span class="text-danger">{{$message}}</span>
                @enderror
            </div>

            <div class="col-md-4 form-group">
                <span>Date of Birth</span>
                <input type="date" name="dob" value="{{old('dob')}}" class="form-control">
                @error('dob')
                <span class="text-danger">{{$message}}</span>
                @enderror
            </div>

            <div class="col-md-4 form-group">
                <span>Gender</span><br>
                <label for="valMale"> Male </label>
                <input type="radio" id="valMale" name="gender" value="Male" {{ old('gender') == 'Male' ? 'checked' : ''}}>
                
                <label for="valFemale">Female</label>
                <input type="radio" id="valFemale" name="gender" value="Female" {{ old('gender') == 'Female' ? 'checked' : ''}}><br>
                
      
                @error('gender')
                    <span class="text-danger">{{$message}}</span>
                @enderror
            </div>

            
            <div class="col-md-4 form-group">
                <span>Joining Date</span>
                <input type="date" name="joiningDate" value="{{old('joiningDate')}}" class="form-control">
                @error('joiningDate')
                <span class="text-danger">{{$message}}</span>
                @enderror
            </div>

            <div class="col-md-4 form-group">
                <span>Address</span>
                <input type="text" name="address" value="{{old('address')}}" class="form-control">
                @error('address')
                    <span class="text-danger">{{$message}}</span>
                @enderror
            </div>

            <div class="col-md-4 form-group">
                <span>Upload image</span>
                <input type="file" name="image" value="{{old('address')}}" class="form-control">
                @error('image')
                    <span class="text-danger">{{$message}}</span>
                @enderror
            </div>

            <input type="submit" class="btn btn-success" value="Add" >
    </form>
@endsection