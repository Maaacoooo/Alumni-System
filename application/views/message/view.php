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
                <div id="email-details" class="col s12 card-panel">
                  <p class="email-subject truncate"><?=$items['subject']?></p>
                  <hr class="grey-text text-lighten-2">

                  <?php foreach($messages as $message):?>
                    <div class="email-content-wrap">
                      <div class="row">
                        <div class="col s10 m10 l10">
                          <ul class="collection">
                            <li class="collection-item avatar">
                               <a href="<?=base_url('profile/view/'.$message['id'])?>">
                                <?php
                                //USER PROFILE IMG                          
                                  if($message['img'] != NULL)    {
                                    echo '<img src="'.base_url('uploads/'.$message['img']).'" alt="" class="circle responsive-img valign profile-image">';
                                  } else {
                                    echo '<i class="mdi-social-person medium grey lighten-2 circle"></i>';
                                  }
                                ?>
                               </a>
                              <span class="email-title"><a href="<?=base_url('profile/view/'.$message['id'])?>"><?=$message['name']?> <?=$message['lastname']?></a></span>                              
                              <p class="grey-text ultra-small"><?=timespan(mysql_to_unix($message['date_time']))?> ago</p>
                            </li>
                          </ul>
                        </div>                        
                      </div>
                      <div class="email-content">
                        <?=$message['message']?>
                      </div>
                    </div>
                    <hr>
                  <?php endforeach;?>
                  
                  <div class="email-reply">
                    <div class="row">
                      <div class="col s4 m4 l4 center-align">
                        <a href="#reply" class="modal-trigger"><i class="mdi-content-reply"></i></a>
                        <p class="ultra-small">Reply</p>
                      </div>                      
                    </div>
                  </div>

                </div>
              </div>
            </div>



            <!-- Compose Email Trigger -->
            <div class="fixed-action-btn" style="bottom: 45px; right: 24px;">
              <a class="btn-floating btn-large red modal-trigger" href="#reply">
                <i class="large mdi-editor-mode-edit"></i>
              </a>
            </div>



            <!-- Compose Email Structure -->
            <div id="reply" class="modal">
              <?=form_open('messages/create')?>
                <div class="modal-content">
                  <nav class="red">
                    <div class="nav-wrapper">
                      <div class="left col s12 m5 l5">
                        <ul>
                          <li><a href="#!" class="email-menu"><i class="modal-action modal-close  mdi-hardware-keyboard-backspace"></i></a>
                          </li>
                          <li><a href="#!" class="email-type">REPLY : <?=$items['subject']?></a>
                          </li>
                        </ul>
                      </div>
                      <div class="col s12 m7 l7 hide-on-med-and-down">
                        <ul class="right">                        
                          <li><button class="btn-send" type="submit"><i class="mdi-content-send send"></i></button>
                          </li>                       
                        </ul>
                      </div>
                    </div>
                  </nav>
                </div>
                <div class="model-email-content">
                  <div class="row">                                     
                      <div class="row">
                        <div class="input-field col s12">
                          <input type="hidden" name="id" value="<?=$items['id']?>">
                          <textarea id="ckeditor" name="message" class="ckeditor"></textarea>
                        </div>
                      </div>                  
                  </div>
                </div>
              </form>
            </div>

        </div><!--/#mail-app -->

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