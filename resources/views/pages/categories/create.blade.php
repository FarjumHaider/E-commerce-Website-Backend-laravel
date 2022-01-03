@extends('layouts.app')
@section('content')
    <form action="{{route('category.create')}}" class="col-md-6" method="post" enctype="multipart/form-data">
        <!-- Cross Site Request Forgery-->
        {{csrf_field()}}
        
        <div class="col-md-4 form-group">
                <span>Name</span>
                <input type="text" name="name" value="{{old('name')}}" class="form-control">
                @error('name')
                    <span class="text-danger">{{$message}}</span>
                @enderror
        </div>

        <input type="submit" class="btn btn-success" value="Add" >
    </form>
@endsection