

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
            <h3 class="box-title">Edit Product</h3>
          </div>
          <!-- /.box-header -->
          <form role="form" action="<?php base_url('users/update') ?>" method="post" enctype="multipart/form-data">
              <div class="box-body">

                <?php echo validation_errors(); ?>

                <div class="form-group">
                 
                  <img src="<?php echo base_url() . $product_data['image'] ?>" width="150" height="150" class="img-square">
                </div>

                <div class="form-group">
                  <label for="product_image">Update Image</label>
                  <div class="kv-avatar">
                      <div class="file-loading">
                          <input id="product_image" name="product_image" type="file">
                      </div>
                  </div>
                </div>

                <div class="form-group">
                  <label for="Added_Date">Product Added_Date</label>
                  <input type="text" class="form-control" id="Added_Date" name="Added_Date" readonly value="<?php echo $product_data['date']; ?>"  autocomplete="off"/>
                </div>
                  
                     <div class="form-group">
                  <label for="Number">Number</label>
                  <input type="text" class="form-control" id="Number" readonly name="Number"<?php if(!in_array('deleteProduct', $user_permission)): ?> readonly=""<?php endif ?> placeholder="Enter Number" value="<?php echo $product_data['Number']; ?> "autocomplete="off" />
                </div>
                <div class="form-group">
                  <label for="Design">Design</label>
                  <input type="text" class="form-control" id="Design" name="Design" <?php if(!in_array('deleteProduct', $user_permission)): ?> readonly=""<?php endif ?>placeholder="Enter Design" value="<?php echo $product_data['Design']; ?>" autocomplete="off" />
                </div>
                     <div class="form-group">
                  <label for="Barcode">Barcode</label>
                  <input type="text" class="form-control" id="Barcode"  name="Barcode" readonly placeholder="Enter Barcode" <?php if(!in_array('deleteProduct', $user_permission)): ?> readonly=""<?php endif ?> value="<?php echo $product_data['Barcode']; ?>"autocomplete="off" />
                </div>
                   <div class="form-group">
                  <label for="Barcode">Barcode2</label>
                  <input type="text" class="form-control" id="Barcode2"  name="Barcode2" placeholder="Enter Barcode" value="<?php echo $product_data['Barcode2']; ?>"autocomplete="off" />
                </div>
                  <?php //if(in_array('deleteProduct', $user_permission)): ?>
                <div class="form-group">
                  <label for="price">Price</label>
                  <input type="text" class="form-control" id="price" name="price" placeholder="Enter price" value="<?php echo $product_data['price']; ?>" autocomplete="off" />
                </div>
                  <?php// endif ?>
                  <div class="form-group">
                  <label for="size">Size(CBM)</label>
                  <input type="text" class="form-control" id="size" name="size" placeholder="Enter CBM" value="<?php echo $product_data['size']; ?>" autocomplete="off" />
                  </div>
                 
                  <div class="form-group">
                  <label for="Packing">Packing Per Carton</label>
                  <input type="text" class="form-control" id="Packing" name="Packing" placeholder="Enter Packing" value="<?php echo $product_data['packing']; ?>" autocomplete="off" />
                </div>
                  <div class="form-group">
                  <label for="qty">Qty</label>
                  <input type="text" class="form-control" <?php if(!in_array('deleteProduct', $user_permission)): ?> readonly=""<?php endif ?> id="qty" name="qty" placeholder="Enter Qty" value="<?php echo $product_data['qty']; ?>" autocomplete="off" />
                </div>

                <div class="form-group">
                  <label for="description">Description</label>
                  <textarea type="text" class="form-control"  style=  "font-size: 30px;color : red" dir="rtl" id="description" name="description" placeholder="Enter 
                  description" autocomplete="off">
                    <?php echo $product_data['description']; ?>
                  </textarea>
                </div>

              
                <div class="form-group">
                  <label for="brands">Items</label>
                  <?php  
                  if ($Production_data== 0){$brand_data = 0 ;}
 else {                  $brand_data = json_decode($Production_data['Material_ID']);}?>
                  <select  class="form-control select_group" disabled id="brands" name="brands[]" multiple="multiple" >
                    <?php foreach ($brands as $k => $v): ?>
                      <option   value="<?php echo $v['id'] ?>" <?php if(in_array($v['id'], $brand_data)) { echo 'selected="selected"'; } ?>><?php echo $v['name'] ?> </option>
                    <?php endforeach ?>
                  </select>
                </div>
   

                <div class="form-group">
                  <label for="store">Store</label>
                  <select class="form-control select_group" id="store" name="store">
                    <?php foreach ($stores as $k => $v): ?>
                      <option value="<?php echo $v['id'] ?>" <?php if($product_data['store_id'] == $v['id']) { echo "selected='selected'"; } ?> ><?php echo $v['name'] ?></option>
                    <?php endforeach ?>
                  </select>
                  
                </div>

                <div class="form-group">
                  <label for="store">Availability</label>
                  <select class="form-control" id="availability" name="availability">
                    <option value="1" <?php if($product_data['availability'] == 1) { echo "selected='selected'"; } ?>>Yes</option>
                    <option value="2" <?php if($product_data['availability'] != 1) { echo "selected='selected'"; } ?>>No</option>
                  </select>
                </div>

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
        layoutTemplates: {main2: '{preview}  {remove} {browse}'},
        allowedFileExtensions: ["jpg", "png", "gif"]
    });

  });
</script>