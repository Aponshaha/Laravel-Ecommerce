<!DOCTYPE html>
<html lang="en">
<head>
@include('common/head')
</head>

<body class="cms-index-index cms-home-page">

<!--[if lt IE 8]>
      <p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
  <![endif]--> 

<!-- mobile menu -->
@include('common/mobile-menu')
<!-- end mobile menu -->
<div id="page"> 
@include('common/header')
  <!-- Home Slider Start -->
 

  
    <div class="container">
    <div class="special-products">
      <div class="page-header" style="margin:50px 0">
        <h2>{{ $data['category_name'] }}</h2>
      </div>
	  
	  @foreach ( $data['products']->chunk(4) as $chunk)
	  <div class="row" style="margin:50px 0 0 0">
		 @foreach($chunk  as $product)

		    <?php 
                                                                       
                                                                       $rating=0;
                                                                       $exits=$data['ratings']->where('product_id',$product->product_row_id)->first(); 
                                                                       if($exits){
                                                                         $rating= $exits->rating;
                                                                       }   
                                                                 ?>
		 <form method="post" action="{{url('/')}}/add-to-cart">
        {{ csrf_field() }}  
			<div class="col-md-3"> 
			
				<a title="{{ $product->product_name }}" href="{{ url('/')}}/product/details/{{ $product->product_row_id }}">
					<img   src="{{ asset('/')}}public/uploads/products/{{ $product->product_image }}"  alt="Product">
				</a>	
				<div class="item-title" style="text-align:center">
					<h4><a title="{{ $product->product_name }}" href="{{ url('/')}}/product/details/{{ $product->product_row_id }}">{{ $product->product_name }}</a></h4>
				</div>
				<div class="item-content" style="text-align:center">

					 <a href="{{URL::to('/give-rating/')}}/{{ $product->product_row_id}}/1"><i class="fa fa-star" @if($rating >=1) style="font-size:20px;color: orange;" @else style="font-size:20px;color:gray"  @endif></i></a> 
                   <a href="{{URL::to('/give-rating/')}}/{{ $product->product_row_id}}/2"><i class="fa fa-star" @if($rating >=2) style="font-size:20px;color: orange;" @else style="font-size:20px;color:gray"  @endif></i></a> 
                   <a href="{{URL::to('/give-rating/')}}/{{ $product->product_row_id}}/3"><i class="fa fa-star" @if($rating >=3) style="font-size:20px;color: orange;" @else style="font-size:20px;color:gray"  @endif></i></a> 
                   <a href="{{URL::to('/give-rating/')}}/{{ $product->product_row_id}}/4"><i class="fa fa-star" @if($rating >=4) style="font-size:20px;color: orange;" @else style="font-size:20px;color:gray"  @endif></i></a> 
                   <a href="{{URL::to('/give-rating/')}}/{{ $product->product_row_id}}/5"><i class="fa fa-star" @if($rating >4) style="font-size:20px;color: orange;" @else style="font-size:20px;color:gray"  @endif></i></a> 
                    <div class="item-price">
					  <div class="price-box"> <span class="regular-price"> <span class="price">{{ $product->product_price }} Tk</span> </span> </div>
					</div>
					<div class="pro-action">
					 <input type="hidden" name="product_row_id" value="{{ $product->product_row_id}}"/>
                              <input type="hidden" class="qty" title="Qty" value="1" maxlength="12" id="qty" name="qty">
                              <button  class="add-to-cart-mt" type="submit"> <i class="fa fa-shopping-cart"></i><span> Add to Cart</span> </button>
					</div>
                </div>
			</div>
		</form>
		 @endforeach
	  </div>
	  @endforeach
	 
	
	  
    </div>
  </div>


  <!-- Footer -->
	@include('common/footer')
  <!-- End Footer --> 
  <!--Newsletter Popup Start-->

  <!--End of Newsletter Popup--> 
  
</div>

<!-- JS --> 
@include('common/footer_js_common_page')

</body>
</html>
