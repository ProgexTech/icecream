<?php

class PurchaseOrder_model extends CI_Model {

    public function insertPO($poData) {
        $this->db->insert('purchase_order', $poData);
        return $this->db->insert_id();
    }

    public function getAllPOs() {
        $result = $this->db->get('purchase_order');

        if ($result->num_rows() != 0) {
            return $result->result();
        }
        return FALSE;
    }

    public function getPOCount() {
        return $this->db->count_all("purchase_order");
    }

    public function fetchData($limit, $start) {
        $this->db->limit($limit, $start);
        $query = $this->db->get("purchase_order");
        if ($query->num_rows() > 0) {
            foreach ($query->result() as $row) {
                $data[] = $row;
            }
            return $data;
        }
        return false;
    }

}
