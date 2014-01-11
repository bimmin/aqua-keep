<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

require_once('main.php');

class Calendar extends Main
{

	function index($year = null, $month=null){

		$this->show_cal($year, $month);
	}

	function show_cal($year, $month){
		// $user_id = $this->session->userdata('user_session')['id'];

		$year = ($year == null) ? date('Y') : $year;
		$month = ($month == null) ? date('n') : $month;

		$this->load->model('calendar_model');
		
		// $this->load->library('calendar', $prefs);
		$user_id = $this->session->userdata('user_session')['id'];

		$data['title'] = "My Calendar";
		$data['calendar'] =  $this->calendar_model->generate_calendar($year, $month, $user_id);

		$this->load->view('cal_view', $data);

		
}
	function add_event(){

		$this->load->model('calendar_model');

		// $day = $this->input->post('day');
		// $month = $this->input->post('month');
		// $year = $this->input->post('year');
		$date = $this->input->post('date');

		$data['date'] = $date;
		$data['event_name'] = $this->input->post('event_name');
		$data['user_id'] = $this->session->userdata('user_session')['id'];

		$interval_unit = $this->input->post('interval_unit');
		$interval_every = $this->input->post('interval_every');

		$date = new DateTime($date);

		if($interval_unit == ''){
			$this->calendar_model->add_events($data);
			// echo json_encode("function ran");
		}

		else{
		$this->calendar_model->add_events($data);
		// var_dump($this->input->post('interval_unit'));

			if($interval_unit == "Daily"){
				$modify = "+" . $this->input->post('interval_every') . " Days";
				}
			elseif($interval_unit == "Monthly"){
				$modify = "+" . $this->input->post('interval_every') . " Months";
			}
				else{
					$modify = "+" .$this->input->post('interval_every') . " Weeks";
				}
			
		//For now just have this place the next 10 dates for recourring event
			for($i=0;$i<10;$i++){
				$next_date = date_modify($date, $modify);

				$data['date'] = $next_date->format("Y-m-d");

				$this->calendar_model->add_events($data);
				
			}
		}
		

		// $this->calendar_model->add_events($data);
		echo json_encode("function ran");

	}
	function delete_event(){

		$this->load->model('calendar_model');

		$date = $this->input->post('date');

		$date = new DateTime($date);
		$data['date'] = $date->format("Y-m-d");
		$data['user_id'] = $this->session->userdata('user_session')['id'];

		$this->calendar_model->delete_event($data);

		echo json_encode("function ran");

	}
		
}



