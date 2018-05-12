@extends('admin.layouts.app')

@section('content')
<div id="page-wrapper">
  <div class="row">
      <div class="col-lg-12">
          <h1 class="page-header">Categories List</h1>
      </div>
      <!-- /.col-lg-12 -->
  </div>
  <!-- /.row -->
  <div class="row">
      <div class="col-lg-12">
          <div class="panel panel-default">
              <div class="panel-heading">
                  Category
              </div>
              <!-- /.panel-heading -->
            <div class="panel-body">
               <table width="100%" class="table table-striped table-bordered table-hover dataTables">
                          <thead>
                              <tr>
                                <th>Category Name</th>
                                <th>Action</th>
                              </tr>
                          </thead>
                 <tbody>  
                      @foreach($data['all_records'] as $row)    
                     <tr>            
                        <td> 
                         @if($row->level == 0) <b>  @endif 
                         @if($row->level == 1) &nbsp; - @endif   
                         @if($row->level == 2) &nbsp; &nbsp; - - @endif     
                         @if($row->level == 3) &nbsp; &nbsp; &nbsp; - - - @endif       
                         @if($row->level == 4) &nbsp; &nbsp; &nbsp; &nbsp; - - - - @endif       
                         @if($row->level == 5) &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;  - - - - - @endif       
                         @if($row->level > 5)  &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; - - - @endif
                         
                         {{ $row->category_name }} 
                         @if($row->level == 0) </b>  @endif 
                         </td> 
                        
                        <td>
                          <button onclick="window.location='{{ url('/')}}/admin/category/edit/{{$row->category_row_id}}'" class="btn btn-warning mb-2">Edit</button>
                          @if( !$row->has_child )  
                          <button deleteID="{{$row->category_row_id}}"  class="btn btn-danger deleteLink">Delete</button>
                          @endif
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

@section('page_level_js')
<script type="text/javascript"> 
 $('.deleteLink').click( function() {
  if( confirm('Are you sure to Delete ? ') )
  {
   var deleteID = $(this).attr('deleteID');   
    window.location.href = "{{ url('/')}}/admin/category/deleteRecord/" + deleteID;    
  }
        
 });
 
 </script> 
@endsection
