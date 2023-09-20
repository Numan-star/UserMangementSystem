<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Blog extends CI_Controller
{
    public function blog()
    {
        $data['todo_list'] = array('Clean House', 'Call Mom', 'Run Errands');
        $data['title'] = "My Real Title";
        $data['heading']  = "My Real Heading";

        $this->load->view('blogView', $data);
    }
}
