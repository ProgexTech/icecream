<?php

class View extends CI_Controller {

    public function login() {
        $this->load->model('role_model');
        $data['main_content'] = "user/login";
        $this->load->view("layouts/main", $data);
    }

    public function editProfile() {
        $this->load->model('user_model');
        //$uId = $this->session->userdata('user_id');
        //$data['userId'] = base64_encode(urlencode($uId));
        $data['main_content'] = "edit_user_view";
        $this->load->view("layouts/main", $data);
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
    
    public function editOrder($orderId){
        $this->load->model('order_model');
        $data['orderId'] = $orderId;
        $data['main_content'] = 'edit_order_view';
        $this->load->view("layouts/main", $data); 
    }
    
    public function addShipmentView(){
        $data['main_content'] = 'add_shipment_data_view';
        $this->load->view("layouts/main", $data); 
    }
}
