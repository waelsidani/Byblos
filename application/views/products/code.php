

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      Manage
      <small>Products</small>
    </h1>
    <ol class="breadcrumb">
      <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
      <li class="active">Products</li>
    </ol>
  </section>

  <!-- Main content -->
  <section class="content">
    <!-- Small boxes (Stat box) -->
    <div class="row">
      <div class="col-md-12 col-xs-12">

        <div id="messages"></div>

        <?php if($this->session->flashdata('success')): ?>
          <div class="alert alert-success alert-dismissible" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <?php echo $this->session->flashdata('success'); ?>
          </div>
        <?php elseif($this->session->flashdata('error')): ?>
          <div class="alert alert-error alert-dismissible" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <?php echo $this->session->flashdata('error'); ?>
          </div>
        <?php endif; ?>


        <div class="box">
          <div class="box-header">
            <h3 class="box-title">Add Product</h3>
          </div>
          <!-- /.box-header -->
          <form role="form" action="<?php base_url('users/code') ?>" method="post" enctype="multipart/form-data">
              <div class="box-body">

                <?php echo validation_errors(); ?>
<div class="form-group">

                
               
               
     <div class="form-group">
                  <label for="P_number">Product Category / نوع المنتج </label>
                   <?php 
                    $product_code = $this->model_products->Productcategorycode();
                   ?>
                 <div> <select class="form-control select_group" name="P_Cat" id="P_Cat"style="width : 400px" onchange="getcode()" >
                         <option></option>
                     <?php foreach ($product_code as $k => $v): ?>
                   
                       <option value="<?php echo $v['id'] ?>" ><?php echo $v['category']?></option>
                    <?php endforeach ?>
                  </select>
                    
                  </div>
                </div>
                   <div class="form-group">
                  <label for="Number">Start Code Number</label>
                  <input type="text" class="form-control" id="Number" name="Number"  autocomplete="off" />
                
                   </div>
    
                  <div class="form-group">
                  <label for="Barcode2">Ended Code Number</label>
                  <input type="text" class="form-control" id="Number2" name="Number2"  autocomplete="off" />
                
                  </div>
              
              <!-- /.box-body -->

              <div class="box-footer">
                <button type="submit" class="btn btn-primary">Save Changes</button>
                <a href="<?php echo base_url('products/') ?>" class="btn btn-warning">Back</a>
              </div>
            
          </div>
                  </div>
              </form>
          <!-- /.box-body -->
        </div>
        <!-- /.box -->
      </div>
      <!-- col-md-12 -->
    </div>
    <!-- /.row -->
    

  </section>
  <!-- /.content -->
</div>
<!-- /.content-wrapper -->

<script type="text/javascript">
  $(document).ready(function() {
    $(".select_group").select2();
    $("#description").wysihtml5();
 
    $("#mainProductNav").addClass('active');
    $("#addProductNav").addClass('active');
    
    var btnCust = '<button type="button" class="btn btn-secondary" title="Add picture tags" ' + 
        'onclick="alert(\'Call your custom code here.\')">' +
        '<i class="glyphicon glyphicon-tag"></i>' +
        '</button>'; 

window.addEventListener("paste", e => {
        if (e.clipboardData.files.length > 0)
        {const fileInput = document.querySelector("#product_image");
            fileInput.files = e.clipboardData.files;
              setPreviewImage(e.clipboardData.files[0]);
        }}); function setPreviewImage(file)
    {if ( /\.(jpe?g|png|gif)$/i.test(file.name) ) {
            const fileReader = new FileReader();
        fileReader.readAsDataURL(file);
        fileReader.onload = () => {
            document.querySelector ("#imagepreview").src = fileReader.result;
        };
    }}

    $("#product_image").fileinput({
        overwriteInitial: true,
        maxFileSize: 15000,
        showClose: false,
        showCaption: false,
        browseLabel: '',
        removeLabel: '',
        browseIcon: '<i class="glyphicon glyphicon-folder-open"></i>',
        removeIcon: '<i class="glyphicon glyphicon-remove"></i>',
        removeTitle: 'Cancel or reset changes',
        elErrorContainer: '#kv-avatar-errors-1',
        msgErrorClass: 'alert alert-block alert-danger',
        // defaultPreviewContent: '<img src="/uploads/default_avatar_male.jpg" alt="Your Avatar">',
        layoutTemplates: {main2: '{preview} ' +  btnCust + ' {remove} {browse}'},
        allowedFileExtensions: ["jpg", "png", "gif"]
    });

  });
  function getcode()
  {
      
       
      var product_id = $("#P_Cat").val(); 
      product_id = Number(product_id);
      var base_url = "<?php echo base_url(); ?>";
    { 
      $.ajax({
        url: base_url + 'Products/getcatValueById/' + product_id,
        type: 'post',
       data: {product_id : product_id},
        dataType: 'json',
        success:function(response) {
          // setting the direct value into the direct input field
          
        
          
$("#Number").val(response.code);

        $("#Number2").val(response.ended_code);  
        } // /success
      }); // /ajax function to fetch the product data 
    }
    { 
      $.ajax({
        url: base_url + 'Products/getbarcodeValueById/',
        type: 'post',
       
        dataType: 'json',
        success:function(response2) {
          // setting the direct value into the direct input field
          
$("#Barcode").val(response2.barcode);
          $("#Barcodeid").val(response2.id);
        } // /success
      }); // /ajax function to fetch the product data 
    }
  }

</script>