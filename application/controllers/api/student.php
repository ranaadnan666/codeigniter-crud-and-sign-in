// application/controllers/Api.php

defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . 'libraries/REST_Controller.php';

class Student extends REST_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('Your_model'); // Load your model for database operations
    }

    // Create
    public function index_post() {
        <!-- $data = $this->post();
        $result = $this->Your_model->create($data);
        $this->response($result, REST_Controller::HTTP_CREATED); -->
        echo "This is Post Method";
    }

    // Read
    public function index_get() {
        <!-- if ($id === NULL) {
            $result = $this->Your_model->read_all();
        } else {
            $result = $this->Your_model->read_one($id);
        }
        $this->response($result, REST_Controller::HTTP_OK); -->
        echo "This is Get Method";
        
    }

    // Update
    public function index_put($id) {
        $data = $this->put();
        $result = $this->Your_model->update($id, $data);
        $this->response($result, REST_Controller::HTTP_OK);
    }

    // Delete
    public function index_delete($id) {
        $result = $this->Your_model->delete($id);
        $this->response($result, REST_Controller::HTTP_OK);
    }
}
