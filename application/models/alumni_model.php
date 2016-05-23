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

class Alumni_Model extends CI_Model {
      function __construct() {
        parent::__construct();
    }
 
   

    function course() {
        
        $query = $this->db->get('course');
        return $query->result_array();

    }


    function year() {
        
        $query = $this->db->get('year');
        return $query->result_array();

    }


    function students() {
        $this->db->select('
            users.id AS id,
            users.student_id,
            users.img,
            users.name,
            users.middlename,
            users.lastname,
            year.name AS year,
            course.name AS course
            ');

        $this->db->join('year', 'users.year_id = year.id', 'left');  
        $this->db->join('course', 'users.course_id = course.id', 'left');
        $this->db->order_by('course.id', 'DESC');
        $this->db->where_not_in('course.id', 0);
        $query = $this->db->get('users');
        return $query->result_array();

    }
  



   
}

?>