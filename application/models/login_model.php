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

Class Login_model extends CI_Model
{


     function verify_admin($username, $password) {

             $this->db->select('*');
             $this->db->from('users');             
             $this->db->where('status', 'Activated');
             $this->db->where('username', $username);          
             $this->db->limit(1);

             $query = $this->db-> get();

             if($query->num_rows() == 1)   {

              //GETS PASSWORD FOR HASHING
               foreach($query->result() as $rows)    {
                  $hash = $rows->password;
               }
         
               //VERIFY PASSWORD
               if (password_verify($password, $hash)) {
                     return $query->result();
                } else {
                    return false;
                } 
               
             }   else   {

               return false;

             }

    }



}