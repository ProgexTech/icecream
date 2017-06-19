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
    
}