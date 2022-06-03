

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
       <body onload="signatureCapture(); signatureCapture1(); signatureCapture2()";>
     <script src="<?php echo base_url('assets/plugins/signature/signature.js') ?>"></script>
      <script src="<?php echo base_url('assets/plugins/dist/js/bootstrap-colorpicker.js') ?>"></script>
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
            <h3 class="box-title">Add Design</h3>
          </div>
          <!-- /.box-header -->
          <form role="form" action="<?php base_url('users/create') ?>" method="post" enctype="multipart/form-data">
              <div class="box-body">

                <?php echo validation_errors(); ?>

                <div class="form-group">

                  <div class="form-group">
                 
                      <img id="imagepreview"  width="200" height="200" class="img-Thumbnail">
               
                </div>

                <div class="form-group">
                  <label for="Design_image">Update Image</label>
                  <div class="kv-avatar">
                      <div class="file-loading">
                          <input id="Design_image" name="Design_image[]" type="file" multiple>
                      </div>
                  </div>
                </div>
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
                  
                       
    
                          <td><input type="text" class="form-control"  id="color_1" name="color[]" placeholder="Enter Panton Number" autocomplete="off" /></td>
                          <td><input type="text" class="form-control"  id="color_2" name="color[]" placeholder="Enter Panton Number" autocomplete="off" /></td>
                          <td><input type="text" class="form-control"  id="color_3" name="color[]" placeholder="Enter Panton Number"autocomplete="off" /></td>
                          <td><input type="text" class="form-control"  id="color_4" name="color[]" placeholder="Enter Panton Number" autocomplete="off" /></td>
                          <td><input type="text" class="form-control"  id="color_5" name="color[]" placeholder="Enter Panton Number" autocomplete="off" /></td>
                          <td><input type="text" class="form-control"  id="color_6" name="color[]" placeholder="Enter Panton Number" autocomplete="off" /></td>
                          <td><input type="text" class="form-control"  id="color_7" name="color[]" placeholder="Enter Panton Number" autocomplete="off" /></td>
                          <td><input type="text" class="form-control"  id="color_8" name="color[]" placeholder="Enter Panton Number" autocomplete="off" /></td>
                          
                              </tr>
                   
                     
                        
                   </tbody>
                </table>
              
                  
        </div>
                     <div class="form-group">
                  <label for="Number">Design Number /رقم الديزاين</label>
                  <input type="text" class="form-control" id="Number" name="Number" placeholder="Enter Number" value=""autocomplete="off" />
                </div>
                   <div class="form-group">
                  <label for="Designer_name">Designer name/ إسم المصمم</label>
                  <select class="form-control" id="Designer_name" name="Designer_name" >
              <option value="Mr. Hassan">Mr. Hassan</option>
              <option value="Mrs. Rim">Mrs. Rim</option>
              
            </select>
                    </div>
                  
                <div class="form-group">
                  <label for="Design_approval">Approval Name/إسم الشخص الموافق </label>
                   <select class="form-control" id="Design_approval" name="Design_approval" >
              <option value="Mr. Jamal">Mr. Jamal</option>
              <option value="Mr. Muhammed">Mr. Muhammed</option>
              <option value="Mr. Saad">Mr. Saad</option>
              <option value="Istoc">Istoc</option>
              
            </select>
                      </div>
                    <div class="form-group">
                  <label for="qty">Film Qty/عدد الافلام </label>
                  <input type="text" class="form-control" id="qty" name="qty" placeholder="Enter Qty" value="" autocomplete="off" />
                </div>
                   <div class="form-group">
                  <label for="description">Description/ وصف أصناف الفلم</label>
                  <input type="text" class="form-control" id="description" name="description" placeholder="Enter Description" value="" autocomplete="off" />
                </div>
                   <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    
    
  
     
    
 

                  <label for="C_date">Film Sending Date/تاريخ إرسال الفلم </label>
                     <div class="form-group">
                  
                  <input type="date" class="datepicker-days" id="C_date"  name="C_date"  value=""autocomplete="off" />
                </div>
                   <label for="Rec_date">Receiving Films Date/تاريخ إستلام الفلم </label>
                  <div class="form-group">
                 
                  <input type="date" class="datepicker-days" id="Rec_date"  name="Rec_date"  value=""autocomplete="off" />
                </div>
                   
                  
                  <div class="form-group">
                  <label for="Tray">Tray Number/رقم الدرج</label>
                  <input type="text" class="form-control" id="Tray" name="Tray" placeholder="Enter Tray Number" value="" autocomplete="off" />
                  <input type="hidden" class="form-control" id="image1" value=""name="image1" placeholder="Enter Tray Number"  autocomplete="off" />
                  <input type="hidden" class="form-control" id="image2" value="" name="image2" placeholder="Enter Tray Number"  autocomplete="off" />
                 <input type="hidden" class="form-control" id="image3" value=""name="image3" placeholder="Enter Tray Number"  autocomplete="off" />
                 
                  </div>
                  
                    <div class="form-group">
                  <label for="printed">Printed in/ طبع في</label>
                  <div>
                  <select class="form-control select_group" id="printed" name="printed" >
                    
                      <option value="1">At Factory/في المعمل</option>
                      <option value="2">Outside Factory/ خارج المعمل</option>
                 
                  </select>
                      </div>
                  </div>

             </div>
              <!-- /.box-body -->
    </div>
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
    <img id="saveSignature" src=""  alt="Saved image png"style="float: right;"/>
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
                  <input type="text" class="form-control" id="Sticker_approval" name="Sticker_approval" placeholder="Enter Sticker_approval Person" value="" autocomplete="off" />
                </div>
                    <div class="form-group">
                         <label for="newSignature1">Sticker Supervisor Signature/ إمضاء مسؤول الستيكر  مع التاريخ</label>
   
   <img id="saveSignature1"  src=""   alt="Saved image png"style="float: right;"/>
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
   <img id="saveSignature2" src=""  alt="Saved image png"style="float: right;"/>
    <div id="canvas">
      <canvas class="roundCorners" id="newSignature2"
      style="position: relative; margin: 0; padding: 0; border: 1px solid #c4caac;"></canvas>
    </div>
          
    
    
         <div >
    <button type="button" onclick="signatureSave2()">Save signature</button>
    <button type="button" onclick="signatureClear2()">Clear signature</button>
        </div>
    </div> /.row -->
    

  </section>
  <!-- /.content -->
</div>
<!-- /.content-wrapper -->

<script type="text/javascript">
    
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

        x = e.changedTouches[0].pageX - offsetx;
        y = e.changedTouches[0].pageY - offsety;
      } else if (e.layerX || 0 == e.layerX) {
        x = e.layerX;
        y = e.layerY;
      } else if (e.offsetX || 0 == e.offsetX) {
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

        x = e.changedTouches[0].pageX - offsetx;
        y = e.changedTouches[0].pageY - offsety;
      } else if (e.layerX || 0 == e.layerX) {
        x = e.layerX;
        y = e.layerY;
      } else if (e.offsetX || 0 == e.offsetX) {
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
        var offsety = canvas.offsetTop || 0;
        var offsetx = canvas.offsetLeft || 0;

        x = e.changedTouches[0].pageX - offsetx;
        y = e.changedTouches[0].pageY - offsety;
      } else if (e.layerX || 0 == e.layerX) {
        x = e.layerX;
        y = e.layerY;
      } else if (e.offsetX || 0 == e.offsetX) {
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
  var context = canvas.getContext("2d");
  context.clearRect(0, 0, canvas1.width, canvas1.height);
}
function signatureClear2() {
   var canvas2 = document.getElementById("newSignature2");
  var context = canvas.getContext("2d");
  context.clearRect(0, 0, canvas2.width, canvas2.height);
}
  $(document).ready(function() {
    $(".select_group").select2();
   

    $("#mainDesignNav").addClass('active');
    $("#addDesignNav").addClass('active');
    
    var btnCust = '<button type="button" class="btn btn-secondary" title="Add picture tags" ' + 
        'onclick="alert(\'Call your custom code here.\')">' +
        '<i class="glyphicon glyphicon-tag"></i>' +
        '</button>'; 
window.addEventListener("paste", e => {
        if (e.clipboardData.files.length > 0)
        {const fileInput = document.querySelector("#Design_image");
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
        layoutTemplates: {main2: '{preview} ' +  btnCust + ' {remove} {browse}'},
        allowedFileExtensions: ["jpg", "png", "gif", "jpeg"]
    });

  });
</script>