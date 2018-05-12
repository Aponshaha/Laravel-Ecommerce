@extends('admin.layouts.app')
@section('content')
<div id="page-wrapper">
  <div class="row">
      <div class="col-lg-12">
          <h1 class="page-header">Category</h1>
      </div>
      <!-- /.col-lg-12 -->
  </div>
  <!-- /.row -->
  <div class="row">
    <div class="col-lg-12">
      <div class="panel panel-default">
          <div class="panel-heading">
                    Add Category
          </div>
          <div class="panel-body">
            <div class="row">                             
                {{ Form::open(array('url' => 'admin/category/store')) }}                             
                  <div class="col-lg-6">                                    
                    <div class="form-group">
                        <label>Category Name</label>
                        <input type="text"  class ="form-control" id="category_name" name="category_name" placeholder = "Enter category Name">
                       
                    </div>
                    <div class="form-group">
                        <label>Category</label>
                        <select name="parent_id" class = "form-control" required>
                          <option value="">Select</option>
                          <option value="0"> Main Category </option>
                          @foreach( $data['all_records'] as $row)
                          <option value="{{ $row->category_row_id}}">
                          @if($row->level == 0) <b>  @endif  

                          @if($row->level == 0) <b>  @endif 
                          @if($row->level == 1) &nbsp; - @endif   
                          @if($row->level == 2) &nbsp; &nbsp; - - @endif     
                          @if($row->level == 3) &nbsp; &nbsp; &nbsp; - - - @endif       
                          @if($row->level == 4) &nbsp; &nbsp; &nbsp; &nbsp; - - - - @endif       
                          @if($row->level == 5) &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;  - - - - - @endif       
                          @if($row->level > 5)  &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; - - - @endif

                          {{ $row->category_name }} 
                          @if($row->level == 0) </b>  @endif  
                          </option>
                          @endforeach
                        </select>
                    </div>                                   
                    <button type="submit" class="btn btn-success">SAVE</button>
                  </div>
                <!-- /.col-lg-6 (nested) -->
                <div class="col-lg-6">
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
      