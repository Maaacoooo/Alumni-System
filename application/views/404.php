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
  <title>Oops! Page Not Found! &middot; Tech Depot Development Team</title>

  <!-- Favicons-->
  <link rel="icon" href="<?=base_url('assets')?>/images/favicon/favicon-32x32.png" sizes="32x32">
  <!-- Favicons-->
  <link rel="apple-touch-icon-precomposed" href="<?=base_url('assets')?>/images/favicon/apple-touch-icon-152x152.png">

  <!-- CORE CSS-->
  
  <link href="<?=base_url('assets')?>/css/materialize.css" type="text/css" rel="stylesheet" media="screen,projection">
  <link href="<?=base_url('assets')?>/css/style.css" type="text/css" rel="stylesheet" media="screen,projection">
  <link href="<?=base_url('assets')?>/css/page-center.css" type="text/css" rel="stylesheet" media="screen,projection">


  <!-- INCLUDED PLUGIN CSS ON THIS PAGE -->
  <link href="<?=base_url('assets')?>/css/prism.css" type="text/css" rel="stylesheet" media="screen,projection">
  <link href="<?=base_url('assets')?>/js/plugins/perfect-scrollbar/perfect-scrollbar.css" type="text/css" rel="stylesheet" media="screen,projection">
  
</head>

<body class="grey darken-1">
  <!-- Start Page Loading -->
  <div id="loader-wrapper">
      <div id="loader"></div>        
      <div class="loader-section section-left"></div>
      <div class="loader-section section-right"></div>
  </div>
  <!-- End Page Loading -->



  <div id="error-page">

    <div class="row">
      <div class="col s12">
        <div class="browser-window">
          <div class="top-bar">
            <div class="circles">
              <div id="close-circle" class="circle"></div>
              <div id="minimize-circle" class="circle"></div>
              <div id="maximize-circle" class="circle"></div>
            </div>
          </div>
          <div class="content">
            <div class="row">
              <div id="site-layout-example-top" class="col s12 red lighten-1">
                <p class="flat-text-logo center white-text caption-uppercase">Sorry but we couldn’t find this page :(</p>
              </div>
              <div id="site-layout-example-right" class="col s12 m12 l12">
                <div class="row center">
                  <h1 class="text-long-shadow col s12">404</h1>
                </div>
                <div class="row center">
                  <p class="center white-text col s12">It seems that this page doesn’t exist.</p>
                  <p class="center s12"><button onclick="goBack()" class="btn waves-effect waves-light grey lighten-5 grey-text text-darken-4">Back</button> <a href="<?=base_url()?>" class="btn waves-effect waves-light grey lighten-5  grey-text text-darken-4">Homepage</a>
                    <p>
                    </p>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>


  <!-- ================================================
    Scripts
    ================================================ -->

  <!-- jQuery Library -->
  <script type="text/javascript" src="<?=base_url('assets')?>/js/jquery-1.11.2.min.js"></script>
  <!--materialize js-->
  <script type="text/javascript" src="<?=base_url('assets')?>/js/materialize.js"></script>
  <!--prism-->
  <script type="text/javascript" src="<?=base_url('assets')?>/js/prism.js"></script>
  <!--scrollbar-->
  <script type="text/javascript" src="<?=base_url('assets')?>/js/plugins/perfect-scrollbar/perfect-scrollbar.min.js"></script>

  <!--plugins.js - Some Specific JS codes for Plugin Settings-->
  <script type="text/javascript" src="<?=base_url('assets')?>/js/plugins.js"></script>
  
  <script type="text/javascript">
    function goBack() {
      window.history.back();
    }
  </script>
</body>

</html>