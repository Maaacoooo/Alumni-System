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

Class Update_model extends CI_Model
{

    function user(){

              $file_name = $this->input->post('img');

              if($_FILES['userfile']['name'] != NULL)  {  

                //DELETE OLD PIC
                  if($file_name) {
                  unlink('./uploads/'.$this->input->post('img'));
                 }
                //END DELETE OLD PIC      

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

           //IF CHANGING PASSWORD 
          if($this->input->post('password'))  {
            $password = password_hash($this->input->post('password'), PASSWORD_DEFAULT);

              $data = array(
                  'password' => $password,
                  'name' => ucwords($this->input->post('name')),
                  'usertype' => $this->input->post('usertype'),              
                  'img' => $file_name,
                  'status' => $this->input->post('status'),
                  'status' => 'Activated'
                );

        } else {
          //WITHOUT CHANGING PASSWORD
            $data = array(
                  'name' => ucwords($this->input->post('name')),
                  'usertype' => $this->input->post('usertype'),              
                  'img' => $file_name,
                  'status' => $this->input->post('status'),
                  'status' => 'Activated'
                );

        }

          $this->db->where('id', $this->input->post('id'));
          return $this->db->update('users', $data);

    }


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

    function check_password($str, $id){

             $this->db->select('*');
             $this->db->from('users');
             $this->db->where('id', $id);          
             $this->db->limit(1);

             $query = $this->db-> get();

             if($query->num_rows() == 1)   {

                 //GETS PASSWORD FOR HASHING
                 foreach($query->result() as $rows)    {
                    $hash = $rows->password;
                 }         
                 //VERIFY PASSWORD
                 if (password_verify($str, $hash)) {                                      
                       return true;
                  } else {                     
                       return false;
                  }

              } else   {

               return false;

             }

    }

    function announcement($user_id){

    

          $data = array(              
              'title'         => $this->input->post('title'),              
              'description'   => $this->input->post('description'), 
              'course_id'     => $this->input->post('course'), 
              'year_id'       => $this->input->post('year'),
              'action'        => 'Updated',
              'user_id'       => $user_id    
            );

          $this->db->where('id', $this->input->post('id'));
          return $this->db->update('announcements', $data);

    }


    function event($user_id){

    

          $data = array(              
              'title'         => $this->input->post('title'),              
              'description'   => $this->input->post('description'), 
              'course_id'     => $this->input->post('course'), 
              'year_id'       => $this->input->post('year'),
              'event_date'    => $this->input->post('date'),
              'action'        => 'Updated',
              'user_id'       => $user_id    
            );

          $this->db->where('id', $this->input->post('id'));
          return $this->db->update('events', $data);

    }


    function course(){

    

          $data = array(
              'name'               => $this->input->post('name'),
              'course_code'        => $this->input->post('course_code')              
            );

          $this->db->where('id', $this->input->post('id'));
          return $this->db->update('course', $data);

    }


    function year(){

    

          $data = array(
              'name'               => $this->input->post('name')              
            );

          $this->db->where('id', $this->input->post('id'));
          return $this->db->update('year', $data);

    }



    function resetpassword(){

    

          $data = array(
              'password'  => password_hash('1234', PASSWORD_DEFAULT)             
            );

          $this->db->where('id', $this->input->post('id'));
          return $this->db->update('users', $data);

    }



    function update_usertype(){

    

          $data = array(
              'usertype'  => $this->input->post('usertype')           
            );

          $this->db->where('id', $this->input->post('id'));
          return $this->db->update('users', $data);

    }


    function contacts(){

    

          $data = array(
              'title'               => $this->input->post('name'),
              'value'        => $this->input->post('value')              
            );

          $this->db->where('id', $this->input->post('id'));
          return $this->db->update('contacts', $data);

    }


  function works(){

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
              'date_ended'      => $ended 
            );

          $this->db->where('id', $this->input->post('id'));
          return $this->db->update('works', $data);

    }


  function personal($id){

              $file_name = $this->input->post('img');
              $cover = $this->input->post('cover_img');

              if($_FILES['userfile']['name'] != NULL)  {  

                //DELETE OLD PIC
                  if($file_name) {
                  unlink('./uploads/'.$this->input->post('img'));
                 }
                //END DELETE OLD PIC      

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

            if($_FILES['coverphoto']['name'] != NULL)  {  

                //DELETE OLD PIC
                  if($file_name) {
                  unlink('./uploads/'.$this->input->post('cover_img'));
                 }
                //END DELETE OLD PIC      

                $config['upload_path'] = './uploads/';
                $config['allowed_types'] = 'gif|jpg|png'; 
                $config['encrypt_name'] = TRUE;                        

                $this->load->library('upload', $config);
                $this->upload->initialize($config);         
                
                $field_name = "coverphoto";
                $this->upload->do_upload($field_name);
                $data2 = array('upload_data' => $this->upload->data());
                foreach ($data2 as $key => $value) {     
                  $cover = $value['file_name'];
                }
                
            }

            $data = array(
                  'name' => ucwords($this->input->post('name')),
                  'middlename' => ucwords($this->input->post('middlename')),
                  'lastname' => ucwords($this->input->post('lastname')),
                  'description' => $this->input->post('description'),  
                  'student_id' => $this->input->post('id_num'),              
                  'img' => $file_name,
                  'cover_img' => $cover
                );

        

          $this->db->where('id', $id);
          return $this->db->update('users', $data);

    }


    function login($id){

           //IF CHANGING PASSWORD 
          if($this->input->post('password'))  {
            $password = password_hash($this->input->post('password'), PASSWORD_DEFAULT);

              $data = array(
                  'password' => $password,                  
                  'username' => $this->input->post('username')
                  
                );

        } else {
          //WITHOUT CHANGING PASSWORD
            $data = array(
                  'username' => $this->input->post('username')
                );

        }

          $this->db->where('id', $id);
          return $this->db->update('users', $data);

    }


}