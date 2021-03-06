<?php

class Stock_model extends CI_Model {

    public function addToStock($stockData) {
        if ($this->isAlreadyExists($stockData['containerId'])) {
            return FALSE;
        }
        $this->db->insert('stock', $stockData);
        return TRUE;
    }

    private function isAlreadyExists($containerId) {
        $this->db->where('containerId', $containerId);
        $result = $this->db->get('stock');
        return ($result->num_rows() != 0);
    }

    public function getAllInstockRecords() {
        $this->db->where('currentQty >', '0');
        $this->db->order_by('containerId', 'ASC');
        $result = $this->db->get('stock');
        if ($result->num_rows() != 0) {
            return $result->result();
        }
        return FALSE;
    }

    public function updateCurrentQuantity($id, $newQty) {
        $this->db->where('id', $id);
        $data = array(
            'currentQty' => $newQty
        );
        $this->db->update('stock', $data);
    }

    public function getStockById($id) {
        $this->db->where('id', $id);
        $result = $this->db->get('stock');

        if ($result->num_rows() == 1) {
            return $result->row(0);
        }
        return FALSE;
    }

    public function getAllRemainingRecords() {
        $this->db->where('currentQty > 0');
        $result = $this->db->get('stock');
        if ($result->num_rows() != 0) {
            return $result->result();
        }
        return FALSE;
    }

    public function getAllRemainingQuantity() {
        $this->db->select_sum('currentQty');
        $result = $this->db->get('stock');
        if ($result->num_rows() != 0) {
            return $result->row(0);
        }
        return FALSE;
    }

    public function removeByContainerId($conId) {
        $this->db->where('containerId', $conId);
        $this->db->delete('stock');
    }

    public function getStockByContainerId($conId) {
        $this->db->where('containerId', $conId);
        $result = $this->db->get('stock');

        if ($result->num_rows() == 1) {
            return $result->row(0);
        }
        return FALSE;
    }

    public function getAllContainersCount() {
        $result = $this->db->get('stock');
        return $result->num_rows();
    }

    public function getAllNonEmptyContainersCount() {
        $this->db->where('currentQty > 0');
        $result = $this->db->get('stock');
        return $result->num_rows();
    }

}
