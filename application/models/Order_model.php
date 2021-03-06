<?php

class Order_model extends CI_Model {

    public function insertOrder($orderData) {
        $this->db->insert('order', $orderData);
    }

    public function getAllOrdersByDecendingOder() {
        $query = $this->db->query("SELECT * FROM `order` ORDER BY createdDate desc");
        $ret = $query->result_array();
        return $ret;
    }

    public function getOrderById($orderId) {
        $this->db->where('id', $orderId);
        $result = $this->db->get('order');

        if ($result->num_rows() == 1) {
            return $result->row(0);
        }
        return FALSE;
    }

    public function getOrderByOrderNumber($orderNo) {
        $this->db->where('orderNo', $orderNo);
        $result = $this->db->get('order');

        if ($result->num_rows() == 1) {
            return $result->row(0);
        }
        return FALSE;
    }

    public function updateOrder($orderId, $data) {
        $condition = array(
            'id' => $orderId
        );
        $this->db->where($condition);
        $this->db->update('order', $data);
    }

    public function updateOrderStatus($orderId, $status) {
        $condition = array(
            'id' => $orderId
        );

        $data = array(
            'status' => $status
        );

        $this->db->where($condition);
        $this->db->update('order', $data);
    }

    public function insertToOrderAudit($auditData) {
        $this->db->insert('orderaudit', $auditData);
    }

    public function getOrderCount() {
        return $this->db->count_all("order");
    }

    public function fetchData($limit, $start) {
        $this->db->limit($limit, $start);
        $query = $this->db->get("order");
        if ($query->num_rows() > 0) {
            foreach ($query->result() as $row) {
                $data[] = $row;
            }
            return $data;
        }
        return false;
    }

}
