@extends('layouts.frontLayout.front_design')
@section('content')
</form>
	
	<section id="form"><!--form-->
		<div class="container">
			<div class="row">
				@if ($errors->any())
					<div class="alert alert-danger">
						<ul>
							@foreach ($errors->all() as $error)
								<li>{{ $error }}</li>
							@endforeach
						</ul>
					</div>
				@endif
				@if(\Illuminate\Support\Facades\Session::has('message'))
					<div class="alert alert-success">
						{{\Illuminate\Support\Facades\Session::get('message')}}
					</div>
				@endif
				@if(\Illuminate\Support\Facades\Session::has('message_error'))
					<div class="alert alert-danger">
						{{\Illuminate\Support\Facades\Session::get('message_error')}}
					</div>
				@endif
				<div class="col-sm-4 col-sm-offset-1">
					<div class="login-form"><!--login form-->
						<h2><strong>Login to your account</strong></h2>
						<form method="POST" action="{{\Illuminate\Support\Facades\URL::route("login-post")}}">
							@csrf
							<input type="text" name="email" placeholder="email" />
							<input type="password" name="password" placeholder="Password" />
							<span>
								<input type="checkbox" name="remember" class="checkbox">
								Keep me signed in
							</span>
							<button type="submit" class="btn btn-default">Login</button>
						</form>
					</div><!--/login form-->
				</div>
				<div class="col-sm-1">
					<h2 class="or">OR</h2>
				</div>
				<div class="col-sm-4">
					<div class="signup-form"><!--sign up form-->
						<h2><strong>New User Signup!</strong></h2>
						<form method="POST" action="{{\Illuminate\Support\Facades\URL::route("signup-post")}}">
							@csrf
							<input type="radio" name="gender" value="male" id="male"/>male
							<input type="radio" name="gender" id="female" value="female"/>Female
							<input type="text" placeholder="Name" name="name"/>
							<input type="email" placeholder="Email Address" name="email"/>
							<input type="password" placeholder="Password" name="password"/>
							<input type="password" placeholder="Confirm Password" name="confirm_password"/><br>
							<button type="submit" class="btn btn-default">Signup</button>
						</form>
					</div><!--/sign up form-->
				</div>
			</div>
		</div>
	</section><!--/form-->
	
	
	@endsection