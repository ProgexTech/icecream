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

    public function addAddress() {
        $this->load->model('customer_model');
        
        $customerId = $this->input->post('customerId');
        
        $addressData = array(
            'customer_id' => base64_decode(urldecode($customerId)),
            'address' => $this->input->post('address'),
            'phone_office' => $this->input->post('phoneOffice'),
            'phone_mobile' => $this->input->post('phoneMobile')
        );

        $this->customer_model->insertCustomerAddress($addressData);

        redirect('/view/addAddress/'.$customerId);
    }

    public function removeAddress($addressId, $customerId){
        $this->load->model('customer_model');
     
        $id = base64_decode(urldecode($addressId));
        $this->customer_model->removeAddress($id);

        redirect('/view/addAddress/'.$customerId);    
    }
}
