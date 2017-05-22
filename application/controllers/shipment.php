<?php

class shipment extends CI_Controller {
    
    public function addShipment(){
        //$this->load->model('shipment_model');
        $this->load->model('order_model');
        $orderData = $this->order_model->getOrderByOrderNumber($this->input->post('orderNo'));
         $orderData = array(
            'shippingId' => $this->input->post('shippingId'),
            'orderId' => $orderData[0]['id'],
            'date' => $this->input->post('date'),
            'manufacturingWeek' => $this->input->post('mWeek')
        );
        //$containerData = $this->input->post('container');
        
        $count = $this->input->post('count');
        $output='';
for($i=0;$i<=$count;$i++)
    {
        echo $this->input->post('container'.$i);
    }
echo $output;
        //echo json_encode($containerData);
        //$this->order_model->insertOrder($orderData);
        $data['main_content'] = "home_view";
        $this->load->view("layouts/main", $data);   
    }
}