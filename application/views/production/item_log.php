

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
            <h3 class="box-title">Edit Production 
                
                </h3>
          </div>
            <div class="col-md-4 col-xs-12 pull pull-right">
            <div class="form-group">
                  <label for="date" class="col-sm-12 control-label">تاريخ إنشاء الطلب/Work Order Creation Date: <?php $date = date('d-m-Y', $Production_data['date_time']);
			$time = date('h:i a', $Production_data['date_time']);

			$date_time = $date . ' ' . $time;
                        echo  $date_time;
                        ?></label>
                </div>
                <div><?php echo"Production ID:". $Production_data['p_id'] ?></div>
                </div>
            
            
          <!-- /.box-header -->
          <form role="form" id="update"action="<?php base_url('production/update') ?>"  method="post"  enctype="multipart/form-data">
              <div class="box-body">

                <?php echo validation_errors(); ?>
 <label>Image Preview: </label>
                <div class="form-group">
                 
                   
                   
                        <img src="
                             <?php foreach ($Product_data as $k => $v): ?>
                            <?php if($v['id'] == $Production_data['P_number']){echo base_url() . $v['image'];
                                    $imageurl = $v['image'];
                                    $Design = $v['Design'];
                                    $Barcode = $v['Barcode'];
                                       $Number1 = $v['Number']     ;}?>
                              <?php endforeach ?>" width="150" height="150"  onchange="img()">
                   
                 
               
                </div>
                <div class="form-group">
                  
                  <input type="hidden" class="form-control" id="imagurl" name="imagurl"  value="<?php echo $imageurl; ?>"  autocomplete="off"/>
                </div>

                <div class="form-group">
                  <label for="Production_image">Update Image</label>
                  <div class="kv-avatar">
                      <div class="file-loading">
                          <input id="Production_image" name="Production_image" type="file">
                      </div>
                  </div>
                </div>
<?php $workshop1 = $this->model_Workorder->getWorkorderData1();
$date = $this->model_Workorder->getWorkorderData2($Production_data['name']);
?>
                <div class="form-group">
                
                   <label for="Production_name">WorkOrder Number/ رقم طلب الانتاج</label>
                   
                      <select <?php  if (!in_array('deleteProduction', $user_permission)){ echo "disabled";} ?>   class="form-control select_group" id="Production_name1" name="Production_name1" >
                    <option value="0"> -</option>
                          <?php foreach ($workshop1 as $k => $v): ?>
                      
                 
                          <option value="<?php echo $v['name'] ?>" <?php if($Production_data['name'] == $v['name'] ) { echo "selected='selected'"; } ?>><?php echo $v['name']?></option>
                    
 <?php endforeach ?>
                  </select>
                  <input type="hidden" class="form-control" id="Production_name" name="Production_name" placeholder="Enter Production name" value="<?php echo $Production_data['name']; ?>"  autocomplete="off"/>
                </div>
 <script>
                        
                        
                        document.getElementById('Production_name1').onchange = function()
                       {
                          
                         
                       $("#Production_name").val( $("#Production_name1").val());;
                     }
                        </script>
 
 <div class="form-group">
  <label for="Production_name">Delivery Date/ تاريخ التسليم</label>
 <input type="text"readonly class="form-control" id="d_date" name="d_date" placeholder="Enter Production name" value="<?php echo $date['delivery']; ?>"  autocomplete="off"/>
 </div>
              <div class="form-group">
                  <label for="P_number">Product need to be produced / المنتج المراد انتاجه</label>
                   <?php $product_data2 = $Production_data['P_number']; ?>
                 <div> <select class="form-control select_group"  id="P_number"style="width : 400px" name="P_number" >
                    <?php foreach ($products2 as $k => $v): ?>
                   
                       <option value="<?php echo $v['id'] ?>" <?php if($v['id'] == $product_data2) { echo 'selected="selected"'; } ?>><?php echo $v['name']." -".$v['Design']?></option>
                    <?php endforeach ?>
                  </select>
                  </div>
                </div>
                <div class="form-group">
                  <label for="Design">Design Number/رقم الديزاين</label>
                  <input type="text" readonly="" class="form-control" id="Design" name="Design" placeholder="Enter Design" value="<?php echo $Design; ?>" autocomplete="off" />
                
                </div>
                 <div class="form-group">
                  <label for="Number">Product Number/ رقم المنتج</label>
                  <input type="text" readonly="" class="form-control" id="Number" name="Number" placeholder="Enter Design" value="<?php echo $Number1; ?>" autocomplete="off" />
                </div>

                
                  <div class="form-group">
                  <label for="Barcode">Product BarCode Number/ باركود المنتج</label>
                  <input type="text" readonly class="form-control" id="Barcode" name="Barcode" placeholder="Enter Barcode" value="<?php echo $Barcode ; ?>" autocomplete="off" />
                </div>

                <div class="form-group">
                  <label for="qty">Qty/الكمية المراد انتاجها</label>
                  <input type="text" class="form-control" id="qty" name="qty" placeholder="Enter Qty"  <?php  if (!in_array('deleteProduction', $user_permission)){echo "readonly";} ?>  value="<?php echo $Production_data['qty']; ?>" autocomplete="off" />
               
              
                </div>

                <div class="form-group">
                  <label for="description">Description/وصف و مواصفات المنتج</label>
                  <textarea  style=  "font-size: 30px;color : red" dir="rtl" type="text" class="form-control" id="description" name="description" placeholder="Enter 
                  description" autocomplete="off">
                    <?php echo $Production_data['description']; ?>
                  </textarea>
                </div>

               

                    
               
                  <div class="form-group">
                   <table class="table table-bordereded" id="Material_info_table">
                  <thead>
                      <tr><th style=" font-size: 20px ">Material / المواد</th></tr>
                    <tr>
                      <th style="width:30%">Materials/المواد</th>
                      <th style="width:10%">Quantity/ الكمية</th>
                      <th style="width:25%"><button <?php  if (!in_array('deleteProduction', $user_permission)){ echo "disabled";} ?> type="button" id="add_row2" class="btn btn-default"><i class="fa fa-plus"></i></button></th>
                    </tr>
                  </thead>

                   <tbody>
                    
                          <?php 
                          if ($Production_data['Material_ID'] == '' || $Production_data['Material_ID'] == 'null'){
                              $sql2 = "SELECT  * FROM production_items ORDER BY id DESC";
                          $Materials_data = $query = $this->db->query($sql2);
                           $quantity_data = json_decode($Production_data['Mqty']);}
                          
                          else{
                          $Materials_data = json_decode($Production_data['Material_ID']);
                          $quantity_data = json_decode($Production_data['Mqty']);}?>
                    
                    <?php if(isset($Production_data['id'])): ?>
                      <?php $y = 1;
                      ?>
                       
                      <?php foreach ($Materials_data as $key => $val): ?>
                   
                       <tr  id="row2_<?php echo $y; ?>">
                         <td>
                             <select  <?php  if (!in_array('deleteProduction', $user_permission)){ echo "disabled";} ?> class="form-control select_group Material"  data-row-id="row2_<?php echo $y; ?>" id="Material1_<?php echo $y; ?>" name="Material1[]" style="width:100%;"  required>
                              <option value=""></option>
                              
                              <?php foreach ($Materialid as $k => $v): ?>
                                <option value="<?php echo $v['id'] ?>"<?php if($val == $v['id'] ) { echo "selected='selected'"; } ?>><?php echo $v['name'] .' - '.$v['Code'] ?></option>
                              <?php endforeach ?>
                            </select>
                              </td>
                               <input type="hidden" class="form-control" id="Material_<?php echo $y; ?>" name="Material[]"value="<?php echo $val; ?>"  autocomplete="off"/>
                
 <script>
                        
                        
                        document.getElementById('Material1_<?php echo $y; ?>').onchange = function()
                       {
                          
                         
                       $("#Material_<?php echo $y; ?>").val( $("#Material1_<?php echo $y; ?>").val());;
                     }
                        </script>
                              
                              
                          <td><input type="text" <?php  if (!in_array('deleteProduction', $user_permission)){ echo "readonly";} ?>  name="Mqty[]" id="Mqty_<?php echo $y; ?>"" class="form-control" required  value="<?php if ($Production_data['Mqty'] !== 'null' && $Production_data['Mqty'] !== ''){ echo  $quantity_data[-1+$y];} else{ echo $Production_data['qty'];}?>" autocomplete="off"></td>
                                     
                          <td><button <?php  if (!in_array('deleteProduction', $user_permission)){ echo "disabled";} ?> type="button" id="removebutton" name="removebutton" class="btn btn-default" onclick="removeRow2('<?php echo $y; ?>')"><i class="fa fa-close"></i></button></td>
                     </tr>
                     <?php $y++; ?>
           <?php endforeach; ?>
                          <?php endif; ?>
                   </tbody>
                </table>
              
                  
        </div>
 <input type="hidden" name="not_rec" id="not_rec" value="<?php echo $Production_data['not_rec'] ?>">
                  <div class="form-group">
                   <table class="table table-bordereded" id="Workshop_info_table">
                  <thead>
                      <tr><th style=" font-size: 20px "> WorkShop / الأقسام</th></tr>
                    <tr>
                      <th style="width:20%">Workshop/القسم</th>
                      <th style="width:20%">Status/الحالة</th>
                      <th style="width:20%">Received Time/وقت الاستلام</th>
                       <th style="width:20%">Finished Time/وقت الانتهاء</th>
                        <th style="width:15%">Total Time/مجموع الوقت المستغرق </th>
                        
                        
                      <th style="width:5%"><button type="button" id="add_row" <?php  if (!in_array('deleteProduction', $user_permission)){ echo "disabled";} ?>  class="btn btn-default"><i class="fa fa-plus"></i></button></th>
                    </tr>
                  </thead>

                   <tbody>
                       <?php $workshop_data = json_decode($Production_data['Workshop']);
                       $Status = json_decode($Production_data['Status']);
                        $Rec_time = json_decode($Production_data['Rec_time']);
                        $Rec_min = json_decode($Production_data['Rec_min']);
                        $Finish_min = json_decode($Production_data['Finish_min']);
                        $Finish_time = json_decode($Production_data['Finish_time']);
                        $Total_time = json_decode($Production_data['Total_time']);
                        $Prod_num = json_decode($Production_data['Prod_num']);
                        $Note_1 = json_decode($Production_data['Note_1']);
                        $Note_2 = json_decode($Production_data['Note_2']);
                        $Qnty_1 = json_decode($Production_data['Qnty_1']);
                        $Qnty_2 = json_decode($Production_data['Qnty_2']);
                       
                       
                        ?>
                    <?php if(isset($Production_data['Workshop'])): ?>
                    <?php $x = 1; ?>
                    <?php foreach ($workshop_data as $key => $val): ?>
                       <tr <?php if($Status[$x-1] == 2) { echo "style='background-color : #68AF80'";}elseif($Status[$x-1] == 1){ echo "style='background-color : #E7DD8F'";} ?> id="row_<?php echo $x; ?>">
                    <td >
                        <select  <?php  if (!in_array('deleteProduction', $user_permission)){ echo "disabled";} ?>   class="form-control Workshop"  data-row-id="row_<?php echo $x; ?>" id="workshop1_<?php echo $x; ?>" name="workshop1[]" >
                    <option value=""></option>
                    <?php foreach ($workshop as $k => $v): ?>
                    <option value="<?php echo $v['id'] ?>" <?php if($val == $v['id']) { echo "selected='selected'"; } ?>><?php echo $v['name'] ?></option>
                    <?php endforeach ?>
                    </select>
                        <input type="hidden"  name="workshop[]" id="workshop_<?php echo $x; ?>" class="form-control" required  value="<?php echo $workshop_data[-1+$x]  ;?>" autocomplete="off">
                   
                      <script>
                        
                        
                        document.getElementById('workshop1_<?php echo $x; ?>').onchange = function()
                       {
                          
                         
                       $("#workshop_<?php echo $x; ?>").val( $("#workshop1_<?php echo $x; ?>").val());;
                     }
                        </script>
                
                   
                    <label style="height: 35px">Materials/المواد المستعملة</label>
                    <input type="text"  name="Note_1[]" id="Note_1_<?php echo $x; ?>" class="form-control" required  value="<?php if ($Production_data['Note_1'] !== 'null' && $Production_data['Note_1'] !== ''&& $Note_1[-1+$x] !==''){ echo  $Note_1[-1+$x];} else{ echo "0";}?>" autocomplete="off">
                    </td>
                    <td> 
                    <select <?php if ($Production_data['approval']== 2 && !in_array('deleteProduction', $user_permission)) {?>   <?php echo 'disabled'; }else {'';}?> class="form-control Workshop"  id="Status_<?php echo $x; ?>" name="Status[]"  onchange="getProductData(<?php echo $x; ?>)" >
                    <option value="0" <?php if($Status[$x-1] == 0) { echo "selected='selected'"; }if($Status[$x-1] == 2 ||$Status[$x-1] == 1 && $_SESSION['username'] !== 'Admin') {?>disabled<?php }?>  >Pending/ إنتظار</option>
                    <option value="1" <?php if($Status[$x-1] == 1) { echo "selected='selected'"; }if($Status[$x-1] == 2 && $_SESSION['username'] !== 'Admin') {?>disabled<?php }?> >Received/ إستلام</option>
                    <option value="2" <?php if($Status[$x-1] == 2) { echo "selected='selected'"; }if($Status[$x-1] == 0  && $_SESSION['username'] !== 'Admin') {?>disabled<?php }?>   >Finished/ إنتهاء</option>
                    </select>
                    <label style="height: 35px">Quantity/الكمية</label>
                    <input type="text"  name="Qnty_1[]" id="Qnty_1_<?php echo $x; ?>" class="form-control" required  value="<?php if ($Production_data['Qnty_1'] !== 'null' && $Production_data['Qnty_1'] !== ''&&$Qnty_1[-1+$x] !== ''){ echo  $Qnty_1[-1+$x];} else{ echo "0";}?>" autocomplete="off"></td>
                    <td><input type="text" readonly name="Rec_time[]" id="Rec_time_<?php echo $x; ?>" class="form-control" required  value="<?php if ($Production_data['Rec_time'] !== 'null' && $Production_data['Rec_time'] !== ''){ echo  $Rec_time[-1+$x];} else{ echo "0";}?>" autocomplete="off">
                    <label style="height: 35px">Materials/المواد المستعملة</label>
                    <input type="text"  name="Note_2[]" id="Note_2_<?php echo $x; ?>" class="form-control" required  value="<?php if ($Production_data['Note_2'] !== 'null' && $Production_data['Note_2'] !== ''&&$Note_2[-1+$x] !== ''){ echo  $Note_2[-1+$x];} else{ echo "0";}?>" autocomplete="off"></td>
                    <td><input type="text" readonly name="Finish_time[]" id="Finish_time_<?php echo $x; ?>" class="form-control" required  value="<?php if ($Production_data['Finish_time'] !== 'null' && $Production_data['Finish_time'] !== ''){ echo  $Finish_time[-1+$x];} else{ echo "0";}?>"autocomplete="off">
                    <label style="height: 35px">Quantity/الكمية</label>
                    <input type="text"  name="Qnty_2[]" id="Qnty_2_<?php echo $x; ?>" class="form-control" required  value="<?php if ($Production_data['Qnty_2'] !== 'null' && $Production_data['Qnty_2'] !== '' && $Qnty_2[-1+$x] !==''){ echo  $Qnty_2[-1+$x];} else{ echo "0";}?>" autocomplete="off"></td>
                    <td><input type="text" readonly name="Total_time[]" id="Total_time_<?php echo $x; ?>" class="form-control" required  value="<?php if ($Production_data['Total_time'] !== 'null' && $Production_data['Total_time'] !== ''){ echo  $Total_time[-1+$x];} else{echo "0";}?>" autocomplete="off">
                    <label style="height: 35px">Amount/كمية الانتاج</label>
                    <input type="text" readonly name="Prod_num[]" id="Prod_num_<?php echo $x; ?>" class="form-control" required  value="<?php if ($Production_data['Prod_num'] !== 'null' && $Production_data['Prod_num'] !== '' && $Prod_num !== ''){ echo  $Prod_num[-1+$x];} else{echo "0";}?>" autocomplete="off"></td>
                    <td><button <?php  if (!in_array('deleteProduction', $user_permission)){echo "disabled";} ?> type="button" id="removebutton" name="removebutton" class="btn btn-default" onclick="removeRow('<?php echo $x; ?>')"><i class="fa fa-close"></i></button>      
                    <input type="hidden" name="Rec_min[]" id="Rec_min_<?php echo $x; ?>" class="form-control" required  value="<?php if ($Production_data['Rec_min'] !== 'null' && $Production_data['Rec_min'] !== ''&& $Rec_min[-1+$x] !== ''){ echo  $Rec_min[-1+$x];} else{ echo "0";}?>" autocomplete="off"></td>
                    <input type="hidden" name="Finish_min[]" id="Finish_min_<?php echo $x; ?>" class="form-control" required  value="<?php if ($Production_data['Finish_min'] !== 'null' && $Production_data['Finish_min'] !== ''&& $Finish_min[-1+$x] !== ''){ echo  $Finish_min[-1+$x];} else{ echo "0";}?>" autocomplete="off"></td>
                    
                    </tr>
                    <?php $x++; ?>
                    <?php endforeach; ?>
                    <?php endif; ?>
                    </tbody>
                </table>
                  
        </div>

 <div class="form-group">
                   <table class="table table-bordereded" id="Disposal_info_table">
                  <thead>
                      <tr><th style=" font-size: 20px "> Disposal / الهدر</th></tr>
                    <tr>
                      <th style="width:30%">Materials/المواد</th>
                      <th style="width:20%">WorkShop/ القسم</th>
                      <th style="width:10%">Disposal Quantity In PC/ بالحبة كمية الهدر</th>
                      <th style="width:30%">Reason/سبب الهدر </th>
                     
                    <th style="width:10%"><button type="button" id="add_row3" class="btn btn-default"><i class="fa fa-plus"></i></button></th>
                   </tr>
                  </thead>

                   <tbody>
                    
                    
                          <?php 
                          if ($Production_data['Material_Dis'] == '' || $Production_data['Material_Dis'] == 'null'){
                              $sql2 = "SELECT  * FROM production_items ORDER BY id DESC";
                              
                          $Materials_data2 = $query = $this->db->query($sql2);
                          $quantity_data2 = json_decode($Production_data['qty_Dis']) 
                          ;}
                          else{
                          $Materials_data2 = json_decode($Production_data['Material_Dis']);
                         $quantity_data2 = json_decode($Production_data['qty_Dis']);
                         $Note_Data = json_decode($Production_data['Note_Dis']);
                         $Workshop_Dis_data = json_decode($Production_data['Workshop_Dis']);
                         $Materialid2 = json_decode($Production_data['Material_Dis']);
                          $Materialstatus = json_decode($Production_data['MID_status']);
                           $Des_materials = json_decode($Production_data['Material_ID']);
                          }?>
                    
                    <?php if(isset($Production_data['id'])): ?>
                      
                        <?php $y = 1;$t=0;
                      ?>
                       
                      <?php foreach ($Materials_data2 as $key => $val): ?>
                   
                       <tr id="row3_<?php echo $y; ?>">
                         <td>
                             <select  <?php if ($Production_data['approval']== 2) {?> <?php echo 'readonly'; }?>  class="form-control select_group Disposal"  data-row-id="row3_<?php echo $y; ?>" id="Material_Dis_<?php echo $y; ?>" name="Material_Dis[]" style="width:100%;"  required>
                              <option value="-">-</option>
                             
                              <?php foreach ($Materialid as $k => $v): ?>
                             
                               <option value="<?php echo $v['id'] ?>"<?php if($val == $v['id'] ) { echo "selected='selected'"; } ?>><?php echo $v['name'].'-'.$v['Code'] ?></option>
                              
                                   <?php endforeach ?>
                            </select>
                              </td>
                            <td>
                             <select <?php if ($Production_data['approval']== 2) {?> <?php echo 'readonly'; }?> class="form-control select_group Disposal"  data-row-id="row3_<?php echo $y; ?>" id="workshop_Dis_<?php echo $y; ?>" name="workshop_Dis[]" style="width:100%;"  required>
                             
                               <option value="-">-</option>
                              <?php foreach ($workshop as $k => $v): ?>
                             
                                <option value="<?php echo $v['id'] ?>" <?php if($Workshop_Dis_data[-1+$y] == $v['id']) { echo "selected='selected'"; } ?>><?php echo $v['name'] ?></option>
                              <?php endforeach ?>
                            </select>
                              </td>
                              <td><input type="text"<?php if ($Production_data['approval']== 2 && !in_array('deleteProduction', $user_permission)) {?><?php echo 'readonly'; }?> style="background-color: <?php if($Materialstatus[-1 + $y] && $Materialstatus[-1 + $y] !== ''){if( $Materialstatus[-1 + $y] == "1")  {echo "red ; color : white";} else { if ($Materialstatus[-1 + $y] == "2") { echo 'green ; color : white';}else {echo 'white';}}} ?>" name="qty_Dis[]" id="qty_Dis_<?php echo $y; ?>" class="form-control" required  value="<?php if ($Production_data['qty_Dis'] !== 'null' && $Production_data['qty_Dis'] !== ''){ echo  $quantity_data2[-1 + $y];} else{ echo'0';}?>" autocomplete="off"></td>
                         <td><input type="text"<?php if ($Production_data['approval']== 2 && !in_array('deleteProduction', $user_permission)) {?> <?php echo 'readonly'; }?> style="background-color: <?php if($Production_data['MID_status'] !== 'null' && $Materialstatus[-1 + $y] !== ''){if( $Materialstatus[-1 + $y] == "1")  {echo "red; color : white";} else { if ($Materialstatus[-1 + $y] == "2") { echo 'green ; color : white';}else {echo 'white';}}} ?> " name="Note_Dis[]" id="Note_Dis_<?php echo $y; ?>" class="form-control" required  value="<?php if ($Production_data['Note_Dis'] !== 'null' && $Production_data['Note_Dis'] !== ''){ echo  $Note_Data[-1 + $y];} else{ echo '0';}?>" autocomplete="off"></td>
                         <td> <input type="hidden" name="MID_status[]" id="MID_status_<?php echo $y; ?>" class="form-control" required  value="<?php if ($Materialstatus[-1 + $y] !== 'null' && $Materialstatus[-1 + $y] !== ''){ echo  $Materialstatus[-1 + $y];} else { echo '0 ';}?>" autocomplete="off">
                         
                            <button type="button" id="forwardbutton" name="forwardbutton" class="btn btn-default" onclick="forwardtostore('<?php echo $y; ?>')"><i class="fa fa-share"></i></button></td>
                      
                        <td><button <?php  if (!in_array('deleteProduction', $user_permission)){ echo "disabled";} ?> type="button" id="removebutton2" name="removebutton2" class="btn btn-default" onclick="removeRow3('<?php echo $y; ?>')"><i class="fa fa-close"></i></button></td>
                     </tr>
                    
                     <?php $y++; ?>
           <?php endforeach; ?>
                          <?php endif; ?>
                   </tbody>
                </table>
                
                  
        </div>

                <div class="form-group">
                  <label for="store">Store/الحفظ في مستودع</label>
                  
                   <div>
 <select class="form-control select_group" style="width : 200px"id="store" name="store">
                  
                      <option value="1" >Products</option>
                   
                  </select>
                </div>
 </div>
                <div class="form-group">
                    

                  <label for="availability">Order Status/حالة طلب الانتاج</label>
                  <input type="text" readonly class="form-control" style="background-color: #fcd3a1; width: 100px  "id="availability" name="availability"  value="<?php echo $Production_data['availability']; ?>" autocomplete="off" />
               <input type="text" readonly class="form-control" style=" width: 200px  "id="ending_time" name="ending_time"  value="<?php echo $Production_data['date_time_finished']; ?>" autocomplete="off" />
                <input type="text" readonly class="form-control" style=" width: 200px  "id="finishtime" name="finishtime"  value="<?php echo $Production_data['finishtime']; ?>" autocomplete="off" />
                
               <label  for="Added_Q">Quantity Will be added to the Product/الكمية التي سوف تضاف للمنتج</label>
                 
                  <input type="text" class="form-control" style="background-color: #afd9ee; width: 100px  "id="Added_Q" name="Added_Q"  value="<?php echo $Production_data['Added_Q']; ?>" autocomplete="off" />
      
         
 <?php if(in_array('deleteProduction', $user_permission)): ?> 
                  <div style="float: right">            
 <label style="float:right"class="radio-inline">
               <div style="float: right">            
 
                         
    <label class="radio-inline"  style="float:right; background: red; color: white ;">
        <input type="radio" name="approval"   value="3" onchange="app()" <?php if ($Production_data['approval'] == "3" ){ echo 'checked'; }?>> Cancel/ إلغاء-
    </label>
               </div>
     
                        <input type="radio" name="approval" onchange="app()" value="1" <?php if ($Production_data['approval'] == "1"){ echo 'checked'; }?>> Approved/ موافق
    </label>
                         
    <label class="radio-inline"  style="float:right">
      <input type="radio" name="approval"  value="2" onchange="app()" <?php if ($Production_data['approval'] == "2" || $Production_data['approval'] == ""){ echo 'checked'; }?>> Not Approved/غير موافق -
    </label></div>
 <div style="float: right">
                     <label for="Approval" style="float:right">Approval Person/ الشخص المسؤول</label>
            <input type="text"style="float:right ; width: 150px" class="form-control" id="Approval_Person" name="Approval_Person" placeholder="Enter your name " value="<?php echo  $_SESSION['username'];?>" autocomplete="off" />
        <input type="date"style="float:right ; width: 150px" class="form-control" id="Approval_date" name="Approval_date" placeholder="Enter your name " value="<?php echo $Production_data['Approval_date'];?>" autocomplete="off" />
        <input type="hidden"  value="<?php echo $Production_data['approval_Pause']?>" class="form-control" id="approval3" name="approval3"   autocomplete="off"/>
              
         <input type="hidden"  value="<?php if ($Production_data['approval'] == "" || $Production_data['approval'] == "2"){ echo "2"; } elseif($Production_data['approval'] == "" || $Production_data['approval'] == "1") { echo "1";} else {echo "3";}?>" class="form-control" id="approval2" name="approval2"   autocomplete="off"/>
          
             
 </div> 
             
         <input  dir="rtl" type="<?php if ($Production_data['reason_cancellation'] == "" || $Production_data['reason_cancellation'] == "0"){echo "hidden";} else {echo "text";} ?>" value="<?php echo $Production_data['reason_cancellation'] ?>" class="form-control" id="reason_cancellation" name="reason_cancellation"   autocomplete="off"/>
                         
                 
               <?php else :{?> 
                  
                  <input type="hidden"  value="<?php echo $Production_data['approval']?>" class="form-control" id="approval2" name="approval2"   autocomplete="off"/>
               <input type="hidden"  value="<?php echo $Production_data['approval_Pause']?>" class="form-control" id="approval3" name="approval3"   autocomplete="off"/>
              <input type="hidden"  value="<?php echo $Production_data['reason_cancellation']?>" class="form-control" id="reason_cancellation" name="reason_cancellation"   autocomplete="off"/>
              
                      <?php } endif ?>
                  
                   
 <script>
   document.getElementById('Approval_date').valueAsDate = new Date();
 if ($("#availability").val() === "Done")
 {
    
   
 document.getElementById('availability').style.backgroundColor= "Green";
  document.getElementById('availability').style.color= "black";
   }
 </script>

              </div>
              <!-- /.box-body -->

              <div class="box-footer">
                  
               <a class="btn btn-warning" onclick ="self.close()">Back/ رجوع</a>
              </div>
            
          <!-- /.box-body -->
        </div>
              </form>
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

    $("#mainProductionNav").addClass('active');
    $("#addProductionNav").addClass('active');
   

    
    $("#Production_image").fileinput({
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
var base_url2 = "<?php echo base_url(); ?>";
  $(document).ready(function() {
    $(".select_group").select2();
    // $("#description").wysihtml5();

   
  
    // Add new row in the table 
    $("#add_row").unbind('click').bind('click', function() {
      var table = $("#Workshop_info_table");
      var count_table_tbody_tr = $("#Workshop_info_table tbody tr").length;
      var row_id = count_table_tbody_tr + 1;

      $.ajax({
          url: base_url + '/Production/getTableworkshopRow/',
          type: 'post',
          dataType: 'json',
          success:function(response) {
            
              // console.log(reponse.x);
               var html = '<tr id="row_'+row_id+'">'+
                   '<td>'+ 
                    '<select class="form-control select_group Workshop" data-row-id="'+row_id+'" id="workshop_'+row_id+'" name="workshop[]" style="width:100%;" onchange="getProductData2('+row_id+')>'+
                        '<option value=""></option>';
                        
                        $.each(response, function(index, value) {
                          html += '<option value="'+value.id+'">'+value.name+'</option>';             
                        });
                        
                      html += '</select>'+
                    '</td>'+ 
                   '<td>'+    
                       '<select class="form-control" id="Status_'+row_id+'" name="Status[]" onchange="getProductData('+row_id+')">'+
                    '<option value="0">Pending</option>'+
                    '<option value="1" >Received</option>'+
                    '<option value="2" >Finished</option>'+
                  '</select></td>'+
                  '<td><input type="text" readonly name="Rec_time[]" id="Rec_time_'+row_id+'" class="form-control"></td>'+
                  '<td><input type="text"readonly  name="Finish_time[]" id="Finish_time_'+row_id+'" class="form-control" ></td>'+
                  '<td><input type="text" readonly name="Total_time[]" id="Total_time_'+row_id+'" class="form-control" ></td>'+
                  
            '<td><button type="button" class="btn btn-default" onclick="removeRow(\''+row_id+'\')"><i class="fa fa-close"></i></button></td>'+
            '<td><input type="hidden" readonly  name="Note_1[]" id="Note_1_'+row_id+'" class="form-control" ></td>'+
                   '<td><input type="hidden" readonly  name="Note_2[]" id="Note_2_'+row_id+'" class="form-control" ></td>'+
                   '<td><input type="hidden" readonly  name="Qnty_1[]" id="Qnty_1_'+row_id+'" class="form-control" ></td>'+
                   '<td><input type="hidden" readonly  name="Qnty_2[]" id="Qnty_2_'+row_id+'" class="form-control" ></td>'+
                   
            '<td><input type="hidden" readonly name="Prod_num[]" id="Prod_num_'+row_id+'" class="form-control" >'+       
                  '<input type="hidden" readonly name="Rec_min[]" id="Rec_min_'+row_id+'" class="form-control" >'+  
                  '<input type="hidden" readonly name="Finish_min[]" id="Finish_min_'+row_id+'" class="form-control" ></td>'+
             
            '</tr>';

                if(count_table_tbody_tr >= 1) {
                $("#Workshop_info_table tbody tr:last").after(html);  
              }
              else {
                $("#Workshop_info_table tbody").html(html);
              }

              $(".workshop").select2();

          }
        });

      return false;
    });

  }); // /document


  // get the product information from the server
  function getProductData(row_id)
  {
     var not_rec = $("#not_rec").val();
      if (not_rec === "0"){$("#not_rec").val(1);}
      var today = new Date();
var minutes = 1000 * 60;
var t = Date.now();
var zero = 0;
var min = Math.round((t / minutes));
var date = today.getFullYear()+'-'+(today.getMonth()+1)+'-'+today.getDate()+'['+today.getHours() + ":" + today.getMinutes()+"]";
    var workshop_id = $("#Status_"+row_id).val();    
    if(workshop_id === "0")
    {
  
("#Rec_time_"+row_id).val(zero);

    } else {
      $.ajax({
        url: base_url + 'Production/getworkshopValueById/',
        type: 'post',
        data: {workshop_id : workshop_id},
        dataType: 'json',
        success:function(response) {
          // setting the direct value into the direct input field
          // 
       if(workshop_id === "1") {  


$("#Rec_time_"+row_id).val(date) ;
$("#Rec_min_"+row_id).val(min) ;
       }
        if(workshop_id === "2"){
  var txt;
  var pro = prompt("Please enter your Production Number/العدد المنتج:", "0");
 
  if (pro === null || pro === "") {
    txt = 0;
  } else {if (pro > 0){
    txt = pro;
    }
    else txt=0;
  
   
  }
  $("#Prod_num_"+row_id).val(txt) ;

$("#Finish_time_"+row_id).val(date) ;
$("#Finish_min_"+row_id).val(min) ;
var totaltime = (min-(Number($("#Rec_min_"+row_id).val())));
if (totaltime > 0  ){
   var Min2 =60*((totaltime/60) - parseInt(totaltime/60));
  // var dayes= parseInt( totaltime/ 86,400,000);
$("#Total_time_"+row_id).val( parseInt(totaltime/60) +' hr : '+ parseInt(Min2)+' min');}else{$("#Total_time_"+row_id).val(0);}

        }
   
     
        subAmount();  
        } // /success
      }); // 
    }
  }
function subAmount() {
    
    var tableProductLength = $("#Workshop_info_table tbody tr").length;
    var totalSubAmount = 0;
    for(x = 0; x < tableProductLength; x++) {
      var tr = $("#Workshop_info_table tbody tr")[x];
      var count = $(tr).attr('id');
      count = count.substring(4);
var Product1 =  $("#Prod_num_"+count);
   $("#Added_Q").val(Product1.val());
      totalSubAmount = Number(totalSubAmount) + Number($("#Status_"+count).val());
    } // /for

    totalSubAmount = totalSubAmount.toFixed(0);
if ((totalSubAmount - (count * 2)) === 0)
{var todayf = new Date();
    var f = Date.now();
    var minutesf = 1000 * 60;
var minf = Math.round((f / minutesf));
    
var datef = todayf.getFullYear()+'-'+(todayf.getMonth()+1)+'-'+todayf.getDate()+'['+todayf.getHours() + ":" + todayf.getMinutes()+"]";
   
    $("#availability").val("Done");
 $("#ending_time").val(datef);
 
 document.getElementById('availability').style.backgroundColor= "Green";
  document.getElementById('availability').style.color= "black";
var totaltime = (minf-(Number($("#Rec_min_1").val())));
if (totaltime > 0  ){
   var Min2 =60*((totaltime/60) - parseInt(totaltime/60));
  // var dayes= parseInt( totaltime/ 86,400,000);
$("#finishtime").val( parseInt(totaltime/60) +' hr : '+ parseInt(Min2)+' min');}else{$("#finishtime"+row_id).val(0);}
  }

}

  function removeRow(tr_id)
  {
    $("#Workshop_info_table tbody tr#row_"+tr_id).remove();

  }
  
  $(document).ready(function() {
    $(".select_group").select2();
    // $("#description").wysihtml5();

 
     // Add new row in the table Material
    $("#add_row2").unbind('click').bind('click', function() {
      
        var table = $("#Material_info_table");
      var count_table_tbody_tr2 = $("#Material_info_table tbody tr").length;
      var row_id2 = count_table_tbody_tr2 + 1;

      $.ajax({
          url: base_url2 + 'Production/getTableworkshopRow2',
          type: 'post',
          dataType: 'json',
          
          success :function(response2) {
            
              console.log(response2);
               var html2 = '<tr id="row2_'+row_id2+'">'+
                   '<td>'+ 
                    '<select class="form-control select_group Material" data-row-id="'+row_id2+'" id="Material_'+row_id2+'" name="Material[]" style="width:100%;" onchange="getProductData2('+row_id2+')">'+
             '<option value=""></option>';
                       
                       
                        
                          $.each(response2, function(index, value1) {
                          html2 += '<option value="'+value1.id+'">'+value1.name+'</option>';               
                        });
                                                             
                      html2 += '</select>'+
                    '</td>'+ 
                   '<td><input type="text" name="Mqty[]" id="Mqty_'+row_id2+'" class="form-control" ></td>'+            
           
                    '<td><button type="button" class="btn btn-default" onclick="removeRow2(\''+row_id2+'\')"><i class="fa fa-close"></i></button></td>'+
                    '</tr>';

                if(count_table_tbody_tr2 >= 1) {
                $("#Material_info_table tbody tr:last").after(html2); 
                
              }
              else {
                $("#Material_info_table tbody").html(html2);
              }

              $(".Material").select2();

          }
        });

      return false;
    });

  }); // /document


  // get the product information from the server
  function getProductData2(row_id2)
  {
      
    var workshop_id2 = $("#Material_"+row_id2).val();    
    if(workshop_id2 === "") {
  

    } else {
      $.ajax({
        url: base_url + 'Production/getworkshopValueById2',
        type: 'post',
        data: {workshop_id2 : workshop_id2},
        dataType: 'json',
        success:function(response2) {
          // setting the direct value into the direct input field
          
     //$("#Material_"+row_id).val(response.id);
          
        } // /success
      }); // /ajax function to fetch the product data 
    }
  }

  function removeRow2(tr_id)
  {
    $("#Material_info_table tbody tr#row2_"+tr_id).remove();

  }
   
  function app()
{
if ($('form input[type=radio]:checked').val()=== "1") 
{$("#approval2").val("1");
$("#approval3").val("2");}
if ($('form input[type=radio]:checked').val()=== "2")
{

           
    $("#approval2").val("2");}
if
($('form input[type=radio]:checked').val()=== "3")
        {$("#approval2").val("3");

var res = prompt("Please Write the Reason of Cancellation/ الرجاء ذكر سبب الإلغاء", "0");

 var txt1;
  if (res === null || res === "0") {
    txt1 = "Not Mentioned";
  } else {
    txt1 = res;
    }
    
  
    $("#reason_cancellation").val(txt1) ;
  }
 
}

 $(document).ready(function() {
    $(".select_group").select2();
    // $("#description").wysihtml5();

 
     // Add new row in the table Disposal
    $("#add_row3").unbind('click').bind('click', function() {
      var table = $("#Disposal_info_table");
      var count_table_tbody_tr3 = $("#Disposal_info_table tbody tr").length;
      var row_id3 = count_table_tbody_tr3 + 1;

      $.ajax({
          url: base_url2 + 'Production/getTableworkshopRow2',
          type: 'post',
          dataType: 'json',
          async :true,
          success :function(response3) {
              $.ajax({
          url: base_url2 + 'Production/getTableworkshopRow',
          type: 'post',
          dataType: 'json',
          success :function(response4){
            
              console.log(response3);
               var html3 = '<tr id="row3_'+row_id3+'">'+
                   '<td>'+ 
                    '<select class="form-control select_group Disposal" data-row-id="'+row_id3+'" id="Material_Dis_'+row_id3+'" name="Material_Dis[]" style="width:100%;" >'+
            
            '<option selected value="-">-</option>';
                       
                       
                        
                          $.each(response3, function(index, value2) {
                          html3 += '<option value="'+value2.id+'">'+value2.name+'</option>';               
                        });
                                                             
                      html3 += '</select>'+
                    '</td>'+ 
                        '<td>'+ 
                        
                    '<select class="form-control select_group Workshop" data-row-id="'+row_id3+'" id="workshop_Dis_'+row_id3+'" name="workshop_Dis[]" style="width:100%;" >'+
                     
              '<option selected value="-">-</option>';
                        
                         $.each(response4, function(index, value5) {
                          html3 += '<option value="'+value5.id+'">'+value5.name+'</option>';               
                        });
                                             
                      html3 += '</select>'+
                    '</td>'+ 
                     '<td><input type="text" name="qty_Dis[]" id="qty_Dis_'+row_id3+'" class="form-control" value= "0" ></td>'+  
            '<td><input type="text" name="Note_Dis[]" id="Note_Dis_'+row_id3+'" value= "0" class="form-control" ></td>'+ 
            '<td> <input type="hidden" name="MID_status[]" id="MID_status_'+row_id3+'" class="form-control" required  value= "0" autocomplete="off">'+
    
                         
                           ' <button type="button" id="forwardbutton" name="forwardbutton" class="btn btn-default" onclick="forwardtostore('+row_id3+')"><i class="fa fa-share"></i></button></td>'+
                      
                    '<td><button type="button"  class="btn btn-default" onclick="removeRow3(\''+row_id3+'\')"><i class="fa fa-close"></i></button></td>'+
                    '</tr>';

                if(count_table_tbody_tr3 >= 1) {
                $("#Disposal_info_table tbody tr:last").after(html3); 
                
              }
              else {
                $("#Disposal_info_table tbody").html(html3);
              }

              $(".Disposal").select2();

          }
        });
 }
        });
      return false;
    });

  }); // /document

function removeRow3(tr_id)
  {
    $("#Disposal_info_table tbody tr#row3_"+tr_id).remove();

  }
  
  function forwardtostore(mrawid)
                     {
                           
  if ($("#Material_Dis_"+mrawid).val() !== "-" && $("#workshop_Dis_"+mrawid).val() !== "-" )
     { $("#MID_status_"+mrawid).val(1);
      document.getElementById("Note_Dis_"+mrawid).style.backgroundColor= "Red";
      document.getElementById("Note_Dis_"+mrawid).style.color= "black"; 
      document.getElementById("qty_Dis_"+mrawid).style.color= "black";
      document.getElementById("qty_Dis_"+mrawid).style.backgroundColor= "Red";
      document.getElementById("approval2").value= "2";
      document.getElementById("approval3").value= "1";

      }
 else {$("#MID_status_"+mrawid).val(0);
     document.getElementById("Note_Dis_"+mrawid).style.backgroundColor= "white";
     document.getElementById("Note_Dis_"+mrawid).style.color= "black"; 
     document.getElementById("qty_Dis_"+mrawid).style.backgroundColor= "white";
     document.getElementById("qty_Dis_"+mrawid).style.color= "black";
     
     }
                                
    }
</script>