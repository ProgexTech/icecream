<?php

class Sale_model extends CI_Model {

    public function insert($saleData) {
        $this->db->insert('sale', $saleData);
    }

    public function update($id, $data) {
        $this->db->where('id', $id);
        $this->db->update('sale', $data);
    }

    public function remove($id) {
        $this->db->where('id', $id);
        $this->db->delete('sale');
    }

    public function getSalesByBillId($billId) {
        $this->db->where('billId', $billId);
        $result = $this->db->get('sale');

        if ($result->num_rows() != 0) {
            return $result->result();
        }
        return FALSE;
    }

}
