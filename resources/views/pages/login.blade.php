@extends('layouts.app')
@section('content')

	

	{{@csrf_field()}}
	<section class="ftco-section">
		<div class="container">
			<div class="row justify-content-center">
				<div class="col-md-6 text-center mb-5">
				</div>
			</div>
			<div class="row justify-content-center">
				<div class="col-md-6 col-lg-5">
					<div class="login-wrap p-4 p-md-5">
		      	<div class="icon d-flex align-items-center justify-content-center">
		      		<span class="fa fa-user-o"></span>
		      	</div>
		      	<h3 class="text-center mb-4">Have an account?</h3>

				<form action="{{route('login')}}" method="post" class="login-form">
					{{@csrf_field()}}
				<div class="form-group">
					<input type="text" class="form-control rounded-left" name="uname" placeholder="Username">
					@error('uname')
						<span class="text-danger">{{$message}}</span>
					@enderror
		      	</div>
	            <div class="form-group d-flex">
	              <input type="password" class="form-control rounded-left" name="password" placeholder="Password">
				  
	            </div>
				<div>
				  @error('password')
                    <span class="text-danger">{{$message}}</span>
                  @enderror
				</div>

				<div >
					@if(session('error'))
						<div class="text-danger">
							{{ session('error') }}
						</div>
					@endif
				</div>
				<div >
					@if(session('account_deactive'))
						<div class="text-danger">
							{{ session('account_deactive') }}
						</div>
					@endif
				</div>
				<div >
					@if(session('account_pending'))
						<div class="text-danger">
							{{ session('account_pending') }}
						</div>
					@endif
				</div>
				

	            <div class="form-group">
	            	<button type="submit" class="btn btn-primary rounded submit p-3 px-5">Login</button>
	            </div>
	          </form>
			  <div>
			  	<a href="/customer/registration">Registration</a>
			  </div>
			  
	        </div>
				</div>
			</div>
		</div>
	</section>
	
	
	<script src="js/jquery.min.js"></script>
  <script src="js/popper.js"></script>
  <script src="js/bootstrap.min.js"></script>
  <script src="js/main.js"></script>


@endsection