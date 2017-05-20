<?php

class role_model extends CI_Model {

    public function get_role_by_id($role_id) {
        $this->db->where('id', $role_id);
        $result = $this->db->get('role');

        if ($result->num_rows() > 0) {
            return $result->row(0);
        }
        return FALSE;
    }

    public function getAllRoles(){
        $query = $this->db->query('SELECT * FROM role');
        $ret = $query->result_array(); 
        return $ret;
    }
}
