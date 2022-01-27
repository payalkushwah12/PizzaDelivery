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
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        
        <script>
            $(document).ready(function(){
                $(".del").click(function(e){
                    var cid = $(this).attr("cid");
                    $.ajax({
                        url:"{{url('/home/dashboard/deletecart')}}",
                        method:'delete',
                        data:{_token:'{{csrf_token()}}',cid:cid},
                        success:function(response){
                            console.log(response);
                            window.location.reload();
                        }
                    })
                })
            })
        </script>
        

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
  <a href="#" class="text-secondary font-weight-bold mr-3">Welcome : {{$sid[0]->email}}</a>
  <a href="/home/dashboard" class="text-secondary font-weight-bold mr-3">Menu</a>
  <a href="/home/dashboard/profile" class="text-secondary font-weight-bold mr-3">Profile</a>
  <a href="/home/dashboard/cart" class="text-secondary font-weight-bold mr-3">Cart <span class="badge badge-secondary">{{ $cartv }}</span></a>
       
      <a href="/home/logout" class="btn btn-outline-secondary font-weight-bold mr-3">Logout</a>
        </div>

        </nav>
        </header>
        <section class="container">
            <div class="jumbotron">
            <h1 class="text-center mb-3 pb-3">Shopping Cart</h1>
        <table class="table table-striped">
        @php 
        $sn=1;
        @endphp
        @foreach($cartdata as $cart)
        <tr>
            <td>{{$sn}}</td>
            <td>
            <img src="{{asset('/images/'.$cart->image)}}" width=90 height=80 style="border-radius:50%;"/>
            </td>
            <td>{{$cart->name}}</td>
            <td>Rs. {{$cart->price}}</td>
            <td>{{$cart->cartvalue}}</td>
            <td>
                <a href="javascript:void(0)" cid="{{$cart->id}}" class="btn btn-danger del">Delete</a></td>
            </tr>
        @php 
        $sn++;
        
        @endphp
        @endforeach
        
    </table>
    <div class="text-center mr-3"><span>Total : <b>Rs. {{$sum}}<b></span>
    <a href="/home/dashboard/checkout" class="btn btn-secondary ml-3">Checkout</a>
    </div>
    
    </div>
    </section>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
  </body>
</html>