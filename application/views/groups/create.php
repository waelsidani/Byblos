

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Manage
        <small>Groups</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">groups</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <!-- Small boxes (Stat box) -->
      <div class="row">
        <div class="col-md-12 col-xs-12">
          
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
              <h3 class="box-title">Add Group</h3>
            </div>
            <form role="form" action="<?php base_url('groups/create') ?>" method="post">
              <div class="box-body">

                <?php echo validation_errors(); ?>

                <div class="form-group">
                  <label for="group_name">Group Name</label>
                  <input type="text" class="form-control" id="group_name" name="group_name" placeholder="Enter group name">
                </div>
                <div class="form-group">
                  <label for="permission">Permission</label>

                  <table class="table table-responsive">
                    <thead>
                      <tr>
                        <th></th>
                        <th>Create</th>
                        <th>Update</th>
                        <th>View</th>
                        <th>Delete</th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr>
                        <td>Users</td>
                        <td><input type="checkbox" name="permission[]" id="permission" value="createUser" class="minimal"></td>
                        <td><input type="checkbox" name="permission[]" id="permission" value="updateUser" class="minimal"></td>
                        <td><input type="checkbox" name="permission[]" id="permission" value="viewUser" class="minimal"></td>
                        <td><input type="checkbox" name="permission[]" id="permission" value="deleteUser" class="minimal"></td>
                      </tr>
                      <tr>
                        <td>Groups</td>
                        <td><input type="checkbox" name="permission[]" id="permission" value="createGroup" class="minimal"></td>
                        <td><input type="checkbox" name="permission[]" id="permission" value="updateGroup" class="minimal"></td>
                        <td><input type="checkbox" name="permission[]" id="permission" value="viewGroup" class="minimal"></td>
                        <td><input type="checkbox" name="permission[]" id="permission" value="deleteGroup" class="minimal"></td>
                      </tr>
                      <tr>
                        <td>Brands</td>
                        <td><input type="checkbox" name="permission[]" id="permission" value="createBrand" class="minimal"></td>
                        <td><input type="checkbox" name="permission[]" id="permission" value="updateBrand" class="minimal"></td>
                        <td><input type="checkbox" name="permission[]" id="permission" value="viewBrand" class="minimal"></td>
                        <td><input type="checkbox" name="permission[]" id="permission" value="deleteBrand" class="minimal"></td>
                      </tr>
                      <tr>
                        <td>Category</td>
                        <td><input type="checkbox" name="permission[]" id="permission" value="createCategory" class="minimal"></td>
                        <td><input type="checkbox" name="permission[]" id="permission" value="updateCategory" class="minimal"></td>
                        <td><input type="checkbox" name="permission[]" id="permission" value="viewCategory" class="minimal"></td>
                        <td><input type="checkbox" name="permission[]" id="permission" value="deleteCategory" class="minimal"></td>
                      </tr>
                      <tr>
                        <td>Supplier</td>
                        <td><input type="checkbox" name="permission[]" id="permission" value="createSupplier" class="minimal"></td>
                        <td><input type="checkbox" name="permission[]" id="permission" value="updateSupplier" class="minimal"></td>
                        <td><input type="checkbox" name="permission[]" id="permission" value="viewSupplier" class="minimal"></td>
                        <td><input type="checkbox" name="permission[]" id="permission" value="deleteSupplier" class="minimal"></td>
                      </tr>
					  <tr>
                        <td>Workers</td>
                        <td><input type="checkbox" name="permission[]" id="permission" value="createWorkers" class="minimal"></td>
                        <td><input type="checkbox" name="permission[]" id="permission" value="updateWorkers" class="minimal"></td>
                        <td><input type="checkbox" name="permission[]" id="permission" value="viewWorkers" class="minimal"></td>
                        <td><input type="checkbox" name="permission[]" id="permission" value="deleteWorkers" class="minimal"></td>
                      </tr>
					  <tr>
                        <td>Workshop</td>
                        <td><input type="checkbox" name="permission[]" id="permission" value="createWorkshop" class="minimal"></td>
                        <td><input type="checkbox" name="permission[]" id="permission" value="updateWorkshop" class="minimal"></td>
                        <td><input type="checkbox" name="permission[]" id="permission" value="viewWorkshop" class="minimal"></td>
                        <td><input type="checkbox" name="permission[]" id="permission" value="deleteWorkshop" class="minimal"></td>
                      </tr>
                      <tr>
                        <td>Customer</td>
                        <td><input type="checkbox" name="permission[]" id="permission" value="createCustomer" class="minimal"></td>
                        <td><input type="checkbox" name="permission[]" id="permission" value="updateCustomer" class="minimal"></td>
                        <td><input type="checkbox" name="permission[]" id="permission" value="viewCustomer" class="minimal"></td>
                        <td><input type="checkbox" name="permission[]" id="permission" value="deleteCustomer" class="minimal"></td>
                      </tr>
                      <tr>
                        <td>Stores</td>
                        <td><input type="checkbox" name="permission[]" id="permission" value="createStore" class="minimal"></td>
                        <td><input type="checkbox" name="permission[]" id="permission" value="updateStore" class="minimal"></td>
                        <td><input type="checkbox" name="permission[]" id="permission" value="viewStore" class="minimal"></td>
                        <td><input type="checkbox" name="permission[]" id="permission" value="deleteStore" class="minimal"></td>
                      </tr>
                      <tr>
                        <td>Attributes</td>
                        <td><input type="checkbox" name="permission[]" id="permission" value="createAttribute" class="minimal"></td>
                        <td><input type="checkbox" name="permission[]" id="permission" value="updateAttribute" class="minimal"></td>
                        <td><input type="checkbox" name="permission[]" id="permission" value="viewAttribute" class="minimal"></td>
                        <td><input type="checkbox" name="permission[]" id="permission" value="deleteAttribute" class="minimal"></td>
                      </tr>
                      <tr>
                        <td>Products</td>
                        <td><input type="checkbox" name="permission[]" id="permission" value="createProduct" class="minimal"></td>
                        <td><input type="checkbox" name="permission[]" id="permission" value="updateProduct" class="minimal"></td>
                        <td><input type="checkbox" name="permission[]" id="permission" value="viewProduct" class="minimal"></td>
                        <td><input type="checkbox" name="permission[]" id="permission" value="deleteProduct" class="minimal"></td>
                      </tr>
                      <tr>
                        <td>Design and Films</td>
                        <td><input type="checkbox" name="permission[]" id="permission" value="createDesign" class="minimal"></td>
                        <td><input type="checkbox" name="permission[]" id="permission" value="updateDesign" class="minimal"></td>
                        <td><input type="checkbox" name="permission[]" id="permission" value="viewDesign" class="minimal"></td>
                        <td><input type="checkbox" name="permission[]" id="permission" value="deleteDesign" class="minimal"></td>
                      </tr>
                      <tr>
                        <td>Designer Tasks</td>
                        <td><input type="checkbox" name="permission[]" id="permission" value="createDesignertasks" class="minimal"></td>
                        <td><input type="checkbox" name="permission[]" id="permission" value="updateDesignertasks" class="minimal"></td>
                        <td><input type="checkbox" name="permission[]" id="permission" value="viewDesignertasks" class="minimal"></td>
                        <td><input type="checkbox" name="permission[]" id="permission" value="deleteDesignertasks" class="minimal"></td>
                      </tr>
					  <tr>
                        <td>BrushStore</td>
                        <td><input type="checkbox" name="permission[]" id="permission" value="createBrushStore" class="minimal"></td>
                        <td><input type="checkbox" name="permission[]" id="permission" value="updateBrushStore" class="minimal"></td>
                        <td><input type="checkbox" name="permission[]" id="permission" value="viewBrushStore" class="minimal"></td>
                        <td><input type="checkbox" name="permission[]" id="permission" value="deleteBrushStore" class="minimal"></td>
                      </tr>
					  <tr>
                        <td>StickerStore and Films</td>
                        <td><input type="checkbox" name="permission[]" id="permission" value="createStickerStore" class="minimal"></td>
                        <td><input type="checkbox" name="permission[]" id="permission" value="updateStickerStore" class="minimal"></td>
                        <td><input type="checkbox" name="permission[]" id="permission" value="viewStickerStore" class="minimal"></td>
                        <td><input type="checkbox" name="permission[]" id="permission" value="deleteStickerStore" class="minimal"></td>
                      </tr>
                       <tr>
                        <td>Printing Films</td>
                        <td><input type="checkbox" name="permission[]" id="permission" value="createPrinting" class="minimal"></td>
                        <td><input type="checkbox" name="permission[]" id="permission" value="updatePrinting" class="minimal"></td>
                        <td><input type="checkbox" name="permission[]" id="permission" value="viewPrinting" class="minimal"></td>
                        <td><input type="checkbox" name="permission[]" id="permission" value="deletePrinting" class="minimal"></td>
                      </tr>
                       <tr>
                        <td>Production</td>
                        <td><input type="checkbox" name="permission[]" id="permission" value="createProduction" class="minimal"></td>
                        <td><input type="checkbox" name="permission[]" id="permission" value="updateProduction" class="minimal"></td>
                        <td><input type="checkbox" name="permission[]" id="permission" value="viewProduction" class="minimal"></td>
                        <td><input type="checkbox" name="permission[]" id="permission" value="deleteProduction" class="minimal"></td>
                      </tr>
					   <tr>
                        <td>Workorder</td>
                        <td><input type="checkbox" name="permission[]" id="permission" value="createWorkorder" class="minimal"></td>
                        <td><input type="checkbox" name="permission[]" id="permission" value="updateWorkorder" class="minimal"></td>
                        <td><input type="checkbox" name="permission[]" id="permission" value="viewWorkorder" class="minimal"></td>
                        <td><input type="checkbox" name="permission[]" id="permission" value="deleteWorkorder" class="minimal"></td>
                      </tr>
                      <tr>
                        <td>Workorder_acc</td>
                        <td><input type="checkbox" name="permission[]" id="permission" value="createWorkorder_acc" class="minimal"></td>
                        <td><input type="checkbox" name="permission[]" id="permission" value="updateWorkorder_acc" class="minimal"></td>
                        <td><input type="checkbox" name="permission[]" id="permission" value="viewWorkorder_acc" class="minimal"></td>
                        <td><input type="checkbox" name="permission[]" id="permission" value="deleteWorkorder_acc" class="minimal"></td>
                      </tr>
                      <tr>
                        <td>Orders</td>
                        <td><input type="checkbox" name="permission[]" id="permission" value="createOrder" class="minimal"></td>
                        <td><input type="checkbox" name="permission[]" id="permission" value="updateOrder" class="minimal"></td>
                        <td><input type="checkbox" name="permission[]" id="permission" value="viewOrder" class="minimal"></td>
                        <td><input type="checkbox" name="permission[]" id="permission" value="deleteOrder" class="minimal"></td>
                      </tr>
					  <tr>
                        <td>Pricing</td>
                        <td><input type="checkbox" name="permission[]" id="permission" value="createPricing" class="minimal"></td>
                        <td><input type="checkbox" name="permission[]" id="permission" value="updatePricing" class="minimal"></td>
                        <td><input type="checkbox" name="permission[]" id="permission" value="viewPricing" class="minimal"></td>
                        <td><input type="checkbox" name="permission[]" id="permission" value="deletePricing" class="minimal"></td>
                      </tr>
                      <tr>
                        <td>Reports</td>
                        <td> - </td>
                        <td> - </td>
                        <td><input type="checkbox" name="permission[]" id="permission" value="viewReports" class="minimal"></td>
                        <td> - </td>
                      </tr>
                      <tr>
                        <td>Company</td>
                        <td> - </td>
                        <td><input type="checkbox" name="permission[]" id="permission" value="updateCompany" class="minimal"></td>
                        <td> - </td>
                        <td> - </td>
                      </tr>
                      <tr>
                        <td>Profile</td>
                        <td> - </td>
                        <td> - </td>
                        <td><input type="checkbox" name="permission[]" id="permission" value="viewProfile" class="minimal"></td>
                        <td> - </td>
                      </tr>
                      <tr>
                        <td>Setting</td>
                        <td>-</td>
                        <td><input type="checkbox" name="permission[]" id="permission" value="updateSetting" class="minimal"></td>
                        <td> - </td>
                        <td> - </td>
                      </tr>
                    </tbody>
                  </table>
                  
                </div>
              </div>
              <!-- /.box-body -->

              <div class="box-footer">
                <button type="submit" class="btn btn-primary">Save Changes</button>
                <a href="<?php echo base_url('groups/') ?>" class="btn btn-warning">Back</a>
              </div>
            </form>
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
    $("#mainGroupNav").addClass('active');
    $("#addGroupNav").addClass('active');

    $('input[type="checkbox"].minimal').iCheck({
      checkboxClass: 'icheckbox_minimal-blue',
      radioClass   : 'iradio_minimal-blue'
    });
  });
</script>

