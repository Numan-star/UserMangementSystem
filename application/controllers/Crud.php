<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Crud extends CI_Controller
{

    public function __construct()
    {

        parent::__construct();
        $this->load->model('user_modal');
    }
    public function index()
    {

        if ($this->input->post('save')) {
            $this->form_validation->set_rules('name', 'Name', 'trim|required');
            $this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email|is_unique[tnt.email]');
            $this->form_validation->set_rules('phoneNumber', 'PhoneNumber', 'trim|required|min_length[10]|max_length[11]');

            if ($this->form_validation->run() == false) {
                $users = $this->user_modal->all();
                $data = array();
                $data['users'] = $users;
                $this->load->view('list', $data);
            } else {
                $formArray = array();
                $formArray['pname'] = $this->input->post('name');
                $formArray['email'] = $this->input->post('email');
                $formArray['phoneNumber'] = $this->input->post('phoneNumber');
                $this->user_modal->create($formArray);
                $this->session->set_flashdata('success', 'Record added successfully!');
                redirect(base_url() . 'Crud/index');
            }
        } else {
            $users = $this->user_modal->all();
            $data = array();
            $data['users'] = $users;
            $this->load->view('list', $data);
        }
    }

    public function edit($userId)
    {

        if ($this->input->post('update')) {

            $this->form_validation->set_rules('name', 'Name', 'required');
            $this->form_validation->set_rules('email', 'Email', 'required|valid_email');
            $this->form_validation->set_rules('phoneNumber', 'PhoneNumber', 'required');
            $data = array();
            $users = $this->user_modal->all();
            $user = $this->user_modal->getUser($userId);
            $data['users'] = $users;
            $data['user'] = $user;
            if ($this->form_validation->run() == false) {
                $this->load->view('edit', $data);
            } else {
                $formArray = array();
                $formArray['pname'] = $this->input->post('name');
                $formArray['email'] = $this->input->post('email');
                $formArray['phoneNumber'] = $this->input->post('phoneNumber');
                $this->user_modal->updateUser($userId, $formArray);
                $this->session->set_flashdata('success', 'Record updated successfully!');
                redirect(base_url() . 'Crud/index');
            }
        } else {
            $data = array();
            $users = $this->user_modal->all();
            $user = $this->user_modal->getUser($userId);
            $data['users'] = $users;
            $data['user'] = $user;
            $this->load->view('edit', $data);
        }
    }

    public function delete($userId)
    {
        $this->user_modal->deleteUser($userId);
        $this->session->set_flashdata('failure', 'Record deleted successfully!');
        redirect(base_url() . 'Crud/index');
    }
}
