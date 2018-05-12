@extends('admin.layouts.app')
@section('page_specific_include_css_file')
<!-- DataTables CSS -->
<link href="{{ asset('sb-admin/vendor/datatables-plugins/dataTables.bootstrap.css') }}" rel="stylesheet">
<!-- DataTables Responsive CSS -->
<link href="{{ asset('sb-admin/vendor/datatables-responsive/dataTables.responsive.css') }}" rel="stylesheet">
@endsection

@section('content')
<div id="page-wrapper">
  <div class="row">
      <div class="col-lg-12">
          <h1 class="page-header">Orders List</h1>
          <a href="{{URL::to('/admin/download/')}}/{{$data['orders_details']->order_row_id}}" class="btn btn-info"> Preview & Print Invoice</a> <br/><br/>
      </div>
      <!-- /.col-lg-12 -->
  </div>
  <!-- /.row -->
  <!-- /.row -->
  <div class="row">
      <div class="col-lg-12">
          <div class="panel panel-default">
              <div class="panel-heading">
                  Orders 
              </div>
              <!-- /.panel-heading -->
              <div class="panel-body">
                <table width="100%" class="table table-striped table-bordered table-hover dataTables">
                  <caption class="text-center">ORD-{{sprintf('%06d',$data['orders_details']->order_row_id)}}</caption>
                    <thead>
                      <tr>
                       
                        <th class="cart_product">Product Code</th>
                        <th class="cart_product" width="160px">Image</th>
                        <th class="text-center">Unit price</th>
                        <th class="text-center">Qty</th>
                        <th class="text-center">Total</th> 
                        
                      </tr>
                    </thead>
                    <tbody>
                    @foreach(json_decode($data['orders_details']->order_details) as $od)
                      <tr><td>{{$od->product_name}}</td>
                       <td><img src="{{ url('uploads/products')}}/{{$od->product_image}}" height="150" width="140"></td>
                      <td class="text-right">{{$od->product_price}}</td>
                      <td class="text-right">{{$od->product_qty}}</td>
                        <td class="text-right">{{$od->product_total_price}}</td>
                      </tr>
                    @endforeach

                    </tbody>
                    <tfoot>
                      <tr>
                        <td colspan="4" class="text-right">Total :</td>
                        <td colspan="4" class="text-right">{{  $data['total_price']}}</td>
                      </tr>

                    </tfoot>
                </table>               
              </div>
              <!-- /.panel-body -->
          </div>
          <!-- /.panel -->
      </div>
      <!-- /.col-lg-12 -->
  </div>
</div>
@endsection

@section('page_specific_include_js_file')
<script src="{{ asset('sb-admin/vendor/datatables/js/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('sb-admin/vendor/datatables-plugins/dataTables.bootstrap.min.js') }}"></script>
<script src="{{ asset('sb-admin/vendor/datatables-responsive/dataTables.responsive.js') }}"></script>
@endsection

@section('page_level_js')
<script type="text/javascript"> 
  $('.deleteLink').click( function() {
    if( confirm('Are you sure to Delete ? ') ){
      var deleteID = $(this).attr('deleteID');   
      window.location.href = "{{ url('/')}}/admin/blog/deleteRecord/" + deleteID;    
    }      
  }); 
 </script> 
@endsection