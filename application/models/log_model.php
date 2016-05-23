<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

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

################################################################
#
#
# THIS IS A LOG MODEL. Nigguh this is awisaam!!!
#
#
################################################################

Class Log_model extends CI_Model
{


     function log($action, $user, $icon) {


              $data = array(
             'user_id' => $user,
             'tag'    => 'user',
             'icon'   => $icon,
             'action' => $action,
             'ip_address' => $_SERVER['REMOTE_ADDR'],
          );

          $this->db->insert('logs', $data); 
             
        

    }

    function last_login($user) {

    		$data = array(
               'last_login' => now()               
            );

		$this->db->where('id', $user);
		$this->db->update('users', $data); 
    }


    function item($item_action, $user, $id) {

      $data = array(
             'user_id'  => $user,
             'tag_id'   => $id,
             'tag'      => 'item',
             'action'   => $item_action            
          );

          $this->db->insert('logs', $data); 

      $update = array(
               'last_activity' => $item_action               
            );

      $this->db->where('id', $id);
      $this->db->update('items', $update); 

    }


}