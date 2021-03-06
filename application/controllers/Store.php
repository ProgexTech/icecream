<?php

class Store extends CI_Controller {

    public function add() {
        $this->load->model('store_model');

        $storeData = array(
            'name' => $this->input->post('name'),
            'address' => $this->input->post('address'),
            'phone' => $this->input->post('phone'),
            'contactPerson' => $this->input->post('cperson')
        );

        $this->store_model->addStore($storeData);

        $url = '/view/viewConfigure/';
        redirect($url);
    }

}
