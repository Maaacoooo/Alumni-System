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

class Pagination_Model extends CI_Model {
      function __construct() {
        parent::__construct();
    }

    // Count all USERS.
      public function count_users() {
        $this->db->where('usertype', 'Administrator');
        return $this->db->count_all_results("users");
    }
    
    // Fetch data according to per_page limit.
    public function fetch_users($limit, $id) {
        
        $this->db->limit($limit, (($id-1)*$limit));    
        $this->db->where('usertype', 'Administrator');
        $query = $this->db->get("users");
        if ($query->num_rows() > 0) {
             return $query->result_array();
        }
        return false;
   }

   // Count all ALUMNI.
      public function count_alumni() {
        $this->db->where('usertype', 'Alumni');
        $this->db->or_where('usertype', 'Moderator');
        return $this->db->count_all_results("users");
    }
    
    // Fetch data according to per_page limit.
    public function fetch_alumni($limit, $id) {
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
        
        $this->db->limit($limit, (($id-1)*$limit));    
        $this->db->where('usertype', 'Alumni');
        $this->db->or_where('usertype', 'Moderator');
        $query = $this->db->get("users");
        if ($query->num_rows() > 0) {
             return $query->result_array();
        }
        return false;
   }

   // Count all ALUMNI.
      public function count_alumni_request($request, $request_id) {
        $this->db->where($request, $request_id);
        $this->db->where('usertype', 'Alumni');
        $this->db->or_where('usertype', 'Moderator');
        return $this->db->count_all_results("users");
    }
    
    // Fetch data according to per_page limit.
    public function fetch_alumni_request($limit, $id, $request, $request_id) {
        
        $this->db->limit($limit, (($id-1)*$limit));    
        $this->db->where($request, $request_id);
        $this->db->where('usertype', 'Alumni');
        $this->db->or_where('usertype', 'Moderator');
        $query = $this->db->get("users");
        if ($query->num_rows() > 0) {
             return $query->result_array();
        }
        return false;
   }


   // Count all YEAR.
      public function count_year() {
        return $this->db->count_all("year");
    }
    
    // Fetch data according to per_page limit.
    public function fetch_year($limit, $id) {
        $this->db->limit($limit, (($id-1)*$limit));    
        $query = $this->db->get("year");
        if ($query->num_rows() > 0) {
             return $query->result_array();
        }
        return false;
   }

   // Count all COURSE.
      public function count_course() {
        return $this->db->count_all("course");
    }
    
    // Fetch data according to per_page limit.
    public function fetch_course($limit, $id) {
        $this->db->limit($limit, (($id-1)*$limit));    
        $query = $this->db->get("course");
        if ($query->num_rows() > 0) {
             return $query->result_array();
        }
        return false;
   }




   // Count all ITEMS.
      public function count_timeline() {
        return $this->db->count_all("timeline");
    }
    
    // Fetch data according to per_page limit.
    public function fetch_timeline($limit, $id) {
        $this->db->select('
            timeline.id AS id,
            users.id AS user_id,
            users.img,
            users.name,
            users.lastname,
            timeline.post,
            timeline.date_time AS date_time,
            year.name AS year,
            course.name AS course
            ');
        $this->db->limit($limit, (($id-1)*$limit));       
        $this->db->join('users', 'users.id = timeline.user_id', 'left');     
        $this->db->join('year', 'users.year_id = year.id', 'left');  
        $this->db->join('course', 'users.course_id = course.id', 'left');
        $this->db->order_by('timeline.id', 'DESC');     
        $query = $this->db->get("timeline");
        if ($query->num_rows() > 0) {
            return $query->result_array();
        }
        return false;
   }


   function count_comments($id, $tag) {      
        $this->db->where('comments.tag', $tag);   
        $this->db->where('comments.tag_id', $id);
        return $this->db->count_all_results('comments');

    }
    
    // Fetch data according to per_page limit.
    public function fetch_comments($limit, $id, $request_id, $tag) {        

        $this->db->limit($limit, (($id-1)*$limit));
        $this->db->select(' 
            comments.id,
            comments.comment,
            comments.date_time AS date_time,         
            users.id AS user_id,  
            users.img,          
            users.name,
            users.lastname,
            year.name AS year,
            course.name AS course
            ');   
          $this->db->where('comments.tag', $tag);   
          $this->db->where('comments.tag_id', $request_id);
          $this->db->join('users', 'users.id = comments.user_id', 'left');     
          $this->db->join('year', 'users.year_id = year.id', 'left');  
          $this->db->join('course', 'users.course_id = course.id', 'left');    
          $this->db->order_by('comments.id', 'DESC');
          $query = $this->db->get('comments');
        
            if ($query->num_rows() > 0) {
                return $query->result_array();
            }
            return false;
   }


   function count_announcements() {    
        return $this->db->count_all('announcements');

    }
    
    // Fetch data according to per_page limit.
    public function fetch_announcements($limit, $id, $user) {

      if($user['usertype']!='Administrator'){
          $this->db->where('announcements.course_id', $user['course_id']);
        }        

        $this->db->limit($limit, (($id-1)*$limit));
        $this->db->select(' 
            announcements.id,
            announcements.title,
            announcements.description,
            announcements.action,
            announcements.date_time AS date_time,         
            users.id AS user_id,        
            users.name,
            users.lastname,
            year.name AS year,
            course.name AS course
            ');   
          $this->db->join('users', 'users.id = announcements.user_id', 'left');     
          $this->db->join('year', 'announcements.year_id = year.id', 'left');  
          $this->db->join('course', 'announcements.course_id = course.id', 'left');  
          $this->db->order_by('announcements.date_time', 'DESC');
          $query = $this->db->get('announcements');
        
            if ($query->num_rows() > 0) {
                return $query->result_array();
            }
            return false;
   }


   function count_events() {    
        return $this->db->count_all('announcements');

    }
    
    // Fetch data according to per_page limit.
    public function fetch_events($limit, $id, $user) {        

        if($user['usertype']!='Administrator'){
          $this->db->where('events.course_id', $user['course_id']);
        }
        
        

        $this->db->limit($limit, (($id-1)*$limit));
        $this->db->select(' 
            events.id,
            events.title,
            events.description,
            events.action,
            events.event_date,
            events.date_time AS date_time,         
            users.id AS user_id,        
            users.name,
            users.lastname,
            year.name AS year,
            course.name AS course
            ');   
          $this->db->join('users', 'users.id = events.user_id', 'left');     
          $this->db->join('year', 'events.year_id = year.id', 'left');  
          $this->db->join('course', 'events.course_id = course.id', 'left');  
          $this->db->order_by('events.date_time', 'DESC');
          $query = $this->db->get('events');
        
            if ($query->num_rows() > 0) {
                return $query->result_array();
            }
            return false;
   }


   function count_message_threads($request_id) {    
        $this->db->where('recepient_id', $request_id);
        $this->db->or_where('sender_id', $request_id);
        return $this->db->count_all_results('message_thread');

    }
    
    // Fetch data according to per_page limit.
    public function fetch_message_threads($limit, $id, $request_id) {      


        $this->db->where('recepient_id', $request_id);
        $this->db->or_where('sender_id', $request_id);
        $this->db->limit($limit, (($id-1)*$limit));
        $this->db->select(' 
            message_thread.id AS thread_id,
            message_thread.recepient_status,
            message_thread.subject,
            message_thread.timestamp,
            message_thread.recepient_status,         
            users.name,
            users.lastname,
            users.img      
            ');   
          $this->db->join('users', 'users.id = message_thread.sender_id', 'left');    
          $this->db->order_by('message_thread.timestamp', 'DESC');
          $query = $this->db->get('message_thread');
        
            if ($query->num_rows() > 0) {
                return $query->result_array();
            }
            return false;
   }




   
}
?>