<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="<?php echo base_url("docs/logo.png"); ?>" type="image/x-icon">
    <title><?php echo get_config_value('fname'); ?> - ระบบแอดมิน</title>
    
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    
    <!-- Google Fonts -->
    <link href='https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&family=Kanit:wght@300;400;500;600;700&display=swap' rel='stylesheet'>
    
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css">
    
    <!-- CKEditor -->
    <script src="https://cdn.ckeditor.com/ckeditor5/39.0.1/classic/ckeditor.js"></script>
    
    <!-- SweetAlert2 -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.31/dist/sweetalert2.min.css">
    
    <!-- Video.js -->
    <link href="https://vjs.zencdn.net/7.14.3/video-js.css" rel="stylesheet">
    <script src="https://vjs.zencdn.net/7.14.3/video.js"></script>
    
    <!-- Font Awesome -->
    <link href="<?= base_url(); ?>vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
    
    <!-- SB Admin 2 CSS -->
    <link href="<?= base_url('asset/'); ?>css/sb-admin-2.min.css" rel="stylesheet">
    
    <!-- DataTables -->
    <link href="<?= base_url(); ?>vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
    
    <!-- Lightbox -->
    <link href="<?= base_url('asset/'); ?>lightbox2/src/css/lightbox.css" rel="stylesheet">
    
    <!-- jQuery - โหลดก่อน script อื่นๆ -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    
    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" 
            integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" 
            crossorigin="anonymous"
            onerror="console.log('Bootstrap CDN failed, using fallback')"></script>
    
    <!-- Fancybox CSS & JS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fancybox/3.5.7/jquery.fancybox.min.css" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/fancybox/3.5.7/jquery.fancybox.min.js"></script>

    <!-- 🔧 REQUIRED: Session Manager -->
    <script src="<?php echo base_url('asset/js/session-manager.js'); ?>"></script>
	
	<!-- DataTables CSS -->
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.13.7/css/dataTables.bootstrap5.min.css">
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/responsive/2.5.0/css/responsive.bootstrap5.min.css">

<!-- DataTables JS -->
<script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.7/js/dataTables.bootstrap5.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.5.0/js/dataTables.responsive.min.js"></script>
	
	<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
	
	
	<script>
// === DISABLE ALL DEBUG/CONSOLE LOGS ===
(function() {
    // ปิด console ทั้งหมด
    console.log = function() {};
    console.warn = function() {};
    console.info = function() {};
    console.debug = function() {};
    // เก็บ console.error ไว้เฉพาะ error ที่สำคัญ (optional)
    // console.error = function() {};
})();
</script>
	
	

    <style>
        :root {
            /* Modern Soft Color Palette */
            --primary-soft: #667eea;
            --primary-light: #f093fb;
            --secondary-soft: #a8edea;
            --success-soft: #88d8c0;
            --warning-soft: #ffeaa7;
            --danger-soft: #fd79a8;
            --info-soft: #74b9ff;
            --light-soft: #fdcb6e;
            
            /* Gradients */
            --gradient-primary: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            --gradient-secondary: linear-gradient(135deg, #a8edea 0%, #fed6e3 100%);
            --gradient-success: linear-gradient(135deg, #88d8c0 0%, #6bb6ff 100%);
            --gradient-warning: linear-gradient(135deg, #ffeaa7 0%, #fab1a0 100%);
            --gradient-info: linear-gradient(135deg, #74b9ff 0%, #0984e3 100%);
            --gradient-danger: linear-gradient(135deg, #fd79a8 0%, #fdcb6e 100%);
            
            /* Backgrounds */
            --bg-soft: #f8f9ff;
            --card-bg: #ffffff;
            --card-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
            --card-shadow-hover: 0 8px 40px rgba(0, 0, 0, 0.12);
            
            /* Text Colors */
            --text-primary: #2d3748;
            --text-secondary: #4a5568;
            --text-muted: #718096;
            --text-light: #a0aec0;
        }

        body {
            font-family: 'Inter', 'Kanit', sans-serif;
            background: var(--bg-soft);
            color: var(--text-primary);
            line-height: 1.6;
        }

        /* Card Enhancements */
        .card {
            border: none !important;
            border-radius: 20px !important;
            background: var(--card-bg) !important;
            box-shadow: var(--card-shadow) !important;
            transition: all 0.3s ease !important;
            overflow: hidden;
        }

        .card:hover {
            transform: translateY(-2px);
            box-shadow: var(--card-shadow-hover) !important;
        }

        .card-header {
            background: transparent !important;
            border-bottom: 1px solid rgba(0, 0, 0, 0.05) !important;
            padding: 1.5rem !important;
        }

        .card-body {
            padding: 1.5rem !important;
        }

        /* Modern Gradients for Storage Card */
        .card-body-icon {
            background: var(--gradient-primary) !important;
            border-radius: 12px;
        }
        
        .bg-primary .card-body-icon {
            background: var(--gradient-primary) !important;
        }
        
        .bg-success .card-body-icon {
            background: var(--gradient-success) !important;
        }
        
        .bg-warning .card-body-icon {
            background: var(--gradient-warning) !important;
        }
        
        .bg-info .card-body-icon {
            background: var(--gradient-info) !important;
        }

        /* Progress Bars */
        .progress {
            border-radius: 12px !important;
            background: rgba(0, 0, 0, 0.05) !important;
            height: 8px !important;
        }

        .progress-bar {
            border-radius: 12px !important;
            background: var(--gradient-success) !important;
            transition: all 0.3s ease;
        }

        /* Custom Progress Colors */
        .progress-green .progress-bar {
            background: var(--gradient-success) !important;
        }

        .progress-orange .progress-bar {
            background: var(--gradient-warning) !important;
        }

        .progress-red .progress-bar {
            background: var(--gradient-danger) !important;
        }

        /* Typography */
        h1, h2, h3, h4, h5, h6 {
            font-weight: 600;
            color: var(--text-primary);
        }

        .font-weight-bold {
            font-weight: 600 !important;
        }

        /* Buttons */
        .btn {
            border-radius: 12px !important;
            font-weight: 500;
            transition: all 0.3s ease;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
        }

        .btn:hover {
            transform: translateY(-1px);
            box-shadow: 0 4px 16px rgba(0, 0, 0, 0.15);
        }

        .btn-sky {
            background: var(--gradient-success) !important;
            color: #fff !important;
            border: none !important;
            padding: 8px 20px;
            font-size: 14px;
            font-weight: 500;
        }

        .btn-sky:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(136, 216, 192, 0.4);
            color: #fff !important;
        }

        /* Status Badges */
        .status-badge {
            border-radius: 20px !important;
            padding: 6px 12px !important;
            font-size: 11px !important;
            font-weight: 500 !important;
            border: 2px solid !important;
            display: inline-block;
            min-width: 100px;
            text-align: center;
        }

        /* Complain Status Colors - Soft Theme */
        .status-received {
            background: rgba(116, 185, 255, 0.1) !important;
            color: #3182ce !important;
            border-color: rgba(116, 185, 255, 0.3) !important;
        }

        .status-processing {
            background: rgba(159, 122, 234, 0.1) !important;
            color: #6b46c1 !important;
            border-color: rgba(159, 122, 234, 0.3) !important;
        }

        .status-waiting {
            background: rgba(255, 178, 102, 0.1) !important;
            color: #d69e2e !important;
            border-color: rgba(255, 178, 102, 0.3) !important;
        }

        .status-completed {
            background: rgba(136, 216, 192, 0.1) !important;
            color: #38a169 !important;
            border-color: rgba(136, 216, 192, 0.3) !important;
        }

        .status-cancelled {
            background: rgba(253, 121, 168, 0.1) !important;
            color: #e53e3e !important;
            border-color: rgba(253, 121, 168, 0.3) !important;
        }

        /* Member Progress Bars */
        .member-progress {
            height: 35px !important;
            border-radius: 15px !important;
            background: rgba(0, 0, 0, 0.03) !important;
            margin-bottom: 12px !important;
            overflow: hidden;
            box-shadow: inset 0 2px 4px rgba(0, 0, 0, 0.06);
        }

        .member-progress .progress-bar {
            background: var(--gradient-success) !important;
            border: none !important;
            border-radius: 15px !important;
            display: flex !important;
            align-items: center !important;
            padding: 0 15px !important;
            font-size: 14px !important;
            font-weight: 500 !important;
            color: #fff !important;
            position: relative;
        }

        .member-progress .member-name {
            flex: 1;
            text-align: left;
        }

        .member-progress .member-count {
            font-weight: 600;
            background: rgba(255, 255, 255, 0.2);
            padding: 4px 12px;
            border-radius: 12px;
            margin-left: auto;
        }

/* Visitor Progress Bars */
.visitor-progress {
    height: 35px !important;
    border-radius: 15px !important;
    background: rgba(0, 0, 0, 0.03) !important;
    margin-bottom: 12px !important;
    overflow: hidden;
    box-shadow: inset 0 2px 4px rgba(0, 0, 0, 0.06);
}

.visitor-progress .progress-bar {
    background: var(--gradient-warning) !important;
    border: none !important;
    border-radius: 15px !important;
    display: flex !important;
    align-items: center !important;
    justify-content: space-between !important;
    padding: 0 15px !important;
    font-size: 14px !important;
    font-weight: 500 !important;
    color: #fff !important;
}

.visitor-progress .member-name {
    text-align: left;
}

.visitor-progress .member-count {
    text-align: right;
}
		
		.visitor-progress .member-name {
    flex: 1;
    text-align: left;
}

.visitor-progress .member-count {
    font-weight: 600;
    background: rgba(255, 255, 255, 0.2);
    padding: 4px 12px;
    border-radius: 12px;
    margin-left: auto;
}

        /* Dots for Complain Status */
        .dot_complain1, .dot_complain2, .dot_complain3, .dot_complain4, .dot_complain5 {
            width: 12px;
            height: 12px;
            border-radius: 50%;
            display: inline-block;
            margin-right: 8px;
        }

        .dot_complain1 { background: var(--success-soft); }
        .dot_complain2 { background: var(--info-soft); }
        .dot_complain3 { background: var(--primary-soft); }
        .dot_complain4 { background: var(--warning-soft); }
        .dot_complain5 { background: var(--danger-soft); }

        /* 🚨 REQUIRED: Session Warning Modals Styles */
        .modal {
            z-index: 9999 !important;
        }
        .modal-backdrop {
            z-index: 9998 !important;
        }
        .modal-dialog {
            z-index: 10000 !important;
            position: relative;
        }
        .modal-content {
            position: relative;
            z-index: 10001 !important;
            border: none !important;
            border-radius: 20px !important;
            box-shadow: 0 20px 60px rgba(0,0,0,0.3) !important;
            overflow: hidden;
        }
        
        .modal-header {
            border-radius: 20px 20px 0 0 !important;
            border-bottom: 1px solid rgba(255, 255, 255, 0.1) !important;
        }

        /* Session Modal Animations */
        .timeout-icon i, .logout-icon i {
            animation: pulse 2s infinite;
        }
        @keyframes pulse {
            0% { transform: scale(1); }
            50% { transform: scale(1.1); }
            100% { transform: scale(1); }
        }
        
        .timeout-title, .logout-title {
            font-weight: 600;
            margin-bottom: 15px;
        }
        
        .timeout-message, .logout-message {
            line-height: 1.6;
            color: #666;
        }
        
        /* Responsive สำหรับ Session Modals */
        @media (max-width: 576px) {
            .timeout-icon i, .logout-icon i {
                font-size: 3rem !important;
            }
            .timeout-title, .logout-title {
                font-size: 1.2rem;
            }
        }

        /* Alert floating styles */
        .alert-floating {
            position: fixed;
            top: 20px;
            right: 20px;
            z-index: 99999;
            min-width: 300px;
            max-width: 500px;
            border-radius: 16px !important;
            border: none !important;
            box-shadow: 0 10px 40px rgba(0, 0, 0, 0.15) !important;
            animation: slideInRight 0.3s ease-out;
        }
        
        @keyframes slideInRight {
            from {
                transform: translateX(100%);
                opacity: 0;
            }
            to {
                transform: translateX(0);
                opacity: 1;
            }
        }

        /* Container improvements */
        .container-fluid, .container {
            max-width: none !important;
            padding-left: 20px !important;
            padding-right: 20px !important;
        }

        .col-xl-3, .col-xl-4, .col-xl-5, .col-md-3, .col-md-4, .col-md-5 {
            padding-left: 10px !important;
            padding-right: 10px !important;
        }

        /* Text utilities */
        .text-soft {
            color: var(--text-muted) !important;
        }

        .text-primary-soft {
            color: var(--primary-soft) !important;
        }

        /* Links */
        a {
            color: var(--primary-soft);
            text-decoration: none;
            transition: all 0.3s ease;
        }

        a:hover {
            color: var(--primary-light);
            text-decoration: none;
        }

        /* Small font adjustments */
        .small-font {
            font-size: 13px !important;
            color: var(--text-muted) !important;
            font-weight: 500;
        }

        /* View link styling */
        .view-link {
            color: var(--primary-soft) !important;
            font-size: 13px;
            font-weight: 500;
            text-decoration: none;
            transition: all 0.3s ease;
        }

        .view-link:hover {
            color: var(--primary-light) !important;
            transform: translateX(2px);
        }

        /* One line ellipsis */
        .one-line-ellipsis {
            overflow: hidden;
            text-overflow: ellipsis;
            display: -webkit-box;
            -webkit-line-clamp: 1;
            -webkit-box-orient: vertical;
            line-height: 1.4;
        }

        /* Custom scrollbar */
        ::-webkit-scrollbar {
            height: 6px;
            width: 6px;
        }

        ::-webkit-scrollbar-track {
            background: rgba(0, 0, 0, 0.05);
            border-radius: 10px;
        }

        ::-webkit-scrollbar-thumb {
            background: var(--gradient-primary);
            border-radius: 10px;
        }

        ::-webkit-scrollbar-thumb:hover {
            background: var(--gradient-secondary);
        }

        /* Chart container improvements */
        .chart-container {
            background: var(--card-bg);
            border-radius: 16px;
            padding: 20px;
            box-shadow: var(--card-shadow);
        }

        /* ApexCharts overrides */
        .apexcharts-canvas {
            font-family: 'Inter', 'Kanit', sans-serif !important;
        }

        .apexcharts-title-text {
            font-weight: 600 !important;
            fill: var(--text-primary) !important;
        }

        .apexcharts-legend-text {
            color: var(--text-secondary) !important;
            font-weight: 500 !important;
        }
    </style>

    <script>
        // Fancybox initialization - รอ DOM ready
        $(document).ready(function() {
            $('[data-fancybox="gallery"]').fancybox({
                buttons: ["zoom", "slideShow", "fullScreen", "thumbs", "close"],
                loop: true,
                protect: true
            });
        });

        // ลบ Bootstrap local references อัตโนมัติ
        document.addEventListener('DOMContentLoaded', function() {
            // ลบ script tags ที่เรียกใช้ local Bootstrap
            const scripts = document.querySelectorAll('script[src*="vendor/bootstrap"]');
            scripts.forEach(script => {
                console.log('🗑️ Removing local Bootstrap script:', script.src);
                script.remove();
            });
            
            // ลบ link tags ที่เรียกใช้ local Bootstrap CSS
            const links = document.querySelectorAll('link[href*="vendor/bootstrap"]');
            links.forEach(link => {
                console.log('🗑️ Removing local Bootstrap CSS:', link.href);
                link.remove();
            });
            
            console.log('✅ Bootstrap cleanup completed');
        });
    </script>
</head>

<body id="page-top">
    <!-- Page Wrapper -->
    <div id="wrapper">