<?php

class Shipment extends CI_Controller {

    public function add() {
        $this->load->model('shipment_model');
        
        $createdUserId = $this->session->userdata('user_id');
        $date = new DateTime();
        
        $shipmentData = array(
            'orderId' => $this->input->post('orderId'),
            'shippingNo' => $this->input->post('shippingNo'),
            'shipmentDate' => $this->input->post('shipmentDate'),
            'createdDate' => $date->format("Y-m-d H:i:s"),
            'createdUserId' => $createdUserId
        );
        
        $this->shipment_model->insertShipment($shipmentData);
        
        $url = '/view/viewShipments/' . urlencode(base64_encode($this->input->post('orderId')));
        redirect($url);
        //$data['main_content'] = "home_view";
        //$this->load->view("layouts/main", $data);
    }

}
