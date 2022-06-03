


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
            <h3 class="box-title">Edit BrushStore</h3>
            </div>

          <!-- /.box-header -->
          <form role="form" action="<?php base_url('BrushStore/update') ?>" method="post" >
              <div class="box-body">

                <?php echo validation_errors(); ?>

<?php


        if (json_decode($BrushStore_data['image']) == 0||json_decode($BrushStore_data['image']) == '')
        {$images[0] =  "assets/images/BrushStores/Byblos.gif";}
        else
        {$images = json_decode($BrushStore_data['image']);}
        ?>

                

          
                <div class="form-group">
                    <input type="hidden"  class="form-control" id="Image_M" name="Image_M" value='<?php  echo $BrushStore_data['image']; ?>' autocomplete="off" />
<input type="hidden"  class="form-control" id="id_brush" name="id_brush" value='<?php  echo $BrushStore_data['id']; ?>' autocomplete="off" />

                  <?php foreach ($images as $k => $v): ?>
                                <img src="<?php echo base_url() . $v ?>" width="250" height="250" class="img-Thumbnail">
                <?php endforeach ?>

                </div>

                <div class="form-group">
                  <label for="BrushStore_image">Update Image</label>
                  <div class="kv-avatar">
                      <div class="file-loading">
                          <input id="BrushStore_image" name="BrushStore_image[]" type="file" multiple>

                      </div>
                  </div>
                </div>
                  <label>Change Image/تغير الصورة</label>
                  <input type="checkbox" name="change_image" id="change_image"  />
<script>
    
    document.getElementById('change_image').onchange = function()
                   {if (this.checked)
            {
                        $("#image").val("0");
                        document.getElementById('change_image').disabled="true";
                    }}
</script>
             <div class="form-group">

    <label style=" font-size: 20px "for="items_info_table"> انواع الالوان/ Color Type</label>
                   <table class="table table-bordered" id="items_info_table">

                        <?php $product = json_decode($BrushStore_data['product']);
                         $details = json_decode($BrushStore_data['details']);
                         $qty = json_decode($BrushStore_data['qty']);
                         $items = json_decode($BrushStore_data['items']);
                         $qty2 = json_decode($BrushStore_data['qty2']);
                          $items1 = json_decode($BrushStore_data['items1']);
                          $add_date = json_decode($BrushStore_data['add_date']);
                         $qty3 = json_decode($BrushStore_data['qty3']);
                         $items2 = json_decode($BrushStore_data['items2']);
                         $Rec_date = json_decode($BrushStore_data['Rec_date']);
                         $qty4 = json_decode($BrushStore_data['qty4']);
                         $note3 = json_decode($BrushStore_data['note3']);
                          $orders = json_decode($BrushStore_data['orders']);
                          $istext = json_decode($BrushStore_data['istext']);
                          $rownum = json_decode($BrushStore_data['rownum']);
                          
                          ?>
                  <thead>
                    <tr>

                       <th style="width:45%">المادة/ Items</th>
                      <th style="width:25%">رقم الصنف/ Item Number</th>
                      <th style="width:25%">الكمية غرام/ Qty gr</th>

                      <th style="width:5%"><button type="button" id="add_row" class="btn btn-default"><i class="fa fa-plus"></i></button></th>
                    </tr>
                  </thead>

                   <tbody>
                      <?php if(isset($BrushStore_data['product'])): ?>
                      <?php $x = 1;
                      $c = 0 ?>
                      <?php foreach ($product as $key => $val): ?>

                       <tr id="row1_<?php echo $x; ?>" >
                       <td>
                           <input type="text" class="form-control  " value="<?php echo $val?>" data-row-id="row1_<?php echo $x?>" id="product_<?php echo $x?>" name="product[]" style="width:100%;"  >
                             </td>
                        <td> <input type="text" name="details[]" id="details_<?php echo $x; ?>" class="form-control" value="<?php echo $details[$x-1]; ?>" autocomplete="off">
                        </td>
                       <td><input type="text" name="qty[]" id="qty1_<?php echo $x; ?>"value="<?php echo $qty[$x-1]; ?>" class="form-control" ></td>

                        <td><button type="button" class="btn btn-default" onclick="removeRow('<?php echo $x; ?>')"><i class="fa fa-close"></i></button></td>
                     </tr>

                     <?php $x++; ?>
                     <?php endforeach; ?>
                   <?php endif; ?>
                   </tbody>
                </table>


        </div>

                   <div class="form-group">
                  
                    <label for="Tray">إسم المواد / Item Name</label>
                    <input type="text" class="form-control" id="film" name="film" value="<?php echo $BrushStore_data['film']?>" autocomplete="off" />
                    <label for="Tray">Supplier /المورد</label>
                    <input type="text" class="form-control" id="Tray" name="Tray" value="<?php echo $BrushStore_data['Tray']?>" autocomplete="off" />
                    <input type="hidden" class="form-control" id="update" name="update" value="<?php if( $BrushStore_data['update_Sticker'] == 2){echo 1;}?>" autocomplete="off" />
                    <input type="hidden" class="form-control" id="image" value="<?php if (json_decode($BrushStore_data['image'])!= "") { echo 1;} else {echo 0;}?>"name="image" placeholder="Enter Tray Number"  autocomplete="off" />
                    <label for="Tray">Note/ ملاحظة</label>
                    <input type="text" class="form-control" id="note" name="note"  value="<?php echo $BrushStore_data['note']?>" autocomplete="off" />
                    <label for="Tray">Burning Temp/ درجة حرارة الشواء</label>
                    <input type="text" class="form-control" id="note2" name="note2"  value="<?php echo $BrushStore_data['note2']?>" autocomplete="off" />


 </div>


                  <label style=" font-size: 20px "for="items_info_table1">إضافة مواد/ Add Items +</label>
                   <table class="table table-bordered" id="items_info_table1">
                  <thead>
                    <tr>

                      <th style="width:45%">المادة/ Items</th>
                      <th style="width:15%">التاريخ/ Date</th>
                      <th style="width:35%">الكمية بالقطعة/ Qty</th>

                      <th style="width:5%"><button type="button" id="add_row1" class="btn btn-default"><i class="fa fa-plus"></i></button></th>
                    </tr>
                  </thead>

                   <tbody>

                        <?php if(isset($BrushStore_data['items1'])): ?>
                      <?php $y = 1; ?>
                      <?php if ($items1 != null) { foreach ($items1 as $key => $val): ?>

                       <tr id="row2_<?php echo $y; ?>" >
                 <td>
                     <button type="button" id="Add_qty_<?php echo $y; ?>" onclick="subAmount(<?php echo $y; ?>)"class="btn btn-default"><i class="fa fa-plus"></i></button>
                
                    <select class="form-control select_group product"  data-row-id="row2_<?php echo $y; ?>" id="items1_<?php echo $y; ?>" name="items1[]" style="width:80%;" >
                         <?php foreach ($product as $key1 => $val1): ?>
                            <option value="<?php echo $val1;  ?>"<?php if($val == $val1) { echo "selected='selected'"; } ?>> <?php echo $val1?></option>
                           <?php endforeach ?>
                    </select>
                    </td>
                    <td><input type="date" class="datepicker-days"  id="add_date_<?php echo $y; ?>"  name="add_date[]"  value="<?php echo $add_date[$y-1]?>"autocomplete="off" />
                     </td>

                    <td><input type="text" name="qty3[]"  id="qty3_<?php echo $y; ?>" value="<?php echo $qty3[$y-1]?>"class="form-control" ></td>
                      <td><button type="button" class="btn btn-default" onclick="removeRow1(<?php echo $y; ?>)"><i class="fa fa-close"></i></button></td>


                      </tr>

                       <?php $y++; ?>
                      <?php endforeach;} ?>
                   <?php endif; ?>
                   </tbody>
                </table>
                  <label style=" font-size: 20px "for="items_info_table2">سحب مواد/ Withdraw Items -</label>
                   <table class="table table-bordered" id="items_info_table2">
                  <thead>
                    <tr>

                      <th style="width:30%">المادة/ Items</th>
                      <th style="width:15%">تاريخ / Date</th>
                      <th style="width:15%">الكمية بالغرام/ Qty gr</th>
                      <th style="width:15%">كمية الزيت/ Oil Qty</th>
                      .<th style="width:20%">مجموع المخلوط/ Total</th>

                      <th style="width:5%"><button type="button" id="add_row2" class="btn btn-default"><i class="fa fa-plus"></i></button></th>
                    </tr>
                  </thead>

                   <tbody><?php if(isset($BrushStore_data['items2'])): ?>
                      <?php $u = 1; ?>
                      <?php if ($items2 != null) { foreach ($items2 as $key => $val): ?>

                       <tr  <?php  if ($istext[$u-1]==""){echo "style='background:grey'";}?>id="row3_<?php echo $u; ?>" >
                 <td> <?php  if ($istext[$u-1]==""){?>
                     <button type="button" id="Dec_qty_<?php echo $u; ?>" onclick="subAmount2(<?php echo $u; ?>)"class="btn btn-default"><i class="fa fa-minus"></i></button>
                   
                    <select class="form-control select_group product"  data-row-id="row3_<?php echo $u; ?>" id="items2_<?php echo $u; ?>" name="items2[]" style="width:80%;" >
                         <?php foreach ($product as $key1=> $val1): ?>
                            <option <?php if($val1 == $val) { echo "selected='selected'"; } ?>> <?php echo $val1?></option>
                           <?php endforeach ?>
                      رقم السطر/ Raw Number<input type="text" name="rownum[]"  id="rownum_<?php echo $u; ?>" value="<?php echo $u; ?>" class="form-control" style="width: 50px;"> 
                        

                      </select><?php }else {?> <input type="text" name="items2[]"  id="items2_<?php echo $u; ?>" value="<?php echo $items2[$u-1]?>" class="form-control" > <li>
                     تابع لسطر / Raw Number<input type="text" name="rownum[]"  id="rownum_<?php echo $u; ?>" value="<?php echo $rownum[$u-1]; ?>" class="form-control" style="width: 50px;"> <?php }?>
                      <input type="hidden" name="istext[]"  id="istext_<?php echo $u; ?>" value="<?php echo $istext[$u-1];?>" class="form-control" style="width: 50px;">
                 </td>
                    <td><input type="date" class="datepicker-days"   id="Rec_date_<?php echo $u; ?>"  name="Rec_date[]"  value="<?php echo $Rec_date[$u-1]?>"autocomplete="off" /></td>

                    <td><input type="number" name="qty4[]"  step="0.5" onkeyup="getTotal(<?php echo $u; ?>)" id="qty4_<?php echo $u; ?>" value="<?php echo $qty4[$u-1]?>"class="form-control" ></td>
                    <td><input type="text" name="orders[]"  step="0.5" onkeyup="getTotal(<?php echo $u; ?>)" id="orders_<?php echo $u; ?>" value="<?php echo $orders[$u-1]?>"class="form-control" >
                  

                   </td>
                    <td><input type="text" name="note3[]" step="0.5" id="note3_<?php echo $u; ?>" value="<?php echo $note3[$u-1]?>"class="form-control" >
                     <td> <?php  if ($istext[$u-1]==""):?>
                        <button type="button" onclick="employee(<?php echo $u; ?>)" id="add_row3"class="btn btn-default"><i class="fa fa-dashboard"></i></button>
                   الإنتاج/ Production 
                     <?php endif;?>  </td>

                    
                    <td><button type="button" class="btn btn-default" onclick="removeRow2(<?php echo $u; ?>)"><i class="fa fa-close"></i></button></td>


                      </tr>

                      <?php $u++; ?>

                      <?php endforeach;} ?>
                   <?php endif; ?>
                   </tbody>
                </table>






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




  </section>
  <!-- /.content -->
</div>
<!-- /.content-wrapper -->

<script type="text/javascript" >

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
               var html = '<tr id="row1_'+row_id+'">'+

                   '<td>'+
                   
                    '<input typ="text" class="form-control " data-row-id="'+row_id+'"  id="product_'+row_id+'" name="product[]" style="width:80%;" >'+
                        
                        
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
      var id= $("#id_brush").val();

      $.ajax({
          url: base_url + '/BrushStore/getActiveProductData/'+id,
          type: 'post',
          dataType: 'json',
          success:function(response) {

              // console.log(reponse.x);
               var html1 = '<tr id="row2_'+row_id1+'">'+

                   '<td>'+
                   '<button type="button" id="Add_qty_'+row_id1+'" onclick="subAmount('+row_id1+')" class="btn btn-default"><i class="fa fa-plus"></i></button>'+
                   
                    '<select class="form-control select_group product" data-row-id="'+row_id1+'"  id="items1_'+row_id1+'" name="items1[]" style="width:80%;" >'+
                         '<option value=""></option>';
                        
    var Note1 = response.product;
    var Note2= Note1.split('","');
  var Note3= JSON.parse(Note2);
 
  var Note5= Note3[0].split(',');
 
                        $.each(Note5, function(index, value) {
                          html1 += '<option value="'+value+'">'+value+'</option>';
                        });

                      html1 += '</select>'+
                    '</td>'+
                    '<td><input type="date" class="datepicker-days" id="add_date_'+row_id1+'"  name="add_date[]"  value=""autocomplete="off" /></td>'+

                      '<td><input type="number" name="qty3[]" onkeyup="getTotal('+row_id1+')  id="qty3_'+row_id1+'"class="form-control" ></td>'+
               
    
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
var id= $("#id_brush").val();

      $.ajax({
          url: base_url + '/BrushStore/getActiveProductData/'+id,
          type: 'post',
          dataType: 'json',
          success:function(response) {

              // console.log(reponse.x);
               var html2 = '<tr id="row3_'+row_id2+'">'+

                   '<td>'+
                    '<button type="button" id="Add_qty_'+row_id2+'" onclick="subAmount2('+row_id2+')" class="btn btn-default"><i class="fa fa-minus"></i></button>'+
                    '<select class="form-control select_group product" data-row-id="'+row_id2+'" id="items2_'+row_id2+'" name="items2[]" style="width:80%;" >'+
                        '<option value=""></option>';
                        
    var Note1 = response.product;
    var Note2= Note1.split('","');
  var Note3= JSON.parse(Note2);
 
  var Note5= Note3[0].split(',');
 
                        $.each(Note5, function(index, value) {
                          html2 += '<option value="'+value+'">'+value+'</option>';
                        });


                      html2 += '</select>'+
                    '</td>'+
                    '<td><input type="date" class="datepicker-days" id="Rec_date_'+row_id2+'"  name="Rec_date[]"  value=""autocomplete="off" /></td>'+
            '<td><input type="number" name="qty4[]"  step="0.5" id="qty4_'+row_id2+'"onkeyup="getTotal('+row_id2+')"  class="form-control" ></td>'+
            '<td><input type="number" name="orders[]"  step="0.5" onkeyup="getTotal('+row_id2+')"id="orders_'+row_id2+'"  class="form-control" ></td>'+
            '<td><input type="number" name="note3[]" id="note3_'+row_id2+'" step="0.5" class="form-control" >'+
'<input type="hidden" name="rownum[]" onkeyup="getTotal('+row_id2+')  id="rownum_'+row_id2+'"class="form-control" >'+
      '<input type="hidden" name="istext[]" onkeyup="getTotal('+row_id2+')  id="istext_'+row_id2+'"class="form-control" ></td>'+
    
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

 

function employee(row) 
{
    
       
    
    $("#rownum_"+row).val(row );
 
      var count_table_tbody_tr3 = $("#items_info_table2 tbody tr").length;
      var row_id3 = count_table_tbody_tr3 + 1;


      {

              // console.log(reponse.x);
               var html3 = '<tr id="row3_'+row_id3+'">'+

                   '<td>'+
                     '<label>Employee</label><input type="text" name="items2[]" id="items2_'+row_id3+'"  class="form-control" >تابع لسطر / Raw Number<input type="text" name="rownum[]"  id="rownum_'+row_id3+'" value="'+row+'" class="form-control" style="width: 50px;"> <input type="hidden" name="istext[]"  id="istext_'+row_id3+'" value="1" class="form-control" style="width: 50px;">'+
            
                    '</td>'+
                    '<td>'+
       '<label>Date</label>'+
   
'<input type="date" class="datepicker-days" id="Rec_date_'+row_id3+'"  name="Rec_date[]"  value=""autocomplete="off" /></td>'+

                      '<td><label>Qty</label><input type="number"  step="0.5" name="qty4[]" id="qty4_'+row_id3+'"  class="form-control" ></td>'+
            '<td><label>Order Number</label><input type="Text" name="orders[]" id="orders_'+row_id3+'"  class="form-control" ></td>'+
'<td><label>Note</label><input type="Text" name="note3[]" id="note3_'+row_id3+'"  class="form-control" ><input type="text" name="rownum[]" value= "'+row+'"  id="rownum_'+row_id3+'" class="form-control" ></td>'+

            '<td><button type="button" class="btn btn-default" onclick="removeRow2(\''+row_id3+'\')"><i class="fa fa-close"></i></button></td>'+
                    '</tr>';

                if(count_table_tbody_tr3 >= 1) {
                $("#items_info_table2 tbody tr:last").after(html3);
              }
              else {
                $("#items_info_table2 tbody").html(html3);
              }

              $(".product").select2();

          }
       

      return false;
    }
  function subAmount(num) 
  {



  var tableProductLength = $("#items_info_table tbody tr").length;
 
  
      for(x = 0; x <= tableProductLength; x++)
      {
      if ($("#items1_"+num).val() === $("#product_"+x).val() )
      {var Sum = Number($("#qty1_"+x).val())+Number($("#qty3_"+num).val());
      $("#qty1_"+x).val(Sum);}
  }
      
  
  document.getElementById("Add_qty_"+num).disabled= true;
  

    }
    
     function getTotal(row = null) {
   if(row) {
      
      var total = (Number($("#qty4_"+row).val())+Number($("#orders_"+row).val()));
      total = total.toFixed(2);
      $("#note3_"+row).val(total);
      
      
     

    } else {
      alert('no row !! please refresh the page');
    }
  }
    function subAmount2(num) 
  {



  var tableProductLength = $("#items_info_table tbody tr").length;
 
  
      for(x = 0; x <= tableProductLength; x++)
      {
      if ($("#items2_"+num).val() === $("#product_"+x).val() )
      {var Sum = Number($("#qty1_"+x).val())-Number($("#qty4_"+num).val());
      $("#qty1_"+x).val(Sum);}
  }
      
  
  document.getElementById("Dec_qty_"+num).disabled= true;
  

    }
    function subAmount3(num) 
  {



  var tableProductLength = $("#items_info_table tbody tr").length;
 
  
      for(x = 0; x <= tableProductLength; x++)
      {
      if ($("#items2_"+num).val() === $("#product_"+x).val() )
      {var Sum = Number($("#qty1_"+x).val())-Number($("#qty4_"+num).val());
      $("#qty1_"+x).val(Sum);}
  }
      
  
  document.getElementById("Dec_qty_"+num).disabled= true;
  

    }
  function removeRow2(tr_id)
  {
    $("#items_info_table2 tbody tr#row3_"+tr_id).remove();

  }
  function removeRow1(tr_id)
  {
    $("#items_info_table1 tbody tr#row2_"+tr_id).remove();

  }
  function removeRow(tr_id)
  {
    $("#items_info_table tbody tr#row1_"+tr_id).remove();

  }
</script>

