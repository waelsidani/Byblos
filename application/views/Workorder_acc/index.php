

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      Manage
      <small>Workorder Costs</small>
    </h1>
    <ol class="breadcrumb">
      <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
      <li class="active">Workorder Costs</li>
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
            <h3 class="box-title">Manage Workorder_acc</h3>
          </div>
          <!-- /.box-header -->
          <div class="box-body">

            <table id="manageTable" class="table table-bordered table-striped">
              <thead>
              <tr>
                <th>Workorder_acc Name</th>
                <th>Customer</th>
                <th>Delivery Date</th>
                <th>Process Status </th>
                <th>Status</th>
                <?php if(in_array('updateWorkorder_acc', $user_permission) || in_array('deleteWorkorder_acc', $user_permission)): ?>
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

<?php if(in_array('createWorkorder_acc', $user_permission)): ?>
<!-- create brand modal -->
<div class="modal fade" tabindex="-1" role="dialog" id="addModal">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Add Workorder_acc</h4>
      </div>

      <form role="form" action="<?php echo base_url('Workorder_acc/create') ?>" method="post" id="createForm">

        <div class="modal-body">

          <div class="form-group">
            <label for="brand_name">Workorder_acc Number</label>
            <input type="text" class="form-control" id="Workorder_acc_name" name="Workorder_acc_name" placeholder="Enter Workorder_acc name" autocomplete="off">
          </div>
            
             <div class="form-group">
            <label for="Customer">Customer</label>
            <input type="text" class="form-control" id="Customer" name="Customer" " autocomplete="off">
          </div>
            <div class="form-group">
            <label for="date">Delivery Date</label>
            <input type="date" class="form-control" id="Delivery" name="Delivery" placeholder="Enter Delivery Date" autocomplete="off">
          </div>
          <div class="form-group">
            <label for="active">Status</label>
            <select class="form-control" id="active" name="active">
              <option value="1">Active</option>
              <option value="2">Inactive</option>
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

<?php if(in_array('updateWorkorder_acc', $user_permission)): ?>
<!-- edit brand modal -->
<div class="modal fade" tabindex="-1" role="dialog" id="editModal">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Edit Workorder_acc</h4>
      </div>

      <form role="form" action="<?php echo base_url('Workorder_acc/update') ?>" method="post" id="updateForm">

        <div class="modal-body">
          <div id="messages"></div>

          <div class="form-group">
            <label for="edit_brand_name">Workorder_acc Name</label>
            <input type="text" class="form-control" id="edit_Workorder_acc_name" name="edit_Workorder_acc_name" placeholder="Enter Workorder_acc name" autocomplete="off">
          </div>
           <div class="form-group">
            <label for="edit_Customer">Customer</label>
            <input type="text" class="form-control" id="edit_Customer" name="edit_Customer" " autocomplete="off">
          </div>
      
           
         
          <div class="box-body">
            <table id="Action_info_table" class="table table-bordered table-striped">
              <thead>
              <tr>
                <th>Product Number</th>
                <th>Product ID</th>
                <th>Indirect Cost</th>
                  <th>Status</th>
               
              </tr>
              </thead>
             
                  
                  
             <tr id="row_1">
              
             </tr>
            </table>
                 
          </div>
        </div>

        <div class="modal-footer">
          <button type="button" onClick="window.parent.location.reload()"  class="btn btn-default" data-dismiss="modal">Close</button>
          <button type="submit" onClick="window.parent.location.reload()"  class="btn btn-primary">Save changes</button>
            <a id="print1" name="print1"  onclick =" print1()" class="btn btn-warning">Print Report</a>
        </div>

      </form>


    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<?php endif; ?>

<?php if(in_array('deleteWorkorder_acc', $user_permission)): ?>
<!-- remove brand modal -->
<div class="modal fade" tabindex="-1" role="dialog" id="removeModal">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Remove Workorder_acc</h4>
      </div>

      <form role="form" action="<?php echo base_url('Workorder_acc/remove') ?>" method="post" id="removeForm">
        <div class="modal-body">
          <p>Do you really want to remove?</p>
        </div>
        <div class="modal-footer">
          <button type="button"  onClick="window.parent.location.reload()"  class="btn btn-default" data-dismiss="modal">Close</button>
          <button type="submit" onClick="window.parent.location.reload()" class="btn btn-primary">Save changes</button>
        </div>
      </form>


    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<?php endif; ?>



<script type="text/javascript">
var manageTable;

$(document).ready(function() {

  $("#Workorder_Nav").addClass('active');

  // initialize the datatable 
  manageTable = $('#manageTable').DataTable({
    'ajax': 'fetchWorkorder_accData',
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
{ var base_url2 = "<?php echo base_url(); ?>";
  $.ajax({
    url: 'fetchWorkorder_accDataById/'+id,
    type: 'post',
    dataType: 'json',
    success:function(response)
    {

       $("#edit_Workorder_acc_name").val(response.name);
      
       $("#edit_Customer").val(response.customer);
       
        $.ajax({
          url: base_url2 + 'Workorder_acc/getProductsNumber/'+response.name,
          type: 'post',
          
          success :function(response3){
              $.ajax({
          url: base_url2 + 'Workorder_acc/getProductsid/'+response.name,
          type: 'post',
          
          success :function(response4){
        var P_ID =  response4;
        var P_ID= P_ID.replace(/[{"id: } ]+/g,'"');
        var P_ID= P_ID.substr(2);
        var P_ID= P_ID.substr(0,P_ID.length-2);
        var P_ID = P_ID.split('","');
              
        var Number = response3;
        var Number2= Number.replace(/[{"Number: } ]+/g,'"');
        var Number2= Number2.substr(2);
        var Number3= Number2.substr(0,Number2.length-2);
        var Number4 = Number3.split('","');
        
        var Cost = response.cost;
        var Cost2= Cost.substr(2);
        var Cost3= Cost2.substr(0,Cost2.length-2);
        var Cost4 = Cost3.split('","');
        
        var check = response.done;
        var check2= check.substr(2);
        var check3= check2.substr(0,check2.length-2);
        var check4 = check3.split('","');
        
                var u = 1;
       
        var count_table_tbody_tr = $("#Action_info_table tbody tr").length;
      
        while(u -1< Number4.length) {
       
               var html4 = '<tr id="row_'+u+'">'+
                       '<td><input readonly type="text" class="form-control" id="Number_'+u+'" name="Number[]" value= "'+Number4[u-1]+'"  autocomplete="off"></td>'+
               '<td><input type="text" readonly class="form-control" value = "0" id="P_ID_'+u+'" name="P_ID[]" autocomplete="off"></td>'+
               
            '<td><input type="text" class="form-control" id="indirect_'+u+'" name="indirect[]" autocomplete="off"></td>'+
               '<td><input type="checkbox" id="status_'+u+'" style="width: 20px; height: 20px;" name="status[]" value="1" onchange=checkbox('+u+')></td>'+
            '<td><input type="hidden" class="form-control" value = "0" id="status2_'+u+'" name="status2[]" autocomplete="off"></td>'+
              
                               
                    '</tr>';

                if(count_table_tbody_tr >= 1) {
                $("#Action_info_table tbody tr:last").after(html4); 
                
              }
              else {
                $("#Action_info_table tbody").html(html4);
              }

              $(".Action").select2();
   
    u++;
}
       if (Number4.length === 1){
    document.getElementById("Number_1").value = Number4[0];
 document.getElementById("indirect_1").value = Cost4[0];
  document.getElementById("status2_1").value = check4[0];
  document.getElementById("P_ID_1").value = P_ID[0];
 if (check4[0] === 1){
    var Check= document.getElementById("status_1");
    Check.checked = true;}
 }else{

if (Cost4.length >1){
        var i = 1;
while(i < Number4.length) {
   

     document.getElementById("Number_"+i).value = Number4[i-1];
     document.getElementById("Number_"+(i+1)).value = Number4[i];
     document.getElementById("indirect_"+i).value = Cost4[i-1];
     document.getElementById("indirect_"+(i+1)).value = Cost4[i];
     document.getElementById("status2_"+i).value = check4[i-1];
     document.getElementById("status2_"+(i+1)).value = check4[i];
     
          document.getElementById("P_ID_"+i).value = P_ID[i-1];
     document.getElementById("P_ID_"+(i+1)).value = P_ID[i];
if (check4[i-1] ==="1"){
     var check1= document.getElementById("status_"+i) ;
 check1.checked = true;}
 if (check4[i] === "1"){
 var check2= document.getElementById("status_"+(i+1)) ;
  check2.checked = true;
            }
    i++;
}}
 }
       
       

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

    }});}
  });}});
}
function checkbox(num)
{
    var Stat= $("#status2_"+num).val();
  if (Stat === "0")
  {document.getElementById("status2_"+num).value = "1";}
  
 else
 {document.getElementById("status2_"+num).value = "0";}
    
}
// remove functions 

function print1()
{
  var base_url2 = "<?php echo base_url(); ?>";
  
  
  window.open(base_url2+"/Production/P_Report/");
}
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
        data: { Workorder_acc_id:id }, 
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
