

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      Manage
      Raw Material
    </h1>
    <ol class="breadcrumb">
      <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
      <li class="active">Brands</li>
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

        <?php if(in_array('createBrand', $user_permission)): ?>
          <button class="btn btn-primary" data-toggle="modal" data-target="#addBrandModal">Add Item</button>
          <br /> <br />
        <?php endif; ?>

        <div class="box">
          <div class="box-header">
            <h3 class="box-title">Manage Raw Material</h3>
          </div>
          <!-- /.box-header -->
          <div class="box-body">
            <table id="manageTable" class="table table-bordered table-striped">
              <thead>
              <tr>
                <th >Material Name</th>
                <th  >Code</th>
                <th  >Quantity</th>
             
                <?php if(in_array('updateBrand', $user_permission) || in_array('deleteBrand', $user_permission)): ?>
                  <th >Action</th>
                <?php endif; ?>
              </tr>
              </thead>

            </table>
          </div>
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

<?php if(in_array('createBrand', $user_permission)): ?>
<!-- create brand modal -->
<div class="modal fade" tabindex="-1" role="dialog" id="addBrandModal">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Add Item</h4>
      </div>

      <form role="form" action="<?php echo base_url('brands/create') ?>" method="post" id="createBrandForm">
 
        <div class="modal-body">

          <div class="form-group">
              
              
               
            <label for="brand_name">Item Name</label>
            <input type="text" class="form-control" id="brand_name" name="brand_name" placeholder="Enter brand name" autocomplete="off">
            <label for="brand_Code">Code</label>
            <input type="text" class="form-control" id="brand_Code" name="brand_Code" placeholder="Enter Code" autocomplete="off">
            <label for="brand_Quantity">Quantity</label>
            <input type="text" step=".0001" class="form-control" id="brand_Quantity" name="brand_Quantity" placeholder="Enter Quantity" autocomplete="off">
            <label for="brand_Size">Original Code</label>
            <input type="text" step=".0001"class="form-control" id="brand_Size" name="brand_Size" placeholder="Enter Size" autocomplete="off">
            <label for="brand_Price">Price</label>
            <input type="text"step=".0001" class="form-control" id="brand_Price" name="brand_Price" placeholder="Enter Item Price" autocomplete="off"> 
            <label for="brand_MQnty">Minimum Quantity Allowed</label>
            <input type="text" step=".0001" class="form-control" id="brand_MQnty" name="brand_MQnty" placeholder="Enter Item Minimum Quantity" autocomplete="off">
            <label for="brand_Material">Material</label>
            <input type="text" class="form-control" id="brand_Material" name="brand_Material" placeholder="Enter Item Price" autocomplete="off">
            <label for="brand_Packing">Packing</label>
            <input type="text" class="form-control" id="brand_Packing" name="brand_Packing" placeholder="Enter Item Price" autocomplete="off">
            <label for="brand_BarCode">Bar Code</label>
            <input type="text" class="form-control" id="brand_BarCode" name="brand_BarCode" placeholder="Enter Item Price" autocomplete="off">      
            <label for="brand_Des">Country of Production</label>
            <input type="text" class="form-control" id="brand_Des" name="brand_Des" placeholder="Write a Description" autocomplete="off">
          </div>
            
            <?php
          $mysqli2 = NEW MySQLi('localhost','root','','stock');
          $resultSet2 = $mysqli2->query("SELECT name FROM Supplier WHERE  ACTIVE = '1'");
          ?>
            <div class="form-group">
            <label for="Supplier_ID">Supplier</label>
            <select class="form-control" id="Supplier_ID" name="Supplier_ID">
              
               <?php while($rows = $resultSet2->fetch_assoc())
                    {
                       $name = $rows['name'] ;
                       echo "<option value='$name'>$name</option>";
                    }
                   ?>
            </select>
          </div>
           <?php
          $mysqli = NEW MySQLi('localhost','root','','stock');
          $resultSet = $mysqli->query("SELECT name , id FROM stores WHERE  ACTIVE = '1'");
          ?>
                 
             <div class="form-group">
                  <label for="Store_ID">Store</label>
                  <select class="form-control" id="Store_ID" name="Store_ID">
                      <?php while($rows = $resultSet->fetch_assoc())
                    {
                            $ID7 =  $rows['id'];
                       $name = $rows['name'] ;
                       echo "<option value='$ID7'>$name</option>";
                    }
                   ?>
                    
                  </select>
                </div>
            
          <div class="form-group">
            <label for="active">Status</label>
            <select class="form-control" id="active" name="active">
              <option value="1">Active</option>
              <option value="2">Inactive</option>
            </select>
          </div>
            <div class="form-group">
     
           
             
                 
                </div>
            
            
          
        </div>
 
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary">Save changes</button>
        </div>

      </form>


    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<?php endif; ?>

<?php if(in_array('updateBrand', $user_permission)): ?>
<!-- edit brand modal -->
<div class="modal fade" tabindex="-1" role="dialog" id="editBrandModal">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Edit Brand</h4>
      </div>

      <form role="form" action="<?php echo base_url('brands/update') ?>" method="post" id="updateBrandForm">
 <button type="submit" class="btn btn-primary">Save changes</button>
        <div class="modal-body">
          <div id="messages"></div>

          <div class="form-group">
             <label for="edit_brand_name">Item Name</label>
            <input type="text" class="form-control" id="edit_brand_name" name="edit_brand_name" placeholder="Enter brand name" autocomplete="off">
            <label for="edit_brand_Code">Code</label>
            <input type="text" class="form-control" id="edit_brand_Code" name="edit_brand_Code" placeholder="Enter Code" autocomplete="off">
            <label for="edit_brand_Quantity">Quantity</label>
            <input type="text"step=".0001" class="form-control" id="edit_brand_Quantity" name="edit_brand_Quantity" placeholder="Enter Quantity" autocomplete="off">
            <label for="edit_brand_Size">Original Code</label>
            <input type="text" step=".0001"class="form-control" id="edit_brand_Size" name="edit_brand_Size" placeholder="Enter Size" autocomplete="off">
            <label for="edit_brand_Price">Price</label>
            <input type="text" class="form-control" id="edit_brand_Price" name="edit_brand_Price" placeholder="Enter Item Price" autocomplete="off"> 
            <label for="edit_brand_MQnty">Minimum Quantity Allowed</label>
            <input type="text"step=".0001" class="form-control" id="edit_brand_MQnty" name="edit_brand_MQnty" placeholder="Enter Item Minimum Quantity" autocomplete="off">
            <label for="edit_brand_Material">Material</label>
            <input type="text" class="form-control" id="edit_brand_Material" name="edit_brand_Material" placeholder="Enter Item Price" autocomplete="off">
            <label for="edit_brand_Packing">Packing</label>
            <input type="text" class="form-control" id="edit_brand_Packing" name="edit_brand_Packing" placeholder="Enter Item Price" autocomplete="off">
            <label for="edit_brand_BarCode">Bar Code</label>
            <input type="text" class="form-control" id="edit_brand_BarCode" name="edit_brand_BarCode" placeholder="Enter Item Price" autocomplete="off">      
          </div>
            <div class="form-group">
            <label for="edit_Supplier_ID">Supplier</label>
            <select class="form-control" id="edit_Supplier_ID" name="edit_Supplier_ID">
              
               <option value="0">SELECT</option>
               
               
              <option value="2">2</option>
            </select>
          </div>
           <?php
          $mysqli = NEW MySQLi('localhost','root','','stock');
          $resultSet = $mysqli->query("SELECT name, id FROM stores WHERE  ACTIVE = '1'");
          ?>
                   
                    
                  
             <div class="form-group">
                  <label for="edit_Store_ID">Store</label>
                  <select class="form-control" id="edit_Store_ID" name="edit_Store_ID">
                      <?php while($rows = $resultSet->fetch_assoc())
                    {
                       $name = $rows['name'] ;
                     $ID6 =  $rows['id'];
                       echo "<option value='$ID6'>$name</option>";
                    }
                   ?>
                    
                  </select>
                </div>
          <div class="form-group">
            <label for="edit_active">Status</label>
            <select class="form-control" id="edit_active" name="edit_active">
              <option value="1">Active</option>
              <option value="2">Inactive</option>
            </select>
          </div>
          
          <div class="form-group">
     
            <label for="edit_brand_Des">Description</label>
            <input type="text" class="form-control" id="edit_brand_Des" name="edit_brand_Des" placeholder="Righ a Description" autocomplete="off">
             
                 
                </div>
            <div class="form-group">
     </div>
            
            
          
        </div>
 
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary">Save changes</button>
        </div>

      </form>


    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<?php endif; ?>

<?php if(in_array('deleteBrand', $user_permission)): ?>
<!-- remove brand modal -->
<div class="modal fade" tabindex="-1" role="dialog" id="removeBrandModal">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Remove Brand</h4>
      </div>

      <form role="form" action="<?php echo base_url('brands/remove') ?>" method="post" id="removeBrandForm">
        <div class="modal-body">
          <p>Do you really want to remove?</p>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary">Save changes</button>
        </div>
      </form>


    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<?php endif; ?>



<script type="text/javascript">
var manageTable;

$(document).ready(function() {

  $("#brandNav").addClass('active');

  // initialize the datatable 
  manageTable = $('#manageTable').DataTable({
    'ajax': 'fetchBrandData',
    'order': []
  });

  // submit the create from 
  $("#createBrandForm").unbind('submit').on('submit', function() {
    var form = $(this);

    // remove the text-danger
    $(".text-danger").remove();

    $.ajax({
      url: form.attr('action'),
      type: form.attr('method'),
      data: form.serialize(), // /converting the form data into array and sending it to server
      dataType: 'json',
      success:function(response) {

        manageTable.ajax.reload(null, false); 

        if(response.success === true) {
          $("#messages").html('<div class="alert alert-success alert-dismissible" role="alert">'+
            '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>'+
            '<strong> <span class="glyphicon glyphicon-ok-sign"></span> </strong>'+response.messages+
          '</div>');


          // hide the modal
          $("#addBrandModal").modal('hide');

          // reset the form
          $("#createBrandForm")[0].reset();
          $("#createBrandForm .form-group").removeClass('has-error').removeClass('has-success');

        } else {

          if(response.messages instanceof Object) {
            $.each(response.messages, function(index, value) {
              var id = $("#"+index);

              id.closest('.form-group')
              .removeClass('has-error')
              .removeClass('has-success')
              .addClass(value.length > 0 ? 'has-error' : 'has-success');
              
              id.after(value);

            });
          } else {
            $("#messages").html('<div class="alert alert-warning alert-dismissible" role="alert">'+
              '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>'+
              '<strong> <span class="glyphicon glyphicon-exclamation-sign"></span> </strong>'+response.messages+
            '</div>');
          }
        }
      }
    }); 

    return false;
  });


});

function editBrand(id)
{ 
  $.ajax({
    url: 'fetchBrandDataById/'+id,
    type: 'post',
    dataType: 'json',
    success:function(response) {

      $("#edit_brand_name").val(response.name);
      $("#edit_brand_Size").val(response.Size);
      $("#edit_brand_Code").val(response.Code);
      $("#edit_brand_Price").val(response.Price);
      $("#edit_Supplier_ID").val(response.Supplier_ID);
      $("#edit_Store_ID").val(response.Store_ID);
      $("#edit_brand_Packing").val(response.Packing);
      $("#edit_brand_Quantity").val(response.Quantity);
      $("#edit_brand_Des").val(response.Des);
      $("#edit_brand_BarCode").val(response.BarCode);
      $("#edit_brand_Material").val(response.Material);
      $("#edit_brand_MQnty").val(response.MQnty);
      $("#edit_active").val(response.active);

      // submit the edit from 
      $("#updateBrandForm").unbind('submit').bind('submit', function() {
        var form = $(this);

        // remove the text-danger
        $(".text-danger").remove();

        $.ajax({
          url: form.attr('action') + '/' + id,
          type: form.attr('method'),
          data: form.serialize(), // /converting the form data into array and sending it to server
          dataType: 'json',
          success:function(response) {

            manageTable.ajax.reload(null, false); 

            if(response.success === true) {
              $("#messages").html('<div class="alert alert-success alert-dismissible" role="alert">'+
                '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>'+
                '<strong> <span class="glyphicon glyphicon-ok-sign"></span> </strong>'+response.messages+
              '</div>');


              // hide the modal
              $("#editBrandModal").modal('hide');
              // reset the form 
              $("#updateBrandForm .form-group").removeClass('has-error').removeClass('has-success');

            } else {

              if(response.messages instanceof Object) {
                $.each(response.messages, function(index, value) {
                  var id = $("#"+index);

                  id.closest('.form-group')
                  .removeClass('has-error')
                  .removeClass('has-success')
                  .addClass(value.length > 0 ? 'has-error' : 'has-success');
                  
                  id.after(value);

                });
              } else {
                $("#messages").html('<div class="alert alert-warning alert-dismissible" role="alert">'+
                  '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>'+
                  '<strong> <span class="glyphicon glyphicon-exclamation-sign"></span> </strong>'+response.messages+
                '</div>');
              }
            }
          }
        }); 

        return false;
      });

    }
  });
}

function removeBrand(id)
{
  if(id) {
    $("#removeBrandForm").on('submit', function() {

      var form = $(this);

      // remove the text-danger
      $(".text-danger").remove();

      $.ajax({
        url: form.attr('action'),
        type: form.attr('method'),
        data: { brand_id:id }, 
        dataType: 'json',
        success:function(response) {

          manageTable.ajax.reload(null, false); 

          if(response.success === true) {
            $("#messages").html('<div class="alert alert-success alert-dismissible" role="alert">'+
              '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>'+
              '<strong> <span class="glyphicon glyphicon-ok-sign"></span> </strong>'+response.messages+
            '</div>');

            // hide the modal
            $("#removeBrandModal").modal('hide');

          } else {

            $("#messages").html('<div class="alert alert-warning alert-dismissible" role="alert">'+
              '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>'+
              '<strong> <span class="glyphicon glyphicon-exclamation-sign"></span> </strong>'+response.messages+
            '</div>'); 
          }
        }
      }); 

      return false;
    });
  }
}


</script>
