<?php

class Customer extends CI_Controller {

    public function add() {
        $this->load->model('customer_model');
        $date = new DateTime();
        
        $customerData = array(
            'name' => $this->input->post('name'),
            'code' => $this->input->post('code'),
            'typeId' => $this->input->post('type'),
            'company' => $this->input->post('company'),
            'description' => $this->input->post('description'),
            'phone' => $this->input->post('phone'),
            'createdDate' => $date->format("Y-m-d H:i:s"),
            'active' => 1
        );

        $this->customer_model->insertCustomer($customerData);
        
        redirect('/view/viewCustomers');
    }
    
}
