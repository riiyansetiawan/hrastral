<?php $system = $this->Umb_model->read_setting_info(1);?>
<?php $perusahaan = $this->Umb_model->read_info_setting_perusahaan(1);?>
<?php $site_lang = $this->load->helper('language');?>
<?php $wz_lang = $site_lang->session->userdata('site_lang');?>
<?php $favicon = base_url().'uploads/logo/favicon/'.$perusahaan[0]->favicon;?>
<?php
$session = $this->session->userdata('username');
if(!empty($session)){ 
	redirect('admin/dashboard/');
}
?>
<?php
$session = $this->session->userdata('username');
if(empty($wz_lang)):
	$flg_icn = '<img src="'.base_url().'uploads/languages_flag/gb.gif">';
elseif($wz_lang == 'english'):
	$lang_code = $this->Umb_model->get_info_language($wz_lang);
	$flg_icn = $lang_code[0]->language_flag;
	$flg_icn = '<img src="'.base_url().'uploads/languages_flag/'.$flg_icn.'">';
else:
	$lang_code = $this->Umb_model->get_info_language($wz_lang);
	$flg_icn = $lang_code[0]->language_flag;
	$flg_icn = '<img src="'.base_url().'uploads/languages_flag/'.$flg_icn.'">';
endif;
if($system[0]->enable_auth_background!='yes'):
	$auth_bg = 'style="background-image: none;"';
else:
	$auth_bg = '';	
endif;
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title><?php echo $title; ?></title>
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <link rel="icon" type="image/x-icon" href="<?php echo $favicon;?>">
  <link href="https://fonts.googleapis.com/css?family=Roboto:300,300i,400,400i,500,500i,700,700i,900" rel="stylesheet">
  <!-- Icon fonts -->
  <link rel="stylesheet" href="<?php echo base_url();?>skin/hrastral_vendor/assets/vendor/fonts/fontawesome.css">
  <link rel="stylesheet" href="<?php echo base_url();?>skin/hrastral_vendor/assets/vendor/fonts/ionicons.css">
  <link rel="stylesheet" href="<?php echo base_url();?>skin/hrastral_vendor/assets/vendor/fonts/linearicons.css">
  <link rel="stylesheet" href="<?php echo base_url();?>skin/hrastral_vendor/assets/vendor/fonts/open-iconic.css">
  <link rel="stylesheet" href="<?php echo base_url();?>skin/hrastral_vendor/assets/vendor/fonts/pe-icon-7-stroke.css">
  <!-- Core stylesheets -->
  <link rel="stylesheet" href="<?php echo base_url();?>skin/hrastral_vendor/assets/vendor/css/rtl/bootstrap.css" class="theme-settings-bootstrap-css">
  <link rel="stylesheet" href="<?php echo base_url();?>skin/hrastral_vendor/assets/vendor/css/rtl/appwork.css" class="theme-settings-appwork-css">
  <link rel="stylesheet" href="<?php echo base_url();?>skin/hrastral_vendor/assets/vendor/css/rtl/theme-corporate.css" class="theme-settings-theme-css">
  <link rel="stylesheet" href="<?php echo base_url();?>skin/hrastral_vendor/assets/vendor/css/rtl/colors.css" class="theme-settings-colors-css">
  <link rel="stylesheet" href="<?php echo base_url();?>skin/hrastral_vendor/assets/vendor/css/rtl/uikit.css">
  <link rel="stylesheet" href="<?php echo base_url();?>skin/hrastral_vendor/assets/css/demo.css">
  <script src="<?php echo base_url();?>skin/hrastral_vendor/assets/vendor/js/material-ripple.js"></script>
  <script src="<?php echo base_url();?>skin/hrastral_vendor/assets/vendor/js/layout-helpers.js"></script>
  <!-- Theme settings-->
  <script src="<?php echo base_url();?>skin/hrastral_vendor/assets/vendor/js/theme-settings.js"></script>
  <script>
    window.themeSettings = new ThemeSettings({
      cssPath: '<?php echo base_url();?>skin/hrastral_vendor/assets/vendor/css/rtl/',
      themesPath: '<?php echo base_url();?>skin/hrastral_vendor/assets/vendor/css/rtl/'
    });
  </script>
  <!-- Core scripts -->
  <script src="<?php echo base_url();?>skin/hrastral_vendor/assets/vendor/js/pace.js"></script>
  <script src="<?php echo base_url();?>skin/hrastral_vendor/assets/vendor/js/jquery.min.js"></script>
  <!-- Libs -->
  <link rel="stylesheet" href="<?php echo base_url();?>skin/hrastral_vendor/assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.css">
  <!-- Page -->
  <link rel="stylesheet" href="<?php echo base_url();?>skin/hrastral_vendor/assets/vendor/css/pages/authentication.css">
  <link rel="stylesheet" href="<?php echo base_url();?>skin/hrastral_vendor/assets/vendor/toastr/toastr.min.css">
  <link media="all" type="text/css" rel="stylesheet" href="<?php echo base_url();?>skin/hrastral_vendor/assets/css/animate.css">
</head>
<body>
  <div class="authentication-wrapper authentication-1 px-4">
    <div class="authentication-inner py-5"> 
      <!-- Logo -->
      <div class="d-flex justify-content-center align-items-center">
        <div class="position-relative">
          <div class="p-1"><img src="<?php echo base_url();?>uploads/logo/signin/<?php echo $perusahaan[0]->sign_in_logo;?>" alt="logo HRASTRAL">
          </div>
        </div>
      </div>
      <!-- / Logo --> 
      <!-- Form -->
      <?php $attributes = array('class' => 'form-hrastral my-5', 'name' => 'hrm-form', 'id' => 'hrm-form', 'data-redirect' => 'dashboard',
      'data-form-table' => 'login', 'data-is-redirect' => '1', 'autocomplete' => 'off');?>
      <?php $hidden = array('user_id' => 0);?>
      <?php echo form_open('admin/auth/login_pincode', $attributes, $hidden);?>
      <div class="form-group">
        <label class="form-label d-flex justify-content-between align-items-end">
          <div><?php echo $this->lang->line('umb_pincode');?></div>
          <a href="<?php echo site_url('admin/auth/forgot_password');?>" class="d-block small"><?php echo $this->lang->line('umb_link_forgot_password');?></a>
        </label>
        <input type="password" class="form-control" id="ipincode" name="ipincode" placeholder="<?php echo $this->lang->line('umb_enter_pincode');?>">
      </div>
      <div class="d-flex justify-content-between align-items-center m-0">
        <label class="custom-control custom-checkbox m-0"> &nbsp; </label>
        <?php echo form_button(array('name' => 'hrastral_form', 'type' => 'submit', 'class' => 'btn btn-primary save mr-2', 'content' => '<i class="saveinfo fas fa-user-lock d-blockd"></i> '.$this->lang->line('umb_login'))); ?> 
      </div>
      <?php echo form_close(); ?> 
      <!-- / Form -->
      <div class="text-center text-muted">
        <?php if($system[0]->enable_current_year=='yes'):?>
          <?php echo date('Y');?>
        <?php endif;?>
        © <?php echo $system[0]->footer_text;?> 
      </div>
    </div>
  </div>

  <!-- Core scripts --> 
  <script src="<?php echo base_url();?>skin/hrastral_vendor/assets/vendor/libs/popper/popper.js"></script>
  <script src="<?php echo base_url();?>skin/hrastral_vendor/assets/vendor/js/bootstrap.js"></script> 
  <script src="<?php echo base_url();?>skin/hrastral_vendor/assets/vendor/js/sidenav.js"></script> 
  <!-- Libs --> 
  <script src="<?php echo base_url();?>skin/hrastral_vendor/assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.js"></script> 
  <!-- Demo --> 
  <script src="<?php echo base_url();?>skin/hrastral_vendor/assets/js/demo.js"></script> 
  <script type="text/javascript" src="<?php echo base_url();?>skin/hrastral_assets/vendor/jquery/jquery-3.2.1.min.js"></script> 
  <script type="text/javascript" src="<?php echo base_url();?>skin/hrastral_vendor/assets/vendor/toastr/toastr.min.js"></script> 
  <link rel="stylesheet" href="<?php echo base_url();?>skin/hrastral_vendor/assets/vendor/libs/ladda/ladda.css">
  <script src="<?php echo base_url();?>skin/hrastral_vendor/assets/vendor/libs/spin/spin.js"></script>
  <script src="<?php echo base_url();?>skin/hrastral_vendor/assets/vendor/libs/ladda/ladda.js"></script> 
  <script type="text/javascript">
    $(document).ready(function(){
      Ladda.bind('button[type=submit]');
      toastr.options.closeButton = <?php echo $system[0]->notification_close_btn;?>;
      toastr.options.progressBar = <?php echo $system[0]->notification_bar;?>;
      toastr.options.timeOut = 3000;
      toastr.options.preventDuplicates = true;
      toastr.options.positionClass = "<?php echo $system[0]->notification_position;?>";
      var site_url = '<?php echo site_url(); ?>';
    });
  </script> 
  <script type="text/javascript">
    var site_url = '<?php echo base_url(); ?>';
    var processing_request = '<?php echo $this->lang->line('umb_permiuntaan_sedang_diproses');?>';
  </script> 
  <script type="text/javascript" src="<?php echo base_url();?>skin/hrastral_vendor/hrastral_scripts/umb_login.js"></script> 
  <script type="text/javascript">
    $(document).ready(function(){
      $(".login-as").click(function(){
        var uname = jQuery(this).data('username');
        var password = jQuery(this).data('password');
        jQuery('#iusername').val(uname);
        jQuery('#ipassword').val(password);
      });
    });	
  </script>
</body>
</html>