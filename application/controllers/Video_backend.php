<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Video_backend extends MY_Controller
{

    public function __construct()
    {
        parent::__construct();
        // เช็ค steb 1 ระบบที่เลือกตรงมั้ย
        $this->check_access_permission(['1', '18']); // 1=ทั้งหมด

        $this->load->model('member_model');
        $this->load->model('space_model');
        $this->load->model('video_model');
    }

    

public function index()
    {
        $data['query'] = $this->video_model->list_all();

        $this->load->view('templat/header');
        $this->load->view('asset/css');
        $this->load->view('templat/navbar_system_admin');
        $this->load->view('system_admin/video', $data);
        $this->load->view('asset/js');
        $this->load->view('templat/footer');
    }

    public function adding()
    {
        $this->load->view('templat/header');
        $this->load->view('asset/css');
        $this->load->view('templat/navbar_system_admin');
        $this->load->view('system_admin/video_form_add');
        $this->load->view('asset/js');
        $this->load->view('templat/footer');
    }


    public function add()
    {
        // echo '<pre>';
        // print_r($_POST);
        // echo '</pre>';
        // exit;
        $this->video_model->add();
        redirect('video_backend', 'refresh');
    }

    public function editing($video_id)
    {
        $data['rsedit'] = $this->video_model->read($video_id);
        // echo '<pre>';
        // print_r($data['rsedit']);
        // echo '</pre>';
        // exit();
        $this->load->view('templat/header');
        $this->load->view('asset/css');
        $this->load->view('templat/navbar_system_admin');
        $this->load->view('system_admin/video_form_edit', $data);
        $this->load->view('asset/js');
        $this->load->view('templat/footer');
    }

    public function edit($video_id)
    {
        $this->video_model->edit($video_id);
        redirect('video_backend', 'refresh');
    }
    public function updateVideoStatus()
    {
        $this->video_model->updateVideoStatus();
    }

    public function del_video($video_id)
    {
        $this->video_model->del_video($video_id);
        $this->session->set_flashdata('del_success', TRUE);
        redirect('video_backend', 'refresh');
    }
}
