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
            <div class="row">
                <h5 class="section-header">TIMELINE</h5>
            </div>
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
              <div class="card-panel">  
                <?=form_open('dashboard')?>
                  <div class="row">
                    <div class="col l12  s12 m12">
                      <div class="input-field col s12">
                          <i class="mdi-editor-mode-edit prefix"></i>
                          <textarea id="icon_prefix2" class="materialize-textarea" name="post"><?php echo set_value('post'); ?></textarea>
                          <label for="icon_prefix2" class="">Post Something...</label>
                      </div>
                    </div>
                  </div><!-- /.row -->
                  <div class="row">
                    <div class="input-field col s12">
                      <button class="btn cyan waves-effect waves-light right" type="submit" name="action">Submit
                        <i class="mdi-content-send right"></i>
                      </button>
                    </div>
                  </div>
                </form>
              </div><!--/.card-panel-->
            </div><!--/.row-->
            <!-- //////// POSTS SECTION -->           
          <?php 
          if($results):
          foreach ($results as $post): ?>
              <div class="row">
                <div class="col s12">
                    <div class="card-panel">
                      <div class="row">
                          <!-- POST -->
                          <div class="row">
                            <ul class="collection">                                                          
                                <li class="collection-item avatar">
                                  <a href="<?=base_url('profile/view/'.$post['user_id'])?>">
                                    <?php                                                 
                                      if($post['img'])    {
                                        echo '<img src="'.base_url('uploads/'.$post['img']).'" alt="" class="circle">';
                                      } else {
                                       echo '<i class="mdi-social-person medium grey lighten-2 circle"></i>';
                                      }
                                    ?>
                                  </a>

                                  <span class="title">
                                    <a href="<?=base_url('profile/view/'.$post['user_id'])?>" class="strong"><?=$post['name']?> <?=$post['lastname']?></a> 
                                    <small class="italic"><?=$post['course']?> <?=$post['year']?></small>
                                    <small class="right italic"><?=timespan(mysql_to_unix($post['date_time']))?> ago</small>
                                    <div class="divider"></div>
                                  </span>
                                  <p class="margin-top-10"><?=$post['post']?></p> 

                                  <?php if($id == $post['user_id']): ?>
                                    <small class="right">
                                      <?=form_open('dashboard/delete')?>
                                        <input type="hidden" name="id" value="<?=$post['id']?>">
                                        <button type="submit" class="btn-link">Delete</button>
                                      </form>
                                    </small>
                                  <?php endif;?>
                                </li>                          
                            </ul>
                          </div>
                          <!-- END POST -->
                          <!-- COMMENTS -->
                          <div class="row">
                            <div class="col s12">
                              <div class="divider"></div>
                                <div class="input-field col s12">
                                  <?=form_open('comment/create')?>
                                    <input id="comment-<?=$post['id']?>" type="text" class="validate" name="comment" autocomplete="off">
                                    <input type="hidden" name="tag" value="timeline">
                                    <input type="hidden" name="id" value="<?=$post['id']?>">
                                    <label for="comment-<?=$post['id']?>">Write a Comment...</label>
                                  </form>                                  
                                </div>
                                <ul class="collection">
                                <?php                                
                                if($this->view_model->get_comment_timeline($post['id'])):
                                foreach ($this->view_model->get_comment_timeline($post['id']) as $comment):
                                ?>                             
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
                                        <input type="hidden" name="id" value="<?=$comment['comment_id']?>">
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
                            </div>
                          </div>                 
                          <!-- END COMMENT -->
                      </div>
                    </div>
                </div>
              </div> <!-- /.row -->

           <?php 
              endforeach;
              endif;
            ?>         

            <div class="row">
               <?php foreach ($links as $link) { echo $link; } ?>
            </div>      

            <!-- /////// END POST ////////////// -->

            </div>
        </div> <!-- /.container -->
      
      </section> <!-- END CONTENT -->
     

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