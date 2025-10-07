<?php
class System_config_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('space_model');
    }

    public function list()
    {
        $this->db->select('*');
        $this->db->from('tbl_system_config');
        $this->db->order_by('tbl_system_config.id', 'asc');
        $query = $this->db->get();
        return $query->result();
    }

    public function list_by_type($type)
    {
        $this->db->select('*');
        $this->db->from('tbl_system_config');
        $this->db->where('type', $type);
        $this->db->order_by('tbl_system_config.id', 'asc');
        $query = $this->db->get();
        return $query->result();
    }

    public function read($id)
    {
        $this->db->select('*');
        $this->db->from('tbl_system_config');
        $this->db->where('tbl_system_config.id', $id);
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            $data = $query->row();
            return $data;
        }
        return false;
    }

    public function edit($id)
    {

        $data = array(
            'keyword' => $this->input->post('keyword'),
            'value' => $this->input->post('value'),
            'description' => $this->input->post('description'),
            'update_by' => $this->session->userdata('m_fname')
        );

        $this->db->where('id', $id);
        $this->db->update('tbl_system_config', $data);

        $this->space_model->update_server_current();
        $this->session->set_flashdata('save_success', TRUE);
    }

    public function update_domain($keyword, $value)
    {
        // ตรวจสอบว่ามี keyword นี้อยู่ในฐานข้อมูลหรือไม่
        $this->db->where('keyword', $keyword);
        $query = $this->db->get('tbl_system_config');

        $data = array(
            'value' => $value,
            'update_by' => $this->session->userdata('m_fname') ?? '',
            'update_date' => date('Y-m-d H:i:s')
        );

        if ($query->num_rows() > 0) {
            // ถ้ามี keyword อยู่แล้ว ให้อัพเดต
            $this->db->where('keyword', $keyword);
            $this->db->update('tbl_system_config', $data);
        } else {
            // ถ้ายังไม่มี keyword ให้เพิ่มใหม่
            $data['keyword'] = $keyword;
            $data['description'] = 'ชื่อโดเมน (อัพเดตอัตโนมัติ)';
            $this->db->insert('tbl_system_config', $data);
        }
        // เพิ่มข้อความแจ้งเตือน
        $this->session->set_flashdata('save_success', TRUE);
        return true;
    }

    public function get_all_config()
    {
        $query = $this->db->get('tbl_system_config');
        $result = array();

        foreach ($query->result() as $row) {
            $result[$row->keyword] = $row->value;
        }

        return $result;
    }
	
	
	
	public function add()
{
    $data = array(
        'keyword' => $this->input->post('keyword'),
        'value' => $this->input->post('value'),
        'description' => $this->input->post('description'),
        'type' => $this->input->post('type'),
        'update_by' => $this->session->userdata('m_fname'),
        'update_date' => date('Y-m-d H:i:s')
    );

    $query = $this->db->insert('tbl_system_config', $data);
    
    // อัพเดตเซิร์ฟเวอร์หากมี
    $this->space_model->update_server_current();
    $this->session->set_flashdata('save_success', TRUE);
    
    return $query;
}
	
	// เพิ่มเมธอดสำหรับดึงข้อมูลประเภทที่มีอยู่ในระบบ
public function get_distinct_types()
{
    $this->db->select('DISTINCT(type) as type');
    $this->db->from('tbl_system_config');
    $this->db->where('type IS NOT NULL');
    $this->db->where('type !=', '');
    $this->db->order_by('type', 'asc');
    $query = $this->db->get();
    return $query->result();
}
	
	// เพิ่มเมธอดสำหรับลบข้อมูล
public function delete($id)
{
    $this->db->where('id', $id);
    $result = $this->db->delete('tbl_system_config');
    
    // อัพเดตเซิร์ฟเวอร์หากมี
    if ($result) {
        $this->space_model->update_server_current();
    }
    
    return $result;
}
}
