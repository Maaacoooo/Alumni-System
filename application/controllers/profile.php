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

class Profile extends CI_Controller {

	/*
	 THIS IS THE MAIN ITEMS CONTROLLER
	 ACTIONS:
	 	CREATE
	 	UPDATE
	 	DELETE
	 */
	public function __construct()	{
		parent::__construct();		
       $this->load->model('alumni_model'); // LOAD ITEM MODEL
	}	


	public function index()	{
		if($this->session->userdata('logged_in'))	{

				//USER DETAILS	
		    	$data['id'] = $this->session->userdata('logged_in')['id'];                      
		        $data['user'] = $this->setting_model->user($data['id']);

		    	//FETCH DATA
		    	$data['items'] = $this->view_model->get_profile($data['id']);
		    	$data['works'] = $this->view_model->get_work($data['id']);
		    	$data['contacts'] = $this->view_model->get_contact($data['id']);
		    	//PAGE TITLE
		    	$data['title'] = $data['items']['name'] . ' ' . $data['items']['middlename'] . ' ' . $data['items']['lastname'];

		    	//GET SITE TITLE		    	                  
		        $data['site_title'] = $this->setting_model->sitename()['value'];	                   	         

				//REQUEST
				$tag = 'profile';
		        $request_id = $data['id'];	

		        //TOTAL COMMENTS	        
		        $data['total_comments'] = $this->pagination_model->count_comments($request_id, $tag);
		        //PAGINATE ITEMS			            
	   			$config['num_links'] = 5;
				$config['base_url'] = base_url('profile/comment/');
				$config["total_rows"] = $data['total_comments']; //BASED ON $total_comments
				$config['per_page'] = 15;
				$config['uri_segment'] = 3;				
				$this->load->config('pagination'); //LOAD PAGINATION CONFIG

				$this->pagination->initialize($config);
		        if($this->uri->segment(3)){
		        $page = ($this->uri->segment(3)) ;
		          }
		        else{
		               $page = 1;
		               
		        }
		        
		        $data["comments"] = $this->pagination_model->fetch_comments($config["per_page"], $page, $request_id, $tag);
		        $str_links = $this->pagination->create_links();
		        $data["links"] = explode('&nbsp;',$str_links );

		        //END PAGINATION

				//LOAD VIEW				
				$this->load->view('profile/view', $data);
				


		} else {
			 //If no session, redirect to login page
			 $this->session->set_flashdata('error', 'Oops! Please login to continue');
		     redirect('login', 'refresh');
	    } 

	}



	public function view($id)	{

		if($this->session->userdata('logged_in'))	{
								
				//USER DETAILS	
		    	$data['id'] = $this->session->userdata('logged_in')['id'];                      
		        $data['user'] = $this->setting_model->user($data['id']);

		    	//FETCH DATA
		    	$data['items'] = $this->view_model->get_profile($id);
		    	$data['works'] = $this->view_model->get_work($id);
		    	$data['contacts'] = $this->view_model->get_contact($id);

		    	//IF NO ID OR NO RESULT, REDIRECT
				if(!$id OR !$data['items']) {
					redirect('dashboard', 'refresh');
				}


		    	//PAGE TITLE
		    	$data['title'] = $data['items']['name'] . ' ' . $data['items']['middlename'] . ' ' . $data['items']['lastname'];

		    	//GET SITE TITLE		    	                  
		        $data['site_title'] = $this->setting_model->sitename()['value'];	                   	         

				//REQUEST
				$tag = 'profile';
		        $request_id = $id;	

		        //TOTAL COMMENTS	        
		        $data['total_comments'] = $this->pagination_model->count_comments($request_id, $tag);
		        //PAGINATE ITEMS			            
	   			$config['num_links'] = 5;
				$config['base_url'] = base_url('profile/view/'.$id.'comment/');
				$config["total_rows"] = $data['total_comments']; //BASED ON $total_comments
				$config['per_page'] = 15;
				$config['uri_segment'] = 5;				
				$this->load->config('pagination'); //LOAD PAGINATION CONFIG

				$this->pagination->initialize($config);
		        if($this->uri->segment(5)){
		        $page = ($this->uri->segment(5)) ;
		          }
		        else{
		               $page = 1;
		               
		        }
		        
		        $data["comments"] = $this->pagination_model->fetch_comments($config["per_page"], $page, $request_id, $tag);
		        $str_links = $this->pagination->create_links();
		        $data["links"] = explode('&nbsp;',$str_links );

		        //END PAGINATION

				//LOAD VIEW				
				$this->load->view('profile/view', $data);
			


		} else {
			 //If no session, redirect to login page
			 $this->session->set_flashdata('error', 'Oops! Please login to continue');
		     redirect('login', 'refresh');
	    }

	}



	public function settings()	{
		if($this->session->userdata('logged_in'))	{

				//USER DETAILS	
		    	$data['id'] = $this->session->userdata('logged_in')['id'];                      
		        $data['user'] = $this->setting_model->user($data['id']);

		    	//FETCH DATA
		    	$data['items'] = $this->view_model->get_profile($data['id']);
		    	$data['works'] = $this->view_model->get_work($data['id']);
		    	$data['contacts'] = $this->view_model->get_contact($data['id']);
		    	//PAGE TITLE
		    	$data['title'] = 'Account Settings';

		    	//GET SITE TITLE		    	                  
		        $data['site_title'] = $this->setting_model->sitename()['value'];	                   	         


				//LOAD VIEW				
				$this->load->view('profile/settings', $data);
				


		} else {
			 //If no session, redirect to login page
			 $this->session->set_flashdata('error', 'Oops! Please login to continue');
		     redirect('login', 'refresh');
	    } 

	}


	function create_contact()	{

		if($this->session->userdata('logged_in'))	{

		             //ACTION START		
		             	$this->form_validation->set_rules('name', 'Title', 'required');		             		
		            		
		            		//USER DETAILS	
					    	$data['id'] = $this->session->userdata('logged_in')['id'];                      
					        $data['user'] = $this->setting_model->user($data['id']);
		            		

							if ($this->form_validation->run() == FALSE) { 
								//LOAD VIEW
								if($data['user']['usertype'] == 'Administrator' 				        							        	
						        	 ) {
									//ERROR
									$this->session->set_flashdata('error', 'Oops! Please recheck the fields');
									redirect($_SERVER['HTTP_REFERER'], 'refresh');
									
								} else {
									show_404();
								}
							}
							else {
								//SUCCESS WITH ANOTHER VALIDATION

								if($this->create_model->user_contact($data['id'])){
									
									//ULTIMATE SUCCESS

									//START LOG DATA								  
								     $user 	 		= $data['id'];
								     $action 		= 'Created New Contact';
								     $icon			= '<i class="mdi-content-flag"></i>';
								     $this->log_model->log($action, $user, $icon);

								    //END LOG DATA
																	
								    //RETURN TO PAGE WITH FLASHDATA. SUCCESS
									$this->session->set_flashdata('success', 'Success! You have created a contact');
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


	function delete_contact()	{

		if($this->session->userdata('logged_in'))	{  	

		             //ACTION START				             			           

						if($this->delete_model->contacts()){
									//ULTIMATE SUCCESS		

									//START LOG DATA								  
								     $user 	 		= $this->session->userdata('logged_in')['id'];
								     $action 		= 'Deleted a Contact';
								     $icon			= '';
								     $this->log_model->log($action, $user, $icon);

								    //END LOG DATA

								    //RETURN TO PAGE WITH FLASHDATA. SUCCESS
									$this->session->set_flashdata('success', 'Success! You have deleted a Contact');
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

	function update_contact()	{

		if($this->session->userdata('logged_in'))	{  	

		             //ACTION START				             			           

						if($this->update_model->contacts()){
									//ULTIMATE SUCCESS		

									//START LOG DATA								  
								     $user 	 		= $this->session->userdata('logged_in')['id'];
								     $action 		= 'Updated a Contact';
								     $icon			= '';
								     $this->log_model->log($action, $user, $icon);

								    //END LOG DATA

								    //RETURN TO PAGE WITH FLASHDATA. SUCCESS
									$this->session->set_flashdata('success', 'Success! You have Updated a Contact');
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



	function create_work()	{

		if($this->session->userdata('logged_in'))	{

		             //ACTION START		
		             	$this->form_validation->set_rules('title', 'Title', 'required');		             		
		            		
		            		//USER DETAILS	
					    	$data['id'] = $this->session->userdata('logged_in')['id'];                      
					        $data['user'] = $this->setting_model->user($data['id']);
		            		

							if ($this->form_validation->run() == FALSE) { 
								//LOAD VIEW
								if($data['user']['usertype'] == 'Administrator' 				        							        	
						        	 ) {
									//ERROR
									$this->session->set_flashdata('error', 'Oops! Please recheck the fields');
									redirect($_SERVER['HTTP_REFERER'], 'refresh');
									
								} else {
									show_404();
								}
							}
							else {
								//SUCCESS WITH ANOTHER VALIDATION

								if($this->create_model->user_work($data['id'])){
									
									//ULTIMATE SUCCESS

									//START LOG DATA								  
								     $user 	 		= $data['id'];
								     $action 		= 'Created New Work';
								     $icon			= '<i class="mdi-content-flag"></i>';
								     $this->log_model->log($action, $user, $icon);

								    //END LOG DATA
																	
								    //RETURN TO PAGE WITH FLASHDATA. SUCCESS
									$this->session->set_flashdata('success', 'Success! You have created a Work');
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


	function delete_work()	{

		if($this->session->userdata('logged_in'))	{  	

		             //ACTION START				             			           

						if($this->delete_model->works()){
									//ULTIMATE SUCCESS		

									//START LOG DATA								  
								     $user 	 		= $this->session->userdata('logged_in')['id'];
								     $action 		= 'Deleted a Work';
								     $icon			= '';
								     $this->log_model->log($action, $user, $icon);

								    //END LOG DATA

								    //RETURN TO PAGE WITH FLASHDATA. SUCCESS
									$this->session->set_flashdata('success', 'Success! You have deleted a Work');
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

	function update_work()	{

		if($this->session->userdata('logged_in'))	{  	

		             //ACTION START				             			           

						if($this->update_model->works()){
									//ULTIMATE SUCCESS		

									//START LOG DATA								  
								     $user 	 		= $this->session->userdata('logged_in')['id'];
								     $action 		= 'Updated a Work';
								     $icon			= '';
								     $this->log_model->log($action, $user, $icon);

								    //END LOG DATA

								    //RETURN TO PAGE WITH FLASHDATA. SUCCESS
									$this->session->set_flashdata('success', 'Success! You have Updated a Work');
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

	function update()	{

		if($this->session->userdata('logged_in'))	{  	

			//USER DETAILS	
					    	$data['id'] = $this->session->userdata('logged_in')['id'];                      
					        $data['user'] = $this->setting_model->user($data['id']);

		             //ACTION START				             			           

						if($this->update_model->personal($data['id'])){
									//ULTIMATE SUCCESS		

									//START LOG DATA								  
								     $user 	 		= $this->session->userdata('logged_in')['id'];
								     $action 		= 'Updated his Profile';
								     $icon			= '';
								     $this->log_model->log($action, $user, $icon);

								    //END LOG DATA

								    //RETURN TO PAGE WITH FLASHDATA. SUCCESS
									$this->session->set_flashdata('success', 'Success! You have Updated your Profile');
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

//////////////////////////////////////////
// ACTIONS
/////////////////////////////////////////

	function login_update()	{

		if($this->session->userdata('logged_in'))	{

					//USER DETAILS	
					    $data['id'] = $this->session->userdata('logged_in')['id'];                      
					    $data['user'] = $this->setting_model->user($data['id']);

		             //ACTION START		
			               //IF CHANGING PASSWORD
			                if($this->input->post('password')){ 
			                	$this->form_validation->set_rules('username', 'Username', 'required'); 
				                $this->form_validation->set_rules('oldpassword', 'Old Password', 'required|callback_password_check');   	                
			            		$this->form_validation->set_rules('password', 'New Password', 'required|matches[confirmpassword]');
			            		$this->form_validation->set_rules('confirmpassword', 'New Password Confirmation', 'required');
		            		} else {

			            		$this->form_validation->set_rules('oldpassword', 'Old Password', 'required|callback_password_check'); 
		            			$this->form_validation->set_rules('username', 'Username', 'required|callback_username_check'); 
		            			

		            		}



		            		          		


							if ($this->form_validation->run() == FALSE) { 
								//ERROR								
									$this->session->set_flashdata('error', 'Oops! Please recheck the fields');
									redirect($_SERVER['HTTP_REFERER'], 'refresh');
							}
							else {
								//SUCCESS WITH ANOTHER VALIDATION

								if($this->update_model->login($data['id'])){
									//ULTIMATE SUCCESS

									//START LOG DATA								  
								     $user 	 		= $this->session->userdata('logged_in')['id'];
								     $action 		= 'Login Information Updated';
								     $icon			= '<i class="fa fa-fw fa-user"></i>';
								     $this->log_model->log($action, $user, $icon);

								    //END LOG DATA

								    //END LOG DATA
								    //RETURN TO PAGE WITH FLASHDATA. SUCCESS
									$this->session->set_flashdata('success', 'Success! You have updated your Login Information');
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


	function password_check($str){

		//USER DETAILS	
		$data['id'] = $this->session->userdata('logged_in')['id'];   

		$result = $this->update_model->check_password($str, $data['id']);
		 
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

		$result = $this->update_model->check_user($str);
		 
		   if($result)
		   {	     
		     $this->form_validation->set_message('username_check', 'Username already exist!');
		     return false;
		   }
		else{
			
			return true;
		}
		
	}


}