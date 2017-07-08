<?php

class PurchaseOrder_model extends CI_Model {

    public function insertPO($poData) {
        $this->db->insert('order', $poData);
    }

}