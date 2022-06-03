

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
          
          <?php if(in_array('deleteProduction', $user_permission)): ?>
          <a href="<?php echo base_url('Production/P_Report_1') ?>" class="btn btn-default">Production Report</a>
          <br /> <br />
        <?php endif; ?>
           <?php if(in_array('deletePricing', $user_permission)): ?>
<a href="<?php echo base_url('Workorder_acc/') ?>" class="btn btn-primary">Work Orders Cost</a>
          <br /> <br />
            <?php endif; ?>
           <button id="toexcel" name="toexcel">To Excel</button>
</head>
<body>

<?php 
$this->load->model('model_Workorder');
$workshop = $this->model_Workorder->getWorkorderData();
  
            
          
             
?>
    
       
<div class="dropdown">
  
 
      <select    class="form-control select_group Material" id="myDropdown" style="width : 200px" onchange="filterFunction()">
          <option  value=""></option>
          
          <?php foreach ($workshop as $k => $v):
              $wnum = $this->model_Workorder->getWorkordercount($v['name']);
$Dwnum = $this->model_Workorder->doneWorkordercount($v['name']);
$countwnum = count($wnum);
$countdwnum = count($Dwnum);
             if (!in_array('deleteProduction', $this->permission)){ if($countwnum != $countdwnum ) {
              ?>
          
          <option  value="<?php  echo $v['name']; ?>"><?php echo $v['name']."-".$v['customer']?></option>
             <?php }}
             
             else{ ?>
                  <option  value="<?php  echo $v['name']; ?>"><?php echo $v['name']."-".$v['customer']?></option>
             <?php
             }endforeach ?>
      </select>

  

 
   <select class="btn btn-secondary dropdown-toggle"  style="background: #fff9e5 ; border:1px solid #ccc"  id="myDropdown1" style="width : 200px ;" onchange="filterFunction1()">
          <option  value=""></option>
          <option  value="Need Approval" style="background: #00caff ; font-size: 15px; font-family: Times New Roman;">Need Approval </option>
          <option  value="In Progress approved " style="background: #ffdb1f ;font-size: 15px; font-family: Times New Roman; ">In Progress</option>
          <option  value="Stopped" style="background: red ; color: white ;font-size: 15px; font-family: Times New Roman;">Stopped</option>
          <option  value="Finished" style="background: green; color: white ; font-size: 15px; font-family: Times New Roman;">Finished</option>
  </select> 

  </div>
    



          <!-- /.box-header -->
          <div class="box-body">
              
            <table data-filter-control='true' data-search="true"  id="manageTable"  class="table table-bordered table-striped">
              <thead>
              <tr><th>SN</th>
                   <?php if(in_array('updateProduction', $user_permission) || in_array('deleteProduction', $user_permission)): ?>
                  <th>Action</th>
                <?php endif; ?>
                  
                <th>ID</th>
                <th>Image</th>
                <th>Design #</th>
                <th >Work Order#</th>
                <th>Product #</th> 
                <th>Qty</th>
                <th>Creation Date</th>
                <th>Finished Date</th>
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
  
$("#toexcel").on('click',function(){
fnExcelReport();
});
function fnExcelReport()
{
     var tab_text="<table border='2px'><tr bgcolor='#767e7e'>";
    var textRange; var j=0;
    tab = document.getElementById('manageTable'); // id of table

    for(j = 0 ; j < tab.rows.length ; j++) 
    {     
        tab_text=tab_text+tab.rows[j].innerHTML+"</tr>";
        //tab_text=tab_text+"</tr>";
    }

    tab_text=tab_text+"</table>";
   
    tab_text= tab_text.replace(/<A[^>]*>|<\/A>/g, "");//remove if u want links in your table
    tab_text= tab_text.replace(/<img[^>]*>/gi,""); // remove if u want images in your table
    tab_text= tab_text.replace(/<input[^>]*>|<\/input>/gi, ""); // reomves input params

    var ua = window.navigator.userAgent;
    var msie = ua.indexOf("MSIE "); 

    if (msie > 0 || !!navigator.userAgent.match(/Trident.*rv\:11\./))      // If Internet Explorer
    {
        txtArea1.document.open("txt/html","replace");
        txtArea1.document.write(tab_text);
        txtArea1.document.close();
        txtArea1.focus(); 
        sa=txtArea1.document.execCommand("SaveAs",true,"Say Thanks to Sumit.xls");
    }  
    else                 //other browser not tested on IE 11
       

      
       sa = window.open('data:application/vnd.ms-excel;charset=utf-8,' + encodeURIComponent((tab_text)));    

    return (sa);
}
 $(document).ready(function() {
    $(".select_group").select2();
});

    
var manageTable;
var base_url = "<?php echo base_url(); ?>";

$(document).ready(function() {

  $("#mainProductionNav").addClass('active');
 
  // initialize the datatable 
  manageTable = $('#manageTable').DataTable({
      
  
    'ajax': base_url + 'Production/fetchProductionData',
    'order': [],
    lengthMenu: [ 200, 500, 1000]
    

  });
 
});
$(document).ready(function(){
  $("#myInput").on("keyup", function() {
    
    var value = $(this).val().toLowerCase();
    manageTable.search(value).draw();
    $(".dropdown-menu li").filter(function() {
      $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
    });
  });
});
function filterFunction() {
 

  
div = document.getElementById("myDropdown1").value + " " +document.getElementById("myDropdown").value;
  
  manageTable.search(div).draw();
}

function filterFunction1() {
 

 div = document.getElementById("myDropdown1").value + " " +document.getElementById("myDropdown").value;
  

  manageTable.search(div).draw();
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
