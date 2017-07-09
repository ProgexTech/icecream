<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Api extends CI_Controller {

    public function index() {
        show_404();
    }

    public function getCustomersByType($typeCode) {
        $this->load->model('customer_model');
        $data = NULL;

        if ($typeCode === 'ALL') {
            $customers = $this->customer_model->getAllCustomers();
            if ($customers) {
                $data['customers'] = $customers;
            } else {
                $data['customers'] = FALSE;
            }            
        } else {
            $customerType = $this->customer_model->getCustomerTypeInfoByCode($typeCode);
            $customers = $this->customer_model->getAllCustomersByType($customerType->id);
            if ($customers) {
                $data['customers'] = $customers;
            } else {
                $data['customers'] = FALSE;
            }
        }

        $this->load->view("api/customer_table", $data);
    }
    
    public function getPricesForCustomer($customerId) {
        $this->load->model('user_model');
        $this->load->model('customer_model');
        $data = NULL;

        $prices = $this->customer_model->getPricesForCustomer($customerId);
        if ($prices) {
            $data['prices'] = $prices;
        } else {
            $data['prices'] = FALSE;
        }            
        
        $this->load->view("api/prices_table", $data);   
    }
    
    public function addPriceForCustomer($customerId, $price) {
        $this->load->model('user_model');
        $this->load->model('customer_model');
        
        $priceData = array(
            'customerId' => $customerId,
            'price' => $price,
            'hidden' => 0,
            'addedUser' => $this->session->userdata('user_id')
        );
        
        $this->customer_model->addPriceForCustomer($priceData);
        
        $data = NULL;

        $prices = $this->customer_model->getPricesForCustomer($customerId);
        if ($prices) {
            $data['prices'] = $prices;
        } else {
            $data['prices'] = FALSE;
        }            
        
        $this->load->view("api/prices_table", $data);   
    }

}
