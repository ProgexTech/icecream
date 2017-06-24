<?php
class Sale_model extends CI_Model {

    public function insert($saleData) {
        $this->db->insert('sale', $billData);
    }
    
    public function update($id, $data) {
        $this->db->where('id', $id);
        $this->db->update('sale', $data);
    }
    
     public function remove($id) {
        $this->db->where('id', $id);
        $this->db->delete('sale');
    }
}