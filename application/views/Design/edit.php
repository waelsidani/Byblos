<?php declare(strict_types=1) ?>

 <body onload="signatureCapture(); signatureCapture1(); signatureCapture2()";>
     <script src="<?php echo base_url('assets/plugins/signature/signature.js') ?>"></script>
      <script src="<?php echo base_url('assets/plugins/dist/js/bootstrap-colorpicker.js') ?>"></script>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      Manage
      <small>Design</small>
    </h1>
    <ol class="breadcrumb">
      <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
      <li class="active">Design</li>
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
            <h3 class="box-title">Edit Design</h3>
            </div>
            
          <!-- /.box-header -->
          <form role="form" action="<?php base_url('users/update') ?>" method="post" enctype="multipart/form-data">
              <div class="box-body">

                <?php echo validation_errors(); ?>
                  
<?php 

        
        if (json_decode($Design_data['image']) == 0||json_decode($Design_data['image']) == '')
        {$images[0] =  "assets/images/designs/Byblos.gif";}
        else
        {$images = json_decode($Design_data['image']);}
        ?>
                  
                  <div class="box">
            <h3 class="box-title"> Print ID</h3>
            <b><input type="text" readonly style="width:80px" class="form-control" id="Design_printing" name="Design_printing" value="<?php echo $Design_data['paint_id']; ?>" autocomplete="off" />
              </b>  
          </div>
                <div class="form-group">
                    <input type="hidden"  class="form-control" id="Image_M" name="Image_M" value='<?php  echo $Design_data['image']; ?>' autocomplete="off" />
             
                  <?php foreach ($images as $k => $v): ?>
                                <img src="<?php echo base_url() . $v ?>" width="200" height="200" class="img-Thumbnail">
                <?php endforeach ?>
                  
                </div>
   
                <div class="form-group">
                  <label for="Design_image">Update Image</label>
                  <div class="kv-avatar">
                      <div class="file-loading">
                          <input id="Design_image" name="Design_image[]" type="file" multiple>
                        
                      </div>
                  </div>
                </div>
                  <label>Change Image/تغير الصورة</label>
                  <input type="checkbox" name="change_image" id="change_image"  />
<script>document.getElementById('change_image').onchange = function()
                   {if (this.checked) 
            {
                        $("#image").val("0");
                        document.getElementById('change_image').disabled="true";
                    }}
</script>
   <div class="form-group">
                   <table class="table table-bordereded" id="Action_info_table">
                  <thead>
                      <tr><th style=" font-size: 20px ">Colors</th></tr>
                    <tr>
                      
                      <th style="width:12.5%">Color Number /رقم اللون</th>
                      
                      <th style="width:12.5%">Color Number /رقم اللون</th>
                     
                      <th style="width:12.5%">Color Number /رقم اللون</th>
                     
                      <th style="width:12.5%">Color Number /رقم اللون</th>
                     
                     <th style="width:12.5%">Color Number /رقم اللون</th>
                     
                      <th style="width:12.5%">Color Number /رقم اللون</th>
                      
                    <th style="width:12.5%">Color Number /رقم اللون</th>
                    
                     <th style="width:12.5%">Color Number /رقم اللون</th>
                       </tr>
                  </thead>

                   <tbody>
                    <tr>
                  <?php   $color1 = json_decode($Design_data['color1']);?>
                       
    
                          <td><input type="text" class="form-control"  id="color1" name="color1" placeholder="Enter Panton Number" value="<?php echo $color1[0] ?> "autocomplete="off" /></td>
                          <td><input type="text" class="form-control"  id="color2" name="color2" placeholder="Enter Panton Number" value="<?php echo $color1[1] ?> "autocomplete="off" /></td>
                          <td><input type="text" class="form-control"  id="color3" name="color3" placeholder="Enter Panton Number" value="<?php echo $color1[2] ?> "autocomplete="off" /></td>
                          <td><input type="text" class="form-control"  id="color4" name="color4" placeholder="Enter Panton Number" value="<?php echo $color1[3]?> "autocomplete="off" /></td>
                          <td><input type="text" class="form-control"  id="color5" name="color5" placeholder="Enter Panton Number" value="<?php echo $color1[4]?> "autocomplete="off" /></td>
                          <td><input type="text" class="form-control"  id="color6" name="color6" placeholder="Enter Panton Number" value="<?php echo $color1[5] ?> "autocomplete="off" /></td>
                          <td><input type="text" class="form-control"  id="color7" name="color7" placeholder="Enter Panton Number" value="<?php echo $color1[6] ?> "autocomplete="off" /></td>
                          <td><input type="text" class="form-control"  id="color8" name="color8" placeholder="Enter Panton Number" value="<?php echo $color1[7] ?> "autocomplete="off" /></td>
                          
                              </tr>
                   
                     
                        
                   </tbody>
                </table>
              
                  
        </div>

   
               <div class="form-group">
                  <label for="Number">Design Number /رقم الديزاين</label>
                  <input type="text" class="form-control" id="Number" name="Number" placeholder="Enter Number" value="<?php echo $Design_data['Number']; ?> "autocomplete="off" />
                </div>
                   <div class="form-group">
                  <label for="Designer_name">Designer name/ إسم المصمم</label>
                  <input type="text" class="form-control" id="Designer_name" name="Designer_name" placeholder="Enter Designer name" value="<?php echo $Design_data['name']; ?>"  autocomplete="off"/>
                </div>
                  
                <div class="form-group">
                  <label for="Design_approval">Approval Name/إسم الشخص الموافق </label>
                  <input type="text" class="form-control" id="Design_approval" name="Design_approval" placeholder="Enter Design_approval Person" value="<?php echo $Design_data['Design_approval']; ?>" autocomplete="off" />
                </div>
                   <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    
                  <label for="C_date">Film Sending Date/تاريخ إرسال الفلم </label>
                     <div class="form-group">
                  
                  <input type="date" class="datepicker-days" id="C_date"  name="C_date"  value="<?php echo $Design_data['C_date']; ?>"autocomplete="off" />
                </div>
                   <label for="Rec_date">Receiving Films Date/تاريخ إستلام الفلم </label>
                  <div class="form-group">
                 
                  <input type="date" class="datepicker-days" id="Rec_date"  name="Rec_date"  value="<?php echo $Design_data['Rec_date']; ?>"autocomplete="off" />
                </div>
                   
                  
                  <div class="form-group">
                  <label for="Tray">Tray Number/رقم الدرج</label>
                  <input type="text" class="form-control" id="Tray" name="Tray" placeholder="Enter Tray Number" value="<?php echo $Design_data['Tray']; ?>" autocomplete="off" />
                  <input type="hidden" class="form-control" id="image1" value="<?php echo $Design_data['image1'];?>"name="image1" placeholder="Enter Tray Number"  autocomplete="off" />
                  <input type="hidden" class="form-control" id="image2" value="<?php echo $Design_data['image2'];?>" name="image2" placeholder="Enter Tray Number"  autocomplete="off" />
                 <input type="hidden" class="form-control" id="image3" value="<?php echo $Design_data['image3'];?>"name="image3" placeholder="Enter Tray Number"  autocomplete="off" />
                 <input type="hidden" class="form-control" id="image" value="<?php if (json_decode($Design_data['image'])!= "") { echo 1;} else {echo 0;}?>"name="image" placeholder="Enter Tray Number"  autocomplete="off" />
                 
                  </div>
                  <div class="form-group">
                  <label for="qty">Film Qty/عدد الافلام </label>
                  <input type="text" class="form-control" id="qty" name="qty" placeholder="Enter Qty" value="<?php echo $Design_data['qty']; ?>" autocomplete="off" />
                </div>
                   <div class="form-group">
                  <label for="description">Description/ وصف أصناف الفلم</label>
                  <input type="text" class="form-control" id="description" name="description" placeholder="Enter Description" value="<?php echo $Design_data['description']; ?>" autocomplete="off" />
                </div>
                    <div class="form-group">
                  <label for="printed">Printed in/ طبع في</label>
                  <div>
                  <select class="form-control select_group" id="printed" name="printed" <?php echo $Design_data?>>
                    
                      <option value="1">At Factory/في المعمل</option>
                      <option value="2">Outside Factory/ خارج المعمل</option>
                 
                  </select>
                      </div>
                  </div>

             </div>
              <!-- /.box-body -->

              <div class="box-footer">
                <button type="submit" class="btn btn-primary">Save Changes/حفظ</button>
                <a href="<?php echo base_url('Design/') ?>" class="btn btn-warning">Back/ الرجوع</a>
              </div>
            </form>
          <!-- /.box-body -->
        </div>
        <!-- /.box -->
      </div>
      <!-- col-md-12 -->
    </div>
    <!--                    <div class="form-group">
                       <label for="newSignature">Designer Signature/ إمضاء المصمم مع التاريخ</label>
    <img id="saveSignature" src="<?php echo $Design_data['image1'];?>"  alt="Saved image png"style="float: right;"/>
                       <div id="canvas">
      <canvas class="roundCorners" id="newSignature"
      style="position: relative; margin: 0; padding: 0; border: 1px solid #c4caac;"></canvas>
    </div>
          <span>
             
    
    </span>
         <div >
    <button type="button" onclick="signatureSave()">Save signature</button>
    <button type="button" onclick="signatureClear()">Clear signature</button>
        </div>
    </div>
                <div class="form-group">
                  <label for="Sticker_approval">Sticker Approval Person Name/إسم مسؤول لصق الستيكر </label>
                  <input type="text" class="form-control" id="Sticker_approval" name="Sticker_approval" placeholder="Enter Sticker_approval Person" value="<?php echo $Design_data['Sticker_approval']; ?>" autocomplete="off" />
                </div>
                    <div class="form-group">
                         <label for="newSignature1">Sticker Supervisor Signature/ إمضاء مسؤول الستيكر  مع التاريخ</label>
   
   <img id="saveSignature1"  src="<?php echo $Design_data['image2'];?>"   alt="Saved image png"style="float: right;"/>
    <div id="canvas1">
      <canvas class="roundCorners" id="newSignature1"
      style="position: relative; margin: 0; padding: 0; border: 1px solid #c4caac;"></canvas>
    </div>
          <span>
    
    </span>
         <div >
    <button type="button" onclick="signatureSave1()">Save signature</button>
    <button type="button" onclick="signatureClear1()">Clear signature</button>
        </div>
    </div>
                    <div class="form-group">
  <label for="newSignature2">Printing Supervisor Signature/ إمضاء مسؤول الطباعة مع التاريخ</label>
   <img id="saveSignature2" src="<?php echo $Design_data['image3'];?>"  alt="Saved image png"style="float: right;"/>
    <div id="canvas">
      <canvas class="roundCorners" id="newSignature2"
      style="position: relative; margin: 0; padding: 0; border: 1px solid #c4caac;"></canvas>
    </div>
          
    
    
         <div >
    <button type="button" onclick="signatureSave2()">Save signature</button>
    <button type="button" onclick="signatureClear2()">Clear signature</button>
        </div>
    </div>/.row -->
    

  </section>
  <!-- /.content -->
</div>
<!-- /.content-wrapper -->

<script type="text/javascript" >
      function signatureCapture2() {
  var canvas = document.getElementById("newSignature2");
    var context = canvas.getContext("2d");
  canvas.width = 276;
  canvas.height = 180;
  context.fillStyle = "#fff";
  context.strokeStyle = "#444";
  context.lineWidth = 1.5;
  context.lineCap = "round";
  context.fillRect(0, 0, canvas.width, canvas.height);
  var disableSave = true;
  var pixels = [];
  var cpixels = [];
  var xyLast = {};
  var xyAddLast = {};
  var calculate = false;
  {   //functions
    function remove_event_listeners() {
      canvas.removeEventListener('mousemove', on_mousemove, false);
      canvas.removeEventListener('mouseup', on_mouseup, false);
      canvas.removeEventListener('touchmove', on_mousemove, false);
      canvas.removeEventListener('touchend', on_mouseup, false);

      document.body.removeEventListener('mouseup', on_mouseup, false);
      document.body.removeEventListener('touchend', on_mouseup, false);
    }

    function get_coords(e) {
      var x, y;

      if (e.changedTouches && e.changedTouches[0]) {
        var offsety = canvas.offsetTop || 0;
        var offsetx = canvas.offsetLeft || 0;

        x = e.changedTouches[0].pageX - offsetx - 220 ;
        y = e.changedTouches[0].pageY - offsety - 100;
      } else if (e.layerX || 0 === e.layerX) {
        x = e.layerX;
        y = e.layerY ;
      } else if (e.offsetX || 0 === e.offsetX) {
        x = e.offsetX;
        y = e.offsetY;
      }

      return {
        x : x, y : y
      };
    };

    function on_mousedown(e) {
      e.preventDefault();
      e.stopPropagation();

      canvas.addEventListener('mouseup', on_mouseup, false);
      canvas.addEventListener('mousemove', on_mousemove, false);
      canvas.addEventListener('touchend', on_mouseup, false);
      canvas.addEventListener('touchmove', on_mousemove, false);
      document.body.addEventListener('mouseup', on_mouseup, false);
      document.body.addEventListener('touchend', on_mouseup, false);

      empty = false;
      var xy = get_coords(e);
      context.beginPath();
      pixels.push('moveStart');
      context.moveTo(xy.x, xy.y);
      pixels.push(xy.x, xy.y);
      xyLast = xy;
    };

    function on_mousemove(e, finish) {
      e.preventDefault();
      e.stopPropagation();

      var xy = get_coords(e);
      var xyAdd = {
        x : (xyLast.x + xy.x ) / 2 ,
        y : (xyLast.y + xy.y) / 2
      };

      if (calculate) {
        var xLast = (xyAddLast.x + xyLast.x + xyAdd.x ) / 3;
        var yLast = (xyAddLast.y + xyLast.y + xyAdd.y) / 3;
        pixels.push(xLast, yLast);
      } else {
        calculate = true;
      }

      context.quadraticCurveTo(xyLast.x, xyLast.y, xyAdd.x, xyAdd.y);
      pixels.push(xyAdd.x, xyAdd.y);
      context.stroke();
      context.beginPath();
      context.moveTo(xyAdd.x, xyAdd.y);
      xyAddLast = xyAdd;
      xyLast = xy;

    };

    function on_mouseup(e) {
      remove_event_listeners();
      disableSave = false;
      context.stroke();
      pixels.push('e');
      calculate = false;
    };
  }
  canvas.addEventListener('touchstart', on_mousedown, false);
  canvas.addEventListener('mousedown', on_mousedown, false);
}  
 function signatureCapture1() {
  var canvas = document.getElementById("newSignature1");
    var context = canvas.getContext("2d");
  canvas.width = 276;
  canvas.height = 180;
  context.fillStyle = "#fff";
  context.strokeStyle = "#444";
  context.lineWidth = 1.5;
  context.lineCap = "round";
  context.fillRect(0, 0, canvas.width, canvas.height);
  var disableSave = true;
  var pixels = [];
  var cpixels = [];
  var xyLast = {};
  var xyAddLast = {};
  var calculate = false;
  {   //functions
    function remove_event_listeners() {
      canvas.removeEventListener('mousemove', on_mousemove, false);
      canvas.removeEventListener('mouseup', on_mouseup, false);
      canvas.removeEventListener('touchmove', on_mousemove, false);
      canvas.removeEventListener('touchend', on_mouseup, false);

      document.body.removeEventListener('mouseup', on_mouseup, false);
      document.body.removeEventListener('touchend', on_mouseup, false);
    }

    function get_coords(e) {
      var x, y;

      if (e.changedTouches && e.changedTouches[0]) {
        var offsety = canvas.offsetTop || 0;
        var offsetx = canvas.offsetLeft || 0;

        x = e.changedTouches[0].pageX -offsetx - 220;
        y = e.changedTouches[0].pageY - offsety - 100 ;
      } else if (e.layerX || 0 === e.layerX) {
        x = e.layerX;
        y = e.layerY;
      } else if (e.offsetX || 0 === e.offsetX) {
        x = e.offsetX;
        y = e.offsetY;
      }

      return {
        x : x, y : y
      };
    };

    function on_mousedown(e) {
      e.preventDefault();
      e.stopPropagation();

      canvas.addEventListener('mouseup', on_mouseup, false);
      canvas.addEventListener('mousemove', on_mousemove, false);
      canvas.addEventListener('touchend', on_mouseup, false);
      canvas.addEventListener('touchmove', on_mousemove, false);
      document.body.addEventListener('mouseup', on_mouseup, false);
      document.body.addEventListener('touchend', on_mouseup, false);

      empty = false;
      var xy = get_coords(e);
      context.beginPath();
      pixels.push('moveStart');
      context.moveTo(xy.x  , xy.y );
      pixels.push(xy.x, xy.y);
      xyLast = xy;
    };

    function on_mousemove(e, finish) {
      e.preventDefault();
      e.stopPropagation();

      var xy = get_coords(e);
      var xyAdd = {
        x : (xyLast.x + xy.x) / 2,
        y : (xyLast.y + xy.y) / 2
      };

      if (calculate) {
        var xLast = (xyAddLast.x + xyLast.x + xyAdd.x) / 3;
        var yLast = (xyAddLast.y + xyLast.y + xyAdd.y) / 3;
        pixels.push(xLast, yLast);
      } else {
        calculate = true;
      }

      context.quadraticCurveTo(xyLast.x, xyLast.y, xyAdd.x, xyAdd.y);
      pixels.push(xyAdd.x, xyAdd.y);
      context.stroke();
      context.beginPath();
      context.moveTo(xyAdd.x, xyAdd.y);
      xyAddLast = xyAdd;
      xyLast = xy;

    };

    function on_mouseup(e) {
      remove_event_listeners();
      disableSave = false;
      context.stroke();
      pixels.push('e');
      calculate = false;
    };
  }
  canvas.addEventListener('touchstart', on_mousedown, false);
  canvas.addEventListener('mousedown', on_mousedown, false);
}
    
 function signatureCapture() {
  var canvas = document.getElementById("newSignature");
    var context = canvas.getContext("2d");
  canvas.width = 276;
  canvas.height = 180;
  context.fillStyle = "#fff";
  context.strokeStyle = "#444";
  context.lineWidth = 1.5;
  context.lineCap = "round";
  context.fillRect(0, 0, canvas.width, canvas.height);
  var disableSave = true;
  var pixels = [];
  var cpixels = [];
  var xyLast = {};
  var xyAddLast = {};
  var calculate = false;
  {   //functions
    function remove_event_listeners() {
      canvas.removeEventListener('mousemove', on_mousemove, false);
      canvas.removeEventListener('mouseup', on_mouseup, false);
      canvas.removeEventListener('touchmove', on_mousemove, false);
      canvas.removeEventListener('touchend', on_mouseup, false);

      document.body.removeEventListener('mouseup', on_mouseup, false);
      document.body.removeEventListener('touchend', on_mouseup, false);
    }

    function get_coords(e) {
      var x, y;

      if (e.changedTouches && e.changedTouches[0]) {
        var offsety =  canvas.offsetTop || 0;
        var offsetx =  canvas.offsetLeft  || 0;

        x = e.changedTouches[0].pageX - offsetx - 220;
        y = e.changedTouches[0].pageY - offsety - 100;
      } else if (e.layerX || 0 === e.layerX) {
        x = e.layerX;
        y = e.layerY;
      } else if (e.offsetX || 0 === e.offsetX) {
        x = e.offsetX;
        y = e.offsetY;
      }

      return {
        x : x, y : y
      };
    };

    function on_mousedown(e) {
      e.preventDefault();
      e.stopPropagation();

      canvas.addEventListener('mouseup', on_mouseup, false);
      canvas.addEventListener('mousemove', on_mousemove, false);
      canvas.addEventListener('touchend', on_mouseup, false);
      canvas.addEventListener('touchmove', on_mousemove, false);
      document.body.addEventListener('mouseup', on_mouseup, false);
      document.body.addEventListener('touchend', on_mouseup, false);

      empty = false;
      var xy = get_coords(e);
      context.beginPath();
      pixels.push('moveStart');
      context.moveTo(xy.x, xy.y);
      pixels.push(xy.x, xy.y);
      xyLast = xy;
    };

    function on_mousemove(e, finish) {
      e.preventDefault();
      e.stopPropagation();

      var xy = get_coords(e);
      var xyAdd = {
        x : (xyLast.x + xy.x)/ 2,
        y : (xyLast.y + xy.y) / 2
      };

      if (calculate) {
        var xLast = (xyAddLast.x + xyLast.x + xyAdd.x) / 3;
        var yLast = (xyAddLast.y + xyLast.y + xyAdd.y) / 3;
        pixels.push(xLast, yLast);
      } else {
        calculate = true;
      }

      context.quadraticCurveTo(xyLast.x, xyLast.y, xyAdd.x, xyAdd.y);
      pixels.push(xyAdd.x, xyAdd.y);
      context.stroke();
      context.beginPath();
      context.moveTo(xyAdd.x, xyAdd.y);
      xyAddLast = xyAdd;
      xyLast = xy;

    };

    function on_mouseup(e) {
      remove_event_listeners();
      disableSave = false;
      context.stroke();
      pixels.push('e');
      calculate = false;
    };
  }
  canvas.addEventListener('touchstart', on_mousedown, false);
  canvas.addEventListener('mousedown', on_mousedown, false);
}

function signatureSave() {
  var canvas = document.getElementById("newSignature");// save canvas image as data url (png format by default)
 
        var dataURL = canvas.toDataURL("image/png");
       
  document.getElementById("saveSignature").src = dataURL;
    document.getElementById("image1").value = dataURL;
  
};
function signatureSave1() {
   var canvas1 = document.getElementById("newSignature1");// save canvas image as data url (png format by default)

         var dataURL1 = canvas1.toDataURL("image/png");
   document.getElementById("saveSignature1").src = dataURL1;
    document.getElementById("image2").value = dataURL1;
};
function signatureSave2() {
   var canvas1 = document.getElementById("newSignature2");// save canvas image as data url (png format by default)

         var dataURL1 = canvas1.toDataURL("image/png");
   document.getElementById("saveSignature2").src = dataURL1;
    document.getElementById("image3").value = dataURL1;
};
function signatureClear() {
  var canvas = document.getElementById("newSignature");
   var context = canvas.getContext("2d");
  context.clearRect(0, 0, canvas.width, canvas.height);
}
function signatureClear1() {
   var canvas1 = document.getElementById("newSignature1");
  var context = canvas1.getContext("2d");
  context.clearRect(0, 0, canvas1.width, canvas1.height);
}
function signatureClear2() {
   var canvas2 = document.getElementById("newSignature2");
  var context = canvas2.getContext("2d");
  context.clearRect(0, 0, canvas2.width, canvas2.height);
}
  $(document).ready(function() {
    $(".select_group").select2();
   

    $("#mainDesignNav").addClass('active');
    $("#manageDesignNav").addClass('active');
    
    
    $("#Design_image").fileinput({
        overwriteInitial: true,
        maxFileSize: 1500,
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
        layoutTemplates: {main2: '{preview} {remove} {browse}'},
        allowedFileExtensions: ["jpg", "png", "gif" , "jpeg"]
    });

  });
  
  
</script>
