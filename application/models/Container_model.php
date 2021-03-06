<?php

class Container_model extends CI_Model {

    public function insertContainer($containerData) {
        if ($this->isAlreadyExists($containerData['contCode'], $containerData['shipmentId'], $containerData['mWeek'])) {
            return FALSE;
        }
        $this->db->insert('container', $containerData);
        return $this->db->insert_id();
    }

    public function getContainerForShipment($shipmentId) {
        $this->db->where('shipmentId', $shipmentId);
        $result = $this->db->get('container');

        if ($result->num_rows() != 0) {
            return $result->result();
        }
        return FALSE;
    }

    public function isAlreadyExists($contCode, $shipmentId, $mWeek) {
        $this->db->where('contCode', $contCode);
        $this->db->where('shipmentId', $shipmentId);
        $this->db->where('mWeek', $mWeek);
        $result = $this->db->get('container');
        return ($result->num_rows() != 0);
    }

    public function remove($id) {
        $this->db->where('id', $id);
        $this->db->delete('container');
    }

    public function getContainerById($id) {
        $this->db->where('id', $id);
        $result = $this->db->get('container');

        if ($result->num_rows() > 0) {
            return $result->row(0);
        }
        return FALSE;
    }

    public function getContainersByShipmentId($shipmentId) {
        $this->db->where('shipmentId', $shipmentId);
        $result = $this->db->get('container');

        if ($result->num_rows() != 0) {
            return $result->result();
        }
        return FALSE;
    }

    public function removeContainersBelongToShipment($shipmentId) {
        $this->db->where('shipmentId', $shipmentId);
        $this->db->delete('container');
    }

    public function updateContainer($contId, $containerData) {
        $this->db->where('id', $contId);
        $this->db->update('container', $containerData);
    }

}
