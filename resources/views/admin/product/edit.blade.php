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
                            {{ Form::open(array('url' => 'admin/product/update', 'files' => true)) }}    
                            <input type="hidden" name="hidden_row_id" value="{{ $data['single_info']->product_row_id }}">                         
                                <div class="col-lg-6">                                    
                                    <div class="form-group">
                                        <label>Product Name</label>
                                        <input class="form-control" required="required" id="product_name" name="product_name" value="{{ $data['single_info']->product_name }}">
                                       
                                    </div>
                                    <div class="form-group">
                                        <label>Product Sku</label>
                                        <input class="form-control" name="product_sku" id="product_sku" value="{{ $data['single_info']->product_sku }}" >
                                    </div>
                                    <div class="form-group">
                                        <label>Product Price</label>
                                         <input class="form-control" name="product_price" id="product_price" value="{{ $data['single_info']->product_price }}" placeholder="Price">
                                    </div>

                                    <div class="form-group">
                                        <label>Product Image</label>
                                        <input type="file" id="image1" name="product_image">
                                    </div>  
                                    <div class = "form-group">
                                      <label for="exampleInputEmail1">Product Name</label>       
                                      <div id ="image1_holder" >                       
                                         @if( $data['single_info']->product_image)
                                         <img src="{{ url('/uploads')}}/products/{{ $data['single_info']->product_image }}" style="height:100px;width:100px" alt="produt image" />
                                         <a href="javascript:void(0)" image1_name="{{ $data['single_info']->product_image }}" delete_row_id="{{ $data['single_info']->product_row_id }}" id="image1_delete"><img src="{{ url('/')}}/images/delete.png"  alt="Delete"/></a>
                                         @endif
                                      </div>
                                    </div> 

                                   
                                    <button type="submit" class="btn btn-success">SAVE</button>
                                </div>
                                <!-- /.col-lg-6 (nested) -->
                                <div class="col-lg-6">
                                  <div class="form-group">
                                            <label>Product Description</label>
                                            <textarea class="form-control" name="product_long_description" rows="3">{{ $data['single_info']->product_long_description}}</textarea>
                                        </div>
                                        <div class="form-group">
                                            <label>Type</label>
                                            <div class="checkbox">
                                                <label>
                                                    <input type="checkbox" id="is_latest" name="is_latest" @if( $data['single_info']->is_latest == 1) checked="checked" @endif>Is it Special Product ?
                                                </label>
                                            </div>
                                            <div class="checkbox">
                                                <label>
                                                    <input type="checkbox"  id="is_featured" name="is_featured"  @if( $data['single_info']->is_featured == 1) checked="checked" @endif >Is it Featured Product ?
                                                </label>
                                            </div>
                                            
                                        </div>
                                        <div class="form-group">
                                            <label>Category</label>
                                            <select name="category_row_id" class = "form-control" required="required">
                                              <option value="" @if( $data['single_info']->category_row_id == "") selected="selected" @endif >Select</option>         
                                              @foreach( $data['categories_list'] as $row)
                                                <option value="{{ $row->category_row_id}}"  @if( $data['single_info']->category_row_id == $row->category_row_id) selected="selected" @endif>
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
    
    
    $('#image1_delete') . click( function() 
    {
    if( !confirm('Are you sure you want to delete ?'))
    return false;
    
    var id  = $(this).attr('delete_row_id');
    var file_name  = $(this).attr('image1_name');    
    $('#image1_holder') . html('');
    $.ajax({
        type: "GET",
        url : "{{url ('/') }}" + "/admin/product/deleteImageOnly/" + id + "/" + file_name ,                         
        success : function(status){
         $('#image1_holder') . html('<span class="inline_success_message">Image has been deleted</span>');
         $('#image1_holder').delay(3000).fadeOut('slow', function(){
             $('#image1_holder').html('');    
             $('#image1_holder').fadeIn('slow');    
         });
         
        }
    });
    }); 
</script>
@endsection