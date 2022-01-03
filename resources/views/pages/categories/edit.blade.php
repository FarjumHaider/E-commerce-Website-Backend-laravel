@extends('layouts.app')
@section('content')
    <form action="{{route('category.edit')}}" class="col-md-6" method="post" enctype="multipart/form-data">
        <!-- Cross Site Request Forgery-->
        {{csrf_field()}}
        <input type="hidden" name="id" value="{{$category->id}}">
        <div class="col-md-4 form-group">
                <span>Name</span>
                <input type="text" name="name" value="{{$category->name}}" class="form-control">
                @error('name')
                    <span class="text-danger">{{$message}}</span>
                @enderror
        </div>

        <input type="submit" class="btn btn-success" value="Edit" >
    </form>
@endsection