
<div class="wrapper">
  <!-- Main content -->
  <section class="invoice">
    <!-- title row -->
    <div class="row">
      <div class="col-xs-12">
        <h2 class="page-header" style="text-align:center;">
          <b>Invoice #{{sprintf('%06d',$data['order_by_id']->order_row_id)}}</b>
          
        </h2>
      </div>
      <!-- /.col -->
    </div>
    <!-- info row -->
    <table style="width: 100%">
      <tr>
        <td>
          From
        <address>
          <strong>Rupahali</strong><br>
          795 Folsom Ave, Suite 600<br>
          San Francisco, CA 94107<br>
          Phone: (+880) 123-5432<br>
          Email: info@rupahali.com
        </address>
        </td>
        <td>
          To
        <address>

          <strong>{{json_decode($data['order_by_id']->shiping_address)->name}}</strong><br>
           {{json_decode($data['order_by_id']->shiping_address)->address}}<br>
          Phone: {{json_decode($data['order_by_id']->shiping_address)->mobile}}<br>
          Email: {{json_decode($data['order_by_id']->shiping_address)->email}}
        </address>
        </td>
      </tr>
    </table>
    <div class="row invoice-info">
        <br>
        <b>Order ID:</b> ORD-{{sprintf('%06d',$data['order_by_id']->order_row_id)}}<br>
        <b>Order Date:</b> {{$data['order_by_id']->created_at}} <br>
    </div>
    <!-- /.row -->

    <!-- Table row -->
    <div class="row">
      <div class="col-xs-12 table-responsive">
        <table class="table table-striped" style="width:100%">
           <caption style="font-size:25px">Order Details</caption>
          <thead>

          <tr>
             <th>Product</th>
            <th>Qty</th>
            <th>Unit Price</th>
            <th>Subtotal</th>
          </tr>
          </thead>
          <tbody>
            @foreach(json_decode($data['order_by_id']->order_details) as $od)
                    <tr>
                      <td>
                        {{$od->product_name}}<br>
                       
                      </td>
                      <td>{{$od->product_qty}}</td>
                      <td>{{$od->product_price}}</td>
                      <td>{{$od->product_qty*$od->product_price}}</td>
                    </tr>
                    
                   
                       @endforeach
            

          </tbody>
        </table>
      </div>
      <!-- /.col -->
    </div>
    <!-- /.row -->

<br>
<table style="width: 100%">
  <tr>
    <td style="text-align:right;">
      <table class="table">
            <tr>
              <th style="width:50%">Subtotal:</th>
              <td>{{$data['order_by_id']->total_price}}</td>
            </tr>
            
            <tr>
              <th>Shipping:</th>
              <td>180</td>
            </tr>
            <tr>
              <th>Total:</th>
              <td>{{$data['order_by_id']->total_price+180}}</td>
            </tr>
          </table>
    </td>
  </tr>
</table>
   

  </section>
  <!-- /.content -->
</div>
<!-- ./wrapper -->
