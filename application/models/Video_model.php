<?php
class Video_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('space_model');
		// log เก็บข้อมูล
        $this->load->model('log_model');
    }

    // public function update_all_video_status($status)
    // {
    //     $this->db->update('tbl_video', array('video_status' => $status));
    // }

    public function add()
    {
        $video_name = $this->input->post('video_name');

        // ตรวจสอบว่ามีข้อมูลที่มีชื่อ video_name นี้อยู่แล้วหรือไม่
        $existing_record = $this->db->get_where('tbl_video', array('video_name' => $video_name))->row();

        if ($existing_record) {
            // ถ้ามีข้อมูลแล้วให้แสดงข้อความแจ้งเตือนหรือทำตามที่ต้องการ
            $this->session->set_flashdata('save_again', TRUE);
        } else {
            // ถ้าไม่มีข้อมูลในฐานข้อมูลให้ทำการเพิ่มข้อมูล
            $data = array(
                'video_name' => $video_name,
                'video_link' => $this->input->post('video_link'),
                'video_date' => $this->input->post('video_date'),
                'video_by' => $this->session->userdata('m_fname'), // เพิ่มชื่อคนที่เพิ่มข้อมูล
            );

            $query = $this->db->insert('tbl_video', $data);
			// บันทึก log การเพิ่มข้อมูล =================================================
      		$video_id = $this->db->insert_id();
       		 // =======================================================================

            $this->space_model->update_server_current();
			
			// บันทึก log การเพิ่มข้อมูล =================================================
            $this->log_model->add_log(
                'เพิ่ม',
                'ข้อมูลวิดีทัศน์',
                $data['video_name'],
                $video_id,
                array(
                    'info' => array(
                        'video_link' => $data['video_link'],
						'video_date' => $data['video_date'],
                    )
                )
            );
            // =======================================================================


            if ($query) {
                $this->session->set_flashdata('save_success', TRUE);
            } else {
                echo "<script>";
                echo "alert('เกิดข้อผิดพลาดในการเพิ่มข้อมูลใหม่ !');";
                echo "</script>";
            }
        }
    }



    public function list_all()
    {
        $this->db->order_by('video_id', 'DESC');
        $query = $this->db->get('tbl_video');
        return $query->result();
    }

    //show form edit
    public function read($video_id)
    {
        $this->db->where('video_id', $video_id);
        $query = $this->db->get('tbl_video');
        if ($query->num_rows() > 0) {
            $data = $query->row();
            return $data;
        }
        return FALSE;
    }

    public function edit($video_id)
    {
		// ดึงข้อมูลเก่าก่อนแก้ไข
        $old_data = $this->read($video_id);

        $data = array(
            'video_name' => $this->input->post('video_name'),
            'video_link' => $this->input->post('video_link'),
            'video_date' => $this->input->post('video_date'),
            'video_by' => $this->session->userdata('m_fname'), // เพิ่มชื่อคนที่เพิ่มข้อมูล
        );

        $this->db->where('video_id', $video_id);
        $query = $this->db->update('tbl_video', $data);

        $this->space_model->update_server_current();

			// บันทึก log การเพิ่มข้อมูล =================================================
            $this->log_model->add_log(
                'แก้ไข',
                'ข้อมูลวิดีทัศน์',
                $data['video_name'],
                $video_id,
                array(
                    'info' => array(
                        'video_link' => $data['video_link'],
						'video_date' => $data['video_date'],
                    )
                )
            );
            // =======================================================================

        if ($query) {
            $this->session->set_flashdata('save_success', TRUE);
        } else {
            echo "<script>";
            echo "alert('เกิดข้อผิดพลาดในการอัปเดตข้อมูล !');";
            echo "</script>";
        }
    }

    public function del_video($video_id)
    {
		 $old_document = $this->db->get_where('tbl_video', array('video_id' => $video_id))->row();
		
        $this->db->delete('tbl_video', array('video_id' => $video_id));
		
		// บันทึก log การลบ =================================================
        if ($old_document) {
            $this->log_model->add_log(
                'ลบ',
                'ข้อมูลวิดีทัศน์',
                $old_document->video_name,
                $video_id,
                array('deleted_date' => date('Y-m-d H:i:s'))
            );
        }
        // =======================================================================
    }

    public function updateVideoStatus()
    {
        // ตรวจสอบว่ามีการส่งข้อมูล POST มาหรือไม่
        if ($this->input->post()) {
            $videoId = $this->input->post('video_id'); // รับค่า video_id
            $newStatus = $this->input->post('new_status'); // รับค่าใหม่จาก switch checkbox

            // ทำการอัพเดตค่าในตาราง tbl_video ในฐานข้อมูลของคุณ
            $data = array(
                'video_status' => $newStatus
            );
            $this->db->where('video_id', $videoId); // ระบุ video_id ของแถวที่ต้องการอัพเดต
            $this->db->update('tbl_video', $data);

            // ส่งการตอบกลับ (response) กลับไปยังเว็บไซต์หรือแอพพลิเคชันของคุณ
            // โดยเช่นปกติคุณอาจส่ง JSON response กลับมาเพื่ออัพเดตหน้าเว็บ
            $response = array('status' => 'success', 'message' => 'อัพเดตสถานะเรียบร้อย');
            echo json_encode($response);
        } else {
            // ถ้าไม่มีข้อมูล POST ส่งมา ให้รีเดอร์เปรียบเสมอ
            show_404();
        }
    }

    public function video_frontend()
    {
        $this->db->select('*');
        $this->db->from('tbl_video');
        $this->db->order_by('video_id', 'asc');
        $query = $this->db->get();
        return $query->result();
    }

    public function increment_view($video_id)
    {
        $this->db->where('video_id', $video_id);
        $this->db->set('video_view', 'video_view + 1', false); // บวกค่า video_view ทีละ 1
        $this->db->update('tbl_video');
    }

    public function get_latest_video()
    {
        $this->db->where('tbl_video.video_status', 'show');
        $this->db->order_by('video_id', 'DESC');
        $this->db->limit(4); // เปลี่ยนจาก 1 เป็น 3
        $query = $this->db->get('tbl_video');
        return $query->result(); // เปลี่ยนจาก row() เป็น result() เพื่อรับข้อมูลหลายแถว
    }
}
