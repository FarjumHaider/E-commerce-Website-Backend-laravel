
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
        @foreach($deliveryMans as $deliveryMan)
            <tr>
                <td>
                    <img src="{{ asset('storage/deliveryMans_images/'.$deliveryMan->image) }}" width="80px" height="90px" alt="">
                </td>
                <td>{{$deliveryMan->f_name}}</td>
                <td>{{$deliveryMan->l_name}}</td>
                <td>{{$deliveryMan->email}}</td>
                <td>{{$deliveryMan->phone}}</td>
                <td>{{$deliveryMan->dob}}</td>
                <td>{{$deliveryMan->gender}}</td>
                <td>{{$deliveryMan->joining_date}}</td>
                <td>{{$deliveryMan->address}}</td>
                
                <td><a href="/deliveryMan/edit/{{$deliveryMan->id}}/{{$deliveryMan->f_name}}">Edit</a></td>
                <td><a href="/deliveryMan/delete/{{$deliveryMan->id}}/{{$deliveryMan->f_name}}">Delete</a></td>
            </tr>
        @endforeach
    </table>

    <script type="text/javascript">
        $("#search").on('keyup',function(){
            
            $value=$(this).val();
            $.ajax({
                    type:'get',
                    url: "{{ route('deliveryMan.search') }}",
                    data: {'search':$value},
                    success:function(data){
                        console.log(data);
                        $('#Content').html(data);
                    }
            });

        })
    </script>
@endsection

