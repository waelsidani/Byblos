

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      Manage Attributes
      <small>Value</small>
    </h1>
    <ol class="breadcrumb">
      <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
      <li class="active"><a href="<?php echo base_url('attributes/') ?>">Attributes</a></li>
      <li class="active">Attributes Value</li>
    </ol>
  </section>

  <!-- Main content -->
  <section class="content">
    <!-- Small boxes (Stat box) -->
    <div class="row">
      <div class="col-md-12 col-xs-12">

        <div class="box">
          <div class="box-body">
            <h4>Attribute name: <?php echo $attribute_data['name']; ?></h4>
          </div>
        </div>

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

        <?php //if(in_array('createGroup', $user_permission)): ?>
          <button class="btn btn-primary" data-toggle="modal" data-target="#addModal">Add Value</button>
          <br /> <br />
        <?php //endif; ?>


        <div class="box">
          <div class="box-header">
            <h3 class="box-title">Manage Attributes Value</h3>
          </div>
          <!-- /.box-header -->
          <div class="box-body">
            <table id="manageTable" class="table table-bordered table-striped">
              <thead>
              <tr>
                <th>Attribute Value</th>
                <?php //if(in_array('updateGroup', $user_permission) || in_array('deleteGroup', $user_permission)): ?>
                  <th>Action</th>
                <?php //endif; ?>
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


<!-- create brand modal -->
<div class="modal fade" tabindex="-1" role="dialog" id="addModal">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Add Attribute Value</h4>
      </div>

      <form role="form"  action="<?php echo base_url('attributes/createValue') ?>" method="post" id="createForm">

        <div class="modal-body">
          <div class="form-group">
            <label for="attribute_value_name">Attribute Name</label>
            <input type="text" class="form-control" id="attribute_value_name" name="attribute_value_name" placeholder="Enter attribute value" autocomplete="off">
          </div>
             <div class="form-group">
            <label for="attribute_value_costpQnt">Direct Cost per Set/Pcs/</label>
            <input  type="text" class="form-control" id="attribute_value_costpQnt" readonly name="attribute_value_costpQnt">
               </div>
            <div class="form-group">
          <label for="attribute_value_Pro_day">Indirect Cost</label>
          <input type="text" class="form-control"  id="attribute_value_Pro_day"readonly name="attribute_value_Pro_day">
              </div>
 <?php
          $mysqli = NEW MySQLi('localhost','root','','stock');
          $resultSet = $mysqli->query("SELECT * FROM brands WHERE  Store_ID <> 'Main Store'");
           $resultRaw = $mysqli->query("SELECT * FROM brands WHERE  Store_ID <> 'Main Store'");
          ?>
                   
                    
                  
             <div class="form-group">
                  <label >Material</label>
                  <select class="form-control " style="width: 100%" id="Raw_M" name="Raw_M" onchange="calc()">
                      <option value=""></option>
                      <?php while($rows = $resultSet->fetch_assoc())
                    {
                         $Price = $rows['Price'] ; 
                       $name = $rows['name'] ;
                       $Code= $rows['Code'];
                       echo "<option value='$Price'>$Code--$name</option>";
                    }
                    
                   ?>
                      
                  </select>
                                      </div>
            
            <div class="form-group">
                  <select id="Raw_ID"  disabled="true" name="Raw_ID">
                      <?php while($rows = $resultRaw->fetch_assoc())
                    {  $Id2 = $rows['id'];
                       $name2 = $rows['name'] ;
                       $Code= $rows['Code'];
                       echo "<option value='$Code--$name2'>$Id2</option>";
                    }
                    
                   ?>
                      
                  </select>
                  <input type="hidden" class="form-control"  id="MaterialID" name="MaterialID" >
                 
                    
              
                    </div>
                   <?php
          $mysqli2 = NEW MySQLi('localhost','root','','stock');
          $resultSet9 = $mysqli2->query("SELECT * FROM workshop");
          $resultSet2 = $mysqli2->query("SELECT * FROM workshop");
           
          ?>
                   
                    
                  
             <div class="form-group">
                  <label for="Workshop">Workshop</label>
                  <select class="form-control  "  id="Workshop" name="Workshop" onchange="calc()">
                      <?php while($rows = $resultSet2->fetch_assoc())
                    {
                         $Id = $rows['indirect'];
                          $Id1 = $rows['id'];
                       $namew = $rows['name'] ;
                       
                       echo "<option value='$Id'>$namew</option>";
                    }
                   
                   ?>
                      <script>
                    $( "select" ) .change(function () {  
                    $("#Workshop2").val($("#Workshop option:selected").text()).change();
                    });  
                      </script>
                  </select>
                  <select  id="Workshop2"  disabled="true" name="Workshop2">
                      <?php while($rows = $resultSet9->fetch_assoc())
                    {  $Id1 = $rows['id'];
                       $namew = $rows['name'] ;
                       echo "<option value='$namew'>$Id1</option>";
                    }
                    
                   ?>
                      <script>
                    $( "select" ) .change(function () {  
                    $("#WorkshopID").val($("#Workshop2 option:selected").text()).change();
                    });  
                     
                      </script>
                  </select>
                  <input type="hidden" class="form-control"  id="WorkshopID" name="WorkshopID" >
                 
                 
                  </div>
                 <div class="form-group">
                  <label for="attribute_value_Quantity">Quantity per Set/Piece</label>
                  <input  type="text" class="form-control" id="attribute_value_Quantity" name="attribute_value_Quantity"  onchange="calc()">
              </div>
             <div class="form-group">
                  <label for="attribute_value_Quantity_set">Production per Day</label>
                  <input type="text" class="form-control" id="attribute_value_Quantity_set" name="attribute_value_Quantity_set" onchange="calc()" >
                 </div>
 
               
          </div>  
        <div class="modal-footer">
          <input type="hidden" name="attribute_parent_id" id="attribute_parent_id" value="<?php echo $attribute_data['id']; ?>">
          <input type="hidden" name="attribute_parent_name" id="attribute_parent_name" value="<?php echo $attribute_data['name']; ?>">
         
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary">Save changes</button>
        </div>

      </form>


    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<!-- edit brand modal -->
<div class="modal fade" tabindex="-1" role="dialog" id="editModal">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Edit Attribute Value</h4>
      </div>

        <form role="form" onmousemove="calc()" action="<?php echo base_url('attributes/updateValue') ?>" method="post" id="updateForm">

        
          <div class="modal-body" >
          <div class="form-group">
            <label for="edit_attribute_value_name">Attribute Name</label>
            <input type="text" class="form-control" id="edit_attribute_value_name" name="edit_attribute_value_name" placeholder="Enter attribute value" autocomplete="off">
          </div>
             <div class="form-group">
            <label for="edit_attribute_value_costpQnt">Direct Cost per Set/Pcs/</label>
            <input type="text" class="form-control" id="edit_attribute_value_costpQnt" readonly name="edit_attribute_value_costpQnt">
               </div>
            <div class="form-group">
          <label for="edit_attribute_value_Pro_day">Indirect Cost</label>
          <input type="text" class="form-control" id="edit_attribute_value_Pro_day" readonly name="edit_attribute_value_Pro_day">
              </div>
 <?php
          $mysqli5 = NEW MySQLi('localhost','root','','stock');
          $resultSet5 = $mysqli5->query("SELECT id , name,Price FROM brands WHERE  Store_ID <> 'Main Store'");
           $resultSet6 = $mysqli5->query("SELECT id , name,Price FROM brands WHERE  Store_ID <> 'Main Store'");
          
          ?>
                   
                    
             <div class="form-group">
                  <label >Material</label>
                  <br>
                  <select class="form-control select_group" id="edit_Raw_M" name="edit_Raw_M" onchange="calc()" style="width: 100%">
                      <option value=""></option>
                      <?php while($rows = $resultSet5->fetch_assoc())
                    {
                         $Price = $rows['Price'] ; 
                       $name = $rows['name'] ;
                       echo "<option value='$Price'>$name</option>";
                    }
                    
                   ?>
                     
                  </select>
                   </div>
              <div class="form-group">
                  <select  id="edit_Raw_ID"   disabled="true" name="edit_Raw_ID">
                      <?php while($rows = $resultSet6->fetch_assoc())
                    {  $Id2 = $rows['id'];
                       $name2 = $rows['name'] ;
                       echo "<option value='$name2'>$Id2</option>";
                    }
                    
                   ?>
                     
                  </select>
                  <input type="hidden" class="form-control"  id="edit_MaterialID" name="edit_MaterialID" >
                 
                    </div>
                   <?php
          $mysqli3 = NEW MySQLi('localhost','root','','stock');
          $resultSet3 = $mysqli3->query("SELECT * FROM workshop ");
          $resultSet33 = $mysqli3->query("SELECT * FROM workshop ");
          ?>
                   
                    
                  
             <div class="form-group">
                  <label for="edit_Workshop">Workshop</label>
                  <select class="form-control " id="edit_Workshop" name="edit_Workshop" onchange="calc()" >
                      <?php while($rows = $resultSet3->fetch_assoc())
                    {
                         $Ind = $rows['indirect'] ; 
                       $namew = $rows['name'] ;  
                       echo "<option value='$Ind'>$namew</option>";
                    }
                    
                   ?>
                     <script>
                    $( "select" ) .change(function () {  
                    $("#edit_Workshop2").val($("#edit_Workshop option:selected").text()).change();
                    });  
                      </script>
                  </select>
                  <select class="form-control " id="edit_Workshop2" disabled="true" name="edit_Workshop2">
                      <?php while($rows = $resultSet33->fetch_assoc())
                    {  $Id1 = $rows['id'];
                       $namew = $rows['name'] ;
                       echo "<option value='$namew'>$Id1</option>";
                    }
                    
                   ?>
                      <script>
                    $( "select" ) .change(function () {  
                    $("#edit_WorkshopID").val($("#edit_Workshop2 option:selected").text()).change();
                    });  
                      </script>
                  </select>
                  <input type="hidden" class="form-control"  id="edit_WorkshopID" name="edit_WorkshopID" >
                  </div>
                 <div class="form-group">
                  <label for="edit_attribute_value_Quantity">Quantity per Set/Piece</label>
                  <input type="text" class="form-control" id="edit_attribute_value_Quantity" name="edit_attribute_value_Quantity"  onchange="calc()" >
              </div>
             <div class="form-group">
                  <label for="edit_attribute_value_Quantity_set">Production per Day</label>
                  <input type="text" class="form-control" id="edit_attribute_value_Quantity_set" name="edit_attribute_value_Quantity_set" onchange="calc()" >
                 </div>
                
            
            </div>
        <div class="modal-footer">
          <input type="hidden" name="attribute_parent_id" id="attribute_parent_id" value="<?php echo $attribute_data['id']; ?>">
          <input type="hidden" name="edit_attribute_parent_name" id="edit_attribute_parent_id" value="<?php echo $attribute_data['name']; ?>">
         
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary">Save changes</button>
        </div>

      </form>


    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<!-- remove brand modal -->
<div class="modal fade" tabindex="-1" role="dialog" id="removeModal">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Remove Attribute Value</h4>
      </div>

      <form role="form" action="<?php echo base_url('attributes/removeValue') ?>" method="post" id="removeForm">
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



<script type="text/javascript">
    
     
var manageTable;
var base_url = "<?php echo base_url(); ?>";

$(document).ready(function() {

  

    $(".select_group").select2({
       
        dropdownParent: $('#updateForm')
    });
    
  $("#attributeNav").addClass('active');

  // initialize the datatable 
  manageTable = $('#manageTable').DataTable({
    'ajax': base_url+'attributes/fetchAttributeValueData/'+<?php echo $attribute_data['id']; ?>,
    'order': []
  });

  // submit the create from 
  $("#createForm").unbind('submit').on('submit', function() {
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
          $("#addModal").modal('hide');

          // reset the form
          $("#createForm")[0].reset();
          $("#createForm .form-group").removeClass('has-error').removeClass('has-success');

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


// edit function
// id => attribute value id
function editFunc(id)
{ 

  $.ajax({
    url: base_url+'attributes/fetchAttributeValueById/'+id,
    type: 'post',
    dataType: 'json',
    success:function(response) {

      console.log(response);

      $("#edit_attribute_value_name").val(response.value);
      $("#edit_attribute_value_costpQnt").val(response.direct);
      $("#edit_attribute_value_Pro_day").val(response.indirect);
      $("#edit_Raw_M").val(response.Material);
      $("#edit_MaterialID").val(response.Material_ID);
      $("#edit_Workshop").val(response.Workshop_Indirect);
      $("#edit_WorkshopID").val(response.Workshop_ID);
      $("#edit_attribute_value_Quantity").val(response.Qty);
      $("#edit_attribute_value_Quantity_set").val(response.QntySet);
      $("#edit_attribute_parent_name").val(response.attribute_parent_name);
   

      // submit the edit from 
      $("#updateForm").unbind('submit').bind('submit', function() {
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
              $("#editModal").modal('hide');
              // reset the form 
              $("#updateForm .form-group").removeClass('has-error').removeClass('has-success');

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
function calc()
{var elm = document.forms["createForm"];
$("#Raw_ID").val($("#Raw_M option:selected").text()).change();
$("#MaterialID").val($("#Raw_ID option:selected").text()).change();
    if (elm["attribute_value_Quantity"].value !== "" && elm["attribute_value_Quantity_set"].value !== "")
      {var cospq = elm["attribute_value_Quantity"].value * elm["Raw_M"].value;
          elm["attribute_value_costpQnt"].value = cospq.toFixed(2);
    
          var  prod = elm["Workshop"].value  / elm["attribute_value_Quantity_set"].value ;
  elm["attribute_value_Pro_day"].value = prod.toFixed(2);}
      
      
  
    
     var elm2 = document.forms["updateForm"];
$("#edit_Raw_ID").val($("#edit_Raw_M option:selected").text()).change();
$("#edit_MaterialID").val($("#edit_Raw_ID option:selected").text()).change();
    if (elm2["edit_attribute_value_Quantity"].value !== ""&& elm2["edit_attribute_value_Quantity_set"].value !== "")
      {var cospq2 = elm2["edit_attribute_value_Quantity"].value * elm2["edit_Raw_M"].value;
      elm2["edit_attribute_value_costpQnt"].value = cospq2.toFixed(2);
       var prod2 = elm2["edit_Workshop"].value / elm2["edit_attribute_value_Quantity_set"].value;}
     elm2["edit_attribute_value_Pro_day"].value = prod2.toFixed(2);   }
// remove functions 
function removeFunc(id)
{
  if(id) {
    $("#removeForm").on('submit', function() {

      var form = $(this);

      // remove the text-danger
      $(".text-danger").remove();

      $.ajax({
        url: form.attr('action'),
        type: form.attr('method'),
        data: { attribute_value_id:id }, 
        dataType: 'json',
        success:function(response) {

          manageTable.ajax.reload(null, false); 

          if(response.success === true) {
            $("#messages").html('<div class="alert alert-success alert-dismissible" role="alert">'+
              '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>'+
              '<strong> <span class="glyphicon glyphicon-ok-sign"></span> </strong>'+response.messages+
            '</div>');

            // hide the modal
            $("#removeModal").modal('hide');

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
