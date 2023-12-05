<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Users extends CI_Controller {
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
    $this->load->model('User_modal'); // Load URL Helper
    $this->form_validation->set_error_delimiters('<div style="color:red">', '</div>');
}

	public function index()
	{
	
		$this->load->view('Register');
 
	}
	public function reg_user() {
        // Validation rules
		$this->form_validation->set_rules('user_name', 'user_name', 'required');
		$this->form_validation->set_rules('email', 'email', 'required|valid_email');
		$this->form_validation->set_rules('password', 'password', 'required');

        if ($this->form_validation->run() == FALSE) {
            // Validation failed, show the registration form again
            $this->load->view('Register');
        } else {
            // Validation passed, register the user
			// $user_input_password = $this->input->post('password');
            $hashed_password = password_hash($this->input->post('password'), PASSWORD_BCRYPT);
            $data = array(
                'user_name' => $this->input->post('user_name'),
                'email' => $this->input->post('email'),
				'password' =>$hashed_password 
            );

            $this->User_modal->Register($data);
            redirect(base_url() . 'index.php/read/index');
        }
    }


	public function login() {
		{
	
			$this->load->view('login');
	 
		}
	}

	
	public function login_now(){
		$this->form_validation->set_rules('email', 'email', 'required|valid_email');
		$this->form_validation->set_rules('password', 'password', 'required');
		if ($this->form_validation->run() == FALSE) {
            // Validation failed, show the registration form again
            $this->load->view('login');

        } else {
            $hashed_password = password_hash($this->input->post('password'), PASSWORD_BCRYPT);
						$email = $this->input->post('email');
						
						$data = array(
							'email' => $this->input->post('email'),
							'password' => $hashed_password,
						);
						
						$status = $this->User_modal->checkpassword($password,$email);
						if ($status!=false){
							$user_name = $status->user_name;
							$password = $status->password;
							$session_data = array(
								'user_name' => $status->user_name,
								'password' => $status->password
							);
						
							redirect(base_url() . 'index.php/read/index');

						}
						else{

						}
			
        }
	   }






	//    forgetpassword

	public function forgot_password() {
        $this->load->view('forgot_password');
    }

    public function reset_password() {
        $this->form_validation->set_rules('email', 'Email', 'required|valid_email');
        
        if ($this->form_validation->run() == FALSE) {
            $this->load->view('forgot_password');
        } else {
            // $email = $this->input->post('email');
            // $user = $this->User_modal->get_user_by_email($email);
            // var_dump($user);
            $email = trim($this->input->post('email'));
            echo "Email to search: $email";
            $user = $this->User_modal->get_user_by_email($email);
            var_dump($user);
            if ($user) {
                // Generate a unique token and save it in the database
                $token = mt_rand(100000,999999);
                $this->User_modal->save_reset_token($user->Id, $token);
			   echo "<script>alert('data is correct.');</script>";
                
                // Send an email with a link to reset password
                // $this->send_reset_email($email, $token);

                $this->load->view('reset_password');
            } else {
                $data['error_message'] = 'Email not found.';
                $this->load->view('forgot_password', $data);
            }
        }
    }

    private function send_reset_email($email, $token) {
        // Your code to send an email with a link containing the token
        // Example: use the Email library
        $this->load->library('email');
        $this->email->from('your@example.com', 'Your Name');
        $this->email->to($email);
        $this->email->subject('Password Reset');
        $reset_link = base_url() . 'users//' . $token;
        $this->email->message('Click the following link to reset your password: ' . $reset_link);
        ini_set('SMTP', 'your_smtp_server');
ini_set('smtp_port', 587);  // Adjust the port if needed
ini_set('smtp_crypto', 'tls');  // Use 'tls' or 'ssl' if required
        $this->email->send();
        if (!$this->email->send()) {
            echo $this->email->print_debugger();
        }
    }

    public function reset($token) {
        // Verify the token and show the reset password form
        $user = $this->User_modal->get_user_by_token($token);

        if ($user) {
            // Token is valid, show the reset password form
            $data['token'] = $token;
            $this->load->view('reset_password_form', $data);
        } else {
            // Token is invalid
            $data['error_message'] = 'Invalid token.';
            $this->load->view('reset_password_error', $data);
        }
    }

    public function update_password() {
        $this->form_validation->set_rules('email', 'Email', 'required|');
        $this->form_validation->set_rules('password', 'Password', 'required|');
        $this->form_validation->set_rules('confirm_password', 'Confirm Password', 'required|matches[password]');
                $token = $this->input->post('token');
                $user = $this->User_modal->get_user_by_token($token);

            if ($user) {
                // confirm_password
                $password = $this->input->post('password');
                $confirm_password = $this->input->post('confirm_password');
                $this->User_modal->update_password($user->Id, $password,$confirm_password);
                $this->User_modal->clear_reset_token($user->Id);
                redirect(base_url() . 'index.php/read/index');
            } else {
                // Token is invalid
                $data['error_message'] = 'Invalid token.';
                $this->load->view('reset_password_error', $data);

            }
        // }
    }
}
	

