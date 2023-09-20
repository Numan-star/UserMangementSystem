<?php
defined('BASEPATH') or exit('No direct script access allowed');

class CarModel extends CI_Controller
{
    public function index()
    {
        $this->load->model('Car_model');
        $rows = $this->Car_model->all();
        $data['rows'] = $rows;
        $this->load->view("car_model/list.php", $data);
    }

    public function showCreateForm()
    {
        $html = $this->load->view("car_model/create", '', true);
        $response['html'] = $html;
        echo json_encode($response);
    }

    public function saveModel()
    {
        $this->load->model('Car_model');
        $this->load->library('form_validation');
        $this->form_validation->set_rules('name', 'Name', 'required');
        $this->form_validation->set_rules('color', 'Color', 'required');
        $this->form_validation->set_rules('price', 'Price', 'required');

        if ($this->form_validation->run() == true) {
            $formArray = array();
            $formArray['name'] = $this->input->post('name');
            $formArray['color'] = $this->input->post('color');
            $formArray['transmission'] = $this->input->post('transmission');
            $formArray['price'] = $this->input->post('price');
            $idRow = $this->Car_model->create($formArray);

            $row = $this->Car_model->getRow($idRow);
            $vData['row'] = $row;
            $rowHtml = $this->load->view('car_model/car_row', $vData, true);

            $response['row']     = $rowHtml;
            $response['status']  = 1;
            $response['message'] = "<div class=\"alert alert-success\">Record has been added successfully.</div>";
        } else {
            $response['status'] = 0;
            $response['name']   = strip_tags(form_error('name'));
            $response['color']  = strip_tags(form_error('color'));
            $response['price']  = strip_tags(form_error('price'));
        }
        echo json_encode($response);
    }

    public function getCarModel($id)
    {
        $this->load->model('Car_model');
        $row = $this->Car_model->getRow($id);
        $data['row'] = $row;

        $html = $this->load->view('car_model/edit', $data, true);
        $response['html'] = $html;
        echo json_encode($response);
    }

    public function updateModel()
    {
        $this->load->model('Car_model');
        $id = $this->input->post('id');
        $row = $this->Car_model->getRow($id);
        if (empty($row)) {
            $response['msg'] = "Either record deleted or not found in DB";
            $response['status'] = 100;
            json_encode($response);
            exit;
        }

        $this->load->library('form_validation');
        $this->form_validation->set_rules('name', 'Name', 'required');
        $this->form_validation->set_rules('color', 'Color', 'required');
        $this->form_validation->set_rules('price', 'Price', 'required');

        if ($this->form_validation->run() == true) {
            $formArray = array();
            $formArray['name'] = $this->input->post('name');
            $formArray['color'] = $this->input->post('color');
            $formArray['transmission'] = $this->input->post('transmission');
            $formArray['price'] = $this->input->post('price');
            $formArray['updated_at'] = date('Y-m-d H:i:s');
            $idRow = $this->Car_model->update($id, $formArray);

            $row = $this->Car_model->getRow($idRow);

            $response['row']     = $row;
            $response['status']  = 1;
            $response['message'] = "<div class=\"alert alert-success\">Record has been updated successfully.</div>";
        } else {
            $response['status'] = 0;
            $response['name']   = strip_tags(form_error('name'));
            $response['color']  = strip_tags(form_error('color'));
            $response['price']  = strip_tags(form_error('price'));
        }
        echo json_encode($response);
    }

    public function deleteModel($id)
    {
        $this->load->model('Car_model');

        $row = $this->Car_model->getRow($id);
        if (empty($row)) {
            $response['msg'] = "Either record deleted or not found in DB";
            $response['status'] = 0;
            echo json_encode($response);
            exit;
        } else {
            $this->Car_model->delete($id);
            $response['msg'] = "Record has been deleted successfully";
            $response['status'] = 1;
            echo json_encode($response);
        }
    }
}
