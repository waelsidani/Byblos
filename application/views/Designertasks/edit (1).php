


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
            <h3 class="box-title">Edit Desingertasks</h3>
            </div>

          <!-- /.box-header -->
          <form role="form" action="<?php base_url('Desingertasks/update') ?>" method="post" >
              <div class="box-body">

                <?php echo validation_errors(); ?>

<?php


        if (json_decode($Desingertasks_data['image']) == 0||json_decode($Desingertasks_data['image']) == '')
        {$images[0] =  "assets/images/Desingertaskss/Byblos.gif";}
        else
        {$images = json_decode($Desingertasks_data['image']);}
        ?>

                

          
                <div class="form-group">
                    <input type="hidden"  class="form-control" id="Image_M" name="Image_M" value='<?php  echo $Desingertasks_data['image']; ?>' autocomplete="off" />

                  <?php foreach ($images as $k => $v): ?>
                                <img src="<?php echo base_url() . $v ?>" width="600" height="600" class="img-Thumbnail">
                <?php endforeach ?>

                </div>

                <div class="form-group">
                  <label for="Desingertasks_image">Update Image</label>
                  <div class="kv-avatar">
                      <div class="file-loading">
                          <input id="Desingertasks_image" name="Desingertasks_image[]" type="file" multiple>

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

    <label style=" font-size: 20px "for="items_info_table">محتويات الستيكر/ Sticker Details</label>
                   <table class="table table-bordered" id="items_info_table">

                        <?php $product = json_decode($Desingertasks_data['product']);
                         $details = json_decode($Desingertasks_data['details']);
                         $qty = json_decode($Desingertasks_data['qty']);
                         $items = json_decode($Desingertasks_data['items']);
                         $qty2 = json_decode($Desingertasks_data['qty2']);
                          $items1 = json_decode($Desingertasks_data['items1']);
                          $add_date = json_decode($Desingertasks_data['add_date']);
                         $qty3 = json_decode($Desingertasks_data['qty3']);
                         $items2 = json_decode($Desingertasks_data['items2']);
                         $Rec_date = json_decode($Desingertasks_data['Rec_date']);
                         $qty4 = json_decode($Desingertasks_data['qty4']);
                          $orders = json_decode($Desingertasks_data['orders']);
                          ?>
                  <thead>
                    <tr>

                      <th style="width:45%">المادة/ Items</th>
                      <th style="width:25%">نوع الصنف/ Item Details</th>
                      <th style="width:25%">الكمية بالقطعة/ Qty</th>

                      <th style="width:5%"><button type="button" id="add_row" class="btn btn-default"><i class="fa fa-plus"></i></button></th>
                    </tr>
                  </thead>

                   <tbody>
                      <?php if(isset($Desingertasks_data['product'])): ?>
                      <?php $x = 1;
                      $c = 0 ?>
                      <?php foreach ($product as $key => $val): ?>

                       <tr id="row1_<?php echo $x; ?>" >
                       <td>
                        <select class="form-control select_group product" data-row-id="row1_<?php echo $x?>" id="product_<?php echo $x?>" name="product[]" style="width:100%;"  >
                             <option value="-">-</option>
                            <option value="1"<?php if($val[$c] == "1") { echo "selected='selected'"; } ?>>شاي / Tea</option>
                            <option value="2"<?php if($val[$c] == "2") { echo "selected='selected'"; } ?>>قهوة / Coffee</option>
                            <option value="3"<?php if($val[$c] == "3") { echo "selected='selected'"; } ?>>طبق/ Saucer</option>
                            <option value="4"<?php if($val[$c] == "4") { echo "selected='selected'"; } ?>>مبخرة/ Incense Burner</option>
                            <option value="5"<?php if($val[$c] == "5") { echo "selected='selected'"; } ?>>عصير-ماء/ Juice or Water</option>
                            <option value="6"<?php if($val[$c] == "6") { echo "selected='selected'"; } ?>>شيشة/ Glass Bottle</option>
                            <option value="7"<?php if($val[$c] == "7") { echo "selected='selected'"; } ?>>إبريق/  Jug </option>
                            <option value="8"<?php if($val[$c] == "8") { echo "selected='selected'"; } ?>>سكرية/ Sugar Bowl</option>

                          </select>
                       </td>
                        <td>
                            <input type="text" name="details[]" id="details_<?php echo $x; ?>" class="form-control" value="<?php echo $details[$x-1]; ?>" autocomplete="off">

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
                      <th style="width:12.5%">الكمية بالقطعة/ Qty</th>


                       </tr>
                  </thead>

                   <tbody>
                    <tr>



                          <td><select class="form-control" id="items_1"  name="items[]" >
                            <option value="">-</option>
                            <option value="1"<?php if($items[0] == 1) { echo "selected='selected'"; } ?>>شاي / Tea</option>
                            <option value="2"<?php if($items[0] == 2) { echo "selected='selected'"; } ?>>قهوة / Coffee</option>
                            <option value="3"<?php if($items[0] == 3) { echo "selected='selected'"; } ?>>طبق/ Saucer</option>
                            <option value="4"<?php if($items[0] == 4) { echo "selected='selected'"; } ?>>مبخرة/ Incense Burner</option>
                            <option value="5"<?php if($items[0] == 5) { echo "selected='selected'"; } ?>>عصير-ماء/ Juice or Water</option>
                            <option value="6"<?php if($items[0] == 6) { echo "selected='selected'"; } ?>>شيشة/ Glass Bottle</option>
                            <option value="7"<?php if($items[0] == 7) { echo "selected='selected'"; } ?>>إبريق/  Jug </option>
                            <option value="8"<?php if($items[0] == 8) { echo "selected='selected'"; } ?>>سكرية/ Sugar Bowl</option>
            </select></td>
            <td><input type="text" class="form-control" id="qty_1" name="qty2[]" value="<?php echo $qty2[0]?>"  autocomplete="off" />
            <input type="hidden" class="form-control" id="temp_qty_1"  name="temp_qty2[]" value="<?php echo $qty2[0]?>"  autocomplete="off" />

            </td>

                          <td><select class="form-control" id="items_2" name="items[]" >
                           <option value="">-</option>
                            <option value="1"<?php if($items[1] == 1) { echo "selected='selected'"; } ?>>شاي / Tea</option>
                            <option value="2"<?php if($items[1] == 2) { echo "selected='selected'"; } ?>>قهوة / Coffee</option>
                            <option value="3"<?php if($items[1] == 3) { echo "selected='selected'"; } ?>>طبق/ Saucer</option>
                            <option value="4"<?php if($items[1] == 4) { echo "selected='selected'"; } ?>>مبخرة/ Incense Burner</option>
                            <option value="5"<?php if($items[1] == 5) { echo "selected='selected'"; } ?>>عصير-ماء/ Juice or Water</option>
                            <option value="6"<?php if($items[1] == 6) { echo "selected='selected'"; } ?>>شيشة/ Glass Bottle</option>
                            <option value="7"<?php if($items[1] == 7) { echo "selected='selected'"; } ?>>إبريق/  Jug </option>
                            <option value="8"<?php if($items[1] == 8) { echo "selected='selected'"; } ?>>سكرية/ Sugar Bowl</option>

                              </select></td> <td><input type="text" class="form-control"  id="qty_2"  value="<?php echo $qty2[1]?>"name="qty2[]" autocomplete="off" />
                              <input type="hidden" class="form-control" id="temp_qty_2"  name="temp_qty2[]" value="<?php echo $qty2[1]?>"  autocomplete="off" />

                              </td>

                          <td><select class="form-control" id="items_3"  name="items[]" >
                            <option value="">-</option>
                            <option value="1"<?php if($items[2] == 1) { echo "selected='selected'"; } ?>>شاي / Tea</option>
                            <option value="2"<?php if($items[2] == 2) { echo "selected='selected'"; } ?>>قهوة / Coffee</option>
                            <option value="3"<?php if($items[2] == 3) { echo "selected='selected'"; } ?>>طبق/ Saucer</option>
                            <option value="4"<?php if($items[2] == 4) { echo "selected='selected'"; } ?>>مبخرة/ Incense Burner</option>
                            <option value="5"<?php if($items[2] == 5) { echo "selected='selected'"; } ?>>عصير-ماء/ Juice or Water</option>
                            <option value="6"<?php if($items[2] == 6) { echo "selected='selected'"; } ?>>شيشة/ Glass Bottle</option>
                            <option value="7"<?php if($items[2] == 7) { echo "selected='selected'"; } ?>>إبريق/  Jug </option>
                            <option value="8"<?php if($items[2] == 8) { echo "selected='selected'"; } ?>>سكرية/ Sugar Bowl</option>
             </select></td>

            <td><input type="text" class="form-control"  id="qty_3"   name="qty2[]" value="<?php echo $qty2[2]?>" autocomplete="off" />
            <input type="hidden" class="form-control" id="temp_qty_3"  name="temp_qty2[]" value="<?php echo $qty2[2]?>"  autocomplete="off" />

            </td>


                               <td><select class="form-control"  id="items_4" name="items[]" >
                            <option value="">-</option>
                            <option value="1"<?php if($items[3] == 1) { echo "selected='selected'"; } ?>>شاي / Tea</option>
                            <option value="2"<?php if($items[3] == 2) { echo "selected='selected'"; } ?>>قهوة / Coffee</option>
                            <option value="3"<?php if($items[3] == 3) { echo "selected='selected'"; } ?>>طبق/ Saucer</option>
                            <option value="4"<?php if($items[3] == 4) { echo "selected='selected'"; } ?>>مبخرة/ Incense Burner</option>
                            <option value="5"<?php if($items[3] == 5) { echo "selected='selected'"; } ?>>عصير-ماء/ Juice or Water</option>
                            <option value="6"<?php if($items[3] == 6) { echo "selected='selected'"; } ?>>شيشة/ Glass Bottle</option>
                            <option value="7"<?php if($items[3] == 7) { echo "selected='selected'"; } ?>>إبريق/  Jug </option>
                            <option value="8"<?php if($items[3] == 8) { echo "selected='selected'"; } ?>>سكرية/ Sugar Bowl</option>
           </select></td>

            <td><input type="text" class="form-control"  id="qty_4"  name="qty2[]" value="<?php echo $qty2[3]?>" autocomplete="off" />
                    <input type="hidden" class="form-control" id="temp_qty_4"  name="temp_qty2[]" value="<?php echo $qty2[3]?>"  autocomplete="off" /></td>


                    </tr>



                   </tbody>
                </table>
                    <label for="Tray">Tray Number/رقم الدرج</label>
                    <input type="text" class="form-control" id="Tray" name="Tray" value="<?php echo $Desingertasks_data['Tray']?>" autocomplete="off" />


                    </div>


                   <label for="Tray">Design Number/رقم التصميم</label>
                  <input type="text" class="form-control" id="film" name="film" value="<?php echo $Desingertasks_data['film']?>" autocomplete="off" />
                   <input type="hidden" class="form-control" id="update" name="update" value="<?php if( $Desingertasks_data['update_Sticker'] == 2){echo 1;}?>" autocomplete="off" />
                 
                  <input type="hidden" class="form-control" id="image" value="<?php if (json_decode($Desingertasks_data['image'])!= "") { echo 1;} else {echo 0;}?>"name="image" placeholder="Enter Tray Number"  autocomplete="off" />
                   <label for="Tray">Note/ ملاحظة</label>
                  <input type="text" class="form-control" id="note" name="note"  value="<?php echo $Desingertasks_data['note']?>" autocomplete="off" />







                  <label style=" font-size: 20px "for="items_info_table1">إضافة ستيكر/ Add Sticker +</label>
                   <table class="table table-bordered" id="items_info_table1">
                  <thead>
                    <tr>

                      <th style="width:45%">المادة/ Items</th>
                      <th style="width:25%">التاريخ/ Date</th>
                      <th style="width:25%">الكمية بالقطعة/ Qty</th>

                      <th style="width:5%"><button type="button" id="add_row1" class="btn btn-default"><i class="fa fa-plus"></i></button></th>
                    </tr>
                  </thead>

                   <tbody>

                        <?php if(isset($Desingertasks_data['items1'])): ?>
                      <?php $y = 1; ?>
                      <?php if ($items1 != null) { foreach ($items1 as $key => $val): ?>

                       <tr id="row2_<?php echo $y; ?>" >
                 <td>
                    <select class="form-control select_group product" onchange="subAmount()" data-row-id="row2_<?php echo $y; ?>" id="items1_<?php echo $y; ?>" name="items1[]" style="width:100%;" >
                        <option value="1"<?php if($items1[0] == 1) { echo "selected='selected'"; } ?>>شاي / Tea</option>
                            <option value="2"<?php if($items1[0] == 2) { echo "selected='selected'"; } ?>>قهوة / Coffee</option>
                            <option value="3"<?php if($items1[0] == 3) { echo "selected='selected'"; } ?>>طبق/ Saucer</option>
                            <option value="4"<?php if($items1[0] == 4) { echo "selected='selected'"; } ?>>مبخرة/ Incense Burner</option>
                            <option value="5"<?php if($items1[0] == 5) { echo "selected='selected'"; } ?>>عصير-ماء/ Juice or Water</option>
                            <option value="6"<?php if($items1[0] == 6) { echo "selected='selected'"; } ?>>شيشة/ Glass Bottle</option>
                            <option value="7"<?php if($items1[0] == 7) { echo "selected='selected'"; } ?>>إبريق/  Jug </option>
                            <option value="8"<?php if($items1[0] == 8) { echo "selected='selected'"; } ?>>سكرية/ Sugar Bowl</option>

                     

                      </select>
                    </td>
                    <td><input type="date" class="datepicker-days" onchange="subAmount()"  id="add_date_<?php echo $y; ?>"  name="add_date[]"  value="<?php echo $add_date[$y-1]?>"autocomplete="off" /></td>

                    <td><input type="text" name="qty3[]" onchange="subAmount()"  id="qty3_<?php echo $y; ?>" value="<?php echo $qty3[$y-1]?>"class="form-control" ></td>
                      <td><button type="button" class="btn btn-default" onclick="removeRow1(<?php echo $y; ?>)"><i class="fa fa-close"></i></button></td>


                      </tr>

                       <?php $y++; ?>
                      <?php endforeach;} ?>
                   <?php endif; ?>
                   </tbody>
                </table>
                  <label style=" font-size: 20px "for="items_info_table2">سحب ستيكر/ Withdraw Sticker -</label>
                   <table class="table table-bordered" id="items_info_table2">
                  <thead>
                    <tr>

                      <th style="width:35%">المادة/ Items</th>
                      <th style="width:20%">نوع الصنف/ Item Details</th>
                      <th style="width:20%">الكمية بالقطعة/ Qty</th>
                      <th style="width:20%">رقم الطلب/ Order Number</th>

                      <th style="width:5%"><button type="button" id="add_row2" class="btn btn-default"><i class="fa fa-plus"></i></button></th>
                    </tr>
                  </thead>

                   <tbody><?php if(isset($Desingertasks_data['items2'])): ?>
                      <?php $u = 1; ?>
                      <?php if ($items2 != null) { foreach ($items2 as $key => $val): ?>

                      <tr id="row3_<?php echo $u; ?>" >
                 <td>
                    <select class="form-control select_group product" onchange="subAmount()" data-row-id="row3_<?php echo $u; ?>" id="items2_<?php echo $u; ?>" name="items2[]" style="width:100%;" >
                        <option value="1"<?php if($items2[0] == 1) { echo "selected='selected'"; } ?>>شاي / Tea</option>
                            <option value="2"<?php if($items2[0] == 2) { echo "selected='selected'"; } ?>>قهوة / Coffee</option>
                            <option value="3"<?php if($items2[0] == 3) { echo "selected='selected'"; } ?>>طبق/ Saucer</option>
                            <option value="4"<?php if($items2[0] == 4) { echo "selected='selected'"; } ?>>مبخرة/ Incense Burner</option>
                            <option value="5"<?php if($items2[0] == 5) { echo "selected='selected'"; } ?>>عصير-ماء/ Juice or Water</option>
                            <option value="6"<?php if($items2[0] == 6) { echo "selected='selected'"; } ?>>شيشة/ Glass Bottle</option>
                            <option value="7"<?php if($items2[0] == 7) { echo "selected='selected'"; } ?>>إبريق/  Jug </option>
                            <option value="8"<?php if($items2[0] == 8) { echo "selected='selected'"; } ?>>سكرية/ Sugar Bowl</option>

                        

                      </select>
                    </td>
                    <td><input type="date" class="datepicker-days" onchange="subAmount()"  id="Rec_date_<?php echo $u; ?>"  name="Rec_date[]"  value="<?php echo $Rec_date[$u-1]?>"autocomplete="off" /></td>

                    <td><input type="text" name="qty4[]" onchange="subAmount()"  id="qty4_<?php echo $u; ?>" value="<?php echo $qty4[$u-1]?>"class="form-control" ></td>
                     <td><input type="text" name="orders[]" onchange="subAmount()"  id="orders_<?php echo $u; ?>" value="<?php echo $orders[$u-1]?>"class="form-control" ></td>

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
                <a href="<?php echo base_url('Desingertasks/') ?>" class="btn btn-warning">Back/ الرجوع</a>
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
                    '<select class="form-control select_group product" data-row-id="'+row_id+'"  id="product_'+row_id+'" name="product[]" style="width:100%;" >'+
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
               var html1 = '<tr id="row2_'+row_id1+'">'+

                   '<td>'+
                    '<select class="form-control select_group product" data-row-id="'+row_id1+'" onchange="subAmount()" id="items1_'+row_id1+'" name="items1[]" style="width:100%;" >'+
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
                    '<td><input type="date" class="datepicker-days" id="add_date_'+row_id1+'" onchange="subAmount()"  name="add_date[]"  value=""autocomplete="off" /></td>'+

                      '<td><input type="text" name="qty3[]" id="qty3_'+row_id1+'" onchange="subAmount()" class="form-control" ></td>'+
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
               var html2 = '<tr id="row3_'+row_id2+'">'+

                   '<td>'+
                    '<select class="form-control select_group product" data-row-id="'+row_id2+'" onchange="subAmount()" id="items2_'+row_id2+'" name="items2[]" style="width:100%;" >'+
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
                    '<td><input type="date" class="datepicker-days" id="Rec_date_'+row_id2+'"  name="Rec_date[]" onchange="subAmount()" value=""autocomplete="off" /></td>'+

                      '<td><input type="text" name="qty4[]" id="qty4_'+row_id2+'" onchange="subAmount()" class="form-control" ></td>'+
            '<td><input type="text" name="orders[]" id="orders_'+row_id2+'" onchange="subAmount()" class="form-control" ></td>'+

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

  function subAmount() {



  var tableProductLength = $("#Action_info_table> tbody > tr:first > td").length;
    var tableProductLength1 = $("#items_info_table1 tbody tr").length;
    var tableProductLength2 = $("#items_info_table2 tbody tr").length;

    var v1 = 0;
    var v2 = 0;
    var v3 = 0;
    var v4 = 0;
    var v5 = 0;
    var v6 = 0;
    var v7 = 0;
    var v8 = 0;
    var t_v1 = 0;
    var t_v2 = 0;
    var t_v3 = 0;
    var t_v4 = 0;
    var t_v5 = 0;
    var t_v6 = 0;
    var t_v7 = 0;
    var t_v8 = 0;
    var add_v1 = 0;
    var add_v2 = 0;
    var add_v3 = 0;
    var add_v4 = 0;
    var add_v5 = 0;
    var add_v6 = 0;
    var add_v7 = 0;
    var add_v8 = 0;
    var W_v1 = 0;
    var W_v2 = 0;
    var W_v3 = 0;
    var W_v4 = 0;
    var W_v5 = 0;
    var W_v6 = 0;
    var W_v7 = 0;
    var W_v8 = 0;



         for(x = 0; x < tableProductLength1; x++) {
      var tr = $("#items_info_table1 tbody tr")[x];
      var count = $(tr).attr('id');
      count = count.substring(4);
      if (Number($("#items1_"+count).val()) === 1 )
      {add_v1= Number(add_v1)+Number($("#qty3_"+count).val());}
      if (Number($("#items1_"+count).val()) === 2 )
      {add_v2= Number(add_v2)+Number($("#qty3_"+count).val());}
      if (Number($("#items1_"+count).val()) === 3 )
      {add_v3= Number(add_v3)+Number($("#qty3_"+count).val());}
      if (Number($("#items1_"+count).val()) === 4 )
      {add_v4= Number(add_v4)+Number($("#qty3_"+count).val());}
      if (Number($("#items1_"+count).val()) === 5 )
      {add_v5= Number(add_v5)+Number($("#qty3_"+count).val());}
      if (Number($("#items1_"+count).val()) === 6 )
      {add_v6= Number(add_v6)+Number($("#qty3_"+count).val());}
      if (Number($("#items1_"+count).val()) === 7 )
      {add_v7= Number(add_v7)+Number($("#qty3_"+count).val());}
      if (Number($("#items1_"+count).val()) === 8 )
      {add_v8= Number(add_v8)+Number($("#qty3_"+count).val());}
  }

            for(x = 0; x < tableProductLength2; x++) {
      var tr = $("#items_info_table2 tbody tr")[x];
      var count = $(tr).attr('id');
      count = count.substring(4);
      if (Number($("#items2_"+count).val()) === 1 )
      {W_v1= Number(W_v1)+Number($("#qty4_"+count).val());}
      if (Number($("#items2_"+count).val()) === 2 )
      {W_v2= Number(W_v2)+Number($("#qty4_"+count).val());}
      if (Number($("#items2_"+count).val()) === 3 )
      {W_v3= Number(W_v3)+Number($("#qty4_"+count).val());}
      if (Number($("#items2_"+count).val()) === 4 )
      {W_v4= Number(W_v4)+Number($("#qty4_"+count).val());}
      if (Number($("#items2_"+count).val()) === 5 )
      {W_v5= Number(W_v5)+Number($("#qty4_"+count).val());}
      if (Number($("#items2_"+count).val()) === 6 )
      {W_v6= Number(W_v6)+Number($("#qty4_"+count).val());}
      if (Number($("#items2_"+count).val()) === 7 )
      {W_v7= Number(W_v7)+Number($("#qty4_"+count).val());}
      if (Number($("#items2_"+count).val()) === 8 )
      {W_v8= Number(W_v8)+Number($("#qty4_"+count).val());}
  }


        for(x = 1; x < tableProductLength; x++) {


      count = x;
      if (Number($("#items_"+count).val()) === 1 )
      {v1= Number(v1)+ Number($("#temp_qty_"+count).val());
      t_v1 =Number(v1)+ Number(add_v1)- Number(W_v1);
      $("#qty_"+count).val(t_v1);
  }
      if (Number($("#items_"+count).val()) === 2 )
      {v2= Number(v2)+Number($("#temp_qty_"+count).val());
       t_v2 =Number(v2)+ Number(add_v2)- Number(W_v2);
   $("#qty_"+count).val(t_v2);
            }
      if (Number($("#items_"+count).val()) === 3 )
      {v3= Number(v3)+Number($("#temp_qty_"+count).val());
       t_v3 =Number(v3)+ Number(add_v3)- Number(W_v3);
   $("#qty_"+count).val(t_v3);
            }
      if (Number($("#items_"+count).val()) === 4 )
      {v4= Number(v4)+Number($("#temp_qty_"+count).val());
       t_v4 =Number(v4)+ Number(add_v4)- Number(W_v4);
   $("#qty_"+count).val(t_v4);
   }
      if (Number($("#items_"+count).val()) === 5 )
      {v5= Number(v5)+Number($("#temp_qty_"+count).val());
       t_v5 =Number(v5)+ Number(add_v5)- Number(W_v5);
   $("#qty_"+count).val(t_v5);
   }
      if (Number($("#items_"+count).val()) === 6 )
      {v6= Number(v6)+Number($("#temp_qty_"+count).val());
       t_v6 =Number(v6)+ Number(add_v6)- Number(W_v6);
   $("#qty_"+count).val(t_v6);
   }
      if (Number($("#items_"+count).val()) === 7 )
      {v7= Number(v7)+Number($("#temp_qty_"+count).val());
       t_v7 =Number(v7)+ Number(add_v7) - Number(W_v7);
   $("#qty_"+count).val(t_v7);
   }
      if (Number($("#items_"+count).val()) === 8 )
      {v8= Number(v8)+Number($("#temp_qty_"+count).val());
       t_v8 =Number(v8)+ Number(add_v8)- Number(W_v8);
   $("#qty_"+count).val(t_v8);
   }
        }

     v1 = 0;
     v2 = 0;
     v3 = 0;
     v4 = 0;
     v5 = 0;
     v6 = 0;
     v7 = 0;
     v8 = 0;
     t_v1 = 0;
     t_v2 = 0;
     t_v3 = 0;
     t_v4 = 0;
     t_v5 = 0;
     t_v6 = 0;
     t_v7 = 0;
     t_v8 = 0;
     add_v1 = 0;
     add_v2 = 0;
     add_v3 = 0;
     add_v4 = 0;
     add_v5 = 0;
     add_v6 = 0;
     add_v7 = 0;
     add_v8 = 0;
     W_v1 = 0;
     W_v2 = 0;
     W_v3 = 0;
     W_v4 = 0;
     W_v5 = 0;
     W_v6 = 0;
     W_v7 = 0;
     W_v8 = 0;
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

