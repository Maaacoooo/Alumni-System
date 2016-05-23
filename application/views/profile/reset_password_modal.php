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
<div id="resetpassword" class="modal">
                  <div class="modal-content">                               
                     <div class="row">                       
                        <div class="col s12">
                          <p class="center"> Are you sure to Reset <?=$items['name']?>'s Password?</p>
                        </div>
                     </div>                   
                  </div> <!-- /.modal-content --> 
                  <div class="modal-footer">
                     <?=form_open('users/resetpassword')?>
                        <a href="#" class="waves-effect waves-red btn-flat modal-action modal-close">Disagree</a>
                        <input type="hidden" name="id" value="<?=$items['user_id']?>">                           
                        <button class="btn cyan waves-light modal-action" type="submit">RESET PASSWORD</button>
                     </form>
                  </div>                
                </div>



                <div id="usertype" class="modal">
                  <?=form_open('users/update_usertype')?>
                    <div class="modal-content">                               
                       <div class="row">                       
                          <div class="input-field col s12">
                            <select class="input-field" name="usertype">
                              <option <?php if(!$items['year']){echo 'selected';}?>>Choose Batch Year...</option>                               
                              <option value="Administrator" <?php if($items['usertype']=='Administrator'){echo 'selected';}?>>Administrator</option> 
                              <option value="Moderator" <?php if($items['usertype']=='Moderator'){echo 'selected';}?>>Moderator</option> 
                              <option value="Alumni" <?php if($items['usertype']=='Alumni'){echo 'selected';}?>>Alumni</option> 
                            </select>
                          </div>
                       </div>                   
                    </div> <!-- /.modal-content --> 
                    <div class="modal-footer">                     
                          <a href="#" class="waves-effect waves-red btn-flat modal-action modal-close">Disagree</a>
                          <input type="hidden" name="id" value="<?=$items['user_id']?>">                           
                          <button class="btn cyan waves-light modal-action" type="submit">UPDATE</button>
                       
                    </div>
                  </form>                
                </div>
