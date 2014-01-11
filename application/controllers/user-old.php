<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class user extends CI_Controller {


	public function __construct()
	{
		parent::__construct();
		$this->username = "David";
	}

	public function profile($user_id)
	{
		echo "Welcome to your profile" . $user_id;
	}

	//default controller
	public function index()
	{
		// $this->load->view('welcome_message');
		echo "Welcome to your profile" . " " . $this->username;
		echo $this->get_name();
	}

	public function get_name()
	{
		return "David";
	}

	public function get_user()
	{
		$user_details = array(
			'email' => 'david.ethier@gmail.com',
			'password' => md5('one2the3')
			);

		$this->load->model("User_Model");
		$user = $this->User_Model->get_user($user_details);
		var_dump($user);
	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */