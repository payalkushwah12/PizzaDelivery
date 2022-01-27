@extends('project.master')
@section('content')
<style>
    .jumbotron{
        margin:0px 250px 0px 250px;
    }
    .alert{
        font-size:12px;
    }
</style>
<h1 class="text-center mt-3"> Register Here</h1>
    <section class="jumbotron">
        <form method="post" action="{{url('/home/postregister')}}" enctype="multipart/form-data">
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
    <label for="name">Name</label>
    <input type="text" name="name" class="form-control" id="name"  placeholder="Enter name">
  </div>
  @if($errors->has('name'))
    <label class="alert alert-danger">{{$errors->first('name')}}</label>
    @endif
    <div class="form-group">
    <label for="mobile">Mobile No.</label>
    <input type="text" name="mobile" class="form-control" id="mobile"  placeholder="Enter Mobile No.">
  </div>
  @if($errors->has('mobile'))
    <label class="alert alert-danger">{{$errors->first('mobile')}}</label>
    @endif
  <div class="form-group">
    <label for="password">Password</label>
    <input type="password" name="password" class="form-control" id="pass" placeholder="Password">
  </div>
  @if($errors->has('password'))
    <label class="alert alert-danger">{{$errors->first('password')}}</label>
    @endif
    <div class="form-group">
    <label for="address">Address</label>
    <input type="text" name="address" class="form-control" id="address"  placeholder="Enter Address">
  </div>
  @if($errors->has('address'))
    <label class="alert alert-danger">{{$errors->first('address')}}</label>
    @endif
  <br>
  <button type="submit" class="btn btn-primary btn-lg btn-block" name="register">Register</button>
</form>
</section>
@endsection