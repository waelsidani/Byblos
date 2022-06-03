

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
       <h1>
      Manage
      <small>BrushStore</small>
    </h1>
    <ol class="breadcrumb">
      <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
      <li class="active">BrushStore</li>
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
            <h3 class="box-title">Add Color/ إضافة لون جديد</h3>
          </div>
          <!-- /.box-header -->
          <form role="form" action="<?php base_url('BrushStore/create') ?>" method="post" enctype="multipart/form-data">
              <div class="box-body">

                <?php echo validation_errors(); ?>

                <div class="form-group">

                  <div class="form-group">
                 
                      <img id="imagepreview"  width="250" height="250" class="img-Thumbnail">
               
                </div>

                <div class="form-group">
                  <label for="BrushStore_image">Update Image</label>
                  <div class="kv-avatar">
                      <div class="file-loading">
                          <input id="BrushStore_image" name="BrushStore_image[]" type="file" multiple>
                      </div>
                  </div>
                </div>
                    
          <div class="form-group">
 
    <label style=" font-size: 20px "for="items_info_table"> انواع الالوان/ Color Type</label>
                   <table class="table table-bordered" id="items_info_table">
                  <thead>
                    <tr>
                      
                      <th style="width:45%">المادة/ Items</th>
                      <th style="width:25%">رقم الصنف/ Item Number</th>
                      <th style="width:25%">الكمية غرام/ Qty gr</th>
                      
                      <th style="width:5%"><button type="button" id="add_row" class="btn btn-default"><i class="fa fa-plus"></i></button></th>
                    </tr>
                  </thead>

                   <tbody>
                     <tr id="row_1">
                         
                         
                       <td>
                       <input type="text"  class="form-control " data-row-id="row_1" id="product_1" name="product[]" style="width:100%;"  >
                            
                            
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
                
                   <label for="Tray">إسم المواد / Item Name</label>
                  <input type="text" class="form-control" id="film" name="film"  autocomplete="off" />
                   
             
                    <label for="Tray">Supplier /المورد</label>
                  <input type="text" class="form-control" id="Tray" name="Tray"  autocomplete="off" />
                  
                  
                    
                  
                  
                   <label for="Tray">Note/ ملاحظة</label>
                  <input type="text" class="form-control" id="note" name="note"   autocomplete="off" />
                   
              <label for="Tray">Burning Temp/ درجة حرارة الشواء</label>
                  <input type="text" class="form-control" id="note2" name="note2"   autocomplete="off" />
                  
      
                   
    
                  </div>
             
                  
                   
             </div>
              <!-- /.box-body -->
    </div>
              <div class="box-footer">
                <button type="submit" class="btn btn-primary">Save Changes/حفظ</button>
                <a href="<?php echo base_url('BrushStore/') ?>" class="btn btn-warning">Back/ الرجوع</a>
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
   

    $("#mainBrushStoreNav").addClass('active');
    $("#addBrushStoreNav").addClass('active');
    
   
window.addEventListener("paste", e => {
        if (e.clipboardData.files.length > 0)
        {const fileInput = document.querySelector("#BrushStore_image");
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
    $("#BrushStore_image").fileinput({
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
                    '<input type="text" class="form-control " data-row-id="'+row_id+'" id="product_'+row_id+'" name="product[]" style="width:100%;" >';
                       
                       
                        
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