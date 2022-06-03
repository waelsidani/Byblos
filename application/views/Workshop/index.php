

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      Manage
      <small>Workshop</small>
    </h1>
    <ol class="breadcrumb">
      <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
      <li class="active">Workshop</li>
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

        <?php if(in_array('createWorkshop', $user_permission)): ?>
          <button class="btn btn-primary" data-toggle="modal" data-target="#addModal">Add Workshop</button>
          <br /> <br />
        <?php endif; ?>

        <div class="box">
          <div class="box-header">
            <h3 class="box-title">Manage Workshop</h3>
          </div>
          <!-- /.box-header -->
          <div class="box-body">
            <table id="manageTable" class="table table-bordered table-striped">
              <thead>
              <tr>
                <th>Workshop Name</th>
                
                <th>Status</th>
                <?php if(in_array('updateWorkshop', $user_permission) || in_array('deleteWorkshop', $user_permission)): ?>
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
<?php
           $mysqli1 = NEW MySQLi('localhost','root','','stock');
           $resultSet65 = $mysqli1->query("SELECT * FROM company WHERE  id = 1");
		$company_info = $resultSet65->fetch_assoc()	
                        
                        ?>
<?php if(in_array('createWorkshop', $user_permission)): ?>
<!-- create brand modal -->
<div class="modal fade" tabindex="-1" role="dialog" id="addModal">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Add Workshop</h4>
      </div>

        <form role="form" onload="calc()" onmousemove="calc()" action="<?php echo base_url('Workshop/create') ?>" method="post" id="createForm">

        <div class="modal-body">

          <div class="form-group">
            <label for="Workshop_name">Workshop Name</label>
            <input type="text" class="form-control" id="Workshop_name" name="Workshop_name" placeholder="Enter Workshop name" autocomplete="off">
          </div>
            <div class="form-group">
            <label for="Workshop_indirect" >Indirect Cost Per Hour</label>
            <input type="text" readonly class="form-control" id="Workshop_indirect" name="Workshop_indirect" placeholder="Enter Indirect Cost Per Hour" autocomplete="off">
            <input type="text" class="form-control" id="Daily_cost" name="Daily_cost" placeholder="Enter Avrage Workers"  value="<?php echo $company_info['Daily_Cost']?>"  autocomplete="off">
            </div>
            <div class="form-group">
            <label for="Workshop_avgworkers">Average Workers</label>
            <input type="text" class="form-control" id="Workshop_avgworkers" name="Workshop_avgworkers" placeholder="Enter Avrage Workers" autocomplete="off">
          </div>
             <?php
          $mysqli = NEW MySQLi('localhost','root','','stock');
          $resultSet = $mysqli->query("SELECT name FROM stores WHERE  ACTIVE = '1'");
         
          ?>
                   
                    
                  <label for="Workshop_Store_ID">Store</label>  
             <div class="form-group">
                
                  <select class="form-control" id="Workshop_Store_ID" name="Workshop_Store_ID">
                      <?php while($rows = $resultSet->fetch_assoc())
                    {
                       $name = $rows['name'] ;
                       echo "<option value='$name'>$name</option>";
                    }
                   ?>
                    
                  </select>
                </div>
            <script>
                  document.getElementById('Workshop_avgworkers').onchange = calc();
          </script>
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

<?php if(in_array('updateWorkshop', $user_permission)): ?>
<!-- edit brand modal -->
<div class="modal fade" tabindex="-1" role="dialog" id="editModal">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Edit Workshop</h4>
      </div>

        <form role="form" onmousemove="calc()"  onsubmit="calc()"  action="<?php echo base_url('Workshop/update') ?>" method="post" id="updateForm">

              <div class="modal-body">

          <div class="form-group">
            <label for="edit_Workshop_name">WorkShop Name</label>
            <input type="text" class="form-control" id="edit_Workshop_name" name="edit_Workshop_name" placeholder="Enter Workshop name" autocomplete="off">
          </div>
                  <label for="Daily_cost" >Worker Daily Cost</label>
         <input type="text" class="form-control" id="Daily_cost" name="Daily_cost" placeholder="Enter Avrage Workers"  value="<?php echo $company_info['Daily_Cost']?>"  autocomplete="off">
          
            <div class="form-group">
            <label for="edit_Workshop_indirect" >Indirect Cost Per Hour</label>
            <input type="number" readonly step="0.001" class="form-control" id="edit_Workshop_indirect" name="edit_Workshop_indirect" placeholder="Enter Indirect Cost Per Hour" autocomplete="off">
         
            </div>
            <div class="form-group">
            <label for="edit_Workshop_avgworkers">Average Workers</label>
            <input type="text" class="form-control" id="edit_Workshop_avgworkers" name="edit_Workshop_avgworkers" placeholder="Enter Avrage Workers" autocomplete="off">
          </div>
             <?php
          $mysqli = NEW MySQLi('localhost','root','','stock');
          $resultSet = $mysqli->query("SELECT name FROM stores WHERE  ACTIVE = '1'");
          ?>
                   
                    
                  
             <div class="form-group">
                  <label for="edit_Workshop_Store_ID">Store</label>
                  <select class="form-control" id="edit_Workshop_Store_ID" name="edit_Workshop_Store_ID">
                      <?php while($rows = $resultSet->fetch_assoc())
                    {
                       $name = $rows['name'] ;
                       echo "<option value='$name'>$name</option>";
                    }
                   ?>
                    
                  </select>
                </div>
         <table class="table table-bordereded" id="Report_Pro_Info">
                  <thead>
                      
                      <tr>
                          <th style="width:10%"><button type="button" id="add_row3" class="btn btn-default"><i class="fa fa-plus"></i></button></th>
                 
                      <th style="width: 50%" > Internal Work/ العمل داخل القسمم</th>
                        <th style="width: 40%" >Production per worker / إنتاجية العامل بالطقم  </th>
                        </tr>
                  </thead>
                  <tbody>
                       <tr id="rowr_1">
                         </tr> 
                      </tbody>
                 
                 
        </table>
            <script>
              
        
                
                
                function removeRowr(tr_id)
  {
    $("#Report_Pro_Info tbody tr#rowr_"+tr_id).remove();

  }
  
  $("#add_row3").unbind('click').bind('click', function() {
                   var count_table_tbody_trr = $("#Report_Pro_Info tbody tr").length;
      var row_idr = count_table_tbody_trr + 1;
      if (row_idr===0)
      {row_idr= 1;}

      
               var htmlr = '<tr id="rowr_'+row_idr+'">'+
             '<td></td><td><input type="text"  class="form-control" id="Work_production_'+row_idr+'" name="Work_production[]" style="width:100%;"></td>'+
             
             '<td><input type="number"  class="form-control" id="Qty_production_'+row_idr+'" name="Qty_production[]" style="width:100%;"></td>'+
                         
             '<td><button type="button" id="removebuttonr" name="removebuttonr" onclick="removeRowr('+row_idr+')" class="btn btn-default" ><i class="fa fa-close"></i></button></td>'+
                    ' </tr>' ;                              
                      

                if(count_table_tbody_trr >= 1) {
                $("#Report_Pro_Info tbody tr:last").after(htmlr); 
                
              }
          } );     
    
          </script>
          <div class="form-group">
            <label for="edit_active">Status</label>
            <select class="form-control" id="edit_active" name="edit_active">
              <option value="1">Active</option>
              <option value="2">Inactive</option>
            </select>
          </div>
        </div>

        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
          <button type="submit" onClick="window.parent.location.reload();window.close()" class="btn btn-primary">Save changes</button>
        </div>

      </form>
    

    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<?php endif; ?>

<?php if(in_array('deleteWorkshop', $user_permission)): ?>
<!-- remove brand modal -->
<div class="modal fade" tabindex="-1" role="dialog" id="removeModal">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Remove Workshop</h4>
      </div>

      <form role="form" action="<?php echo base_url('Workshop/remove') ?>" method="post" id="removeForm">
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
  $("#WorkshopNav").addClass('active');
  
  // initialize the datatable 
  manageTable = $('#manageTable').DataTable({
    'ajax': 'fetchWorkshopData',
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
    url: 'fetchWorkshopDataById/'+id,
    type: 'post',
    dataType: 'json',
    success:function(response) {

      $("#edit_Workshop_name").val(response.name);
      $("#edit_Workshop_indirect").val(response.indirect);
      $("#edit_Workshop_avgworkers").val(response.avgworker);
      $("#edit_Workshop_Store_ID").val(response.store);
      $("#edit_active").val(response.active);
        
        var result2= response.Work_production;
        var Note= result2.substr(2);
        var Note= Note.substr(0,Note.length-2);
        var Note= Note.split('","');
        
        var result3= response.Qty_production;
        var Qty= result3.substr(2);
        var Qty= Qty.substr(0,Qty.length-2);
        var Qty= Qty.split('","');
         var count_table_tbody_tr = $("#Report_Pro_Info tbody tr").length;
        
        var j = count_table_tbody_tr;


while(j-1 < Note.length) {
                
            var html3 = '<tr id="rowr_'+j+'">'+
             '<td></td>  <td><input type="text"  class="form-control" id="Work_production_'+j+'" name="Work_production[]" style="width:100%;"></td>'+
             
             '<td><input type="number"  class="form-control" id="Qty_production_'+j+'" name="Qty_production[]" style="width:100%;"></td>'+
                         
             '<td><button type="button" id="removebuttonr" name="removebuttonr" onclick="removeRowr('+j+')" class="btn btn-default" ><i class="fa fa-close"></i></button></td></tr>';
                    
                if(count_table_tbody_tr >= 1) {
                $("#Report_Pro_Info tbody tr:last").after(html3); 
                 }
              else {
                $("#Report_Pro_Info tbody").html(html3);
              }
              $(".Action").select2();
    j++;
}
if (Note.length === 1){
    document.getElementById("Qty_production_1").value = Qty[0];
    document.getElementById("Work_production_1").value = Note[0];

 }else{
        var i = 1;
while(i < Note.length) {
     document.getElementById("Qty_production_"+i).value = Qty[i-1];
     document.getElementById("Qty_production_"+(i+1)).value = Qty[i];
     document.getElementById("Work_production_"+i).value = Note[i-1];
     document.getElementById("Work_production_"+(i+1)).value = Note[i];
    i++;
}}
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
{
             var elm = document.forms["createForm"];

    if (elm["Workshop_avgworkers"].value !== "")
      {elm["Workshop_indirect"].value = elm["Workshop_avgworkers"].value * (elm["Daily_cost"].value) ;}             
    var elm = document.forms["updateForm"];

    if (elm["edit_Workshop_avgworkers"].value !== "")
      {elm["edit_Workshop_indirect"].value = elm["edit_Workshop_avgworkers"].value * (elm["Daily_cost"].value)  ;}
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
        data: { Workshop_id:id }, 
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
