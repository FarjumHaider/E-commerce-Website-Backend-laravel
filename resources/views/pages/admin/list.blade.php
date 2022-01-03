
@extends('layouts.app')
@section('content')

    <div class="col-md-9 form-group" >
        <input type="text" name="search" id="search" class="form-control" placeholder="Search.." />
    </div>

    <div id="Content"></div>
    <table class="table table-borded">
        <tr>
            <th>Image</th>
            <th>First name</th>
            <th>Last name</th>
            <th>Email</th>
            <th>Phone</th>
            <th>Date of Birth</th>
            <th>Gender</th>
            <th>Joining Date</th>
            <th>Address</th>
            <th></th>
        </tr>
        @foreach($admins as $admin)
            <tr>
                <td>
                    <img src="{{ asset('storage/admin_images/'.$admin->image) }}" width="80px" height="90px" alt="">
                </td>
                <td>{{$admin->f_name}}</td>
                <td>{{$admin->l_name}}</td>
                <td>{{$admin->email}}</td>
                <td>{{$admin->phone}}</td>
                <td>{{$admin->dob}}</td>
                <td>{{$admin->gender}}</td>
                <td>{{$admin->joining_date}}</td>
                <td>{{$admin->address}}</td>
                
                <td><a href="/admin/edit/{{$admin->id}}/{{$admin->f_name}}">Edit</a></td>
                <td><a href="/admin/delete/{{$admin->id}}/{{$admin->f_name}}">Delete</a></td>
            </tr>
        @endforeach
    </table>

    <script type="text/javascript">
        $("#search").on('keyup',function(){
            
            $value=$(this).val();
            $.ajax({
                    type:'get',
                    url: "{{ route('admin.search') }}",
                    data: {'search':$value},
                    success:function(data){
                        console.log(data);
                        $('#Content').html(data);
                    }
            });

        })
    </script>
@endsection

