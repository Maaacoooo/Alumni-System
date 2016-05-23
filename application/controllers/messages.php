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

class Messages extends CI_Controller {

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
		    	$data['title'] = 'Messages';
		 
		    	//GET SITE TITLE		    	                  
		        $data['site_title'] = $this->setting_model->sitename()['value'];		                   	         

		    	//USER DETAILS	
		    	$data['id'] = $this->session->userdata('logged_in')['id'];                      
		        $data['user'] = $this->setting_model->user($data['id']);		

		        //PAGINATE ITEMS			            
	   			$config['num_links'] = 5;
				$config['base_url'] = base_url('messages/index/');
				$config["total_rows"] = $this->pagination_model->count_message_threads($data['user']['id']);
				$config['per_page'] = 15;				
				$this->load->config('pagination'); //LOAD PAGINATION CONFIG

				$this->pagination->initialize($config);
		        if($this->uri->segment(3)){
		        $page = ($this->uri->segment(3)) ;
		          }
		        else{
		               $page = 1;
		               
		        }
		        $data["results"] = $this->pagination_model->fetch_message_threads($config["per_page"], $page, $data['user']['id']);
		        $str_links = $this->pagination->create_links();
		        $data["links"] = explode('&nbsp;',$str_links );
		        $data['page'] = $page;
		        //END PAGINATION


				//LOAD VIEW		
				$this->load->view('message/messages', $data);


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
		    	$data['items'] = $this->view_model->get_message_thread($id);
		    	$data['messages'] = $this->view_model->get_messages($id);
		    	/*

		    	//IF NO ID OR NO RESULT, REDIRECT
				if(!$id OR !$data['items']) {
					redirect('dashboard', 'refresh');
				} */


		    	//PAGE TITLE
		    	$data['title'] = 'Message &middot; ' . $data['items']['subject'];

		    	//GET SITE TITLE		    	                  
		        $data['site_title'] = $this->setting_model->sitename()['value'];	                   	         

				//LOAD VIEW				
				$this->load->view('message/view', $data);
			


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


//////////////////////////////////////////////////////////////////




	function create()	{

		if($this->session->userdata('logged_in'))	{

				//USER DETAILS	
		    	$data['id'] = $this->session->userdata('logged_in')['id'];                      
		        $data['user'] = $this->setting_model->user($data['id']);

		             //ACTION START				             			           

						if($this->create_model->message($data['id'])){
									//ULTIMATE SUCCESS		

									//START LOG DATA								  
								     $user 	 		= $this->session->userdata('logged_in')['id'];
								     $action 		= 'Sent a Message';
								     $icon			= '';
								     $this->log_model->log($action, $user, $icon);

								    //END LOG DATA

								    //RETURN TO PAGE WITH FLASHDATA. SUCCESS
									$this->session->set_flashdata('success', 'Success! Message Sent!');
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