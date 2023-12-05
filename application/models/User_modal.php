<?php

class User_modal extends CI_Model {

public function getData(){
    $query = $this->db->get('users'); //get from user table
    return $query->result();
}

 public function add_data($post){
    $this->db->insert('users',$post); //insert into user table
}

public function get_user_by_id($id) {
    // Implement your method to get user data by ID from the database
    $this->db->where('Id', $id);
    $query = $this->db->get('users');
    return $query->row(); // Change to row() to return an object
}
public function update_user($id, $data) {
    // Implement your method to update a user in the database
    $this->db->where('Id', $id);
    $this->db->update('users', $data);
}

public function delete_user($id) {
    // Perform the deletion in the database
    $this->db->where('Id', $id);
    $this->db->delete('users');
}

public function Register($post){
    $this->db->insert('register',$post); //insert into user table
}
public function checkpassword($password, $email) {
    $query = $this->db->query("SELECT * FROM register WHERE password = ? AND email = ?", array($password, $email));
    
    if ($query->num_rows() == 1) {
        return $query->row();
    } else {
        return false;
    }
}



// forget password

// public function get_user_by_email($email) {
//     $query = $this->db->get_where('users', array('email' => $email));
//     return $query->row();
// }
public function get_user_by_email($email) {
    $query = $this->db->get_where('register', array('LOWER(email)' => strtolower($email)));
    return $query->row();
}
public function save_reset_token($user_id, $token) {
    $data = array('reset_token' => $token);
    $this->db->where('Id', $user_id);
    $this->db->update('register', $data);
}

public function get_user_by_token($token) {
    $this->db->select('*');
    $this->db->from('register');
    $this->db->where('reset_token', $token);
    $query = $this->db->get();

    // Print the last executed query
    echo $this->db->last_query();

    if ($query->num_rows() > 0) {
        $user = $query->row();
        // print_r($user);
    } else {
        echo "No user found with the given token.";
        return false;
    }
}
public function clear_reset_token($user_id) {
    $data = array('reset_token' => null);
    $this->db->where('Id', $user_id);
    $this->db->update('register', $data);
}

public function update_password($user_id, $password) {
    $data = array('password' => password_hash($password, PASSWORD_BCRYPT));
    $this->db->where('Id', $user_id);
    $this->db->update('register', $data);
}
}