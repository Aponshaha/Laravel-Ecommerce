<!-- Related Products
----------------------------------------------------------------------------- 
  <div class="row">
    <div class="col-sm-12 text-center bold-class font-big padding-bottom-big">Related Products below</div>
  </div>
  <div class="row">   
    @if($data['related_products'] && count($data['related_products']))
      @foreach($data['related_products']  as $product)
      <div class="col-sm-4">
        <div class="panel panel-primary">
          <div class="panel-heading">{{ $product->product_name }}</div>
          <div class="panel-body">            
              <img src="{{ asset('/')}}uploads/products/{{ $product->product_image }}"  alt="product" style="max-width:325px;max-height: 120px">            
            </div>
          <div class="panel-footer">Price: {{ $product->product_price }} </div>
        </div>
      </div>
      @endforeach
    @endif
  </div>
 ---------------------------------------------------------------------- 
 Related Products -->