

@if(session('role')=="Customer")
<div class="position-relative">
  <h4 class="position-absolute top-0 start-10 translate-middle-x text-primary">Welcome {{Session::get('user')}} {{Session('Customer_id')}}</h4>
  <div class="position-absolute top-0 end-0"><a class="btn btn-success" href="{{route('logout')}}"> Logout </a></div>
</div>

<br><br>
<a class="btn btn-primary" href="{{route('customer.home')}}">Home</a>
<a class="btn btn-primary" href="{{route('home.product.list')}}">Products</a>
<a class="btn btn-primary" href="{{route('products.mycart')}}"> Cart </a>
<a class="btn btn-primary" href="{{route('customer.myorders')}}"> My Orders </a>



@elseif(session('role')=="Admin")

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

@elseif(session('role')=="Employee")
<div class="position-relative">
  <h4 class="position-absolute top-0 start-10 translate-middle-x text-primary">Welcome {{Session::get('user')}}</h4>
  <div class="position-absolute top-0 end-0"><a class="btn btn-success" href="{{route('logout')}}"> Logout </a></div>
</div>

<br><br>

<div class="jumbotron jumbotron-fluid btn btn-outline-light text-dark ">
  <div class="container ">
      <a class="btn btn-outline-secondary" href="{{route('employee.home')}}"> Home </a>
      <a class="btn btn-outline-info" href="{{route('deliveryMan.create')}}"> Create DeliveryMan <a>
      <a class="btn btn-outline-info" href="{{route('deliveryMan.list')}}"> DliveryMan List </a>
      <a class="btn btn-outline-info" href="{{route('category.create')}}"> Add Category </a>
      <a class="btn btn-outline-info" href="{{route('category.list')}}"> Category List </a>
      <a class="btn btn-outline-info" href="{{route('product.create')}}"> Add Product </a>
      <a class="btn btn-outline-info" href="{{route('product.list')}}"> Product List </a>
      <a class="btn btn-outline-info" href="{{route('order.list')}}"> Manage Order </a>
      <a class="btn btn-outline-info" href="{{route('order.confirmList')}}"> Order History</a>
      <a class="btn btn-outline-info" href="{{route('customer.list')}}"> Manage Customer </a>
  </div>
</div> 
@else
<a class="btn btn-primary" href="{{route('home')}}">Home</a>
<a class="btn btn-primary" href="{{route('home.product.list')}}">Products</a>
<a class="btn btn-primary" href="{{route('products.mycart')}}"> Cart </a>
<a class="btn btn-primary" href="{{route('login')}}"> Login </a>
@endif


 


