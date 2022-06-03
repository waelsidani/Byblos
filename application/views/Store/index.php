

<!-- Content Wrapper. Contains page content -->

   
<style>
  .select,
  #locale {
    width: 100%;
  }
  
</style>
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      Manage
      Store Material
    </h1>
    <ol class="breadcrumb">
      <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
      <li class="active">Store</li>
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
<style>
body {
  font-family: Arial, Helvetica, sans-serif;
}

.notification {
  background-color: #555;
  color: white;
  text-decoration: none;
  padding: 15px 26px;
  position: relative;
  display: inline-block;
  border-radius: 2px;
}

.notification:hover {
  background: red;
 color:  white;
}

.notification .badge {
  position: absolute;
  top: -10px;
  right: -10px;
  padding: 5px 10px;
  border-radius: 50%;
  background-color: red;
  color: white;
}
</style>
        
        <?php $pending= count($this->model_Store-> getStorePending())  ?>
       <a href="<?php echo base_url('Store/raw') ?>" class="notification">
  <span>Inbox</span>
  <span class="badge"><?php echo $pending?> </span>
</a>
        <?php if(in_array('createStore', $user_permission) or in_array('updateProduction', $this->permission)): ?>
           <a href="<?php echo base_url('Store/create') ?>" class="btn btn-warning">Create/إنشاء طلب</a>
          <br /> <br />
        <?php endif; ?>
          <button id="print" name="print">Print Table</button>
           <button id="toexcel" name="toexcel">To Excel</button>
        <div class="box">
          <div class="box-header">
            <h3 class="box-title">Manage Raw Material</h3>
          </div>
          <!-- /.box-header -->
          <div class="box-body">
              <div id="toolbar">
 </div>
              <div style=" width: 1px">  <input type="hidden" class="form-control" value="en-US"  id="locale">
    

</div>

  <table id="manageTable"    class="table table-bordered table-striped" data-show-fullscreen="true"   data-show-export="true"
         
         >
              <thead>
              <tr >
                   <?php if(in_array('updateStore', $user_permission) || in_array('viewStore', $user_permission) || in_array('deleteStore', $user_permission)): ?>
                  <th style="text-align:center; width:10%"> Action</th>
                <?php endif; ?>
                <th style="text-align:center; width:5%" >Requester </th>
                 <th style="text-align:center; width:10%">W_Order_ID</th>
                 <th style="text-align:center; width:10%">W_Order_Number</th>
                 <th style="text-align:center; width:5%" >Code</th>
                <th style="text-align:center; width:20%" >Material Name</th>
                
                <th style="text-align:center; width:5%">Qty</th>
                <th style="text-align:center; width:10%" >Request Date</th>
                <th style="text-align:center; width:10%" >Received Date</th>
                 <th style="text-align:center; width:5%">Sent Qty</th>
                 <th style="text-align:center; width:10%">Receiver Name</th>
                
                <th style="text-align:center; width:10%" >Status</th>
             
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
  <!-- /.content -f->
</div>
<!-- /.content-wrapper -->

<?php if(in_array('createStore', $user_permission)): ?>
<!-- create Store modal -->
<div class="modal fade" tabindex="-1" role="dialog" id="addStoreModal">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Add Item</h4>
      </div>

      


    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<?php endif; ?>

<?php if(in_array('updateStore', $user_permission)): ?>
<!-- edit Store modal -->
<div class="modal fade" tabindex="-1" role="dialog" id="editStoreModal">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Edit Store</h4>
      </div>

      <form role="form" action="<?php echo base_url('Store/update') ?>" method="post" id="updateStoreForm">
 
        <div class="modal-body">
          <div id="messages"></div>
          <label for="edit_Store_Quantity">Quantity/الكمية</label>
          <div class="form-group">
              <input type="text" class="form-control" id="edit_Store_Quantity" name="edit_Store_Quantity" placeholder="Enter Quantity/أدخل العدد" autocomplete="off">   
              <input type="hidden" class="form-control" id="Array_num" name="Array_num" placeholder="Enter Quantity/أدخل العدد" autocomplete="off">   
          <input type="hidden" class="form-control" id="Order_num" name="Order_num" placeholder="Enter Quantity/أدخل العدد" autocomplete="off">   
          
          </div>
          
          <div class="form-group">
             
           <?php
          $mysqli = NEW MySQLi('localhost','root','','stock');
          $resultSet = $mysqli->query("SELECT name, id FROM stores WHERE  ACTIVE = '1'");
          ?>
                   
                    
          </div> 
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
            <label for="edit_active">Date/ التاريخ</label>
            <input type="datetime" class="form-control" id="edit_date_time" name="edit_date_time"  autocomplete="off">
             <input type="hidden" class="form-control"id="edit_date_time1" name="edit_date_time1" autocomplete="off">
            
            <script>
      
                
             window.addEventListener("load", function() {
    var now = new Date();
    var utcString = now.toISOString().substring(0,19);
    var year = now.getFullYear();
    var month = now.getMonth() + 1;
    var day = now.getDate();
    var hour = now.getHours();
    var minute = now.getMinutes();
    var second = now.getSeconds();
    var localDatetime = year + "-" +
                      (month < 10 ? "0" + month.toString() : month) + "-" +
                      (day < 10 ? "0" + day.toString() : day) + "/" +
                      (hour < 10 ? "0" + hour.toString() : hour) + ":" +
                      (minute < 10 ? "0" + minute.toString() : minute) +
                      utcString.substring(16,19);
    var datetimeField = document.getElementById("edit_date_time");
      var datetimeField1 = document.getElementById("edit_date_time1");
    datetimeField.value = localDatetime;
      datetimeField1.value = Math.floor(Number(now)/1000)+7200;
});
             </script>
          </div>
          
          <div class="form-group">
     
            <label for="edit_Store_Des">The Receiver /المستلم</label>
            <input type="text" class="form-control" id="Person" name="Person" placeholder="Receiver / المستلم" autocomplete="off">
              <label for="edit_Store_Des">Note/ ملاحظة</label>
            <input type="text" class="form-control" id="note" name="note" placeholder="note / ملاحظة" autocomplete="off">
             
                 
                </div>
         <?php if(in_array('deleteStore', $user_permission)): ?>
         <div class="test1">
          <div class="form-group">
              
              <input type="radio" id="Status" name="Status"  value="1" onchange="ChangeStatus()"><b>Not Delivered/لم يتم التسلسم</b>
          </div> </div>
          <?php endif ?>
           
          <input type="hidden" class="form-control" id="approval1" name="approval1"  autocomplete="off">
          <input type="hidden" class="form-control" id="Status1" name="Status1" value= "2" autocomplete="off">
            
         
        <div class="modal-footer">
          <button type="button" class="btn btn-default" onClick="window.parent.location.reload();window.close()" data-dismiss="modal">Close</button>
          
          <button type="submit" id= "btnSubmit" onClick="window.parent.location.reload();window.close()" class="btn btn-primary">Save changes</button>
        
         </div>
</div>
      </form>


    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<?php endif; ?>

<?php if(in_array('deleteStore', $user_permission)): ?>
<!-- remove Store modal -->
<div class="modal fade" tabindex="-1" role="dialog" id="removeStoreModal">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Remove Store</h4>
      </div>

      <form role="form" action="<?php echo base_url('Store/remove') ?>" method="post" id="removeStoreForm">
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

<?php if(in_array('deleteStore', $user_permission)): ?>
<!-- remove Store modal -->
<div class="modal fade" tabindex="-1" role="dialog" id="approveStoreModal">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Approve Item</h4>
      </div>

      <form role="form" action="<?php echo base_url('Store/approve') ?>" method="post" id="approveStoreForm">
        <div class="modal-body">
          <p>Do you really want to approve this request?</p>
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

</div>

<script type="text/javascript">
    
      


var manageTable;

$(document).ready(function() {

  $("#StoreNav").addClass('active');

  // initialize the datatable 
  manageTable = $('#manageTable').DataTable({
    'ajax': 'fetchStoreData',
    'order': [],
     lengthMenu: [20, 50, 100, 200, 500, 1000]
  });

  // submit the create from 
  $("#createStoreForm").unbind('submit').on('submit', function() {
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
          $("#addStoreModal").modal('hide');

          // reset the form
          $("#createStoreForm")[0].reset();
          $("#createStoreForm .form-group").removeClass('has-error').removeClass('has-success');

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
function ChangeStatus ()

{ $("#Status1").val(1);}
function editStore(id)
{ 
  $.ajax({
    url: 'fetchStoreDataById/'+id,
    type: 'post',
    dataType: 'json',
    success:function(response) {

      
     
      $("#edit_Store_Quantity").val(response.Quantity);
      $("#edit_Store_Des").val(response.Des);
      $("#edit_Store_BarCode").val(response.BarCode);
      $("#edit_Store_Material").val(response.Material);
      $("#edit_Store_MQnty").val(response.MQnty);
      $("#edit_active").val(response.active);
       $("#approval1").val(response.approval);
         $("#Array_num").val(response.array_num);
         $("#Order_num").val(response.Order_id);
         
         $("#Person").val(response.Person);
          $("#note").val(response.note);
          
          if (response.approval === "0" )
          {$("#btnSubmit").attr("disabled", true);}
         
let divs = document.getElementsByClassName('test');

for (let x = 0; x < divs.length; x++) {
	let div = divs[x];
	
  
	if (response.Status === "2" ) {
  	div.style.display = 'none';
  }
}
      // submit the edit from 
      $("#updateStoreForm").unbind('submit').bind('submit', function() {
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
              $("#editStoreModal").modal('hide');
              // reset the form 
              $("#updateStoreForm .form-group").removeClass('has-error').removeClass('has-success');

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

function removeStore(id)
{
  if(id) {
    $("#removeStoreForm").on('submit', function() {

      var form = $(this);

      // remove the text-danger
      $(".text-danger").remove();

      $.ajax({
        url: form.attr('action'),
        type: form.attr('method'),
        data: { Store_id:id }, 
        dataType: 'json',
        success:function(response) {

          manageTable.ajax.reload(null, false); 

          if(response.success === true) {
            $("#messages").html('<div class="alert alert-success alert-dismissible" role="alert">'+
              '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>'+
              '<strong> <span class="glyphicon glyphicon-ok-sign"></span> </strong>'+response.messages+
            '</div>');

            // hide the modal
            $("#removeStoreModal").modal('hide');

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

function approveStore(id)
{
  if(id) {
    $("#approveStoreForm").on('submit', function() {

      var form = $(this);

      // remove the text-danger
      $(".text-danger").remove();

      $.ajax({
        url: form.attr('action'),
        type: form.attr('method'),
        data: { Store_id:id }, 
        dataType: 'json',
        success:function(response) {

          manageTable.ajax.reload(null, false); 

          if(response.success === true) {
            $("#messages").html('<div class="alert alert-success alert-dismissible" role="alert">'+
              '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>'+
              '<strong> <span class="glyphicon glyphicon-ok-sign"></span> </strong>'+response.messages+
            '</div>');

            // hide the modal
            $("#approveStoreModal").modal('hide');

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
function printData()
{
   var divToPrint=document.getElementById("manageTable");
   newWin= window.open("");
   newWin.document.write(divToPrint.outerHTML);
   newWin.print();
   newWin.close();
}

$("#print").on('click',function(){
printData();
});
$("#toexcel").on('click',function(){
fnExcelReport();
});

var $table = $('#manageTable');
  
  function initTable() {
    $table.bootstrapTable('manageTable').bootstrapTable({
    
     exportTypes: ['excel'],
      
      locale: $('#locale').val(),
     
      
    });
    $table.on('check.bs.table uncheck.bs.table ' +
      'check-all.bs.table uncheck-all.bs.table',
    )
    $table.on('all.bs.table', function (e, name, args) {
      console.log(name, args)
    })
   
  }

  $(function() {
    initTable()
   $('#locale').change(initTable)
  })
  
  
             
</script>
