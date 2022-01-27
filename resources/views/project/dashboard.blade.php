@php 
 $sid=session('sid');
 $cartv=session('cartv');
@endphp 
@if(empty($sid))
  <script>
      location.href="{{url('/home')}}";
  </script>
@endif 
<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

    <title>Pizza Delivery</title>
    <style>
        a:hover{
            text-decoration:none;
        }
        </style>
  </head>
  <body>
      <header>
      <nav class="navbar navbar-expand-lg navbar-light bg-light">
  <img src="/images/Pizzalogo.png" height=80 width=80 style="border-radius:50%" class="ml-3"/>
  <a class="navbar-brand" href="#"></a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse float-right" id="navbarNav">
    <ul class="navbar-nav">
    </ul>
  </div>
  <div class="float-right mr-3">
      <a  href="#" class="text-secondary font-weight-bold mr-3">Welcome : {{$sid[0]->email}}</a>
    <a href="/home/dashboard" class="text-secondary font-weight-bold mr-3">Menu</a>
    <a href="/home/dashboard/profile" class="text-secondary font-weight-bold mr-3">Profile</a>
    <a href="/home/dashboard/cart" class="text-secondary font-weight-bold mr-3">Cart <span class="badge badge-secondary">{{ $cartv }}</span></a>
      <a href="/home/logout" class="btn btn-outline-secondary font-weight-bold mr-3">Logout</a>
        </div>

        </nav>
        </header>
      <section class="container">
        @foreach($menudata as $menu)
        <div class="card float-left text-center m-2" style="width:255px;height:350px;">
            <img class="card-img-top" src="{{asset('/images/'.$menu->p_image)}}" alt="Card image cap" width=150 height=200>
            <div class="card-body" style="padding-bottom:0px;height:140px;width:250px;">
                <h5 class="card-title">{{$menu->p_name}}</h5>
                <p class="card-text">Rs. {{$menu->p_price}}</p>
                <!--<a href="javascript:void(0)" cid="{{$menu->id}}" class="btn btn-primary add">Add TO Cart</a> -->
              <form method="post" action="/home/dashboard/addtocart"> 
              @csrf()
              <input type="hidden" value="{{$menu->id}}" name="id"/>
              <input type="hidden" value="{{$menu->p_name}}" name="name"/> 
              <input type="hidden" value="{{$menu->p_price}}" name="price"/> 
                <input type="hidden" value="{{$menu->p_image}}" name="image"/>
                <input type="submit" class="btn btn-info" value="Add To Cart">
            </form> 
            </div>
            
        </div> 
        @endforeach
        </section>

    

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
  </body>
</html>