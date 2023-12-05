<?php

class Edit extends CI_Controller {
	public function __construct()
	{
		parent::__construct();
		// $this->load->model('user_modal'); // Load URL Helper
		$this->form_validation->set_error_delimiters('<div style="color:red">', '</div>');
	}

    public function index($id) {
        $this->load->model('User_modal');
        // Initialize $data
        $data = array();
        $data['user'] = $this->User_modal->get_user_by_id($id); // Implement this method in your model

        $this->form_validation->set_rules('name', 'name', 'required');
        $this->form_validation->set_rules('email', 'email', 'required|valid_email');
        $this->form_validation->set_rules('city', 'city', 'required');

        if ($this->form_validation->run() == false) {
            $this->load->view('edit', $data);
        } else {
            // Form validation passed
            // Process the form data, in this case, update the user
            $formArray = array();
            $formArray['name'] = $this->input->post('name');
            $formArray['email'] = $this->input->post('email');
            $formArray['city'] = $this->input->post('city');
            $this->User_modal->update_user($id, $formArray);
   // Add this line to check the posted data
            // Set a flash message for success
			// $this->session->set_flashdata('success', 'Records updated successfully');

            // Redirect to the 'read' controller
            redirect(base_url() . 'index.php/read/index');
        }
    }


    public function Record_edit($id) {
        $this->load->model('User_modal');
    
        $data = array();
        $data['user'] = $this->User_modal->get_user_by_id($id);
    
        $this->form_validation->set_rules('name', 'name', 'required');
        $this->form_validation->set_rules('email', 'email', 'required|valid_email');
        $this->form_validation->set_rules('city', 'city', 'required');
    
        if ($this->form_validation->run() == false) {
            $this->load->view('Ajedit', $data);
        } else {
            $formArray = array();
            $formArray['name'] = $this->input->post('name');
            $formArray['email'] = $this->input->post('email');
            $formArray['city'] = $this->input->post('city');
            $this->User_modal->update_user($id, $formArray);
    
            // $response = array('success' => true, 'message' => 'Record updated successfully');
        }
    }
    
}