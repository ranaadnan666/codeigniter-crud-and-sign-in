<?php

class Read extends CI_Controller {


	public function index()
	{
		$this->load->database();  
		$this->load->model('User_modal');
		$data['user'] = $this->User_modal->getData();
		$this->load->view('readview',$data);
 
	}
	
}
