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

Class Delete_model extends CI_Model {


  function user() {

          return $this->db->delete('users', array('id' => $this->input->post('id'))); 

    }


  function comment() {
         
          return $this->db->delete('comments', array('id' => $this->input->post('id'))); 

    }


  function events() {
         
          return $this->db->delete('events', array('id' => $this->input->post('id'))); 

    }
    

  function announcement() {
         
          $this->db->delete('comments', array('tag_id' => $this->input->post('id'), 'tag' => 'announcement'));
          return $this->db->delete('announcements', array('id' => $this->input->post('id'))); 

    }  


  function contacts() {
         
          return $this->db->delete('contacts', array('id' => $this->input->post('id'))); 

    }

  function works() {
         
          return $this->db->delete('works', array('id' => $this->input->post('id'))); 

    }

  function year() {
         
          return $this->db->delete('year', array('id' => $this->input->post('id'))); 

    }

  function course() {
         
          return $this->db->delete('course', array('id' => $this->input->post('id'))); 

    }


  function post() {
          $this->db->delete('comments', array('tag_id' => $this->input->post('id'), 'tag' => 'timeline'));
          return $this->db->delete('timeline', array('id' => $this->input->post('id'))); 

    }


}