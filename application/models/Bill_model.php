<?php

class Bill_model extends CI_Model {

    public function insertBill($billData) {
        $this->db->insert('bill', $billData);
        $billId = $this->db->insert_id();

        return $billId;
    }

    public function getAllPaymentTypes() {
        $result = $this->db->get('payment');

        if ($result->num_rows() != 0) {
            return $result->result();
        }
        return FALSE;
    }
    
    public function getBillById($id) {     
        $this->db->where('id', $id);
        $result = $this->db->get('bill');

        if ($result->num_rows() == 1) {
            return $result->row(0);
        }
        return FALSE;
    }

    public function update($id, $data) {
        $this->db->where('id', $id);
        $this->db->update('bill', $data);
    }

     public function remove($id) {
        $this->db->where('id', $id);
        $this->db->delete('bill');
    }
}
