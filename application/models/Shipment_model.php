<?php

class Shipment_model extends CI_Model {

    public function insertShipment($shipmentData) {
        $this->db->insert('shipment', $shipmentData);
    }

    public function getShipmentById($shipmentId) {
        $this->db->where('id', $shipmentId);
        $result = $this->db->get('shipment');

        if ($result->num_rows() == 1) {
            return $result->row(0);
        }
        return FALSE;
    }

    public function getShipmentsForOrder($orderId) {
        $this->db->order_by('createdDate', 'DESC');
        $this->db->where('orderId', $orderId);
        $result = $this->db->get('shipment');

        if ($result->num_rows() != 0) {
            return $result->result();
        }
        return FALSE;
    }

     public function remove($id) {
        $this->db->where('id', $id);
        $this->db->delete('shipment');
    }
    
    public function updateShipment($shippingId, $shipmentData){
        $this->db->where('id', $shippingId);
        $this->db->update('shipment', $shipmentData);
    }
}
