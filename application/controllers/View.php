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

    public function registerUser(){
        $this->load->model('role_model');
        $data['main_content'] = "user_registration_view";
        $this->load->view("layouts/main", $data);
    }
    
    public function placeOrder() {
        $this->load->model('order_model');
        $data['main_content'] = "add_order_view";
        $this->load->view("layouts/main", $data);
    }
    
    public function viewOrders(){
        $this->load->model('order_model');
        $this->load->model('user_model');
        
        $data['main_content'] = "view_orders_view";
        $this->load->view("layouts/main", $data); 
    }
}
