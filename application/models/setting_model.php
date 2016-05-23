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

class Setting_Model extends CI_Model {
      function __construct() {
        parent::__construct();
    }
    //  Returns USER DETAILS
      public function user($id) {              
                $this->db->from('users');
                $this->db->where('id', $id);
                $query = $this->db-> get();
                return $query->row_array();
    }


    public function sitename() {

            $this->db->where('id', 1);
            $query = $this->db-> get('settings');
            return $query->row_array();

    }
    
  



   
}

?>