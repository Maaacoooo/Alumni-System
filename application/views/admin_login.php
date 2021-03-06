<?php
/*
 * Copyright (c)2016, Jenmar "Maco" Cortes
 * Copyright TechDepot PH
 * All Rights Reserved
 * 
 * This license is a legal agreement between you and the Maco Cortes
 * for the use of ALUMNI INFORMATION SYSTEM referred to as the "Software"
 * By obtaining the Software you agree to comply with the terms and conditions of this license.
 *
 * PERMITTED USE
 * With approval from Maco Cortes, You are permitted to use the program for educational purposes only.
 * 
 * MODIFICATION AND REDISTRIBUTION 
 * Unless with written approval obtained from Maco Cortes, 
 * You are NOT allowed to modify, copy, redistribute, and sell the Software.
 *
 * For any concerns, you may reach Maco Cortes via:
 * maco.techdepot@gmail.com
 * facebook.com/Maaacoooo
 * maco@techdepot-ph.com
 * TechDepot-PH.com
 */
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0, user-scalable=no">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="msapplication-tap-highlight" content="no">
  <title>Login</title>

  <!-- Favicons-->
  <link rel="icon" href="<?=base_url()?>assets/images/favicon/favicon-32x32.png" sizes="32x32">
  <!-- Favicons-->
  <link rel="apple-touch-icon-precomposed" href="<?=base_url()?>assets/images/favicon/apple-touch-icon-152x152.png">

  <link href="<?=base_url()?>assets/css/page.css" type="text/css" rel="stylesheet" media="screen,projection">

  <!-- CORE CSS-->

  <link href="<?=base_url()?>assets/css/materialize.css" type="text/css" rel="stylesheet" media="screen,projection">
  <link href="<?=base_url()?>assets/css/style.css" type="text/css" rel="stylesheet" media="screen,projection">
  <link href="<?=base_url()?>assets/css/page-center.css" type="text/css" rel="stylesheet" media="screen,projection">

  <!-- INCLUDED PLUGIN CSS ON THIS PAGE -->
  <link href="<?=base_url()?>assets/css/prism.css" type="text/css" rel="stylesheet" media="screen,projection">
  <link href="<?=base_url()?>assets/js/plugins/perfect-scrollbar/perfect-scrollbar.css" type="text/css" rel="stylesheet" media="screen,projection">
  
</head>

<body class="grey darken-4">
  <!-- Start Page Loading -->
  <div id="loader-wrapper">
      <div id="loader"></div>        
      <div class="loader-section section-left"></div>
      <div class="loader-section section-right"></div>
  </div>
  <!-- End Page Loading -->



  <div id="login-page" class="row">
    <div class="col s12 z-depth-4 card-panel login-border">

      <?=form_open('verifylogin', array('class' => 'login-form'))?>
        <div class="row">
          <div class="input-field col s12 center">
            <img src="<?=base_url()?>assets/images/sti_header.png" alt="" class="responsive-img valign">
            <p class="center login-form-text">Alumni Information System</p>
          </div>
        </div>
        <div class="row margin center">  
          <?php
          //SUCCESS ACTION
              $this->form_validation->set_error_delimiters('', '');
               if($this->session->flashdata('success')) { ?>
              <div class="card-panel green">
                 <span class="white-text"><i class="mdi-action-done tiny"></i> <?php echo $this->session->flashdata('success'); ?></span>
              </div>
          <?php } ?>   
            <?php   
             $this->form_validation->set_error_delimiters('', '');          
            if(validation_errors()) { ?>
              <div class="card-panel red">              
                 <span class="white-text"><i class="mdi-alert-warning tiny"></i> <?php echo validation_errors(); ?></span> 
              </div>               
            <?php } ?>  
        </div>
        <div class="row margin">
          <div class="input-field col s12">
            <i class="mdi-social-person-outline prefix"></i>
            <input id="username" type="text" name="username" class="validate" autocomplete="off" required>
            <label for="username" class="center-align">Username</label>
          </div>
        </div>
        <div class="row margin">
          <div class="input-field col s12">
            <i class="mdi-action-lock-outline prefix"></i>
            <input id="password" type="password" name="password" class="validate" required>
            <label for="password">Password</label>
          </div>
        </div>
        <div class="row">
          <div class="input-field col s12">
            <button type="submit" class="btn waves-effect grey darken-3 col s12">Login</button>
          </div>
        </div>        
      </form>
    </div>
  </div>

    <!-- ================================================
    Scripts
    ================================================ -->

    <!-- jQuery Library -->
    <script type="text/javascript" src="<?=base_url()?>assets/js/jquery-1.11.2.min.js"></script>
    <!--materialize js-->
    <script type="text/javascript" src="<?=base_url()?>assets/js/materialize.js"></script>
    <!--prism-->
    <script type="text/javascript" src="<?=base_url()?>assets/js/prism.js"></script>
    <!--scrollbar-->
    <script type="text/javascript" src="<?=base_url()?>assets/js/plugins/perfect-scrollbar/perfect-scrollbar.min.js"></script>

    <!--plugins.js - Some Specific JS codes for Plugin Settings-->
    <script type="text/javascript" src="<?=base_url()?>assets/js/plugins.js"></script>

</body>
</html>