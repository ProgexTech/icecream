<?php

class Customer_model extends CI_Model {

    public function insertCustomer($customerData) {
        $this->db->insert('customer', $customerData);
        return $this->db->insert_id();
    }

    // For unregistered customers
    public function updateCustomerCode($id, $code) {
        $this->db->where('id', $id);
        $data = array(
            'code' => $code
        );
        $this->db->update('customer', $data);
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

    public function getAllCustomersByType($type_id) {
        $this->db->where('typeId', $type_id);
        $result = $this->db->get('customer');

        if ($result->num_rows() != 0) {
            return $result->result();
        }
        return FALSE;
    }

    public function getCustomerTypeInfoById($customer_type_id) {
        $this->db->where('id', $customer_type_id);
        $result = $this->db->get('customer_type');

        if ($result->num_rows() != 0) {
            return $result->row(0);
        }
        return FALSE;
    }

    public function getCustomerTypeInfoByCode($customer_type_code) {
        $this->db->where('code', $customer_type_code);
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

    public function getAddress($address_id) {
        $this->db->where('id', $address_id);
        $result = $this->db->get('customer_address');

        if ($result->num_rows() != 0) {
            return $result->row(0);
        }
        return FALSE;
    }

    public function removeAddress($id) {
        $this->db->where('id', $id);
        $this->db->delete('customer_address');
    }

    public function getCustomerVehicleInfo($customer_vehicle_id) {
        $this->db->where('customer_id', $customer_vehicle_id);
        $result = $this->db->get('customer_vehicle');

        if ($result->num_rows() != 0) {
            return $result->row(0);
        }
        return FALSE;
    }

    public function getAllVehiclesForCustomer($customer_id) {
        $this->db->where('customer_id', $customer_id);
        $result = $this->db->get('customer_vehicle');

        if ($result->num_rows() != 0) {
            return $result->result();
        }
        return FALSE;
    }

    public function insertCustomerVehicle($vehicleData) {
        $this->db->insert('customer_vehicle', $vehicleData);
    }

    public function removeVehicle($id) {
        $this->db->where('id', $id);
        $this->db->delete('customer_vehicle');
    }

    public function getVehicle($vehicle_id) {
        $this->db->where('id', $vehicle_id);
        $result = $this->db->get('customer_vehicle');

        if ($result->num_rows() != 0) {
            return $result->row(0);
        }
        return FALSE;
    }

    public function removeCustomer($id) {
        $this->db->where('id', $id);
        $this->db->delete('customer');
    }

    public function removeCustomerAddressessByCustomerId($id) {
        $this->db->where('customer_id', $id);
        $this->db->delete('customer_address');
    }

    public function removeCustomerVehiclesByCustomerId($id) {
        $this->db->where('customer_id', $id);
        $this->db->delete('customer_vehicle');
    }

    public function getPricesForCustomer($customerId) {
        $this->db->where('customerId', $customerId);
        $result = $this->db->get('customer_price');

        if ($result->num_rows() != 0) {
            return $result->result();
        }
        return FALSE;
    }

    public function isPriceAlreadyExists($customerId, $storeId, $type) {
        $this->db->where('storeId', $storeId);
        $this->db->where('type', $type);
        $this->db->where('customerId', $customerId);
        $result = $this->db->get('customer_price');

        if ($result->num_rows() != 0) {
            return TRUE;
        }
        return FALSE;
    }

    public function addPriceForCustomer($priceData) {
        $this->db->insert('customer_price', $priceData);
    }

    public function getPriceById($id) {
        $this->db->where('id', $id);
        $result = $this->db->get('customer_price');

        if ($result->num_rows() != 0) {
            return $result->result();
        }
        return FALSE;
    }

    public function getCustomerCount() {
        return $this->db->count_all("customer");
    }

    public function fetchData($limit, $start) {
        $this->db->limit($limit, $start);
        $query = $this->db->get("customer");
        if ($query->num_rows() > 0) {
            foreach ($query->result() as $row) {
                $data[] = $row;
            }
            return $data;
        }
        return false;
    }

    public function fetchPrice($customerId, $storeId, $paymentType) {
        $condition = array('customerId' => $customerId, 'storeId' => $storeId, 'type' => $paymentType);
        $this->db->where($condition);
        $result = $this->db->get('customer_price');

        if ($result->num_rows() != 0) {
            return $result->row(0);
        }
        return FALSE;
    }

    // Drivers
    public function insertDriver($driverData) {
        $this->db->insert('customer_driver', $driverData);
    }

    public function removeDriver($driverId) {
        $this->db->where('id', $driverId);
        $this->db->delete('customer_driver');
    }

    public function getDriver($driverId) {
        $this->db->where('id', $driverId);
        $result = $this->db->get('customer_driver');

        if ($result->num_rows() != 0) {
            return $result->row(0);
        }
        return FALSE;
    }

    public function getAllDriversForCustomer($customerId) {
        $this->db->where('customerId', $customerId);
        $result = $this->db->get('customer_driver');

        if ($result->num_rows() != 0) {
            return $result->result();
        }
        return FALSE;
    }

}
