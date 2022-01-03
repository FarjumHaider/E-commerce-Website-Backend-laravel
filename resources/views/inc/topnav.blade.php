<div class="position-relative">

  <h4 class="position-absolute top-0 start-10 translate-middle-x text-primary">Welcome {{Session::get('user')}}</h4>
  <div class="position-absolute top-0 end-0"><a class="btn btn-success" href="{{route('logout')}}"> Logout </a></div>

</div>


<br><br>
<div>
    <a class="btn btn-primary" href="{{route('admin.home')}}"> Home </a>
    <a class="btn btn-primary" href="{{route('admin.create')}}"> Create Admin </a>
    <a class="btn btn-primary" href="{{route('admin.list')}}"> Admin List </a>
    <a class="btn btn-primary" href="{{route('employee.create')}}"> Create Employee </a>
    <a class="btn btn-primary" href="{{route('employee.list')}}"> Employee List </a>
    <a class="btn btn-primary" href="{{route('category.create')}}"> Add Category </a>
    <a class="btn btn-primary" href="{{route('category.list')}}"> Category List </a>
    <a class="btn btn-primary" href="{{route('product.create')}}"> Add Product </a>
    <a class="btn btn-primary" href="{{route('product.list')}}"> Product List </a>
    <a class="btn btn-primary" href="{{route('salary.payingList')}}"> Payment </a>
    <a class="btn btn-primary" href="{{route('salary.payedList')}}"> Payed list </a>
    <a class="btn btn-primary" href="{{route('product.report')}}"> Generate product report </a>
</div>
<br>


 


