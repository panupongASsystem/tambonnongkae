<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Home extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		
		// ป้องกันการแคชและการคัดลอกเนื้อหา
		$this->output->set_header('Cache-Control: no-store, no-cache, must-revalidate');
		$this->output->set_header('Cache-Control: post-check=0, pre-check=0, max-age=0');
		$this->output->set_header('Pragma: no-cache');

		// ป้องกันการฝัง iframe
		$this->output->set_header('X-Frame-Options: DENY');

		// ป้องกันการคาดเดา MIME type
		$this->output->set_header('X-Content-Type-Options: nosniff');

		// ป้องกัน XSS attacks
		$this->output->set_header('X-XSS-Protection: 1; mode=block');

		// Content Security Policy เพื่อควบคุมทรัพยากรที่โหลดได้
		// $this->output->set_header("Content-Security-Policy: default-src 'self'; script-src 'self' 'unsafe-inline'; style-src 'self' 'unsafe-inline'; img-src 'self' data:; connect-src 'self'; font-src 'self'; object-src 'none'; media-src 'self'; frame-src 'none'; base-uri 'self'; form-action 'self';");

		// ป้องกันการเก็บข้อมูลโดย browsers (ใช้ในข้อมูลละเอียดอ่อน)
		$this->output->set_header('Referrer-Policy: same-origin');

		// ป้องกันการดาวน์โหลดไฟล์แทนการแสดงในเบราว์เซอร์
		$this->output->set_header('Content-Disposition: inline');

		// กำหนดเวลาหมดอายุของหน้าเว็บ
		$this->output->set_header('Expires: Sat, 26 Jul 1997 05:00:00 GMT');
		
		$this->load->model('important_day_model');
		$this->load->model('HotNews_model');
		$this->load->model('Vision_model');
		$this->load->model('Weather_report_model');
		$this->load->model('banner_model');
		$this->load->model('background_personnel_model');
		$this->load->model('calender_model');
		$this->load->model('activity_model');
		$this->load->model('p_rpo_model');
		$this->load->model('p_reb_model');
		$this->load->model('news_model');
		$this->load->model('order_model');
		$this->load->model('announce_model');
		$this->load->model('procurement_model');
		$this->load->model('mui_model');
		$this->load->model('guide_work_model');
		$this->load->model('loadform_model');

		$this->load->model('otop_model');
		$this->load->model('travel_model');
		$this->load->model('video_model');
		$this->load->model('manual_esv_model');

		$this->load->model('like_model');
		$this->load->model('log_users_model');

		$this->load->model('q_a_model');

		$this->load->model('publicize_ita_model');
		$this->load->model('prov_local_doc_model');
		$this->load->model('procurement_egp_model');
		$this->load->model('intra_egp_model');
		
		$this->load->model('cmi_model');
		$this->load->model('e_mag_model');
	}

	public function main()
	{
		$data['qImportant_day'] = $this->important_day_model->important_day_frontend();
		$data['qControl_important_day'] = $this->important_day_model->control_important_day_frontend();
		$this->load->view('frontend/main', $data);
	}

	public function index()
	{
		// โหลดข้อมูลอื่น ๆ ก่อน
		$data = $this->loadOtherData();

		// ดึงข้อมูลวิดีโอล่าสุด
		$data['latest_video'] = $this->video_model->get_latest_video();
		$data['manual_esv'] = $this->manual_esv_model->read(1);
		
		if (isset($data['qE_mag'])) {
			foreach ($data['qE_mag'] as &$magazine) {
				// เปลี่ยน URL ให้ใช้ route ใหม่ที่มี CORS support
				$magazine->pdf_url = base_url('Home/serve_pdf/' . $magazine->file_name);
				$magazine->cover_url = !empty($magazine->cover_image) 
					? base_url('Home/serve_image/' . $magazine->cover_image)
					: base_url('assets/images/default_cover.png');
			}
		}

		// โหลด API หลังจากโหลดข้อมูลอื่น ๆ เสร็จแล้ว
		$apiData = $this->loadApiData();

		// ตรวจสอบว่าข้อมูล API ใช้งานได้หรือไม่
		if ($apiData !== FALSE) {
			// รวมข้อมูลทั้งหมด
			$data['json_data'] = $apiData;
		} else {
			// ถ้า API ใช้งานไม่ได้ ไม่ต้องส่งข้อมูลไปที่หน้า home
			$data['json_data'] = []; // หรือสามารถไม่กำหนดค่านี้เลยตามความเหมาะสม
		}

		// เรียกใช้ฟังก์ชันเพื่อโหลดข้อมูล RSS
		$rssData = $this->loadNewsDlaData();
		// ตรวจสอบว่าข้อมูล RSS ใช้งานได้หรือไม่
		if ($rssData !== FALSE) {
			// รวมข้อมูล RSS กับข้อมูลอื่น ๆ
			$data['rssData'] = $rssData;
		} else {
			// ถ้า RSS ใช้งานไม่ได้ ไม่ต้องส่งข้อมูลไปที่หน้า home
			$data['rssData'] = []; // หรือสามารถไม่กำหนดค่านี้เลยตามความเหมาะสม
		}

		// สถ.จ. แบบ XML
		// $data['prov_local_doc'] = $this->getProvLocalDocFromAPI();
		// สถ.จ.
		// $data['prov_local_doc'] = $this->prov_local_doc_model->get_local_docs();

		//ข่าวจัดซื้อจัดจ้าง E-gp
		// $data['procurement_egp_tbl_w0'] = $this->procurement_egp_model->get_tbl_w0_frontend();
		// $data['procurement_egp_tbl_p0'] = $this->procurement_egp_model->get_tbl_p0_frontend();
		// $data['procurement_egp_tbl_15'] = $this->procurement_egp_model->get_tbl_15_frontend();
		// $data['procurement_egp_tbl_b0'] = $this->procurement_egp_model->get_tbl_b0_frontend();
		
		$data['events'] = $this->calender_model->get_events();

		$data['province_links'] = $this->get_province_links();
		$data['dla_links'] = $this->get_dla_links();

		// โหลด view
		$this->load->view('frontend_templat/header');
		$this->load->view('frontend_asset/css');
		$this->load->view('frontend_templat/navbar');  // ส่งข้อมูลไปที่ navbar
		$this->load->view('frontend/home', $data);
		$this->load->view('components/e_mags_modal');
		$this->load->view('frontend_asset/js');
		$this->load->view('frontend_asset/pdf_js'); // สร้างไฟล์ใหม่สำหรับ PDF.js
		$this->load->view('frontend_asset/home_calendar');
		$this->load->view('frontend_asset/php');
		$this->load->view('frontend_templat/footer');
	}


	private function loadOtherData()
	{
		// โหลดข้อมูลอื่น ๆ ที่ไม่ใช่ API
		$onlineUsersCount = $this->log_users_model->countOnlineUsers();
		$onlineUsersDay = $this->log_users_model->countUsersToday();
		$onlineUsersWeek = $this->log_users_model->countUsersThisWeek();
		$onlineUsersMonth = $this->log_users_model->countUsersThisMonth();
		$onlineUsersYear = $this->log_users_model->countUsersThisYear();
		$onlineUsersAll = $this->log_users_model->countAllUsers();

		// รวมข้อมูลทั้งหมดในรูปแบบของ array
		$data = [
			'onlineUsersCount' => $onlineUsersCount,
			'onlineUsersDay' => $onlineUsersDay,
			'onlineUsersWeek' => $onlineUsersWeek,
			'onlineUsersMonth' => $onlineUsersMonth,
			'onlineUsersYear' => $onlineUsersYear,
			'onlineUsersAll' => $onlineUsersAll,
		];

		$data['qHotnews'] = $this->HotNews_model->hotnews_frontend();
		$data['qVision'] = $this->Vision_model->vision_frontend_home();
		$data['qWeather'] = $this->Weather_report_model->weather_reports_frontend();
		$data['qBanner'] = $this->banner_model->banner_frontend();
		$data['qBackground_personnel'] = $this->background_personnel_model->background_personnel_frontend();
		$data['qCalender'] = $this->calender_model->calender_frontend();
		$data['qActivity'] = $this->activity_model->activity_frontend();

		$data['qEgp'] = $this->intra_egp_model->egp_frontend();

		$data['qP_reb'] = $this->p_reb_model->p_reb_frontend();
		$data['qP_rpo'] = $this->p_rpo_model->p_rpo_frontend();
		$data['qNews'] = $this->news_model->news_frontend();
		$data['qOrder'] = $this->order_model->order_frontend();
		$data['qAnnounce'] = $this->announce_model->announce_frontend();
		$data['qProcurement'] = $this->procurement_model->procurement_frontend();
		$data['qMui'] = $this->mui_model->mui_frontend();
		$data['qGuide_work'] = $this->guide_work_model->guide_work_frontend();
		$data['qLoadform'] = $this->loadform_model->loadform_frontend();

		$data['qTravel'] = $this->travel_model->travel_frontend();
		$data['qOtop'] = $this->otop_model->otop_frontend();
		$data['qQ_a'] = $this->q_a_model->q_a_frontend();

		$data['qPublicize_ita'] = $this->publicize_ita_model->publicize_ita_frontend();

		$data['qE_mag'] = $this->e_mag_model->get_for_home();


		$countExcellent = $this->like_model->countLikes('ดีมาก');
		$countGood = $this->like_model->countLikes('ดี');
		$countAverage = $this->like_model->countLikes('ปานกลาง');
		$countOkay = $this->like_model->countLikes('พอใช้');

		$totalCount = $countExcellent + $countGood + $countAverage + $countOkay;

		$data['percentExcellent'] = ($totalCount > 0) ? ($countExcellent / $totalCount) * 100 : 0;
		$data['percentGood'] = ($totalCount > 0) ? ($countGood / $totalCount) * 100 : 0;
		$data['percentAverage'] = ($totalCount > 0) ? ($countAverage / $totalCount) * 100 : 0;
		$data['percentOkay'] = ($totalCount > 0) ? ($countOkay / $totalCount) * 100 : 0;

		return $data;
	}

	private function loadApiData()
	{
		// // URL of the Open API
		// $api_url = 'https://govspending.data.go.th/api/service/cgdcontract?api-key=TH3JFBwJZlaXdDCpcVfSFGuoofCJ1heX&dept_code=6810509&year=2567&limit=500';

		// // Configure options for the HTTP request
		// $options = [
		// 	'http' => [
		// 		'method' => 'GET',
		// 		'timeout' => 5, // Set a timeout value for the request (in seconds)
		// 		'ignore_errors' => true, // Ignore HTTP errors to handle them manually
		// 	],
		// ];

		// // Create a stream context with the specified options
		// $context = stream_context_create($options);

		// // Fetch data from the API using file_get_contents with the specified context
		// $api_data = file_get_contents($api_url, false, $context);

		// // Check if data is fetched successfully
		// if ($api_data !== FALSE) {
		// 	// Decode the JSON data
		// 	$json_data = json_decode($api_data, TRUE);

		// 	// Check if JSON decoding is successful
		// 	if ($json_data !== NULL) {
		// 		return $json_data;
		// 	}
		// }

		// // ในกรณีที่มีปัญหาในการโหลดหรือประมวลผลข้อมูล
		// return FALSE; // แก้ไขให้ฟังก์ชันนี้คืนค่า FALSE แทน []
	}

	public function addLike()
	{
		$like_name = $this->input->post('like_name');

		if (empty($like_name)) {
			// เรียกใช้งาน SweetAlert ถ้า like_name ว่าง
			echo '<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>';
			echo '<script>
            window.onload = function() {
                Swal.fire({
                    icon: "warning",
                    title: "กรุณาเลือกแบบสอบถาม",
                    showConfirmButton: true,
                    confirmButtonText: "ตกลง"
                }).then(function() {
                    window.history.back();
                });
            }
        </script>';
			return;
		}

		// ส่วนที่เหลือของโค้ดสำหรับการบันทึกข้อมูล	
		$data = array(
			'like_name' => $like_name
		);

		$this->like_model->addLike($data);
		$this->session->set_flashdata('save_success', TRUE);
		echo '<script>window.history.back();</script>'; // เปลี่ยนไปที่หน้าก่อนหน้า
	}

	public function login()
	{
		$api_data1 = $this->fetch_api_data('https://www.assystem.co.th/service_api/index.php');
		if ($api_data1 !== FALSE) {
			// Merge API data with existing data
			$data['api_data1'] = $api_data1;
		} else {
			// Handle if API data is not fetched successfully
			$data['api_data1'] = []; // or any default value as needed
		}

		$this->load->view('login', $data);
	}

	private function fetch_api_data($api_url)
	{
		// Initialize cURL
		$curl = curl_init();

		// Set cURL options
		curl_setopt($curl, CURLOPT_URL, $api_url);
		curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false); // Disable SSL verification (for testing purposes only)

		// Execute cURL request
		$api_data = curl_exec($curl);

		// Check for errors
		if ($api_data === false) {
			$error_message = curl_error($curl);
			echo "Error: $error_message";
		} else {
			// Decode JSON data
			$data = json_decode($api_data, true);
			return $data;
		}

		// Close cURL session
		curl_close($curl);
	}


	private function loadNewsDlaData()
	{
		// Load the XML data from the URL
		$xml = @simplexml_load_file("https://addr.assystem.co.th/dla_rss.php");

		// Initialize row color flag
		$row_color = '#FFFFFF'; // Start with white

		// Array to store document data
		$documents = [];

		// Check if XML data is loaded successfully
		if ($xml !== FALSE) {
			// Loop through each DOCUMENT tag
			foreach ($xml->DOCUMENT as $document) {
				// Alternate row color
				$row_color = ($row_color == '#FFFFFF') ? '#73e3f9' : '#FFFFFF';

				// Extract data from XML
				$date = (string) $document->DOCUMENT_DATE;
				$organization = (string) $document->ORG;
				$doc_number = (string) $document->DOCUMENT_NO;
				$topic = (string) $document->DOCUMENT_TOPIC;
				$upload_file1 = (string) $document->UPLOAD_FILE1;

				// Initialize topic with no hyperlink
				$topic_html = $topic;

				// Check if UPLOAD_FILE1 exists for the topic
				if (isset($document->UPLOAD_FILE1)) {
					// Get UPLOAD_FILE1 link
					$upload_file1 = (string) $document->UPLOAD_FILE1;
					// Create hyperlink for the topic
					$topic_html = '<a href="' . $upload_file1 . '">' . $topic . '</a>';
				}

				// Check if there are additional UPLOAD_FILE and UPLOAD_DESC
				for ($i = 2; $i <= 5; $i++) {
					$upload_file = (isset($document->{"UPLOAD_FILE$i"})) ? (string) $document->{"UPLOAD_FILE$i"} : '';
					$upload_desc = (isset($document->{"UPLOAD_DESC$i"})) ? (string) $document->{"UPLOAD_DESC$i"} : '';
					if (!empty($upload_file)) {
						$topic_html .= '<br><a href="' . $upload_file . '">' . $upload_desc . '</a>';
					}
				}

				// Generate data array for the view
				$documents[] = [
					'date' => $date,
					'organization' => $organization,
					'doc_number' => $doc_number,
					'topic' => $topic_html
				];
			}
			// echo '<pre>';
			// print_r($documents);
			// echo '</pre>';
			// exit;
		} else {
			// Handle error: XML data could not be loaded
			$documents = [];
		}

		// Sort documents by date in descending order
		usort($documents, function ($a, $b) {
			$dateA = DateTime::createFromFormat('d/m/Y', $a['date']);
			$dateB = DateTime::createFromFormat('d/m/Y', $b['date']);
			return $dateB <=> $dateA; // Descending order
		});

		// Return the array of documents
		return $documents;
	}
	
	
	public function check_session() {
    if (!$this->input->is_ajax_request()) {
        show_404();
       return;
   }
    
  $this->output->set_content_type('application/json');
   $this->output->set_header('Cache-Control: no-cache');
    
   $is_logged_in = (
       ($this->session->userdata('mp_id') && !empty($this->session->userdata('mp_id'))) ||
      ($this->session->userdata('m_id') && !empty($this->session->userdata('m_id')))
  );
    
  $this->output->set_output(json_encode(['is_logged_in' => $is_logged_in]));
    }
	
	private function get_province_links()
	{
		$province_name = get_config_value('province');

		if (empty($province_name)) {
			return [];
		}

		// เรียก API
		$url = "https://addr.assystem.co.th/index.php/api_web_links/get_links?province=" . urlencode($province_name);

		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_TIMEOUT, 10);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);

		$response = curl_exec($ch);
		$http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
		curl_close($ch);

		if (!$response || $http_code != 200) {
			return [];
		}

		$data = json_decode($response, true);

		if (!$data || $data['status'] !== 'success' || empty($data['data'])) {
			return [];
		}

		// แยกประเภทลิงก์ด้วยชื่อใหม่
		$links = [];

		foreach ($data['data'] as $item) {
			$desc = mb_strtolower($item['description']);
			$url = $item['url'];

			// 1. Province (จังหวัด)
			if (
				strpos($desc, 'จังหวัด') !== false &&
				strpos($desc, 'อบจ') === false &&
				strpos($desc, 'สสจ') === false &&
				strpos($desc, 'ดำรงธรรม') === false &&
				strpos($desc, 'สถจ') === false
			) {
				$links['Province'] = $url;
			}
			// 2. PAO (อบจ - Provincial Administrative Organization)
			elseif (strpos($desc, 'อบจ') !== false || strpos($desc, 'องค์การบริหารส่วนจังหวัด') !== false) {
				$links['PAO'] = $url;
			}
			// 3. PPHO (สสจ - Provincial Public Health Office)
			elseif (strpos($desc, 'สสจ') !== false || strpos($desc, 'สาธารณสุข') !== false) {
				$links['PPHO'] = $url;
			}
			// 4. Damrongdhama (ดำรงธรรม)
			elseif (strpos($desc, 'ดำรงธรรม') !== false) {
				$links['Damrongdhama'] = $url;
			}
			// 5. POLA (สถจ - Provincial Office of Local Administration)
			elseif (strpos($desc, 'สถจ') !== false || strpos($desc, 'ส่งเสริมการปกครอง') !== false) {
				$links['POLA'] = $url;
			}
		}

		return $links;
	}
	
	private function get_dla_links()
	{
		$url = "https://addr.assystem.co.th/index.php/api_dla_links/links";

		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_TIMEOUT, 10);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);

		$response = curl_exec($ch);
		$http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
		curl_close($ch);

		if (!$response || $http_code != 200) {
			return [];
		}

		$data = json_decode($response, true);

		if (!$data || $data['status'] !== 'success' || empty($data['data'])) {
			return [];
		}

		// แปลงเป็น array โดยใช้ id เป็น key
		$links = [];
		foreach ($data['data'] as $item) {
			$links[$item['id']] = $item['url'];
		}

		return $links;
	}

	// เพิ่มฟังก์ชันสำหรับ serve PDF files ด้วย CORS headers
	public function serve_pdf($filename)
	{
		$file_path = FCPATH . 'docs/file/' . $filename;

		// ตรวจสอบว่าไฟล์มีอยู่จริง
		if (!file_exists($file_path)) {
			show_404();
			return;
		}

		// ตั้งค่า CORS headers
		header('Access-Control-Allow-Origin: *');
		header('Access-Control-Allow-Methods: GET, POST, OPTIONS');
		header('Access-Control-Allow-Headers: Content-Type');

		// ตั้งค่า content type สำหรับ PDF
		header('Content-Type: application/pdf');
		header('Content-Length: ' . filesize($file_path));
		header('Cache-Control: public, max-age=3600'); // Cache เป็นเวลา 1 ชั่วโมง

		// ส่งไฟล์
		readfile($file_path);
		exit;
	}

	// เพิ่มฟังก์ชันสำหรับ serve image files ด้วย CORS headers
	public function serve_image($filename)
	{
		$file_path = FCPATH . 'docs/img/' . $filename;

		// ตรวจสอบว่าไฟล์มีอยู่จริง
		if (!file_exists($file_path)) {
			show_404();
			return;
		}

		// ตรวจสอบนามสกุลไฟล์
		$allowed_extensions = ['jpg', 'jpeg', 'png', 'gif', 'webp'];
		$file_extension = strtolower(pathinfo($filename, PATHINFO_EXTENSION));

		if (!in_array($file_extension, $allowed_extensions)) {
			show_404();
			return;
		}

		// ตั้งค่า CORS headers
		header('Access-Control-Allow-Origin: *');
		header('Access-Control-Allow-Methods: GET, POST, OPTIONS');
		header('Access-Control-Allow-Headers: Content-Type');

		// ตั้งค่า content type ตามประเภทไฟล์
		$mime_types = [
			'jpg' => 'image/jpeg',
			'jpeg' => 'image/jpeg',
			'png' => 'image/png',
			'gif' => 'image/gif',
			'webp' => 'image/webp'
		];

		header('Content-Type: ' . $mime_types[$file_extension]);
		header('Content-Length: ' . filesize($file_path));
		header('Cache-Control: public, max-age=86400'); // Cache เป็นเวลา 24 ชั่วโมง

		// ส่งไฟล์
		readfile($file_path);
		exit;
	}
	
	private function getProvLocalDocFromAPI($limit = 13)
	{
		$province = get_config_value('province');
		if (empty($province)) {
			error_log("Province config not found");
			return [];
		}

		// Step 1: เรียก API เพื่อขอ URL ของ RSS feed ตามจังหวัด
		$api_url = 'https://addr.assystem.co.th/index.php/api_rss_book/get_rss?province=' . urlencode($province);

		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $api_url);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_TIMEOUT, 10);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, true);

		$rss_url = curl_exec($ch);
		$http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
		$curl_error = curl_error($ch);
		curl_close($ch);

		if ($curl_error) {
			error_log("cURL Error (Get RSS URL): " . $curl_error);
			return [];
		}

		if ($http_code != 200 || empty($rss_url)) {
			error_log("API Error: HTTP Code " . $http_code);
			return [];
		}

		// ทำความสะอาด URL ที่ได้มา
		$rss_url = trim($rss_url);

		// Step 2: เรียก URL ที่ได้มาเพื่อดึงข้อมูล XML
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $rss_url);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_TIMEOUT, 10);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, true);

		$response = curl_exec($ch);
		$http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
		$curl_error = curl_error($ch);
		curl_close($ch);

		if ($curl_error) {
			error_log("cURL Error (Fetch XML): " . $curl_error);
			return [];
		}

		if ($http_code != 200 || !$response) {
			error_log("RSS Feed Error: HTTP Code " . $http_code);
			return [];
		}

		// Parse XML
		$documents = [];
		libxml_use_internal_errors(true);
		$xml = simplexml_load_string($response);

		if ($xml === false) {
			error_log("XML Parse Error: " . implode(", ", libxml_get_errors()));
			libxml_clear_errors();
			return [];
		}

		if (isset($xml->DOCUMENT)) {
			foreach ($xml->DOCUMENT as $doc) {
				$documents[] = [
					'doc_no' => (string)$doc->DOCUMENT_NUMBER,
					'topic' => (string)$doc->DOCUMENT_TOPIC,
					'doc_date' => (string)$doc->DOCUMENT_DATE,
					'url' => (string)$doc->DETAIL_URL,
					'link' => (string)$doc->DETAIL_URL
				];
			}
		}

		return array_slice($documents, 0, $limit);
	}
	
	
	// ฟังก์ชันจัดการ Cache
	private function get_cache($key)
	{
		$cache_file = APPPATH . 'cache/' . md5($key) . '.cache';

		if (file_exists($cache_file)) {
			$cache_data = unserialize(file_get_contents($cache_file));
			if ($cache_data['expires'] > time()) {
				return $cache_data['data'];
			}
		}

		return FALSE;
	}

	private function set_cache($key, $data, $ttl = 300)
	{
		$cache_file = APPPATH . 'cache/' . md5($key) . '.cache';
		$cache_data = array(
			'data' => $data,
			'expires' => time() + $ttl
		);

		file_put_contents($cache_file, serialize($cache_data));
	}
}
