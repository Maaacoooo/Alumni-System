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

class Dashboard extends CI_Controller {

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
	public function __construct()
	{
		parent::__construct();	
		$this->load->model('dashboard_model');

	}	


	public function index2()	{

		if($this->session->userdata('logged_in'))	{

				//PAGE TITLE
		    	$data['title'] = 'Dashboard';

		    	//GET SITE TITLE		    	                  
		        $data['site_title'] = $this->setting_model->sitename()['value'];		                   	         

		    	//USER DETAILS	
		    	$data['id'] = $this->session->userdata('logged_in')['id'];                      
		        $data['user'] = $this->setting_model->user($data['id']);	

		        //PAGINATE ITEMS			            
	   			$config['num_links'] = 5;
				$config['base_url'] = base_url('dashboard/index/');
				$config["total_rows"] = $this->pagination_model->count_timeline();
				$config['per_page'] = 15;				
				$this->load->config('pagination'); //LOAD PAGINATION CONFIG

				$this->pagination->initialize($config);
		        if($this->uri->segment(3)){
		        $page = ($this->uri->segment(3)) ;
		          }
		        else{
		               $page = 1;
		               
		        }
		        $data["results"] = $this->pagination_model->fetch_timeline($config["per_page"], $page);
		        $str_links = $this->pagination->create_links();
		        $data["links"] = explode('&nbsp;',$str_links );
		        $data['page'] = $page;
		        //END PAGINATION

				//LOAD VIEW
				$this->load->view('dashboard', $data);


		} else {
			 //If no session, redirect to login page
			 $this->session->set_flashdata('error', 'Oops! Please login to continue');
		     redirect('login', 'refresh');
	    } 

	}


	function index()	{

		if($this->session->userdata('logged_in'))	{

					//PAGE TITLE
			    	$data['title'] = 'Dashboard';

			    	//GET SITE TITLE		    	                  
			        $data['site_title'] = $this->setting_model->sitename()['value'];	             	         

			    	//USER DETAILS	
			    	$data['id'] = $this->session->userdata('logged_in')['id'];                      
			        $data['user'] = $this->setting_model->user($data['id']);	

		             //ACTION START		
		             		$this->form_validation->set_rules('post', 'Post', 'required');	             		

							if ($this->form_validation->run() == FALSE) { 

								//PAGINATE ITEMS			            
					   			$config['num_links'] = 5;
								$config['base_url'] = base_url('dashboard/index/');
								$config["total_rows"] = $this->pagination_model->count_timeline();
								$config['per_page'] = 15;				
								$this->load->config('pagination'); //LOAD PAGINATION CONFIG

								$this->pagination->initialize($config);
						        if($this->uri->segment(3)){
						        $page = ($this->uri->segment(3)) ;
						          }
						        else{
						               $page = 1;
						               
						        }
						        $data["results"] = $this->pagination_model->fetch_timeline($config["per_page"], $page);
						        $str_links = $this->pagination->create_links();
						        $data["links"] = explode('&nbsp;',$str_links );
						        $data['page'] = $page;
						        //END PAGINATION

								//LOAD VIEW					
								$this->load->view('dashboard', $data);
								
							}
							else {
								//SUCCESS WITH ANOTHER VALIDATION

								if($this->create_model->post($data['id'])){
									
									//ULTIMATE SUCCESS

									//START LOG DATA								  
								     $user 	 		= $data['id'];
								     $action 		= 'Updated a Status';
								     $icon			= '<i class="mdi-content-flag"></i>';
								     $this->log_model->log($action, $user, $icon);

								    //END LOG DATA
																	
								    //RETURN TO PAGE WITH FLASHDATA. SUCCESS
									$this->session->set_flashdata('success', 'Success! You have Updated your Status');
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


	function delete()	{

		if($this->session->userdata('logged_in'))	{  	

		             //ACTION START				             			           

						if($this->delete_model->post()){
									//ULTIMATE SUCCESS		

									//START LOG DATA								  
								     $user 	 		= $this->session->userdata('logged_in')['id'];
								     $action 		= 'Deleted a Status Update';
								     $icon			= '';
								     $this->log_model->log($action, $user, $icon);

								    //END LOG DATA

								    //RETURN TO PAGE WITH FLASHDATA. SUCCESS
									$this->session->set_flashdata('success', 'Success! You have your Status Update');
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