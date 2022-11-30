@extends('layout')
@section('content')


<form method="POST" action="{{route('register.post')}}">
    @csrf
    <div class="login-box ">
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
        <h1>Register</h1>
        <div class="textbox">
            <i class="fa-solid fa-face-laugh-beam"></i>
            <input type="text" placeholder="Name" type="text" name="name">
        </div>
        <div class="textbox">
            <i class="fas fa-envelope"></i>
            <input type="text" placeholder="Email" type="email" name="email">
        </div>
        <div class="textbox">
            <i class="fas fa-user"></i>
            <input type="text" placeholder="Username" type="text" name="username">
        </div>
        <div class="textbox">
            <i class="fas fa-lock"></i>
            <input type="password" placeholder="Password" type="password" name="password">
        </div>
        <button type="submit" class="btn btn-dark float-right" value="Sign In">Sign In</button>
       
        <div class="account">
           <a href="/"> Sudah punya akun?</a>


        </div>
</form>    
@endsection