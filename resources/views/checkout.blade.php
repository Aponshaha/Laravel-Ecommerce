@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row">
	    <div class="col-md-6">
			<form method="post" action="{{ url('/') }}/processPayment">
				{!! csrf_field() !!}

				<div class="form-group row">
					<label for="example-text-input" class="col-xs-2 col-form-label">Name</label>
					<div class="col-xs-10">
					<input class="form-control" name="name" type="text" value="{{ (Auth::guest()) ? '' :  (Auth::user()->name) }}">
					</div>
				</div>
				
				<div class="form-group row">
					<label for="example-text-input" class="col-xs-2 col-form-label">Email</label>
					<div class="col-xs-10">
					<input class="form-control" name="email" type="text" value="{{ (Auth::guest()) ? '' :  (Auth::user()->email) }}" >
					</div>
				</div>

			@if( Auth::guest() )
				<div class="form-group row">
					<label for="example-text-input" class="col-xs-2 col-form-label">Password</label>
					<div class="col-xs-10">
					<input class="form-control" name="password" type="password" >
					</div>
				</div>
				
				
				<div class="form-group row">
					<label for="example-text-input" class="col-xs-2 col-form-label">Confirm Password</label>
					<div class="col-xs-10">
					<input class="form-control" name="cpassword" type="password" >
					</div>
				</div>
			@endif
				
				
				<div class="form-group row">
				<label for="example-text-input" class="col-xs-2 col-form-label"> Card Information</label>
					<div class="col-xs-10">
						<ul class="list-price">							
									<li>
									<div class="outer-payment-items">
											<div class="form-group">							  
											<select name="card_type" class="form-control">
												<option> Choose Payment Method</option>
												<option> VISA</option>
												<option> Master Card</option>
												<option> American Express</option>
											</select> 
											</div>
											<div class="form-group"> 
												<input class="form-control" name="card_holder_contactname" value="" size="25" maxlength="120" placeholder="card holder name"  required=""> 
											</div>
											<div class="form-group">
												<input class="form-control" name="card_number" value="" size="25" maxlength="16" placeholder="card number"  required="">
											</div>
											<div class=" form-group text-left">
												<div class="form-inline">
													<label class="card_payment_title">Card Expiration </label> 
													
													<select name="card_exp_month" class="form-control card_payment" id="card_exp_month" placeholder="Expiration (month)" required>
														<option value=" ">Select Month</option>
														<option value="01">01</option>
														<option value="02">02</option>
														<option value="03">03</option>
														<option value="04">04</option>
														<option value="05">05</option>
														<option value="06">06</option>
														<option value="07">07</option>
														<option value="08">08</option>
														<option value="09">09</option>
														<option value="10">10</option>
														<option value="11">11</option>
														<option value="12">12</option>
													</select>  
												   
												   <select name="card_exp_year" class="form-control card_payment" id="card_exp_year" exclude=" " placeholder="Expiration (year)" required>
														<option value=" ">Select Year</option>
														<option value="2016">2016</option>
														<option value="2017">2017</option>
														<option value="2018">2018</option>
														<option value="2019">2019</option>
														<option value="2020">2020</option>
														<option value="2021">2021</option>
														<option value="2022">2022</option>
														<option value="2023">2023</option>
														<option value="2024">2024</option>
														<option value="2025">2025</option>
														<option value="2026">2026</option>
														<option value="2027">2027</option>
														<option value="2028">2028</option>
														<option value="2029">2029</option>
														<option value="2030">2030</option>
													</select> 
												</div>
											</div>
												 
											<div class="form-horizontal payment_cvv_code">     
												<div class="form-group"> 										
													<label class="col-sm-3 control-label" >CCV Code</label> 
													<div class="col-sm-9">
														<input name="card_security_code" placeholder="cvv" class="form-control" autocomplete="off" id="card_security_code"  maxlength="4" />
													</div>
												</div>
											</div>
											
											<div class="form-group"> 
												<input  type="submit" class="btn btn-info" value="Submit" name="submit" />  
											</div>

									</div>

									</li>						
							
						</ul>
					</div>	
				</div>
			</form>
		</div>	
    </div>
	
	
	<div class="row" style="padding:100px 0 0 0">	
	  <div class="col-md-12 text-center"> <img src="{{ url('/public')}}/images/payment_method.png" /> </div>
	</div>

</div>
@endsection
