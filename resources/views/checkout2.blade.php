@extends('layouts.app')
@section('content')
<header id="header">
    <div class="header-container">
      <div class="header-top">
        <div class="container">
			<div class="panel">
         	    <div class="panel-body">
         	    	<div class="row">
         	    		<div class="col-sm-3">
         	    		</div>

         	    		<div class="col-sm-6">
         	    			<form class="form-group" role="form" id="" method="post" action="{{ url('/') }}/checkout">
				                {!! csrf_field() !!}
				                <h3 style="text-decoration: underline;text-align: center;">Checkout</h3><br>
				                <label>Shipping Address</label>
				                <input type="text" class="form-control input" name="customer_address">
				                <label>Phone</label>
				                <input type="text" class="form-control input" name="customer_phone">
				                <label>Bikash Number ( Optional ) </label>
				                <input type="text" class="form-control input" name="bikash_number">
				                <button class="button" style="margin: 10px 0px 0px 230px"><i class="icon-login"></i>&nbsp; <span>Submit</span></button>
			                </form>
         	    		</div>

         	    		<div class="col-sm-3">
         	    		</div>
     	    		</div>
          		</div>
            </div>
			</div>
		</div>
	</div>

@endsection