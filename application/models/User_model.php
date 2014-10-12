<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class User_model extends CI_Model
{
	
	public function get_user($email, $password)
	{
		return $this->db->where('email', $email)
					->where('password', MD5($password))
					->get("users")
					->row();
	}

	public function register_user($user)
	{
		return $this->db->insert("Users, $user");
	}

	public function get_aquariums($user_id)
	{
		$this->db->select('aquariums.*, photos.url')
				 ->from('aquariums')
				 ->join('photos', 'photos.aquarium_id = aquariums.id', 'left')
				 ->where('aquariums.user_id', $user_id)
				 ->group_by('aquariums.id');
				 // ->order_by('photos.priority');
		return $this->db->get()->result_array();

	}

	public function get_aquarium($aquarium_id)
	{
		$this->db->select('aquariums.*, photos.url')
				->from('aquariums')
				->where('aquariums.id', $aquarium_id)
				->join('photos', 'photos.aquarium_id = aquariums.id', 'left')
				->order_by('photos.priority');

		return $this->db->get()->result_array();

	}

	public function insert_aquarium($data){	
		// $user_id = $data['user_id'];

		// $this->db->where('id', $id);
		$this->db->insert('aquariums', $data); 
	}

	public function update_aquarium($data){	
		$id = $data['id'];

		$this->db->where('id', $id);
		$this->db->update('aquariums', $data); 
	}

	public function add_aquarium($data){
		$this->db->insert('aquariums', $data);
	}

	public function delete_aquarium($aquarium_id){
		$this->db->where('id', $aquarium_id);
		$this->db->delete('aquariums');
	}

	public function get_devices($aquarium_id){
		$this->db->select('id, name, watts, hours_on_per_day')
				 ->from('equipment')
				 ->where('aquarium_id', $aquarium_id);

		return $this->db->get()->result_array();
	}

	public function delete_device($device_id){
		$this->db->where('id', $device_id)
				 ->delete('equipment');
	}

	public function get_kWh($aquarium_id){
		$this->db->select('kWh_cost')
				 ->from('aquariums')
				 ->where('id', $aquarium_id);

		return $this->db->get()->result_array();
	}

	public function set_kWh($data){
		$this->db->where('id', $data['id']);
		$this->db->update('aquariums', $data);
	}

	public function add_device($data){
		$this->db->insert('equipment', $data);
	}

	public function get_messages($aquarium_id){
		$this->db->select('messages.*, users.display_name')
				 ->from('messages')
				 ->join('users', 'users.id = messages.user_id', 'left')
				 ->where('messages.aquarium_id', $aquarium_id)
				 ->order_by('messages.created_at DESC');
		return $this->db->get()->result_array();
	}

	//when I integrate public/private select where private=false
	public function get_rand_aquariums(){

		$this->db->select('aquariums.*, photos.url')
				 ->from('aquariums')
				 ->join('photos', 'photos.aquarium_id = aquariums.id')
				 ->order_by('photos.aquarium_id', 'random')
	 			 ->group_by('id')
				 ->limit(10);
		return $this->db->get()->result_array();
	}

	public function get_water_params($aquarium_id){

		$this->db->select('*');
		$this->db->from('water_tests');
		$this->db->where('aquarium_id', $aquarium_id);

		return $this->db->get()->result_array();
	}

	public function get_aquarium_name($aquarium_id){
		$this->db->select('aquariums.name');
		$this->db->from('aquariums');
		$this->db->where('id', $aquarium_id);
		$result = $this->db->get()->result();
		return $result[0]->name;
	}

	public function add_water_test($data){
		$this->db->insert('water_tests', $data);
	}

	public function add_log_from_test($data){
		$this->db->insert('log', $data);
	}

	public function add_message($data){
		$this->db->insert('messages', $data);
	}

	public function get_logs($aquarium_id){
		$this->db->select('text, date')
				 ->from('log')
				 ->where('aquarium_id', $aquarium_id)
				 ->order_by('date DESC');

		return $this->db->get()->result_array();
	}

	public function add_log_event($data){
		$this->db->insert('log', $data);
	}
	
}


?>
