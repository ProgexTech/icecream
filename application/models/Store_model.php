<?php

class Store_model extends CI_Model {

    public function addStore($storeData) {
        $this->db->insert('store', $storeData);
    }

    public function getStoreById($storeId) {
        $this->db->where('id', $storeId);
        $result = $this->db->get('store');

        if ($result->num_rows() == 1) {
            return $result->row(0);
        }
        return FALSE;
    }

    public function getAllStores() {
        $result = $this->db->get('store');

        if ($result->num_rows() != 0) {
            return $result->result();
        }
        return FALSE;
    }

}
