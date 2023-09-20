<?php
defined('BASEPATH') or exit('No direct script access allowed');

class User extends CI_Controller
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
            $user = $this->ums_model->userlogin($username, $password);

            if (!empty($user)) {
                $this->session->set_userdata('user', $user);
                redirect(base_url() . 'user/welcome');
            } else {
                $this->session->set_flashdata('errorMsg', 'Either Username/Password is incorrect');
                redirect(base_url() . 'user');
            }
        } else {
            if (empty($this->session->userdata['user'])) {
                $this->load->view("users/login");
            } else {
                redirect(base_url() . 'user/welcome');
            }

        }
    }
    public function register()
    {
        if ($this->input->post('register')) {
            $formArray = array();
            $formArray['name'] = $this->input->post('username');
            $formArray['password'] = $this->input->post('password');
            $formArray['address'] = $this->input->post('address');
            $formArray['country'] = $this->input->post('country');
            $this->ums_model->create($formArray);
            $this->session->set_flashdata('success', 'Record added successfully!');
            redirect(base_url() . 'user/register');
        } else {
            $this->load->view("users/register");
        }
    }
    public function welcome()
    {
        if (empty($this->session->userdata['user'])) {
            redirect(base_url() . 'user');
        } else {
            $user = $this->session->userdata['user'];
            $id = $user['id'];
            $data['person'] = $this->ums_model->getUser($id);
            $this->load->view('users/welcome', $data);
        }
    }
    public function edit($id)
    {
        if ($this->input->post('update')) {
            $formArray = array();
            $formArray['name'] = $this->input->post('newusername');
            $formArray['password'] = $this->input->post('newpassword');
            $formArray['address'] = $this->input->post('newaddress');
            $formArray['country'] = $this->input->post('newcountry');
            $this->ums_model->updateUser($formArray, $id);
            $this->session->set_flashdata('success', 'Record Updated successfully!');
            redirect(base_url() . 'user/welcome');
        } else {
            $user = $this->session->userdata['user'];
            $userId = $user['id'];
            if ($userId == $id) {
                $data['person'] = $this->ums_model->getUser($id);
                $this->load->view('users/edit', $data);
            } else {
                $this->session->set_flashdata('failure', 'User Not Found!');
                redirect(base_url() . 'user/welcome');
            }
        }

    }
    public function logout()
    {
        $this->session->unset_userdata('user');
        redirect(base_url() . 'user');
    }
}
