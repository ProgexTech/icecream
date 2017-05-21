<?php

class View extends CI_Controller {

    public function login() {
        $this->load->model('role_model');
        $data['main_content'] = "user/login";
        $this->load->view("layouts/main", $data);
    }

    public function profile($user_id) {
        echo "Profile";
    }

}
