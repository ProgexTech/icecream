<?php

class Shipment extends CI_Controller {

    public function add() {
        $this->load->model('shipment_model');
        $this->load->model('order_model');
        $orderData = $this->order_model->getOrderByOrderNumber($this->input->post('orderNo'));
        $shipmentData = array(
            'shippingId' => $this->input->post('shippingId'),
            'orderId' => $orderData->id,
            'date' => $this->input->post('date'),
            'manufacturingWeek' => $this->input->post('mWeek')
        );

        $shipmentId = $this->shipment_model->insertShipment($shipmentData);
        $count = $this->input->post('count');
        for ($i = 1; $i < $count; $i++) {
            echo " " . $i . "-" . $this->input->post('container' . $i);
            $containerData = array(
                'shipmentId' => $shipmentId,
                'qty' => $this->input->post('container' . $i)
            );

            $this->shipment_model->insertContainer($containerData);
        }
        
        redirect('/');
        //$data['main_content'] = "home_view";
        //$this->load->view("layouts/main", $data);
    }

}
