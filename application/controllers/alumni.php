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

class Alumni extends CI_Controller {

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

				//PAGE TITLE
		    	$data['title'] = 'Alumni';
		 
		    	//GET SITE TITLE		    	                  
		        $data['site_title'] = $this->setting_model->sitename()['value'];		                   	         

		    	//USER DETAILS	
		    	$data['id'] = $this->session->userdata('logged_in')['id'];                      
		        $data['user'] = $this->setting_model->user($data['id']);		

		        //PAGINATE ITEMS			            
	   			$config['num_links'] = 5;
				$config['base_url'] = base_url('alumni/index/');
				$config["total_rows"] = $this->pagination_model->count_alumni();
				$config['per_page'] = 15;				
				$this->load->config('pagination'); //LOAD PAGINATION CONFIG

				$this->pagination->initialize($config);
		        if($this->uri->segment(3)){
		        $page = ($this->uri->segment(3)) ;
		          }
		        else{
		               $page = 1;
		               
		        }
		        $data["results"] = $this->pagination_model->fetch_alumni($config["per_page"], $page);
		        $str_links = $this->pagination->create_links();
		        $data["links"] = explode('&nbsp;',$str_links );
		        $data['page'] = $page;
		        //END PAGINATION


				//LOAD VIEW		
				$this->load->view('alumni/alumni', $data);


		} else {
			 //If no session, redirect to login page
			 $this->session->set_flashdata('error', 'Oops! Please login to continue');
		     redirect('login', 'refresh');
	    }

	}

	public function year($id)	{

		if($this->session->userdata('logged_in'))	{

				//FETCH DATA
				$data['items'] = $this->view_model->year($id);

				//IF NO ID OR NO RESULT, REDIRECT
				if(!$id OR !$data['items']) {
					redirect('alumni', 'refresh');
				}

				//PAGE TITLE
		    	$data['title'] = 'Batch Year &middot;' . ' ' . $data['items']['name'];
		 
		    	//GET SITE TITLE		    	                  
		        $data['site_title'] = $this->setting_model->sitename()['value'];		                   	         

		    	//USER DETAILS	
		    	$data['id'] = $this->session->userdata('logged_in')['id'];                      
		        $data['user'] = $this->setting_model->user($data['id']);	

		        //REQUEST	
		        $request = 'year_id';
		        $request_id = $id;

		        //PAGINATE ITEMS			            
	   			$config['num_links'] = 5;
				$config['base_url'] = base_url('alumni/year/'.$id.'/page/');
				$config["total_rows"] = $this->pagination_model->count_alumni_request($request, $request_id);
				$config['per_page'] = 20;				
				$this->load->config('pagination'); //LOAD PAGINATION CONFIG
				$config['uri_segment'] = 5;	
				$this->pagination->initialize($config);
		        if($this->uri->segment(5)){
		        $page = ($this->uri->segment(5)) ;
		          }
		        else{
		               $page = 1;
		               
		        }
		        $data["results"] = $this->pagination_model->fetch_alumni_request($config["per_page"], $page, $request, $request_id);
		        $str_links = $this->pagination->create_links();
		        $data["links"] = explode('&nbsp;',$str_links );
		        $data['page'] = $page;
		        //END PAGINATION

		        //ACCESS CONTROL
		        if($data['user']['usertype'] == 'Administrator') {

					//LOAD VIEW		
					$this->load->view('alumni/alumni', $data);

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

	public function course($id)	{

		if($this->session->userdata('logged_in'))	{

				//FETCH DATA
				$data['items'] = $this->view_model->course($id);

				//IF NO ID OR NO RESULT, REDIRECT
				if(!$id OR !$data['items']) {
					redirect('alumni', 'refresh');
				}

				//PAGE TITLE
		    	$data['title'] = 'Course &middot;' . ' ' . $data['items']['name'];
		 
		    	//GET SITE TITLE		    	                  
		        $data['site_title'] = $this->setting_model->sitename()['value'];		                   	         

		    	//USER DETAILS	
		    	$data['id'] = $this->session->userdata('logged_in')['id'];                      
		        $data['user'] = $this->setting_model->user($data['id']);	

		        //REQUEST	
		        $request = 'course_id';
		        $request_id = $id;

		        //PAGINATE ITEMS			            
	   			$config['num_links'] = 5;
				$config['base_url'] = base_url('alumni/course/'.$id.'/page/');
				$config["total_rows"] = $this->pagination_model->count_alumni_request($request, $request_id);
				$config['per_page'] = 20;				
				$this->load->config('pagination'); //LOAD PAGINATION CONFIG
				$config['uri_segment'] = 5;	
				$this->pagination->initialize($config);
		        if($this->uri->segment(5)){
		        $page = ($this->uri->segment(5)) ;
		          }
		        else{
		               $page = 1;
		               
		        }
		        $data["results"] = $this->pagination_model->fetch_alumni_request($config["per_page"], $page, $request, $request_id);
		        $str_links = $this->pagination->create_links();
		        $data["links"] = explode('&nbsp;',$str_links );
		        $data['page'] = $page;
		        //END PAGINATION

		        //ACCESS CONTROL
		        if($data['user']['usertype'] == 'Administrator') {

					//LOAD VIEW		
					$this->load->view('alumni/alumni', $data);

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


	public function years()	{

		if($this->session->userdata('logged_in'))	{

				//PAGE TITLE
		    	$data['title'] = 'Alumni';
		 
		    	//GET SITE TITLE		    	                  
		        $data['site_title'] = $this->setting_model->sitename()['value'];		                   	         

		    	//USER DETAILS	
		    	$data['id'] = $this->session->userdata('logged_in')['id'];                      
		        $data['user'] = $this->setting_model->user($data['id']);

		        //FETCH DATA
			    $data['years'] = $this->alumni_model->year();

		        //PAGINATE ITEMS			            
	   			$config['num_links'] = 5;
				$config['base_url'] = base_url('alumni/year/');
				$config["total_rows"] = $this->pagination_model->count_year();
				$config['per_page'] = 15;				
				$this->load->config('pagination'); //LOAD PAGINATION CONFIG

				$this->pagination->initialize($config);
		        if($this->uri->segment(3)){
		        $page = ($this->uri->segment(3)) ;
		          }
		        else{
		               $page = 1;
		               
		        }
		        $data["results"] = $this->pagination_model->fetch_year($config["per_page"], $page);
		        $str_links = $this->pagination->create_links();
		        $data["links"] = explode('&nbsp;',$str_links );
		        $data['page'] = $page;
		        //END PAGINATION

		        //ACCESS CONTROL
		        if($data['user']['usertype'] == 'Administrator') {

					//LOAD VIEW		
					$this->load->view('alumni/year', $data);

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

	public function courses()	{

		if($this->session->userdata('logged_in'))	{

				//PAGE TITLE
		    	$data['title'] = 'Courses';
		 
		    	//GET SITE TITLE		    	                  
		        $data['site_title'] = $this->setting_model->sitename()['value'];		                   	         

		    	//USER DETAILS	
		    	$data['id'] = $this->session->userdata('logged_in')['id'];                      
		        $data['user'] = $this->setting_model->user($data['id']);		

		        //PAGINATE ITEMS			            
	   			$config['num_links'] = 5;
				$config['base_url'] = base_url('alumni/courses/');
				$config["total_rows"] = $this->pagination_model->count_course();
				$config['per_page'] = 15;				
				$this->load->config('pagination'); //LOAD PAGINATION CONFIG

				$this->pagination->initialize($config);
		        if($this->uri->segment(3)){
		        $page = ($this->uri->segment(3)) ;
		          }
		        else{
		               $page = 1;
		               
		        }
		        $data["results"] = $this->pagination_model->fetch_course($config["per_page"], $page);
		        $str_links = $this->pagination->create_links();
		        $data["links"] = explode('&nbsp;',$str_links );
		        $data['page'] = $page;
		        //END PAGINATION

		        //ACCESS CONTROL
		        if($data['user']['usertype'] == 'Administrator') {

					//LOAD VIEW		
					$this->load->view('alumni/course', $data);

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




	function edit($id)	{

		if($this->session->userdata('logged_in'))	{
								
				//FETCH DATA				
		        $data['items'] = $this->view_model->get_announcement($id);		     	        
		        //IF NO ID OR NO RESULT, REDIRECT
				if(!$id OR !$data['items']) {
					redirect('announcements', 'refresh');
				}			

				//FETCH DATA
			    $data['years'] = $this->alumni_model->year();
			    $data['courses'] = $this->alumni_model->course();	
		       
		 
		    	//PAGE TITLE
		    	$data['title'] = 'Edit: '.$data['items']['title'];

		    	//GET SITE TITLE		    	                  
		        $data['site_title'] = $this->setting_model->sitename()['value'];		                   	         

		    	//USER DETAILS	
		    	$data['id'] = $this->session->userdata('logged_in')['id'];                      
		        $data['user'] = $this->setting_model->user($data['id']);	
				
				
				
				//LOAD VIEW
				if($data['user']['usertype'] == 'Administrator' 
					OR $data['user']['usertype'] == 'Moderator' 						        	
				) {
					//LOAD VIEW		
					$this->load->view('announcement/edit', $data);
				} else {
					show_404();
				}			


		} else {
			 //If no session, redirect to login page
			 $this->session->set_flashdata('error', 'Oops! Please login to continue');
		     redirect('login', 'refresh');
	    }

	}


//////////////////////////////////////////////////////////////////////////
// ACTION OF THE MAIN ITEM
// This is where the actions place in. Create - Update - Delete
// POST Shit
///////////////////////////////////////////////////////////////////////////

function create()	{

		if($this->session->userdata('logged_in'))	{

					//PAGE TITLE
			    	$data['title'] = 'Register Alumni';

			    	//GET SITE TITLE		    	                  
			        $data['site_title'] = $this->setting_model->sitename()['value'];	             	         

			    	//USER DETAILS	
			    	$data['id'] = $this->session->userdata('logged_in')['id'];                      
			        $data['user'] = $this->setting_model->user($data['id']);	

			        //FETCH DATA
			        $data['years'] = $this->alumni_model->year();
			        $data['courses'] = $this->alumni_model->course();	

		             //ACTION START		
		             		$this->form_validation->set_rules('name', 'Name', 'required');	
		             		$this->form_validation->set_rules('middlename', 'Middle Name', 'required');	
		             		$this->form_validation->set_rules('lastname', 'Last Name', 'required');	 
		             		$this->form_validation->set_rules('id_num', 'ID Number', 'trim|required');           		
		            		$this->form_validation->set_rules('year', 'Year', 'trim|required');  
		            		$this->form_validation->set_rules('course', 'Course', 'trim|required');

		            		if($this->input->post('username')){
		            			$this->form_validation->set_rules('username', 'Username', 'callback_username_check');
		            		}
		            			
		            		if($this->input->post('password')){
		            			$this->form_validation->set_rules('password', 'Password', 'required|matches[confirmpassword]');
		            			$this->form_validation->set_rules('confirmpassword', 'Password Confirmation', 'required');
		            		}	  
		            		
		            		

							if ($this->form_validation->run() == FALSE) { 
								//LOAD VIEW
								if($data['user']['usertype'] == 'Administrator' 
						        	OR $data['user']['usertype'] == 'Moderator' 						        	
						        	 ) {
									//ERROR
									$this->load->view('alumni/create', $data);
								} else {
									show_404();
								}
							}
							else {
								//SUCCESS WITH ANOTHER VALIDATION

								if($this->create_model->set_alumni()){
									
									//ULTIMATE SUCCESS

									//START LOG DATA								  
								     $user 	 		= $data['id'];
								     $action 		= 'Registered New Alumni Account';
								     $icon			= '<i class="mdi-content-flag"></i>';
								     $this->log_model->log($action, $user, $icon);

								    //END LOG DATA
																	
								    //RETURN TO PAGE WITH FLASHDATA. SUCCESS
									$this->session->set_flashdata('success', 'Success! You have Registered a New Alumni Account');
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
//////////////////////////////////////////////////////////////////
// VALIDATION FUNCTIONS
//////////////////////////////////////////////////////////////////

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

//////////////////////////////////////////////////////////////////

function update()	{

		if($this->session->userdata('logged_in'))	{

		             //USER DETAILS	
			    		$data['id'] = $this->session->userdata('logged_in')['id'];

		             //ACTION START		
		             		$this->form_validation->set_rules('title', 'Title', 'required');		             		
		            		$this->form_validation->set_rules('description', 'Description', 'required');            		
		            		$this->form_validation->set_rules('year', 'Year', 'trim');  
		            		$this->form_validation->set_rules('course', 'Course', 'trim');  		


							if ($this->form_validation->run() == FALSE) { 
								//ERROR								
									$this->session->set_flashdata('error', 'Oops! Please recheck the fields');
									redirect('announcements/edit/'.$this->input->post('id'), 'refresh');
							}
							else {
								//SUCCESS WITH ANOTHER VALIDATION

								if($this->update_model->announcement($data['id'])){
									//ULTIMATE SUCCESS

									//START LOG DATA								  
								     $user 	 		= $this->session->userdata('logged_in')['id'];
								     $action 		= 'Updated an Announcement';
								     $icon			= '<i class="fa fa-fw fa-flask"></i>';
								     $this->log_model->log($action, $user, $icon);								    
								  
								    //END LOG DATA

								    //RETURN TO PAGE WITH FLASHDATA. SUCCESS
									$this->session->set_flashdata('success', 'Success! You have updated <u>' . ucwords($this->input->post('title')).'</u>');
									redirect('announcements/view/'.$this->input->post('id'), 'refresh');

								} else {
									//FAIL SUBMISSION
									$this->session->set_flashdata('error', 'Oops! An Error has occured! Contact the System Administrator!');
									redirect('announcements/edit/'.$this->input->post('id'), 'refresh');
								}

							}


					//ACTION END		

					

				}
				else   {
				//If no session, redirect to login page
		 	redirect('login', 'refresh');
		 }
		 
	}


	function delete()	{

		if($this->session->userdata('logged_in'))	{  	

		             //ACTION START				             			           

						if($this->delete_model->announcement()){
									//ULTIMATE SUCCESS		

									//START LOG DATA								  
								     $user 	 		= $this->session->userdata('logged_in')['id'];
								     $action 		= 'Deleted an Announcement';
								     $icon			= '';
								     $this->log_model->log($action, $user, $icon);

								    //END LOG DATA

								    //RETURN TO PAGE WITH FLASHDATA. SUCCESS
									$this->session->set_flashdata('success', 'Success! You have deleted an Announcement');
									redirect('announcements', 'refresh');

								} else {
									//FAIL SUBMISSION
									$this->session->set_flashdata('error', 'Oops! An Error has occured! Contact the System Administrator!');
									redirect('announcements', 'refresh');
						}						

					//ACTION END							

				}
				else   {
				//If no session, redirect to login page
		 	redirect('login', 'refresh');
		 }

		 
	}


	function create_course()	{

		if($this->session->userdata('logged_in'))	{

			
			    	//GET SITE TITLE		    	                  
			        $data['site_title'] = $this->setting_model->sitename()['value'];	             	         

			    	//USER DETAILS	
			    	$data['id'] = $this->session->userdata('logged_in')['id'];                      
			        $data['user'] = $this->setting_model->user($data['id']);

			        

		             //ACTION START		
		             		$this->form_validation->set_rules('title', 'Title', 'required');			             		
		            		

							if ($this->form_validation->run() == FALSE) { 
								//ERROR								
								$this->session->set_flashdata('error', 'Oops! Please recheck the fields');
								redirect($_SERVER['HTTP_REFERER'], 'refresh');							
							}
							else {
								//SUCCESS WITH ANOTHER VALIDATION

								if($this->create_model->course()){
									
									//ULTIMATE SUCCESS

									//START LOG DATA								  
								     $user 	 		= $data['id'];
								     $action 		= 'Registered New Course';
								     $icon			= '<i class="mdi-content-flag"></i>';
								     $this->log_model->log($action, $user, $icon);

								    //END LOG DATA
																	
								    //RETURN TO PAGE WITH FLASHDATA. SUCCESS
									$this->session->set_flashdata('success', 'Success! You have Registered a New Course');
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

	function update_course()	{

		if($this->session->userdata('logged_in'))	{

					//PAGE TITLE
			    	$data['title'] = 'Register Alumni';

			    	//GET SITE TITLE		    	                  
			        $data['site_title'] = $this->setting_model->sitename()['value'];	             	         

			    	//USER DETAILS	
			    	$data['id'] = $this->session->userdata('logged_in')['id'];                      
			        $data['user'] = $this->setting_model->user($data['id']);

			        

		             //ACTION START		
		             		$this->form_validation->set_rules('name', 'Title', 'required');			             		
		            		

							if ($this->form_validation->run() == FALSE) { 
								//ERROR								
								$this->session->set_flashdata('error', 'Oops! Please recheck the fields');
								redirect($_SERVER['HTTP_REFERER'], 'refresh');							
							}
							else {
								//SUCCESS WITH ANOTHER VALIDATION

								if($this->update_model->course()){
									
									//ULTIMATE SUCCESS

									//START LOG DATA								  
								     $user 	 		= $data['id'];
								     $action 		= 'Updated a Course';
								     $icon			= '<i class="mdi-content-flag"></i>';
								     $this->log_model->log($action, $user, $icon);

								    //END LOG DATA
																	
								    //RETURN TO PAGE WITH FLASHDATA. SUCCESS
									$this->session->set_flashdata('success', 'Success! You have updated a Course');
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


	function delete_course()	{

		if($this->session->userdata('logged_in'))	{  	

		             //ACTION START				             			           

						if($this->delete_model->course()){
									//ULTIMATE SUCCESS		

									//START LOG DATA								  
								     $user 	 		= $this->session->userdata('logged_in')['id'];
								     $action 		= 'Deleted a Course';
								     $icon			= '';
								     $this->log_model->log($action, $user, $icon);

								    //END LOG DATA

								    //RETURN TO PAGE WITH FLASHDATA. SUCCESS
									$this->session->set_flashdata('success', 'Success! You have deleted a Course');
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


	function create_year()	{

		if($this->session->userdata('logged_in'))	{

					//PAGE TITLE
			    	$data['title'] = 'Register Alumni';

			    	//GET SITE TITLE		    	                  
			        $data['site_title'] = $this->setting_model->sitename()['value'];	             	         

			    	//USER DETAILS	
			    	$data['id'] = $this->session->userdata('logged_in')['id'];                      
			        $data['user'] = $this->setting_model->user($data['id']);

			        

		             //ACTION START		
		             		$this->form_validation->set_rules('from', 'From', 'required');			             		
		            		$this->form_validation->set_rules('to', 'To', 'required');		

							if ($this->form_validation->run() == FALSE) { 
								//ERROR								
								$this->session->set_flashdata('error', 'Oops! Please recheck the fields');
								redirect($_SERVER['HTTP_REFERER'], 'refresh');							
							}
							else {
								//SUCCESS WITH ANOTHER VALIDATION

								if($this->create_model->year()){
									
									//ULTIMATE SUCCESS

									//START LOG DATA								  
								     $user 	 		= $data['id'];
								     $action 		= 'Registered New Batch Year';
								     $icon			= '<i class="mdi-content-flag"></i>';
								     $this->log_model->log($action, $user, $icon);

								    //END LOG DATA
																	
								    //RETURN TO PAGE WITH FLASHDATA. SUCCESS
									$this->session->set_flashdata('success', 'Success! You have Registered a New Batch Year');
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

	function update_year()	{

		if($this->session->userdata('logged_in'))	{

					//PAGE TITLE
			    	$data['title'] = 'Register Alumni';

			    	//GET SITE TITLE		    	                  
			        $data['site_title'] = $this->setting_model->sitename()['value'];	             	         

			    	//USER DETAILS	
			    	$data['id'] = $this->session->userdata('logged_in')['id'];                      
			        $data['user'] = $this->setting_model->user($data['id']);

			        

		             //ACTION START		
		             		$this->form_validation->set_rules('name', 'Title', 'required');			             		
		            		

							if ($this->form_validation->run() == FALSE) { 
								//ERROR								
								$this->session->set_flashdata('error', 'Oops! Please recheck the fields');
								redirect($_SERVER['HTTP_REFERER'], 'refresh');							
							}
							else {
								//SUCCESS WITH ANOTHER VALIDATION

								if($this->update_model->year()){
									
									//ULTIMATE SUCCESS

									//START LOG DATA								  
								     $user 	 		= $data['id'];
								     $action 		= 'Updated a Batch Year';
								     $icon			= '<i class="mdi-content-flag"></i>';
								     $this->log_model->log($action, $user, $icon);

								    //END LOG DATA
																	
								    //RETURN TO PAGE WITH FLASHDATA. SUCCESS
									$this->session->set_flashdata('success', 'Success! You have updated a Batch Year');
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


	function delete_year()	{

		if($this->session->userdata('logged_in'))	{  	

		             //ACTION START				             			           

						if($this->delete_model->year()){
									//ULTIMATE SUCCESS		

									//START LOG DATA								  
								     $user 	 		= $this->session->userdata('logged_in')['id'];
								     $action 		= 'Deleted a Batch Year';
								     $icon			= '';
								     $this->log_model->log($action, $user, $icon);

								    //END LOG DATA

								    //RETURN TO PAGE WITH FLASHDATA. SUCCESS
									$this->session->set_flashdata('success', 'Success! You have deleted a Batch Year');
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


//////////////////////////////////////////////////////////////////////////
// SEARCH
//////////////////////////////////////////////////////////////////////////
	public function search()	{

			if($this->session->userdata('logged_in'))	{

					//PAGE TITLE
			    	$data['title'] = 'Search: ' . $this->input->post('search');

			    	//REDIRECT IF EMPTY
			    	if(!$this->input->post('search')) {
			    		redirect('alumni', 'refresh');
			    	}

			    	//FETCH DATA
			    	$data['results'] = $this->view_model->search_alumni();
			 
			    	//GET SITE TITLE		    	                  
			        $data['site_title'] = $this->setting_model->sitename()['value'];		                   	         

			    	//USER DETAILS	
			    	$data['id'] = $this->session->userdata('logged_in')['id'];                      
			        $data['user'] = $this->setting_model->user($data['id']);		

					//LOAD VIEW		
					$this->load->view('alumni/search', $data);

					

			} else {
				 //If no session, redirect to login page
				 $this->session->set_flashdata('error', 'Oops! Please login to continue');
			     redirect('login', 'refresh');
		    }

		}


	public function reports()	{

		if($this->session->userdata('logged_in'))	{

				//PAGE TITLE
		    	$data['title'] = 'Alumni';
		 
		    	//GET SITE TITLE		    	                  
		        $data['site_title'] = $this->setting_model->sitename()['value'];		                   	         

		    	//USER DETAILS	
		    	$data['id'] = $this->session->userdata('logged_in')['id'];                      
		        $data['user'] = $this->setting_model->user($data['id']);		

		        // FETCH DATA
		        $data['students'] = $this->alumni_model->students();

		        //ACCESS CONTROL
		        if($data['user']['usertype'] == 'Administrator') {
					//LOAD VIEW		
					$this->load->view('alumni/reports', $data);
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


}