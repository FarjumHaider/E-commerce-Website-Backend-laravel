
@extends('layouts.app')
@section('content')

    <div class="col-md-9 form-group" >
        <input type="text" name="search" id="search" class="form-control" placeholder="Search.." />
    </div>

    <div id="Content"></div>
    <table class="table table-borded">
        <tr>
            <th>First name</th>
            <th>Last name</th>
            <th>username</th>
            <th>Phone</th>
            <th>Salary</th>
            <th>Paid</th>
            <th>Due</th>
            <th>Payment Date</th>
            <th></th>
        </tr>
        @foreach($salaries as $salary)
            <tr>
                <td>{{$salary->f_name}}</td>
                <td>{{$salary->l_name}}</td>
                <td>{{$salary->uname}}</td>
                <td>{{$salary->phone}}</td>
                <td>{{$salary->salary}}</td>
                <td>{{$salary->paid}}</td>
                <td>{{$salary->due}}</td>
                <td>{{$salary->payment_date}}</td>

                @if( $salary->due == 0 )
                     <td class="text-success" >Already paid</td>
                @else
                     <td><a href="/salary/paying/due/{{$salary->id}}/{{$salary->f_name}}">Pay due</a></td>
                @endif
            
            </tr>
        @endforeach
    </table>


@endsection

