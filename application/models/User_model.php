<?php

class User_model extends CI_Model {

    public function authenticate($uName, $password) {
        $this->db->where('uName', $uName);
        $this->db->where('password', $password);

        $result = $this->db->get('user');

        if ($result->num_rows() == 1) {
            return $result->row(0);
        }
        return FALSE;
    }

    public function insertUser($userData) {
        $this->db->insert('user', $userData);
    }

    public function getUserById($user_id) {
        $this->db->where('id', $user_id);
        $result = $this->db->get('user');

        if ($result->num_rows() == 1) {
            return $result->row(0);
        }
        return FALSE;
    }

}
