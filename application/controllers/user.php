<?php

class User extends CI_Controller {

  
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

    public function authenticate() {
        $this->load->model('user_model');
        $this->load->model('role_model');
        $uName = $this->input->post('uName');
        $password = md5($this->input->post('password'));
        $currentUser = $this->user_model->authenticate($uName, $password);
        if ($currentUser) {
            $role = $this->role_model->get_role_by_id($currentUser->roleId);
            if ($role) {
                $data['main_content'] = "home_view";
                $this->set_session_user($currentUser, $role);
		$this->load->view("layouts/main", $data);
            } else {
                $data['login_errors'] = 'Invalid user. Please contact administrator';
                $data['main_content'] = "welcome_view";
		$this->load->view("layouts/main", $data);
            }
        } else {
            $data['login_errors'] = 'Login failed. Please enter valid username and password';
            $data['main_content'] = "welcome_view";
            $this->load->view("layouts/main", $data);
        }
    }

    public function view_profile($userId) {
        $this->load->model('user_model');
        $this->load->model('task_model');
        $this->load->model('skill_model');
        
        $uId = base64_decode(urldecode($userId));
        $result = $this->task_model->getAverageUserRating($uId);
        foreach($result as &$value)
        {
             $data['rating']  = ceil($value['AvgRating']);
        }
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

        $this->user_model->update_user_profile();

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

        //redirect(base_url() . $user_page);
        //redirect(base_url());
    }
    
    public function addUser(){
        $this->load->model('user_model');
        $this->user_model->insert_user();
        $data['main_content'] = "home_view";
        $this->load->view("layouts/main", $data);  
    }
}
