@extends('layouts.app')
@section('content')
<header id="header">
    <div class="header-container">
      <div class="header-top">
        <div class="container">
			 <div class="panel">
         	    <div class="panel-body">

                    <div class="row">
                        
                        <div class="col-md-6">
                          <div class="panel panel-info">
                              <div class="panel-body">

                                  <form class="form-group" role="form" id="" method="post" action="{{ url('/') }}/confirm-order">
                                        {!! csrf_field() !!}
                                        <h3 class="text-center">
                        @if(Auth::check())
                         Checkout
                        @else
                        <p style="color: green;padding:0 30px;font-size: 18px">You are currently as Guest user mode. Please Sign In for better buying experience.</p>
                                          Checkout As Guest
                                          @endif
                                    </h3>
                                        <label>Name</label>
                                        <input type="text" class="form-control input" placeholder="Full name"   @if(Auth::check()) value="{{Auth::user()->name}}" @endif name="customer_name" required>
                                        <label>Shipping Address</label>
                                        <textarea type="text" placeholder="Enter Shipping Address in details..(House No,Road No,Vill etc)"  class="form-control input" name="customer_address" rows="5" required> @if(Auth::check()) {{Auth::user()->address}} @endif </textarea>
                                    
                                        <label>Phone</label>
                                        <input type="text" placeholder="Mobile Number" class="form-control input" @if(Auth::check()) value="{{Auth::user()->phone}}" @endif name="customer_phone" required>
                                         <label>Email Address</label>
                                        <input type="Email" placeholder="abc@example.com" class="form-control input" @if(Auth::check()) value="{{Auth::user()->email}}" @endif name="customer_email" required>
                                        <label>Payment Method</label>
                                        <select name="payment_type" id="payment_type" class="form-control" required>
                                                <option value="0">Choose Payment Method</option>
                                                <option value="1">bKash</option>
                                                <option value="2">DBBL Mobile Banking</option>
                                                 <option value="3">Cash On Delivery</option>
                                                <option value="4"> VISA</option>
                                                <option value="5"> Master Card</option>
                                                <option value="6"> American Express</option>
                                            </select> 
                                            <div id="mobile_banking" hidden="true">
                                                <label>Transaction Id</label>
                                            <input type="text"  class="form-control input" name="trnxId" id="trnxId">
                                            </div>
                                            <br/>
                                          <div id="credit_cart" hidden="true">
                                                <div class="form-group"> 
                                                     <label>Card Name</label>
                                                <input class="form-control" name="card_holder_contactname" value="" size="25" maxlength="120" placeholder="card holder name"> 
                                            </div>
                                            <div class="form-group">
                                                 <label>Card Number</label>
                                                <input class="form-control" name="card_number" value="" size="25" maxlength="16" placeholder="card number">
                                            </div>
                                            <div class=" form-group text-left">
                                                 <label class="card_payment_title">Card Expiration </label> 
                                             
                                                   <div class="row">
                                                       <div class="col-sm-6">
                                                            <select name="card_exp_month" class="form-control card_payment" id="card_exp_month" placeholder="Expiration (month)">
                                                       <?php $now = date('m'); ?>
                                                        <option value="01" @if($now==1) selected="selected" @endif>Jan (01)</option>
                                    <option value="02" @if($now==2) selected="selected" @endif>Feb (02)</option>
                                    <option value="03" @if($now==3) selected="selected" @endif>Mar (03)</option>
                                    <option value="04" @if($now==4) selected="selected" @endif>Apr (04)</option>
                                    <option value="05" @if($now==5) selected="selected" @endif>May (05)</option>
                                    <option value="06" @if($now==6) selected="selected" @endif>June (06)</option>
                                    <option value="07" @if($now==7) selected="selected" @endif>July (07)</option>
                                    <option value="08" @if($now==8) selected="selected" @endif>Aug (08)</option>
                                    <option value="09" @if($now==9) selected="selected" @endif>Sep (09)</option>
                                    <option value="10" @if($now==10) selected="selected" @endif>Oct (10)</option>
                                    <option value="11" @if($now==11) selected="selected" @endif>Nov (11)</option>
                                    <option value="12" @if($now==12) selected="selected" @endif>Dec (12)</option>
                                                    </select>  
                                                       </div>
                                                        <div class="col-sm-6"> 
                                                   <select name="card_exp_year" class="form-control card_payment" id="card_exp_year" exclude=" " placeholder="Expiration (year)">
                                                         <?php $now = date('Y'); ?>

                                    @for ($i = 2015; $i <= 2040; $i++)
                                    <option  value="{{ $i }}" @if($now==$i) selected="selected" @endif>{{ $i }}</option>

                                    @endfor 
                                                    </select> </div>
                                                   </div>
                                                    
                                                   

                                                  
                                                
                                            </div>
                                                 
                                            
                                                 <label>CCV Code</label> 
                                                <div class="form-group">                                        
                                                   
                                                    <div class="col-sm-9">
                                                        <input name="card_security_code" placeholder="cvv" class="form-control" autocomplete="off" id="card_security_code"  maxlength="4" />
                                                    </div>
                                                </div>
                                           
                                            </div>
                                       
                                       
                                        <button class="button btn-info"  style="margin: 10px 0px 0px 230px"><i class="icon-login"></i>&nbsp; <span>Submit</span></button>
                                    </form>
                                </div>

                            </div>
                        </div>   
                        <div class="col-sm-6">
                          @if(Auth::check())
                            <div class="panel panel-info">
                                <div class="panel panel-body" style="min-height: 200px;font-weight: bold">
                                  Welcome, {{ Auth::user()->name}}.<br /> Provide Shipping Address and Pay to
                                  place the order.
                                </div>
                            </div>
                            @else
                            <div class="panel ">
                                <div class="panel-body">
                                    <div class="row" >
                                         <div class="text-center">
                                       
                            <div class="panel panel-primary">
                                <div class="panel-body">
                                     <h2>Log In</h2>
                                    <form class="form-horizontal" role="form" method="POST" action="{{ url('/log-in') }}">
                                        {{ csrf_field() }}
                                        
                                        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                                            <label for="email" class="col-md-4 control-label">E-Mail</label>

                                            <div class="col-md-6">
                                                <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required autofocus>

                                                @if ($errors->has('email'))
                                                    <span class="help-block">
                                                        <strong>{{ $errors->first('email') }}</strong>
                                                    </span>
                                                @endif
                                            </div>
                                        </div>

                                        <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                                            <label for="password" class="col-md-4 control-label">Password</label>

                                            <div class="col-md-6">
                                                <input id="password" type="password" class="form-control" name="password" required>

                                                @if ($errors->has('password'))
                                                    <span class="help-block">
                                                        <strong>{{ $errors->first('password') }}</strong>
                                                    </span>
                                                @endif
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <div class="col-md-6 col-md-offset-4">
                                                <div class="checkbox">
                                                    <label>
                                                        <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : ''}}> Remember Me
                                                    </label>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <div class="col-md-6 col-md-offset-4">
                                                <button type="submit" class="btn btn-info">
                                                    Login & Checkout
                                                </button>

                                                <a class="btn btn-link" href="{{ url('/password/reset') }}">
                                                    Forgot Your Password?
                                                </a>
                                            </div>
                                        </div>

                                    </form>
 <div class="text-center" style="min-height: 150px;background-color: #F3F3F3;">
                                          <p style="color: green;padding-top: 40px;font-size: 18px">New to this site ? Join today!.</p>
                                        <a href="{{route('user.registration')}}" class="btn btn-primary"> <i class="fa fa-user"></i> Register</a>
                                    </div>
                                </div>
                            </div>
                                    </div>
                                    </div>
                                      
                                    
                                    
                                </div>
                            </div>

                    @endif
                        </div>                  
                   </div>

         	    	
               </div>
           </div>
       </div>
   </div>
</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script type="text/javascript">
    $('#payment_type').change(function () {
    var payment_type_id = $(this).val();
    if(payment_type_id>3)
    {
        $('#credit_cart').show();
         $('#mobile_banking').hide();
    }
   else if(payment_type_id<=2 && payment_type_id>0)
   {
     $('#mobile_banking').show();
     $('#credit_cart').hide();
   }
   else{
    $('#mobile_banking').hide();
     $('#credit_cart').hide();
   }
   
});
</script>
@endsection