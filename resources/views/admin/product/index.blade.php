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
        <h1 class="page-header">Products List</h1>
    </div>
    <!-- /.col-lg-12 -->
</div>
<!-- /.row -->
<div class="row">
    <div class="col-lg-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                Products
            </div>
            <!-- /.panel-heading -->
            <div class="panel-body">
                <table width="100%" class="table table-striped table-bordered table-hover dataTables">
                    <thead>
                        <tr>
                          <th>Product Name</th>              
                          <th> Price</th>   
                          <th>Image</th>          
                          <th>Category Name</th>       
                          <th>Special</th>     
                          <th>Featured</th>
                          <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($data['products_list'] as $row)    
                        <tr>            
                        <td>{{ $row->product_name }}</td> 
                        <td>{{ $row->product_price }}</td>            
                        <td><img alt="product" style="width:50px;height:50px" src="{{ asset('/uploads')}}/products/{{ $row->product_image }}"></td>            
                        <td>{{ isset($row->category_info->category_name) ? $row->category_info->category_name : '' }}</td>            
                        <td>{{ $row->is_latest ? 'Yes' : '' }}</td>
                        <td>{{ $row->is_featured ? 'Yes' : '' }}</td>                       
                        <td>
                            <button onclick="window.location='{{ url('/')}}/admin/product/edit/{{$row->product_row_id}}'" class="btn btn-warning mb-2">Edit</button>
                            <button deleteID="{{$row->product_row_id}}"  class="btn btn-danger deleteLink">Delete</button> 
                        </td>
                        </tr>
                        @endforeach
                    </tbody>
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
   $('.deleteLink') . click( function() {
    if( !confirm('Are you sure you want to delete ?'))
    return false;
	
	   var id  = $(this).attr('deleteID');	
	   window.location.href = "{{url('/')}}/admin/product/deleteRecord/" + id;
   
    });
</script>
@endsection
