<?php

class Shipment extends CI_Controller {

    public function add() {
        $this->load->model('shipment_model');

        $createdUserId = $this->session->userdata('user_id');
        $date = new DateTime("now", new DateTimeZone("Asia/Colombo"));

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

    public function remove($shipmentId) {
        $this->load->model('container_model');
        $this->load->model('shipment_model');

        $sId = base64_decode(urldecode($shipmentId));
        $shipment = $this->shipment_model->getShipmentById($sId);
        $orderId = urlencode(base64_encode($shipment->orderId));
        $this->shipment_model->remove($sId);
        $this->container_model->removeContainersBelongToShipment($sId);

        $url = '/view/viewShipments/' . $orderId;
        redirect($url);
    }

    public function edit() {
        $this->load->model('shipment_model');

        $createdUserId = $this->session->userdata('user_id');
        $date = new DateTime("now", new DateTimeZone("Asia/Colombo"));
        $shippingId = $this->input->post('shipmentId');
        $shipmentData = array(
            'shipmentDate' => $this->input->post('shipmentDate'),
            'shippingNo' => $this->input->post('shippingNo')
        );

        $this->shipment_model->updateShipment($shippingId, $shipmentData);

        $url = '/view/viewShipments/' . urlencode(base64_encode($this->input->post('orderId')));
        redirect($url);
    }

}
