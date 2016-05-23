<?php
defined('BASEPATH') OR exit('No direct script access allowed');

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

class Verifylogin extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see http://codeigniter.com/user_guide/general/urls.html
	 */

	public function __construct()	{
		parent::__construct();		
		$this->load->model('login_model');
	}	


	function index()	{
		   //This method will have the credentials validation
		 		 
		   $this->form_validation->set_rules('username', 'Username', 'trim|required|xss_clean');
		   $this->form_validation->set_rules('password', 'Password', 'trim|required|xss_clean|callback_check_database');   
		 
		   if($this->form_validation->run() == FALSE)
		   {
		     //Field validation failed.  User redirected to login page
		     $this->load->view('admin_login');
		   }
		   else
		   {
		     //Go to private area
		     redirect('dashboard', 'refresh');
		   }
		 
		 }
		 
	function check_database($password)   {
		   //Field validation succeeded.  Validate against database
		   $username = $this->input->post('username');
		 
		   //query the database
		   $result = $this->login_model->verify_admin($username, $password);
		 
		   if($result)
		   {
		     $sess_array = array();
		     foreach($result as $row)
		     {
		       $sess_array = array(
		         'id' => $row->id,
		         'username' => $row->username
		       );
		       $this->session->set_userdata('logged_in', $sess_array);
		     }
		     //START LOG DATA
			     $session_data 	= $this->session->userdata('logged_in');  
			     $user 	 		= $session_data['id'];		     
			     $this->log_model->last_login($user);
		     //END LOG DATA
		     return TRUE;
		   }
		   else
		   {
		     $this->form_validation->set_message('check_database', 'Invalid username or password');
		     return false;
		   }
		 

 		}


}
