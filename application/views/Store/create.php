

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
            <h3 class="box-title">Samples/ عينات</h3>
          </div>
          <!-- /.box-header -->
          <form role="form" action="<?php base_url('Store/create') ?>" method="post" class="form-horizontal">
              <div class="box-body">

                <?php echo validation_errors(); ?>
                  <?php
          $mysqli2 = NEW MySQLi('localhost','root','','stock');
          
         $resultSet3 = $mysqli2->query("SELECT *  FROM brands");
          $resultSet1 = $mysqli2->query("SELECT *  FROM workshop");
         
          ?> 

                <div class="form-group">
                  <label for="gross_amount" class="col-sm-12 control-label">Date: <?php echo date('Y-m-d') ?></label>
                </div>
                <div class="form-group">
                  <label for="gross_amount" class="col-sm-12 control-label">Date: <?php echo date('h:i a') ?></label>
                </div>

                <div class="col-md-4 col-xs-12 pull pull-left">
                      <label for="workshop" class="col-sm-5 control-label" style="text-align:left;">Request For Workshop/ إسم القسم</label>
                    <select class="form-control select_group " id="workshop" name="workshop" style="width:100%;" >
                            <option value=""></option>
                            <?php foreach ($resultSet1 as $k => $v): ?>
                          
                              <option value="<?php echo $v['id'] ?>"><?php echo $v['name'] ?></option>
                            <?php endforeach ?>
                          </select>
                  <div class="form-group">
                    <label for="gross_amount" class="col-sm-5 control-label" style="text-align:left;">Person Name/ إسم الشخص </label>
                    <div class="col-sm-7">
                      <input type="text" class="form-control" id="person_name" name="person_name"  autocomplete="off" />
                    </div>
                  </div>
                      <div class="form-group">
                    <label for="gross_amount" class="col-sm-5 control-label" style="text-align:left;">Note/ ملاحظة</label>
                    <div class="col-sm-7">
                      <input type="text" class="form-control" id="note" name="note"  autocomplete="off" />
                    </div>
                  </div>

                  

                    
    
                </div>
                
                
                <br /> <br/>
                <table class="table table-bordered" id="attribute_info_table">
                  <thead>
                    <tr>
                      <th style="width:50%">Material/ المواد</th>
                      <th style="width:10%">Qty/ الكمية</th>
                        <th style="width:10%"><button type="button" id="add_row" class="btn btn-default"><i class="fa fa-plus"></i></button></th>
                    </tr>
                  </thead>

                   <tbody>
                     <tr id="row_1">
                       <td>
                           
                 
                        <select class="form-control select_group attribute" data-row-id="row_1" id="attribute_1" name="attribute[]" style="width:100%;"  required>
                            <option value=""></option>
                            <?php foreach ($resultSet3 as $k => $v): ?>
                          
                              <option value="<?php echo $v['id'] ?>"><?php echo$v['Code'] ." - ". $v['name'] ?></option>
                            <?php endforeach ?>
                          </select>
                        </td>
                        <td><input type="text" name="qty[]" id="qty_1" class="form-control" required ></td>
                         
                        <td><button type="button" class="btn btn-default" onclick="removeRow('1')"><i class="fa fa-close"></i></button></td>
                     </tr>
                   </tbody>
                </table>

                <br /> <br/>

              
              </div>
              <!-- /.box-body -->

              <div class="box-footer">
                <button type="submit" class="btn btn-primary">Create Order/ إنشاء طلب</button>
                <a href="javascript:history.back()" class="btn btn-warning">Back/ رجوع</a>
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

  $(document).ready(function() {
    $(".select_group").select2();
    

     $("#mainstoreNav").addClass('active');
    $("#addstoreNav").addClass('active');
    
    
  
    $("#add_row").unbind('click').bind('click', function() {

      var count_table_tbody_tr = $("#attribute_info_table tbody tr").length;
      var row_id = count_table_tbody_tr + 1;

      $.ajax({
          url: base_url + '/Store/getTableitemsRow/',
          type: 'post',
          dataType: 'json',
          success:function(response) {
            
              // console.log(reponse.x);
               var html = '<tr id="row_'+row_id+'">'+
                   '<td>'+ 
                    '<select class="form-control select_group attribute" data-row-id="'+row_id+'" id="attribute_'+row_id+'" name="attribute[]" style="width:100%;" >'+
                        '<option value=""></option>';
                        $.each(response, function(index, value) {
                       
                          html += '<option value="'+value.id+'">'+value.Code+' - '+value.name+'</option>';             
                        });
                        
                      html += '</select>'+
                    '</td>'+ 
                    '<td><input type="text" name="qty[]" id="qty_'+row_id+'" class="form-control" ></td>'+
                    '<td><button type="button" class="btn btn-default" onclick="removeRow(\''+row_id+'\')"><i class="fa fa-close"></i></button></td>'+
                    '</tr>';

                if(count_table_tbody_tr >= 1) {
                $("#attribute_info_table tbody tr:last").after(html);  
              }
              else {
                $("#attribute_info_table tbody").html(html);
              }

              $(".attribute").select2();

          }
        });

      return false;
    });

  }); // /document

  
  function removeRow(tr_id)
  {
    $("#attribute_info_table tbody tr#row_"+tr_id).remove();
    subAmount();
  }
</script>