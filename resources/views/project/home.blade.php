@extends('project.master')
@section('content')
<div class="jumbotron">
    <h1 class="text-info text-center" style="font-size:65px;">Pizza Delivery</h1>
    <div style="padding:10px 100px 0px 100px;">
        <p style="font-size:19px;">Welcome to pizza delivery service. This is the place when you may
         choose the most delicious pizza you like from wide variety of options!</p><br>
    <hr><br>
    <p  style="font-size:19px;">We're performing delivery free of charge in case if your order is higher than Rs.250</p><br>
    <a href="/home/register" class="btn btn-block btn-primary btn-large">Sign In and Order</a>
    </div>
</div>
@endsection