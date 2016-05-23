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
<div id="course_modal" class="modal">
                  <div class="modal-content">
                    <div class="card-panel">
                      <?=form_open('alumni/create_course')?>
                        <div class="row">
                          <h5 class="header2">Register Course</h5>
                          <div class="input-field col s12">
                            <input type="text" class="validate" name="title" id="title" required>
                            <label for="title">Course Title</label>
                          </div>
                          <div class="input-field col s12">
                            <input type="text" class="validate" name="course_code" id="course_code">
                            <label for="course_code">Course Code</label>
                          </div>
                          <div class="input-field col s12">
                            <button class="btn cyan waves-effect waves-light right" type="submit" name="action">Submit</button>
                          </div>
                        </div>
                      </form>
                    </div>
                    <div class="card-panel">
                      <?=form_open('alumni/create_course')?>
                        <div class="row">
                          <h5 class="header2">Courses</h5>
                          <div class="row">
                            <?php foreach($results as $course):?>               
                              <?=form_open('alumni/update_course')?>
                              <div class="input-field col s5">                              
                                <input id="name" name="name" type="text" class="validate" value="<?=$course['name']?>">
                                <label for="name">Course</label>
                              </div>
                              <div class="input-field col s5">                              
                                <input id="course_code" name="course_code" type="text" class="validate" value="<?=$course['course_code']?>">
                                <label for="course_code">Course Code</label>
                              </div>
                              <div class="input-field col s1">                              
                                  <button class="btn-floating btn-flat amber darken-1 waves-effect waves-light" type="submit" name="action"><i class="mdi-content-save"></i></button>                           
                              </div> 
                                <input type="hidden" name="id" value="<?=$course['id']?>">
                              </form>     
                              <div class="input-field col s1">
                                <?=form_open('alumni/delete_course')?>
                                  <input type="hidden" name="id" value="<?=$course['id']?>">
                                  <button class="btn-floating btn-flat red darken-2 waves-effect waves-light" type="submit"><i class="mdi-content-clear"></i></button>                              
                                </form>
                              </div>  
                            <?php endforeach; ?>
                          </div><!-- /.row -->
                        </div>
                      </form>
                    </div>

                  </div> <!-- /.modal-content -->                 
                </div>
