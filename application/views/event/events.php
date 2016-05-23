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
          <div class="section">

            <div class="row">
              <div class="col s12">
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
              </div>
            </div>

            <!--Announcement Start-->
            <div class="row">
              <div class="col s12">
                <div id="work-collections" class="seaction">              
                  <div class="row">
                    <div class="col s12">          
                      <ul id="projects-collection" class="collection">
                        <li class="collection-item avatar">
                          <i class="mdi-notification-event-available circle red"></i>
                          <span class="collection-header">Events</span>
                          <p>Alumni Events</p>                     
                        </li>
                        <?php if($results): ?>
                        <?php foreach ($results as $item): ?>                        
                          <li class="collection-item">
                            <div class="row">
                              <div class="col s8">
                                <p class="collections-title"><a href="<?=base_url('events/view/'.$item['id'])?>"><?=$item['title']?></a></p>
                                <p class="collections-content"><?=character_limiter(strip_tags($item['description']), 150)?></p>
                              </div>
                              <div class="col s2">
                                <?php if($item['course']):?>
                                <span class="task-cat pink accent-2"><?=$item['course']?></span>
                                <?php endif; ?>
                                <?php if($item['year']):?>
                                  <span class="task-cat cyan accent-4"><?=$item['year']?></span>
                                <?php endif; ?>
                                <?php if($item['event_date']):?>
                                  <span class="task-cat red darken-4"><?=$item['event_date']?></span>
                                <?php endif; ?>
                              </div>
                              <div class="col s2"> 
                                <small class="italic"><?=$item['action']?> by <?=$item['name']?> <?=$item['lastname']?> | <?=timespan(mysql_to_unix($item['date_time']))?> ago</small>                          
                              </div>
                            </div>
                          </li>                    
                        <?php endforeach; ?>
                      <?php endif; ?>
                      </ul>
                    </div>                
                  </div>
                </div>
              </div>
            </div>
            <div class="row">
              <?php foreach ($links as $link) { echo $link; } ?>
            </div>

           
            <!--Announcement End-->
         
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