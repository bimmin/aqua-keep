<?php

class Event_model extends CI_Model {
	var $event_name;
	var $start_date;
	var $end_date;

    function __construct()
    {
        parent::__construct();
    }

    function get($request){
    	$query = $this->db->get("events");
    	return $query->result_array();
    }

    protected function get_values($action){
        $this->event_name   = $action->get_value("event_name");
        $this->start_date   = $action->get_value("start_date");
        $this->end_date     = $action->get_value("end_date");
    }
    function insert($action){
        $this->get_values($action);

        if ($this->validate($action)){ 
    	   $this->db->insert("events", $this);
    	   $action->success($this->db->insert_id());
       }
    }
    function update($action){
    	$this->get_values($action);

        if ($this->validate($action)){ 
        	$this->db->update("events", $this, array("event_id" => $action->get_id()));
        	$action->success();
        }
    }

    function validate($action){
        if ($this->event_name == ""){
            $action->invalid();
            $action->set_response_attribute("details","Empty text is not allowed");

            return false;
        }
        return true;
    }

    function delete($action){
    	$this->db->delete("events", array("event_id" => $action->get_id()));
    	$action->success();
    }
    
}

?>