

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      Manage
      <small>Production</small>
    </h1>
    <ol class="breadcrumb">
      <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
      <li class="active">Production</li>
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
            <script>window.onload= self.close();</script>
                <?php echo $this->session->flashdata('success');?>
            
          </div>
       
        <?php 
        elseif($this->session->flashdata('error')): ?>
          <div class="alert alert-error alert-dismissible" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <?php echo $this->session->flashdata('error'); ?>
          </div>
        <?php endif; ?>
<a href="<?php echo base_url('Store/create') ?>" class="btn btn-warning">Samples/ طلب عينات من المستودع</a>
          <br /> <br />
        <?php if(in_array('createProduction', $user_permission)): ?>
          <a href="<?php echo base_url('Production/create') ?>" class="btn btn-primary">Add Production</a>
          <br /> <br />
          <a href="<?php echo base_url('workorder/') ?>" class="btn btn-warning">Work Orders</a>
          <br /> <br />
        <?php endif; ?>
            <?php if(in_array('updateProduction', $user_permission)): ?>
          <a href="<?php echo base_url('Production/P_Report') ?>" class="btn btn-default">Report</a>
          <br /> <br />
        <?php endif; ?>

</head>
<body>

<?php 
$this->load->model('model_Workorder');
$workshop = $this->model_Workorder->getWorkorderData();
  
            
          
             
?>
    
       
<div class="dropdown">
  
 
      <select    class="form-control select_group Material" id="myDropdown" style="width : 200px" onchange="filterFunction()">
          <option  value=""></option>
          
          <?php foreach ($workshop as $k => $v): ?>
          <option  value="<?php echo $v['name'] ?>"><?php echo $v['name']?></option>
                    <?php endforeach ?>
      </select>

  

 
   <select class="btn btn-secondary dropdown-toggle"  style="background: #fff9e5 ; border:1px solid #ccc"  id="myDropdown1" style="width : 200px ;" onchange="filterFunction1()">
          <option  value=""></option>
          <option  value="Need Approval" style="background: #00caff ; font-size: 15px; font-family: Times New Roman;">Need Approval </option>
          <option  value="In Progress" style="background: #ffdb1f ;font-size: 15px; font-family: Times New Roman; ">In Progress</option>
           <option  value="Stopped" style="background: red ; color: white ;font-size: 15px; font-family: Times New Roman;">Stopped</option>
          
            <option  value="Finished" style="background: green; color: white ; font-size: 15px; font-family: Times New Roman;">Finished</option>
                    
      </select> 

    <input type="date" id="filter" name="filter"  pattern="\d{4}-\d{2}-\d{2}" 
       onchange="filterFunction2()" >  

   
  </div>
    



          <!-- /.box-header -->
          <div class="box-body">
              
            <table data-filter-control='true' data-search="true"  id="manageTable"  class="table table-bordered table-striped">
              <thead>
              <tr>
                   <?php if(in_array('updateProduction', $user_permission) || in_array('deleteProduction', $user_permission)): ?>
                  <th>Action</th>
                <?php endif; ?>
                <th>ID</th>
                
                <th>Design #</th>
                <th >Work Order#</th>
                <th>Product #</th> 
                <th>Qty</th>
                <th>Log Date</th>
                <th>User Name</th>
                <th>Status</th>
               
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

<?php if(in_array('deleteProduction', $user_permission)): ?>
<!-- remove brand modal -->
<div class="modal fade" tabindex="-1" role="dialog" id="removeModal">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Remove Production</h4>
      </div>

      <form role="form" action="<?php echo base_url('Production/remove') ?>" method="post" id="removeForm">
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
    
 $(document).ready(function() {
    $(".select_group").select2();
});

    
var manageTable;
var base_url = "<?php echo base_url(); ?>";

$(document).ready(function() {

  $("#mainProductionNav").addClass('active');
 
  // initialize the datatable 
  manageTable = $('#manageTable').DataTable({
      
  
    'ajax': base_url + 'Production/fetchProductionlog',
    'order': []
    
    

  });
 
});
$(document).ready(function(){
  $("#myInput").on("keyup", function() {
    
    var value = $(this).val().toLowerCase();
    manageTable.search(value).draw();
    $(".dropdown-menu li").filter(function() {
      $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1);
    });
  });
});
function filterFunction() {
 

  div = document.getElementById("myDropdown").value;

  manageTable.search(div).draw();
}

function filterFunction1() {
 

  div = document.getElementById("myDropdown1").value;

  manageTable.search(div).draw();
}
function filterFunction2() {
 

  div = document.getElementById("filter").value;
   myName = div;

newName1 =myName.substring(8,10)+'-'+myName.substring(5,7)+'-'+myName.substring(0,4);

  manageTable.search(newName1).draw();
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
        data: { Production_id:id }, 
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
