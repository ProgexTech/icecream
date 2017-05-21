<?php

class User extends CI_Controller {
  
    public function register(){
        $this->load->model('role_model');
        $data['main_content'] = "user_registration_view";
        $this->load->view("layouts/main", $data);
    }
    
    public function editProfile(){
        $this->load->model('user_model');
         $data['main_content'] = "edit_user_view";
        $this->load->view("layouts/main", $data);
    }
    
    public function logout() {
        $this->session->unset_userdata('user_id');
        $this->session->unset_userdata('username');
        $this->session->unset_userdata('display_name');
        $this->session->unset_userdata('usertype');
        $this->session->unset_userdata('logged_in');
        $this->session->unset_userdata('permission');
        $this->session->sess_destroy();

        redirect(base_url());
    }

    public function login() {
        $this->load->model('user_model');
        $this->load->model('role_model');
        $uName = $this->input->post('uName');
        $password = md5($this->input->post('password'));
        $currentUser = $this->user_model->authenticate($uName, $password);
        if ($currentUser) {
            $role = $this->role_model->getRoleById($currentUser->roleId);
            if ($role) {
                $data['main_content'] = "home_view";
                $this->set_session_user($currentUser, $role);
		$this->load->view("layouts/main", $data);
            } else {
                $data['login_errors'] = 'Invalid user. Please contact administrator';
                $data['main_content'] = "login_view";
		$this->load->view("layouts/main", $data);
            }
        } else {
            $data['login_errors'] = 'Login failed. Please enter valid username and password';
            $data['main_content'] = "login_view";
            $this->load->view("layouts/main", $data);
        }
    }

    public function view_profile($userId) {
        $this->load->model('user_model');        
        $uId = base64_decode(urldecode($userId));
        
        $data['userId'] = $userId;
        $data['main_content'] = "user_profile";
        $this->load->view("layouts/main", $data);
    }

    public function update_profile() {
        $this->load->model('user_model');
        $result = $this->user_model->authenticate();
        if ($result == FALSE) {
            $data['login_errors'] = 'Old password is incorrect';
        }

        $this->user_model->updateUserProfile();

        $data['main_content'] = "user_profile";
        $this->load->view("layouts/main", $data);
    }

    // Private functions
    private function set_session_user($user, $role) {
        $userData = array(
            'user_id' => $user->id,
            'display_name' => $user->name,
            'usertype' => $role->name,
            'permission' => $role->permission,
            'logged_in' => TRUE
        );

        $this->session->set_userdata($userData);
        $user_page = str_replace(' ', '', strtolower($role->name)); // This will load the usertype controller

    }
    
    public function addUser(){
        $this->load->model('user_model');
        $userData = array(
            'email' => $this->input->post('email'),
            'password' => md5($this->input->post('password')),
            'roleId' => $this->input->post('role'),
            'name' => $this->input->post('name'),
            'nic' => $this->input->post('nic'),
            'phone' => $this->input->post('phone'),
            'address' => $this->input->post('address'),
            'uName' => $this->input->post('uName')
        );

        $this->user_model->insertUser($userData);
        $data['main_content'] = "home_view";
        $this->load->view("layouts/main", $data);  
    }
}
