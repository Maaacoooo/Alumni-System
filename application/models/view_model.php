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

Class View_model extends CI_Model
{


    function get_user($id) {         
          $query = $this->db->get_where('users', array('id' => $id));
          return $query->row_array();
    }

    function year($id) {         
          $query = $this->db->get_where('year', array('id' => $id));
          return $query->row_array();
    }

    function course($id) {         
          $query = $this->db->get_where('course', array('id' => $id));
          return $query->row_array();
    }

    function get_contact($id) {         
          $query = $this->db->get_where('contacts', array('tag_id' => $id));
          return $query->result_array();
    }

    function get_work($id) {         
          $query = $this->db->get_where('works', array('user_id' => $id));
          return $query->result_array();
    }

    function get_message_thread($id) {         
          $query = $this->db->get_where('message_thread', array('id' => $id));
          return $query->row_array();
    }

    function get_messages($id) { 
          $this->db->join('users', 'users.id = messages.user_id', 'left');           
          $query = $this->db->get_where('messages', array('thread_id' => $id));
          return $query->result_array();
    }


    function get_profile($id) {  
          $this->db->select('  
            users.id AS user_id,
            users.username,
            users.usertype,            
            users.name,
            users.middlename,
            users.lastname, 
            users.description,  
            users.student_id, 
            users.img,
            users.cover_img,           
            year.name AS year,
            course.name AS course
            ');      
          $this->db->where('users.id', $id);            
          $this->db->join('year', 'users.year_id = year.id', 'left');  
          $this->db->join('course', 'users.course_id = course.id', 'left');    
          $query = $this->db->get('users');
          return $query->row_array();
    }



    function get_announcement($id) {  
          $this->db->select('  
            announcements.id AS id,
            announcements.action,
            announcements.title, 
            announcements.year_id, 
            announcements.course_id,            
            announcements.description,
            announcements.date_time AS date_time,         
            users.id AS user_id,            
            users.name,
            users.lastname,            
            year.name AS year,
            course.name AS course
            ');      
          $this->db->where('announcements.id', $id);
          $this->db->join('users', 'users.id = announcements.user_id', 'left');     
          $this->db->join('year', 'announcements.year_id = year.id', 'left');  
          $this->db->join('course', 'announcements.course_id = course.id', 'left');    
          $query = $this->db->get('announcements');
          return $query->row_array();
    }



    function get_event($id) {  
          $this->db->select('  
            events.id AS id,
            events.action,
            events.title, 
            events.year_id, 
            events.event_date, 
            events.course_id,            
            events.description,
            events.date_time AS date_time,         
            users.id AS user_id,            
            users.name,
            users.lastname,            
            year.name AS year,
            course.name AS course
            ');      
          $this->db->where('events.id', $id);
          $this->db->join('users', 'users.id = events.user_id', 'left');     
          $this->db->join('year', 'events.year_id = year.id', 'left');  
          $this->db->join('course', 'events.course_id = course.id', 'left');    
          $query = $this->db->get('events');
          return $query->row_array();
    }



    function get_comment_timeline($id)  {
          $this->db->select('
          comments.id as comment_id,
          comments.comment,
          users.id AS user_id,
          users.img,
          users.name,
          users.lastname,
          comments.date_time AS date_time,
          year.name AS year,
          course.name AS course
          ');
          $this->db->order_by('comments.id', 'DESC');
          $this->db->where('comments.tag_id', $id);
          $this->db->where('comments.tag', 'timeline');
          $this->db->join('users', 'users.id = comments.user_id', 'left');     
          $this->db->join('year', 'users.year_id = year.id', 'left');  
          $this->db->join('course', 'users.course_id = course.id', 'left');   
          $query = $this->db->get("comments");
          return $query->result_array();
    }


    function search_alumni()  { 
        $this->db->select('
            users.id AS id,
            users.img,
            users.name,
            users.lastname,
            users.last_activity,
            users.last_activity_stamp,       
            year.name AS year,
            course.name AS course
            ');

        $this->db->join('year', 'users.year_id = year.id', 'left');  
        $this->db->join('course', 'users.course_id = course.id', 'left');

        $this->db->like('users.name', $this->input->post('search'), 'after'); 
        $this->db->or_like('users.middlename', $this->input->post('search'), 'after'); 
        $this->db->or_like('users.lastname', $this->input->post('search'), 'after'); 
        $this->db->or_like('users.student_id', $this->input->post('search')); 

        $this->db->or_like('course.name', $this->input->post('search'), 'after'); 
        $this->db->or_like('year.name', $this->input->post('search')); 

        $query = $this->db->get("users");
        return $query->result_array();
    }





}