<?php

class user_model extends CI_Model {

    public function authenticate($uName, $password) {
        $this->db->where('email', $uName);
        $this->db->where('password', $password);

        $result = $this->db->get('user');

        if ($result->num_rows() == 1) {
            return $result->row(0);
        }
        return FALSE;
    }

    public function insert_user() {
        $userData = array(
            'email' => $this->input->post('email'),
            'password' => md5($this->input->post('password')),
            'role_id' => $this->input->post('role'),
            'name' => $this->input->post('name'),
            'nic' => $this->input->post('nic'),
            'current_city' => $this->input->post('currentCity'),
            'address' => $this->input->post('address')
        );

        $this->db->insert('user', $userData);
        $user_id = $this->db->insert_id();

        //inserting phone numbers
        $phone1 = $this->input->post('phone1');
        $userPhoneData = array(
            'user_id' => $user_id,
            'phone_no' => $phone1
        );
        $this->db->insert('telephone', $userPhoneData);

        $phone2 = $this->input->post('phone2');
        $userPhoneData1 = array(
            'phone_no' => $phone2,
            'user_id' => $user_id
        );
        $this->db->insert('telephone', $userPhoneData1);

        //inserting user skills
        $skills = $this->input->post('skills');
        foreach ($skills as $skill) {
            $skillData = array(
                'skill_id' => $skill,
                'user_id' => $user_id
            );
            $this->db->insert('user_skill', $skillData);
        }
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
