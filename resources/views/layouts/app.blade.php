<!DOCTYPE html>
<html lang="en">
<head>
  <title>Custom Laravel Ecommerce</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>  
  <style>
    /* Remove the navbar's default rounded borders and increase the bottom margin */ 
    .navbar {
      margin-bottom: 50px;
      border-radius: 0;
    }
    
    /* Remove the jumbotron's default bottom margin */ 
     .jumbotron {
      margin-bottom: 0;
      padding: 0;
      background-color: #fff;
    }
    .color-lara {color:#FA4D33;}
    .bold-class {font-weight: bold}
    .font-big {font-size:20px;}
    .padding-bottom-big {padding-bottom: 20px}

    /* 
        overwrite bootstrap theme

    */
    .panel-primary>.panel-heading {
    color: #fff;
    background-color: #FA4D33;
    border-color: #FA4D33;
    }
    .panel-primary {border-color:#000}

    /* Add a gray background color and some padding to the footer */
    footer {
      background-color: #f2f2f2;
      padding: 25px;
    }
    .jumbotron .h1, .jumbotron h1 {font-size: 30px}

    #logo_container {padding: 5px 0 0 50px; float:left;width: 200px; }
    .jumbotron .h1, .jumbotron h1, h2{font-size: 24px;}
  </style>
</head>
<body>

<div class="jumbotron">
  <div id="logo_container"><a href="{{ url('/') }}"><img src="{{ asset('/images/Logo.png') }}" alt="logo"></a></div>
  <div class="container text-center">
    <h1>Laravel Based Ecommerce</h1>      
    <p class="color-lara">I will simply change the design for you.</p>
  </div>
</div>

<nav class="navbar navbar-inverse">
  <div class="container-fluid">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>                        
      </button>     
    </div>
    <div class="collapse navbar-collapse" id="myNavbar">
      <ul class="nav navbar-nav">
        <li class="active"><a href="{{ url('/') }}">Home</a></li>
        <li><a href="#">Products</a></li>
        <li><a href="#">About Us</a></li>        
        <li><a href="#">Contact</a></li>
      </ul>
      <ul class="nav navbar-nav navbar-right">
         @if(Auth::check())
            <li>
              <a href="{{ url('/logout') }}" onclick="event.preventDefault();document.getElementById('logout-form').submit();">
                <span class="glyphicon glyphicon-user"></span> Logout
              </a>
              <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                @csrf
              </form>
            </li>

            @else
            <li><a href="{{ url('/register') }}"><span class="glyphicon glyphicon-user"></span> Register</a></li>            
        @endif        
            <li><a href="{{ url('/mycart') }}"><span class="glyphicon glyphicon-shopping-cart"></span> Cart</a></li>
      </ul>
    </div>
  </div>
</nav>

@yield('content')

<footer class="container-fluid text-center">
  <p>no copyright issue, copy as much as you need</p>  
 
</footer>
@yield('page_js')
</body>
</html>
