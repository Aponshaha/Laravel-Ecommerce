@extends('admin.layouts.app')
@section('content')
    <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Products</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            Add Product
                        </div>
                        <div class="panel-body">
                            <div class="row">                             
                            {{ Form::open(array('url' => 'admin/product/store', 'files' => true)) }}                             
                                <div class="col-lg-6">                                    
                                    <div class="form-group">
                                        <label>Product Name</label>
                                        <input class="form-control" required="required" id="product_name" name="product_name" placeholder="Product Name">
                                       
                                    </div>
                                    <div class="form-group">
                                        <label>Product Sku</label>
                                        <input class="form-control" name="product_sku" id="product_sku" placeholder="SKU">
                                    </div>
                                    <div class="form-group">
                                        <label>Product Price</label>
                                         <input class="form-control" name="product_price" id="product_price" placeholder="Price">
                                    </div>

                                    <div class="form-group">
                                        <label>Product Image</label>
                                        <input type="file" id="image1" name="product_image">
                                    </div>    

                                    <div class = "form-group">                                          
                                      <div id ="image1_holder" ></div>
                                    </div>                                    
                                   
                                    <button type="submit" class="btn btn-success">SAVE</button>
                                </div>
                                <!-- /.col-lg-6 (nested) -->
                                <div class="col-lg-6">
                                  <div class="form-group">
                                            <label>Product Description</label>
                                            <textarea class="form-control" name="product_long_description" rows="3"></textarea>
                                        </div>
                                        <div class="form-group">
                                            <label>Type</label>
                                            <div class="checkbox">
                                                <label>
                                                    <input type="checkbox" id="is_latest" name="is_latest">Is it Special Product ?
                                                </label>
                                            </div>
                                            <div class="checkbox">
                                                <label>
                                                    <input type="checkbox"  id="is_featured" name="is_featured">Is it Featured Product ?
                                                </label>
                                            </div>
                                            
                                        </div>
                                        <div class="form-group">
                                            <label>Category</label>
                                            <select name="category_row_id" class = "form-control" required="required">
                                                <option value="">Select</option>         
                                                @foreach( $data['categories_list'] as $row)
                                                <option value="{{ $row->category_row_id}}">
                                                  @if($row->level == 0) <b>  @endif  
                                                   @if($row->level == 1) &nbsp; - @endif 
                                                   @if($row->level == 2) &nbsp; &nbsp; &nbsp;  - @endif            
                                                   {{ $row->category_name }} 
                                                  @if($row->level == 0) </b>  @endif  
                                                </option>
                                                @endforeach
                                            </select>
                                        </div>
                                </div>
                                <!-- /.col-lg-6 (nested) -->
                                {{ Form::close() }}
                            </div>
                            <!-- /.row (nested) -->
                        </div>
                        <!-- /.panel-body -->
                    </div>
                    <!-- /.panel -->
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
    </div>
@endsection


@section('page_level_js')
<script type="text/javascript">
  $('#image1').bind('change',setImage);
    function setImage(event) {    
        var files = event.target.files;
        var fileName = files[0].name;
        var tmpPath = URL.createObjectURL(event.target.files[0]);
        $('#image1_holder') . html('');
        $('#image1_holder') . html('<img src = "' + tmpPath + '" alt="Image" style="height:100px;" />');
    }
</script>
@endsection        