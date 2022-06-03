

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
          <form role="form" action="<?php base_url('users/create') ?>" method="post" enctype="multipart/form-data">
              <div class="box-body">

                <?php echo validation_errors(); ?>
<div class="form-group">

                  <div class="form-group">
                 
                      <img id="imagepreview"  width="200" height="200" class="img-Thumbnail">
               
                </div>
                <div class="form-group">

                  <label for="product_image">Image</label>
                  <div class="kv-avatar">
                      <div class="file-loading">
                          <input id="product_image" name="product_image" type="file">
                      </div>
                  </div>
                </div>

                <div class="form-group">
                  <label for="Added_Date">Product Added_Date</label>
                  <input type="text" class="form-control" id="Added_Date" name="Added_Date" readonly value= "<?php echo date('Y-m-d') ?>"autocomplete="off"/>
                </div>
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
                    <label>Add Product Manual</label>
                  <input type="checkbox" name="add_manual" id="add_manual"  />
<script>document.getElementById('add_manual').onchange = function()
                   {if (this.checked) 
            {
                        
                        document.getElementById('add_manual').disabled="true";
                         document.getElementById('P_Cat').disabled="true";
                        $("#Number").removeAttr("readonly");
                        $("#Barcode").removeAttr("readonly");
                       document.getElementById('Number').value="0";  
                       document.getElementById('Barcode').value="0";  
                    }}
</script>
               
                  </div>
                </div>
                   <div class="form-group">
                  <label for="Number">Number</label>
                  <input type="text" class="form-control" id="Number" name="Number" readonly="true" placeholder="Enter Number" autocomplete="off" />
                <input type="hidden" class="form-control" id="Numberid" name="Numberid" readonly placeholder="Enter Number" autocomplete="off" />
               
                   </div>
                <div class="form-group">
                  <label for="Design">Design</label>
                  <input type="text" class="form-control" value="0" id="Design" name="Design" placeholder="Enter Design" autocomplete="off" />
                </div>
    
                <div class="form-group">
                  <label for="Barcode">Barcode</label>
                  <input type="text" class="form-control" id="Barcode" readonly name="Barcode" placeholder="Enter Barcode" autocomplete="off" />
                <input type="hidden" class="form-control" id="Barcodeid" readonly name="Barcodeid" placeholder="Enter Barcode" autocomplete="off" />
               
                </div>
                  <div class="form-group">
                  <label for="Barcode2">Barcode2</label>
                  <input type="text" class="form-control" id="Barcode2" name="Barcode2" value="0" autocomplete="off" />
                
                  </div>
                <div class="form-group">
                  <label for="price">Price</label>
                  <input type="text" class="form-control" value="0" id="price" name="price" placeholder="Enter price" autocomplete="off" />
                </div>
                <div class="form-group">
                  <label for="size">Size(CBM)</label>
                  <input type="text" class="form-control" id="size" value="0" name="size" placeholder="Enter CBM" autocomplete="off" />
                </div>
                  <div class="form-group">
                  <label for="Packing">Packing Per Carton</label>
                  <input type="text" class="form-control" value="1" id="Packing" name="Packing" placeholder="Enter Packing" autocomplete="off" />
                </div>
                <div class="form-group">
                  <label for="qty">Qty</label>
                  <input type="text" class="form-control" id="qty" value="0" name="qty" placeholder="Enter Qty" autocomplete="off" />
                </div>

                <div class="form-group">
                  <label for="description">Description</label>
                  <textarea type="text" style=  "font-size: 30px;color : red" dir="rtl" class="form-control" id="description" name="description" placeholder="Enter 
                  description" autocomplete="off">
                  </textarea>
                </div>
                  
               
                

                <div class="form-group">
                  <label for="store">Store</label>
                  <select class="form-control select_group" id="store" name="store">
                    <?php foreach ($stores as $k => $v): ?>
                      <option value="<?php echo $v['id'] ?>"><?php echo $v['name'] ?></option>
                    <?php endforeach ?>
                  </select>
                </div>

                <div class="form-group">
                  <label for="store">Availability</label>
                  <select class="form-control" id="availability" name="availability">
                    <option value="1">Yes</option>
                    <option value="2">No</option>
                  </select>
                </div>

              </div>
              <!-- /.box-body -->

              <div class="box-footer">
                <button type="submit" class="btn btn-primary">Save Changes</button>
                <a href="<?php echo base_url('products/') ?>" class="btn btn-warning">Back</a>
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
    $("#manageProductNav").addClass('active');
    
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
          
         var code= response.code;
         total = Number(code) + 1;
          
$("#Number").val(total);
$("#Numberid").val(response.id);
          
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