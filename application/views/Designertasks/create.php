

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
       <h1>
      Manage
      <small>Designer Tasks</small>
    </h1>
    <ol class="breadcrumb">
      <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
      <li class="active">Designertasks</li>
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
            <h3 class="box-title">Add Designer Tasks</h3>
          </div>
          <!-- /.box-header -->
          <form role="form" action="<?php base_url('Designertasks/create') ?>" method="post" enctype="multipart/form-data">
              <div class="box-body">

                <?php echo validation_errors(); ?>

                <div class="form-group">
                    <label style="font-size: 30px" for="Tittle">عنوان المهمة/ Task Tittle</label>
                    <input type="text" style="width: 600px" class="form-control" id="Tittle" name="Tittle"  autocomplete="off" />
                  
                  
                    </div>
                   <div class="form-group">
                    <label style="font-size: 30px" for="Tittle"> بطلب من/ Requester Name</label>
                    <input type="text" style="width: 600px" class="form-control" id="person" name="person"  autocomplete="off" />
                  
                  
                    </div>
                  <div class="form-group">
                    <label style="font-size: 30px" for="Deadline"> المهلة المحددة للتسليم/ Delivery Date (Deadline)</label>
                    <input type="date"  style="width: 600px; font-size:  20px" class="form-control" id="Deadline" name="Deadline"  autocomplete="off" />
                  
                  
                    </div>
                  <div class="form-group">
                 <label style="font-size: 20px" for="Tray"> رسم توضيحي/ Sample Draw:</label>
                      <img id="imagepreview"  width="300" height=300" class="img-Thumbnail">
               
                </div>

                <div class="form-group">
                  <label for="Designertasks_image">Update Image</label>
                  <div class="kv-avatar">
                      <div class="file-loading">
                          <input id="Designertasks_image" name="Designertasks_image[]" type="file" multiple>
                      </div>
                  </div>
                </div>
                    
          <div class="form-group">
 
    <label style=" font-size: 20px "for="items_info_table">التصاميم المطلوبة/ The Needed Designs</label>
                   <table class="table table-bordered" id="items_info_table">
                  <thead>
                    <tr>
                      
                      <th style="width:20%">عنوان التصميم/ Design Tittle </th>
                     
                      <th style="width:20%">تفاصيل التصميم/ Design Details </th>
                      <th style="width:15%">Design Number/رقم التصميم</th>
                      <th style="width:20%">تاريخ الإنتهاء/ Finished Date</th>
                      
                      <th style="width:20%">حالة العمل/ Work Status </th>
                      <th style="width:5%"><button type="button" id="add_row" class="btn btn-default"><i class="fa fa-plus"></i></button></th>
                    </tr>
                  </thead>

                   <tbody>
                     <tr id="row_1">
                         <td>
                          <input type="text" name="Subtitle[]" id="Subtitle_1" class="form-control"  autocomplete="off">
                        </td>
                        <td>
                          <input type="text" name="details[]" id="details_1" class="form-control"  autocomplete="off">
                         </td>
                        <td>
                          <input type="text" class="form-control" id="film_1" name="film[]"  autocomplete="off" /> </td>
                        <td>
                          <input type="text" name="done_date[]" id="done_date_1"  readonly class="form-control"  autocomplete="off">
                           </td>
                           <td>  <input style=" -ms-transform: scale(2);  -moz-transform: scale(2); -webkit-transform: scale(2); -o-transform: scale(2); transform: scale(2);  padding: 10px;" type="checkbox" id="Done1_1" name="Done1[]" value="Done"    onchange= "finishtime(1)"> 
                            <label style="font-size: 20px;" for="Done">--Done </label><br>
                            <input type="hidden" class="form-control" id="Done_1" name="Done[]"  value="0" autocomplete="off" /> </td>
                       </td>
                        <td><button type="button" class="btn btn-default" onclick="removeRow('1')"><i class="fa fa-close"></i></button></td>
                     </tr>
                   </tbody>
                </table>
        </div> 
                   <label for="note">Note/ ملاحظة</label>
                  <input type="text" class="form-control" id="note" name="note"   autocomplete="off" />
                    </div>
              <!-- /.box-body -->
    </div>
              <div class="box-footer">
                <button type="submit" class="btn btn-primary">Save Changes/حفظ</button>
                <a href="<?php echo base_url('Designertasks/') ?>" class="btn btn-warning">Back/ الرجوع</a>
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
   

    $("#mainDesignertasksNav").addClass('active');
    $("#addDesignertasksNav").addClass('active');
    
   
window.addEventListener("paste", e => {
        if (e.clipboardData.files.length > 0)
        {const fileInput = document.querySelector("#Designertasks_image");
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
    $("#Designertasks_image").fileinput({
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
                          '<input type="text" name="Subtitle[]" id="Subtitle_'+row_id+'" class="form-control"  autocomplete="off">'+
                        '</td>'+
                        '<td>'+
                          '<input type="text" name="details[]" id="details_'+row_id+'" class="form-control"  autocomplete="off">'+
                         '</td>'+
                        '<td>'+
                          '<input type="text" class="form-control" id="film_'+row_id+'" name="film[]"  autocomplete="off" /> </td>'+
                        '<td>'+
                          '<input type="text" name="done_date[]" id="done_date_'+row_id+'"  readonly class="form-control"  autocomplete="off">'+
                           '</td>'+
                          '<td>  <input style=" -ms-transform: scale(2);  -moz-transform: scale(2); -webkit-transform: scale(2); -o-transform: scale(2); transform: scale(2);  padding: 10px;" type="checkbox" id="Done1_'+row_id+'" name="Done1[]" value="Done" onchange= "finishtime('+row_id+')"> '+
                            '<label style="font-size: 20px;" for="Done">--Done </label><br>'+
                       '<input type="hidden" class="form-control" id="Done_'+row_id+'" name="Done[]"  value="0" autocomplete="off" /> </td>'+
                    
            '</td>'+
                        '<td><button type="button" class="btn btn-default" onclick="removeRow('+row_id+')"><i class="fa fa-close"></i></button></td>'+
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


 
 
   
  
    

  }); // /document
 
  });
  
  function finishtime(row_id)
  {
var today = new Date();

var date = today.getFullYear()+'-'+(today.getMonth()+1)+'-'+today.getDate()+'['+today.getHours() + ":" + today.getMinutes()+"]";
    
    $("#done_date_"+row_id).val(date) ;
    $("#Done_"+row_id).val("Done") ;
 
   var checkBox = document.getElementById('Done1_'+row_id);   
  
   if (checkBox.checked === true)
   {
        $("#Done_"+row_id).val("Done") ;
          $("#done_date_"+row_id).val(date) ;
    }
    else 
    {$("#Done_"+row_id).val("0");
      $("#done_date_"+row_id).val('0') ;}
  } 
  
  
  function removeRow(tr_id)
  {
    $("#items_info_table tbody tr#row_"+tr_id).remove();
    
  }
</script>