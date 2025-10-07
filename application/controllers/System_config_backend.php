<?php
defined('BASEPATH') or exit('No direct script access allowed');

class System_config_backend extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('system_config_model');
        if (
            $this->session->userdata('m_system') != 'system_admin'
        ) {
            redirect('User/logout', 'refresh');
        }

        // ตั้งค่าเวลาหมดอายุของเซสชัน
        $this->check_session_timeout();
    }

    private function check_session_timeout()
    {
        $timeout = 900; // 15 นาที
        $last_activity = $this->session->userdata('last_activity');

        if ($last_activity && (time() - $last_activity > $timeout)) {
            $this->session->sess_destroy();
            redirect('User/logout', 'refresh');
        } else {
            $this->session->set_userdata('last_activity', time());
        }
    }

    public function index()
    {
        // print_r($_SESSION);
        $data['query'] = $this->system_config_model->list();
        // echo '<pre>';
        // print_r($data);
        // echo '</pre>';
        // exit;
        $this->load->view('templat/header');
        $this->load->view('asset/css');
        $this->load->view('templat/navbar_system_admin');
        $this->load->view('system_admin/system_config', $data);
        $this->load->view('asset/js');
        $this->load->view('templat/footer');
    }

    public function address()
    {
        // หน้าแสดงข้อมูลกลุ่มที่อยู่
        $data['query'] = $this->system_config_model->list_by_type('address');
        $data['type'] = 'address';
        $data['content'] = 'system_config'; // ใช้ view เดิม
        $this->load->view('templat/header');
        $this->load->view('asset/css');
        $this->load->view('templat/navbar_system_admin');
        $this->load->view('system_admin/system_config', $data);
        $this->load->view('asset/js');
        $this->load->view('templat/footer');
    }
	
	    public function link()
    {
        // หน้าแสดงข้อมูลกลุ่มที่อยู่
        $data['query'] = $this->system_config_model->list_by_type('link');
        $data['type'] = 'link';
        $data['content'] = 'system_config'; // ใช้ view เดิม
        $this->load->view('templat/header');
        $this->load->view('asset/css');
        $this->load->view('templat/navbar_system_admin');
        $this->load->view('system_admin/system_config', $data);
        $this->load->view('asset/js');
        $this->load->view('templat/footer');
    }

    public function key_token()
    {
        // หน้าแสดงข้อมูล key & token
        $data['query'] = $this->system_config_model->list_by_type('key_token');
        $data['type'] = 'key_token';
        $data['content'] = 'system_config'; // ใช้ view เดิม
        $this->load->view('templat/header');
        $this->load->view('asset/css');
        $this->load->view('templat/navbar_system_admin');
        $this->load->view('system_admin/system_config', $data);
        $this->load->view('asset/js');
        $this->load->view('templat/footer');
    }

    public function update_domain()
    {
        // ดึงโดเมนจาก URL ปัจจุบัน
        $full_domain = isset($_SERVER['HTTP_HOST']) ? $_SERVER['HTTP_HOST'] : '';

        // ตัด www. ออกถ้ามี
        $full_domain = preg_replace('/^www\./', '', $full_domain);

        // แยกโดเมนออกเป็นส่วนๆ
        $domain_parts = explode('.', $full_domain);

        // ดึงเฉพาะส่วนแรกของโดเมน (sawang จาก sawang.go.th)
        $domain = isset($domain_parts[0]) ? $domain_parts[0] : '';

        // กรณีเป็น localhost ให้ดึงจาก path แทน
        if ($full_domain == 'localhost' || preg_match('/^[0-9\.]+$/', $full_domain)) {
            $path = isset($_SERVER['REQUEST_URI']) ? $_SERVER['REQUEST_URI'] : '';
            $path_parts = explode('/', trim($path, '/'));
            $domain = !empty($path_parts) ? $path_parts[0] : $domain;
        }

        // อัพเดตฐานข้อมูลถ้าโดเมนไม่ตรงกับที่เก็บในฐานข้อมูล
        $stored_domain = get_config_value('domain');

        if ($stored_domain != $domain && !empty($domain)) {
            // อัพเดตฐานข้อมูล
            $this->system_config_model->update_domain('domain', $domain);
        }
        redirect('system_config_backend');

    }

    public function editing($id)
    {
        $data['rsedit'] = $this->system_config_model->read($id);

        $this->load->view('templat/header');
        $this->load->view('asset/css');
        $this->load->view('templat/navbar_system_admin');
        $this->load->view('system_admin/system_config_form_edit', $data);
        $this->load->view('asset/js');
        $this->load->view('templat/footer');
    }
    public function edit($id)
    {
        // echo '<pre>';
        // print_r($_POST);
        // echo '</pre>';
        // exit;
        $this->system_config_model->edit($id);
        redirect('system_config_backend', 'refresh');
    }
	
	
	// เพิ่มเมธอดใหม่สำหรับเพิ่มข้อมูล
    public function adding()
    {
        // ถ้ามีการส่ง type มา ให้ใช้ type นั้น
        $data['type'] = $this->input->get('type') ?? '';
        
        // ดึงข้อมูลประเภทที่มีอยู่ในระบบ
        $data['existing_types'] = $this->system_config_model->get_distinct_types();
        
        $this->load->view('templat/header');
        $this->load->view('asset/css');
        $this->load->view('templat/navbar_system_admin');
        $this->load->view('system_admin/system_config_form_add', $data);
        $this->load->view('asset/js');
        $this->load->view('templat/footer');
    }

    public function add()
    {
        $this->system_config_model->add();
        
        // ตรวจสอบ type ที่ส่งมา และ redirect กลับไปหน้าเดิม
        $type = $this->input->post('type');
        if ($type == 'address') {
            redirect('system_config_backend/address', 'refresh');
        } else if ($type == 'link') {
            redirect('system_config_backend/link', 'refresh');
        } else if ($type == 'key_token') {
            redirect('system_config_backend/key_token', 'refresh');
        } else {
            redirect('system_config_backend', 'refresh');
        }
    }
	
	// เพิ่มเมธอดสำหรับลบข้อมูล
public function delete($id)
{
    // ตรวจสอบข้อมูลก่อนลบ
    $data = $this->system_config_model->read($id);
    if (!$data) {
        // ถ้าไม่พบข้อมูล ให้ redirect กลับไปหน้าหลัก
        redirect('system_config_backend', 'refresh');
    }
    
    // ลบข้อมูล
    $result = $this->system_config_model->delete($id);
    
    if ($result) {
        $this->session->set_flashdata('del_success', TRUE);
    }
    
    // ตรวจสอบ type เพื่อ redirect กลับไปหน้าเดิม
    if (isset($data->type)) {
        if ($data->type == 'address') {
            redirect('system_config_backend/address', 'refresh');
        } else if ($data->type == 'link') {
            redirect('system_config_backend/link', 'refresh');
        } else if ($data->type == 'key_token') {
            redirect('system_config_backend/key_token', 'refresh');
        }
    }
    
    // ถ้าไม่มี type หรือไม่ตรงกับเงื่อนไข ให้ redirect ไปหน้าหลัก
    redirect('system_config_backend', 'refresh');
}
}
