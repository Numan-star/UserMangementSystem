<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Login extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('ums_model');
    }
    public function index()
    {
        if ($this->input->post('login')) {
            $username = $this->input->post('username');
            $password = $this->input->post('password');
            $admin = $this->ums_model->adminlogin($username, $password);

            if (!empty($admin)) {
                $this->session->set_userdata('admin', $admin);
                redirect(base_url() . 'login/welcome');
            } else {
                $this->session->set_flashdata('errorMsg', 'Either Username/Password is incorrect');
                redirect(base_url() . 'login');
            }
        } else {
            if (empty($this->session->userdata['admin'])) {
                $this->load->view("admin/login");
            } else {
                redirect(base_url() . 'login/welcome');
            }

        }
    }
    public function welcome()
    {
        if (empty($this->session->userdata['admin'])) {
            redirect(base_url() . 'login');
        } else {
            // $admin = $this->session->userdata['admin'];
            $data['users'] = $this->ums_model->all();
            $this->load->view('admin/welcome', $data);
        }
    }
    public function delete($userId)
    {
        $this->ums_model->deleteUser($userId);
        $this->session->set_flashdata('failure', 'Record deleted successfully!');
        redirect(base_url() . 'login/welcome');
    }
    public function logout()
    {
        $this->session->unset_userdata('admin');
        redirect(base_url() . 'login');
    }
}
