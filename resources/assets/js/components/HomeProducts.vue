<template>
    <div class="container">    
  <div class="row">
    
    <div class="col-sm-4" v-for="product in products">
      <div class="panel panel-primary">
        <div class="panel-heading">BLACK FRIDAY DEAL111</div>
        <div class="panel-body"><img src="https://placehold.it/150x80?text=IMAGE" class="img-responsive" style="width:100%" alt="Image"></div>
        <div class="panel-footer">Buy 50 mobiles and get a gift card</div>
      </div>
    </div>
    <div class="col-sm-4"> 
      <div class="panel panel-danger">
        <div class="panel-heading">BLACK FRIDAY DEAL222222222222</div>
        <div class="panel-body"><img src="https://placehold.it/150x80?text=IMAGE" class="img-responsive" style="width:100%" alt="Image"></div>
        <div class="panel-footer">Buy 50 mobiles and get a gift card</div>
      </div>
    </div>
    <div class="col-sm-4"> 
      <div class="panel panel-success">
        <div class="panel-heading">BLACK FRIDAY DEAL333333333333</div>
        <div class="panel-body"><img src="https://placehold.it/150x80?text=IMAGE" class="img-responsive" style="width:100%" alt="Image"></div>
        <div class="panel-footer">Buyd 50005 mobiles and get a gift cardss</div>
      </div>
    </div>
  </div>
</div>
</template>
<script>
    export default {
      name: 'products',
      data() {
        return {
          products:[]
        }
      },
      methods:{
        fetchProducts() {
        fetch("http://localhost/lara/public/api/products")
            .then(function(response) {               
            });
        }
      },
      created: function() {
        this.fetchProducts();
      }
}
</script>
