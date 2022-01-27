@extends('project.master')
@section('content')
<style>
    .jumbotron{
        margin:0px 250px 0px 250px;
    }
</style>

    <h1 class="text-center">Login Panel </h1>
             <section class="jumbotron">
             <form method="post" action="/home/postlogin">
             @csrf()
                 @if(Session::has('errMsg'))
                   <div class="alert alert-danger">{{Session::get('errMsg')}}</div>
                 @endif
                 <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" name="email" class="form-control" id="email" aria-describedby="emailHelp" placeholder="Enter email">
                </div>
                @if($errors->has('email'))
                <label class="alert alert-danger">{{$errors->first('email')}}</label>
                @endif
                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" name="password" class="form-control" id="password" placeholder="Password">
                </div>
                @if($errors->has('password'))
                <label class="alert alert-danger">{{$errors->first('password')}}</label>
                @endif
                <div class="form-check">
                    <input type="checkbox" class="form-check-input" name="remember" id="exampleCheck1">
                    <label class="form-check-label" for="exampleCheck1">Remember Me</label>
                </div>
                <br>
                <button type="submit" class="btn btn-success btn-lg btn-block" name="login">LOGIN</button>
                    <br>
                <a href="/home/register" class="btn btn-primary"> New User </a>
            </form>
        </section>
        @endsection