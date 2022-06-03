

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      Manage
      <small>Orders</small>
    </h1>
    <ol class="breadcrumb">
      <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
      <li class="active">Orders</li>
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
            <h3 class="box-title">Edit Order</h3>
          </div>
          <!-- /.box-header -->
          <form role="form" action="<?php base_url('orders/create') ?>" method="post" class="form-horizontal">
              <div class="box-body">

                <?php echo validation_errors(); ?>

                <div class="form-group">
                  <label for="date" class="col-sm-12 control-label">Date: <?php echo date('Y-m-d') ?></label>
                </div>
                <div class="form-group">
                  <label for="time" class="col-sm-12 control-label">Date: <?php echo date('h:i a') ?></label>
                </div>

                <div class="col-md-4 col-xs-12 pull pull-left">

                  <div class="form-group">
                    <label for="gross_amount" class="col-sm-5 control-label" style="text-align:left;">Customer Name</label>
                    <div class="col-sm-7">
                        <input type="text" class="form-control" readonly id="customer_name" name="customer_name" placeholder="Enter Customer Name" value="<?php echo $order_data['order']['customer_name'] ?>" autocomplete="off"/>
                    </div>
                  

                    <label for="gross_amount" class="col-sm-5 control-label" style="text-align:left;" >Order from?</label>
                   <select class="form-control select_group" id=place_name" name="place_name">
                      <option value='Show-Room(Istoc)' <?php if( $order_data['order']['place_name'] == "Show-Room(Istoc)"){ echo "selected='selected'";}?>>Show-Room(Istoc)</option>
                      <option value='Factory' <?php if( $order_data['order']['place_name'] == "Factory"){ echo "selected='selected'";}?>>Factory</option>
                       </select>
</div>
                  
                  <div class="form-group">
                    <label for="gross_amount" class="col-sm-5 control-label" style="text-align:left;">Customer Address</label>
                    <div class="col-sm-7">
                      <input type="text" class="form-control" id="customer_address" name="customer_address" placeholder="Enter Customer Address" value="<?php echo $order_data['order']['customer_address'] ?>" autocomplete="off">
                    </div>
                  </div>

                  <div class="form-group">
                    <label for="gross_amount" class="col-sm-5 control-label" style="text-align:left;">Customer Phone</label>
                    <div class="col-sm-7">
                      <input type="text" class="form-control" id="customer_phone" name="customer_phone" placeholder="Enter Customer Phone" value="<?php echo $order_data['order']['customer_phone'] ?>" autocomplete="off">
                    </div>
                  </div>
                </div>
                
                
                <br /> <br/>
                <table class="table table-bordered" id="product_info_table">
                  <thead>
                    <tr>
                        <th style="width:13%">Image</th>
                      <th style="width:23%">Product</th>
                      <th style="width:7%">CTN</th>
                      <th style="width:5%">Packing</th>
                      <th style="width:7%">Qty</th>
                      <th style="width:10%">Price</th>
                      <th style="width:10%">C.B.M/ CTN</th>
                      <th style="width:10%">Total C.B.M</th>
                      <th style="width:15%">Amount</th>
                      <th style="width:5%"><button type="button" id="add_row" class="btn btn-default"><i class="fa fa-plus"></i></button></th>
                    </tr>
                  </thead>

                   <tbody >

                    <?php if(isset($order_data['order_item'])): ?>
                      <?php $x = 1; ?>
                      <?php foreach ($order_data['order_item'] as $key => $val): ?>
                        <?php //print_r($v); ?>
                       <tr id="row_<?php echo $x; ?>" >
                           <td><img src="<?php echo base_url($val['image']) ?>"  width="150" height="150" name="image[]" id="image_<?php echo $x; ?>" ></td>
                         <td style="text-align:center ; vertical-align: middle" >
                          <select class="form-control select_group product" data-row-id="row_<?php echo $x; ?>" id="product_<?php echo $x; ?>" name="product[]" style="width:100%;" onchange="getProductData(<?php echo $x; ?>)" required>
                              <option value=""></option>
                              <?php foreach ($products as $k => $v): ?>
                                <option value="<?php echo $v['id'] ?>" <?php if($val['product_id'] == $v['id']) { echo "selected='selected'"; } ?>><?php echo $v['Number'] ?></option>
                              <?php endforeach ?>
                            </select>
                          </td>
                          <td style="text-align:center ; vertical-align: middle">
                          <input type="text" name="ctn[]" id="ctn_<?php echo $x; ?>" class="form-control" value="<?php echo $val['ctn'] ?>"readonly autocomplete="off">
                          
                        </td>
                        <td style="text-align:center ; vertical-align: middle">
                          <input type="text" name="packing[]" id="packing_<?php echo $x; ?>" class="form-control" value="<?php echo $val['packing'] ?> "readonly autocomplete="off">
                          
                        </td>
                          <td style="text-align:center ; vertical-align: middle"><input type="text" name="qty[]" id="qty_<?php echo $x; ?>" class="form-control" required onkeyup="getTotal(<?php echo $x; ?>)" value="<?php echo $val['qty'] ?>" autocomplete="off"></td>
                          <td style="text-align:center ; vertical-align: middle">
                              <input type="text" name="rate_value[]" id="rate_value_<?php echo $x; ?>" class="form-control" onkeyup="getTotal(<?php echo $x; ?>)"  value="<?php if(in_array('createOrder', $this->permission)) {echo $val['rate'];}else {echo 0;} ?>"  autocomplete="off">
                          </td>
                          
                          <td style="text-align:center ; vertical-align: middle">
                          <input type="text" name="cbm[]" id="cbm_<?php echo $x; ?>" value="<?php echo $val['cbm'] ?>"class="form-control" readonly autocomplete="off">
                         </td>
                         <td style="text-align:center ; vertical-align: middle">
                          <input type="text" name="tcbm[]" id="tcbm_<?php echo $x; ?>"  value="<?php echo $val['tcbm'] ?>" onkeyup="getTotal" class="form-control" readonly autocomplete="off">
                         </td>
                         <td style="text-align:center ; vertical-align: middle">
                              <input type="text" readonly name="amount_value[]" id="amount_value_<?php echo $x; ?>" class="form-control" value="<?php  if(in_array('createOrder', $this->permission)) {echo $val['amount'];}else {echo 0;} ?>" autocomplete="off">
                          <input type="hidden" name="image1[]" id="image1_<?php echo $x; ?>" value="<?php echo $val['image'] ?>" class="form-control">
                       
                          </td>
                          <td><button type="button" class="btn btn-default" onclick="removeRow('<?php echo $x; ?>')"><i class="fa fa-close"></i></button></td>
                       </tr>
                       <?php $x++; ?>
                     <?php endforeach; ?>
                   <?php endif; ?>
                   </tbody>
                </table>

                <br /> <br/>
<div class="col-md-6 col-xs-12 pull pull-left">
<label for="total_cbm_value" class="col-sm-5 control-label">Comments or Special Instructions </label>
                  
                 <div class="form-group">
                    
                    <div class="col-sm-7">
                    <input type="text" class="form-control" id="note1"  value="<?php echo $order_data['order']['note1'] ?>" name="note1" autocomplete="off">
                    </div>
                    <div class="col-sm-7">
                    <input type="text" class="form-control" id="note2"  value="<?php echo $order_data['order']['note2'] ?>" name="note2" autocomplete="off">
                    </div>
                    <div class="col-sm-7">
                    <input type="text" class="form-control" id="note3" value="<?php echo $order_data['order']['note3'] ?>"   name="note3" autocomplete="off">
                    </div>
                      <div class="col-sm-7">
                    <input type="text" class="form-control" id="note4"  value="<?php echo $order_data['order']['note4'] ?>" name="note4" autocomplete="off">
                    </div>
                  </div></div>
                <div class="col-md-6 col-xs-12 pull pull-right">

                 
                 <div class="form-group">
                    <label for="total_cbm_value" class="col-sm-5 control-label">Total C.B.M</label>
                    <div class="col-sm-7">
                    <input type="text" class="form-control" id="total_cbm_value"  readonly name="total_cbm_value" value="<?php echo $order_data['order']['tcbm'] ?>"autocomplete="off">
                    </div>
                  </div>
                    <div class="form-group">
                    <label for="total_set_value" class="col-sm-5 control-label">Total CTN</label>
                    <div class="col-sm-7">
                    <input type="text" class="form-control" id="total_ctn_value"  readonly name="total_ctn_value"  value="<?php echo $order_data['order']['tctn'] ?>"autocomplete="off">
                    </div>
                  </div>
                    <div class="form-group">
                    <label for="total_set_value" class="col-sm-5 control-label">Total Sets/Pc</label>
                    <div class="col-sm-7">
                    <input type="text" class="form-control" id="total_set_value"  readonly name="total_set_value" value="<?php echo $order_data['order']['tset'] ?>"autocomplete="off">
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="gross_amount" class="col-sm-5 control-label">Total Amount</label>
                    <div class="col-sm-7">
                      <input type="text" class="form-control" id="gross_amount" name="gross_amount" disabled value="<?php  if(in_array('createOrder', $this->permission)) {echo $order_data['order']['gross_amount'];}else {echo 0;}  ?>" autocomplete="off">
                      <input type="hidden" class="form-control" id="gross_amount_value" name="gross_amount_value" value="<?php echo $order_data['order']['gross_amount'] ?>" autocomplete="off">
                    </div>
                  </div>
                  <?php if($is_vat_enabled == true): ?>
                  <div class="form-group">
                    <label for="vat_charge" class="col-sm-5 control-label">Vat <?php echo $company_data['vat_charge_value'] ?> %</label>
                    <div class="col-sm-7">
                      <input type="text" class="form-control" id="vat_charge" name="vat_charge" disabled value="<?php echo $order_data['order']['vat_charge'] ?>" autocomplete="off">
                      <input type="hidden" class="form-control" id="vat_charge_value" name="vat_charge_value" value="<?php echo $order_data['order']['vat_charge'] ?>" autocomplete="off">
                    </div>
                  </div>
                  <?php endif; ?>
                  <div class="form-group">
                    <label for="discount" class="col-sm-5 control-label">Paid Amount</label>
                    <div class="col-sm-7">
                      <input type="text" class="form-control" id="discount" name="discount" placeholder="Discount" onkeyup="subAmount()" value="<?php echo $order_data['order']['discount'] ?>" autocomplete="off">
                    </div>
                  </div>
                    <div class="form-group">
                    <label for="shipping" class="col-sm-5 control-label">Shipping Fees</label>
                    <div class="col-sm-7">
                        <input type="text" value="<?php echo $order_data['order']['shipping'] ?>"class="form-control" id="shipping" name="shipping"onkeyup="subAmount()">
                        
                      
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="net_amount" class="col-sm-5 control-label">Net Amount</label>
                    <div class="col-sm-7">
                      <input type="text" class="form-control" id="net_amount" name="net_amount" disabled value="<?php if(in_array('createOrder', $this->permission)) {echo $order_data['order']['net_amount'];}else {echo 0;}  ?>" autocomplete="off">
                      <input type="hidden" class="form-control" id="net_amount_value" name="net_amount_value" value="<?php echo $order_data['order']['net_amount'] ?>" autocomplete="off">
                    </div>
                  </div>

                  

                </div>
              </div>
              <!-- /.box-body -->

              <div class="box-footer">

                <input type="hidden" name="vat_charge_rate" value="<?php echo $company_data['vat_charge_value'] ?>" autocomplete="off">
<a target="__blank" href="<?php echo base_url() . 'orders/toexcel/'.$order_data['order']['id'] ?>" class="btn btn-default" >Export to Excel</a>
                
                <a target="__blank" href="<?php echo base_url() . 'orders/printDiv/'.$order_data['order']['id'] ?>" class="btn btn-default" >Print</a>
                <button type="submit" <?php if(!in_array('createOrder', $this->permission)) {echo 'disabled';}?> class="btn btn-primary">Save Changes</button>
                <a href="<?php echo base_url('orders/') ?>" class="btn btn-warning">Back</a>
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
  var base_url = "<?php echo base_url(); ?>";

  // function printOrder(id)
  // {
  //   if(id) {
  //     $.ajax({
  //       url: base_url + 'orders/printDiv/' + id,
  //       type: 'post',
  //       success:function(response) {
  //         var mywindow = window.open('', 'new div', 'height=400,width=600');
  //         // mywindow.document.write('<html><head><title></title>');
  //         // mywindow.document.write('<link rel="stylesheet" href="<?php //echo base_url('assets/bower_components/bootstrap/dist/css/bootstrap.min.css') ?>" type="text/css" />');
  //         // mywindow.document.write('</head><body >');
  //         mywindow.document.write(response);
  //         // mywindow.document.write('</body></html>');

  //         mywindow.print();
  //         mywindow.close();

  //         return true;
  //       }
  //     });
  //   }
  // }

  $(document).ready(function() {
    $(".select_group").select2();
    // $("#description").wysihtml5();

    $("#mainOrdersNav").addClass('active');
    $("#manageOrdersNav").addClass('active');
    
    
    // Add new row in the table 
    $("#add_row").unbind('click').bind('click', function() {
      var table = $("#product_info_table");
      var count_table_tbody_tr = $("#product_info_table tbody tr").length;
      var row_id = count_table_tbody_tr + 1;

      $.ajax({
          url: base_url + '/orders/getTableProductRow/',
          type: 'post',
          dataType: 'json',
          success:function(response) {
            

              // console.log(reponse.x);
               var html = '<tr id="row_'+row_id+'">'+
                   '<td>'+ 
                    '<select class="form-control select_group product" data-row-id="'+row_id+'" id="product_'+row_id+'" name="product[]" style="width:100%;" onchange="getProductData('+row_id+')">'+
                        '<option value=""></option>';
                        $.each(response, function(index, value) {
                          html += '<option value="'+value.id+'">'+value.name+'</option>';             
                        });
                        
                      html += '</select>'+
                    '</td>'+ 
                    '<td><input type="text" name="ctn[]" id="ctn_'+row_id+'" class="form-control" readonly></td>'+
                    '<td><input type="text" name="packing[]" id="packing_'+row_id+'" class="form-control" readonly></td>'+
                    '<td><input type="text" name="qty[]" id="qty_'+row_id+'" class="form-control" ><input type="hidden" name="image1[]" id="image1_'+row_id+'" class="form-control" ></td>'+
                    '<td><input type="text" name="rate_value[]" id="rate_value_'+row_id+'" class="form-control"   ></td>'+
            '<td><input type="text" name="cbm[]" id="cbm_'+row_id+'" class="form-control" readonly></td>'+
              '<td><input type="text" name="tcbm[]" id="tcbm_'+row_id+'" class="form-control" readonly></td>'+
                                  
            '<td><input type="text" name="amount_value[]" id="amount_value_'+row_id+'" class="form-control" readonly ></td>'+
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
     
     
      
      
      
      
       var ctn = (Number($("#qty_"+row).val())) / (Number($("#packing_"+row).val()));
       ctn = ctn.toFixed(2);
            $("#ctn_"+row).val(ctn);
       
      var tcbm = Number($("#cbm_"+row).val()) * Number($("#ctn_"+row).val()) ;
      tcbm = tcbm.toFixed(2);
      $("#tcbm_"+row).val(tcbm);
      var total = Number($("#rate_value_"+row).val()) * Number($("#qty_"+row).val());
      total = total.toFixed(2);
      $("#amount_value_"+row).val(total);
   
      subAmount();

    } else {
      alert('no row !! please refresh the page');
    }
  }

  // get the product information from the server
  function getProductData(row_id)
  {
    var product_id = $("#product_"+row_id).val();    
    if(product_id == "") {
      $("#rate_"+row_id).val("");
      $("#rate_value_"+row_id).val("");

      $("#qty_"+row_id).val("");           

      $("#amount_"+row_id).val("");
      $("#amount_value_"+row_id).val("");

    } else {
      $.ajax({
        url: base_url + 'orders/getProductValueById',
        type: 'post',
        data: {product_id : product_id},
        dataType: 'json',
        success:function(response) {
          // setting the rate value into the rate input field
          
          $("#rate_value_"+row_id).val(response.price);
          $("#image1_"+row_id).val(response.image);
         $("#ctn_"+row_id).val(1);
         $("#packing_"+row_id).val(response.packing);
         
         $("#cbm_"+row_id).val(response.size);
        $("#cbm_"+row_id).val(response.size);
        
          $("#qty_"+row_id).val(1);
          $("#qty_value_"+row_id).val(1);

          var total = Number(response.price) * 1;
          total = total.toFixed(2);
         
          $("#amount_value_"+row_id).val(total);
          
          subAmount();
        } // /success
      }); // /ajax function to fetch the product data 
    }
  }

  // calculate the total amount of the order
  function subAmount() {
     var vat_charge = <?php echo ($company_data['vat_charge_value'] > 0) ? $company_data['vat_charge_value']:0; ?>;

    var tableProductLength = $("#product_info_table tbody tr").length;
    var totalSubAmount = 0;
    var totalctn = 0;
    var totalcbm = 0;
     var totalset = 0;
    
    for(x = 0; x < tableProductLength; x++) {
      var tr = $("#product_info_table tbody tr")[x];
      var count = $(tr).attr('id');
      count = count.substring(4);
 totalSubAmount = Number(totalSubAmount) + Number($("#amount_value_"+count).val());
      totalset = Number(totalset) + Number($("#qty_"+count).val());
      totalcbm = Number(totalcbm) + Number($("#tcbm_"+count).val());
      totalctn = Number(totalctn) + Number($("#ctn_"+count).val());
    } // /for
totalctn = totalctn.toFixed(2);
totalSubAmount = totalSubAmount.toFixed(2);
totalcbm = totalcbm.toFixed(2);
totalset = totalset.toFixed(2);
    // sub total
   
    $("#gross_amount_value").val(totalSubAmount);
$("#total_cbm_value").val(totalcbm);
$("#total_set_value").val(totalset);
$("#total_ctn_value").val(totalctn);
    // vat
    var vat = (Number($("#gross_amount_value").val())/100) * vat_charge;
    vat = vat.toFixed(2);
    $("#vat_charge").val(vat);
    $("#vat_charge_value").val(vat);

   
    
    // total amount
    var totalAmount = (Number(totalSubAmount) + Number(vat));
    totalAmount = totalAmount.toFixed(2);
    // $("#net_amount").val(totalAmount);
    // $("#totalAmountValue").val(totalAmount);
var shipping = $("#shipping").val();
    var discount = $("#discount").val();
    if(discount) {
      var grandTotal = Number(totalAmount) - Number(discount)+ Number(shipping);
      grandTotal = grandTotal.toFixed(2);
      $("#net_amount").val(grandTotal);
      $("#net_amount_value").val(grandTotal);
    } else {
      $("#net_amount").val(totalAmount);
      $("#net_amount_value").val(totalAmount);
      
    } // /else discount 

  } // /sub total amount

  function paidAmount() {
    var grandTotal = $("#net_amount_value").val();

    if(grandTotal) {
      var dueAmount = Number($("#net_amount_value").val()) - Number($("#paid_amount").val());
      dueAmount = dueAmount.toFixed(2);
      $("#remaining").val(dueAmount);
      $("#remaining_value").val(dueAmount);
    } // /if
  } // /paid amoutn function

  function removeRow(tr_id)
  {
    $("#product_info_table tbody tr#row_"+tr_id).remove();
    subAmount();
  }
</script>