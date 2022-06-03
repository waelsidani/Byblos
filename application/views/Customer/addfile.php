

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      Manage Files
     
     
    </h1>
    <ol class="breadcrumb">
      <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
     <li class="active"><a href="<?php echo base_url('customer/') ?>">Customers</a></li>
      <li class="active">Files</li>
    </ol>
  </section>
<div class="box">
          <div class="box-body">
            <h4>Customer name: <?php echo $customer_data_file['contactname']; ?></h4>
          </div>
        </div>
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

      <form role="form" action="<?php echo base_url('Customer/upload_file') ?>" method="POST" enctype="multipart/form-data">
 <div class="box-body">

                <?php echo validation_errors(); ?>
           <div class="form-group">

                  <label for="product_image">Attach a File</label>
                  <div class="kv-avatar">
                      <div class="file-loading">
                          <input id="product_image" name="product_image[]" type="file" multiple>
                      </div>
                      <input type="hidden" id="id" name="id" method="post"  value="<?php echo $customer_data_file['id']?>">
                  </div>
                </div> <br /> <br />
                 <div class="box-footer">
                     <button type="submit"  class="btn btn-primary">Save Changes</button>
                <a href="<?php echo base_url('customer/') ?>" class="btn btn-warning">Back</a>
              </div>
          <br /> <br />
 </div>
      </form>

        <div class="box">
          <div class="box-header">
            <h3 class="box-title">Manage Files</h3>
          </div>
          
          <!-- /.box-header -->
          <div class="box-body">
            <table id="manageTable" class="table table-bordered table-striped">
              <thead>
              <tr>
                <th>File Name</th>
                <?php //if(in_array('updateGroup', $user_permission) || in_array('deleteGroup', $user_permission)): ?>
                  <th>Action</th>
                <?php //endif; ?>
              </tr>
              </thead>
              <?php $Files = json_decode($customer_data_file['files'])?>
<?php if (!empty ( $Files)){foreach ($Files as $k => $v): ?>
              <tr>
              <td><a href="<?php if (count($Files)>1){ echo base_url() . json_decode($Files[$k])[0];}
              else {echo base_url() . $Files[$k];} ?>" target="_blank">
           <?php 
              if (count($Files)>1)
              {echo json_decode($Files[$k])[0];}
              
              else{echo $Files[$k];}?>
 
                  </a></td>
              <td>
                  <button type="button" class="btn btn-default" onclick=" <?php// unlink(base_url() . $Files[$x]) ;?>" data-toggle="modal" ><i class="fa fa-trash"></i></button>
			     
            
<?php endforeach; }?>
                  </td></tr>
            </table>
                 
          </div>
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


<!-- create brand modal -->
<div class="modal fade" tabindex="-1" role="dialog" id="addfile">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Add Attribute Value</h4>
      </div>

      

    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<!-- remove brand modal -->
<div class="modal fade" tabindex="-1" role="dialog" id="removeModal">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Remove Attribute Value</h4>
      </div>

      <form role="form" action="<?php echo base_url('customer/removeValue') ?>" method="post" id="removeForm">
        <div class="modal-body">
          <p>Do you really want to remove?</p>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary">Save changes</button>
        </div>
      </form>


    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->



 <script type="text/javascript">
     
     
  $(document).ready(function() {
    $(".select_group").select2();
 
    $("#product_image").fileinput({
        overwriteInitial: true,
        maxFileSize: 500000,
        showClose: false,
        showCaption: false,
        browseLabel: '',
        removeLabel: '',
        browseIcon: '<i class="glyphicon glyphicon-folder-open"></i>',
        removeIcon: '<i class="glyphicon glyphicon-remove"></i>',
        removeTitle: 'Cancel or reset changes',
        elErrorContainer: '#kv-avatar-errors-1',
        msgErrorClass: 'alert alert-block alert-danger',
         accept: '*',
        // defaultPreviewContent: '<img src="/uploads/default_avatar_male.jpg" alt="Your Avatar">',
        layoutTemplates: {main2: '{preview} {remove} {browse}'}
        
    });

  });
  
 
</script>   
    

