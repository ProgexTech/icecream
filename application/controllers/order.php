<?php
class order extends CI_Controller {

    public function index(){
        $this->load->model('order_model');
        $data['main_content'] = "add_order_view";
        $this->load->view("layouts/main", $data);
    }
    
    public function addOrder(){
        $this->load->model('order_model');
        
         $orderData = array(
            'refNo' => $this->input->post('refNo'),
            'country' => $this->input->post('country'),
            'company' => $this->input->post('company'),
            'orderNo' => $this->input->post('orderNo'),
            'field1' => $this->input->post('field1'),
            'field2' => $this->input->post('field2'),
            'userId' => $this->session->userdata('user_id')
        );

        $this->order_model->insertOrder($orderData);
        $data['main_content'] = "home_view";
        $this->load->view("layouts/main", $data);  
    }
    
    public function viewOrders(){
        $this->load->model('order_model');
        $this->load->model('user_model');
        
        $data['main_content'] = "view_orders_view";
        $this->load->view("layouts/main", $data); 
    }
}
