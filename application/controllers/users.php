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

class Users extends CI_Controller {

	/*
		ADMIN  MAIN CONTROLLER - USER BASED CONTROLLER
		
	 */
	public function __construct()
	{
		parent::__construct();	

	}	




	///////////////////////////////
	// USERS PART
	///////////////////////////////

	public function index()	{

		if($this->session->userdata('logged_in'))	{

				//PAGE TITLE
		    	$data['title'] = 'Users';
		 
		    	//GET SITE TITLE		    	                  
		        $data['site_title'] = $this->setting_model->sitename()['value'];		                   	         

		    	//USER DETAILS	
		    	$data['id'] = $this->session->userdata('logged_in')['id'];                      
		        $data['user'] = $this->setting_model->user($data['id']);		

		        //PAGINATE ITEMS			            
	   			$config['num_links'] = 5;
				$config['base_url'] = base_url('users/index/');
				$config["total_rows"] = $this->pagination_model->count_users();
				$config['per_page'] = 20;				
				$this->load->config('pagination'); //LOAD PAGINATION CONFIG

				$this->pagination->initialize($config);
		        if($this->uri->segment(3)){
		        $page = ($this->uri->segment(3)) ;
		          }
		        else{
		               $page = 1;
		               
		        }
		        $data["results"] = $this->pagination_model->fetch_users($config["per_page"], $page);
		        $str_links = $this->pagination->create_links();
		        $data["links"] = explode('&nbsp;',$str_links );
		        $data['page'] = $page;
		        //END PAGINATION

		        //ACCESS CONTROL
		        if($data['user']['usertype'] == 'Administrator') {

					//LOAD VIEW		
					$this->load->view('user/users', $data);

				} else {
					//SHOW 404
					show_404();
				}


		} else {
			 //If no session, redirect to login page
			 $this->session->set_flashdata('error', 'Oops! Please login to continue');
		     redirect('login', 'refresh');
	    }

	}

	function create()	{

		if($this->session->userdata('logged_in'))	{

					//PAGE TITLE
			    	$data['title'] = 'Create User';

			    	//GET SITE TITLE		    	                  
			        $data['site_title'] = $this->setting_model->sitename()['value'];		                   	         

			    	//USER DETAILS	
			    	$data['id'] = $this->session->userdata('logged_in')['id'];                      
			        $data['user'] = $this->setting_model->user($data['id']);		

		             //ACTION START		
		             		$this->form_validation->set_rules('username', 'Username', 'callback_username_check');	
		            		$this->form_validation->set_rules('password', 'Password', 'required|matches[confirmpassword]');
		            		$this->form_validation->set_rules('confirmpassword', 'Password Confirmation', 'required');		            		            
		            		$this->form_validation->set_rules('name', 'Name', 'trim|required'); 	    
		            		$this->form_validation->set_rules('lastname', 'Last Name', 'trim|required'); 	           		


							if ($this->form_validation->run() == FALSE) { 								
		        				//ACCESS CONTROL
		        				if($data['user']['usertype'] == 'Administrator') {
									//ERROR OR NULL INPUT -- LOAD VIEW
									$this->load->view('user/create_user', $data);
								}
							}
							else {
								//SUCCESS WITH ANOTHER VALIDATION

								if($this->create_model->set_user()){
									//ULTIMATE SUCCESS

									//START LOG DATA								  
								     $user 	 		= $data['id'];
								     $action 		= 'New '.$this->input->post('usertype').' Added';
								     $icon			= '<i class="fa fa-fw fa-user-plus"></i>';
								     $this->log_model->log($action, $user, $icon);

								    //END LOG DATA


								    //RETURN TO PAGE WITH FLASHDATA. SUCCESS
									$this->session->set_flashdata('success', 'Success! You have created <u>' . ucwords($this->input->post('name')).'</u>');
									redirect($_SERVER['HTTP_REFERER'], 'refresh');

								} else {
									//FAIL SUBMISSION
									$this->session->set_flashdata('error', 'Oops! An Error has occured! Contact the System Administrator!');
									redirect($_SERVER['HTTP_REFERER'], 'refresh');
								}

							}


					//ACTION END		

					

				}
				else   {
				//If no session, redirect to login page
		 	redirect('login', 'refresh');
		 }
		 
	}


	function edit_user($id)	{

		if($this->session->userdata('logged_in'))	{


		        //IF NO ID OR NO RESULT, REDIRECT
				if(!$id OR !$data['items']) {
					redirect('Administrator/users', 'refresh');
				}
		 
		    	//PAGE TITLE
		    	$data['title'] = 'Edit Candidate' . ' : ' . $data['items']['name'];

		    	//GET SITE TITLE		    	                  
		        $data['site_title'] = $this->setting_model->sitename()['value'];		                   	         

		    	//USER DETAILS	
		    	$data['id'] = $this->session->userdata('logged_in')['id'];                      
		        $data['user'] = $this->setting_model->user($data['id']);			
				
				//ACCESS CONTROL
		        if($data['usertype'] == 'Administrator') {

					//LOAD VIEW		
					$this->load->view('Administrator/edit_user', $data);

				} else {
					//SHOW 404
					show_404();
				}


		} else {
			 //If no session, redirect to login page
			 $this->session->set_flashdata('error', 'Oops! Please login to continue');
		     redirect('login', 'refresh');
	    }

	}	




//////////////////////////////////////////
// ACTIONS
/////////////////////////////////////////

	function update_user()	{

		if($this->session->userdata('logged_in'))	{

		             //ACTION START		
			               //IF CHANGING PASSWORD
			                if($this->input->post('password')) {
			                $this->form_validation->set_rules('oldpassword', 'Old Password', 'required|callback_password_check');
		            		$this->form_validation->set_rules('password', 'New Password', 'required|matches[confirmpassword]');
		            		$this->form_validation->set_rules('confirmpassword', 'New Password Confirmation', 'required');
		            		}

		            		$this->form_validation->set_rules('usertype', 'User Profile', 'trim'); 		            
		            		$this->form_validation->set_rules('name', 'Name', 'trim'); 	           		


							if ($this->form_validation->run() == FALSE) { 
								//ERROR								
									$this->session->set_flashdata('error', 'Oops! Please recheck the fields');
									redirect('Administrator/edit_user/'.$this->input->post('id'), 'refresh');
							}
							else {
								//SUCCESS WITH ANOTHER VALIDATION

								if($this->update_model->user()){
									//ULTIMATE SUCCESS

									//START LOG DATA								  
								     $user 	 		= $this->session->userdata('logged_in')['id'];
								     $action 		= 'User Updated';
								     $icon			= '<i class="fa fa-fw fa-user"></i>';
								     $this->log_model->log($action, $user, $icon);

								    //END LOG DATA

								    //END LOG DATA
								    //RETURN TO PAGE WITH FLASHDATA. SUCCESS
									$this->session->set_flashdata('success', 'Success! You have updated <u>' . ucwords($this->input->post('name')).'</u>');
									redirect('Administrator/edit_user/'.$this->input->post('id'), 'refresh');

								} else {
									//FAIL SUBMISSION
									$this->session->set_flashdata('error', 'Oops! An Error has occured! Contact the System Administrator!');
									redirect('Administrator/edit_user/'.$this->input->post('id'), 'refresh');
								}

							}


					//ACTION END		

					

				}
				else   {
				//If no session, redirect to login page
		 	redirect('login', 'refresh');
		 }
		 
	}


	function password_check($str){

		$result = $this->update_model->check_password($str);
		 
		   if(!$result)
		   {	     
		     $this->form_validation->set_message('password_check', 'Password does not match!');
		     return false;
		   }
		else{
			
			return true;
		}		
	}

	

	function username_check($str){

		$result = $this->create_model->check_user($str);
		 
		   if($result)
		   {	     
		     $this->form_validation->set_message('username_check', 'Username already exist!');
		     return false;
		   }
		else{
			
			return true;
		}
		
	}

	function delete()	{

		if($this->session->userdata('logged_in'))	{  		
		     		

		             //ACTION START				             			           

						if($this->delete_model->user()){
									//ULTIMATE SUCCESS		

									//START LOG DATA								  
								     $user 	 		= $this->session->userdata('logged_in')['id'];
								     $action 		= 'Account Deleted';
								     $icon			= '<i class="fa fa-fw fa-user"></i>';
								     $this->log_model->log($action, $user, $icon);

								    //END LOG DATA

								    //RETURN TO PAGE WITH FLASHDATA. SUCCESS
									$this->session->set_flashdata('success', 'Success! You have deleted an Account');
									redirect($_SERVER['HTTP_REFERER'], 'refresh');

								} else {
									//FAIL SUBMISSION
									$this->session->set_flashdata('error', 'Oops! An Error has occured! Contact the System Administrator!');
									redirect($_SERVER['HTTP_REFERER'], 'refresh');
								}						


					//ACTION END							

				}
				else   {
				//If no session, redirect to login page
		 	redirect('login', 'refresh');
		 }

		 
	}

function resetpassword()	{

		if($this->session->userdata('logged_in'))	{  		
		     		

		             //ACTION START				             			           

						if($this->update_model->resetpassword()){
									//ULTIMATE SUCCESS		

									//START LOG DATA								  
								     $user 	 		= $this->session->userdata('logged_in')['id'];
								     $action 		= 'Resetted Password';
								     $icon			= '<i class="fa fa-fw fa-user"></i>';
								     $this->log_model->log($action, $user, $icon);

								    //END LOG DATA

								    //RETURN TO PAGE WITH FLASHDATA. SUCCESS
									$this->session->set_flashdata('success', 'Success! You have Resetted the Account Password. Password was set to <em><u> 1234 </u></em>');
									redirect($_SERVER['HTTP_REFERER'], 'refresh');

								} else {
									//FAIL SUBMISSION
									$this->session->set_flashdata('error', 'Oops! An Error has occured! Contact the System Administrator!');
									redirect($_SERVER['HTTP_REFERER'], 'refresh');
								}						


					//ACTION END							

				}
				else   {
				//If no session, redirect to login page
		 	redirect('login', 'refresh');
		 }

		 
	}

function update_usertype()	{

		if($this->session->userdata('logged_in'))	{  		
		     		

		             //ACTION START				             			           

						if($this->update_model->update_usertype()){
									//ULTIMATE SUCCESS		

									//START LOG DATA								  
								     $user 	 		= $this->session->userdata('logged_in')['id'];
								     $action 		= 'Updated an Account';
								     $icon			= '<i class="fa fa-fw fa-user"></i>';
								     $this->log_model->log($action, $user, $icon);

								    //END LOG DATA

								    //RETURN TO PAGE WITH FLASHDATA. SUCCESS
									$this->session->set_flashdata('success', 'Success! You have updated an Account');
									redirect($_SERVER['HTTP_REFERER'], 'refresh');

								} else {
									//FAIL SUBMISSION
									$this->session->set_flashdata('error', 'Oops! An Error has occured! Contact the System Administrator!');
									redirect($_SERVER['HTTP_REFERER'], 'refresh');
								}						


					//ACTION END							

				}
				else   {
				//If no session, redirect to login page
		 	redirect('login', 'refresh');
		 }

		 
	}



}