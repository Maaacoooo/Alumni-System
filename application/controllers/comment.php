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

class Comment extends CI_Controller {

	/*
	 THIS IS THE MAIN ITEMS CONTROLLER
	 ACTIONS:
	 	CREATE
	 	UPDATE
	 	DELETE
	 */
	public function __construct()	{
		parent::__construct();		
       
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


		             //ACTION START		
		             		$this->form_validation->set_rules('comment', 'Comment', 'required');	             		

							if ($this->form_validation->run() == FALSE) { 
								//LOAD VIEW
								if($data['user']['usertype'] == 'Administrator' 
						        	OR $data['user']['usertype'] == 'Moderator' 						        	
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

								if($this->create_model->comment($data['id'])){
									
									//ULTIMATE SUCCESS

									//START LOG DATA								  
								     $user 	 		= $data['id'];
								     $action 		= 'Commented on an Announcement';
								     $icon			= '<i class="mdi-content-flag"></i>';
								     $this->log_model->log($action, $user, $icon);

								    //END LOG DATA
																	
								    //RETURN TO PAGE WITH FLASHDATA. SUCCESS
									$this->session->set_flashdata('success', 'Comment Success!');
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

						if($this->delete_model->comment()){
									//ULTIMATE SUCCESS		

									//START LOG DATA								  
								     $user 	 		= $this->session->userdata('logged_in')['id'];
								     $action 		= 'Deleted an Comment';
								     $icon			= '';
								     $this->log_model->log($action, $user, $icon);

								    //END LOG DATA

								    //RETURN TO PAGE WITH FLASHDATA. SUCCESS
									$this->session->set_flashdata('success', 'Success! You have deleted your Comment');
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