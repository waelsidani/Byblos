

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
            <h3 class="box-title">Production Report</h3>
          </div>
          <!-- /.box-header -->
          <form role="form" action="<?php base_url('Production/P_Report') ?>" method="post">
              <div class="box-body">
          

       
  
  <div >            
   <input type="radio" name="Repot_Type"   value="1" onchange="app()" > Production Reportt sort by Workorder / تقرير الانتاج حسب رقم الانتاج
  </div>
  <div>   
   <input type="radio" name="Repot_Type"  value="2"  onchange="app()"> Production Reportt sort by Product / تقرير الانتاج حسب رقم المنتج
 
    
                <?php echo validation_errors(); ?>
   
  
       
   <div  id="per_item" class="form-group">
     <div class="form-group">
                   <table class="table table-bordereded" id="Workshop_info_table">
                  <thead>
                    <tr>
                        <th style="width:5%">Product</th>
                        <th style="width:10%"><button type="button" id="add_row" class="btn btn-default"><i class="fa fa-plus"></i></button></th>
                    </tr>
                  </thead>
                  <tbody>
                     <tr id="row_1">
                       <td>
                          
                       <select class="form-control select_group Workshop" data-row-id="row_1" id="workshop_1" name="workshop[]" style="width:100%;"  onchange="getProductData(1)" required>
                              <option value="-">-</option>
                              <?php foreach ($workshop as $k => $v): ?>
                              
                                <option value="<?php echo $v['id'] ?> "><?php echo $v['name']."-".$v['id'] ."-".$v['Number']?></option>
                              <?php endforeach ;?>
                            </select>
                       <td><button type="button" id="removebutton" name="removebutton" class="btn btn-default" onclick="removeRow('1')"><i class="fa fa-close"></i></button></td>
                     </tr>
                   </tbody>
                </table>
                  
        </div>
 </div>
      <div  id="per_workorder" class="form-group">
     <div class="form-group">
                   <table class="table table-bordereded" id="Workshop_info_table">
                  <thead>
                    <tr>
                        <th style="width:5%">Work Order</th>
                          </tr>
                  </thead>
                  <tbody>
                     <tr>
                       <td>
             
                       <select class="form-control select_group Workshop"  id="workorder" name="workorder" style="width:100%;"  onchange="getProductData(1)" required>
                           <option value="-">-</option>
                              <?php $data1 = $this->model_Workorder->getWorkorderData();
                              foreach ($data1 as $k => $v): ?>
                              
                                <option value="<?php echo $v['name'] ?> "><?php echo $v['name']?></option>
                              <?php endforeach ?>
                            </select>
                        </tr>
                   </tbody>
                </table>
                  
        </div>
 </div>
                   </div>
              <!-- /.box-body -->

              <div class="box-footer">
                  <button type="submit" class="btn btn-primary" >Place Order</button>
                 <a href="<?php echo base_url('Production/') ?>" class="btn btn-warning">Back</a>
                    </div>
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
    
  var temp = document.getElementById("temp");
  var p_i = document.getElementById("per_item");
  var p_i_v = document.getElementById("workshop_1");
  var P_W =document.getElementById("per_workorder");
  var P_W_V =document.getElementById("workorder");
 
 p_i.style.display = "none";
 P_W.style.display = "none";
 
function app()
{
if ($('form input[type=radio]:checked').val()=== "1")
    
        {
      p_i.style.display = "none";
      P_W.style.display = "block";
      P_W_V.selectedIndex = 0;
      p_i_v.selectedIndex = 0;
        }
      else 
      
      {
           P_W_V.selectedIndex = 0;
      p_i_v.selectedIndex = 0;
         
          p_i.style.display = "block";
      P_W.style.display = "none";
  ;}
  }
  $(document).ready(function() {
    $(".select_group").select2();
    $("#description").wysihtml5();

    $("#mainProductionNav").addClass('active');
    $("#addProductionNav").addClass('active');
    
    var btnCust = '<button type="button" class="btn btn-secondary" title="Add picture tags" ' + 
        'onclick="alert(\'Call your custom code here.\')">' +
        '<i class="glyphicon glyphicon-tag"></i>' +
        '</button>'; 
    $("#Production_image").fileinput({
        overwriteInitial: true,
        maxFileSize: 1500,
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
        layoutTemplates: {main2: '{preview} ' +  btnCust + ' {remove} {browse}'},
        allowedFileExtensions: ["jpg", "png", "gif"]
    });

  });
  
  var base_url = "<?php echo base_url(); ?>";

  $(document).ready(function() {
    $(".select_group").select2();
    // $("#description").wysihtml5();

   
  
    // Add new row in the table 
    $("#add_row").unbind('click').bind('click', function() {
      var table = $("#Workshop_info_table");
      var count_table_tbody_tr = $("#Workshop_info_table tbody tr").length;
      var row_id = count_table_tbody_tr + 1;

      $.ajax({
          url: base_url + '/Production/getTableproduction/',
          type: 'post',
          dataType: 'json',
          success:function(response) {
            
              // console.log(reponse.x);
               var html = '<tr id="row_'+row_id+'">'+
                   '<td>'+ 
                    '<select class="form-control select_group Workshop" data-row-id="'+row_id+'" id="workshop_'+row_id+'" name="workshop[]" style="width:100%;" onchange="getProductData('+row_id+')">'+
                        '<option value=""></option>';
                       
                        $.each(response, function(index, value) {
                          html += '<option value="'+value.id+'">'+value.name+'-'+value.id+'-'+value.Number+'</option>';             
                        });
                        
                      html += '</select>'+
                    '</td>'+ 
                   
                    '<td><button type="button" class="btn btn-default" onclick="removeRow(\''+row_id+'\')"><i class="fa fa-close"></i></button></td>'+
                    '</tr>';

                if(count_table_tbody_tr >= 1) {
                $("#Workshop_info_table tbody tr:last").after(html);  
              }
              else {
                $("#Workshop_info_table tbody").html(html);
              }

              $(".Workshop").select2();

          }
        });

      return false;
    });

  }); // /document


  // get the product information from the server
  function getProductData(row_id)
  {
    var workshop_id = $("#workshop_"+row_id).val();    
    if(workshop_id === "") {
  

    } else {
      $.ajax({
        url: base_url + 'Production/getworkshopValueById',
        type: 'post',
        data: {workshop_id : workshop_id},
        dataType: 'json',
        success:function(response) {
          // setting the direct value into the direct input field
          
     
          
        } // /success
      }); // /ajax function to fetch the product data 
    }
  }


      

   

   



  function removeRow(tr_id)
  {
    $("#Workshop_info_table tbody tr#row_"+tr_id).remove();
    subAmount();
  }
</script>