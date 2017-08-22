<?php
class Customer extends CI_Controller {
    public function add() {
        $this->load->model('customer_model');
        $date = new DateTime("now", new DateTimeZone("Asia/Colombo"));
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
    public function add_unreg() {
        $this->load->model('customer_model');
        $date = new DateTime("now", new DateTimeZone("Asia/Colombo"));
        $typeInfo = $this->customer_model->getCustomerTypeInfoByCode('UG');
        $customerData = array(
            'name' => $this->input->post('name'),
            'code' => '',
            'typeId' => $typeInfo->id,
            'company' => $this->input->post('company'),
            'description' => '',
            'phone' => $this->input->post('phone'),
            'createdDate' => $date->format("Y-m-d H:i:s"),
            'active' => 1
        );
        $customerId = $this->customer_model->insertCustomer($customerData);
        $code = 'UG' . str_pad($customerId, 4, '0', STR_PAD_LEFT);
        $this->customer_model->updateCustomerCode($customerId, $code);
        $addressData = array(
            'customer_id' => $customerId,
            'region' => $this->input->post('region'),
            'address' => $this->input->post('address'),
            'phone_office' => '',
            'phone_mobile' => $this->input->post('phone')
        );
        $this->customer_model->insertCustomerAddress($addressData);
        $vehicleData = array(
            'customer_id' => $customerId,
            'regNo' => $this->input->post('regno'),
            'type' => '',
            'capacity' => '',
            'driverName' => $this->input->post('driver')
        );
        $this->customer_model->insertCustomerVehicle($vehicleData);
        $priceData = array(
            'customerId' => $customerId,
            'price' => $this->input->post('price'),
            'hidden' => 0,
            'addedUser' => $this->session->userdata('user_id')
        );
        $this->customer_model->addPriceForCustomer($priceData);
        redirect('/view/newPO/' . urlencode(base64_encode($customerId)));
    }
    public function addAddress() {
        $this->load->model('customer_model');
        $customerId = $this->input->post('customerId');
        $addressData = array(
            'customer_id' => base64_decode(urldecode($customerId)),
            'region' => $this->input->post('region'),
            'address' => $this->input->post('address'),
            'phone_office' => $this->input->post('phoneOffice'),
            'phone_mobile' => $this->input->post('phoneMobile')
        );
        $this->customer_model->insertCustomerAddress($addressData);
        redirect('/view/addAddress/' . $customerId);
    }
    public function removeAddress($addressId, $customerId) {
        $this->load->model('customer_model');
        $id = base64_decode(urldecode($addressId));
        $this->customer_model->removeAddress($id);
        redirect('/view/addAddress/' . $customerId);
    }
    public function addVehicle() {
        $this->load->model('customer_model');
        $customerId = $this->input->post('customerId');
        $vehicleData = array(
            'customer_id' => base64_decode(urldecode($customerId)),
            'regNo' => $this->input->post('regNo'),
            'type' => $this->input->post('type'),
            'capacity' => $this->input->post('capacity')
        );
        $this->customer_model->insertCustomerVehicle($vehicleData);
        redirect('/view/addVehicle/' . $customerId);
    }
    public function removeVehicle($vehicleId, $customerId) {
        $this->load->model('customer_model');
        $id = base64_decode(urldecode($vehicleId));
        $this->customer_model->removeVehicle($id);
        redirect('/view/addVehicle/' . $customerId);
    }
    public function removeCustomer($customerId) {
        $this->load->model('customer_model');
        $id = base64_decode(urldecode($customerId));
        $this->customer_model->removeCustomerVehiclesByCustomerId($id);
        $this->customer_model->removeCustomerAddressessByCustomerId($id);
        $this->customer_model->removeCustomer($id);
        redirect('/view/viewCustomers');
    }
    public function addDriver() {
        $this->load->model('customer_model');
        $customerId = $this->input->post('customerId');
        $driverData = array(
            'name' => $this->input->post('driverName'),
            'licenceNo' => $this->input->post('licenceNo'),
            'address' => $this->input->post('address'),
            'phone' => $this->input->post('phone'),
            'description' => $this->input->post('description'),
            'customerId' => base64_decode(urldecode($customerId))
        );
        $this->customer_model->insertDriver($driverData);
        redirect('/view/addDriver/' . $customerId);
    }
}
