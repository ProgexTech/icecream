<?php

class Customer_model extends CI_Model {

    public function insertCustomer($customerData) {
        $this->db->insert('customer', $customerData);
    }

    public function getCustomerById($customer_id) {
        $this->db->where('id', $customer_id);
        $result = $this->db->get('customer');

        if ($result->num_rows() != 0) {
            return $result->row(0);
        }
        return FALSE;
    }

    public function getAllCustomers() {
        $result = $this->db->get('customer');

        if ($result->num_rows() != 0) {
            return $result->result();
        }
        return FALSE;
    }

    public function getCustomerTypeInfo($customer_type_id) {
        $this->db->where('id', $customer_type_id);
        $result = $this->db->get('customer_type');

        if ($result->num_rows() != 0) {
            return $result->row(0);
        }
        return FALSE;
    }

    public function getAllCustomerTypes() {
        $result = $this->db->get('customer_type');

        if ($result->num_rows() != 0) {
            return $result->result();
        }
        return FALSE;
    }

    public function getCustomerAddressInfo($customer_address_id) {
        $this->db->where('customer_id', $customer_address_id);
        $result = $this->db->get('customer_address');

        if ($result->num_rows() != 0) {
            return $result->row(0);
        }
        return FALSE;
    }

    public function getAllAddressesForCustomer($customer_id) {
        $this->db->where('customer_id', $customer_id);
        $result = $this->db->get('customer_address');

        if ($result->num_rows() != 0) {
            return $result->result();
        }
        return FALSE;
    }

    public function insertCustomerAddress($customerAddress) {
        $this->db->insert('customer_address', $customerAddress);
    }
    
    public function removeAddress($id){
        $this->db->where('id', $id);
        $this->db->delete('customer_address');
    }

    public function getAllVehiclesForCustomer($customer_id) {
        $this->db->where('customer_id', $customer_id);
        $result = $this->db->get('customer_vehicle');

        if ($result->num_rows() != 0) {
            return $result->result();
        }
        return FALSE;
    }
    
    public function insertCustomerVehicle($vehicleData){
      $this->db->insert('customer_vehicle', $vehicleData);  
    }
    
    public function removeVehicle($id){
        $this->db->where('id', $id);
        $this->db->delete('customer_vehicle');
    }
}
