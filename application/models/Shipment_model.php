<?php

class Shipment_model extends CI_Model {

    public function insertShipment($shipmentData) {
        $this->db->insert('shipment', $shipmentData);
    }
    
}