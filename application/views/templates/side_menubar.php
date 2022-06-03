<aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    
    <section class="sidebar">
      
      <!-- sidebar menu: : style can be found in sidebar.less -->
      <ul class="sidebar-menu" data-widget="tree">
         
        <li id="dashboardMainMenu">
          <a href="<?php echo base_url('dashboard') ?>">
            <i class="fa fa-dashboard"></i> <span>Dashboard</span>
          </a>
        </li>

        <?php if($user_permission): ?>
          <?php if(in_array('createUser', $user_permission) || in_array('updateUser', $user_permission) || in_array('viewUser', $user_permission) || in_array('deleteUser', $user_permission)): ?>
            <li class="treeview" id="mainUserNav">
            <a href="#">
              <i class="fa fa-users"></i>
              <span>Users</span>
              <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
              </span>
            </a>
            <ul class="treeview-menu">
              <?php if(in_array('createUser', $user_permission)): ?>
              <li id="createUserNav"><a href="<?php echo base_url('users/create') ?>"><i class="fa fa-circle-o"></i> Add User</a></li>
              <?php endif; ?>

              <?php if(in_array('updateUser', $user_permission) || in_array('viewUser', $user_permission) || in_array('deleteUser', $user_permission)): ?>
              <li id="manageUserNav"><a href="<?php echo base_url('users') ?>"><i class="fa fa-circle-o"></i> Manage Users</a></li>
            <?php endif; ?>
            </ul>
          </li>
          <?php endif; ?>

          <?php if(in_array('createGroup', $user_permission) || in_array('updateGroup', $user_permission) || in_array('viewGroup', $user_permission) || in_array('deleteGroup', $user_permission)): ?>
            <li class="treeview" id="mainGroupNav">
              <a href="#">
                <i class="fa fa-files-o"></i>
                <span>Groups</span>
                <span class="pull-right-container">
                  <i class="fa fa-angle-left pull-right"></i>
                </span>
              </a>
              <ul class="treeview-menu">
                <?php if(in_array('createGroup', $user_permission)): ?>
                  <li id="addGroupNav"><a href="<?php echo base_url('groups/create') ?>"><i class="fa fa-circle-o"></i> Add Group</a></li>
                <?php endif; ?>
                <?php if(in_array('updateGroup', $user_permission) || in_array('viewGroup', $user_permission) || in_array('deleteGroup', $user_permission)): ?>
                <li id="manageGroupNav"><a href="<?php echo base_url('groups') ?>"><i class="fa fa-circle-o"></i> Manage Groups</a></li>
                <?php endif; ?>
              </ul>
            </li>
          <?php endif; ?>
<?php if(in_array('createStore', $user_permission) || in_array('updateStore', $user_permission) || in_array('viewStore', $user_permission) || in_array('deleteStore', $user_permission)): ?>
            <li class="treeview" id="StoreNav">
              <a href="#">
                <i class="fa fa-cube"></i>
                <span>Store</span>
                <span class="pull-right-container">
                  <i class="fa fa-angle-left pull-right"></i>
                </span>
              </a>
              <ul class="treeview-menu">
                
                <?php if(in_array('createStore', $user_permission)): ?>
                  <li id="addStoreNav"><a href="<?php echo base_url('Store/') ?>"><i class="fa fa-files-o"></i> Main Store</a></li>
                <?php endif; ?>
                  </ul>
            </li>
          <?php endif; ?>
 <?php if(in_array('createBrand', $user_permission) || in_array('updateBrand', $user_permission) || in_array('viewBrand', $user_permission) || in_array('deleteBrand', $user_permission)): ?>
            <li class="treeview" id="brandNav">
              <a href="#">
                <i class="fa fa-cube"></i>
                <span>Raw Materials</span>
                <span class="pull-right-container">
                  <i class="fa fa-angle-left pull-right"></i>
                </span>
              </a>
              <ul class="treeview-menu">
                  
                <?php if(in_array('createBrand', $user_permission)): ?>
                  <li id="addProductNav"><a href="<?php echo base_url('brands/') ?>"><i class="fa fa-files-o"></i> Manage Items</a></li>
                <?php endif; ?>
                
                
                 <?php if(in_array('createStore', $user_permission) || in_array('updateStore', $user_permission) || in_array('viewStore', $user_permission) || in_array('deleteStore', $user_permission)): ?>
            <li id="storeNav">
              <a href="<?php echo base_url('stores/') ?>">
                <i class="glyphicon glyphicon-tasks"></i> <span> Manage Stores</span>
              </a>
            </li>
          <?php endif; ?>
              </ul>
            </li>
          <?php endif; ?>
          
          <?php if(in_array('createSupplier', $user_permission) || in_array('viewSupplier', $user_permission) || in_array('deleteSupplier', $user_permission)): ?>
                <li id="AddSupplier"><a href="<?php echo base_url('Supplier/') ?>"><i class=" fa fa-address-book"></i> Manage Supplier</a></li>
                <?php endif; ?>
		<?php if(in_array('createWorkers', $user_permission) || in_array('viewWorkers', $user_permission) || in_array('deleteWorkers', $user_permission)): ?>
                <li id="AddWorkers"><a href="<?php echo base_url('Workers/') ?>"><i class=" glyphicon glyphicon-user"></i> Manage Workers</a></li>
                <?php endif; ?>
<?php if(in_array('createWorkshop', $user_permission) || in_array('viewWorkshop', $user_permission) || in_array('deleteWorkshop', $user_permission)): ?>
                <li id="AddWorkshop"><a href="<?php echo base_url('Workshop/') ?>"><i class=" glyphicon glyphicon-cog"></i> Manage Workshop</a></li>
                <?php endif; ?>				
          <?php if(in_array('createCustomer', $user_permission) || in_array('viewCustomer', $user_permission) || in_array('deleteCustomer', $user_permission)): ?>
                <li id="AddCustomer"><a href="<?php echo base_url('Customer/') ?>"><i class=" fa fa-address-book"></i>Customers</a></li>
                <?php endif; ?>
      <?php if(in_array('createProduction', $user_permission) || in_array('updateProduction', $user_permission) || in_array('viewProduction', $user_permission) || in_array('deleteProduction', $user_permission)): ?>
            <li class="treeview" id="mainProductionNav">
              <a href="#">
                <i class="fa fa-cube"></i>
                <span>Production</span>
                <span class="pull-right-container">
                  <i class="fa fa-angle-left pull-right"></i>
                </span>
              </a>
              <ul class="treeview-menu">
                <?php if(in_array('createProduction', $user_permission)): ?>
                  <li id="addProductionNav"><a href="<?php echo base_url('production/create') ?>"><i class="fa fa-circle-o"></i> Add Production Order</a></li>
                <?php endif; ?>
                <?php if(in_array('updateProduction', $user_permission) || in_array('viewProduction', $user_permission) || in_array('deleteProduction', $user_permission)): ?>
                <li id="manageProductionNav"><a href="<?php echo base_url('production') ?>"><i class="fa fa-circle-o"></i> Manage Production Order</a></li>
               <li id="storeNav">
            <?php endif; ?>
                   <?php if(in_array('deleteProduction', $user_permission)):  ?>
                
                <li id="manageProductionNav"><a href="<?php echo base_url('production/log') ?>"><i class="fa fa-circle-o"></i>Logs</a></li>
                <?php endif; ?>
                
                <?php if(in_array('createProduction', $user_permission)):  ?>
                
                <li id="manageProductionNav"><a href="<?php echo base_url('production/P_report') ?>"><i class="fa fa-circle-o"></i> Report</a></li>
                <?php endif; ?>
                <?php if(in_array('createStore', $user_permission) || in_array('updateStore', $user_permission) || in_array('viewStore', $user_permission) || in_array('deleteStore', $user_permission)): ?>
            
          <?php endif; ?>
              </ul>
            </li>
          <?php endif; ?>
            
             <?php if(in_array('createDesign', $user_permission) || in_array('updateDesign', $user_permission) || in_array('viewDesign', $user_permission) || in_array('deleteDesign', $user_permission)): ?>
            <li class="treeview" id="mainDesignNav">
              <a href="#">
                <i class="fa fa-cube"></i>
                <span>Design</span>
                <span class="pull-right-container">
                  <i class="fa fa-angle-left pull-right"></i>
                </span>
              </a>
              <ul class="treeview-menu">
                <?php if(in_array('createDesign', $user_permission)): ?>
                  <li id="addDesignNav"><a href="<?php echo base_url('Design/create') ?>"><i class="fa fa-circle-o"></i> Add a Design</a></li>
                <?php endif; ?>
                <?php if(in_array('updateDesign', $user_permission) || in_array('viewDesign', $user_permission) || in_array('deleteDesign', $user_permission)): ?>
                <li id="manageDesignNav"><a href="<?php echo base_url('Design') ?>"><i class="fa fa-circle-o"></i> Manage a Design</a></li>
                <?php endif; ?>
               
              </ul>
            </li>
            <?php endif; ?>
			
			  <?php if(in_array('createBrushStore', $user_permission) || in_array('updateBrushStore', $user_permission) || in_array('viewBrushStore', $user_permission) || in_array('deleteBrushStore', $user_permission)): ?>
            <li class="treeview" id="mainBrushStoreNav">
              <a href="#">
                <i class="fa fa-cube"></i>
                <span>BrushStore</span>
                <span class="pull-right-container">
                  <i class="fa fa-angle-left pull-right"></i>
                </span>
              </a>
              <ul class="treeview-menu">
                <?php if(in_array('createBrushStore', $user_permission)): ?>
                  <li id="addBrushStoreNav"><a href="<?php echo base_url('BrushStore/create') ?>"><i class="fa fa-circle-o"></i> Add a BrushStore</a></li>
                <?php endif; ?>
                <?php if(in_array('updateBrushStore', $user_permission) || in_array('viewBrushStore', $user_permission) || in_array('deleteBrushStore', $user_permission)): ?>
                <li id="manageBrushStoreNav"><a href="<?php echo base_url('BrushStore') ?>"><i class="fa fa-circle-o"></i> Manage a BrushStore</a></li>
                <?php endif; ?>
               
              </ul>
            </li>
            <?php endif; ?>
			<?php if(in_array('createStickerStore', $user_permission) || in_array('updateStickerStore', $user_permission) || in_array('viewStickerStore', $user_permission) || in_array('deleteStickerStore', $user_permission)): ?>
            <li class="treeview" id="mainStickerStoreNav">
              <a href="#">
                <i class="fa fa-cube"></i>
                <span>StickerStore</span>
                <span class="pull-right-container">
                  <i class="fa fa-angle-left pull-right"></i>
                </span>
              </a>
              <ul class="treeview-menu">
                <?php if(in_array('createStickerStore', $user_permission)): ?>
                  <li id="addStickerStoreNav"><a href="<?php echo base_url('StickerStore/create') ?>"><i class="fa fa-circle-o"></i> Add a StickerStore</a></li>
                <?php endif; ?>
                <?php if(in_array('updateStickerStore', $user_permission) || in_array('viewStickerStore', $user_permission) || in_array('deleteStickerStore', $user_permission)): ?>
                <li id="manageStickerStoreNav"><a href="<?php echo base_url('StickerStore') ?>"><i class="fa fa-circle-o"></i> Manage a StickerStore</a></li>
                <?php endif; ?>
               
              </ul>
            </li>
            <?php endif; ?>
            
              <?php if(in_array('createDesignertasks', $user_permission) || in_array('updateDesignertasks', $user_permission) || in_array('viewDesignertasks', $user_permission) || in_array('deleteDesignertasks', $user_permission)): ?>
            <li class="treeview" id="mainDesignertasksNav">
              <a href="#">
                <i class="fa fa-cube"></i>
                <span>Designer Tasks</span>
                <span class="pull-right-container">
                  <i class="fa fa-angle-left pull-right"></i>
                </span>
              </a>
              <ul class="treeview-menu">
                <?php if(in_array('createDesignertasks', $user_permission)): ?>
                  <li id="addDesignertasksNav"><a href="<?php echo base_url('Designertasks/create') ?>"><i class="fa fa-circle-o"></i> Add a Designertasks</a></li>
                <?php endif; ?>
                <?php if(in_array('updateBrushStore', $user_permission) || in_array('viewDesignertasks', $user_permission) || in_array('deleteDesignertasks', $user_permission)): ?>
                <li id="manageDesignertasksNav"><a href="<?php echo base_url('Designertasks') ?>"><i class="fa fa-circle-o"></i> Manage a Designertasks</a></li>
                <?php endif; ?>
               
              </ul>
            </li>
            <?php endif; ?>
            <?php if(in_array('createPrinting', $user_permission) || in_array('updatePrinting', $user_permission) || in_array('viewPrinting', $user_permission) || in_array('deletePrinting', $user_permission)): ?>
            <li class="treeview" id="mainPrintingNav">
              <a href="#">
                <i class="fa fa-cube"></i>
                <span>Printing</span>
                <span class="pull-right-container">
                  <i class="fa fa-angle-left pull-right"></i>
                </span>
              </a>
              <ul class="treeview-menu">
                <?php if(in_array('createPrinting', $user_permission)): ?>
                  <li id="addPrintingNav"><a href="<?php echo base_url('Printing/create') ?>"><i class="fa fa-circle-o"></i> Add Printing</a></li>
                <?php endif; ?>
                <?php if(in_array('updatePrinting', $user_permission) || in_array('viewPrinting', $user_permission) || in_array('deletePrinting', $user_permission)): ?>
                <li id="managePrintingNav"><a href="<?php echo base_url('Printing') ?>"><i class="fa fa-circle-o"></i> Manage Printing</a></li>
                <?php endif; ?>
               
              </ul>
            </li>
          <?php endif; ?>
            
               <?php if(in_array('createCategory', $user_permission) || in_array('viewCategory', $user_permission) || in_array('deleteCategory', $user_permission)): ?>
            <li class="treeview" id="mainCategoryNav">
              <a href="#">
                <i class="fa fa-cube"></i>
                <span>Paints</span>
                <span class="pull-right-container">
                  <i class="fa fa-angle-left pull-right"></i>
                </span>
              </a>
              <ul class="treeview-menu">
                <?php if(in_array('createCategory', $user_permission) || in_array('viewCategory', $user_permission) || in_array('deleteCategory', $user_permission)): ?>
                <li id="AddCategory"><a href="<?php echo base_url('category/') ?>"><i class="fa fa-cog"></i> Manage Paints</a></li>
                <?php endif; ?>
                 <?php if(in_array('createCategory', $user_permission) || in_array('viewCategory', $user_permission) || in_array('deleteCategory', $user_permission)): ?>
                <li id="AddCategory"><a href="<?php echo base_url('category/') ?>"><i class="fa fa-cog"></i> Report</a></li>
                <?php endif; ?>
                
               
                
              </ul>
            </li>
          <?php endif; ?>
          <?php if(in_array('createProduct', $user_permission) || in_array('updateProduct', $user_permission) || in_array('viewProduct', $user_permission) || in_array('deleteProduct', $user_permission)): ?>
            <li class="treeview" id="mainProductNav">
              <a href="#">
                <i class="fa fa-cube"></i>
                <span>Products</span>
                <span class="pull-right-container">
                  <i class="fa fa-angle-left pull-right"></i>
                </span>
              </a>
              <ul class="treeview-menu">
                <?php if(in_array('createProduct', $user_permission)): ?>
                  <li id="addProductNav"><a href="<?php echo base_url('products/create') ?>"><i class="fa fa-circle-o"></i> Add Product</a></li>
                <?php endif; ?>
                <?php if(in_array('updateProduct', $user_permission) || in_array('viewProduct', $user_permission) || in_array('deleteProduct', $user_permission)): ?>
                <li id="manageProductNav"><a href="<?php echo base_url('products') ?>"><i class="fa fa-circle-o"></i> Manage Products</a></li>
                <?php endif; ?>
               
               <?php if( in_array('deleteProduct', $user_permission)): ?>
                <li id="manageProductNav"><a href="<?php echo base_url('products/Code') ?>"><i class="fa fa-circle-o"></i> Manage Codes</a></li>
                <?php endif; ?>
                
              </ul>
            </li>
          <?php endif; ?>


          <?php if(in_array('createOrder', $user_permission) || in_array('updateOrder', $user_permission) || in_array('viewOrder', $user_permission) || in_array('deleteOrder', $user_permission)): ?>
            <li class="treeview" id="mainOrdersNav">
              <a href="#">
                <i class="fa fa-dollar"></i>
                <span>Orders</span>
                <span class="pull-right-container">
                  <i class="fa fa-angle-left pull-right"></i>
                </span>
              </a>
              <ul class="treeview-menu">
                <?php if(in_array('createOrder', $user_permission)): ?>
                  <li id="addOrderNav"><a href="<?php echo base_url('orders/create') ?>"><i class="fa fa-circle-o"></i> Add Order</a></li>
                <?php endif; ?>
                <?php if(in_array('updateOrder', $user_permission) || in_array('viewOrder', $user_permission) || in_array('deleteOrder', $user_permission)): ?>
                <li id="manageOrdersNav"><a href="<?php echo base_url('orders') ?>"><i class="fa fa-circle-o"></i> Manage Orders</a></li>
                <?php endif; ?>
              </ul>
            </li>
          <?php endif; ?>
		  
		  <?php if(in_array('createPricing', $user_permission) || in_array('updatePricing', $user_permission) || in_array('viewPricing', $user_permission) || in_array('deletePricing', $user_permission)): ?>
            <li class="treeview" id="mainPricingNav">
              <a href="#">
                <i class="fa fa-dollar"></i>
                <span>Pricing</span>
                <span class="pull-right-container">
                  <i class="fa fa-angle-left pull-right"></i>
                </span>
              </a>
              <ul class="treeview-menu">
                <?php if(in_array('createPricing', $user_permission)): ?>
                  <li id="addPricingNav"><a href="<?php echo base_url('Pricing/create') ?>"><i class="fa fa-circle-o"></i> Add Pricing</a></li>
                <?php endif; ?>
                <?php if(in_array('updatePricing', $user_permission) || in_array('viewPricing', $user_permission) || in_array('deletePricing', $user_permission)): ?>
                <li id="managePricingNav"><a href="<?php echo base_url('Pricing') ?>"><i class="fa fa-circle-o"></i> Manage Pricing</a></li>
                <?php endif; ?>
                <?php if(in_array('createAttribute', $user_permission) || in_array('updateAttribute', $user_permission) || in_array('viewAttribute', $user_permission) || in_array('deleteAttribute', $user_permission)): ?>
                <li id="attributeNav">
                <a href="<?php echo base_url('attributes/') ?>">
                <i class="fa fa-files-o"></i> <span>Pricing Attributes</span>
                </a>
                </li>
                <?php endif; ?>
              </ul>
            </li>
          <?php endif; ?>

          <?php if(in_array('viewReports', $user_permission)): ?>
            <li id="reportNav">
              <a href="<?php echo base_url('reports/') ?>">
                <i class="glyphicon glyphicon-stats"></i> <span>Reports</span>
              </a>
            </li>
          <?php endif; ?>


          <?php if(in_array('updateCompany', $user_permission)): ?>
            <li id="companyNav"><a href="<?php echo base_url('company/') ?>"><i class="fa fa-files-o"></i> <span>Company</span></a></li>
          <?php endif; ?>

        

        <!-- <li class="header">Settings</li> -->

        <?php if(in_array('viewProfile', $user_permission)): ?>
          <li><a href="<?php echo base_url('users/profile/') ?>"><i class="fa fa-user-o"></i> <span>Profile</span></a></li>
        <?php endif; ?>
        <?php if(in_array('updateSetting', $user_permission)): ?>
          <li><a href="<?php echo base_url('users/setting/') ?>"><i class="fa fa-wrench"></i> <span>Setting</span></a></li>
        <?php endif; ?>

        <?php endif; ?>
        <!-- user permission info -->
        <li><a href="<?php echo base_url('auth/logout') ?>"><i class="glyphicon glyphicon-log-out"></i> <span>Logout</span></a></li>
 
      </ul>
    </section>
    <!-- /.sidebar -->
  </aside>