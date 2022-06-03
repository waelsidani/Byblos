

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
       <body onload="signatureCapture(); signatureCapture1(); signatureCapture2()";>
     <script src="<?php echo base_url('assets/plugins/signature/signature.js') ?>"></script>
      <script src="<?php echo base_url('assets/plugins/dist/js/bootstrap-colorpicker.js') ?>"></script>
    <h1>
      Manage
      <small>Printing</small>
    </h1>
    <ol class="breadcrumb">
      <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
      <li class="active">Printing</li>
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
            <h3 class="box-title">Add Printing</h3>
          </div>
          <!-- /.box-header -->
          <form role="form" action="<?php base_url('users/create') ?>" method="post" enctype="multipart/form-data">
              <div class="box-body">

                <?php echo validation_errors(); ?>

                <div class="form-group">
             <div class="form-group">
                  <label for="S_Date">Starting Date/ تاريخ البدأ</label>
                   <input type="date" class="datepicker-days" id="S_date"  name="S_date"  value=""autocomplete="off" />
                 </div>
                   <div class="form-group">
                  <label for="Preparation_time">Preparation Time / وقت البدأ في التحضير</label>
                   <input type="time" class="datepicker-days" id="Preparation_time"  name="Preparation_time"  value=""autocomplete="off" />
                </div>
                  
                <div class="form-group">
                  <label for="Designer">Designer Name/إسم امصمم </label>
                  <input type="text" class="form-control" id="Designer" name="Designer" placeholder="Enter Printing_approval Person" value="" autocomplete="off" />
                </div>
                  
    
                  <label for="Design">Design Number/رقم التصميم </label>
                     <div class="form-group">
                  <input type="text" class="form-control" id="Design" name="Design" placeholder="Enter Printing_approval Person" value="" autocomplete="off" />
               
                  
                     </div>
                   <label for="Frame_Number">Number of Frames/عدد القوالب المستخدمة </label>
                  <div class="form-group">
                  <input type="text" class="form-control" id="Frame_Number" name="Frame_Number" placeholder="Enter Tray Number" value="" autocomplete="off" />
                 
                   </div>
      
                  <div class="form-group">
                  <label for="preparation_p">Name of the preparation person/إسم عامل تحضير القوالب</label>
                  <input type="text" class="form-control" id="preparation_p" name="preparation_p" placeholder="Enter Tray Number" value="" autocomplete="off" />
                  
                  </div>
                   <div class="form-group">
                  <label for="Humidity">Humidity Number/درجة رطوبة القسم</label>
                  <input type="text" class="form-control" id="Humidity" name="Humidity" placeholder="Enter Tray Number" value="" autocomplete="off" />
                  
                  </div>
                   <div class="form-group">
                  <label for="Printing_Person">Name of printing Person/إسم عامل الطباعة</label>
                  <input type="text" class="form-control" id="Printing_Person" name="Printing_Person"  autocomplete="off" />
                  
                  </div>
                  
                  
                  <div class="form-group">
                   <table class="table table-bordereded" id="Action_info_table">
                       <b style=" font-size: 20px ">Colors</b>
                  <thead>
                   <?php $mysqli2 = NEW MySQLi('localhost','root','','stock');
          $resultSet2 = $mysqli2->query("SELECT * FROM categories ");
                    ?></th>
                   <th ><button type="button" id="add_row" class="btn btn-default"><i class="fa fa-plus"></i></button></th>
                   </tr>
                   <th style="width:25%"></th>
                       <th style="width:15%" ></th>
                         <th style="width:15%"></th>
                           <th style="width:25%"></th>
                            <th style="width:20%"></th>
                           <th style="width:5%"></th>
                    
                  </thead>

                   <tbody>
                       
                    <tr>
                  <tr id="row_1">
                           <td>
                   <label style="height: 35px" >Color Number /رقم اللون</label>
                   <select class="form-control select_group Material" id="color_12_<?php echo $x; ?>" name="color_12[]" >
                       <option  value='-'>-</option>
            
                       <?php foreach ($resultSet2 as $k => $v): ?>
                                <option value="<?php echo $v['id'] ?>"><?php echo $v['name'] .'-'.$v['number'] ?></option>
                              <?php endforeach ?>
                                 
            </select>
                          <input type="text" class="form-control"  id="color_1_1" name="color_1[]"  autocomplete="off" />
                          <input type="text" class="form-control"  id="color_2_1" name="color_2[]"  autocomplete="off" />
                          <input type="text" class="form-control"  id="color_3_1" name="color_3[]" autocomplete="off" />
                           <input type="text" class="form-control"  id="color_4_1" name="color_4[]" autocomplete="off" />
                           </td>              
                          <td>
                           <label style="height: 35px">Quantity(g)/ (غ)الكمية</label>
                            <input type="text" class="form-control"  id="color_10_1" name="color_13[]" autocomplete="off" />
                         
                          <input type="text" class="form-control"  id="color_7_1" name="color_7[]"  autocomplete="off" />
                           <input type="text" class="form-control"  id="color_8_1" name="color_8[]"  autocomplete="off" />
                           <input type="text" class="form-control"  id="color_9_1" name="color_9[]" autocomplete="off" />
                          <input type="text" class="form-control"  id="color_10_1" name="color_10[]" autocomplete="off" />
                          </td>
                            
                          
                         
                          <td>
                              <label style="height: 35px">Oil Number /رقم الزيت</label>
                              <input type="text" class="form-control"  id="color_5_1" name="color_5[]"  autocomplete="off" />
                          <label style="height: 35px">Quantity(g)/ (غ)الكمية</label>
                          <input type="text" class="form-control"  id="color_11_1" name="color_11[]"  autocomplete="off" /></td>
                          
                           
                          <td>
                              <label style="height: 35px">Silk Number /رقم الحرير</label>
                              <input type="text" class="form-control"  id="color_6_1" name="color_6[]"  autocomplete="off" />
                              <label style="height: 35px">Painting Counts/عدد مرات الدهن</label>
                          <input type="text" class="form-control"  id="count" name="count[]"  autocomplete="off" /></td>
                         
                          </td>
                          
                          <td> 
                              <label style="height: 35px">Starting Time/وقت وتاريخ البدأ</label>
                               <input type="date" class="form-control" id="C_date_1" name="C_date[]"  autocomplete="off" />
                        <input type="time" class="form-control "  id="C_T_1" name="C_T[]"  autocomplete="off" />
                        
                               </td>
               <td>
                           <button type="button" id="removebutton" name="removebutton" class="btn btn-default" onclick="removeRow('1')"><i class="fa fa-close"></i></button></td>
                        
                        </tr>
                        
                   </tbody>
                </table>  
        </div>   </div>
                   <div class="form-group">
                  <label for="Quantity">Pages Quantity/ عدد الصفحات</label>
                  <input type="text" class="form-control" id="Quantity" name="Quantity" pvalue="" autocomplete="off" />
                </div>
                    <div class="form-group">
                  <label for="Assistant">Printing Assistant Person/إسم المعاون في الطباعة</label>
                  <input type="text" class="form-control" id="Assistant" name="Assistant" value="" autocomplete="off" />
                </div>
                    <div class="form-group">
                  <label for="Disposal">Disposal Number/ عدد الهدر في قسم</label>
                  <input type="text" class="form-control" id="Disposal" name="Disposal"  value="" autocomplete="off" />
                </div>
                    <div class="form-group">
                  <label for="Note">Note/ ملاحظة</label>
                  <input type="text" class="form-control" id="Note" name="Note" value="" autocomplete="off" />
                </div>
                     <div class="form-group">
                  <label for="Packing">Pages Packing Person Name/إسم عامل تغليف الصفحات </label>
                  <input type="text" class="form-control" id="Packing" name="Packing"  value="" autocomplete="off" />
                </div>
                   <div class="form-group">
                  <label for="Responsible_P">Workshop Responsible Person/إسم مسؤول القسم</label>
                  <input type="text" class="form-control" id="Responsible_P" name="Responsible_P"  value="" autocomplete="off" />
                </div>
                   
                    <div class="form-group">
                  <label for="Finished">Finished Date and Time/ تاريخ و وقت الانتهاء</label>
                  <input type="date" class="datepicker-days" id="Finished_D"  name="Finished_D"  value=""autocomplete="off" />
                 <input type="time" class="timepicker-orient-bottom" id="Finished_T"  name="Finished_T"  value=""autocomplete="off" />
                </div>
                   
                   <div class="form-group">
                  <label for="Receiver">Receiver Person/إسم المستلم</label>
                  <input type="text" class="form-control" id="Receiver" name="Receiver"  value="" autocomplete="off" />
                </div>
                   
                    <div class="form-group">
                  <label for="Received_D">Received Date and Time/ تاريخ و وقت التسليم</label>
                  <input type="date" class="datepicker-days" id="Received_D"  name="Received_D"  value=""autocomplete="off" />
                 <input type="time" class="datepicker-days" id="Received_T"  name="Received_T"  value=""autocomplete="off" />
                </div>
                   
             </div>
              <!-- /.box-body -->
    </div>
              <div class="box-footer">
                <button type="submit" class="btn btn-primary">Save Changes/حفظ</button>
                <a href="<?php echo base_url('Printing/') ?>" class="btn btn-warning">Back/ الرجوع</a>
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
  

  $(document).ready(function() {
    $(".select_group").select2();
var base_url = "<?php echo base_url(); ?>";
     
    $("#add_row").unbind('click').bind('click', function() {
      
        var table = $("#Action_info_table");
      var count_table_tbody_tr2 = $("#Action_info_table tbody tr").length;
      var row_id = count_table_tbody_tr2 + 1;

      $.ajax({
          url: base_url + 'Printing/getTablePaintsRow',
          type: 'post',
          dataType: 'json',
          
          success :function(response2) {
            
              console.log(response2);
              
                   
                   var html = '<tr id="row_'+row_id+'">'+
                   '<td>'+ 
                   '<label style="height: 35px">Color Number /رقم اللون</label>'+
                    '<select class="form-control select_group Material" data-row-id="'+row_id+'" id="color_12_'+row_id+'" name="color_12[]" style="width:100%;" >'+
             '<option value="-">-</option>';
                       
                       
                        
                          $.each(response2, function(index, value1) {
                          html += '<option value="'+value1.id+'">'+value1.name+'-'+value1.number+'</option>';               
                        });
                                                             
                      html += '</select>'+
                    
                          
                          
                          
                          '<input type="text" class="form-control"  id="color_1_'+row_id+'" name="color_1[]"  autocomplete="off" />'+
                          '<input type="text" class="form-control"  id="color_2_'+row_id+'" name="color_2[]" autocomplete="off" />'+
                          '<input type="text" class="form-control"  id="color_3_'+row_id+'" name="color_3[]" autocomplete="off" />'+
                          '<input type="text" class="form-control"  id="color_4_'+row_id+'" name="color_4[]" autocomplete="off" />'+
                         
                                       
            '<td>'+
                          
                          '<label style="height: 35px">Quantity(g)/ (غ)الكمية</label>'+
                          '<input type="text" class="form-control"  id="color_13_'+row_id+'" name="color_13[]" autocomplete="off" />'+
                          '<input type="text" class="form-control"  id="color_7_'+row_id+'" name="color_7[]"autocomplete="off" />'+              
                          '<input type="text" class="form-control"  id="color_8_'+row_id+'" name="color_8[]" autocomplete="off" />'+
                          '<input type="text" class="form-control"  id="color_9_'+row_id+'" name="color_9[]" autocomplete="off" />'+
                          '<input type="text" class="form-control"  id="color_10_'+row_id+'" name="color_10[]" autocomplete="off" />'+
                          
                         
                                      
            '<td>'+
                           '<label style="height: 35px">Oil Number /رقم الزيت</label>'+
                           '<input type="text" class="form-control"  id="color_5_'+row_id+'" name="color_5[]" autocomplete="off" />'+
                          '<label style="height: 35px">Quantity(g)/ (غ)الكمية</label>'+
                          '<input type="text" class="form-control"  id="color_11_'+row_id+'" name="color_11[]"autocomplete="off" />'+
                           '<td>'+
                          '<label style="height: 35px">Silk Number /رقم الحرير</label>'+
                          '<input type="text" class="form-control"  id="color_6_'+row_id+'" name="color_6[]" autocomplete="off" />'+
                          '<label style="height: 35px">Painting Counts /عدد مرات الدهن</label>'+
                          '<input type="text" class="form-control"  id="count'+row_id+'" name="count[]" autocomplete="off" />'+
                          
            '</td>'+
                          '<td> '+
                            '<label style="height: 35px">Starting Time/وقت وتاريخ البدأ</label>'+
                            '<input type="date" class="form-control" id="C_date_'+row_id+'"  name="C_date[]"  value=""autocomplete="off" />'+
                            '<input type="time" class="form-control" id="C_T_'+row_id+'"  name="C_T[]"  value=""autocomplete="off" />'+
                            '</td>'+
               '<td>'+
                '<button type="button" id="removebutton" name="removebutton" class="btn btn-default" onclick="removeRow('+row_id+')"><i class="fa fa-close"></i></button></td>'+
                 '</tr>'     ;  
            

                if(count_table_tbody_tr2 >= 1) {
                $("#Action_info_table tbody tr:last").after(html);  
              }
              else {
                $("#Action_info_table tbody").html(html);
              }

              $(".workshop").select2();
          
          }
        });
      return false;
    });

  });
 
function removeRow(tr_id)
  {
    $("#Action_info_table tbody tr#row_"+tr_id).remove();

  }
  
  $(".date")
        .datepicker({
            onSelect: function(dateText) {
                console.log("Selected date: " + dateText + "; input's current value: " + this.value);
		        $(this).change();
		    }
		})
        .on("change", function() {
            console.log("Got change event from field");
        });
        
        
</script>