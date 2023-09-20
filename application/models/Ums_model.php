<?php
class Ums_model extends CI_model
{
    public function create($formArray)
    {
        $this->db->insert('person', $formArray);
    }

    public function adminlogin($username, $password)
    {
        $this->db->where('user', $username);
        $this->db->where('pass', $password);
        $query = $this->db->get('admin');
        $admin = $query->row_array();
        return $admin;
    }

    public function userlogin($username, $password)
    {
        $this->db->where('name', $username);
        $this->db->where('password', $password);
        $query = $this->db->get('person');
        $user = $query->row_array();
        return $user;
    }

    public function all()
    {
        return $users = $this->db->get('person')->result_array();
    }

    public function getUser($userId)
    {
        $this->db->where('id', $userId);
        return $user = $this->db->get('person')->row_array();
    }

    public function updateUser($formArray, $userId)
    {
        $this->db->where('id', $userId);
        $this->db->update('person', $formArray);
    }

    public function deleteUser($userId)
    {
        $this->db->where('id', $userId);
        $this->db->delete('person');
    }
}
