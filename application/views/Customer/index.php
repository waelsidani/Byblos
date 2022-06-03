<?php declare(strict_types=1) ?>


<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      Manage
      <small>Customer</small>
    </h1>
    <ol class="breadcrumb">
      <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
      <li class="active">Customer</li>
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

        <?php if(in_array('createCustomer', $user_permission)): ?>
          <button class="btn btn-primary" data-toggle="modal" data-target="#addModal">Add Customer</button>
          <br /> <br />
        <?php endif; ?>

        <div class="box">
          <div class="box-header">
            <h3 class="box-title">Manage Customer</h3>
          </div>
          <!-- /.box-header -->
          <div class="box-body">
           <?php   $this->load->model('model_Customer');
$users = $this->model_Customer->getCustomeruser();?>
  
               <select    class="form-control select_group Material" id="myDropdown" style="width : 200px" onchange="filterFunction()">
          <option  value=""></option>
          
          <?php foreach ($users as $k => $v): ?>
          <option  value="<?php echo $v['user'] ?>"><?php echo $v['user']?></option>
                    <?php endforeach ?>
      </select>
              
   <select class="btn btn-secondary dropdown-toggle"  style="background: #fff9e5 ; border:1px solid #ccc"  id="myDropdown1" style="width : 200px ;" onchange="filterFunction1()">
          <option  value=""></option>
          <option  value="Potential Customer" style="background: red ; color: white ;font-size: 15px; font-family: Times New Roman;">Potential Customer</option> 
          <option  value="Under Communication Customer" style="background: #ffdb1f ;font-size: 15px; font-family: Times New Roman; ">Under Communication Customer</option>
          <option  value="Final Customer" style="background: green; color: white ; font-size: 15px; font-family: Times New Roman;">Final Customer</option>
                    
      </select> 
            <table id="manageTable" class="table table-bordered table-striped">
              <thead>
              <tr>
                  <th style="width: 10%;">Company Name</th>
                <th style="width: 10%;">Contact Person Name</th>
                <th style="width: 15%;">Added Date</th>
                <th style="width: 10%;">Added By User</th>
                <th style="width: 10%;">Phone</th>
                <th style="width: 10%;">Wts-Phone</th>
                <th style="width: 10%;">Status</th>
                <th style="width: 20%;">Last Action</th>
                <?php if(in_array('updateCustomer', $user_permission) || in_array('deleteCustomer', $user_permission)): ?>
                  <th style="width: 5%;">Action</th>
                <?php endif; ?>
              </tr>
              </thead>

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

<?php if(in_array('createCustomer', $user_permission)): ?>
<!-- create brand modal -->
<div class="modal fade" tabindex="-1" role="dialog" id="addModal">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Add Customer</h4>
      </div>
        <form role="form" action="<?php echo base_url('Customer/create') ?>" method="post" id="createForm" onclose="window.location.reload()" > 
      <div class="modal-body">
          
          <div class="form-group">
             <input type='hidden' value='0' name='Customer_Website'>
             <input type='hidden' value='0' name='Customer_Alibaba'>
             <input type='hidden' value='0' name='Customer_istoc'>
             <input type='hidden' value='0' name='Customer_Social_Media'>
             <input type='hidden' value='--Select--' name='Customer_Social_Media_Type'>
            <label for="Customer_Company">Company Name</label>
            <input type="text" class="form-control" id="Customer_Company" name="Customer_Company" placeholder="Enter Customer Company" autocomplete="off">
          </div>
            <div class="form-group">
            <label for="Customer_phone1" >Phone Number</label>
            <input type="text" class="form-control" id="Customer_phone1" name="Customer_phone1" placeholder="Enter Customer Contact Number" autocomplete="off">
          </div>
            <div class="form-group">
            <label for="Customer_Contact">Contact Person Name</label>
            <input type="text" class="form-control" id="Customer_Contact" name="Customer_Contact" placeholder="Enter Contact Person name" autocomplete="off">
          </div>
            <div class="form-group">
            <label for="Customer_phone2" >Contact Person Phone Number</label>
            <input type="text" class="form-control" id="Customer_phone2" name="Customer_phone2" placeholder="Enter Customer Contact Number" autocomplete="off">
          </div>
             
            <div class="form-group">
            <label for="Customer_phone3" >Contact Person Whatsapp</label>
            <input type="text" class="form-control" id="Customer_phone3" name="Customer_phone3" placeholder="Enter Customer Contact Whatsapp Number" autocomplete="off">
          </div>
            
          <div class="form-group">
            <label for="Customer_Address" value="Turkey">Address</label>
            <input type="text" class="form-control" id="Customer_Address" name="Customer_Address" placeholder="Enter Customer Address" autocomplete="off">
          </div>
           
             <div class="form-group">
            <label for="Customer_email" >Email</label>
            <input type="text" class="form-control" id="Customer_email" name="Customer_email" placeholder="Enter Customer Contact Email" autocomplete="off">
          </div>
 
            <div class="form-group">
            <label for="Customer_web" >WebSite</label>
            <input type="text" class="form-control" id="Customer_web" name="Customer_web" placeholder="Enter Customer Contact Web" autocomplete="off">
          </div>
            
                <input type="hidden" class="form-control" id="Customer_user" name="Customer_user" value="<?php echo $_SESSION['username'];?>" placeholder="Enter Customer Contact Email" autocomplete="off">
             <input type="hidden" class="form-control" id="Customer_addeddate" name="Customer_addeddate" value="<?php echo  date("Y/m/d");?>" placeholder="Enter Customer Contact Email" autocomplete="off">
      <div class="form-group">
            <label for="Customer_Sales" >Sales Person</label>
            <input type="text" class="form-control" id="Customer_Sales" name="Customer_Sales" placeholder="Enter Sales Name" autocomplete="off">
          </div>
       
            <div class="input-group-prepend">
            <div class="input-group-text">
                <h3>How He/She Reach Us</h3>
                 <label for="Customer_Salesperson" >Through(person): </label>
                <input type="text"  class="form-control" id="Customer_Salesperson" name="Customer_Salesperson" placeholder="Enter Sales Person Name" autocomplete="off">
            <input type="checkbox" name="Customer_Website" id="Customer_Website"value='Website'/>
               <label for="Customer_Website" >Website</label>
            <script>
                   document.getElementById('Customer_Website').onchange = function()
                   {if (this.checked) 
            {document.getElementById('Customer_istoc').checked= false;
            document.getElementById('Customer_Alibaba').checked= false;
            document.getElementById('Customer_Social_Media').checked= false;
        document.getElementById('Customer_Social_Media_Type').disabled= "true";}}
                   </script>
           </div></div>
         
           <div class="input-group-text">
           
           <input type="checkbox" name="Customer_Alibaba" id="Customer_Alibaba"value='AliBaba'/>
             <label for="Customer_Alibaba" >AliBaba</label>     
           <script>
                   document.getElementById('Customer_Alibaba').onchange = function()
                   {if (this.checked) 
            {document.getElementById('Customer_istoc').checked= false;
            document.getElementById('Customer_Social_Media').checked= false;
            document.getElementById('Customer_Website').checked= false;
        document.getElementById('Customer_Social_Media_Type').disabled= "true";}}
                   </script>
           </div>
                     
           <div class="input-group-text">
          
           
           <input type="checkbox" name="Customer_istoc" id="Customer_istoc"value='İstoç'  />
               <label for="Customer_istoc" >İstoç</label>   
               <script>
                   document.getElementById('Customer_istoc').onchange = function()
                   {if (this.checked) 
            {document.getElementById('Customer_Social_Media').checked= false;
            document.getElementById('Customer_Alibaba').checked= false;
            document.getElementById('Customer_Website').checked= false;
        document.getElementById('Customer_Social_Media_Type').disabled= "true";}}
                   </script>
                      </div>
                         
          <div class="input-group-text">
          
           
              <input type="checkbox" name="Customer_Social_Media" id="Customer_Social_Media"value='Social Media' />
               <label for="Customer_Social_Media" >Social Media</label>     
                      </div>
           
     <script>
                    document.getElementById('Customer_Social_Media').onchange = function()
                    {
                    if (this.checked){
                            document.getElementById('Customer_Social_Media_Type').removeAttribute('disabled'); 
                            document.getElementById('Customer_istoc').checked= false;
            document.getElementById('Customer_Alibaba').checked= false;
            document.getElementById('Customer_Website').checked= false;
                            
                        }
                 else{document.getElementById('Customer_Social_Media_Type').disabled= "true";}
                     }
                    </script>
            
                
          <div class="form-group">
            <label for="Customer_Social_Media_Type">Social Media</label>
            <select class="form-control" id="Customer_Social_Media_Type" name="Customer_Social_Media_Type" disabled>
                
                
              <option value="">---Select---</option>
              <option value="Facebook">Facebook</option>
              <option value="Instagram">Instagram</option>
              <option value="Twitter">Twitter</option>
              <option value="Linkedin">Linkedin</option>
            </select>
          </div>
                    <label for="Status">Action</label>
                     <textarea rows="2" cols="50" style="resize : none" placeholder="Add Details" type="text" name="Note-1[]" value="-" id="Note-1" class="form-control" required   autocomplete="off" ></textarea>
                           
                        <div class="form-group">
         <label for="Status">Status</label>
            <select class="form-control"  id="Status" name="Status" >
            <option  value="0">Potential Customer</option>
            <option value="1">Under Communication Customer</option>
            <option value="2">Final Customer</option>
           
            </select>
</div>  
                 </div>

               
          
        <div class="modal-footer">
          <button type="button"  class="btn btn-default" data-dismiss="modal">Close</button>
          <button type="submit"  onClick="window.parent.location.reload();window.close()" class="btn btn-primary">Save changes</button>
      </div>

            </form>


    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<?php endif; ?>

<?php if(in_array('updateCustomer', $user_permission)): ?>
<!-- edit brand modal -->
<div class="modal fade" tabindex="-1" role="dialog" id="editModal">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Edit Customer</h4>
      </div>

     <form role="form" action="<?php echo base_url('Customer/update') ?>" method="POST" id="updateForm" >
     
         <div class="modal-body">
          
          <div class="form-group">
         <input type='hidden' value='0' name='Customer_Website'>
           
              
          
 
             <input type='hidden'  id='edit_Customer_Website'name="edit_Customer_Website">
             <input type='hidden' id='edit_Customer_Alibaba' name ='edit_Customer_Alibaba'>
             <input type='hidden' id='edit_Customer_istoc'name="edit_Customer_istoc">
             <input type='hidden'  id='edit_Customer_Social_Media'name="edit_Customer_Social_Media"  >
             <input type='hidden' id='edit_Customer_Social_Media_Type'name="edit_Customer_Social_Media_Type">
         

          
            <label for="edit_Customer_Company">Company Name</label>
       
            <input type="text" class="form-control" id="edit_Customer_Company" name="edit_Customer_Company" placeholder="Enter Customer Company" autocomplete="off">
          </div>
            <div class="form-group">
            <label for="edit_Customer_phone1" >Phone Number</label>
            <input type="text" class="form-control" id="edit_Customer_phone1" name="edit_Customer_phone1" placeholder="Enter Customer Contact Number" autocomplete="off">
          </div>
            <div class="form-group">
            <label for="edit_Customer_Contact">Contact Person Name</label>
            <input type="text" class="form-control" id="edit_Customer_Contact" name="edit_Customer_Contact" placeholder="Enter Contact Person name" autocomplete="off">
          </div>
            <div class="form-group">
            <label for="edit_Customer_phone2" >Contact Person Phone Number</label>
            <input type="text" class="form-control" id="edit_Customer_phone2" name="edit_Customer_phone2" placeholder="Enter Customer Contact Number" autocomplete="off">
          </div>
             
            <div class="form-group">
            <label for="edit_Customer_phone3" >Contact Person Whatsapp</label>
            <input type="text" class="form-control" id="edit_Customer_phone3" name="edit_Customer_phone3" placeholder="Enter Customer Contact Whatsapp Number" autocomplete="off">
          </div>
            
          <div class="form-group">
            <label for="edit_Customer_Address" value="Turkey">Address</label>
            <input type="text" class="form-control" id="edit_Customer_Address" name="edit_Customer_Address" placeholder="Enter Customer Address" autocomplete="off">
          </div>
           
             <div class="form-group">
            <label for="edit_Customer_email" >Email</label>
            <input type="text" class="form-control" id="edit_Customer_email" name="edit_Customer_email" placeholder="Enter Customer Contact Email" autocomplete="off">
          </div>
 
            <div class="form-group">
            <label for="edit_Customer_web" >WebSite</label>
            <input type="text" class="form-control" id="edit_Customer_web" name="edit_Customer_web" placeholder="Enter Customer Contact Web" autocomplete="off">
          </div>
            
                <input type="hidden" class="form-control" id="edit_Customer_user" name="edit_Customer_user" value="<?php echo $_SESSION['username'];?>" placeholder="Enter Customer Contact Email" autocomplete="off">
             <input type="hidden" class="form-control" id="edit_Customer_addeddate" name="edit_Customer_addeddate" value="<?php echo  date("Y/m/d");?>" placeholder="Enter Customer Contact Email" autocomplete="off">
      <div class="form-group">
            <label for="edit_Customer_Sales" >Sales Person</label>
            <input type="text" class="form-control" id="edit_Customer_Sales" name="edit_Customer_Sales" placeholder="Enter Sales Name" autocomplete="off">
          </div>
       
            <div class="input-group-prepend">
            <div class="input-group-text">
                <h3>How He/She Reach Us</h3>
                 <label for="edit_Customer_Salesperson" >Through(person): </label>
                <input type="text"  class="form-control" id="edit_Customer_Salesperson" name="edit_Customer_Salesperson" placeholder="Enter Sales Person Name" autocomplete="off">
          
                <input type="checkbox" name="edit_Customer_Website1" id="edit_Customer_Website1" value='Website' />
              
                <label for="edit_Customer_Website1" >Website</label>
            <script>
                   document.getElementById('edit_Customer_Website1').onchange = function()
                   {if (this.checked) 
            {
                        $("#edit_Customer_istoc").val("0");
                        $("#edit_Customer_Website").val("Website");
                        $("#edit_Customer_Social_Media").val("0");
                        $("#edit_Customer_Alibaba").val("0");
                        $("#edit_Customer_Social_Media_Type").val("none");
            document.getElementById('edit_Customer_istoc1').checked= false;
            document.getElementById('edit_Customer_Alibaba1').checked= false;
            document.getElementById('edit_Customer_Social_Media1').checked= false;
            document.getElementById('edit_Customer_Social_Media_Type1').disabled= "true";}};
                   </script>
           </div>
         </div>
           <div class="input-group-text">
           
           <input type="checkbox" name="edit_Customer_Alibaba1" id="edit_Customer_Alibaba1" value='Alibaba'/>
             <label for="edit_Customer_Alibaba1" >AliBaba</label>     
           <script>
                   document.getElementById('edit_Customer_Alibaba1').onchange = function()
                   {if (this.checked)
                       {
                        $("#edit_Customer_istoc").val("0");
                        $("#edit_Customer_Website").val("0");
                        $("#edit_Customer_Social_Media").val("0");
                        $("#edit_Customer_Alibaba").val("Alibaba");
                        $("#edit_Customer_Social_Media_Type").val("none");
            document.getElementById('edit_Customer_istoc1').checked= false;
            document.getElementById('edit_Customer_Social_Media1').checked= false;
            document.getElementById('edit_Customer_Website1').checked= false;
            document.getElementById('edit_Customer_Social_Media_Type1').disabled= "true";}};
                   </script>
           </div>
                     
           
          
              
               <input type="checkbox" name="edit_Customer_istoc1" id="edit_Customer_istoc1" value='Istoc'  />
               <label for="edit_Customer_istoc1" >İstoç</label>   
               <script>
                   document.getElementById('edit_Customer_istoc1').onchange = function()
                   {if (this.checked) 
            {
             $("#edit_Customer_istoc").val("Istoc");
             $("#edit_Customer_Website").val("0");
             $("#edit_Customer_Social_Media").val("0");
             $("#edit_Customer_Alibaba").val("0");
             $("#edit_Customer_Social_Media_Type").val("none");
            document.getElementById('edit_Customer_Social_Media1').checked= false;
            document.getElementById('edit_Customer_Alibaba1').checked= false;
            document.getElementById('edit_Customer_Website1').checked= false;
            document.getElementById('edit_Customer_Social_Media_Type1').disabled= "true";}};
                   </script>
                      
                         
          <div class="input-group-text">
          
           
              <input type="checkbox" name="edit_Customer_Social_Media1" id="edit_Customer_Social_Media1" value='Social Media' />
               <label for="edit_Customer_Social_Media1" >Social Media</label>     
                      </div>
           
     <script>
                    document.getElementById('edit_Customer_Social_Media1').onchange = function()
                    {
                    if (this.checked){
                        
                        $("#edit_Customer_istoc").val("0");
                        $("#edit_Customer_Website").val("0");
                        $("#edit_Customer_Social_Media").val("Social Media");
                        $("#edit_Customer_Alibaba").val("0");
                   
                            document.getElementById('edit_Customer_Social_Media_Type1').removeAttribute('disabled'); 
                            document.getElementById('edit_Customer_istoc1').checked= false;
                            document.getElementById('edit_Customer_Alibaba1').checked= false;
                            document.getElementById('edit_Customer_Website1').checked= false;
                             
                        }
                 else{document.getElementById('edit_Customer_Social_Media_Type1').disabled= "true";}
                     };
                    </script>
             
                
          <div class="form-group">
            <label for="edit_Customer_Social_Media_Type1">Social Media</label>
            <select class="form-control" disabled id="edit_Customer_Social_Media_Type1" name="edit_Customer_Social_Media_Type1" >
                
                
              <option  value="">---Select---</option>
              <option value="Facebook">Facebook</option>
              <option value="Instagram">Instagram</option>
              <option value="Twitter">Twitter</option>
              <option value="Linkedin">Linkedin</option>
            </select>
            
            <script>  
   
  $( "select" ) .change(function () {    
document.getElementById("edit_Customer_Social_Media_Type").value= document.getElementById("edit_Customer_Social_Media_Type1").value;  
                        $("#edit_Customer_istoc").val("0");
                        $("#edit_Customer_Website").val("0");
                        $("#edit_Customer_Social_Media").val("Social Media");
                        $("#edit_Customer_Alibaba").val("0");
                            document.getElementById('edit_Customer_istoc1').checked= false;
                            document.getElementById('edit_Customer_Alibaba1').checked= false;
                            document.getElementById('edit_Customer_Website1').checked= false;
                             
                        
});  
                    </script>
          </div>
                  
                   
                                        
                    <div class="form-group">
                   <table class="table table-bordereded" id="Action_info_table">
                  <thead>
                      <tr><th style=" font-size: 20px ">Update</th></tr>
                    <tr>
                     
                      <th style="width:90%">Note</th>
                   
                      <th style="width: 10%"><button type="button" id="add_row2" class="btn btn-default"><i class="fa fa-plus"></i></button></th>
                    </tr>
                  </thead>

                   <tbody>
                    <tr id="row2_1">
                  
                       
      </tr>
                   
                     
                        
                   </tbody>
                </table>
                        <input type="hidden" readonly name="ID" id="ID" class="form-control"   autocomplete="off"></td>
                           
              <button type="button" onclick="addfiles()" class="btn btn-default" class="fa fa-plus" id="addfilebut"> Add File</button>     
        </div>
<div class="box-body">
            <table id="Action_info_table4" class="table table-bordered table-striped">
              <thead>
              <tr>
                <th>File Name</th>
               
                  <th>Action</th>
               
              </tr>
              </thead>
             <tr id="row_1">
             	
              </tr>
            </table>
                 
          </div>
       <div class="form-group">
         <label for="Status">Status</label>
        <select class="form-control"  id="Status_1" name="Status_1" >
                
                
                <option value="0">Potential Customer</option>
              <option value="1">Under Communication Customer</option>
              <option value="2">Final Customer</option>
           
            </select>
</div>        
                   
        
</div>
          

        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
          <button type="submit" onClick="window.parent.location.reload();window.close()" class="btn btn-primary">Save changes</button>
      </div>

            </form>
 
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<?php endif; ?>

<?php if(in_array('deleteCustomer', $user_permission)): ?>
<!-- remove brand modal -->
<div class="modal fade" tabindex="-1" role="dialog" id="removeModal">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Remove Customer</h4>
      </div>

      <form role="form" action="<?php echo base_url('Customer/remove') ?>" method="post" id="removeForm">
        <div class="modal-body">
          <p>Do you really want to remove?</p>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
          <button type="submit" onClick="window.parent.location.reload();window.close()" class="btn btn-primary" >Save changes</button>
        </div>
      </form>
        


    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<?php endif; ?>


<?php if(in_array('deleteCustomer', $user_permission)): ?>
<!-- remove brand modal -->
<div class="modal fade" tabindex="-1" role="dialog" id="addfile">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Add Attachment</h4>
      </div>

     
        


    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<?php endif; ?>


<script type="text/javascript">
    
    function filterFunction1() {
 

       div = document.getElementById("myDropdown1").value + " " +document.getElementById("myDropdown").value;
  
  manageTable.search(div).draw();
}
function filterFunction() {
 

  div = div = document.getElementById("myDropdown1").value + " " +document.getElementById("myDropdown").value;;

  manageTable.search(div).draw();
}
      
    
var manageTable;

$(document).ready(function() {
  $("#CustomerNav").addClass('active');
  
  // initialize the datatable 
  manageTable = $('#manageTable').DataTable({
    'ajax': 'fetchCustomerData',
    'order': [],
    
  });

  // submit the create from 
  $("#createForm").unbind('submit').on('submit', function() {
    var form = $(this);

    // remove the text-danger
    $(".text-danger").remove();

    $.ajax({
      url: form.attr('action'),
      type: form.attr('method'),
      data: form.serialize(), // /converting the form data into array and sending it to server
      dataType: 'json',
      success:function(response) {

        manageTable.ajax.reload(null, false); 

        if(response.success === true) {
          $("#messages").html('<div class="alert alert-success alert-dismissible" role="alert">'+
            '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>'+
            '<strong> <span class="glyphicon glyphicon-ok-sign"></span> </strong>'+response.messages+
          '</div>');


          // hide the modal
          $("#addModal").modal('hide');

          // reset the form
          $("#createForm")[0].reset();
          $("#createForm .form-group").removeClass('has-error').removeClass('has-success');

        } else {

          if(response.messages instanceof Object) {
            $.each(response.messages, function(index, value) {
              var id = $("#"+index);

              id.closest('.form-group')
              .removeClass('has-error')
              .removeClass('has-success')
              .addClass(value.length > 0 ? 'has-error' : 'has-success');
              
              id.after(value);

            });
          } else {
            $("#messages").html('<div class="alert alert-warning alert-dismissible" role="alert">'+
              '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>'+
              '<strong> <span class="glyphicon glyphicon-exclamation-sign"></span> </strong>'+response.messages+
            '</div>');
          }
        }
      }
    }); 

    return false;
  });

});

// edit function
function editFunc(id)
{ 
  $.ajax({
    url: 'fetchCustomerDataById/'+id,
    type: 'post',
    dataType: 'json',
    success:function(response) {

    
      $("#edit_Customer_Company").val(response.company);
      $("#edit_Customer_phone1").val(response.phone1);
      $("#edit_Customer_Contact").val(response.contactname);
      $("#edit_Customer_phone2").val(response.phone2);
      $("#edit_Customer_phone3").val(response.phone3);
      $("#edit_Customer_Address").val(response.address);
      $("#edit_Customer_email").val(response.email);
      $("#edit_Customer_web").val(response.website);
      $("#edit_Customer_user").val(response.user);
      $("#edit_Customer_addeddate").val(response.date);
      $("#edit_Customer_Sales").val(response.sales);
      $("#edit_Customer_Salesperson").val(response.salesperson);
      $("#edit_Customer_Website").val(response.web);
      $("#edit_Customer_Alibaba").val(response.alibaba);
      $("#edit_Customer_istoc").val(response.istoc);
      $("#edit_Customer_Social_Media").val(response.socialmedia);
      $("#edit_Customer_Social_Media_Type").val(response.socialmediatype);
      $('#edit_Customer_Social_Media_Type1').find('option[value="'+response.socialmediatype+'"]').prop('selected', true); 
      $('#Status_1').find('option[value="'+response.Status+'"]').prop('selected', true);     
      $("#ID").val(response.id);
       var result2= response.Note_action;
      
        var result4= response.filenote;
          
        var files = response.files;
        var files2= files.substr(2);
        var files3= files2.substr(0,files2.length-2);
        var files4 = files3.split('","');
        
        var filenote= result4.substr(2);
        var filenote1= filenote.substr(0,filenote.length-2);
        var filenote2= filenote1.split('","');
      
        var Note= result2.substr(2);
        var Note1= Note.substr(0,Note.length-2);
        var Note2= Note1.split('","');
        
       
        var u = 1;
        var count_table_tbody_tr3 = $("#Action_info_table tbody tr").length;
        var count_table_tbody_tr4 = $("#Action_info_table4 tbody tr").length;
        var base_url2 = "<?php echo base_url(); ?>";
        while(u -1< files4.length) {
        var files7 = base_url2 + files4[u-1];
        var files8= files7.replace("[","");
        var files9= files8.replace("]","");
        var files199= files9.replace('"','');
        if (u === 1){var files10 = files199;}
        else{
        var files10 = files199.substring(0, files199.length - 2);
    }
               var html4 = '<tr id="row_'+u+'">'+
                   '<td><a id="files_'+u+'" href= "'+files10+'"  target="_blank" >'+files10.substr(files10.length -3)+'</a></td>'+
    '<td><input type="text"   id= "filenote_'+u+'" class="form-control"  name= "filenote[]"   ></td>'+            
                    '</tr>';

                if(count_table_tbody_tr4 >= 1) {
                $("#Action_info_table4 tbody tr:last").after(html4); 
                
              }
              else {
                $("#Action_info_table4 tbody").html(html4);
              }

              $(".Action").select2();
   
    u++;
}
     if (filenote2.length === 1)
{document.getElementById("filenote_1").value = filenote2[0];
     
 }else{
      
        var i3 = 1;
        
        
while(i3 < filenote2.length) {
   

     document.getElementById("filenote_"+i3).value = filenote2[i3-1];
     document.getElementById("filenote_"+(i3+1)).value = filenote2[i3];

    i3++;
}}
   
var j = 1;


while(j-1 < Note2.length) {
       
               var html3 = '<tr id="row2_'+j+'">'+
                  
                            
                   '<td><textarea rows="4" cols="50" style="resize : none" type="text" name="Note[]" id="Note_'+j+'" class="form-control" ></textarea></td>'+            
                          
           
                    '<td><button type="button" class="btn btn-default" onclick="removeRow2(\''+j+'\')"><i class="fa fa-close"></i></button></td>'+
                    '</tr>';

                if(count_table_tbody_tr3 >= 1) {
                $("#Action_info_table tbody tr:last").after(html3); 
                
              }
              else {
                $("#Action_info_table tbody").html(html3);
              }

              $(".Action").select2();
   
    j++;
}

if (Note2.length === 1){
    document.getElementById("Note_1").value = Note2[0];

     
 }else{


        var i = 1;
        
        
        
        
while(i < Note2.length) {
   

     document.getElementById("Note_"+i).value = Note2[i-1];
     document.getElementById("Note_"+(i+1)).value = Note2[i];

    i++;
}
 }

 
     var  w = $("#edit_Customer_Website").val();
     var  a = $("#edit_Customer_Alibaba").val();
     var  i = $("#edit_Customer_istoc").val();
     var  s = $("#edit_Customer_Social_Media").val();
     if (w !== "0")
      {$("#edit_Customer_Website1").prop( "checked", true );}
       else if (a !== "0")
       {$("#edit_Customer_Alibaba1").prop( "checked", true );}
       else if (i !== "0")
       {$("#edit_Customer_istoc1").prop( "checked", true );}
       else if (s !== "0")
       {$("#edit_Customer_Social_Media1").prop( "checked", true );}
           
      // submit the edit from 
      $("#updateForm").unbind('submit').bind('submit', function() {
        var form = $(this);

        // remove the text-danger
        $(".text-danger").remove();

        $.ajax({
          url: form.attr('action') + '/' + id,
          type: form.attr('method'),
          data: form.serialize(), // /converting the form data into array and sending it to server
          dataType: 'json',
          mimeType:"multipart/form-data",
          success:function(response) {

            manageTable.ajax.reload(null, false); 

            if(response.success === true) {
              $("#messages").html('<div class="alert alert-success alert-dismissible" role="alert">'+
                '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>'+
                '<strong> <span class="glyphicon glyphicon-ok-sign"></span> </strong>'+response.messages+
              '</div>');


              // hide the modal
              $("#editModal").modal('hide');
              // reset the form 
              $("#updateForm .form-group").removeClass('has-error').removeClass('has-success');

            } else {

              if(response.messages instanceof Object) {
                $.each(response.messages, function(index, value) {
                  var id = $("#"+index);

                  id.closest('.form-group')
                  .removeClass('has-error')
                  .removeClass('has-success')
                  .addClass(value.length > 0 ? 'has-error' : 'has-success');
                  
                  id.after(value);

                });
              } else {
                $("#messages").html('<div class="alert alert-warning alert-dismissible" role="alert">'+
                  '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>'+
                  '<strong> <span class="glyphicon glyphicon-exclamation-sign"></span> </strong>'+response.messages+
                '</div>');
              }
            }
          }
        }); 

        return false;
      });

    }
  });
}

 
function removeFunc(id)
{
  if(id) {
    $("#removeForm").on('submit', function() {

      var form = $(this);

      // remove the text-danger
      $(".text-danger").remove();

      $.ajax({
        url: form.attr('action'),
        type: form.attr('method'),
        data: { Customer_id:id }, 
        dataType: 'json',
        success:function(response) {

          manageTable.ajax.reload(null, false); 

          if(response.success === true) {
            $("#messages").html('<div class="alert alert-success alert-dismissible" role="alert">'+
              '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>'+
              '<strong> <span class="glyphicon glyphicon-ok-sign"></span> </strong>'+response.messages+
            '</div>');

            // hide the modal
            $("#removeModal").modal('hide');

          } else {

            $("#messages").html('<div class="alert alert-warning alert-dismissible" role="alert">'+
              '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>'+
              '<strong> <span class="glyphicon glyphicon-exclamation-sign"></span> </strong>'+response.messages+
            '</div>'); 
          }
        }
      }); 

      return false;
    });
  }
}
{    $(".select_group").select2();
    $("#add_row2").unbind('click').bind('click', function() {
      var table = $("#Action_info_table");
      var count_table_tbody_tr2 = $("#Action_info_table tbody tr").length;
    
      var row_id2 = count_table_tbody_tr2 + 1;
var base_url2 = "<?php echo base_url(); ?>";
      $.ajax({
          url: base_url2 +'/Production/getTableworkshopRow/',
          type: 'post',
          dataType: 'json',
          
          success :function() {
            
              
               var html2 = '<tr id="row2_'+row_id2+'">'+
                  
                   '<td>'+            
                   '<textarea rows="4" cols="50" style="resize : none" type="text" name="Note[]" id="Note_'+row_id2+'" class="form-control" ></textarea>'+            
                   '</td>'+            
           
                    '<td><button type="button" class="btn btn-default" onclick="removeRow2(\''+row_id2+'\')"><i class="fa fa-close"></i></button></td>'+
                    '</tr>';

                if(count_table_tbody_tr2 >= 1) {
                $("#Action_info_table tbody tr:last").after(html2); 
                
              }
              else {
                $("#Action_info_table tbody").html(html2);
              }

              $(".Action").select2();

          }
        });
         

      return false;
    });

  } // /document
  
  
  function addfiles()
  {
     var idc = $("#ID").val(); 
     var base_url2 = "<?php echo base_url(); ?>";
     var url =  base_url2+'customer/addfile/'+ idc;
     
     window.open(url);
     
     
  }
function removeRow2(tr_id)
  {
    $("#Action_info_table tbody tr#row2_"+tr_id).remove();

  }

</script>
