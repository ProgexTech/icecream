<?php

class user_model extends CI_Model {

    public function authenticate($uName, $password) {
        $this->db->where('uName', $uName);
        $this->db->where('password', $password);

        $result = $this->db->get('user');

        if ($result->num_rows() == 1) {
            return $result->row(0);
        }
        return FALSE;
    }

    public function insert_user($userData) {
        $this->db->insert('user', $userData);
     }

    public function get_user_by_id($user_id) {
        $this->db->where('id', $user_id);
        $result = $this->db->get('user');

        if ($result->num_rows() == 1) {
            return $result->row(0);
        }
        return FALSE;
    }

}
