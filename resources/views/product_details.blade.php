@extends('layouts.app')
@section('content')
<div class="container">

  <div class="row">
    <div class="col-sm-12 text-center bold-class font-big padding-bottom-big">Product Details Page</div>
  </div>

  <div class="row">   
      <div class="col-sm-4">
        <div class="panel panel-primary">
          <div class="panel-heading">{{ $data['single_info']->product_name }}</div>
          <div class="panel-body">            
                <img class="zoom-img" src="{{ asset('/')}}uploads/products/{{ $data['single_info']->product_image }}" alt="{{ $data['single_info']->product_name }}" style="max-width:325px">
          </div>
          <div class="panel-footer">Price: {{ $data['single_info']->product_price }} </div>
        </div>
      </div>    

      <div class="col-sm-4">
        <div class="product-variation">
            <form action="{{url('/')}}/add-to-cart" method="post">
               {{ csrf_field() }}
              <div class="cart-plus-minus">
                 <input type="hidden" name="product_row_id" value="{{ $data['single_info']->product_row_id}}"/>
                <label for="qty">Quantity:</label>
                <div class="numbers-row">
                  <div onClick="var result = document.getElementById('qty'); var qty = result.value; if( !isNaN( qty ) &amp;&amp; qty &gt; 0 ) result.value--;return false;" class="dec qtybutton"><i class="fa fa-minus">&nbsp;</i></div>
                  <input type="text" class="qty" title="Qty" value="1" maxlength="12" id="qty" name="qty">
                  <div onClick="var result = document.getElementById('qty'); var qty = result.value; if( !isNaN( qty )) result.value++;return false;" class="inc qtybutton"><i class="fa fa-plus">&nbsp;</i></div>
                </div>
              </div>
                <button class="button pro-add-to-cart" title="Add to Cart" type="submit" style="background-color: #FA4D33; border:1px solid #FA4D33;padding: 5px">
                  <span><i class="fa fa-shopping-cart"></i> Add to Cart</span>
               </button>
            </form>

            <div style="padding-top:10px">  {{ $data['single_info']->product_description }}</div>
          </div>
      </div>
  </div>



  
</div>
@endsection

  
  
 