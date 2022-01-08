<?php

date_default_timezone_set('UTC');
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Event_model extends CI_Model {
    function add_update_event_data(){ 
        if($this->input->post('event_id')){
            $datetime = date('Y-m-d H:i:s');
            $data = array(
                'name' => $this->input->post('event_name'),
                'description' => $this->input->post('event_desc'),
                'location' => $this->input->post('event_loc'),
                'event_date' => $this->input->post('event_date'),            
                'date_modified' => $datetime,            
            );
            $this->db->where('id', $this->input->post('event_id'));
            $query = $this->db->update('ems_events', $data);
        }else{
            $data = array(
                'name' => $this->input->post('event_name'),
                'description' => $this->input->post('event_desc'),
                'location' => $this->input->post('event_loc'),
                'event_date' => $this->input->post('event_date'),            
            );

            $query = $this->db->insert('ems_events', $data);
        }
        return $query;
    }

    function get_eventList(){
        $query = $this->db->get('ems_events');
        return $query->result_array();
    }

    function delete_event($id){        
       $this->db->where('id', $id);
       $query = $this->db->delete('ems_events');
       return $query;
   }
}

?>