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

        redirect('/view/printPO/' . urlencode(base64_encode($poId)));
    }

    public function finalize() {
        $this->load->model('purchaseOrder_model');
        $this->load->model('sale_model');
        $this->load->model('stock_model');
        $this->load->model('bill_model');

        $qty = $this->input->post('issuedQty');
        $uPrice = $this->input->post('unitPrice');
        $poId = base64_decode(urldecode($this->input->post('poId')));

        $po = $this->purchaseOrder_model->getPOById($poId);

        $amount = $uPrice * $qty;

        $billData = array(
            'customerId' => $po->customerId,
            'poId' => $poId,
            'userId' => $this->session->userdata('user_id'),
            'amount' => $amount,
            'qty' => $qty
        );

        $billId = $this->bill_model->insertBill($billData);

        $tempQty = $qty;

        $allStock = $this->stock_model->getAllInstockRecords();
        if ($allStock != FALSE)
            foreach ($allStock as $row) {

                $stockQty = $row->currentQty;
                $stockId = $row->id;

                if ($tempQty <= $stockQty) {
                    $newQty = $stockQty - $tempQty;

                    $this->stock_model->updateCurrentQuantity($stockId, $newQty);

                    $saleData = array(
                        'billId' => $billId,
                        'stockId' => $stockId,
                        'qty' => $tempQty
                    );
                    $this->sale_model->insert($saleData);
                    break;
                } else {
                    $tempQty -= $stockQty;
                    $newQty = 0;

                    $saleData = array(
                        'billId' => $billId,
                        'stockId' => $stockId,
                        'qty' => $stockQty
                    );
                    $this->sale_model->insert($saleData);

                    $this->stock_model->updateCurrentQuantity($stockId, $newQty);
                }
            }

        $this->purchaseOrder_model->setUpdateAsDelivered($poId);
        
        redirect('/view/printDeliveryNote/' . urlencode(base64_encode($billId)));
    }

}
