@extends('layouts.app')
@section('content')
<div class="container">
  <h2>Cart Page</h2>
  @if( isset($data['temp_orders']) && count($data['temp_orders'] ) )       
  <table class="table table-bordered">
    <thead>
      <tr>
        <th style="width:45%">Product</th>
        <th style="width:25%">Qty</th>
        <th style="width:15%">Total</th>
        <th style="width:15%">Action</th>
      </tr>
    </thead>
    <tbody>
      @foreach($data['temp_orders'] as $temp_order) 
        <form method="post" action="{{ url('/') }}/update-cart"id="{{$temp_order->temp_order_row_id}}">
        {{ csrf_field() }}     
        <tr>
          <td>{{$temp_order->product_name}}</td>
          <td>
            <div style="float:left;margin-left: 10px">
                <input type="text" class="form-control" title="Qty" min="1" value="{{$temp_order->product_qty}}" maxlength="12" id="qty_{{$temp_order->temp_order_row_id}}" name="qty_textbox" style="width:100px">
            </div>
            <div style="float:left;margin-left: 10px">                
              <input type="hidden" name="temp_order_row_id" value="{{$temp_order->temp_order_row_id}}">
              <button class='btn btn-success'>Update Cart</button>
            </div>            
          </td>
          <td>${{ $temp_order->product_total_price }}</td>
          <td> 
            <a href="javascript:void(0)" temp_order_row_id="{{ $temp_order->temp_order_row_id }}" class="remove-item" /> <button class='btn btn-danger'>Delete</button>
            </a>
            <input type="hidden" name="temp_order_row_id[]" value="{{ $temp_order->temp_order_row_id }}" /> 
           </td>
        </tr>
        </form>
      @endforeach   
      <tr>
        <td colspan="2" class="text-right">
          <strong>Total :</strong>
        </td>
         <td class="text-left">  ${{$data['temp_orders']->sum('product_total_price')}}</td>
         <td>&nbsp;</td>
      </tr> 

      <tr class="first last">
      <td colspan="4" class="a-right last">
        <a href="{{URL::to('/checkoutPage')}}"><button type="button" title="Continue Shopping" class="button btn-continue btn-info" href="{{ url('/')}}"><span>Checkout</span></button></a>

        <a href="{{URL::to('/')}}"><button type="button" title="Continue Shopping" class="button btn-continue btn-info" href="{{ url('/')}}"><span>Continue Shopping</span></button></a>

        <a href="javascript:void(0)" temp_order_row_id="{{ $temp_order->temp_order_row_id }}" id="remove-all" /> 
        <button type="button" class="button btn-danger">Remove All</button> </a>
        </td>
      </tr>

    </tbody>
  </table>
  @else
    <div class="col-sm-12 text-center"> Cart is empty!</div>
  @endif
</div>
@endsection

@section('page_js')
<script type="text/javascript"> 
$(document).ready(function() {
 $("#qty_textbox").change(function(){ 
     $("#car_from").submit();
  });

 $('a.remove-item') . click( function() {
    var temp_order_row_id = $(this).attr('temp_order_row_id');
  if( !confirm('Are you sure to remove this item ? '))
  {
    return false;
  }
  
  var dataString = 'temp_order_row_id=' + temp_order_row_id;
    $.ajax({
        type: "POST",
        headers: {'X-CSRF-Token': $('meta[name=_token]').attr('content')},
        url : "{{url ('/') }}" + "/cartItemDelete",
        data : dataString,                    
        success : function(status) {    
        window.location.href = '{{url('/')}}/mycart';    
        }
    });
      
 });
 
  $('#remove-all') . click( function() {

  //var dataString = 'temp_order_row_id=' + temp_order_row_id;
  if( !confirm('Are you sure to remove all items from cart ? '))
  {
    return false;
  }
  $.ajax({
      type: "POST",
      headers: {'X-CSRF-Token': $('meta[name=_token]').attr('content')},
      url : "{{url ('/') }}" + "/cartItemDeleteAll",
      //data : dataString,                    
      success : function(status) {
      window.location.href = '{{url('/')}}/mycart';   
      }
  });
    
  });
 
 }); 
</script>
@endsection