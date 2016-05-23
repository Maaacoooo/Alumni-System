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
    <title><?=$title?> &middot; <?=$site_title?></title>

    <?php $this->load->view('inc/css'); ?>


</head>

<body>
    
    <?php $this->load->view('inc/header'); ?>

    <!-- //////////////////////////////////////////////////////////////////////////// -->


  <!-- START MAIN -->
  <div id="main">
    <!-- START WRAPPER -->
    <div class="wrapper">

      <?php $this->load->view('inc/left_nav'); ?>

      <!-- //////////////////////////////////////////////////////////////////////////// -->

           <!-- START CONTENT -->
      <section id="content">

        <!--start container-->
        <div class="container">

          <div id="mail-app" class="section">
            <div class="row">
              <div class="col s12">
                <nav class="red">
                  <div class="nav-wrapper">
                    <div class="left col s12 m5 l5">
                      <ul>
                        <li><a href="#!" class="email-menu"><i class="mdi-navigation-menu"></i></a>
                        </li>
                        <li><a href="#!" class="email-type"><?=$title?></a>
                        </li>                        
                      </ul>
                    </div>                   
                  </div>
                </nav>
              </div>
              <div class="col s12">                
                <div id="email-list" class="col s12 card-panel z-depth-1">
                  <ul class="collection">
                  <?php if($results):?>                        
                  <?php foreach($results as $thread):?>
                   <a href="<?=base_url('messages/view/'.$thread['thread_id'])?>">
                      <li class="collection-item avatar <?php if($thread['recepient_status']=='unread'){echo'email-unread';}?>">
                        <?php
                          //USER PROFILE IMG                          
                            if($thread['img'] != NULL)    {
                              echo '<img src="'.base_url('uploads/'.$thread['img']).'" alt="" class="circle responsive-img valign profile-image">';
                            } else {
                              echo '<i class="mdi-social-person medium grey lighten-2 circle"></i>';
                            }
                          ?>
                        <span class="email-title"><?=$thread['name']?> <?=$thread['lastname']?></span>
                        <p class="truncate grey-text ultra-small"><?=$thread['subject']?></p>
                        <a href="<?=base_url('messages/view/'.$thread['thread_id'])?>" class="secondary-content email-time"><span class="grey-text ultra-small"><?=unix_to_human(mysql_to_unix($thread['timestamp']))?></span></a>
                      </li>
                    </a>  
                  <?php endforeach; ?>   
                  <?php endif; ?>                
                  </ul>
                </div>               
              </div>              
            </div>
        </div><!--/#mail-app -->
        <div class="row">
                <?php foreach ($links as $link) { echo $link; } ?>
              </div>
    </div>
    <!--end container-->

    </section>
    <!-- END CONTENT -->

      <!-- //////////////////////////////////////////////////////////////////////////// -->
     <?php $this->load->view('inc/right_nav'); ?>

    </div>
    <!-- END WRAPPER -->

  </div>
  <!-- END MAIN -->



     <!-- //////////////////////////////////////////////////////////////////////////// -->

    <?php $this->load->view('inc/footer'); ?>

    <?php $this->load->view('inc/js'); ?>
   
</body>
</html>