<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Calendar_model extends CI_Model{

	function generate_calendar($year, $month, $user_id){

		$prefs = array (
               'month_type'   	=> 'long',
               'day_type'     	=> 'short',
               'show_next_prev' => 'TRUE',
               'next_prev_url'  => base_url().'calendar/show_cal'
             );

			$events = $this->get_events($year,$month, $user_id);

			// var_dump($events); 

			$this->load->library('calendar', $prefs);

			return $this->calendar->generate($year, $month, $events);

	}

	function get_events($year, $month, $user_id){

		$events = array();

		$query = $this->db->select('date, event_name')
						  ->from('events')
						  ->like('date',"$year-$month")
						  ->where('user_id', $user_id)
						  ->get();
		$query = $query->result();

		foreach($query as $row){

			$day = (int)substr($row->date,8,2);

			$events[$day] = $row->event_name;

		}

	return $events;
	}

	function add_events($data){

		// $data['date'] = $date;
		// $data['event_name'] = $event;
		// $data['user_id'] = $user_id;

		$this->db->insert('events', $data);

	}

	function delete_event($data){

		$this->db->where('date', $data['date'])
				 ->where('user_id', $data['user_id'])
				 ->delete('events');
	}
	

}