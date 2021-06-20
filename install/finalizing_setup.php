<?php session_start(); ?>
<?php
require_once('includes/core_class.php');

$core = new Core();
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <title>hrastral - The Ultimate HRM</title>
  <link rel="stylesheet" href="assets/css/bootstrap.min.css">
  <style type="text/css">
    body {
     font-size: 12px;
   }
   .form-control {
     height: 32px;
   }
   .error {
     background: #ffd1d1;
     border: 1px solid #ff5858;
     padding: 4px;
   }
 </style>
 <link rel="stylesheet" href="../skin/hrastral_vendor/assets/vendor/toastr/toastr.min.css">
 <link rel="stylesheet" href="../skin/hrastral_vendor/assets/vendor/libs/ladda/ladda.css">
</head>
<body style="background:linear-gradient(90deg, #000000 0%, #d3e9ff 100%);">
  <div class="container" style="margin-top:30px ">
    <div class="row">
      <div class="col-md-7 col-md-offset-5" style="margin-bottom:15px;"> <img src="../skin/img/hrastral-white.png" /> </div>
      <div class="col-md-8 col-md-offset-2">
        <div class="panel panel-primary">
          <div class="panel-heading"> <strong class="">HRASTRAL- HRM</strong> </div>
          <div class="panel-body">
            <div class="alert alert-success" role="alert">
              Selamat Instalasi Berhasil
            </div>
            <div class="alert alert-info" role="alert">Setting Nama Aplikasi anda, Username admin untuk login, email dan password.<br />
              Ingat kredensial masuk yang Anda perlukan nanti untuk masuk ke akun Anda.<br />
              Setelah langkah ini, Anda akan diarahkan ke halaman login aplikasi.
            </div>
            <hr/>
            <form class="form-horizontal" id="set_up" method="post" action="set_up.php">
              <div class="form-group">
                <label for="inputEmail3" class="col-sm-3 control-label">Nama Aplikasi</label>
                <div class="col-sm-8">
                  <input class="form-control" type="text" value="hrastral" name="application_name">
                  <span style="font-size:12px;">Nama aplikasi Anda</span>
                </div>
              </div>
              <hr>
              <div class="form-group">
                <label for="inputPassword3" class="col-sm-3 control-label">Nama Depan Superadmin</label>
                <div class="col-sm-8">
                  <input class="form-control" type="text" name="first_name">
                  <span style="font-size:12px;">Nama depan untuk Administrator</span>
                </div>
              </div>
              <hr>
              <div class="form-group">
                <label for="inputPassword3" class="col-sm-3 control-label">Nama Belakang Superadmin</label>
                <div class="col-sm-8">
                  <input class="form-control" type="text" name="last_name">
                  <span style="font-size:12px;">Nama Belakang untuk Administrator</span>
                </div>
              </div>
              <hr>
              <div class="form-group">
                <label for="inputPassword3" class="col-sm-3 control-label">Username Superadmin</label>
                <div class="col-sm-8">
                  <input class="form-control" type="text" name="username">
                  <span style="font-size:12px;">Username untuk login sebagai administrator</span>
                </div>
              </div>
              <hr>
              <div class="form-group">
                <label for="inputPassword3" class="col-sm-3 control-label">Email Superadmin</label>
                <div class="col-sm-8">
                  <input class="form-control" type="text" name="email">
                  <span style="font-size:12px;">Alamat Email untuk administrator</span>
                </div>
              </div>
              <hr>
              <div class="form-group">
                <label for="inputPassword3" class="col-sm-3 control-label">Password Superadmin</label>
                <div class="col-sm-8">
                  <input class="form-control" type="text" name="password">
                  <span style="font-size:12px;">Password Login Superadmin</span>
                </div>
              </div>
              <hr>
              <div class="form-group">
                <label for="inputPassword3" class="col-sm-3 control-label">Zona Waktu</label>
                <div class="col-sm-8">
                  <select class="form-control" name="system_timezone" data-plugin="select_hrm">
                    <?php foreach($core->all_timezones() as $tval=>$labels):?>
                      <option value="<?php echo $tval;?>" <?php if('Asia/Riyadh'==$tval):?> selected <?php endif;?>><?php echo $labels;?></option>
                    <?php endforeach;?>
                  </select>
                  <span style="font-size:12px;">Pilih system Zona Waktu</span>
                </div>
              </div>
              <hr>
              <div class="form-group last">
                <div class="col-sm-offset-3 col-sm-8">
                  <button type="submit" class="btn btn-success" id="submit">Setting Selesai</button>
                </div>
              </div>
            </form>
          </div>
          <div class="panel-footer"><?php echo date('Y');?> &copy HRASTRAL - HRM</div>
        </div>
      </div>
    </div>
  </div>
  <script src="../skin/hrastral_vendor/assets/vendor/js/jquery.min.js"></script>
  <!-- jQuery UI 1.11.4 -->
  <script src="../skin/hrastral_vendor/assets/vendor/libs/jquery-ui/jquery-ui.min.js"></script>
  <script src="../skin/hrastral_vendor/assets/vendor/libs/spin/spin.js"></script>
  <script src="../skin/hrastral_vendor/assets/vendor/libs/ladda/ladda.js"></script>
  <script src="../skin/hrastral_vendor/assets/vendor/toastr/toastr.min.js"></script> 
  <script type="text/javascript">
    $(document).ready(function(){
     toastr.options.closeButton = true;
     toastr.options.progressBar = true;
     toastr.options.timeOut = 2000;
     toastr.options.preventDuplicates = true;
     toastr.options.positionClass = "toast-top-center";
     Ladda.bind('button[type=submit]');

     $("#set_up").submit(function(e){
       e.preventDefault();
       var obj = $(this), action = obj.attr('name');
       $.ajax({
         type: "POST",
         url: e.target.action,
         data: obj.serialize()+"&is_ajax=1&type=set_up&form="+action,
         cache: false,
         success: function (JSON) {
          if (JSON.error != '') {
           toastr.error(JSON.error);
           $('input[name="csrf_hrastral"]').val(JSON.csrf_hash);
           Ladda.stopAll();
         } else {
           toastr.success(JSON.result);
           $('input[name="csrf_hrastral"]').val(JSON.csrf_hash);
           Ladda.stopAll();
           window.location = 'success.php';
         }
       }
     });
     });
   });
 </script>
</body>
</html>
