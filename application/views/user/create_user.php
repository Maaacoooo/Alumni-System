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
        
        <!--breadcrumbs start-->
        <div id="breadcrumbs-wrapper" class=" grey lighten-3">
          <div class="container">
            <div class="row">
              <div class="col s12 m12 l12">
                <h5 class="breadcrumbs-title"><?=$title?></h5>
                <ol class="breadcrumb">
                    <li><a href="<?=base_url()?>">Dashboard</a></li>
                    <li><a href="<?=base_url('users')?>">Users</a></li>
                    <li class="active"><?=$title?></li>
                </ol>
              </div>
            </div>
          </div>
        </div>
        <!--breadcrumbs end-->  

        <!--start container-->
        <div class="container">
          <div class="section">

            <p class="caption">Fill up the form to Create a New User. </p>
            <div class="divider"></div>    

            <div class="row">
              <?php
                //ERROR ACTION                          
                  if($this->session->flashdata('error')) { ?>
                    <div class="card-panel deep-orange darken-3">
                        <span class="white-text"><i class="mdi-alert-warning tiny"></i> <?php echo $this->session->flashdata('error'); ?></span>
                    </div>
              <?php } ?> 
              <?php
                //SUCCESS ACTION                          
                  if($this->session->flashdata('success')) { ?>
                    <div class="card-panel green">
                        <span class="white-text"><i class="mdi-action-done tiny"></i> <?php echo $this->session->flashdata('success'); ?></span>
                    </div>
              <?php } ?>             
              <?php
                //FORM VALIDATION ERROR
                    $this->form_validation->set_error_delimiters('<p><i class="mdi-alert-warning tiny"></i> ', '</p>');
                      if(validation_errors()) { ?>
                    <div class="card-panel yellow amber">
                        <span class="white-text"> <?php echo validation_errors(); ?></span>
                    </div>
              <?php } ?> 

            <div id="basic-form" class="section">
              <div class="row">
                <div class="col s12 m12 12">
                  <div class="card-panel">    
                    <div class="row">
                          <?php echo form_open_multipart('users/create');?>
                           <div class="col s12 l6 m6"> 
                              <div class="row">                                
                              </div>
                              <div class="row">
                                <div class="input-field col s12">
                                  <input id="username" class="validate" type="text" name="username" autocomplete="off" value="<?php echo set_value('username'); ?>" minlength="3" required>
                                  <label for="first_name">Username</label>
                                </div>
                              </div>                        
                              <div class="row">
                                <div class="input-field col s12">
                                  <input id="password" class="validate" type="password" name="password" minlength="5" required>
                                  <label for="password">Password</label>
                                </div>
                              </div>
                              <div class="row">
                                <div class="input-field col s12">
                                  <input id="password" class="validate" type="password" name="confirmpassword" minlength="5" required>
                                  <label for="password">Confirm Password</label>
                                </div>
                              </div>                                                            
                           </div>
                           <div class="col s12 l6 m6">
                              <div class="input-field col s12">
                                  <input id="name" class="validate" type="text" autocomplete="off" name="name" value="<?php echo set_value('name'); ?>" required>
                                  <label for="name">Name</label>
                              </div>
                              <div class="input-field col s12">
                                  <input id="lastname" class="validate" type="text" autocomplete="off" name="lastname" value="<?php echo set_value('lastname'); ?>" required>
                                  <label for="lastname">Last Name</label>
                              </div>
                              <div class="row">
                                <div class="file-field input-field col s12">
                                  <input class="file-path validate" type="text"/>                                  
                                    <div class="btn waves-effect waves-light cyan">
                                      <span><i class="mdi-image-image"></i></span>
                                      <input type="file" name="userfile"/>                                      
                                    </div>
                                </div>
                              </div>                                                                                       
                           </div>            

                                <div class="row">
                                  <div class="input-field col s12">
                                    <button class="btn cyan waves-effect waves-light right" type="submit" name="action">Submit
                                      <i class="mdi-content-send right"></i>
                                    </button>
                                  </div>
                                </div>
                             
                          </form>
                    </div>
                  </div>
                </div> 
         
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