<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

require_once('main.php');

class User extends Main
{
	
	public function login()
	{
		// $data['login_errors'] = $this->session->flashdata('login_errors');
		// $this->load->view('index', $data);
		$this->load->view('index');

	}

	public function process_login(){
		// var_dump($this->input->post());
		//  echo $this->input->post('email');

		$this->load->library('form_validation');

		$this->form_validation->set_rules('email', 'Email', 'valid_email|required');

		$this->form_validation->set_rules('password', 'Password', 'min_length[6]|required');

		if($this->form_validation->run() === FALSE)
		{
			// $this->session->set_flashdata('login_errors', validation_errors());
			// redirect(base_url('user/login/'));
			$data['errors'] = TRUE;
			$data['messages'] = validation_errors();
			echo json_encode($data);
		}
		else
		{
		   $email = $this->input->post('email');
		   $password = $this->input->post('password');

		   $this->load->model('User_model');

		   $query = $this->User_model->get_user($email, $password);

		   if($query)
		   {

				$user = array('id'=> $query->id,
							  'display_name' => $query->display_name,
							  'password' => $query->password,
							  'created_at' => $query->created_at,
							  'email' => $email,
							  'login_status' => TRUE
							 );

				$this->session->set_userdata('user_session', $user);

		    	// $html ='<script>location.href="user/profile";</script>';
		    	$data['errors'] = FALSE;
				echo json_encode($data);
				// redirect(base_url('/user/profile'));
		   }
		   else
		   {
		   	$data['errors'] = TRUE;
		   	$data['messages'] = "<span class='error'>Invalid email address or password.</span>";
		   	echo json_encode($data);
		   }

		}

	}

	public function process_registration(){
	$this->load->library('form_validation');

		$this->form_validation->set_rules('display_name', 'Display Name', 'alpha|required');

		$this->form_validation->set_rules('email', 'Email', 'valid_email|required');

		$this->form_validation->set_rules('password', 'Password', 'min_length[6]|required');

		$this->form_validation->set_rules('confirm_password', 'Password', 'matches[password]|required');

		if($this->form_validation->run() === FALSE)
		{
			// $this->session->set_flashdata('login_errors', validation_errors());
			// redirect(base_url('user/login/'));
			$html = validation_errors();
			echo json_encode($html);
		}

		else
		{
			//check if email is already taken and if not add record and direct to profile
			$this->load->helper('date');

			$display_name = $this->input->post('display_name');
			$email = $this->input->post('email');
			$password = $this->input->post('password');

			$this -> db -> select('*');
			$this -> db -> FROM('users');
			$this -> db -> WHERE('email', $email);

			$users = $this -> db -> get()->row();

			if(count($users)>0){
				$html = "Email already registered.";
				echo json_encode($html);
			}
			else{
				//instert Query

				$now = date('Y-m-d H:i:s');

				$insert_data = array(
					'display_name'=> $display_name,
					'email'=> $email,
					'password'=> md5($password),
					'created_at'=> $now
					);
				$this->db->insert('users', $insert_data);

				$html = "<p>You have successfully registered, Please login.</p>";
				echo json_encode($html);

			}
		}
	}

	public function profile($id=null){
		//this function gets uesr aquariums and sends data with load view
		$this->load->model('User_model');
		$user_id = $this->session->userdata('user_session')['id'];

		if($id==null)
		{
			$query_aquariums = $this->User_model->get_aquariums($user_id);
			$data['logged_in_user'] = $user_id;
		}
		else
		{
			$query_aquariums = $this->User_model->get_aquariums($id);
			$data['logged_in_user'] = $id;
		}
		for ($i=0; $i<count($query_aquariums); $i++){
			if($query_aquariums[$i]['url'] == NULL)
			{
				$query_aquariums[$i]['url'] = "goldi.jpg";
			}
		}
		$data['aquariums'] = $query_aquariums;
		
		$this->load->view('profile', $data);
	}

	public function aquarium($aquarium_id){

		$this->load->model('User_model');

		$query_aquariums = $this->User_model->get_aquarium($aquarium_id);

		for ($i=0; $i<count($query_aquariums); $i++){
			if($query_aquariums[$i]['url'] == NULL)
			{
				$query_aquariums[$i]['url'] = "goldi.jpg";
			}
		}
		$data['aquarium_details'] = $query_aquariums;

		$query_messages = $this->User_model->get_messages($aquarium_id);

		$data['messages'] = $query_messages;

		$this->load->view('aquarium', $data);
	}

	public function public_aquarium($aquarium_id){

		$this->load->model('User_model');

		$query_aquariums = $this->User_model->get_aquarium($aquarium_id);

		for ($i=0; $i<count($query_aquariums); $i++){
			if($query_aquariums[$i]['url'] == NULL)
			{
				$query_aquariums[$i]['url'] = "goldi.jpg";
			}
		}
		$data['aquarium_details'] = $query_aquariums;

		$query_messages = $this->User_model->get_messages($aquarium_id);

		$data['messages'] = $query_messages;

		$this->load->view('public_aquarium', $data);
	}

	public function browse(){
		$this->load->model('User_model');
		$query_aquariums = $this->User_model->get_rand_aquariums();

		for ($i=0; $i<count($query_aquariums); $i++){
			if($query_aquariums[$i]['url'] == NULL)
			{
				$query_aquariums[$i]['url'] = "goldi.jpg";
			}
		}
		$data['aquariums'] = $query_aquariums;

		$this->load->view('browse', $data);
	}

	public function add_aquarium(){

		$this->load->library('form_validation');

		$this->form_validation->set_rules('name', 'Aquarium Name', 'trim|required|xss_clean');

		$this->form_validation->set_rules('size', 'Aquarium Size', 'numeric|required');

		$this->form_validation->set_rules('inhabitants', 'Inhabitants', 'trim|required|xss_clean');

		if($this->form_validation->run() === FALSE)
		{
			$html['errors'] = TRUE;
			$html['messages'] = validation_errors();
			echo json_encode($html);
		}

		else
		{
			$html['errors'] = FALSE;

			$this->load->model('User_model');

			$data = $this->input->post();

			$this->User_model->add_aquarium($data);

			$html['profile_id'] = $data['user_id'];

			echo json_encode($html);

		}
	}

public function update_aquarium(){

		$this->load->library('form_validation');

		$this->form_validation->set_rules('name', 'Aquarium Name', 'trim|required|xss_clean');

		$this->form_validation->set_rules('size', 'Aquarium Size', 'numeric|required');

		$this->form_validation->set_rules('inhabitants', 'Inhabitants', 'trim|required|xss_clean');

		if($this->form_validation->run() === FALSE)
		{
			$data['messages'] = validation_errors();
			$data['errors'] = TRUE;
			echo json_encode($data);
		}

		else
		{
			$data['errors'] = FALSE;

			$this->load->model('User_model');

			$data = $this->input->post();

			$this->User_model->update_aquarium($data);

			echo json_encode($data);

		}
	}

	public function delete_aquarium($aquarium_id){
			$this->load->model('User_model');

			$this->User_model->delete_aquarium($aquarium_id);

			redirect('user/profile');
	}

	public function post_message($aquarium_id){
		$this->load->model('User_model');

		$data['user_id'] = $this->session->userdata('user_session')['id'];
		$data['aquarium_id'] = $aquarium_id;
		$data['message'] = $this->input->post('message');
		$data['created_at'] = date('Y-m-d H:i:s');

		$this->User_model->add_message($data);

		redirect('user/aquarium/'.$aquarium_id.'');
	}

	public function graphs($aquarium_id){

		$this->load->model('User_model');

		$water_readings = $this->User_model->get_water_params($aquarium_id);


		$types_array = array();
		//create an array of arrays. Keys are types from db which holds array of date and water reading/value
		foreach ($water_readings as $key => $value) {
			if(isset($types_array[$value['type']])){
				array_push($types_array[$value['type']], array($value['date'], $value['value']));
			}
			else{
				$types_array[$value['type']] = array();
				array_push($types_array[$value['type']], array($value['date'], $value['value']));
			}
		}

		$types = array();
		// date_default_timezone_set('UTC');

		foreach($types_array as $key => $type){
			$hold = $key;
			$hold = array();
			$hold['name'] = $key;

			foreach($type as &$value){
				$value[0] = date("d-m-Y", strtotime($value[0]));
				$value[0] = strtotime($value[0]) * 1000 - strtotime('02-01-1970: 00:00:00') * 1000;
				$value[1] = (float)$value[1];
				//$value[2] = $aquarium_name;
			}

			$hold['data'] = $type;

			array_push($types, $hold);
		}

		$types_array['types_array'] = $types;

		$types_array['aquarium_id'] = $aquarium_id;
		$types_array['aquarium_name'] = $this->User_model->get_aquarium_name($aquarium_id);

		$this->load->view('graphs', $types_array);
	}

	public function add_data($aquarium_id){
		$data = $this->input->post();
		$data['aquarium_id'] = $aquarium_id;
		
		$this->load->model('User_model');
		$this->User_model->add_water_test($data);

		redirect('user/graphs/'.$aquarium_id.'');
	}

	public function energy($aquarium_id){

		$data['aquarium_id'] = $aquarium_id;

		$this->load->model('User_model');

		$data['devices'] = $this->User_model->get_devices($aquarium_id);

		$data['kWh'] = $this->User_model->get_kWh($aquarium_id);

		$this->load->view('energy', $data);
	}

	public function change_kWh($aquarium_id){
		$this->load->model('User_model');

		$data['kWh_cost'] = $this->input->post('kWh_cost');
		$data['id'] = $aquarium_id;

		$this->User_model->set_Kwh($data);
		echo json_encode("kwh updated");
	}

	public function add_device(){

		$this->load->library('form_validation');

		$this->form_validation->set_rules('name', 'Device Name', 'trim|required|xss_clean');

		$this->form_validation->set_rules('watts', 'Device Watts', 'trim|numeric|required');

		$this->form_validation->set_rules('hours_on_per_day', 'Hours of use a day', 'numeric|max_length[24]|required');

		if($this->form_validation->run() === FALSE)
		{
			$html['errors'] = TRUE;
			$html['messages'] = validation_errors();
			echo json_encode($html);
		}

		else
		{
			$html['errors'] = FALSE;

			$this->load->model('User_model');

			$data = $this->input->post();

			$html['aquarium_id'] = $data['aquarium_id'];

			$this->User_model->add_device($data);

			// $html['profile_id'] = $data['user_id'];

			echo json_encode($html);


		}

	}

	public function delete_device($device_id, $aquarium_id){
		$this->load->model('User_model');
		$this->User_model->delete_device($device_id);

		redirect(base_url('/user/energy/'.$aquarium_id.''));

	}

	public function log($aquarium_id){
		$this->load->model('User_model');
		$data['log'] = $this->User_model->get_logs($aquarium_id);
		$data['aquarium_id'] = $aquarium_id;
		$this->load->view('log', $data);
	}

	public function add_log_event($aquarium_id){
		$this->load->model('User_model');
		$data['text'] = $this->input->post('text');
		$data['aquarium_id'] = $aquarium_id;
		$data['date'] = date('Y-m-d H:i:s');
		$this->User_model->add_log_event($data);

		$this->log($aquarium_id);
	}

	public function edit_account(){
		$this->load->view('under_construction');
	}

	public function about(){
		$this->load->view('about');
	}
	public function privacy(){
		$this->load->view('privacy');
	}
	public function contact(){

	    $this->load->view('contact');
    }

	public function logout()
	{
		$this->session->sess_destroy();
		redirect(base_url(''));
	}
}
