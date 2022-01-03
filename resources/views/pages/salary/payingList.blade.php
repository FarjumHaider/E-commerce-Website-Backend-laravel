
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
            <th>Salary</th>
            <th>Gender</th>
            <th>Joining Date</th>
            <th>Address</th>
            <th></th>
        </tr>
        @foreach($employees as $employee)
            <tr>
                <td>
                    <img src="{{ asset('storage/employee_images/'.$employee->image) }}" width="80px" height="90px" alt="">
                </td>
                <td>{{$employee->f_name}}</td>
                <td>{{$employee->l_name}}</td>
                <td>{{$employee->email}}</td>
                <td>{{$employee->phone}}</td>
                <td>{{$employee->dob}}</td>
                <td>{{$employee->salary}}</td>
                <td>{{$employee->gender}}</td>
                <td>{{$employee->joining_date}}</td>
                <td>{{$employee->address}}</td>

                <td><a href="/salary/paying/{{$employee->id}}/{{$employee->f_name}}">Pay</a></td>
            
            </tr>
        @endforeach
    </table>

    <script type="text/javascript">
        $("#search").on('keyup',function(){
            
            $value=$(this).val();
            $.ajax({
                    type:'get',
                    url: "{{ route('salaryPayingList.search') }}",
                    data: {'search':$value},
                    success:function(data){
                        console.log(data);
                        $('#Content').html(data);
                    }
            });

        })
    </script>
@endsection

