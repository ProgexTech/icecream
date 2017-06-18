<?php

class Container extends CI_Controller {

    public function add() {
        $this->load->model('container_model');
        
        $createdUserId = $this->session->userdata('user_id');
        $date = new DateTime();
        
        $containerData = array(
            'contCode' => $this->input->post('contCode'),
            'shipmentId' => $this->input->post('shipmentId'),
            'mWeek' => $this->input->post('mWeek'),
            'qty' => $this->input->post('qty'),
            'createdDate' => $date->format("Y-m-d H:i:s"),
            'createdUserId' => $createdUserId
        );
        
        $this->container_model->insertContainer($containerData);
        
        $url = '/view/viewContainers/' . urlencode(base64_encode($this->input->post('shipmentId')));
        redirect($url);
    }
    
}
