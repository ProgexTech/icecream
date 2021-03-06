<?php

class PurchaseOrder extends CI_Controller {

    public function add() {
        $this->load->model('purchaseOrder_model');
        $this->load->model('purchaseOrderStock_model');
        $this->load->model('customer_model');

        $paymentType = $this->input->post('sale_type');
        $customerId = $this->input->post('customer_id');
        $storeId = $this->input->post('storeLocation');

        $enteredQty = $this->input->post('quantity');
        if ($enteredQty <= 0) {
            $this->session->set_flashdata('feedback', 'Please enter a valid Quantity');
            redirect('view/newPO/' . urlencode(base64_encode($customerId)));
        }
        $price = $this->customer_model->fetchPrice($customerId, $storeId, $paymentType);
        $priceId = -1;
        if ($price) {
            $priceId = $price->id;
        } else {
            $this->session->set_flashdata('feedback', 'Please enter a valid price');
            redirect('view/newPO/' . urlencode(base64_encode($customerId)));
        }
        $customerAddressId = $this->input->post('customerAddress_id');
        if (!$customerAddressId) {
            $customerAddressId = -1;
        }

        $customerVehicleId = $this->input->post('customerVehicle_id');
        if (!$customerVehicleId) {
            $customerVehicleId = -1;
        }

        $customerDriverId = $this->input->post('customerDriver_id');
        if (!$customerDriverId) {
            $customerDriverId = -1;
        }

        $poData = array(
            'customerId' => $customerId,
            'customerAddressId' => $customerAddressId,
            'customerVehicleId' => $customerVehicleId,
            'customerDriverId' => $customerDriverId,
            'customerPriceId' => $priceId,
            'deliveryType' => $this->input->post('delivery_type'),
            'saleType' => $paymentType,
            'quantity' => $enteredQty,
            'createdDate' => $this->input->post('date_time')
        );

        $poId = $this->purchaseOrder_model->insertPO($poData);

        $poStockData = array(
            'poId' => $poId,
            'qty' => $this->input->post('quantity')
        );

        $this->purchaseOrderStock_model->insertPOStock($poStockData);

        redirect('/view/printPO/' . urlencode(base64_encode($poId)));
    }

    public function finalize() {
        $this->load->model('purchaseOrder_model');
        $this->load->model('purchaseOrderStock_model');
        $this->load->model('sale_model');
        $this->load->model('stock_model');
        $this->load->model('bill_model');

        $uPrice = $this->input->post('unitPrice');
        $poId = base64_decode(urldecode($this->input->post('poId')));

        $po = $this->purchaseOrder_model->getPOById($poId);

        $qty = $this->input->post('issuedQty');
        if ($qty <= 0) {
            $this->session->set_flashdata('feedback', 'Please enter a valid Quantity');
            redirect('view/processPO/' . urlencode(base64_encode($poId)));
        }

        $amount = $uPrice * $qty;
        $dt = new DateTime("now", new DateTimeZone("Asia/Colombo"));

        $billData = array(
            'customerId' => $po->customerId,
            'poId' => $poId,
            'userId' => $this->session->userdata('user_id'),
            'amount' => $amount,
            'date' => $dt->format('Y-m-d H:i:s'),
            'qty' => $qty
        );
        $billId = $this->bill_model->insertBill($billData);

        $tempQty = $qty;

        $allStock = $this->stock_model->getAllInstockRecords();

        if ($allStock) {
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
        }
        $this->purchaseOrder_model->setUpdateAsDelivered($poId);
        redirect('/view/printDeliveryNote/' . urlencode(base64_encode($billId)));
    }

    public function cancelPO($poId) {
        $this->load->model('purchaseOrder_model');
        $this->load->model('purchaseOrderStock_model');
        $this->load->model('sale_model');
        $this->load->model('stock_model');
        $this->load->model('bill_model');

        $this->purchaseOrder_model->deletePO(base64_decode(urldecode($poId)));
        $this->purchaseOrderStock_model->deletePOStock(base64_decode(urldecode($poId)));

        redirect('/view/viewPOs');
    }

}
