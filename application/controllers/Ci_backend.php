<?php
defined('BASEPATH') or exit('No direct script access allowed');

class ci_backend extends MY_Controller
{

    public function __construct()
    {
        parent::__construct();
        // เช็ค steb 1 ระบบที่เลือกตรงมั้ย
         $this->check_access_permission(['1', '12']); // 1=ทั้งหมด
        $this->load->model('member_model');
        $this->load->model('space_model');
        $this->load->model('cmi_model');
    }

   
public function index()
    {
        $data['query'] = $this->cmi_model->list_all();

        $this->load->view('templat/header');
        $this->load->view('asset/css');
        $this->load->view('templat/navbar_system_admin');
        $this->load->view('system_admin/ci', $data);
        $this->load->view('asset/js');
        $this->load->view('templat/footer');
    }

    public function adding()
    {
        $this->load->view('templat/header');
        $this->load->view('asset/css');
        $this->load->view('templat/navbar_system_admin');
        $this->load->view('system_admin/ci_form_add');
        $this->load->view('asset/js');
        $this->load->view('templat/footer');
    }


    public function add()
    {
        // echo '<pre>';
        // print_r($_POST);
        // echo '</pre>';
        // exit;
        $this->cmi_model->add();
        redirect('Ci_backend', 'refresh');
    }

    public function editing($ci_id)
    {
        $data['rsedit'] = $this->cmi_model->read($ci_id);
        // echo '<pre>';
        // print_r($data['rsedit']);
        // echo '</pre>';
        // exit();
        $this->load->view('templat/header');
        $this->load->view('asset/css');
        $this->load->view('templat/navbar_system_admin');
        $this->load->view('system_admin/ci_form_edit', $data);
        $this->load->view('asset/js');
        $this->load->view('templat/footer');
    }

    public function edit($ci_id)
    {
        $this->cmi_model->edit($ci_id);
        redirect('Ci_backend', 'refresh');
    }

    public function del_ci($ci_id)
    {
        $this->cmi_model->del_ci($ci_id);
        $this->session->set_flashdata('del_success', TRUE);
        redirect('Ci_backend', 'refresh');
    }
}
