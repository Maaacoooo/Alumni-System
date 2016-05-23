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
<!-- Compose Email Structure -->
            <div id="message" class="modal">
              <?=form_open('messages/create')?>
                  <div class="modal-content">
                    <nav class="red">
                      <div class="nav-wrapper">
                        <div class="left col s12 m5 l5">
                          <ul>
                            <li><a href="#!" class="email-menu"><i class="modal-action modal-close  mdi-hardware-keyboard-backspace"></i></a>
                            </li>
                            <li><a href="#!" class="email-type">Compose</a>
                            </li>
                          </ul>
                        </div>
                        <div class="col s12 m7 l7 hide-on-med-and-down">
                          <ul class="right">                        
                            <li><button class="btn-send"><i class="mdi-content-send send"></i></button>
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
                            <input id="to" type="text" class="validate" value="<?=$items['name']?> <?=$items['lastname']?>" disabled>
                            <label for="to">To</label>
                          </div>
                        </div>
                        <div class="row">
                          <div class="input-field col s12">
                            <input id="subject" type="text" name="subject" class="validate">
                            <label for="subject">Subject</label>
                          </div>
                        </div>
                        <input type="hidden" name="recepient_id" value="<?=$items['user_id']?>">
                        <div class="row">
                          <div class="input-field col s12">
                            <textarea id="ckeditor" name="message" class="ckeditor"></textarea>
                          </div>
                        </div>                  
                    </div>
                  </div>
              </form>
            </div>