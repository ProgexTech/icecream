<?php

class PurchaseOrderStock_model extends CI_Model {

    public function insertPOStock($poStockData) {
        $this->db->insert('po_stock', $poStockData);
    }
    
    public function deletePOStock($poId) {
        $this->db->where('poId', $poId);
        $this->db->delete('po_stock');
    }

    public function getAllByPOId($poId) {
        $this->db->where('poId', $poId);
        $result = $this->db->get('po_stock');

        if ($result->num_rows() != 0) {
            return $result->result();
        }
        return FALSE;
    }
    
    public function getAll() {
        $result = $this->db->get('po_stock');

        if ($result->num_rows() != 0) {
            return $result->result();
        }
        return FALSE;
    }
   
}
