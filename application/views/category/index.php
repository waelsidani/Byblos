<?php declare(strict_types=1) ?>


<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      Manage
      <small>Category</small>
    </h1>
    <ol class="breadcrumb">
      <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
      <li class="active">Category</li>
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

        <?php if(in_array('createCategory', $user_permission)): ?>
          <button class="btn btn-primary" data-toggle="modal" data-target="#addModal">Add Category</button>
          <br /> <br />
        <?php endif; ?>

        <div class="box">
          <div class="box-header">
            <h3 class="box-title">Manage Categories</h3>
          </div>
          <!-- /.box-header -->
          <div class="box-body">
            <table id="manageTable" class="table table-bordered table-striped">
              <thead>
              <tr>
                <th>Item Name/الاسم</th>
                <th>Code/ الرقم</th>
                  <th>Qnty/الكمية</th>
                <?php if(in_array('updateCategory', $user_permission) || in_array('deleteCategory', $user_permission)): ?>
                  <th>Action</th>
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

<?php if(in_array('createCategory', $user_permission)): ?>
<!-- create brand modal -->
<div class="modal fade" tabindex="-1" role="dialog" id="addModal">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Add Category</h4>
      </div>

      <form role="form" action="<?php echo base_url('category/create') ?>" method="post" id="createForm">

        <div class="modal-body">
          <div class="form-group">
            <label for="brand_name">Name / الاسم</label>
            <input type="text" class="form-control" id="category_name" name="category_name" placeholder="Color Number/ رقم اللون" autocomplete="off">
          </div>
          <div class="form-group">
            <label for="brand_name">Color Number/ رقم اللون</label>
            <input type="text" class="form-control" id="category_number" name="category_number" placeholder="Color Number/ رقم اللون" autocomplete="off">
          </div>
            <div class="form-group">
            <label for="brand_name">Quantity/ الكمية</label>
            <input type="text" class="form-control" id="category_qty" name="category_qty" placeholder="Quantity/ الكمية" autocomplete="off">
          </div>
          
               <div class="form-group">
            <label for="brand_name">Min-Quantity/أقل كمية مسموح بها</label>
            <input type="text" class="form-control" id="category_mqty" name="category_mqty" placeholder="Min-Quantity/أقل كمية مسموح بها" autocomplete="off">
          </div>
            <div class="form-group">
            <label for="brand_name">Description/ وصف الصنف</label>
            <input type="text" class="form-control" id="category_des" name="category_des" placeholder="Description/ وصف الصنف" autocomplete="off">
          </div>
            
           
            <div class="form-group">
            <label for="active">Type/النوع</label>
            <select class="form-control" id="active" name="active">
              <option value="1">600</option>
              <option value="2">200</option>
              <option value="3">-</option>
            </select>
          </div>
        </div>

        <div class="modal-footer">
          <button onClick="window.parent.location.reload();window.close()" type="button" class="btn btn-default" data-dismiss="modal">Close</button>
         
          <button type="submit" class="btn btn-primary">Save changes</button>
        </div>

      </form>


    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<?php endif; ?>

<?php if(in_array('updateCategory', $user_permission)): ?>
<!-- edit brand modal -->
<div class="modal fade" tabindex="-1" role="dialog" id="editModal">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Update Item/تعديل الصنف</h4>
      </div>

      <form role="form" action="<?php echo base_url('category/update') ?>" method="post" id="updateForm">

        <div class="modal-body">
          <div id="messages"></div>

          <div class="modal-body">
          <div class="form-group">
            <label for="brand_name">Name / الاسم</label>
            <input type="text" class="form-control" id="edit_category_name" name="edit_category_name" placeholder="Color Number/ رقم اللون" autocomplete="off">
          </div>
          <div class="form-group">
            <label for="brand_name">Color Number/ رقم اللون</label>
            <input type="text" class="form-control" id="edit_category_number" name="edit_category_number" placeholder="Color Number/ رقم اللون" autocomplete="off">
          </div>
            <div class="form-group">
            <label for="brand_name">Quantity/ الكمية</label>
            <input type="text" class="form-control" id="edit_category_qty" name="edit_category_qty" placeholder="Quantity/ الكمية" autocomplete="off">
          </div>
               <div class="form-group">
            <label for="brand_name">Min-Quantity/أقل كمية مسموح بها</label>
            <input type="text" class="form-control" id="edit_category_mqty" name="edit_category_mqty" placeholder="Quantity/ الكمية" autocomplete="off">
          </div>
            <div class="form-group">
            <label for="brand_name">Description/ وصف الصنف</label>
            <input type="text" class="form-control" id="edit_category_des" name="edit_category_des" placeholder="Description/ وصف الصنف" autocomplete="off">
          </div>
            
               <div class="form-group">
            <label for="brand_name">Transaction description/ شرح الحركة</label>
            <input type="text" class="form-control" id="edit_category_Trans"value="0" name="edit_category_Trans" autocomplete="off">
           
               </div>
            <div class="form-group">
                  <input type="checkbox" name="Add" id="Add"value='Add'/>
                    <label for="Add" >Add</label> 
                    <input type="checkbox" name="Withdraw" id="Withdraw"value='Withdraw'/>
                      <label for="Withdraw" >Withdraw</label> 
            <label for="brand_name">-New Quantity/ الكمية الجديدة</label>
             <input type="text" class="form-control" id="edit_category_nqty"value="0" name="edit_category_nqty" placeholder="الكمية الجديدة +/-" autocomplete="off">
          </div>
              <script>
                   document.getElementById('Add').onchange = function(){
                   {if (this.checked) 
            {document.getElementById('Withdraw').checked= false;
             var elm = document.forms["updateForm"];

    if (elm["edit_category_nqty"].value !== "")
      {var val1 = $("#edit_category_qty").val();
        var val2 = $("#edit_category_nqty").val();
        val1= Number(val1)+Number(val2);
        $("#edit_category_qty").val(val1)
            }}};
            document.getElementById('Withdraw').onchange = function()
                   {if (this.checked) 
            {document.getElementById('Add').checked= false;
             var elm = document.forms["updateForm"];

    if (elm["edit_category_nqty"].value !== "")
      {var val1 = $("#edit_category_qty").val();
        var val2 = $("#edit_category_nqty").val();
        val1= Number(val1)-Number(val2);
        $("#edit_category_qty").val(val1)
            }}};}
            
                   
                 
                         
    var elm = document.forms["updateForm"];

    if (elm["edit_category_nqty"].value !== "")
      {var val1 = $("#edit_category_qty").val();
        var val2 = $("#edit_category_nqty").val();
        val1= Number(val1)+Number(val2);
        $("#edit_category_qty").val(val1)
            }
                  
          </script>
            <label for="edit_active">Type/النوع</label>
            <select class="form-control" id="edit_active" name="edit_active">
              <option value="1">600</option>
              <option value="2">200</option>
              <option value="3">-</option>
            </select>
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

<?php if(in_array('deleteCategory', $user_permission)): ?>
<!-- remove brand modal -->
<div class="modal fade" tabindex="-1" role="dialog" id="removeModal">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Remove Category</h4>
      </div>

      <form role="form" action="<?php echo base_url('category/remove') ?>" method="post" id="removeForm">
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
  $("#categoryNav").addClass('active');
  
  // initialize the datatable 
  manageTable = $('#manageTable').DataTable({
    'ajax': 'fetchCategoryData',
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
function editFunc(id)
{ 
  $.ajax({
    url: 'fetchCategoryDataById/'+id,
    type: 'post',
    dataType: 'json',
    success:function(response) {

      $("#edit_category_name").val(response.name);
      $("#edit_category_number").val(response.number);
      $("#edit_category_qty").val(response.qty);
      $("#edit_category_mqty").val(response.mqty);
      $("#edit_category_des").val(response.description);
      $("#edit_category_Trans").val(response.tras);
      $("#edit_category_nqty").val(response.nqty);
      $("#edit_active").val(response.active);

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
        data: { category_id:id }, 
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

