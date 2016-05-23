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
<div id="year_modal" class="modal">
                  <div class="modal-content">
                    <div class="card-panel">
                      <?=form_open('alumni/create_year')?>
                        <div class="row">
                          <h5 class="header2">Register Batch Year</h5>                         
                          <div class="input-field col s4">
                            <input type="number" class="validate" name="from" id="title" required>
                            <label for="title">From Year</label>
                          </div>    
                          <div class="input-field col s4">
                            <input type="number" class="validate" name="to" id="year2" required>
                            <label for="year2">To Year</label>
                          </div>           
                          <div class="input-field col s4">
                            <button class="btn cyan waves-effect waves-light right" type="submit" name="action">Submit</button>
                          </div>
                        </div>
                      </form>
                    </div>
                    <div class="card-panel">                     
                        <div class="row">
                          <h5 class="header2">Batch Years</h5>
                          <div class="row">
                            <?php foreach($results as $year):?>               
                              <?=form_open('alumni/update_year')?>
                              <div class="input-field col s10">                              
                                <input id="name" name="name" type="text" class="validate" value="<?=$year['name']?>">
                                <label for="name">Course</label>
                              </div>                              
                              <div class="input-field col s1">                              
                                  <button class="btn-floating btn-flat amber darken-1 waves-effect waves-light" type="submit" name="action"><i class="mdi-content-save"></i></button>                           
                              </div> 
                                <input type="hidden" name="id" value="<?=$year['id']?>">
                              </form>     
                              <div class="input-field col s1">
                                <?=form_open('alumni/delete_year')?>
                                  <input type="hidden" name="id" value="<?=$year['id']?>">
                                  <button class="btn-floating btn-flat red darken-2 waves-effect waves-light" type="submit"><i class="mdi-content-clear"></i></button>                              
                                </form>
                              </div>  
                            <?php endforeach; ?>
                          </div><!-- /.row -->
                        </div>                     
                    </div>

                  </div> <!-- /.modal-content -->                 
                </div>
