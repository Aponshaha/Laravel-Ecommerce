@extends('admin.layouts.app')

@section('content')

 <form class ="form-horizontal" role = "form" method="post" action="{{ url('admin/blog/store')}}">
      {!! csrf_field() !!}
   <div class = "form-group">
      <label for = "firstname" class = "col-sm-2 control-label">Title</label>
        
      <div class = "col-sm-10">
         <input type="text" required class ="form-control" name="post_title" >
      </div>
   </div>
   
  
   <div class = "form-group">
      <label for = "firstname" class = "col-sm-2 control-label">Content</label>
      <div class = "col-sm-10">                                                           
         <script type="text/javascript" src="{{ asset('public\libraries\tinymce\tinymce.min.js') }}"></script>
                    <script type="text/javascript">
                      tinymce.init({
                        selector : "textarea",
                        plugins : ["advlist autolink lists link image charmap print preview anchor", "searchreplace visualblocks code fullscreen", "insertdatetime media table contextmenu paste"],
                        toolbar : "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image"
                      }); 
                    </script>
         <textarea name='post_content' style="height:250px" class="text_input_area"></textarea>
      </div>
   </div>
   
   <div class = "form-group">
      <label for="parent" class = "col-sm-2 control-label">Category</label>
        
      <div class = "col-sm-10">
         <select name="category_row_id" class = "form-control" required>
             <option value="">Select Category</option>
         @foreach( $data['categories'] as $row)
          <option value="{{ $row->category_row_id}}">
               {{ $row->category_name }}

           </option>
          @endforeach
          
         </select>
      </div>
   </div>
  
   
   <div class = "form-group">
      <div class = "col-sm-offset-2 col-sm-10">
         <input type ="submit" class = "btn btn-default" value="SAVE" />
      </div>
   </div>
    
</form>
@endsection