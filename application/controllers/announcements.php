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

class Announcements extends CI_Controller {

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
		    	$data['title'] = 'Announcements';

		    	//GET SITE TITLE		    	                  
		        $data['site_title'] = $this->setting_model->sitename()['value'];		                   	         

		    	//USER DETAILS	
		    	$data['id'] = $this->session->userdata('logged_in')['id'];                      
		        $data['user'] = $this->setting_model->user($data['id']);

				//PAGINATE ITEMS			            
	   			$config['num_links'] = 5;
				$config['base_url'] = base_url('announcements/index/');
				$config["total_rows"] = $this->pagination_model->count_announcements();
				$config['per_page'] = 10;				
				$this->load->config('pagination'); //LOAD PAGINATION CONFIG

				$this->pagination->initialize($config);
		        if($this->uri->segment(3)){
		        $page = ($this->uri->segment(3)) ;
		          }
		        else{
		               $page = 1;
		               
		        }
		        $data["results"] = $this->pagination_model->fetch_announcements($config["per_page"], $page, $data['user']);
		        $str_links = $this->pagination->create_links();
		        $data["links"] = explode('&nbsp;',$str_links );

				//LOAD VIEW				
				$this->load->view('announcement/announcements', $data);
				


		} else {
			 //If no session, redirect to login page
			 $this->session->set_flashdata('error', 'Oops! Please login to continue');
		     redirect('login', 'refresh');
	    } 

	}



	function view($id)	{

		if($this->session->userdata('logged_in'))	{
								
				//FETCH DATA				
		        $data['items'] = $this->view_model->get_announcement($id);		      	        
		        //IF NO ID OR NO RESULT, REDIRECT
				if(!$id OR !$data['items']) {
					redirect('announcements', 'refresh');
				}

				//REQUEST
				$tag = 'announcement';
		        $request_id = $id;	

		        //TOTAL COMMENTS	        
		        $data['total_comments'] = $this->pagination_model->count_comments($request_id, $tag);
		        //PAGINATE ITEMS			            
	   			$config['num_links'] = 5;
				$config['base_url'] = base_url('announcements/view/'.$id.'/comment/');
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
		 
		    	//PAGE TITLE
		    	$data['title'] = $data['items']['title'];

		    	//GET SITE TITLE		    	                  
		        $data['site_title'] = $this->setting_model->sitename()['value'];		                   	         

		    	//USER DETAILS	
		    	$data['id'] = $this->session->userdata('logged_in')['id'];                      
		        $data['user'] = $this->setting_model->user($data['id']);	
				
				

				//LOAD VIEW		
				$this->load->view('announcement/view', $data);

			


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
			    	$data['title'] = 'Create Announcement';

			    	//GET SITE TITLE		    	                  
			        $data['site_title'] = $this->setting_model->sitename()['value'];	             	         

			    	//USER DETAILS	
			    	$data['id'] = $this->session->userdata('logged_in')['id'];                      
			        $data['user'] = $this->setting_model->user($data['id']);	

			        //FETCH DATA
			        $data['years'] = $this->alumni_model->year();
			        $data['courses'] = $this->alumni_model->course();	

		             //ACTION START		
		             		$this->form_validation->set_rules('title', 'Title', 'required');		             		
		            		$this->form_validation->set_rules('description', 'Description', 'required');            		
		            		$this->form_validation->set_rules('year', 'Year', 'trim');  
		            		$this->form_validation->set_rules('course', 'Course', 'trim');  
		            		
		            		

							if ($this->form_validation->run() == FALSE) { 
								//LOAD VIEW
								if($data['user']['usertype'] == 'Administrator' 
						        	OR $data['user']['usertype'] == 'Moderator' 						        	
						        	 ) {
									//ERROR
									$this->load->view('announcement/create', $data);
								} else {
									show_404();
								}
							}
							else {
								//SUCCESS WITH ANOTHER VALIDATION

								if($this->create_model->announcement($data['id'])){
									
									//ULTIMATE SUCCESS

									//START LOG DATA								  
								     $user 	 		= $data['id'];
								     $action 		= 'Published New Announcement';
								     $icon			= '<i class="mdi-content-flag"></i>';
								     $this->log_model->log($action, $user, $icon);

								    //END LOG DATA
																	
								    //RETURN TO PAGE WITH FLASHDATA. SUCCESS
									$this->session->set_flashdata('success', 'Success! You have published an Announcement');
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












}