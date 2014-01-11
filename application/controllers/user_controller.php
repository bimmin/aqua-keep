<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class User extends CI_Controller
{
	
	public function login()
	{
		$this->load->view('login');
	}

	public function process_login()
	{
		// var_dump($this->input->post());
		//  echo $this->input->post('email');

		$this->load->library('form_validation');

		$this->form_validation->set_rules('email', 'Email', 'valid_email|required');

		if($this->form_validation->run() === FALSE)
		{
			echo validation_errors();
		}

	}
	
}
