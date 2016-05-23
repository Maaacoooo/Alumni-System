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
                    <li><a href="<?=base_url('announcements')?>">Announcements</a></li>
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

            <div class="row">
              <div class="col s12">
                <div class="card-panel">
                  <article>
                    <div class="header">
                      <div class="row">                        
                        <div class="col s12">
                          <h5>
                            <?=$items['title']?>
                            <?php if($items['course']):?>
                              <span class="task-cat pink accent-2"><?=$items['course']?></span>
                            <?php endif; ?>
                            <?php if($items['year']):?>
                              <span class="task-cat cyan accent-4"><?=$items['year']?></span>
                            <?php endif; ?>
                            <small class="italic right"><?=$items['action']?> by <?=$items['name']?> <?=$items['lastname']?> | <?=timespan(mysql_to_unix($items['date_time']))?> ago</small>   
                          </h5> 
                        </div>                       
                      </div>
                    </div>
                    <p><?=$items['description']?></p>
                    <div class="row">                           
                      <?php if($id == $items['user_id'] OR $user['usertype'] == 'Administrator'): ?>
                        <small class="right">
                          <?=form_open('announcements/delete')?>
                            <input type="hidden" name="id" value="<?=$items['id']?>">
                            <a href="<?=base_url('announcements/edit/'.$items['id'])?>">Edit</a> 
                            <button type="submit" class="btn-link">Delete</button>
                          </form>
                        </small>
                      <?php endif;?>
                    </div>
                  </article>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col s12">
                <div class="card-panel">
                  <h5>COMMENTS (<?=$total_comments?>)</h5>
                  <div class="row">
                    <div class="input-field col s12">
                      <?=form_open('comment/create')?>
                        <input id="comment" type="text" class="validate" name="comment" autocomplete="off">
                        <input type="hidden" name="tag" value="announcement">
                        <input type="hidden" name="id" value="<?=$items['id']?>">
                        <label for="comment">Write a Comment...</label>
                      </form>                                  
                    </div>
                  </div>
                  <div class="row margin-top-10">                                  
                      <ul class="collection">
                  <?php 
                  if($comments):
                  foreach ($comments as $comment): ?>
                    
                      <li class="collection-item avatar">
                      <a href="<?=base_url('profile/view/'.$comment['user_id'])?>">
                        <?php                                                 
                          if($comment['img'])    {
                            echo '<img src="'.base_url('uploads/'.$comment['img']).'" alt="" class="circle">';
                          } else {
                           echo '<i class="mdi-social-person medium grey lighten-2 circle"></i>';
                          }
                        ?>
                      </a>

                      <span class="title">
                        <a href="<?=base_url('profile/view/'.$comment['user_id'])?>" class="strong"><?=$comment['name']?> <?=$comment['lastname']?></a> 
                        <small class="italic"><?=$comment['course']?> <?=$comment['year']?></small>
                        <small class="right italic"><?=timespan(mysql_to_unix($comment['date_time']))?> ago</small>
                        <div class="divider"></div>
                      </span>
                      <p class="margin-top-10"><?=$comment['comment']?></p> 

                      <?php if($id == $comment['user_id']): ?>
                        <small class="right">
                          <?=form_open('comment/delete')?>
                            <input type="hidden" name="id" value="<?=$comment['id']?>">
                            <button type="submit" class="btn-link">Delete</button>
                          </form>
                        </small>
                      <?php endif;?>
                    </li>                           
                    
                  <?php 
                  endforeach; 
                  endif;
                  ?>
                    </ul>
                  </div><!--/.row -->
                  <div class="row">
                    <?php foreach ($links as $link) { echo $link; } ?>
                  </div>
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