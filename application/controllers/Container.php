<?php

class Container extends CI_Controller {

    public function add() {
        $this->load->model('container_model');
        $this->load->model('stock_model');

        $createdUserId = $this->session->userdata('user_id');
        $date = new DateTime();

        $containerData = array(
            'contCode' => $this->input->post('contCode'),
            'shipmentId' => $this->input->post('shipmentId'),
            'mWeek' => $this->input->post('mWeek'),
            'qty' => $this->input->post('qty'),
            'createdDate' => $date->format("Y-m-d H:i:s"),
             'unloadingDate'=>$this->input->post('unloadingDate'),
            'createdUserId' => $createdUserId
        );

        $containerId = $this->container_model->insertContainer($containerData);

        // Add to stock
        $stockData = array(
            'containerId' => $containerId,
            'mWeek' => $this->input->post('mWeek'),
            'qty' => $this->input->post('qty'),
            'currentQty' => $this->input->post('qty')
        );

        $this->stock_model->addToStock($stockData);

        $url = '/view/viewContainers/' . urlencode(base64_encode($this->input->post('shipmentId')));
        redirect($url);
    }

    public function remove($containerId) {
        $this->load->model('container_model');
     
        $cId = base64_decode(urldecode($containerId));
        $containerRow = $this->container_model->getContainerById($cId);
        $shipmentId = urlencode(base64_encode($containerRow->shipmentId));
        $this->container_model->remove($cId);

        $url = '/view/viewContainers/' . $shipmentId;
        redirect($url);
    }

}
