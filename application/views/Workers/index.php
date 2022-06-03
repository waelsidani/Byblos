

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      Manage
      <small>Workers</small>
    </h1>
    <ol class="breadcrumb">
      <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
      <li class="active">Workers</li>
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

        <?php if(in_array('createWorkers', $user_permission)): ?>
          <button class="btn btn-primary" data-toggle="modal" data-target="#addModal">Add Workers</button>
          <br /> <br />
        <?php endif; ?>

        <div class="box">
          <div class="box-header">
            <h3 class="box-title">Manage Workers</h3>
          </div>
          <!-- /.box-header -->
          <div class="box-body">
            <table id="manageTable" class="table table-bordered table-striped">
              <thead>
              <tr>
                <th>Workers Name</th>
                
                <th>Status</th>
                <?php if(in_array('updateWorkers', $user_permission) || in_array('deleteWorkers', $user_permission)): ?>
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

<?php if(in_array('createWorkers', $user_permission)): ?>
<!-- create brand modal -->
<div class="modal fade" tabindex="-1" role="dialog" id="addModal">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Add Workers</h4>
      </div>

      <form role="form" action="<?php echo base_url('Workers/create') ?>" method="post" id="createForm">

        <div class="modal-body">

          <div class="form-group">
            <label for="Workers_name">Worker Name</label>
            <input type="text" class="form-control" id="Workers_name" name="Workers_name" placeholder="Enter Worker name" autocomplete="off">
          </div>
            <div class="form-group">
            <label for="Workers_phone1" >Phone Number</label>
            <input type="text" class="form-control" id="Workers_phone1" name="Workers_phone1" placeholder="Enter Worker Contact Number" autocomplete="off">
          </div>
            <div class="form-group">
            <label for="Workers_dob">Date of Birth</label>
            <input type="date" class="form-control" value = "2000-12-01" id="Workers_dob" name="Workers_dob" placeholder="Enter Date Of Birth" autocomplete="off"  >
          </div>
            <div class="form-group">
            <label for="Workers_id" >National ID</label>
            <input type="text" class="form-control" id="Workers_id" name="Workers_id" placeholder="Enter National ID" autocomplete="off">
          </div>
            
          <div class="form-group">
            <label for="Workers_startingdate">Starting Date</label>
            <input type="date" class="form-control" value = "2000-12-01" id="Workers_startingdate" name="Workers_startingdate" placeholder="Enter Starting Work Date" autocomplete="off">
          </div>
           
             <div class="form-group">
            <label for="Workers_endingdate" >Ending Date</label>
            <input type="text" class="form-control" value = "-" id="Workers_endingdate" name="Workers_endingdate" placeholder="Enter End Work Date" autocomplete="off">
          </div>
            <div class="form-group">
            <label for="Workers_nationality" >Nationality</label>
            <input type="text" class="form-control" id="Workers_nationality" name="Workers_nationality" placeholder="Enter Worker Nationality" autocomplete="off">
          </div>
            <div class="form-group">
            <label for="Workers_Salary" >Salary</label>
            <input type="number"step=".01" class="form-control" id="Workers_Salary" name="Workers_Salary" placeholder="Enter Worker Salary" autocomplete="off">
          </div>
         
            <div class="form-group">
            <label for="Workers_workinghours" >Working Hours Per Day</label>
            <input type="text" class="form-control" id="Workers_workinghours" name="Workers_workinghours" placeholder="Enter Working Hours Per Day" autocomplete="off">
            <input type="hidden" name="Workers_workonsaturday" value="0" />
            <input type="checkbox" checked value="5" id="Workers_workonsaturday" name="Workers_workonsaturday"  autocomplete="off">
          <label for="Workers_workonsaturday" >Working On Saturday</label>
            </div>
          
            <div class="form-group">
            <label for="Worker_gender">Status</label>
            <select class="form-control" id="Worker_gender" name="Worker_gender">
              <option value="Male">Male</option>
              <option value="Female">Female</option>
            </select>
          </div>
   
          <div class="form-group">
            <label for="active">Status</label>
            <select class="form-control" id="active" name="active">
              <option value="1">Active</option>
              <option value="2">Inactive</option>
            </select>
          </div>
       

        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary">Save changes</button>
        </div>
</div>
      </form>


    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<?php endif; ?>

<?php if(in_array('updateWorkers', $user_permission)): ?>
<!-- edit brand modal -->
<div class="modal fade" tabindex="-1" role="dialog" id="editModal">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Edit Workers</h4>
      </div>

      <form role="form" action="<?php echo base_url('Workers/update') ?>" method="post" id="updateForm">

        <div class="modal-body">

          <div class="form-group">
            <label for="edit_Workers_name">Worker Name</label>
            <input type="text" class="form-control" id="edit_Workers_name" name="edit_Workers_name" placeholder="Enter Worker name" autocomplete="off">
          </div>
            <div class="form-group">
            <label for="edit_Workers_phone1" >Phone Number</label>
            <input type="text" class="form-control" id="edit_Workers_phone1" name="edit_Workers_phone1" placeholder="Enter Worker Contact Number" autocomplete="off">
          </div>
            <div class="form-group">
            <label for="edit_Workers_dob">Date of Birth</label>
            <input type="date" class="form-control" value = "2000-12-01" id="edit_Workers_dob" name="edit_Workers_dob" placeholder="Enter Date Of Birth" autocomplete="off">
          </div>
            <div class="form-group">
            <label for="edit_Workers_id" >National ID</label>
            <input type="text" class="form-control" id="edit_Workers_id" name="edit_Workers_id" placeholder="Enter National ID" autocomplete="off">
          </div>
            
          <div class="form-group">
            <label for="edit_Workers_startingdate">Starting Date</label>
            <input type="date" class="form-control" value = "2000-12-01" id="edit_Workers_startingdate" name="edit_Workers_startingdate" placeholder="Enter Starting Work Date" autocomplete="off">
          </div>
           
             <div class="form-group">
            <label for="edit_Workers_endingdate" >Ending Date</label>
            <input type="text" class="form-control" value = "-" id="edit_Workers_endingdate" name="edit_Workers_endingdate" placeholder="Enter End Work Date" autocomplete="off">
          </div>
            <div class="form-group">
            <label for="edit_Workers_nationality" >Nationality</label>
            <input type="text" class="form-control" id="edit_Workers_nationality" name="edit_Workers_nationality" placeholder="Enter Worker Nationality" autocomplete="off">
          </div>
            <div class="form-group">
            <label for="edit_Workers_Salary" >Salary</label>
            <input type="number"step=".01" class="form-control" id="edit_Workers_Salary" name="edit_Workers_Salary" placeholder="Enter Worker Salary" autocomplete="off">
          </div>
         
            <div class="form-group">
            <label for="edit_Workers_workinghours" >Working Hours Per Day</label>
            <input type="text" class="form-control" id="edit_Workers_workinghours" name="edit_Workers_workinghours" placeholder="Enter Working Hours Per Day" autocomplete="off">
          <input type="hidden" name="edit_Workers_workonsaturday" value="0"/>
            <input type="checkbox"  id="edit_Workers_workonsaturday" name="edit_Workers_workonsaturday" value="5" autocomplete="off">
          <label for="edit_Workers_workonsaturday" >Working On Saturday</label>
             <script>
                   document.getElementById('edit_Workers_workonsaturday').onchange = function()
                   {if (this.checked) 
            {
                        $("#edit_Workers_workonsaturday").val("5");
                    }}
                    </script>
            
            </div>
          
            <div class="form-group">
            <label for="edit_Worker_gender">Status</label>
            <select class="form-control" id="edit_Worker_gender" name="edit_Worker_gender">
              <option value="Male">Male</option>
              <option value="Female">Female</option>
            </select>
          </div>
   
          <div class="form-group">
            <label for="edit_active">Status</label>
            <select class="form-control" id="edit_active" name="edit_active">
              <option value="1">Active</option>
              <option value="2">Inactive</option>
            </select>
          </div>
       

        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary">Save changes</button>
        </div>
</div>

      </form>


    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<?php endif; ?>

<?php if(in_array('deleteWorkers', $user_permission)): ?>
<!-- remove brand modal -->
<div class="modal fade" tabindex="-1" role="dialog" id="removeModal">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Remove Workers</h4>
      </div>

      <form role="form" action="<?php echo base_url('Workers/remove') ?>" method="post" id="removeForm">
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
  $("#WorkersNav").addClass('active');
  
  // initialize the datatable 
  manageTable = $('#manageTable').DataTable({
    'ajax': 'fetchWorkersData',
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
    url: 'fetchWorkersDataById/'+id,
    type: 'post',
    dataType: 'json',
    success:function(response) {

      $("#edit_Workers_name").val(response.name);
      $("#edit_Workers_phone1").val(response.Phone1);
      $("#edit_Workers_dob").val(response.dob);
      $("#edit_Workers_id").val(response.nid);
      $("#edit_Workers_startingdate").val(response.startingdate);
      $("#edit_Workers_endingdate").val(response.endingdate);
      $("#edit_Workers_nationality").val(response.nationality);
      $("#edit_Workers_Salary").val(response.salary);
      $("#edit_Workers_workinghours").val(response.workinghours);
      $("#edit_Workers_workonsaturday").val(response.workonsaturday);
      $("#edit_Worker_gender").val(response.gender);
      $("#edit_active").val(response.active);
      var  w = $("#edit_Workers_workonsaturday").val();
     if (w !== "0")
      {$("#edit_Workers_workonsaturday").prop( "checked", true );}
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
        data: { Workers_id:id }, 
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
