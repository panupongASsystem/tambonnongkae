<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Manual_admin_backend extends MY_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->check_access_permission(['1', '134']); // 1=ทั้งหมด
        $this->load->model('Manual_admin_model');
        $this->load->model('log_model');
        $this->load->library('upload');
    }


    public function index()
    {
        $data['manuals'] = $this->Manual_admin_model->get_all();
        $this->load->view('templat/header');
        $this->load->view('asset/css');
        $this->load->view('templat/navbar_system_admin');
        $this->load->view('system_admin/manual_admin', $data);
        $this->load->view('asset/js');
        $this->load->view('templat/footer');
    }


    public function insert_manual_admin()
    {
        $config['upload_path'] = './docs/file/';
        $config['allowed_types'] = 'pdf';
        $config['max_size'] = 20480; // 20 MB
        $this->upload->initialize($config);


        $file_name = '';
        if ($this->upload->do_upload('manual_admin_pdf')) {
            $file_name = $this->upload->data('file_name');
        }


        $data = array(
            'manual_admin_name' => $this->input->post('manual_admin_name'),
            'manual_admin_pdf' => $file_name,
            'manual_admin_by' => $this->session->userdata('username')
        );


        $this->Manual_admin_model->insert_manual_admin($data);

        $this->log_model->add_log(
            'เพิ่ม',
            'คู่มือการใช้งาน',
            $data['manual_admin_name'],
            $this->db->insert_id(), // id ล่าสุดที่เพิ่ง insert
            array(
                'files_uploaded' => array(
                    'pdfs' => !empty($data['manual_admin_pdf']) ? 1 : 0
                )
            )
        );

        redirect('manual_admin_backend');
    }


    public function edit($id)
    {
        $data['manual'] = $this->Manual_admin_model->get_by_id($id);
        $this->load->view('templat/header');
        $this->load->view('asset/css');
        $this->load->view('templat/navbar_system_admin');
        $this->load->view('system_admin/manual_admin_form_edit', $data);
        $this->load->view('asset/js');
        $this->load->view('templat/footer');
    }

    public function update_manual_admin($id)
    {
        $config['upload_path']   = './docs/file/';
        $config['allowed_types'] = 'pdf';
        $config['max_size']      = 20480; // 20 MB
        $this->upload->initialize($config);

        // ดึงข้อมูลเก่ามาเช็กก่อน
        $manual = $this->Manual_admin_model->get_by_id($id);
        $file_name = $this->input->post('old_pdf');

        if ($this->upload->do_upload('manual_admin_pdf')) {
            // ถ้ามีไฟล์ใหม่ อัปโหลดสำเร็จ
            $file_name = $this->upload->data('file_name');

            // ลบไฟล์เก่าออก (ถ้ามีจริงและไม่ว่าง)
            if (!empty($manual->manual_admin_pdf) && file_exists('./docs/file/' . $manual->manual_admin_pdf)) {
                unlink('./docs/file/' . $manual->manual_admin_pdf);
            }
        }

        $data = array(
            'manual_admin_name' => $this->input->post('manual_admin_name'),
            'manual_admin_pdf'  => $file_name,
            'manual_admin_by'   => $this->session->userdata('username')
        );

        $this->Manual_admin_model->update_manual_admin($id, $data);

        $this->log_model->add_log(
            'แก้ไข',
            'คู่มือการใช้งาน',
            $data['manual_admin_name'],
            $id,
            array(
                'files_uploaded' => array(
                    'pdfs' => !empty($data['manual_admin_pdf']) ? 1 : 0
                )
            )
        );

        redirect('manual_admin_backend');
    }


    public function delete($id)
    {
        $this->Manual_admin_model->delete_manual_admin($id);
        $manual = $this->Manual_admin_model->get_by_id($id);

        $this->Manual_admin_model->delete_manual_admin($id);

        $this->log_model->add_log(
            'ลบ',
            'คู่มือการใช้งาน',
            $manual ? $manual->manual_admin_name : '',
            $id,
            array()
        );

        redirect('manual_admin_backend');
    }

    public function download($id)
    {
        $manual = $this->Manual_admin_model->get_by_id($id);

        if ($manual && !empty($manual->manual_admin_pdf)) {
            // เพิ่มจำนวนดาวน์โหลด
            $this->Manual_admin_model->increment_download_manual_admin($id);

            // Path ของไฟล์
            $file = FCPATH . 'docs/file/' . $manual->manual_admin_pdf;

            if (file_exists($file)) {
                $this->load->helper('download');
                force_download($file, NULL);
            } else {
                show_404();
            }
        } else {
            show_404();
        }
    }
}
