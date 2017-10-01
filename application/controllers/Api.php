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
        $this->load->model('store_model');
        $this->load->model('customer_model');

        $data['customerId'] = $customerId;

        $prices = $this->customer_model->getPricesForCustomer($customerId);
        if ($prices) {
            $data['prices'] = $prices;
        } else {
            $data['prices'] = FALSE;
        }

        $this->load->view("api/prices_table", $data);
    }

    public function addPriceForCustomer($customerId, $type, $store, $price) {
        $this->load->model('user_model');
        $this->load->model('customer_model');
        $this->load->model('store_model');

        $priceData = array(
            'customerId' => $customerId,
            'price' => $price,
            'type' => $type,
            'storeId' => $store,
            'hidden' => 0,
            'addedUser' => $this->session->userdata('user_id')
        );

        $exists = $this->customer_model->isPriceAlreadyExists($customerId, $store, $type);
        if (!$exists) {
            $this->customer_model->addPriceForCustomer($priceData);
        }

        $data['customerId'] = $customerId;

        $prices = $this->customer_model->getPricesForCustomer($customerId);
        if ($prices) {
            $data['prices'] = $prices;
        } else {
            $data['prices'] = FALSE;
        }

        $this->load->view("api/prices_table", $data);
    }

    public function getPricesForCustomerByPaymentTypeAndLocation($customerId, $storeId, $paymentType) {
        $this->load->model('customer_model');

        $price = $this->customer_model->fetchPrice($customerId, $storeId, $paymentType);
        if ($price) {
            echo number_format((float) ($price->price), 2, '.', '');
        } else {
            echo "0.00";
        }
    }

    public function getRegion($addressId) {
        $this->load->model('customer_model');

        $address = $this->customer_model->getAddress($addressId);
        if ($address) {
            echo $address->region;
        } else {
            echo "Invalid Address";
        }
    }

}
