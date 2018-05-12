@extends('layouts.app')
@section('content')
<div class="container">   
  <!- Featured Products -->
  <div class="row">
    <div class="col-sm-12 text-center bold-class font-big padding-bottom-big">Featured Products</div>
  </div>
  <div class="row">
    @if($data['featured_products'] && count($data['featured_products']))
      @foreach($data['featured_products']  as $product)
      <div class="col-sm-4">
        <div class="panel panel-primary">
          <div class="panel-heading">{{ $product->product_name }}</div>
          <div class="panel-body"> 
            <a title="{{ $product->product_name }}" href="{{ url('/')}}/product/details/{{ $product->product_row_id }}">
              <img src="{{ asset('/')}}uploads/products/{{ $product->product_image }}"  alt="product" style="width: 280px; height:180px">
            </a>
            </div>
          <div class="panel-footer">Price: {{ $product->product_price }} </div>
        </div>
      </div>
      @endforeach
    @endif
  </div>
  <!- Featured Products -->

  <!- Latest Products -->
  <div class="row">
    <div class="col-sm-12 text-center bold-class font-big padding-bottom-big">Latest Products</div>
  </div>
  <div class="row">
    @if($data['latest_products'] && count($data['latest_products']))
      @foreach($data['latest_products']  as $product)
      <div class="col-sm-4">
        <div class="panel panel-primary">
          <div class="panel-heading">{{ $product->product_name }}</div>
          <div class="panel-body"> 
            <a title="{{ $product->product_name }}" href="{{ url('/')}}/product/details/{{ $product->product_row_id }}">
              <img src="{{ asset('/')}}uploads/products/{{ $product->product_image }}"  alt="product" style="width: 225px;height:225px">
            </a>
            </div>
          <div class="panel-footer">Price: {{ $product->product_price }} </div>
        </div>
      </div>
      @endforeach
    @endif
  </div>
  <!- Latest Products -->

</div>
@endsection

@section('page_js')
@endsection