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
                    <li><a href="<?=base_url('profile')?>">Profile</a></li>
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
                <?=form_open_multipart('profile/update')?>
                  <div class="col s8">
                    <div class="card-panel">
                      <h5 class="heading2">PERSONAL INFORMATION</h5>
                      <div class="row">
                        <div class="col s6">
                          <div class="input-field col s12">
                            <input id="id_num" class="validate" type="text" autocomplete="off" name="id_num" value="<?=$items['student_id']?>" required>
                            <label for="id_num">ID Number</label>
                          </div>
                          <div class="input-field col s12">
                              <input id="name" class="validate" type="text" autocomplete="off" name="name" value="<?=$items['name']?>" required>
                              <label for="name">Name</label>
                          </div>
                          <div class="input-field col s12">
                              <input id="middlename" class="validate" type="text" autocomplete="off" name="middlename" value="<?=$items['middlename']?>" required>
                              <label for="middlename">Middle Name</label>
                          </div>
                          <div class="input-field col s12">
                              <input id="lastname" class="validate" type="text" autocomplete="off" name="lastname" value="<?=$items['lastname']?>" required>
                              <label for="lastname">Last Name</label>
                          </div>
                          <strong class="col s12">USER IMAGE</strong>
                          <div class="file-field input-field col s12">                          
                              <input class="file-path validate" type="text"/>                                  
                              <div class="btn waves-effect waves-light cyan">
                                <span><i class="mdi-image-image"></i></span>
                                <input type="file" name="userfile" placeholder="test"/>                                      
                              </div>
                          </div>                        
                        </div>
                        <div class="col s6">
                          <div class="input-field col s12">
                              <textarea class="ckeditor" id="ckeditor" name="description"><?=$items['description']?></textarea>
                          </div>
                          <div class="row">
                            <strong class="col s12">COVER PHOTO</strong>
                            <div class="file-field input-field col s12">                          
                                <input class="file-path validate" type="text"/>                                  
                                <div class="btn waves-effect waves-light cyan">
                                  <span><i class="mdi-image-image"></i></span>
                                  <input type="file" name="coverphoto" placeholder="test"/>                                      
                                </div>
                            </div>
                          </div>
                          <div class="row">
                              <div class="input-field col s12">
                                <button class="btn cyan waves-effect waves-light right" type="submit" name="action">UPDATE INFO
                                  <i class="mdi-content-send right"></i>
                                </button>
                              </div>
                          </div>                          
                          <input type="hidden" name="img" value="<?=$items['img']?>">
                          <input type="hidden" name="cover_img" value="<?=$items['cover_img']?>">
                          <input type="hidden" name="id" value="<?=$items['user_id']?>">
                        </div>
                      </div>
                    </div>
                  </div>
                </form>
                <?=form_open('profile/login_update')?>
                    <div class="col s4">
                      <div class="card-panel">
                        <h5 class="heading2">LOGIN INFORMATION </h5>
                        <small class="italic">Type your Password upon updating.</small>
                        <div class="row">
                      
                             <div class="input-field col s12">
                                <input id="username" class="validate" type="text" name="username" autocomplete="off" value="<?=$items['username']?>" minlength="3">
                                <label for="first_name">Username</label>
                              </div>                                    
                              
                              <div class="input-field col s12">
                                <input id="oldpassword" class="validate" type="password" name="oldpassword" minlength="5">
                                <label for="oldpassword">Password</label>
                              </div>   

                              <div class="input-field col s12">
                                <input id="password" class="validate" type="password" name="password" minlength="5">
                                <label for="password">New Password</label>
                              </div>                            
                            
                              <div class="input-field col s12">
                                <input id="password" class="validate" type="password" name="confirmpassword" minlength="5">
                                <label for="password">Confirm New Password</label>
                              </div>

                              <div class="input-field col s12">
                                <button class="btn cyan waves-effect waves-light right" type="submit" name="action">
                                  UPDATE LOGIN
                                  <i class="mdi-content-save right"></i>
                                </button>
                            </div>                  
                        </div>
                      </div>
                    </div>
                </form>
              </div><!-- /.row -->
        

              <div class="row">                
                  <div class="col s4">
                      <div class="card-panel">
                        <h5 class="heading2">CONTACT INFORMATION</h5>
                        <div class="row">
                              <?=form_open('profile/create_contact')?>                        
                              <div class="input-field col s4">                              
                                <input id="name" name="name" type="text" class="validate">
                                <label for="name">Title</label>
                              </div>
                              <div class="input-field col s6">                              
                                <input id="value" name="value" type="text" class="validate">
                                <label for="value">Value</label>
                              </div>
                              <div class="input-field col s2">                              
                                  <button class="btn-floating btn-flat green darken-1 waves-effect waves-light" type="submit" name="action"><i class="mdi-content-add"></i></button>                           
                              </div> 
                              </form>
                      
                             <?php foreach($contacts as $contact):?>               
                              <?=form_open('profile/update_contact')?>
                              <div class="input-field col s4">                              
                                <input id="name" name="name" type="text" class="validate" value="<?=$contact['title']?>">
                                <label for="name">Title</label>
                              </div>
                              <div class="input-field col s6">                              
                                <input id="value" name="value" type="text" class="validate" value="<?=$contact['value']?>">
                                <label for="value">Value</label>
                              </div>
                              <div class="input-field col s1">                              
                                  <button class="btn-floating btn-flat amber darken-1 waves-effect waves-light" type="submit" name="action"><i class="mdi-content-save"></i></button>                           
                              </div> 
                                <input type="hidden" name="id" value="<?=$contact['id']?>">
                              </form>     
                              <div class="input-field col s1">
                                <?=form_open('profile/delete_contact')?>
                                  <input type="hidden" name="id" value="<?=$contact['id']?>">
                                  <button class="btn-floating btn-flat red darken-2 waves-effect waves-light" type="submit"><i class="mdi-content-clear"></i></button>                              
                                </form>
                              </div>  
                            <?php endforeach; ?>
                                                   
                        </div>
                      </div>
                  </div>
                  <div class="col s8">
                      <div class="card-panel">
                        <h5 class="heading2">WORK INFORMATION</h5>
                        <div class="row">
                          <div class="row">                     
                            <?=form_open('profile/create_work')?>                        
                                <div class="input-field col s2">                              
                                  <input id="company" name="company" type="text" class="validate">
                                  <label for="company">Company</label>
                                </div>
                                <div class="input-field col s2">                              
                                  <input id="title" name="title" type="text" class="validate">
                                  <label for="title">Job Title</label>
                                </div>
                                <div class="input-field col s3">                              
                                  <input id="address" name="address" type="text" class="validate">
                                  <label for="address">Address</label>
                                </div>
                                <div class="input-field col s2">                              
                                  <input id="started" name="started" type="text" class="datepicker">
                                  <label for="started">Date Started</label>
                                </div>
                                <div class="input-field col s2">                              
                                  <input id="ended" name="ended" type="text" class="datepicker">
                                  <label for="ended">Date Ended</label>
                                </div>
                                <div class="input-field col s1">                              
                                    <button class="btn-floating btn-flat green darken-1 waves-effect waves-light" type="submit" name="action"><i class="mdi-content-add"></i></button>                           
                                </div> 
                            </form>
                        </div>  
                          <?php foreach($works as $work):?> 
                            <div class="row">              
                              <?=form_open('profile/update_work')?>
                              <div class="input-field col s2">                              
                                <input id="company_<?=$work['id']?>" name="company" type="text" class="validate" value="<?=$work['company']?>">
                                <label for="company_<?=$work['id']?>">Company</label>
                              </div>
                              <div class="input-field col s2">                              
                                <input id="title_<?=$work['id']?>" name="title" type="text" class="validate" value="<?=$work['job_title']?>">
                                <label for="title_<?=$work['id']?>">Job Title</label>
                              </div>
                              <div class="input-field col s2">                              
                                <input id="address_<?=$work['id']?>" name="address" type="text" class="validate" value="<?=$work['address']?>">
                                <label for="address_<?=$work['id']?>">Address</label>
                              </div>
                              <div class="input-field col s2">                              
                                <input id="started_<?=$work['id']?>" name="started" type="text" class="datepicker" value="<?=$work['date_started']?>">
                                <label for="started_<?=$work['id']?>">From</label>
                              </div>
                              <div class="input-field col s2">                              
                                <input id="ended_<?=$work['id']?>" name="ended" type="text" class="datepicker"  value="<?=$work['date_ended']?>">
                                <label for="ended_<?=$work['id']?>">To</label>
                              </div>
                              <div class="input-field col s1">                              
                                  <button class="btn-floating btn-flat amber darken-1 waves-effect waves-light" type="submit" name="action"><i class="mdi-content-save"></i></button>                           
                              </div> 
                                <input type="hidden" name="id" value="<?=$work['id']?>">
                              </form>     
                              <div class="input-field col s1">
                                <?=form_open('profile/delete_work')?>
                                  <input type="hidden" name="id" value="<?=$work['id']?>">
                                  <button class="btn-floating btn-flat red darken-2 waves-effect waves-light" type="submit"><i class="mdi-content-clear"></i></button>                              
                                </form>
                              </div>
                            </div>  
                            <?php endforeach; ?>                                                 
                        </div>
                      </div>
                  </div>
              </div><!-- /.row -->
            

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