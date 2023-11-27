<?php
class Delete extends CI_Controller {

        public function delete_user($user_id) {
            // Load the User_model
            $this->load->model('User_modal');
            
            // Call the delete_user method from the model
            $this->User_modal->delete_user($user_id);
            redirect(base_url() . 'index.php/read/index');


        }
        public function delete_ajax() {
            $this->load->model('User_modal');

            $id = $this->input->post('id'); // Assuming you're passing the ID through POST
    
            // Delete the data in the model
            $result = $this->User_modal->delete_user($id);
    
            // Return a response (you can customize this based on your needs)
            if ($result) {
                echo json_encode(array('success' => true));
            } else {
                echo json_encode(array('success' => false, 'message' => 'Failed to delete data'));
            }
        }
    
}