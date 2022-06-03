

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      Manage
      <small>Pricing</small>
    </h1>
    <ol class="breadcrumb">
      <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
      <li class="active">Pricing</li>
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
            <h3 class="box-title">Add Pricing</h3>
          </div>
          <!-- /.box-header -->
          <form role="form" action="<?php base_url('Pricing/create') ?>" method="post" class="form-horizontal" enctype="multipart/form-data">
              <div class="box-body">

                <?php echo validation_errors(); ?>
            
                <div class="form-group">
                  <label for="gross_subtotal" class="col-sm-12 control-label">Date: <?php echo date('Y-m-d') ?></label>
                </div>
                <div class="form-group">
                  <label for="gross_subtotal" class="col-sm-12 control-label">Date: <?php echo date('h:i a') ?></label>
                </div>

                <div class="col-md-4 col-xs-12 pull pull-left">
<?php  
                   
                  
          $mysqli22 = NEW MySQLi('localhost','root','','stock');
          $cus = $mysqli22->query("SELECT contactname , id  FROM customer");
       
          $sn = $mysqli22->query("select * from pricing ORDER BY id DESC LIMIT 1");
      while($rows = $sn->fetch_assoc())
                    {
                        
                       $sn2 = $rows['id'] ;
                        
                    }
                   
                  
          ?>
                     <input type="hidden" class="form-control" id="sn" name="sn" value="<?php echo  $sn2 ?>" autocomplete="off">
                  
                  <div class="form-group">
                    <label for="gross_subtotal" class="col-sm-5 control-label" style="text-align:left;">Customer Name</label>
                   <select class="form-control select_group" id="customer_name2" name="customer_name2">
                      <option value=''></option>
                      <?php while($rows = $cus->fetch_assoc())
                    {
                        
                       $name = $rows['contactname'] ;
                       echo "<option value='$name'>$name</option>";
                       
                    }
                   
                   ?>
                       </select>
                    <script>
                        
                        
                        document.getElementById('customer_name2').onchange = function()
                       {
                          
                         
                       $("#customer_name").val( $("#customer_name2").val());;
                     }
                        </script>
                  </div>
                   
                  <div class="form-group">
                    <label for="gross_subtotal" class="col-sm-5 control-label" style="text-align:left;">Customer Address</label>
                    <div class="col-sm-7">
                      <input type="text" class="form-control" id="customer_name" readonly name="customer_name" placeholder="Customer Name" autocomplete="off">
                    </div>
                     </div>
                  <div class="form-group">
                    <label for="gross_subtotal" class="col-sm-5 control-label" style="text-align:left;">Customer Address</label>
                    <div class="col-sm-7">
                      <input type="text" class="form-control" id="customer_address" name="customer_address" placeholder="Enter Customer Address" autocomplete="off">
                    </div>
                     </div>
                     <div class="form-group">
                    <label for="gross_subtotal" class="col-sm-5 control-label" style="text-align:left ;">Title/العنوان</label>
                    <div class="col-sm-7">
                      <input type="text" class="form-control" id="Description" name="Description" placeholder="Enter Title" autocomplete="off">
                    </div>
                  </div>
                 
                       <div class="form-group">
                    <label for="gross_subtotal" class="col-sm-5 control-label" style="text-align:left;">Type</label>
                    <div class="col-sm-7">
                        <input type="text" readonly class="form-control" id="Pricing_type" name="Pricing_type" placeholder="Type" autocomplete="off">
                    </div>
                  </div>
                     
                 
                     <?php  
                   
                   
          $mysqli = NEW MySQLi('localhost','root','','stock');
       
         $resultSet2 = $mysqli->query("SELECT name,id  FROM attributes");
          ?>
                   
                        
                        <div class="form-group">
                  <label for="Att_name">Set/PC</label>
                  <select class="form-control select_group" id="Att_name" name="Att_name">
                      <option value=''></option>
                      <?php while($rows = $resultSet2->fetch_assoc())
                    {
                         $ID = $rows['id'] ; 
                       $name = $rows['name'] ;
                       echo "<option value='$name'>$name</option>";
                       
                    }
                   
                   ?>
                       </select>
                  
                   <script>
                        
                        
                        document.getElementById('Att_name').onchange = function()
                       {
                          
                         
                       $("#Pricing_type").val( $("#Att_name").val());;
                     }
                        </script>
                
                    </div>

                  
             
                </div>
                
                
                <br /> <br/>
                <table class="table table-bPricinged" id="product_info_table">
                  <thead>
                    <tr>
                      <th style="width:50%">Product/ المواد</th>
                      <th style="width:10%">Qty/ العدد</th>
                      <th style="width:10%">Direct Cost/قيمة المواد</th>
                      <th style="width:10%">Indirect Cost/العمالة</th>
                      <th style="width:10%">SubTotal/ المجموع</th>
                      <th style="width:10%"><button type="button" id="add_row" class="btn btn-default"><i class="fa fa-plus"></i></button></th>
                    </tr>
                  </thead>

                   <tbody>
                     <tr id="row_1">
                       <td>
             
                       <select class="form-control select_group product" data-row-id="row_1" id="product_1" name="product[]" style="width:100%;" onchange="getProductData(1)" required>
                              <option value=""></option>
                              <?php foreach ($products as $k => $v): ?>
                                <option value="<?php echo $v['id'] ?> "><?php echo $v['value'] ."-".  $v['Attribute_parent_name'] ?></option>
                              <?php endforeach ?>
                            </select>
                           
                             <input type="hidden" name="Workshop_ID[]" id="Workshop_ID_1" class="form-control" autocomplete="off">
                        <input type="hidden" name="Material_ID[]" id="Material_ID_1" class="form-control" autocomplete="off">
                        </td>
                        <td><input type="text" name="qty[]" id="qty_1" class="form-control" required onkeyup="getTotal(1)"></td>
                        <td>
                          <input type="text" name="direct[]" id="direct_1" class="form-control" disabled autocomplete="off">
                          <input type="hidden" name="direct_value[]" id="direct_value_1" class="form-control" autocomplete="off">
                        </td>
                        <td>
                          <input type="text" name="indirect[]" id="indirect_1" class="form-control" disabled autocomplete="off">
                          <input type="hidden" name="indirect_value[]" id="indirect_value_1" class="form-control" autocomplete="off">
                        </td>
                        <td>
                          <input type="text" name="subtotal[]" id="subtotal_1" class="form-control" disabled autocomplete="off">
                          <input type="hidden" name="subtotal_value[]" id="subtotal_value_1" class="form-control" autocomplete="off">
                        </td>
                       
                        <td><button type="button" id="removebutton" name="removebutton" class="btn btn-default" onclick="removeRow('1')"><i class="fa fa-close"></i></button></td>
                     </tr>
                   </tbody>
                </table>

                <br /> <br/>
 
                <div class="col-md-6 col-xs-12 pull pull-right">
  
<div class="form-group">
                      
                    <label for="gross_subtotal" class="col-sm-5 control-label">Direct Cost</label>
                    <div class="col-sm-7">
                      <input type="text" class="form-control" id="direct_subtotal" name="direct_subtotal" disabled  autocomplete="off">
                    <input type="hidden" class="form-control" id="direct_subtotal_value" name="direct_subtotal_value"  autocomplete="off">
                     </div></div>
                  <div class="form-group">
                    <label for="gross_subtotal" class="col-sm-5 control-label">In-Direct Cost</label>
                    <div class="col-sm-7">
                      <input type="text" class="form-control" id="indirect_subtotal" name="indirect_subtotal" disabled  autocomplete="off">
                    <input type="hidden" class="form-control" id="indirect_subtotal_value" name="indirect_subtotal_value"  autocomplete="off">
               </div></div>
                  <div class="form-group">
                      
                
                
                    <label for="gross_subtotal" class="col-sm-5 control-label">Total</label>
                    <div class="col-sm-7">
                      <input type="text" class="form-control" id="gross_subtotal" name="gross_subtotal" disabled autocomplete="off">
                      <input type="hidden" class="form-control" id="gross_subtotal_value" name="gross_subtotal_value" autocomplete="off">
                    </div>
                  </div>
              
                  
              
                  <?php if($is_service_enabled == true): ?>
                  <div class="form-group">
                    <label for="service_charge" class="col-sm-5 control-label">Disposal <?php echo $company_data['service_charge_value'] ?> %</label>
                    <div class="col-sm-7">
                      <input type="text" class="form-control" id="service_charge" name="service_charge" disabled autocomplete="off">
                      <input type="hidden" class="form-control" id="service_charge_value" name="service_charge_value" autocomplete="off">
                    </div>
                  </div>
                    <div class="form-group">
                    <label for="gross_nettotal" class="col-sm-5 control-label">Net Total</label>
                    <div class="col-sm-7">
                      <input type="text" class="form-control" id="gross_nettotal" name="gross_nettotal" disabled autocomplete="off">
                      <input type="hidden" class="form-control" id="gross_nettotal_value" name="gross_nettotal_value" autocomplete="off">
                    </div>
                  </div>
                  <?php endif; ?>
                     <div class="form-group">
                    <label for="profit" class="col-sm-5 control-label">Profit %</label>
                    <div class="col-sm-7">
                        <input type="text" class="form-control" id="profit" value="45" name="profit" placeholder="Profit%" onkeyup="subAmount()" autocomplete="off">
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="discount" class="col-sm-5 control-label">Discount</label>
                    <div class="col-sm-7">
                      <input type="text" class="form-control" id="discount" name="discount" placeholder="Discount" onkeyup="subAmount()" autocomplete="off">
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="net_subtotal" class="col-sm-5 control-label">Net Amount</label>
                    <div class="col-sm-7">
                      <input type="text" class="form-control" id="net_subtotal" name="net_subtotal" disabled autocomplete="off">
                      <input type="hidden" class="form-control" id="net_subtotal_value" name="net_subtotal_value" autocomplete="off">
                    </div>
                  </div>

                </div>
             <div class="form-group">

                 
                 
                      <img id="imagepreview"  width="200" height="200" class="img-Thumbnail">
               
               
                 
                  <div class="kv-avatar  ">
                      <div class="file-loading">
                          <input id="product_image" name="product_image" type="file" class="file-loading">
                          <img id="imagepreview"  width="200" height="200" class="img-Thumbnail">
                      </div>
                  </div>
              </div>
              <!-- /.box-body -->

              <div class="box-footer">
               
                <input type="hidden" name="service_charge_rate" value="<?php echo $company_data['service_charge_value'] ?>" autocomplete="off">
                <button type="submit" class="btn btn-primary">Create Pricing</button>
                <a href="<?php echo base_url('Pricing/') ?>" class="btn btn-warning">Back</a>
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
    $("#description").wysihtml5();

    $("#mainPricingNav").addClass('active');
    $("#addPricingNav").addClass('active');
    
    var btnCust = '<button type="button" class="btn btn-secondary" title="Add picture tags" ' + 
        'onclick="alert(\'Call your custom code here.\')">' +
        '<i class="glyphicon glyphicon-tag"></i>' +
        '</button>'; 
window.addEventListener("paste", e => {
        if (e.clipboardData.files.length > 0)
        {const fileInput = document.querySelector("#product_image");
            fileInput.files = e.clipboardData.files;
              setPreviewImage(e.clipboardData.files[0]);
        }}); function setPreviewImage(file)
    {if ( /\.(jpe?g|png|gif)$/i.test(file.name) ) {
            const fileReader = new FileReader();
        fileReader.readAsDataURL(file);
        fileReader.onload = () => {
            document.querySelector ("#imagepreview").src = fileReader.result;
        };
    }}
    $("#product_image").fileinput({
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
        layoutTemplates: {main2: '{preview}  {remove} {browse}'},
        allowedFileExtensions: ["jpg", "png", "gif","jpeg"]
    });

  });
  var base_url = "<?php echo base_url(); ?>";
   
 $(document).ready(function() {
    $(".select_group").select2();
    // $("#description").wysihtml5();

    $("#mainPricingNav").addClass('active');
    $("#addPricingNav").addClass('active');
  
    
    // Add new row in the table 
    $("#add_row").unbind('click').bind('click', function() {
      var table = $("#product_info_table");
      var count_table_tbody_tr = $("#product_info_table tbody tr").length;
      var row_id = count_table_tbody_tr + 1;

      $.ajax({
          url: base_url + '/Pricing/getTableProductRow/',
          type: 'post',
          dataType: 'json',
          success:function(response) {
            
              // console.log(reponse.x);
               var html = '<tr id="row_'+row_id+'">'+
                   '<td>'+ 
                    '<select class="form-control select_group product" data-row-id="'+row_id+'" id="product_'+row_id+'" name="product[]" style="width:100%;" onchange="getProductData('+row_id+')">'+
                        '<option value=""></option>';
                        $.each(response, function(index, value) {
                            var res = value.value.concat( " - ", value.Attribute_parent_name);
                          html += '<option value="'+value.id+'">'+res+ '</option>';             
                        });
                        
                      html += '</select>'+
                    '</td>'+ 
                    '<td><input type="text" name="qty[]" id="qty_'+row_id+'" class="form-control" onkeyup="getTotal('+row_id+')"></td>'+
                    '<td><input type="text" name="direct[]" id="direct_'+row_id+'" class="form-control" disabled><input type="hidden" name="direct_value[]" id="direct_value_'+row_id+'" class="form-control"></td>'+
                    '<td><input type="text" name="indirect[]" id="indirect_'+row_id+'" class="form-control" disabled><input type="hidden" name="indirect_value[]" id="indirect_value_'+row_id+'" class="form-control"><input type="hidden" name="Workshop_ID[]" id="Workshop_ID_'+row_id+'" class="form-control"><input type="hidden" name="Material_ID[]" id="Material_ID_'+row_id+'" class="form-control"></td>'+        
                    '<td><input type="text" name="subtotal[]" id="subtotal_'+row_id+'" class="form-control" disabled><input type="hidden" name="subtotal_value[]" id="subtotal_value_'+row_id+'" class="form-control"></td>'+
               
                    '<td><button type="button" class="btn btn-default" onclick="removeRow(\''+row_id+'\')"><i class="fa fa-close"></i></button></td>'+
                    '</tr>';

                if(count_table_tbody_tr >= 1) {
                $("#product_info_table tbody tr:last").after(html);  
              }
              else {
                $("#product_info_table tbody").html(html);
              }

              $(".product").select2();

          }
        });

      return false;
    });

  }); // /document

  function getTotal(row = null) {
    if(row) {
      var total = (Number($("#direct_value_"+row).val())+Number($("#indirect_value_"+row).val())) * Number($("#qty_"+row).val());
      total = total.toFixed(2);
      $("#subtotal_"+row).val(total);
      $("#subtotal_value_"+row).val(total);
      
      subAmount();

    } else {
      alert('no row !! please refresh the page');
    }
  }

  // get the product information from the server
  function getProductData(row_id)
  {
    var product_id = $("#product_"+row_id).val();    
    if(product_id === "") {
      $("#direct_"+row_id).val("");
      $("#direct_value_"+row_id).val("");

      $("#qty_"+row_id).val("");           
      $("#indirect_"+row_id).val("");
      $("#indirect_value_"+row_id).val("");
      $("#Workshop_ID_"+row_id).val("");
      $("#Material_ID_"+row_id).val("");
      $("#subtotal_"+row_id).val("");
      $("#subtotal_value_"+row_id).val("");

    } else {
      $.ajax({
        url: base_url + 'Pricing/getProductValueById',
        type: 'post',
        data: {product_id : product_id},
        dataType: 'json',
        success:function(response) {
          // setting the direct value into the direct input field
          
          $("#direct_"+row_id).val(response.direct);
          $("#direct_value_"+row_id).val(response.direct);
          $("#indirect_"+row_id).val(response.indirect);
          $("#indirect_value_"+row_id).val(response.indirect);
          $("#Workshop_ID_"+row_id).val(response.Workshop_ID);
          $("#Material_ID_"+row_id).val(response.Material_ID);
          $("#qty_"+row_id).val(1);
          $("#qty_value_"+row_id).val(1);

          var total = Number(response.indirect) + Number(response.direct) * 1;
          total = total.toFixed(2);
          $("#subtotal_"+row_id).val(total);
          $("#subtotal_value_"+row_id).val(total);
          
          subAmount();
        } // /success
      }); // /ajax function to fetch the product data 
    }
  }

  // calculate the total subtotal of the Pricing
 function subAmount() {
    
    var service_charge = <?php echo ($company_data['service_charge_value'] > 0) ? $company_data['service_charge_value']:0; ?>;

    var tableProductLength = $("#product_info_table tbody tr").length;
    var totalSubAmount = 0;
    var  totaldirect =0;
   var totalindirect = 0;
    for(x = 0; x < tableProductLength; x++) {
      var tr = $("#product_info_table tbody tr")[x];
      var count = $(tr).attr('id');
      count = count.substring(4);

      totalSubAmount = Number(totalSubAmount) + Number($("#subtotal_"+count).val());
       totaldirect = Number(totaldirect) + (Number($("#direct_"+count).val()) * Number($("#qty_"+count).val())) ;
        totalindirect = Number(totalindirect) + (Number($("#indirect_"+count).val())* Number($("#qty_"+count).val()));
      
    } // /for

    totalSubAmount = totalSubAmount.toFixed(2);
     totaldirect = totaldirect.toFixed(2);
      totalindirect = totalindirect.toFixed(2);
      

    // sub total
    $("#gross_subtotal").val(totalSubAmount);
    $("#gross_subtotal_value").val(totalSubAmount);
    $("#direct_subtotal").val(totaldirect);
 $("#direct_subtotal_value").val(totaldirect);
  $("#indirect_subtotal").val(totalindirect);
  $("#indirect_subtotal_value").val(totalindirect);

    // service
    var service = (Number($("#gross_subtotal").val())/100) * service_charge;
    service = service.toFixed(2);
    
    var tttotal = Number(totalSubAmount) + Number(service);
    tttotal = tttotal.toFixed(2);
    $("#service_charge").val(service);
    $("#service_charge_value").val(service);
    $("#gross_nettotal").val(tttotal);
    $("#gross_nettotal_value").val(tttotal);
var profit = $("#profit").val();
profit = -1 * ( $("#profit").val() - 100);
profit = profit.toFixed(2);

    // service
 
    
    // total subtotal
    var totalAmount = 100 * ((Number(totalSubAmount) + Number(service)  ) / Number(profit));
    totalAmount = totalAmount.toFixed(2);
    // $("#net_subtotal").val(totalAmount);
    // $("#totalAmountValue").val(totalAmount);

    var discount = $("#discount").val();
        if(discount !== '') {
      var grandTotal = Number(totalAmount) - Number(discount);
      grandTotal = grandTotal.toFixed(2);
      
      $("#net_subtotal").val(grandTotal);
      $("#net_subtotal_value").val(grandTotal);
    } else {
      $("#net_subtotal").val(totalAmount);
      $("#net_subtotal_value").val(totalAmount);
      
    } 
   

   

  }

  function removeRow(tr_id)
  {
    $("#product_info_table tbody tr#row_"+tr_id).remove();
    subAmount();
  }
</script>