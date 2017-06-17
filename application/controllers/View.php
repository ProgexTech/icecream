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
        $data['main_content'] = "user/edit_user";
        $this->load->view("layouts/main", $data);
    }

    public function registerUser() {
        $this->load->model('role_model');
        $data['main_content'] = "user/add_user";
        $this->load->view("layouts/main", $data);
    }

    public function placeOrder() {
        $this->load->model('order_model');
        $data['main_content'] = "order/add_order";
        $this->load->view("layouts/main", $data);
    }

    public function viewOrders() {
        $this->load->model('order_model');
        $this->load->model('user_model');

        $data['main_content'] = "order/view_orders";
        $this->load->view("layouts/main", $data);
    }

    public function editOrder($orderId) {
        $this->load->model('order_model');
        $data['orderId'] = $orderId;
        $data['main_content'] = 'order/edit_order';
        $this->load->view("layouts/main", $data);
    }

    public function addShipment($orderId = NULL) {
        $this->load->model('order_model');
        $data['orderId'] = $orderId;
        $data['main_content'] = 'shipment/add_shipment';
        $this->load->view("layouts/main", $data);
    }

    // purchase orders
    public function placePO() {
        $data['main_content'] = "po/place_po";
        $this->load->view("layouts/main", $data);
    }

    public function viewPOs() {
        $data['main_content'] = "po/view_pos";
        $this->load->view("layouts/main", $data);
    }

    // customers
    public function addCustomer() {
        $data['main_content'] = "customer/add_customer";
        $this->load->view("layouts/main", $data);
    }

    public function viewCustomers() {
        $data['main_content'] = "customer/view_customers";
        $this->load->view("layouts/main", $data);
    }

}
