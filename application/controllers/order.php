<?php
class order extends CI_Controller {
    
    public function addOrder(){
        $this->load->model('order_model');
        
         $orderData = array(
            'refNo' => $this->input->post('refNo'),
            'country' => $this->input->post('country'),
            'company' => $this->input->post('company'),
            'orderNo' => $this->input->post('orderNo'),
            'field1' => $this->input->post('field1'),
            'field2' => $this->input->post('field2'),
            'qty' => $this->input->post('qty'),
            'userId' => $this->session->userdata('user_id')
        );

        $this->order_model->insertOrder($orderData);
        $data['main_content'] = "home_view";
        $this->load->view("layouts/main", $data);  
    }
    
    public function edit(){
       $this->load->model('order_model');
       $this->load->model('user_model');
       
        $oId = base64_decode(urldecode($this->input->post('orderId')));
         $orderData = array(
            'refNo' => $this->input->post('refNo'),
            'country' => $this->input->post('country'),
            'company' => $this->input->post('company'),
            'orderNo' => $this->input->post('orderNo'),
            'field1' => $this->input->post('field1'),
            'field2' => $this->input->post('field2'),
            'qty' => $this->input->post('qty'),
            'userId' => $this->session->userdata('user_id')
        );
        $this->order_model->updateOrder($oId, $orderData);
        
        $data['main_content'] = "view_orders_view";
        $this->load->view("layouts/main", $data);   
    }
    
    public function cancel($orderId){
       $this->load->model('order_model');
       $this->load->model('user_model');
       
        $this->order_model->updateOrderStatus(base64_decode(urldecode($orderId)), '1');
        
        $data['main_content'] = "view_orders_view";
        $this->load->view("layouts/main", $data); 
    }
}
