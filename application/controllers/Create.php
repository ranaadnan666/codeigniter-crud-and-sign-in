<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Create extends CI_Controller {

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
	 * @see https://codeigniter.com/userguide3/general/urls.html
	 */
	public function __construct()
{
    parent::__construct();
    $this->load->model('user_modal'); // Load URL Helper
    $this->form_validation->set_error_delimiters('<div style="color:red">', '</div>');
}

	public function index()
	{
			$this->load->view('ajaxpost');
			// $this->form_validation->set_error_delimiters('div style="color:red"','</div>');
	}
	public function add_data(){
		$this->form_validation->set_rules('name','name','required');
		$this->form_validation->set_rules('email','email','required|valid_email');
		$this->form_validation->set_rules('city','city','required');

		if ($this->form_validation->run()==false){
			$this->load->view('ajaxpost');

		}
		else{
			//Save data successfully
			$post  =  $this->input->post();
			$this->user_modal->add_data($post);
			// echo "<pre>";
			// print_r($post); 
		}
	}
	public function cr_data() {
		$this->form_validation->set_rules('name', 'name', 'required');
		$this->form_validation->set_rules('email', 'email', 'required|valid_email');
		$this->form_validation->set_rules('city', 'city', 'required');
	
		if ($this->form_validation->run() == false) {
			$this->load->view('create');
		} else {
			// Save data successfully
			$post = $this->input->post();  // Use $this->input->post() to get POST data
			$this->user_modal->add_data($post);
            redirect(base_url() . 'index.php/read/index');

	
	}

}
}
