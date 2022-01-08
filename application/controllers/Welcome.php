<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */
	public function index()
	{
		$data['event_list'] = $this->event_model->get_eventList();
		$this->load->view('index', $data);
	}

	public function save_event(){		
		$result = $this->event_model->add_update_event_data();
		if($this->input->post('event_id')){
			$msg = 'Updated';
			$msg_fail = 'Updating';
		}else{
			$msg = 'Added';
			$msg_fail = 'Adding';
		}
		if ($result) {
			$this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissable"><button aria-hidden="true" data-dismiss="alert" class="close" type="button">x</button>'.$msg.' Successfully!!</div>');
		} else {
			$this->session->set_flashdata('message', '<div class="alert alert-danger alert-dismissable"><button aria-hidden="true" data-dismiss="alert" class="close" type="button">x</button>'.$msg_fail.' has been failed !!</div>');
		}
		redirect(base_url() . 'index', 'refresh');
	}

	public function remove_event($event_id){		
		$result = $this->event_model->delete_event($event_id);
		if ($result) {
			$this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissable"><button aria-hidden="true" data-dismiss="alert" class="close" type="button">x</button>Deleted Successfully!!</div>');
		} else {
			$this->session->set_flashdata('message', '<div class="alert alert-danger alert-dismissable"><button aria-hidden="true" data-dismiss="alert" class="close" type="button">x</button>Deleting has been failed !!</div>');
		}
		redirect(base_url() . 'index', 'refresh');
	}
}
