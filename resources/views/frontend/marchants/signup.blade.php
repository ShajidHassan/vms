<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Admin Sign Up</title>

    <!-- Font Icon -->
    <link rel="stylesheet" href="{{ asset('fonts/material-icon/css/material-design-iconic-font.min.css') }}">

    <!-- Main css -->
    <link rel="stylesheet" href="{{ asset('registration/css/style.css') }}">
</head>
<body>

    <div class="main">

    	<!-- Sign up form -->
        <section class="signup">
            <div class="container">
                <div class="signup-content">
                    <div class="signup-form">
                        @if ($errors->any())
                            <div style="color:red;" class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                        @if(\Illuminate\Support\Facades\Session::has('message'))
                            <div style="color: green;" class="alert alert-success">
                                {{\Illuminate\Support\Facades\Session::get('message')}}
                            </div>
                        @endif
                        @if(\Illuminate\Support\Facades\Session::has('message_error'))
                            <div style="color: red;" class="alert alert-danger">
                                {{\Illuminate\Support\Facades\Session::get('message_error')}}
                            </div>
                        @endif
                        <h2 class="form-title">Sign up</h2>
                        <form method="POST" class="register-form" id="register-form" action="{{\Illuminate\Support\Facades\URL::route("admin.signup-post")}}">
                        	{{ csrf_field() }}
                            <div class="form-group">
                                <label for="name"><i class="zmdi zmdi-account material-icons-name"></i></label>
                                <input required type="text" name="name" id="name" placeholder="Your Showroom Name"/>
                            </div>
                            <div class="form-group">
                                <label for="email"><i class="zmdi zmdi-email"></i></label>
                                <input required type="email" name="email" id="email" placeholder="Email"/>
                            </div>
                            <div class="form-group">
                                <label for="pass"><i class="zmdi zmdi-lock"></i></label>
                                <input required minlength="6" type="password" name="password" id="password" placeholder="Password"/>
                            </div>
                            <div class="form-group">
                                <label for="re-pass"><i class="zmdi zmdi-lock-outline"></i></label>
                                <input required minlength="6" type="password" name="confirm_password" id="re_pass" placeholder="Repeat your password"/>
                            </div>
                            <div class="form-group">
                                <input type="radio" name="gender" value="male" id="male"/>male
                                <input type="radio" name="gender" id="female" value="female"/>Female
                            </div>
                            <!--<div class="form-group">
                                <label for="contact"><i class="zmdi zmdi-phone-msg"></i></label>
                                <input type="number" name="contact" id="name" placeholder="Contact"/>
                            </div>
                            <div class="form-group">
                                <label for="address"><i class="zmdi zmdi-google-maps"></i></label>
                                <input type="text" name="address" id="address" placeholder="Address"/>
                            </div>-->

                            <div class="form-group">
                                <input type="checkbox" name="agree-term" id="agree-term" class="agree-term" />
                                <label for="agree-term" class="label-agree-term"><span><span></span></span>I agree all statements in  <a href="#" class="term-service">Terms of service</a></label>
                            </div>
                            <div class="form-group form-button">
                                <input type="submit" name="signup" id="signup" class="form-submit" value="Register"/>
                            </div>

                            <p class = "alert alert-info alert-block"style="font-size: 20px; color: white; background: #FF0000;">
  </p>
                        </form>
                    </div>
                    <div class="signup-image">
                        <figure><img src="{{ asset('img/signup-image.jpg') }}" alt="sing up image"></figure>
                        <a href="{{\Illuminate\Support\Facades\URL::route("marchant.signin")}}" class="signup-image-link">I am already member</a>
                    </div>
                </div>
            </div>
        </section>
<!-- JS -->
    <script src="{{ asset('registration/vendor/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('registration/js/main.js') }}"></script>
</body><!-- This templates was made by Colorlib (https://colorlib.com) -->
</html>