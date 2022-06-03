

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
       <h1>
      Manage
      <small>Desingertasks</small>
    </h1>
    <ol class="breadcrumb">
      <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
      <li class="active">Desingertasks</li>
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
            <h3 class="box-title">Add Desingertasks</h3>
          </div>
          <!-- /.box-header -->
          <form role="form" action="<?php base_url('Desingertasks/create') ?>" method="post" enctype="multipart/form-data">
              <div class="box-body">

                <?php echo validation_errors(); ?>

                <div class="form-group">

                  <div class="form-group">
                 
                      <img id="imagepreview"  width="600" height="600" class="img-Thumbnail">
               
                </div>

                <div class="form-group">
                  <label for="Desingertasks_image">Update Image</label>
                  <div class="kv-avatar">
                      <div class="file-loading">
                          <input id="Desingertasks_image" name="Desingertasks_image[]" type="file" multiple>
                      </div>
                  </div>
                </div>
                    
          <div class="form-group">
 
    <label style=" font-size: 20px "for="items_info_table">محتويات الستيكر/ Sticker Details</label>
                   <table class="table table-bordered" id="items_info_table">
                  <thead>
                    <tr>
                      
                      <th style="width:45%">المادة/ Items</th>
                      <th style="width:25%">نوع الصنف/ Item Details</th>
                      <th style="width:25%">الكمية بالحبة/ Qty</th>
                      
                      <th style="width:5%"><button type="button" id="add_row" class="btn btn-default"><i class="fa fa-plus"></i></button></th>
                    </tr>
                  </thead>

                   <tbody>
                     <tr id="row_1">
                         
                         
                       <td>
                        <select class="form-control select_group product" data-row-id="row_1" id="product_1" name="product[]" style="width:100%;"  >
                            <option value="1">شاي / Tea</option>
                            <option value="2">قهوة / Coffee</option>
                            <option value="3">طبق/ Saucer</option>
                            <option value="4">مبخرة/ Incense Burner</option>
                            <option value="5">عصير-ماء/ Juice or Water</option>
                            <option value="6">شيشة/ Glass Bottle</option>
                            <option value="7">إبريق/  Jug </option>
                            <option value="8">سكرية/ Sugar Bowl</option>
                            
                          </select>
                       </td>
                        <td>
                          <input type="text" name="details[]" id="details_1" class="form-control"  autocomplete="off">
                          
                        </td>
                         
                        <td><input type="text" name="qty[]" id="qty1_" class="form-control" ></td>
                       
                        <td><button type="button" class="btn btn-default" onclick="removeRow('1')"><i class="fa fa-close"></i></button></td>
                     </tr>
                   </tbody>
                </table>
              
                  
        </div>
                   
                   <div class="form-group">
                  <label for="Desingertaskser_name">الاعداد/ Quantities</label>
                  <table class="table table-bordereded" id="Action_info_table">
                  <thead>
                      
                    <tr>
                      
                      <th style="width:12.5%">المادة/ Items</th>
                      <th style="width:12.5%">الكمية بالحبة/ Qty</th>
                      <th style="width:12.5%">المادة/ Items</th>
                      <th style="width:12.5%">الكمية بالحبة/ Qty</th>
                      <th style="width:12.5%">المادة/ Items</th>
                      <th style="width:12.5%">الكمية بالحبة/ Qty</th>
                      <th style="width:12.5%">المادة/ Items</th>
                      <th style="width:12.5%">الكمية بالحبة/ Qty</th>
                     
                      
                       </tr>
                  </thead>

                   <tbody>
                    <tr>
                  
                       
    
                        <td><select class="form-control" id="items_1" name="items[]" >
                            <option value="">-</option>
                            <option value="1">شاي / Tea</option>
                            <option value="2">قهوة / Coffee</option>
                            <option value="3">طبق/ Saucer</option>
                            <option value="4">مبخرة/ Incense Burner</option>
                            <option value="5">عصير-ماء/ Juice or Water</option>
                            <option value="6">شيشة/ Glass Bottle</option>
                            <option value="7">إبريق/  Jug </option>
                            <option value="8">سكرية/ Sugar Bowl</option>
            </select></td>
            <td><input type="text" class="form-control" id="qty_1" name="qty2[]"  autocomplete="off"  />
               </td>
                          
                          <td><select class="form-control" id="items_2" name="items[]"  >
                           <option value="">-</option>
                           <option value="1">شاي / Tea</option>
                            <option value="2">قهوة / Coffee</option>
                            <option value="3">طبق/ Saucer</option>
                            <option value="4">مبخرة/ Incense Burner</option>
                            <option value="5">عصير-ماء/ Juice or Water</option>
                            <option value="6">شيشة/ Glass Bottle</option>
                            <option value="7">إبريق/  Jug </option>
                            <option value="8">سكرية/ Sugar Bowl</option>
                              </select></td> <td><input type="text" class="form-control"  id="qty_2"  name="qty2[]" autocomplete="off" /></td>
                          
                          <td><select class="form-control" id="items_3" name="items[]"  >
                            <option value="">-</option>
                            <option value="1">شاي / Tea</option>
                            <option value="2">قهوة / Coffee</option>
                            <option value="3">طبق/ Saucer</option>
                            <option value="4">مبخرة/ Incense Burner</option>
                            <option value="5">عصير-ماء/ Juice or Water</option>
                            <option value="6">شيشة/ Glass Bottle</option>
                            <option value="7">إبريق/  Jug </option>
                            <option value="8">سكرية/ Sugar Bowl</option>
            </select></td>
            
            <td><input type="text" class="form-control"  id="qty_3" name="qty2[]"  autocomplete="off" /></td>
                          
                             
                               <td><select class="form-control" id="items_4" name="items[]" >
                            <option value="">-</option>
                            <option value="1">شاي / Tea</option>
                            <option value="2">قهوة / Coffee</option>
                            <option value="3">طبق/ Saucer</option>
                            <option value="4">مبخرة/ Incense Burner</option>
                            <option value="5">عصير-ماء/ Juice or Water</option>
                            <option value="6">شيشة/ Glass Bottle</option>
                            <option value="7">إبريق/  Jug </option>
                            <option value="8">سكرية/ Sugar Bowl</option>
            </select></td>
            
            <td><input type="text" class="form-control"  id="qty_4" name="qty2[]"  autocomplete="off"  /></td>
                          
             
                    </tr>
                   
                     
                        
                   </tbody>
                </table>
                    <label for="Tray">Tray Number/رقم الدرج</label>
                  <input type="text" class="form-control" id="Tray" name="Tray"  autocomplete="off" />
                  
                  
                    </div>
                  
                
                   <label for="Tray">Design Number/رقم التصميم</label>
                  <input type="text" class="form-control" id="film" name="film"  autocomplete="off" />
                  
                   <label for="Tray">Note/ ملاحظة</label>
                  <input type="text" class="form-control" id="note" name="note"   autocomplete="off" />
                   
              
                  
      
                   
    
                  
                  <label style=" font-size: 20px "for="items_info_table1">إضافة ستيكر/ Add Sticker +</label>
                   <table class="table table-bordered" id="items_info_table1">
                  <thead>
                    <tr>
                      
                      <th style="width:45%">المادة/ Items</th>
                      <th style="width:25%">نوع الصنف/ Item Details</th>
                      <th style="width:25%">الكمية بالحبة/ Qty</th>
                      
                      <th style="width:5%"><button type="button" id="add_row1" class="btn btn-default"><i class="fa fa-plus"></i></button></th>
                    </tr>
                  </thead>

                   <tbody>
                     <tr id="row_1">
                         
                      </tr>
                   </tbody>
                </table>
                  <label style=" font-size: 20px "for="items_info_table2">سحب ستيكر/ Withdraw Sticker -</label>
                   <table class="table table-bordered" id="items_info_table2">
                  <thead>
                    <tr>
                      
                      <th style="width:35%">المادة/ Items</th>
                      <th style="width:20%">نوع الصنف/ Item Details</th>
                      <th style="width:20%">الكمية بالحبة/ Qty</th>
                      <th style="width:20%">رقم الطلب/ Order Number</th>
                      
                      <th style="width:5%"><button type="button" id="add_row2" class="btn btn-default"><i class="fa fa-plus"></i></button></th>
                    </tr>
                  </thead>

                   <tbody>
                     <tr id="row_1">
                         
                      </tr>
                   </tbody>
                </table>
                   
                  
                 
                  
                  
             </div>
              <!-- /.box-body -->
    </div>
              <div class="box-footer">
                <button type="submit" class="btn btn-primary">Save Changes/حفظ</button>
                <a href="<?php echo base_url('Desingertasks/') ?>" class="btn btn-warning">Back/ الرجوع</a>
              </div>
            </form>
          <!-- /.box-body -->
        </div>
        <!-- /.box -->
      </div>
      <!-- col-md-12 -->
    </div>
    

  </section>
  <!-- /.content -->
</div>
<!-- /.content-wrapper -->

<script type="text/javascript">
    
 
  $(document).ready(function() {
    $(".select_group").select2();
   

    $("#mainDesingertasksNav").addClass('active');
    $("#addDesingertasksNav").addClass('active');
    
   
window.addEventListener("paste", e => {
        if (e.clipboardData.files.length > 0)
        {const fileInput = document.querySelector("#Desingertasks_image");
            fileInput.files = e.clipboardData.files;
              setPreviewImage(e.clipboardData.files[0]);
        }});
    
    function setPreviewImage(file)
    {if ( /\.(jpe?g|png|gif)$/i.test(file.name) ) {
            const fileReader = new FileReader();
        fileReader.readAsDataURL(file);
        fileReader.onload = () => {
            document.querySelector ("#imagepreview").src = fileReader.result;
        };
    }}
    $("#Desingertasks_image").fileinput({
        overwriteInitial: true,
        maxFileSize: 15000,
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
        layoutTemplates: {main2: '{preview} '  + ' {remove} {browse}'},
        allowedFileExtensions: ["jpg", "png", "gif", "jpeg"]
    });
var base_url = "<?php echo base_url(); ?>";

  $(document).ready(function() {
    $(".select_group").select2();
    // $("#description").wysihtml5();

    $("#mainOrdersNav").addClass('active');
    $("#addOrderNav").addClass('active');
    
    var btnCust = '<button type="button" class="btn btn-secondary" title="Add picture tags" ' + 
        'onclick="alert(\'Call your custom code here.\')">' +
        '<i class="glyphicon glyphicon-tag"></i>' +
        '</button>'; 
  
    // Add new row in the table 
    $("#add_row").unbind('click').bind('click', function() {
      var table = $("#items_info_table");
      var count_table_tbody_tr = $("#items_info_table tbody tr").length;
      var row_id = count_table_tbody_tr + 1;

      $.ajax({
          url: base_url + '/orders/getTableProductRow/',
          type: 'post',
          dataType: 'json',
          success:function(response) {
            
              // console.log(reponse.x);
               var html = '<tr id="row_'+row_id+'">'+
                      
                   '<td>'+ 
                    '<select class="form-control select_group product" data-row-id="'+row_id+'" id="product_'+row_id+'" name="product[]" style="width:100%;" >'+
                        '<option value="1">شاي / Tea</option>'+
                           ' <option value="2">قهوة / Coffee</option>'+
                            '<option value="3">طبق/ Saucer</option>'+
                            '<option value="4">مبخرة/ Incense Burner</option>'+
                            '<option value="5">عصير-ماء/ Juice or Water</option>'+
                            '<option value="6">شيشة/ Glass Bottle</option>'+
                            '<option value="7">إبريق/  Jug </option>'+
                            '<option value="8">سكرية/ Sugar Bowl</option>;'+
                        $.each(response, function(index, value) {
                          html += '<option value="'+value.id+'">'+value.name+'</option>';             
                        });
                        
                      html += '</select>'+
                    '</td>'+ 
                    '<td><input type="text" name="details[]" id="details_'+row_id+'" class="form-control" ></td>'+
                    '<td><input type="text" name="qty[]" id="qty1_'+row_id+'" class="form-control"></td>'+
                      '<td><button type="button" class="btn btn-default" onclick="removeRow(\''+row_id+'\')"><i class="fa fa-close"></i></button></td>'+
                    '</tr>';

                if(count_table_tbody_tr >= 1) {
                $("#items_info_table tbody tr:last").after(html);  
              }
              else {
                $("#items_info_table tbody").html(html);
              }

              $(".product").select2();

          }
        });

      return false;
    });


 
 
   
  
    $("#add_row1").unbind('click').bind('click', function() {
      var table1 = $("#items_info_table1");
      var count_table_tbody_tr1 = $("#items_info_table1 tbody tr").length;
      var row_id1 = count_table_tbody_tr1 + 1;

      $.ajax({
          url: base_url + '/orders/getTableProductRow/',
          type: 'post',
          dataType: 'json',
          success:function(response) {
            
              // console.log(reponse.x);
               var html1 = '<tr id="row_'+row_id1+'">'+
                      
                   '<td>'+ 
                    '<select class="form-control select_group product" data-row-id="'+row_id1+'" id="items1_'+row_id1+'" name="items1[]" style="width:100%;"  >'+
                        '<option value="1">شاي / Tea</option>'+
                           ' <option value="2">قهوة / Coffee</option>'+
                            '<option value="3">طبق/ Saucer</option>'+
                            '<option value="4">مبخرة/ Incense Burner</option>'+
                            '<option value="5">عصير-ماء/ Juice or Water</option>'+
                            '<option value="6">شيشة/ Glass Bottle</option>'+
                            '<option value="7">إبريق/  Jug </option>'+
                            '<option value="8">سكرية/ Sugar Bowl</option>;'+
                        $.each(response, function(index, value) {
                          html1 += '<option value="'+value.id+'">'+value.name+'</option>';             
                        });
                        
                      html1 += '</select>'+
                    '</td>'+ 
                    '<td><input type="date" class="datepicker-days" id="add_date_'+row_id1+'"  name="add_date[]"  value=""autocomplete="off" /></td>'+
                    
                      '<td><input type="text" name="qty3[]" id="qty3_'+row_id1+'" class="form-control" ></td>'+
                      '<td><button type="button" class="btn btn-default" onclick="removeRow1(\''+row_id1+'\')"><i class="fa fa-close"></i></button></td>'+
                    '</tr>';

                if(count_table_tbody_tr1 >= 1) {
                $("#items_info_table1 tbody tr:last").after(html1);  
              }
              else {
                $("#items_info_table1 tbody").html(html1);
              }

              $(".product").select2();

          }
        });

      return false;
    });

 $("#add_row2").unbind('click').bind('click', function() {
      var table2 = $("#items_info_table2");
      var count_table_tbody_tr2 = $("#items_info_table2 tbody tr").length;
      var row_id2 = count_table_tbody_tr2 + 1;

      $.ajax({
          url: base_url + '/orders/getTableProductRow/',
          type: 'post',
          dataType: 'json',
          success:function(response) {
            
              // console.log(reponse.x);
               var html2 = '<tr id="row_'+row_id2+'">'+
                      
                   '<td>'+ 
                    '<select class="form-control select_group product" data-row-id="'+row_id2+'" id="items2_'+row_id2+'" name="items2[]" style="width:100%;"  >'+
                        '<option value="1">شاي / Tea</option>'+
                           ' <option value="2">قهوة / Coffee</option>'+
                            '<option value="3">طبق/ Saucer</option>'+
                            '<option value="4">مبخرة/ Incense Burner</option>'+
                            '<option value="5">عصير-ماء/ Juice or Water</option>'+
                            '<option value="6">شيشة/ Glass Bottle</option>'+
                            '<option value="7">إبريق/  Jug </option>'+
                            '<option value="8">سكرية/ Sugar Bowl</option>;'+
                        $.each(response, function(index, value) {
                          html2 += '<option value="'+value.id+'">'+value.name+'</option>';             
                        });
                        
                      html2 += '</select>'+
                    '</td>'+ 
                    '<td><input type="date" class="datepicker-days" id="Rec_date_'+row_id2+'"  name="Rec_date[]"  value=""autocomplete="off" /></td>'+
                    
                      '<td><input type="text" name="qty4[]" id="qty4_'+row_id2+'" class="form-control"  ></td>'+
            '<td><input type="text" name="orders[]" id="orders_'+row_id2+'" class="form-control" ></td>'+
                                
            '<td><button type="button" class="btn btn-default" onclick="removeRow2(\''+row_id2+'\')"><i class="fa fa-close"></i></button></td>'+
                    '</tr>';

                if(count_table_tbody_tr2 >= 1) {
                $("#items_info_table2 tbody tr:last").after(html2);  
              }
              else {
                $("#items_info_table2 tbody").html(html2);
              }

              $(".product").select2();

          }
        });

      return false;
    });

  }); // /document
 
  });
  
   
  function removeRow2(tr_id)
  {
    $("#items_info_table2 tbody tr#row_"+tr_id).remove();
    
  }
  function removeRow1(tr_id)
  {
    $("#items_info_table1 tbody tr#row_"+tr_id).remove();
    
  }
  function removeRow(tr_id)
  {
    $("#items_info_table tbody tr#row_"+tr_id).remove();
    
  }
</script>