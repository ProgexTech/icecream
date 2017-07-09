<?php

class PurchaseOrder extends CI_Controller {

    public function add() {
        $this->load->model('purchaseOrder_model');
        //$date = new DateTime();

        $poData = array(
            'customerId' => $this->input->post('customer_id'),
            'customerAddressId' => $this->input->post('customerAddress_id'),
            'customerVehicleId' => $this->input->post('customerVehicle_id'),
            'customerPriceId' => $this->input->post('customerPrice_id'),
            'deliveryType' => $this->input->post('delivery_type'),
            'saleType' => $this->input->post('sale_type'),
            'quantity' => $this->input->post('quantity'),
            'createdDate' => $this->input->post('date_time')
        );

        $poId = $this->purchaseOrder_model->insertPO($poData);
        
        redirect('/view/printPO/'.  urlencode(base64_encode($poId)));
    }

}
