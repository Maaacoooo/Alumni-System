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
<!-- START LEFT SIDEBAR NAV -->
      <aside id="left-sidebar-nav">
          <ul id="slide-out" class="side-nav fixed leftside-navigation">
              <li class="user-details grey lighten-5">
                  <div class="row">
                      <div class="col col s4 m4 l4">
                        <?php
                        //USER PROFILE IMG                          
                          if($user['img'] != NULL)    {
                            echo '<img src="'.base_url('uploads/'.$user['img']).'" alt="" class="circle responsive-img valign profile-image">';
                          } else {
                            echo '<i class="mdi-social-person medium grey lighten-2 circle"></i>';
                          }
                        ?>
                          

                          
                      </div>
                      <div class="col col s8 m8 l8">
                          <ul id="profile-dropdown" class="dropdown-content">
                              <li><a href="<?=base_url('profile')?>"><i class="mdi-action-face-unlock"></i> Profile</a>
                              </li>
                              <li><a href="<?=base_url('settings')?>"><i class="mdi-action-settings"></i> Settings</a>
                              </li>                              
                              <li class="divider"></li>                              
                              <li><a href="<?=base_url('logout')?>"><i class="mdi-hardware-keyboard-tab"></i> Logout</a>
                              </li>
                          </ul>
                          <a class="btn-flat dropdown-button waves-effect waves-light white-text profile-btn" href="#" data-activates="profile-dropdown"><?=$user['name']?> <?=$user['lastname']?><i class="mdi-navigation-arrow-drop-down right"></i></a>
                          <p class="user-roal"><?=$user['usertype']?></p>
                      </div>
                  </div>
              </li>
              <li class="bold"><a href="<?=base_url('dashboard')?>" class="waves-effect waves-cyan"><i class="mdi-action-dashboard"></i> Home</a>
              </li>
              <li class="bold"><a href="<?=base_url('announcements')?>" class="waves-effect waves-cyan"><i class="mdi-content-flag"></i> Announcements</a>
              </li> 
              <li class="bold"><a href="<?=base_url('events')?>" class="waves-effect waves-cyan"><i class="mdi-editor-insert-invitation"></i> Events</a>
              </li>
              <li class="bold"><a href="<?=base_url('alumni')?>" class="waves-effect waves-cyan"><i class="mdi-social-school"></i> Alumni</a>
              </li> 
              <li class="bold"><a href="<?=base_url('messages')?>" class="waves-effect waves-cyan"><i class="mdi-communication-email"></i> Messages</a>
              </li>
              <?php if($user['usertype'] == 'Administrator') { ?>     
              <li class="li-hover"><div class="divider"></div></li>
              <li class="li-hover"><p class="ultra-small margin more-text">ADMIN OPTIONS</p></li>  
              <li class="no-padding">
                  <ul class="collapsible collapsible-accordion">
                      <li class="bold"><a class="collapsible-header waves-effect waves-cyan"><i class="mdi-action-account-child"></i> Administrators</a>
                          <div class="collapsible-body">
                              <ul>
                                  <li><a href="<?=base_url('users/create')?>">Register Administrator</a>
                                  </li>                                       
                                  <li><a href="<?=base_url('users')?>">Administrators</a>
                                  </li>                                
                              </ul>
                          </div>
                      </li>
                    </ul>
              </li> 
              <li class="no-padding">
                  <ul class="collapsible collapsible-accordion">
                      <li class="bold"><a class="collapsible-header waves-effect waves-cyan"><i class="mdi-social-school"></i> Alumni</a>
                          <div class="collapsible-body">
                              <ul>
                                  <li><a href="<?=base_url('alumni/create')?>">Register Alumni</a>
                                  </li>                                       
                                  <li><a href="<?=base_url('alumni')?>">Alumni</a>
                                  </li>  
                                  <li><a href="<?=base_url('alumni/years')?>">School Year</a>
                                  </li>  
                                  <li><a href="<?=base_url('alumni/courses')?>">Course</a>
                                  </li>   
                                  <li><a href="<?=base_url('alumni/reports')?>" target="_blank">Alumni Student Report</a>
                                  </li>                                
                              </ul>
                          </div>
                      </li>
                    </ul>
              </li>             
              <?php } ?>   
              <?php if($user['usertype'] == 'Administrator' OR $user['usertype'] == 'Moderator') { ?>     
              <li class="li-hover"><div class="divider"></div></li>
              <li class="li-hover"><p class="ultra-small margin more-text">MODERATOR OPTIONS</p></li>  
              <li class="bold">
                <a href="<?=base_url('announcements/create')?>" class="waves-effect waves-cyan">
                  <i class="mdi-content-flag"></i> Create Announcement
                </a>                
              </li>  
              <li class="bold">
                <a href="<?=base_url('events/create')?>" class="waves-effect waves-cyan">
                  <i class="mdi-editor-insert-invitation"></i> Create Event
                </a>
              </li>       
              <?php } ?>            
              
          </ul>         
          <a href="#" data-activates="slide-out" class="sidebar-collapse btn-floating btn-medium waves-effect waves-light hide-on-large-only grey darken-4"><i class="mdi-navigation-menu" ></i></a>
      </aside> 
      <!-- END LEFT SIDEBAR NAV-->


     