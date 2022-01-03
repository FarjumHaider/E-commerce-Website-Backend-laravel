
@extends('layouts.app')
@section('content')
    <div class="col-md-9 form-group" >
        <input type="text" name="search" id="search" class="form-control" placeholder="Search.." />
    </div>

    <div id="Content"></div>
    <table class="table table-borded">
        <tr>
            <th>Name</th>
            <th></th>
        </tr>
        @foreach($categories as $category)
            <tr>
                <td>{{$category->name}}</td>
                
                <td><a href="/category/edit/{{$category->id}}/{{$category->name}}">Edit</a></td>
                <td><a href="/category/delete/{{$category->id}}/{{$category->name}}">Delete</a></td>
            </tr>
        @endforeach
    </table>

    <script type="text/javascript">
        $("#search").on('keyup',function(){
            
            $value=$(this).val();
            $.ajax({
                    type:'get',
                    url: "{{ route('category.search') }}",
                    data: {'search':$value},
                    success:function(data){
                        console.log(data);
                        $('#Content').html(data);
                    }
            });

        })
    </script>
@endsection

