@extends('layout')
@section('content')
<form method="POST" action="{{route('login.auth')}}">
    @csrf
    <div class="login-box">
    @if(Session::get('success'))
                <div class="alert alert-success w-80">
                    {{ Session::get('success')}}
                </div> 
                @endif

                @if(Session::get('fail'))
                <div class="alert alert-danger w-80">
                    {{ Session::get('fail')}}
                </div> 
                @endif
                
                @if(Session::get('notAllowed'))
                <div class="alert alert-danger w-80">
                    {{ Session::get('notAllowed')}}
                </div> 
                @endif

        <h1>Login</h1>
        
       
        <div class="textbox">
            <i class="fas fa-user"></i>
            <input type="text" placeholder="Username" name="username">
        </div>
        <div class="textbox">
            <i class="fas fa-lock"></i>
            <input type="password" placeholder="Password" name="password">
        </div>
        <button type="submit" class="btn btn-dark float-right" value="Sign In">Log In</button>
        <div class="account">
           <a href="/register"> tidak punya akun?</a>
        </div>
    </div>
</form>
@endsection


        

