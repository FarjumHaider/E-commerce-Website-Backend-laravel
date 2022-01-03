@extends('layouts.app')
@section('content')
    <form action="{{route('employee.edit')}}" class="col-md-6" method="post" enctype="multipart/form-data">
        <!-- Cross Site Request Forgery-->
        {{csrf_field()}}
        <input type="hidden" name="id" value="{{$employee->id}}">
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
                <span>Password</span>
                <input type="password" name="password" value="{{$employee->password}}"class="form-control">
                @error('password')
                    <span class="text-danger">{{$message}}</span>
                @enderror
            </div>

            <div class="col-md-4 form-group">
                <span>Email</span>
                <input type="text" name="email" value="{{$employee->email}}"class="form-control">
                @error('email')
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
                <span>Date of Birth</span>
                <input type="date" name="dob" value="{{$employee->dob}}" class="form-control">
                @error('dob')
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
                <span>Gender</span><br>
                <label for="valMale"> Male </label>
                <input type="radio" id="valMale" name="gender" value="Male" {{ $employee->gender == 'Male' ? 'checked' : ''}}>
                
                <label for="valFemale">Female</label>
                <input type="radio" id="valFemale" name="gender" value="Female" {{ $employee->gender == 'Female' ? 'checked' : ''}}><br>
                
      
                @error('gender')
                    <span class="text-danger">{{$message}}</span>
                @enderror
            </div>

            
            <div class="col-md-4 form-group">
                <span>Joining Date</span>
                <input type="date" name="joiningDate" value="{{$employee->joining_date}}" class="form-control">
                @error('joiningDate')
                <span class="text-danger">{{$message}}</span>
                @enderror
            </div>

            <div class="col-md-4 form-group">
                <span>Address</span>
                <input type="text" name="address" value="{{$employee->address}}" class="form-control">
                @error('address')
                    <span class="text-danger">{{$message}}</span>
                @enderror
            </div>

            <div class="col-md-4 form-group">
                
                <img src="{{ asset('storage/employee_images/'.$employee->image) }}" width="80px" height="90px" alt="">
                <span>Upload image</span>
                <input type="file" name="image" class="form-control">
                @error('image')
                    <span class="text-danger">{{$message}}</span>
                @enderror
            </div>

            <input type="submit" class="btn btn-success" value="Edit" >
    </form>
@endsection