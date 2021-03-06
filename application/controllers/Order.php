<?php

class Order extends CI_Controller {

    public function add() {
        $this->load->model('order_model');

        $orderData = array(
            'refNo' => $this->input->post('refNo'),
            'country' => $this->input->post('country'),
            'company' => $this->input->post('company'),
            'orderNo' => $this->input->post('orderNo'),
            'qty' => $this->input->post('qty'),
            'orderDate' => $this->input->post('orderDate'),
            'createdUserId' => $this->session->userdata('user_id')
        );

        $this->order_model->insertOrder($orderData);

        redirect('/view/viewOrders');
        //$data['main_content'] = "home_view";
        //$this->load->view("layouts/main", $data);
    }

    public function edit() {
        $this->load->model('order_model');
        $this->load->model('user_model');

        $oId = base64_decode(urldecode($this->input->post('orderId')));
        $orderData = array(
            'refNo' => $this->input->post('refNo'),
            'country' => $this->input->post('country'),
            'company' => $this->input->post('company'),
            'orderNo' => $this->input->post('orderNo'),
            'orderDate' => $this->input->post('orderDate'),
            'qty' => $this->input->post('qty')
        );

        $orderAuditData = array(
            'orderId' => $oId,
            'editedUserId' => $this->session->userdata('user_id'),
            'editedContent' => json_encode($orderData)
        );

        $this->order_model->updateOrder($oId, $orderData);
        $this->order_model->insertToOrderAudit($orderAuditData);

        redirect('/view/viewOrders');
        //$data['main_content'] = "order/view_orders";
        //$this->load->view("layouts/main", $data);
    }

    public function cancel($orderId) {
        $this->load->model('order_model');
        $this->load->model('user_model');

        $this->order_model->updateOrderStatus(base64_decode(urldecode($orderId)), '1');

        redirect('/view/viewOrders');
        //$data['main_content'] = "order/view_orders";
        //$this->load->view("layouts/main", $data);
    }

}
