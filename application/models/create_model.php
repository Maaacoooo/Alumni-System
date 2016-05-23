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

Class Create_model extends CI_Model
{

    function set_user(){

      $password = password_hash($this->input->post('password'), PASSWORD_DEFAULT);

              $file_name = '';

              if($_FILES['userfile']['name'] != NULL)  {        

                $config['upload_path'] = './uploads/';
                $config['allowed_types'] = 'gif|jpg|png'; 
                $config['encrypt_name'] = TRUE;                        

                $this->load->library('upload', $config);
                $this->upload->initialize($config);         
                
                $field_name = "userfile";
                $this->upload->do_upload($field_name);
                $data2 = array('upload_data' => $this->upload->data());
                foreach ($data2 as $key => $value) {     
                  $file_name = $value['file_name'];
                }
                
            }

          $data = array(
              'username' => $this->input->post('username'),
              'password' => $password,
              'name' => ucwords($this->input->post('name')),
              'lastname' => ucwords($this->input->post('lastname')),
              'usertype' => 'Administrator',              
              'img' => $file_name,
              'last_activity' => 'Registered',
              'status' => 'Activated'
            );

          return $this->db->insert('users', $data);

    }

    function set_alumni(){

      //GENERATE USERNAME IF NULL
      if($this->input->post('username')){
        $username = $this->input->post('username');
      } else {
        $username = $this->input->post('id_num');
      }


      //GENERATE PASSWORD IF NULL
      if($this->input->post('password')){
        $password = password_hash($this->input->post('password'), PASSWORD_DEFAULT);
      } else {
        $password = password_hash('1234', PASSWORD_DEFAULT);
      }

              $file_name = '';

              if($_FILES['userfile']['name'] != NULL)  {        

                $config['upload_path'] = './uploads/';
                $config['allowed_types'] = 'gif|jpg|png'; 
                $config['encrypt_name'] = TRUE;                        

                $this->load->library('upload', $config);
                $this->upload->initialize($config);         
                
                $field_name = "userfile";
                $this->upload->do_upload($field_name);
                $data2 = array('upload_data' => $this->upload->data());
                foreach ($data2 as $key => $value) {     
                  $file_name = $value['file_name'];
                }
                
            }

          $data = array(
              'username' => $username,
              'password' => $password,
              'student_id' => $this->input->post('id_num'),
              'year_id' => $this->input->post('year'),
              'course_id' => $this->input->post('course'),
              'name' => ucwords($this->input->post('name')),
              'middlename' => ucwords($this->input->post('middlename')),
              'lastname' => ucwords($this->input->post('lastname')),
              'usertype' => 'Alumni',              
              'img' => $file_name,
              'last_activity' => 'Registered',
              'status' => 'Activated'
            );

           $this->db->insert('users', $data);

           if($this->input->post('mobile')){
            $sontact_data = array(              
              'title'      => 'Mobile',  
              'value'      => $this->input->post('mobile'),             
              'tag_id'   => $this->db->insert_id('users')    
            );


             $this->db->insert('contacts', $sontact_data);

           }

           return true;

    }

    //THIS CHECKS THE USERNAME'S AVAILABILITY
    function check_user($str){

             $this->db->select('*');
             $this->db->from('users');
             $this->db->where('username', $str);          
             $this->db->limit(1);

             $query = $this->db-> get();

             if($query->num_rows() == 1)   {

                  return true;

              } else   {

               return false;

             }

    }

//////////////////////////////////
// COMMENT
//////////////////////////////////

    function comment($user_id){

          $data = array(              
              'comment'         => $this->input->post('comment'),             
              'tag'     => $this->input->post('tag'), 
              'tag_id'       => $this->input->post('id'),
              'user_id'       => $user_id    
            );

          return $this->db->insert('comments', $data);
                   
              
    }

//////////////////////////////////
// ANNOUNCEMENT
//////////////////////////////////

    function announcement($user_id){

          $data = array(              
              'title'         => $this->input->post('title'),              
              'description'   => $this->input->post('description'), 
              'course_id'     => $this->input->post('course'), 
              'year_id'       => $this->input->post('year'),
              'action'        => 'Published',
              'user_id'       => $user_id    
            );

          return $this->db->insert('announcements', $data);
                   
              
    }


//////////////////////////////////
// EVENTS
//////////////////////////////////

    function event($user_id){

          $data = array(              
              'title'         => $this->input->post('title'),              
              'description'   => $this->input->post('description'), 
              'course_id'     => $this->input->post('course'), 
              'year_id'       => $this->input->post('year'),
              'event_date'    => $this->input->post('date'),
              'action'        => 'Published',
              'user_id'       => $user_id    
            );


          return $this->db->insert('events', $data);
                   
              
    }


  
/////////////////////////////////////
// COURSE
////////////////////////////////////

    function course(){

          $data = array(              
              'name'         => $this->input->post('title'),
              'course_code'  => $this->input->post('course_code')
                      
            );

          return $this->db->insert('course', $data);
                   
              
    }


/////////////////////////////////////
// YEAR
////////////////////////////////////

    function year(){

          $data = array(              
              'name'               => 'S.Y ' . $this->input->post('from') . ' - ' . $this->input->post('to')
                      
            );

          return $this->db->insert('year', $data);
                   
              
    }

//////////////////////////////////
// TIMELINE POST
//////////////////////////////////

    function post($user_id){

          $data = array(              
              'post'      => $this->input->post('post'),             
              'user_id'   => $user_id    
            );


          return $this->db->insert('timeline', $data);
                   
              
    }


    function user_contact($user_id){

          $data = array(              
              'title'      => $this->input->post('name'),  
              'value'      => $this->input->post('value'),             
              'tag_id'   => $user_id    
            );


          return $this->db->insert('contacts', $data);


    }     



   function user_work($user_id){

      if(!$this->input->post('ended')){
        $ended = 'Present';
      } else {
        $ended = $this->input->post('ended');
      }


          $data = array(              
              'job_title'      => $this->input->post('title'),  
              'company'      => $this->input->post('company'),  
              'address'      => $this->input->post('address'),  
              'date_started'      => $this->input->post('started'),  
              'date_ended'      => $ended,                         
              'user_id'   => $user_id    
            );


          return $this->db->insert('works', $data);


    } 



    function message($user_id){

      if($this->input->post('id')){

        $id = $this->input->post('id');

        $data = array(              
              'message'      => $this->input->post('message'),  
              'thread_id'    => $id,                         
              'user_id'      => $user_id    
            );


          return $this->db->insert('messages', $data);


      } else {

        $thread = array(              
              'subject'           => $this->input->post('subject'),  
              'recepient_id'      => $this->input->post('recepient_id'), 
              'recepient_status'  => 'unread',          
              'sender_id'         => $user_id    
            );


        $this->db->insert('message_thread', $thread);
        $id = $this->db->insert_id('message_thread');

        $message = array(              
              'message'      => $this->input->post('message'),  
              'thread_id'    => $id,                         
              'user_id'      => $user_id    
            );


         return $this->db->insert('messages', $message);

      }


          


    }                  
           




}