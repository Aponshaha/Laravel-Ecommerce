@extends('layouts.app')
@section('content')
    
<div class="container">
    <div class="row" style="padding:100px 0">
	   <p>Your Order No: # {{	$data['track_id']}}</p>
	   <p>Thank You for the Order!.	</p>
    </div>
</div>

@endsection
