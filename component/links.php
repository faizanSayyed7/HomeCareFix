<link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
<link href="https://fonts.googleapis.com/css2?family=Merienda:wght@400;700&family=Poppins:wght@400;500;600&display=swap" rel="stylesheet">
<link rel="stylesheet" href="bootstrap-icons-1.11.3/font/bootstrap-icons.css">
<link href="vendor/swipperjs/swiper-bundle.min.css" rel="stylesheet">
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>



<?php
  session_start();
  date_default_timezone_set('Asia/Kolkata');
    
  require('admin/component/db_config.php');
  require('admin/component/essential.php');
  $contact_q = "SELECT * FROM `contact_details` WHERE `id`=?";
  $setting_q = "SELECT * FROM `settings` WHERE `id`=?";
  $values = [1];
  $contact_r = mysqli_fetch_assoc(select($contact_q,$values,"i"));
  $settings_r = mysqli_fetch_assoc(select($setting_q,$values,"i"));

  $path = LOGO_IMG_PATH;

  if($settings_r['shutdown']){
    redirect('maintainance.php');
  }

?>