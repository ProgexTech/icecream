<?php

class View extends CI_Controller {

    // User
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

    // Stock Order
    public function placeOrder() {
        $this->load->model('order_model');
        $data['main_content'] = "order/add_order";
        $this->load->view("layouts/main", $data);
    }

    public function viewOrders() {
        $this->load->model('order_model');
        $this->load->model('user_model');

        $this->load->library('pagination');

        $config = array();
        $config["base_url"] = base_url() . "view/viewOrders";
        $total_row = $this->order_model->getOrderCount();
        $config["total_rows"] = $total_row;
        $config["per_page"] = 1;
        $config['use_page_numbers'] = TRUE;
        $config['num_links'] = $total_row;
        $config['cur_tag_open'] = '&nbsp;<a class="current">';
        $config['cur_tag_close'] = '</a>';
        $config['next_link'] = 'Next';
        $config['prev_link'] = 'Previous';
        $config["uri_segment"] = 3;

        $this->pagination->initialize($config);
        $page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
        $offset = $page==0? 0: ($page-1)*$config["per_page"];
        $data["results"] = $this->order_model->fetchData($config["per_page"], $offset);
        $data["links"] = $this->pagination->create_links();

        $data['main_content'] = "order/view_orders";
        $this->load->view("layouts/main", $data);
    }

    public function editOrder($orderId) {
        $this->load->model('order_model');
        $data['orderId'] = $orderId;
        $data['main_content'] = 'order/edit_order';
        $this->load->view("layouts/main", $data);
    }

    public function viewStock() {
        $data['main_content'] = 'order/view_stock';
        $this->load->view("layouts/main", $data);
    }

    public function viewOrder($orderId) {
        $this->load->model('order_model');
        $this->load->model('shipment_model');
        $this->load->model('container_model');
        $data['orderId'] = $orderId;
        $data['main_content'] = 'order/view_order_details';
        $this->load->view("layouts/main", $data);
    }

    // Shipment
    public function viewShipments($orderId) {
        $this->load->model('order_model');
        $this->load->model('shipment_model');
        $this->load->model('container_model');
        $data['orderId'] = $orderId;
        $data['main_content'] = 'shipment/view_shipments';
        $this->load->view("layouts/main", $data);
    }

    public function viewShipment($shipmentId) {
        $this->load->model('order_model');
        $this->load->model('shipment_model');
        $this->load->model('container_model');
        $data['shipmentId'] = $shipmentId;
        $data['main_content'] = 'shipment/view_shipment_details';
        $this->load->view("layouts/main", $data);
    }

    // Container
    public function viewContainers($shipmentId) {
        $this->load->model('shipment_model');
        $this->load->model('container_model');
        $data['shipmentId'] = $shipmentId;
        $data['main_content'] = 'container/view_containers';
        $this->load->view("layouts/main", $data);
    }

    // Purchase Order
    public function addPO() {
        $this->load->model('customer_model');
        $data['main_content'] = "po/add_po";
        $this->load->view("layouts/main", $data);
    }
    
    public function newPO($customerId, $type=1) {
        $this->load->model('customer_model');
        $data['customerId'] = $customerId;
        $data['type'] = $type;
        $data['main_content'] = "po/new_po";
        $this->load->view("layouts/main", $data);
    }

    public function viewPOs() {
        $data['main_content'] = "po/view_pos";
        $this->load->view("layouts/main", $data);
    }

    // Customers
    public function addCustomer() {
        $this->load->model('customer_model');
        $data['main_content'] = "customer/add_customer";
        $this->load->view("layouts/main", $data);
    }

    public function viewCustomers() {
        $this->load->model('customer_model');
        $data['main_content'] = "customer/view_customers";
        $this->load->view("layouts/main", $data);
    }

    public function addAddress($customerId) {
        $this->load->model('customer_model');
        $data['customerId'] = $customerId;
        $data['main_content'] = "customer/add_customer_address";
        $this->load->view("layouts/main", $data);
    }

    public function addVehicle($customerId) {
        $this->load->model('customer_model');
        $data['customerId'] = $customerId;
        $data['main_content'] = "customer/add_customer_vehicle";
        $this->load->view("layouts/main", $data);
    }
    
    public function viewUnregCustomers() {
        $this->load->model('customer_model');
        $data['main_content'] = "customer/view_unreg_customers";
        $this->load->view("layouts/main", $data);
    }

    public function editShipment($shipmentId) {
        $this->load->model('shipment_model');
        $data['shipmentId'] = $shipmentId;
        $data['main_content'] = "shipment/edit_shipment";
        $this->load->view("layouts/main", $data);
    }

    public function editContainer($containerId, $shipmentId) {
        $this->load->model('shipment_model');
        $this->load->model('container_model');
        $data['shipmentId'] = $shipmentId;
        $data['containerId'] = $containerId;
        $data['main_content'] = "container/edit_container";
        $this->load->view("layouts/main", $data);
    }

}
