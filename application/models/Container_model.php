<?php

class Container_model extends CI_Model {

    public function insertContainer($containerData) {
        $this->db->insert('container', $containerData);
    }
    
    public function getContainerForShipment($shipmentId) {
        $this->db->where('shipmentId', $shipmentId);
        $result = $this->db->get('container');

        if ($result->num_rows() != 0) {
            return $result->result();
        }
        return FALSE;
    }
    
}