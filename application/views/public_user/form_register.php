<!DOCTYPE html>
<html lang="th">

<head>
	
	
	 <style>
    /* 🆕 เพิ่ม CSS สำหรับ error display และ password toggle */
    .password-toggle {
        position: absolute;
        right: 40px;
        top: 50%;
        transform: translateY(-50%);
        background: none;
        border: none;
        color: #6c757d;
        cursor: pointer;
        padding: 5px;
        z-index: 10;
    }

    .password-toggle:hover {
        color: #495057;
    }

    .input-wrapper {
        position: relative;
    }

    /* 🆕 Email Check Button Styles */
    .email-check-wrapper {
        position: relative;
    }

    .check-email-btn {
        position: absolute;
        right: 10px;
        top: 50%;
        transform: translateY(-50%);
        background: linear-gradient(135deg, #007bff, #0056b3);
        border: none;
        color: white;
        padding: 8px 12px;
        border-radius: 6px;
        font-size: 0.85rem;
        cursor: pointer;
        z-index: 10;
        transition: all 0.3s ease;
        display: flex;
        align-items: center;
        gap: 5px;
        min-width: 100px;
        justify-content: center;
    }

    .check-email-btn:hover:not(:disabled) {
        background: linear-gradient(135deg, #0056b3, #004085);
        transform: translateY(-50%) translateY(-1px);
        box-shadow: 0 4px 8px rgba(0, 123, 255, 0.3);
    }

    .check-email-btn:disabled {
        background: #6c757d;
        cursor: not-allowed;
        opacity: 0.7;
    }

    .check-email-btn .btn-text {
        font-size: 0.8rem;
        font-weight: 500;
    }

    .email-check-wrapper .input-field {
        padding-right: 120px;
    }

    /* 🆕 ID Number Check Button Styles */
    .id-check-wrapper {
        position: relative;
    }

    .check-id-btn {
        position: absolute;
        right: 10px;
        top: 50%;
        transform: translateY(-50%);
        background: linear-gradient(135deg, #28a745, #1e7e34);
        border: none;
        color: white;
        padding: 8px 12px;
        border-radius: 6px;
        font-size: 0.85rem;
        cursor: pointer;
        z-index: 10;
        transition: all 0.3s ease;
        display: flex;
        align-items: center;
        gap: 5px;
        min-width: 100px;
        justify-content: center;
    }

    .check-id-btn:hover:not(:disabled) {
        background: linear-gradient(135deg, #1e7e34, #155724);
        transform: translateY(-50%) translateY(-1px);
        box-shadow: 0 4px 8px rgba(40, 167, 69, 0.3);
    }

    .check-id-btn:disabled {
        background: #6c757d;
        cursor: not-allowed;
        opacity: 0.7;
    }

    .check-id-btn .btn-text {
        font-size: 0.8rem;
        font-weight: 500;
    }

    .id-check-wrapper .input-field {
        padding-right: 120px;
    }

    .input-field.is-invalid {
        border-color: #dc3545;
        box-shadow: 0 0 0 0.2rem rgba(220, 53, 69, 0.25);
    }

    .form-select.is-invalid {
        border-color: #dc3545;
        box-shadow: 0 0 0 0.2rem rgba(220, 53, 69, 0.25);
    }

    .invalid-feedback {
        display: block;
        width: 100%;
        margin-top: 0.25rem;
        font-size: 0.875em;
        color: #dc3545;
    }

    #validation-errors {
        margin-bottom: 1.5rem;
        border-left: 4px solid #dc3545;
    }

    #validation-errors ul {
        margin-bottom: 0;
        padding-left: 1.5rem;
    }

    #validation-errors li {
        margin-bottom: 0.25rem;
    }

    .loading-icon {
        position: absolute;
        right: 30px;
        top: 50%;
        transform: translateY(-50%);
        color: #007bff;
        z-index: 10;
    }

    .address-error {
        color: #dc3545 !important;
        font-size: 0.875em;
        margin-top: 0.25rem;
    }

    /* ปรับปรุง input field styling */
    .input-field:focus {
        border-color: #80bdff;
        box-shadow: 0 0 0 0.2rem rgba(0, 123, 255, 0.25);
        outline: 0;
    }

    .form-select:focus {
        border-color: #80bdff;
        box-shadow: 0 0 0 0.2rem rgba(0, 123, 255, 0.25);
        outline: 0;
    }

    /* 🆕 Success Modal Styles */
    .success-modal {
        border: none;
        border-radius: 20px;
        box-shadow: 0 20px 60px rgba(0, 0, 0, 0.2);
    }

    .success-modal .modal-body {
        background: linear-gradient(135deg, #f8f9fa, #e9ecef);
        border-radius: 20px;
    }

    .success-icon {
        font-size: 4rem;
        color: #28a745;
        text-shadow: 0 4px 8px rgba(40, 167, 69, 0.3);
    }

    .success-title {
        color: #2c3e50;
        font-weight: 700;
        font-size: 1.8rem;
    }

    .success-message {
        color: #6c757d;
        font-size: 1.1rem;
        line-height: 1.6;
    }

    /* 🆕 Checkmark Animation */
    .success-animation {
        display: flex;
        justify-content: center;
        align-items: center;
    }

    .checkmark {
        width: 56px;
        height: 56px;
        border-radius: 50%;
        display: block;
        stroke-width: 2;
        stroke: #28a745;
        stroke-miterlimit: 10;
        box-shadow: inset 0px 0px 0px #28a745;
        animation: fill .4s ease-in-out .4s forwards, scale .3s ease-in-out .9s both;
        position: relative;
    }

    .checkmark_circle {
        stroke-dasharray: 166;
        stroke-dashoffset: 166;
        stroke-width: 2;
        stroke-miterlimit: 10;
        stroke: #28a745;
        fill: none;
        animation: stroke 0.6s cubic-bezier(0.65, 0, 0.45, 1) forwards;
        width: 56px;
        height: 56px;
        border-radius: 50%;
        left: 0;
        top: 0;
        position: absolute;
        border: 2px solid #28a745;
    }

    .checkmark_stem {
        animation: stroke 0.3s cubic-bezier(0.65, 0, 0.45, 1) 0.8s forwards;
        position: absolute;
        left: 50%;
        top: 50%;
        width: 3px;
        height: 9px;
        background: #28a745;
        transform: translate(-50%, -60%) rotate(135deg);
        transform-origin: center;
        opacity: 0;
    }

    .checkmark_kick {
        animation: stroke 0.3s cubic-bezier(0.65, 0, 0.45, 1) 0.9s forwards;
        position: absolute;
        left: 50%;
        top: 50%;
        width: 3px;
        height: 3px;
        background: #28a745;
        transform: translate(-50%, -20%) rotate(-45deg);
        transform-origin: center;
        opacity: 0;
    }
	.login-link {
    font-size: 0.875rem; /* ลดขนาดฟอนต์ */
    padding: 8px 12px; /* ลดขนาด padding */
	}

	.register-btn {
		font-size: 0.875rem; /* ลดขนาดฟอนต์ */
		padding: 10px 16px; /* ลดขนาด padding */
	}

	.login-link i,
	.register-btn i {
		font-size: 0.8rem; /* ลดขนาดไอคอน */
	}

    @keyframes stroke {
        100% {
            opacity: 1;
        }
    }

    @keyframes scale {
        0%, 100% {
            transform: none;
        }
        50% {
            transform: scale3d(1.1, 1.1, 1);
        }
    }

    @keyframes fill {
        100% {
            box-shadow: inset 0px 0px 0px 30px #28a745;
        }
    }

    /* 🆕 Email Status Colors */
    #email-check-status .text-success {
        color: #28a745 !important;
        font-weight: 600;
    }

    #email-check-status .text-danger {
        color: #dc3545 !important;
        font-weight: 600;
    }

    #email-check-counter {
        margin-top: 0.5rem;
    }

    #email-check-counter .text-muted {
        font-size: 0.85rem;
    }

    /* 🆕 Error Modal Styles */
    .error-modal {
        border: none;
        border-radius: 15px;
        box-shadow: 0 20px 60px rgba(220, 53, 69, 0.2);
    }

    .error-modal .modal-header {
        background: linear-gradient(135deg, #f8d7da, #f5c6cb);
        border-radius: 15px 15px 0 0;
        padding: 1.5rem;
    }

    .error-modal .modal-title {
        font-weight: 600;
        font-size: 1.2rem;
    }

    .error-modal .modal-body {
        padding: 1.5rem;
    }

    .error-modal .alert {
        background: linear-gradient(135deg, #f8d7da, #f5c6cb);
        border: 1px solid #f1aeb5;
        border-radius: 10px;
    }

    .error-modal .alert ul {
        padding-left: 1.5rem;
    }

    .error-modal .alert li {
        margin-bottom: 0.5rem;
        color: #721c24;
        font-weight: 500;
    }

    .error-modal .btn-close {
        filter: brightness(0) saturate(100%) invert(18%) sepia(49%) saturate(1643%) hue-rotate(324deg) brightness(98%) contrast(94%);
    }

    .error-modal .modal-footer {
        padding: 1rem 1.5rem 1.5rem;
    }

    /* Loading Button Animation */
    .spinner-border-sm {
        width: 1rem;
        height: 1rem;
        border-width: 0.1em;
    }

    .register-btn:disabled {
        opacity: 0.8;
        cursor: not-allowed;
    }

    /* Error Icon Animation */
    .error-icon .fa-times-circle {
        animation: errorPulse 2s infinite;
    }

    @keyframes errorPulse {
        0% {
            transform: scale(1);
            opacity: 1;
        }
        50% {
            transform: scale(1.05);
            opacity: 0.8;
        }
        100% {
            transform: scale(1);
            opacity: 1;
        }
    }

    /* Validation Error Highlight */
    .is-invalid {
        animation: errorShake 0.5s ease-in-out;
    }

    @keyframes errorShake {
        0%, 100% {
            transform: translateX(0);
        }
        10%, 30%, 50%, 70%, 90% {
            transform: translateX(-5px);
        }
        20%, 40%, 60%, 80% {
            transform: translateX(5px);
        }
    }

    /* Modal Backdrop */
    .modal-backdrop {
        background-color: rgba(0, 0, 0, 0.6);
    }

    /* Responsive Modal */
    @media (max-width: 576px) {
        .error-modal .modal-dialog {
            margin: 1rem;
        }
        
        .error-modal .modal-header,
        .error-modal .modal-body,
        .error-modal .modal-footer {
            padding: 1rem;
        }
    }
    </style>
	
	
	 <style>
	/* Post Registration 2FA Modal Styles */
#postRegistration2FAInviteModal .modal-content {
    border: none;
    border-radius: 15px;
    box-shadow: 0 20px 60px rgba(0,0,0,0.15);
}

#postRegistration2FAInviteModal .modal-header {
    border-radius: 15px 15px 0 0;
    border-bottom: none;
    padding: 25px 30px;
}

#postRegistration2FAInviteModal .modal-body {
    padding: 30px;
}

#postRegistration2FAInviteModal .btn-success {
    background: linear-gradient(135deg, #28a745, #20c997);
    border: none;
    font-weight: 600;
    box-shadow: 0 4px 15px rgba(40, 167, 69, 0.3);
    transition: all 0.3s ease;
}

#postRegistration2FAInviteModal .btn-success:hover {
    background: linear-gradient(135deg, #20c997, #28a745);
    transform: translateY(-2px);
    box-shadow: 0 6px 20px rgba(40, 167, 69, 0.4);
}

#postRegistration2FAInviteModal .btn-outline-secondary {
    border: 2px solid #6c757d;
    font-weight: 500;
    transition: all 0.3s ease;
}

#postRegistration2FAInviteModal .btn-outline-secondary:hover {
    background: #6c757d;
    border-color: #6c757d;
    transform: translateY(-1px);
}

/* Animation for benefits */
#postRegistration2FAInviteModal .d-flex.align-items-start {
    animation: slideInUp 0.6s ease-out;
    animation-fill-mode: both;
}

#postRegistration2FAInviteModal .d-flex.align-items-start:nth-child(1) { animation-delay: 0.1s; }
#postRegistration2FAInviteModal .d-flex.align-items-start:nth-child(2) { animation-delay: 0.2s; }

@keyframes slideInUp {
    from {
        opacity: 0;
        transform: translateY(20px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

/* Steps animation */
#postRegistration2FAInviteModal .bg-primary,
#postRegistration2FAInviteModal .bg-success {
    animation: bounceIn 0.8s ease-out;
    animation-fill-mode: both;
}

#postRegistration2FAInviteModal .col-4:nth-child(1) > div > div { animation-delay: 0.3s; }
#postRegistration2FAInviteModal .col-4:nth-child(2) > div > div { animation-delay: 0.4s; }
#postRegistration2FAInviteModal .col-4:nth-child(3) > div > div { animation-delay: 0.5s; }

@keyframes bounceIn {
    0% {
        opacity: 0;
        transform: scale(0.3);
    }
    50% {
        opacity: 1;
        transform: scale(1.05);
    }
    70% {
        transform: scale(0.9);
    }
    100% {
        opacity: 1;
        transform: scale(1);
    }
}
	 </style>
	
	
    <script>
        //เมื่อต้องการดู console log คุณเพียงแค่เข้าเว็บด้วย URL ที่มีพารามิเตอร์ debug_dump=true
        //https://example.com/register?debug_dump=true
        function getUrlParam(name) {
            var results = new RegExp('[\?&]' + name + '=([^&#]*)').exec(window.location.search);
            return results ? decodeURIComponent(results[1]) : null;
        }

        var debug = getUrlParam('debug_dump') === 'true';
        var originalConsole = {
            log: console.log,
            info: console.info,
            warn: console.warn,
            error: console.error,
            debug: console.debug
        };

        if (!debug) {
            console.log = function () { };
            console.info = function () { };
            console.warn = function () { };
            console.error = function () { };
            console.debug = function () { };
        }

        window.enableConsole = function () {
            console.log = originalConsole.log;
            console.info = originalConsole.info;
            console.warn = originalConsole.warn;
            console.error = originalConsole.error;
            console.debug = originalConsole.debug;
            console.log("Console logging enabled");
        };

        window.disableConsole = function () {
            console.log = function () { };
            console.info = function () { };
            console.warn = function () { };
            console.error = function () { };
            console.debug = function () { };
            originalConsole.log("Console logging disabled");
        };
    </script>

    <!-- 🔧 แก้ไข: ปรับปรุงการตั้งค่า base_url -->
    <script>
        // วิธีที่ 1: ตั้งค่า base_url หลายแบบ
        <?php 
        $base_url = base_url();
        if (empty($base_url)) {
            $base_url = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]" . str_replace(basename($_SERVER['SCRIPT_NAME']), "", $_SERVER['SCRIPT_NAME']);
        }
        ?>
        
        window.base_url = '<?php echo rtrim($base_url, '/'); ?>/';
        window.site_url = '<?php echo site_url(); ?>/';
        window.RECAPTCHA_KEY = '<?php echo get_config_value("recaptcha"); ?>';
        
        // Debug base_url
        console.log('Base URL set to:', window.base_url);
        console.log('Site URL set to:', window.site_url);
        
        // Fallback หาก base_url ยังเป็น undefined
        if (!window.base_url || window.base_url === 'undefined/' || window.base_url === '/') {
            window.base_url = window.location.origin + '/';
            console.log('Fallback base_url:', window.base_url);
        }
    </script>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="<?php echo base_url("docs/logo.png"); ?>" type="image/x-icon">
    <title><?php echo get_config_value('fname'); ?> - สมัครสมาชิก</title>

    <!-- Fonts & Icons -->
    <link href='https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap' rel='stylesheet'>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <!-- CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- reCAPTCHA -->
    <script src="https://www.google.com/recaptcha/api.js?render=<?php echo get_config_value('recaptcha'); ?>"></script>

    <?php $this->load->view('asset/public_register'); ?>
</head>

<body>
	
	<div class="text-center pages-head">
    <span class="font-pages-head">สมัครสมาชิกใช้งานระบบ e-Service ของประชาชน</span>
</div>
</div>
<img src="<?php echo base_url('docs/welcome-btm-light-other.png'); ?>">
	
    <!-- Background Overlay -->
    <div class="bg-overlay"></div>

    <!-- Modern Floating Particles -->
    <div class="floating-particles">
        <?php for ($i = 1; $i <= 20; $i++): ?>
            <div class="particle"></div>
        <?php endfor; ?>
    </div>

    <div class="container" style="margin-top: -200px;">
        <div class="register-container">
            <div class="register-header">
                <img src="<?php echo base_url("docs/logo.png"); ?>" alt="โลโก้" class="register-logo">
                <h1 class="register-title"><?php echo get_config_value('fname'); ?></h1>
                <p class="register-subtitle">สมัครสมาชิกเพื่อใช้บริการ e-Service</p>
            </div>

            <!-- Register Card -->
            <div class="register-card">
                <h2 class="form-title">
                    <i class="fas fa-user-plus"></i>
                    สมัครสมาชิกใช้งานระบบ e-Service ของประชาชน
                </h2>

                <!-- 🆕 Error Display Area -->
                <div id="validation-errors" class="alert alert-danger" style="display: none;">
                    <h6><i class="fas fa-exclamation-triangle"></i> กรุณาแก้ไขข้อผิดพลาดต่อไปนี้:</h6>
                    <ul id="error-list"></ul>
                </div>

                <form id="registerForm" action="<?php echo site_url('Auth_public_mem/register'); ?>" method="post"
                    class="form-horizontal" enctype="multipart/form-data">

                    <!-- ข้อมูลบัญชี -->
                    <div class="form-section">
                        <div class="section-header">
                            <h5><i class="fas fa-user-circle"></i>ข้อมูลบัญชี</h5>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label class="form-label">อีเมล <span class="required-star">*</span></label>
                                    <div class="input-wrapper email-check-wrapper">
                                        <input type="email" name="mp_email" id="mp_email" class="input-field" required
                                            placeholder="example@youremail.com"
                                            value="<?php echo set_value('mp_email'); ?>">
                                        <i class="fas fa-envelope input-icon"></i>
                                        <!-- 🆕 Email Check Button -->
                                        <button type="button" id="check-email-btn" class="check-email-btn" 
                                                onclick="checkEmailAvailability()" disabled>
                                            <i class="fas fa-search"></i>
                                            <span class="btn-text">ตรวจสอบ</span>
                                        </button>
                                    </div>
                                    <small class="form-text">ใช้อีเมลนี้ในการเข้าสู่ระบบ กด "ตรวจสอบ" ก่อนทุกครั้งเพื่อเป็นการยืนยันอีเมล</small>
                                    
                                    <!-- 🆕 Email Check Status -->
                                    <div id="email-check-status" style="display: none;">
                                        <small id="email-status-text" class="form-text"></small>
                                    </div>
                                    
                                    <!-- 🆕 Check Counter Display -->
                                    <div id="email-check-counter" style="display: none;">
                                        <small class="text-muted">
                                            <i class="fas fa-clock"></i> 
                                            ตรวจสอบแล้ว <span id="check-count">0</span>/5 ครั้ง
                                        </small>
                                    </div>
                                    
                                    <div class="invalid-feedback"></div>
                                    <span class="error-feedback"><?= form_error('mp_email'); ?></span>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <div class="form-group">
                                    <label class="form-label">รหัสผ่าน <span class="required-star">*</span></label>
                                    <div class="input-wrapper">
                                        <input type="password" name="mp_password" id="mp_password" class="input-field" 
                                               required placeholder="รหัสผ่านของคุณ" autocomplete="new-password"
                                               value="<?php echo set_value('mp_password'); ?>">
                                        <i class="fas fa-lock input-icon"></i>
                                        <button type="button" class="password-toggle" onclick="togglePassword('mp_password')">
                                            <i class="fas fa-eye"></i>
                                        </button>
                                    </div>
                                    <small class="form-text">รหัสผ่านต้องมีอย่างน้อย 6 ตัวอักษร</small>
                                    <div class="invalid-feedback"></div>
                                    <span class="error-feedback"><?= form_error('mp_password'); ?></span>
                                </div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <div class="form-group">
                                    <label class="form-label">ยืนยันรหัสผ่าน <span class="required-star">*</span></label>
                                    <div class="input-wrapper">
                                        <input type="password" name="confirmp_password" id="confirmp_password" 
                                               class="input-field" required placeholder="ยืนยันรหัสผ่าน" 
                                               autocomplete="new-password">
                                        <i class="fas fa-lock input-icon"></i>
                                        <button type="button" class="password-toggle" onclick="togglePassword('confirmp_password')">
                                            <i class="fas fa-eye"></i>
                                        </button>
                                    </div>
                                    <div class="invalid-feedback"></div>
                                    <span class="error-feedback"><?= form_error('confirmp_password'); ?></span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- ข้อมูลส่วนตัว -->
                    <div class="form-section">
                        <div class="section-header">
                            <h5><i class="fas fa-address-card"></i>ข้อมูลส่วนตัว</h5>
                        </div>
                        <div class="row">
                            <div class="col-md-3 mb-3">
                                <div class="form-group">
                                    <label class="form-label">คำนำหน้า <span class="required-star">*</span></label>
                                    <div class="form-select-wrapper">
                                        <select name="mp_prefix" id="mp_prefix" class="form-select" required>
                                            <option value="" disabled selected>เลือก...</option>
                                            <option value="นาย" <?= set_select('mp_prefix', 'นาย'); ?>>นาย</option>
                                            <option value="นาง" <?= set_select('mp_prefix', 'นาง'); ?>>นาง</option>
                                            <option value="นางสาว" <?= set_select('mp_prefix', 'นางสาว'); ?>>นางสาว</option>
                                        </select>
                                        <i class="fas fa-user-tag form-select-icon"></i>
                                    </div>
                                    <div class="invalid-feedback"></div>
                                    <span class="error-feedback"><?= form_error('mp_prefix'); ?></span>
                                </div>
                            </div>
                            <div class="col-md-4.5 mb-3">
                                <div class="form-group">
                                    <label class="form-label">ชื่อจริง <span class="required-star">*</span></label>
                                    <div class="input-wrapper">
                                        <input type="text" name="mp_fname" id="mp_fname" class="input-field" required
                                            placeholder="กรอกชื่อจริง" value="<?php echo set_value('mp_fname'); ?>">
                                        <i class="fas fa-user input-icon"></i>
                                    </div>
                                    <div class="invalid-feedback"></div>
                                    <span class="error-feedback"><?= form_error('mp_fname'); ?></span>
                                </div>
                            </div>
                            <div class="col-md-4.5 mb-3">
                                <div class="form-group">
                                    <label class="form-label">นามสกุล <span class="required-star">*</span></label>
                                    <div class="input-wrapper">
                                        <input type="text" name="mp_lname" id="mp_lname" class="input-field" required
                                            placeholder="กรอกนามสกุล" value="<?php echo set_value('mp_lname'); ?>">
                                        <i class="fas fa-user input-icon"></i>
                                    </div>
                                    <div class="invalid-feedback"></div>
                                    <span class="error-feedback"><?= form_error('mp_lname'); ?></span>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <div class="form-group">
                                    <label class="form-label">เลขประจำตัวประชาชน</label>
                                    <div class="input-wrapper id-check-wrapper">
                                        <input type="text" id="mp_number" name="mp_number" class="input-field"
                                            placeholder="กรอกเลขประจำตัวประชาชน 13 หลัก" 
                                            maxlength="13" value="<?php echo set_value('mp_number'); ?>">
                                        <i class="fas fa-id-card input-icon"></i>
                                        <!-- 🆕 ID Check Button -->
                                        <button type="button" id="check-id-btn" class="check-id-btn" 
                                                onclick="checkIdNumberAvailability()" disabled style="display: none;">
                                            <i class="fas fa-search"></i>
                                            <span class="btn-text">ตรวจสอบ</span>
                                        </button>
                                    </div>
                                    <small class="form-text">สามารถเว้นว่างไว้ก่อน แล้วเพิ่มทีหลังได้</small>
                                    
                                    <!-- 🆕 ID Check Status -->
                                    <div id="id-check-status" style="display: none;">
                                        <small id="id-status-text" class="form-text"></small>
                                    </div>
                                    
                                    <!-- 🆕 Check Counter Display for ID -->
                                    <div id="id-check-counter" style="display: none;">
                                        <small class="text-muted">
                                            <i class="fas fa-clock"></i> 
                                            ตรวจสอบแล้ว <span id="id-check-count">0</span>/3 ครั้ง
                                        </small>
                                    </div>
                                    
                                    <div class="invalid-feedback"></div>
                                    <span class="error-feedback"><?= form_error('mp_number'); ?></span>
                                </div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <div class="form-group">
                                    <label class="form-label">เบอร์โทรศัพท์ <span class="required-star">*</span></label>
                                    <div class="input-wrapper">
                                        <input type="tel" id="mp_phone" name="mp_phone" class="input-field" required
                                            placeholder="กรอกเบอร์โทรศัพท์ 10 หลัก" pattern="\d{10}"
                                            title="กรุณากรอกเบอร์มือถือเป็นตัวเลข 10 ตัว"
                                            value="<?php echo set_value('mp_phone'); ?>">
                                        <i class="fas fa-phone-alt input-icon"></i>
                                    </div>
                                    <div class="invalid-feedback"></div>
                                    <span class="error-feedback"><?= form_error('mp_phone'); ?></span>
                                </div>
                            </div>
                        </div>

                        <!-- Address Form Section -->
                        <div class="row mb-3">
                            <div class="col-md-12">
                                <div class="form-group">
									
									 <label class="form-label">บ้านเลขที่ ซอย ถนน หรือรายละเอียดเพิ่มเติม <span class="required-star">*</span></label>
									 <!-- ที่อยู่ของผู้ใช้ (บังคับกรอก) -->
                                    <div class="row mb-2">
                                        <div class="col-md-12">
                                            <div class="input-wrapper">
                                                <input type="text" id="mp_address_field" name="mp_address" 
                                                       class="input-field" required
                                                       placeholder="กรอกที่อยู่ (บ้านเลขที่ ซอย ถนน หมู่บ้าน) *"
                                                       value="<?php echo set_value('mp_address'); ?>">
                                                <i class="fas fa-map-marker-alt input-icon"></i>
                                            </div>
                                            <small class="form-text">บังคับกรอก: บ้านเลขที่ ซอย ถนน หรือรายละเอียดเพิ่มเติม</small>
                                            <div class="invalid-feedback"></div>
                                            <span class="error-feedback"><?= form_error('mp_address'); ?></span>
                                        </div>
                                    </div>
									
									
                                    <label class="form-label">รหัสไปรษณีย์ <span class="required-star">*</span></label>

                                    <!-- รหัสไปรษณีย์ -->
                                    <div class="row mb-2">
                                        <div class="col-md-6">
                                            <div class="input-wrapper">
                                                <input type="text" id="zipcode_field" class="input-field"
                                                    placeholder="กรอกรหัสไปรษณีย์ 5 หลัก" maxlength="5"
                                                    pattern="[0-9]{5}">
                                                <i class="fas fa-mail-bulk input-icon"></i>
                                            </div>
                                            <small class="form-text">กรอกรหัสไปรษณีย์เพื่อเติมข้อมูลอัตโนมัติ</small>
                                            <!-- Loading & Error indicators -->
                                            <div id="zipcode_loading" class="text-center mt-1" style="display: none;">
                                                <small class="text-primary">
                                                    <i class="fas fa-spinner fa-spin"></i> กำลังค้นหา...
                                                </small>
                                            </div>
                                            <div id="zipcode_error" class="mt-1" style="display: none;">
                                                <small class="text-danger"></small>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- จังหวัด และ อำเภอ -->
                                    <div class="row mb-2">
                                        <div class="col-md-6">
                                            <div class="input-wrapper">
                                                <input type="text" id="province_field" class="input-field"
                                                    placeholder="จังหวัด" readonly>
                                                <i class="fas fa-map input-icon"></i>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="input-wrapper">
                                                <select id="amphoe_field" class="input-field" disabled>
                                                    <option value="">เลือกอำเภอ</option>
                                                </select>
                                                <i class="fas fa-city input-icon"></i>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- ตำบล -->
                                    <div class="row mb-2">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="form-label">ตำบล <span class="required-star">*</span></label>
                                                <div class="input-wrapper">
                                                    <select id="district_field" class="input-field" disabled required>
                                                        <option value="">เลือกตำบล</option>
                                                    </select>
                                                    <i class="fas fa-home input-icon"></i>
                                                </div>
                                                <small class="form-text">กรุณาเลือกตำบลที่อยู่</small>
                                                <div class="invalid-feedback"></div>
                                                <span class="error-feedback" id="district_error"></span>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- 🆕 Hidden fields สำหรับส่งข้อมูลแยกย่อย -->
                                    <input type="hidden" name="province" id="province_hidden" value="<?php echo set_value('province'); ?>">
                                    <input type="hidden" name="amphoe" id="amphoe_hidden" value="<?php echo set_value('amphoe'); ?>">
                                    <input type="hidden" name="district" id="district_hidden" value="<?php echo set_value('district'); ?>">
                                    <input type="hidden" name="zipcode" id="zipcode_hidden" value="<?php echo set_value('zipcode'); ?>">

                                    <div class="invalid-feedback"></div>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-12 mb-3">
                                <div class="form-group">
                                    <label class="form-label">รูปภาพโปรไฟล์</label>

                                    <!-- Avatar Selection -->
                                    <div class="avatar-selection mb-3">
                                        <p class="avatar-label">เลือก Avatar ที่ต้องการ:</p>
                                        <div class="avatar-grid">
                                            <!-- Avatar 1 - ผู้ชายใส่สูท -->
                                            <div class="avatar-option">
                                                <input type="radio" id="avatar1" name="avatar_choice"
                                                    value="avatar1" class="avatar-radio" checked>
                                                <label for="avatar1" class="avatar-label">
                                                    <img src="https://cdn.pixabay.com/photo/2016/08/20/05/38/avatar-1606916_960_720.png"
                                                        alt="Avatar ผู้ชาย" class="avatar-img">
                                                </label>
                                            </div>
                                            <!-- Avatar 2 - ผู้หญิงทำงาน -->
                                            <div class="avatar-option">
                                                <input type="radio" id="avatar2" name="avatar_choice"
                                                    value="avatar2" class="avatar-radio">
                                                <label for="avatar2" class="avatar-label">
                                                    <img src="https://static.vecteezy.com/system/resources/thumbnails/002/002/257/small/beautiful-woman-avatar-character-icon-free-vector.jpg"
                                                        alt="Avatar ผู้หญิง" class="avatar-img">
                                                </label>
                                            </div>
                                            <!-- Avatar 3 - ผู้ชายวัยกลางคน -->
                                            <div class="avatar-option">
                                                <input type="radio" id="avatar3" name="avatar_choice"
                                                    value="avatar3" class="avatar-radio">
                                                <label for="avatar3" class="avatar-label">
                                                    <img src="https://cdn.pixabay.com/photo/2016/04/01/11/25/avatar-1300331_960_720.png"
                                                        alt="Avatar ผู้ชายวัยกลางคน" class="avatar-img">
                                                </label>
                                            </div>
                                            <!-- Avatar 4 - ผู้หญิงผมยาว -->
                                            <div class="avatar-option">
                                                <input type="radio" id="avatar4" name="avatar_choice"
                                                    value="avatar4" class="avatar-radio">
                                                <label for="avatar4" class="avatar-label">
                                                    <img src="https://static.vecteezy.com/system/resources/thumbnails/002/002/297/small/beautiful-woman-avatar-character-icon-free-vector.jpg"
                                                        alt="Avatar ผู้หญิงผมยาว" class="avatar-img">
                                                </label>
                                            </div>
                                            <!-- Avatar 5 - ผู้ชายวัยรุ่น -->
                                            <div class="avatar-option">
                                                <input type="radio" id="avatar5" name="avatar_choice"
                                                    value="avatar5" class="avatar-radio">
                                                <label for="avatar5" class="avatar-label">
                                                    <img src="https://cdn.pixabay.com/photo/2014/04/03/10/32/businessman-310819_960_720.png"
                                                        alt="Avatar ผู้ชายวัยรุ่น" class="avatar-img">
                                                </label>
                                            </div>
                                            <!-- Avatar 6 - ผู้หญิงทำงาน -->
                                            <div class="avatar-option">
                                                <input type="radio" id="avatar6" name="avatar_choice"
                                                    value="avatar6" class="avatar-radio">
                                                <label for="avatar6" class="avatar-label">
                                                    <img src="https://cdn3.iconfinder.com/data/icons/business-avatar-1/512/7_avatar-512.png"
                                                        alt="Avatar ผู้หญิงทำงาน" class="avatar-img">
                                                </label>
                                            </div>
                                            <!-- Avatar 7 - ผู้ชายใส่แว่น -->
                                            <div class="avatar-option">
                                                <input type="radio" id="avatar7" name="avatar_choice"
                                                    value="avatar7" class="avatar-radio">
                                                <label for="avatar7" class="avatar-label">
                                                    <img src="https://cdn.pixabay.com/photo/2016/12/13/16/17/dancer-1904467_960_720.png"
                                                        alt="Avatar ผู้ชายใส่แว่น" class="avatar-img">
                                                </label>
                                            </div>
                                            <!-- Avatar 8 - ผู้หญิงใส่แว่น -->
                                            <div class="avatar-option">
                                                <input type="radio" id="avatar8" name="avatar_choice"
                                                    value="avatar8" class="avatar-radio">
                                                <label for="avatar8" class="avatar-label">
                                                    <img src="https://cdn.pixabay.com/photo/2017/01/31/19/07/avatar-2026510_960_720.png"
                                                        alt="Avatar ผู้หญิงใส่แว่น" class="avatar-img">
                                                </label>
                                            </div>
                                        </div>

                                        <!-- Upload Option -->
                                        <div class="upload-option">
                                            <p class="avatar-label">หรือ อัพโหลดรูปภาพโปรไฟล์ของคุณ:</p>
                                            <div class="file-upload-wrapper">
                                                <input type="file" name="mp_img" class="file-upload-input"
                                                    accept=".jpg, .jpeg, .png">
                                                <i class="fas fa-image file-upload-icon"></i>
                                            </div>
                                            <small class="form-text">รองรับไฟล์รูปภาพ JPG, JPEG, PNG ขนาดไม่เกิน 2MB</small>
                                            <span class="error-feedback"><?= form_error('mp_img'); ?></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row mt-4">
                        <div class="col-md-6 mb-ภ">
                            <a href="<?php echo site_url('User'); ?>" class="login-link">
                                <i class="fas fa-arrow-left"></i>
                                มีบัญชีอยู่แล้ว? เข้าสู่ระบบที่นี่
                            </a>
                        </div>
                        <div class="col-md-6 mb-3 text-end">
                            <button type="submit" class="register-btn" data-action="submit" data-callback="onSubmit"
                                data-sitekey="<?php echo get_config_value('recaptcha'); ?>">
                                <i class="fas fa-user-plus"></i>
                                สมัครสมาชิก
                            </button>
                        </div>
                    </div>
                </form>
            </div>

            <div class="footer-text">
                <p>© <?php echo date('Y'); ?> <a href="https://www.assystem.co.th" target="_blank">บริษัท
                        <span class="as-highlight">เอเอส</span> ซิสเต็ม จำกัด</a> สงวนลิขสิทธิ์</p>
            </div>
        </div>
    </div>
	
	
	
	<!-- Modal เชิญชวนให้เปิดใช้งาน 2FA หลังสมัครสมาชิกสำเร็จ -->
<div class="modal fade" id="postRegistration2FAInviteModal" tabindex="-1" aria-labelledby="postRegistration2FAInviteModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header bg-gradient text-white" style="background: linear-gradient(135deg, #28a745 0%, #20c997 100%);">
                <h5 class="modal-title" id="postRegistration2FAInviteModalLabel">
                    <i class="bi bi-shield-plus"></i> ยินดีต้อนรับ! เพิ่มความปลอดภัยให้บัญชีใหม่ของคุณ
                </h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <!-- Congratulations Section -->
                <div class="text-center mb-4">
                    <div class="d-inline-flex align-items-center justify-content-center bg-success rounded-circle mb-3" style="width: 80px; height: 80px;">
                        <i class="bi bi-check-circle-fill text-white" style="font-size: 2.5rem;"></i>
                    </div>
                    <h4 class="text-success mb-2">สมัครสมาชิกสำเร็จ!</h4>
                    <p class="text-muted">ขณะนี้บัญชีของคุณพร้อมใช้งานแล้ว</p>
                </div>

                <!-- 2FA Invitation -->
                <div class="alert alert-info border-0" style="background: linear-gradient(135deg, #e3f2fd 0%, #f0f8ff 100%);">
                    <div class="d-flex align-items-center mb-3">
                        <i class="bi bi-shield-exclamation text-primary me-3" style="font-size: 2rem;"></i>
                        <div>
                            <h5 class="mb-1 text-primary">แนะนำ: เปิดใช้งานการยืนยันตัวตนแบบ 2 ขั้นตอน</h5>
                            <p class="mb-0">เพิ่มความปลอดภัยระดับสูงให้กับบัญชีใหม่ของคุณทันที</p>
                        </div>
                    </div>
                </div>

                <!-- Benefits Grid -->
                <div class="row mb-4">
                    <div class="col-md-6">
                        <div class="d-flex align-items-start mb-3">
                            <div class="flex-shrink-0">
                                <div class="bg-success rounded-circle p-2">
                                    <i class="bi bi-shield-check text-white"></i>
                                </div>
                            </div>
                            <div class="ms-3">
                                <h6 class="mb-1">ปกป้องจากการถูกแฮค</h6>
                                <small class="text-muted">แม้รหัสผ่านรั่วไหล ก็ไม่สามารถเข้าถึงบัญชีได้</small>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="d-flex align-items-start mb-3">
                            <div class="flex-shrink-0">
                                <div class="bg-primary rounded-circle p-2">
                                    <i class="bi bi-phone text-white"></i>
                                </div>
                            </div>
                            <div class="ms-3">
                                <h6 class="mb-1">ใช้งานง่าย</h6>
                                <small class="text-muted">สแกน QR Code ครั้งเดียว ใช้งานได้ทันที</small>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row mb-4">
                    <div class="col-md-6">
                        <div class="d-flex align-items-start mb-3">
                            <div class="flex-shrink-0">
                                <div class="bg-info rounded-circle p-2">
                                    <i class="bi bi-wifi-off text-white"></i>
                                </div>
                            </div>
                            <div class="ms-3">
                                <h6 class="mb-1">ทำงานแบบออฟไลน์</h6>
                                <small class="text-muted">ไม่ต้องการอินเทอร์เน็ต สร้างรหัสในมือถือ</small>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="d-flex align-items-start mb-3">
                            <div class="flex-shrink-0">
                                <div class="bg-warning rounded-circle p-2">
                                    <i class="bi bi-clock text-white"></i>
                                </div>
                            </div>
                            <div class="ms-3">
                                <h6 class="mb-1">ตั้งค่าใน 2 นาที</h6>
                                <small class="text-muted">ติดตั้งแอป → สแกน QR → เสร็จสิ้น</small>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Security Stats -->
                <div class="bg-light rounded p-3 mb-4 text-center">
                    <div class="row">
                        <div class="col-4">
                            <h4 class="text-danger mb-1">99.9%</h4>
                            <small class="text-muted">ลดความเสี่ยงถูกแฮค</small>
                        </div>
                        <div class="col-4">
                            <h4 class="text-success mb-1">30 วิ</h4>
                            <small class="text-muted">รหัสเปลี่ยนทุก</small>
                        </div>
                        <div class="col-4">
                            <h4 class="text-primary mb-1">2 นาที</h4>
                            <small class="text-muted">เวลาตั้งค่า</small>
                        </div>
                    </div>
                </div>

                <!-- Simple Steps -->
                <div class="bg-light rounded p-3 mb-4">
                    <h6 class="mb-3 text-center"><i class="bi bi-list-ol me-2"></i>3 ขั้นตอนง่ายๆ</h6>
                    <div class="row text-center">
                        <div class="col-4">
                            <div class="position-relative mb-2">
                                <div class="bg-primary text-white rounded-circle mx-auto d-flex align-items-center justify-content-center" style="width: 40px; height: 40px;">1</div>
                            </div>
                            <small>ติดตั้งแอป<br>Google Authenticator</small>
                        </div>
                        <div class="col-4">
                            <div class="position-relative mb-2">
                                <div class="bg-primary text-white rounded-circle mx-auto d-flex align-items-center justify-content-center" style="width: 40px; height: 40px;">2</div>
                            </div>
                            <small>สแกน<br>QR Code</small>
                        </div>
                        <div class="col-4">
                            <div class="position-relative mb-2">
                                <div class="bg-success text-white rounded-circle mx-auto d-flex align-items-center justify-content-center" style="width: 40px; height: 40px;">3</div>
                            </div>
                            <small>ยืนยันรหัส<br>เสร็จสิ้น!</small>
                        </div>
                    </div>
                </div>

                <!-- Action Buttons Section -->
                <div class="text-center">
                    <p class="mb-3"><strong>แนะนำให้คุณเปิดใช้งานการยืนยันตัวตนแบบ 2 ขั้นตอน เพิ่มความปลอดภัยระดับสูงให้กับบัญชีใหม่ของคุณ</strong></p>
                    
                    <div class="d-grid gap-2 d-md-flex justify-content-md-center">
                        <button type="button" class="btn btn-success btn-lg me-md-3" onclick="skipRegistration2FA()" style="min-width: 200px;">
                            <i class="bi bi-shield-plus me-2"></i>
                            เข้าหน้าล็อกอินเลย
                        </button>
                        
                    </div>
                    
                    <p class="mt-3 text-muted small">
                        <i class="bi bi-info-circle me-1"></i>
                        คุณสามารถเปิดใช้ได้ในหน้าโปรไฟล์
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>
	
	

    <!-- Scripts -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        $(document).ready(function () {
            // ==========================================
            // GLOBAL VARIABLES
            // ==========================================

            // API Base URL สำหรับดึงข้อมูลรหัสไปรษณีย์
            const API_BASE_URL = 'https://addr.assystem.co.th/index.php/zip_api';

            // Global Elements สำหรับฟอร์มที่อยู่
            let zipcodeField, provinceField, amphoeField, districtField;
            let currentAddressData = [];

            // Email Check Variables
            let emailCheckCount = parseInt(sessionStorage.getItem('emailCheckCount') || '0');
            const maxEmailChecks = 5;
            let isEmailChecked = false;
            let isEmailAvailable = false;

            // ID Number Check Variables
            let idCheckCount = parseInt(sessionStorage.getItem('idCheckCount') || '0');
            const maxIdChecks = 3;
            let isIdChecked = false;
            let isIdAvailable = false;

            // 2FA Setup Variables
            let current2FASecret = null;
            let currentStep = 1;

            // ==========================================
            // VALIDATION FUNCTIONS
            // ==========================================

            function showValidationErrors(errors) {
                const errorContainer = $('#validation-errors');
                const errorList = $('#error-list');
                
                if (errors.length > 0) {
                    errorList.empty();
                    errors.forEach(error => {
                        errorList.append(`<li>${error.message}</li>`);
                        
                        const field = $(`#${error.field}`);
                        field.addClass('is-invalid');
                        field.closest('.form-group').find('.invalid-feedback').text(error.message);
                    });
                    
                    errorContainer.show();
                    $('html, body').animate({
                        scrollTop: errorContainer.offset().top - 100
                    }, 500);
                } else {
                    errorContainer.hide();
                }
            }

            function clearValidationErrors() {
                $('#validation-errors').hide();
                $('.is-invalid').removeClass('is-invalid');
                $('.invalid-feedback').text('');
            }

            function validateForm() {
                const errors = [];

                // ตรวจสอบอีเมล
                const email = $('#mp_email').val().trim();
                if (!email) {
                    errors.push({ field: 'mp_email', message: 'กรุณากรอกอีเมล' });
                } else if (!isValidEmail(email)) {
                    errors.push({ field: 'mp_email', message: 'รูปแบบอีเมลไม่ถูกต้อง' });
                } else if (!isEmailChecked) {
                    errors.push({ field: 'mp_email', message: 'กรุณาตรวจสอบความพร้อมใช้งานของอีเมลก่อน' });
                } else if (!isEmailAvailable) {
                    errors.push({ field: 'mp_email', message: 'อีเมลนี้ถูกใช้งานแล้ว กรุณาใช้อีเมลอื่น' });
                }

                // ตรวจสอบรหัสผ่าน
                const password = $('#mp_password').val();
                const confirmPassword = $('#confirmp_password').val();
                
                if (!password) {
                    errors.push({ field: 'mp_password', message: 'กรุณากรอกรหัสผ่าน' });
                } else if (password.length < 6) {
                    errors.push({ field: 'mp_password', message: 'รหัสผ่านต้องมีอย่างน้อย 6 ตัวอักษร' });
                }

                if (!confirmPassword) {
                    errors.push({ field: 'confirmp_password', message: 'กรุณายืนยันรหัสผ่าน' });
                } else if (password !== confirmPassword) {
                    errors.push({ field: 'confirmp_password', message: 'รหัสผ่านไม่ตรงกัน' });
                }

                // ตรวจสอบคำนำหน้า
                if (!$('#mp_prefix').val()) {
                    errors.push({ field: 'mp_prefix', message: 'กรุณาเลือกคำนำหน้า' });
                }

                // ตรวจสอบชื่อ
                const fname = $('#mp_fname').val().trim();
                if (!fname) {
                    errors.push({ field: 'mp_fname', message: 'กรุณากรอกชื่อจริง' });
                } else if (fname.length < 2) {
                    errors.push({ field: 'mp_fname', message: 'ชื่อต้องมีอย่างน้อย 2 ตัวอักษร' });
                }

                // ตรวจสอบนามสกุล
                const lname = $('#mp_lname').val().trim();
                if (!lname) {
                    errors.push({ field: 'mp_lname', message: 'กรุณากรอกนามสกุล' });
                } else if (lname.length < 2) {
                    errors.push({ field: 'mp_lname', message: 'นามสกุลต้องมีอย่างน้อย 2 ตัวอักษร' });
                }

                // ตรวจสอบเลขบัตรประชาชน (ถ้ากรอก)
                const idNumber = $('#mp_number').val().trim();
                if (idNumber) {
                    if (idNumber.length !== 13 || !/^\d{13}$/.test(idNumber)) {
                        errors.push({ field: 'mp_number', message: 'เลขบัตรประชาชนต้องเป็นตัวเลข 13 หลัก' });
                    } else if (!isIdChecked) {
                        errors.push({ field: 'mp_number', message: 'กรุณาตรวจสอบเลขบัตรประชาชนก่อน' });
                    } else if (!isIdAvailable) {
                        errors.push({ field: 'mp_number', message: 'เลขบัตรประชาชนนี้ถูกใช้งานแล้ว' });
                    }
                }

                // ตรวจสอบเบอร์โทรศัพท์
                const phone = $('#mp_phone').val().trim();
                if (!phone) {
                    errors.push({ field: 'mp_phone', message: 'กรุณากรอกเบอร์โทรศัพท์' });
                } else if (phone.length !== 10 || !/^\d{10}$/.test(phone)) {
                    errors.push({ field: 'mp_phone', message: 'เบอร์โทรศัพท์ต้องเป็นตัวเลข 10 หลัก' });
                }

                // ตรวจสอบที่อยู่
                const mpAddress = $('#mp_address_field').val().trim();
                if (!mpAddress) {
                    errors.push({ field: 'mp_address_field', message: 'กรุณากรอกที่อยู่' });
                } else if (mpAddress.length < 3) {
                    errors.push({ field: 'mp_address_field', message: 'ที่อยู่ต้องมีอย่างน้อย 3 ตัวอักษร' });
                }

                // ตรวจสอบข้อมูลที่อยู่แยกย่อย
                const province = $('#province_hidden').val().trim();
                const district = $('#district_hidden').val().trim();
                
                if (!province || !district) {
                    errors.push({ field: 'district_field', message: 'กรุณาเลือกข้อมูลที่อยู่ให้ครบถ้วน (ตำบล, อำเภอ, จังหวัด)' });
                }

                return errors;
            }

            function isValidEmail(email) {
                const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
                return emailRegex.test(email);
            }

            // ==========================================
            // EMAIL & ID CHECK FUNCTIONS
            // ==========================================

            window.checkEmailAvailability = async function() {
                const email = $('#mp_email').val().trim();
                const checkBtn = $('#check-email-btn');
                const statusDiv = $('#email-check-status');
                const statusText = $('#email-status-text');
                const counterDiv = $('#email-check-counter');
                const countSpan = $('#check-count');

                if (!email) {
                    showEmailStatus('กรุณากรอกอีเมล', 'error');
                    return;
                }

                if (!isValidEmail(email)) {
                    showEmailStatus('รูปแบบอีเมลไม่ถูกต้อง', 'error');
                    return;
                }

                if (emailCheckCount >= maxEmailChecks) {
                    showEmailStatus('คุณได้ตรวจสอบอีเมลครบ 5 ครั้งแล้ว กรุณาลองใหม่ในเซสชันใหม่', 'error');
                    checkBtn.prop('disabled', true);
                    return;
                }

                checkBtn.prop('disabled', true);
                checkBtn.html('<i class="fas fa-spinner fa-spin"></i> กำลังตรวจสอบ...');
                
                try {
                    const possibleUrls = [
                        `${window.location.protocol}//${window.location.host}/index.php/Auth_public_mem/check_email`,
                        `${window.location.protocol}//${window.location.host}/Auth_public_mem/check_email`,
                        window.base_url ? window.base_url + 'Auth_public_mem/check_email' : null,
                        window.site_url ? window.site_url + 'Auth_public_mem/check_email' : null,
                        './Auth_public_mem/check_email'
                    ].filter(url => url !== null);

                    let response;
                    let urlIndex = 0;
                    
                    while (urlIndex < possibleUrls.length) {
                        try {
                            const checkEmailUrl = possibleUrls[urlIndex];
                            
                            response = await fetch(checkEmailUrl, {
                                method: 'POST',
                                headers: {
                                    'Content-Type': 'application/x-www-form-urlencoded',
                                    'X-Requested-With': 'XMLHttpRequest'
                                },
                                body: 'email=' + encodeURIComponent(email)
                            });

                            if (response.ok) {
                                break;
                            } else {
                                urlIndex++;
                            }
                            
                        } catch (fetchError) {
                            urlIndex++;
                            if (urlIndex >= possibleUrls.length) {
                                throw new Error('All URL attempts failed');
                            }
                        }
                    }

                    if (!response.ok) {
                        throw new Error(`HTTP error! status: ${response.status}`);
                    }

                    const result = await response.json();
                    
                    emailCheckCount++;
                    sessionStorage.setItem('emailCheckCount', emailCheckCount.toString());
                    
                    countSpan.text(emailCheckCount);
                    counterDiv.show();

                    if (result.status === 'success') {
                        if (result.available) {
                            showEmailStatus('✅ อีเมลนี้สามารถใช้งานได้', 'success');
                            isEmailAvailable = true;
                            isEmailChecked = true;
                        } else {
                            showEmailStatus('❌ อีเมลนี้ถูกใช้งานแล้ว กรุณาใช้อีเมลอื่น', 'error');
                            isEmailAvailable = false;
                            isEmailChecked = true;
                        }
                    } else {
                        showEmailStatus('เกิดข้อผิดพลาดในการตรวจสอบ', 'error');
                        isEmailChecked = false;
                    }

                } catch (error) {
                    console.error('Email check error:', error);
                    showEmailStatus('เกิดข้อผิดพลาดในการเชื่อมต่อ', 'error');
                    isEmailChecked = false;
                } finally {
                    checkBtn.html('<i class="fas fa-search"></i> <span class="btn-text">ตรวจสอบ</span>');
                    
                    if (emailCheckCount < maxEmailChecks) {
                        setTimeout(() => {
                            checkBtn.prop('disabled', false);
                        }, 1000);
                    }
                }
            };

            window.checkIdNumberAvailability = async function() {
    const idNumber = $('#mp_number').val().trim();
    const checkBtn = $('#check-id-btn');
    const statusDiv = $('#id-check-status');
    const statusText = $('#id-status-text');
    const counterDiv = $('#id-check-counter');
    const countSpan = $('#id-check-count');

    if (!idNumber) {
        showIdStatus('กรุณากรอกเลขประจำตัวประชาชน', 'error');
        return;
    }

    if (!isValidIdNumber(idNumber)) {
        showIdStatus('รูปแบบเลขประจำตัวประชาชนไม่ถูกต้อง', 'error');
        return;
    }

    if (idCheckCount >= maxIdChecks) {
        showIdStatus(`คุณได้ตรวจสอบเลขประจำตัวประชาชนครบ ${maxIdChecks} ครั้งแล้ว`, 'error');
        checkBtn.prop('disabled', true);
        return;
    }

    checkBtn.prop('disabled', true);
    checkBtn.html('<i class="fas fa-spinner fa-spin"></i> กำลังตรวจสอบ...');
    
    try {
        // 🆕 ปรับปรุง URL paths ให้ครอบคลุมมากขึ้น
        const possibleUrls = [
            window.base_url + 'Auth_public_mem/check_id_number',
            window.site_url + 'Auth_public_mem/check_id_number', 
            `${window.location.origin}/index.php/Auth_public_mem/check_id_number`,
            `${window.location.origin}/Auth_public_mem/check_id_number`,
            './Auth_public_mem/check_id_number',
            '../Auth_public_mem/check_id_number'
        ].filter(url => url && url !== 'undefined' && url !== 'null');

        console.log('🔍 Trying URLs for ID check:', possibleUrls); // Debug log

        let response;
        let urlIndex = 0;
        let lastError;
        
        while (urlIndex < possibleUrls.length) {
            try {
                const checkUrl = possibleUrls[urlIndex];
                console.log(`📡 Attempting URL ${urlIndex + 1}: ${checkUrl}`); // Debug log
                
                response = await fetch(checkUrl, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/x-www-form-urlencoded',
                        'X-Requested-With': 'XMLHttpRequest'
                    },
                    body: 'id_number=' + encodeURIComponent(idNumber),
                    timeout: 10000 // 10 second timeout
                });

                if (response.ok) {
                    console.log(`✅ Success with URL ${urlIndex + 1}`);
                    break;
                } else {
                    console.log(`❌ Failed with URL ${urlIndex + 1}: HTTP ${response.status}`);
                    lastError = `HTTP ${response.status}`;
                    urlIndex++;
                }
                
            } catch (fetchError) {
                console.log(`❌ Network error with URL ${urlIndex + 1}:`, fetchError.message);
                lastError = fetchError.message;
                urlIndex++;
            }
        }

        if (!response || !response.ok) {
            throw new Error(`All URL attempts failed. Last error: ${lastError}`);
        }

        const result = await response.json();
        console.log('📦 ID check response:', result); // Debug log
        
        idCheckCount++;
        sessionStorage.setItem('idCheckCount', idCheckCount.toString());
        
        countSpan.text(idCheckCount);
        counterDiv.show();

        if (result.status === 'success') {
            if (result.available) {
                showIdStatus('✅ เลขประจำตัวประชาชนนี้สามารถใช้งานได้', 'success');
                isIdAvailable = true;
                isIdChecked = true;
            } else {
                showIdStatus('❌ เลขประจำตัวประชาชนนี้ถูกใช้งานแล้ว', 'error');
                isIdAvailable = false;
                isIdChecked = true;
            }
        } else {
            showIdStatus(result.message || 'เกิดข้อผิดพลาดในการตรวจสอบ', 'error');
            isIdChecked = false;
        }

    } catch (error) {
        console.error('❌ ID check error:', error);
        showIdStatus('เกิดข้อผิดพลาดในการเชื่อมต่อ กรุณาลองใหม่อีกครั้ง', 'error');
        isIdChecked = false;
    } finally {
        checkBtn.html('<i class="fas fa-search"></i> <span class="btn-text">ตรวจสอบ</span>');
        
        if (idCheckCount < maxIdChecks) {
            setTimeout(() => {
                checkBtn.prop('disabled', false);
            }, 1000);
        }
    }
};

            function showIdStatus(message, type) {
                const statusDiv = $('#id-check-status');
                const statusText = $('#id-status-text');
                
                statusText.removeClass('text-success text-danger text-warning');
                
                if (type === 'success') {
                    statusText.addClass('text-success');
                } else if (type === 'error') {
                    statusText.addClass('text-danger');
                } else {
                    statusText.addClass('text-warning');
                }
                
                statusText.text(message);
                statusDiv.show();
            }

            function isValidIdNumber(idNumber) {
                return /^\d{13}$/.test(idNumber);
            }

            function showEmailStatus(message, type) {
                const statusDiv = $('#email-check-status');
                const statusText = $('#email-status-text');
                
                statusText.removeClass('text-success text-danger text-warning');
                
                if (type === 'success') {
                    statusText.addClass('text-success');
                } else if (type === 'error') {
                    statusText.addClass('text-danger');
                } else {
                    statusText.addClass('text-warning');
                }
                
                statusText.text(message);
                statusDiv.show();
            }

            window.togglePassword = function(fieldId) {
                const field = document.getElementById(fieldId);
                const icon = field.parentNode.querySelector('.password-toggle i');
                
                if (field.type === 'password') {
                    field.type = 'text';
                    icon.classList.remove('fa-eye');
                    icon.classList.add('fa-eye-slash');
                } else {
                    field.type = 'password';
                    icon.classList.remove('fa-eye-slash');
                    icon.classList.add('fa-eye');
                }
            };

            // ==========================================
            // INITIALIZE ELEMENTS
            // ==========================================
            
            function initializeElements() {
                zipcodeField = $('#zipcode_field');
                provinceField = $('#province_field');
                amphoeField = $('#amphoe_field');
                districtField = $('#district_field');
            }

            initializeElements();

            // ==========================================
            // FORM SUBMIT HANDLING
            // ==========================================

            $('#registerForm').on('submit', function (e) {
                e.preventDefault();
                
                clearValidationErrors();
                updateAddressData();
                
                const errors = validateForm();
                
                if (errors.length > 0) {
                    showValidationErrorsModal(errors);
                    return false;
                }

                // จัดการ Avatar
                var avatarSelected = $('input[name="avatar_choice"]:checked').length > 0;
                if (avatarSelected) {
                    var avatarValue = $('input[name="avatar_choice"]:checked').val();
                    var avatarNumber = avatarValue.replace('avatar', '');
                    var avatarUrl = 'https://i.pravatar.cc/150?img=' + avatarNumber;

                    if ($('#avatar_url').length === 0) {
                        $('<input>').attr({
                            type: 'hidden',
                            id: 'avatar_url',
                            name: 'avatar_url',
                            value: avatarUrl
                        }).appendTo('#registerForm');
                    } else {
                        $('#avatar_url').val(avatarUrl);
                    }
                }

                showRegistrationLoading(true);
                submitFormWithAjax();
            });

            function submitFormWithAjax() {
                const formData = new FormData($('#registerForm')[0]);
                
                $.ajax({
                    url: $('#registerForm').attr('action'),
                    type: 'POST',
                    data: formData,
                    processData: false,
                    contentType: false,
                    success: function(response) {
                        console.log('🎉 Registration successful:', response);
                        showRegistrationLoading(false);
                        
                        if (typeof response === 'string') {
                            if (response.includes('success') || response.includes('สมัครสมาชิกสำเร็จ')) {
                                console.log('✅ Registration detected as successful');
                                handleRegistrationSuccess();
                            } else if (response.includes('<!DOCTYPE') || response.includes('<html')) {
                                console.log('🔄 Detected HTML response, assuming success');
                                handleRegistrationSuccess();
                            } else {
                                console.log('❓ Unknown HTML response');
                                showErrorModal('เกิดข้อผิดพลาดที่ไม่คาดคิด กรุณาลองใหม่อีกครั้ง');
                            }
                        } else if (response && typeof response === 'object') {
                            if (response.status === 'success') {
                                console.log('✅ JSON response indicates success');
                                handleRegistrationSuccess();
                            } else {
                                console.log('❌ JSON response indicates failure:', response);
                                showErrorModal(response.message || 'เกิดข้อผิดพลาดในการสมัครสมาชิก');
                            }
                        } else {
                            console.log('❓ Unknown response type:', typeof response);
                            handleRegistrationSuccess();
                        }
                    },
                    error: function(xhr, status, error) {
                        console.error('❌ Registration failed:', {xhr, status, error});
                        showRegistrationLoading(false);
                        
                        let errorMessage = 'เกิดข้อผิดพลาดในการสมัครสมาชิก';
                        
                        try {
                            const response = JSON.parse(xhr.responseText);
                            if (response.message) {
                                errorMessage = response.message;
                            }
                        } catch (e) {
                            if (xhr.responseText && xhr.responseText.includes('validation')) {
                                errorMessage = 'ข้อมูลที่กรอกไม่ถูกต้อง กรุณาตรวจสอบและลองใหม่อีกครั้ง';
                            } else if (xhr.status === 404) {
                                errorMessage = 'ไม่พบหน้าสมัครสมาชิก กรุณาติดต่อผู้ดูแลระบบ';
                            } else if (xhr.status === 500) {
                                errorMessage = 'เกิดข้อผิดพลาดในเซิร์ฟเวอร์ กรุณาลองใหม่อีกครั้ง';
                            }
                        }
                        
                        showErrorModal(errorMessage);
                    }
                });
            }

            function handleRegistrationSuccess() {
                console.log('🎉 Handling registration success...');
                
                setTimeout(() => {
                    console.log('🔒 Showing 2FA invitation modal directly...');
                    showPostRegistration2FAInvite();
                }, 500);
            }

            function showValidationErrorsModal(errors) {
                let errorListHtml = '';
                errors.forEach(error => {
                    errorListHtml += `<li>${error.message}</li>`;
                    
                    const field = $(`#${error.field}`);
                    field.addClass('is-invalid');
                    field.closest('.form-group').find('.invalid-feedback').text(error.message);
                });
                
                const modal = $(`
                    <div class="modal fade" id="errorModal" tabindex="-1" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content error-modal">
                                <div class="modal-header border-0">
                                    <h5 class="modal-title text-danger">
                                        <i class="fas fa-exclamation-circle me-2"></i>
                                        กรุณาแก้ไขข้อผิดพลาด
                                    </h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                </div>
                                <div class="modal-body">
                                    <div class="alert alert-danger border-0">
                                        <h6 class="alert-heading">
                                            <i class="fas fa-exclamation-triangle me-2"></i>
                                            พบข้อผิดพลาดในการกรอกข้อมูล:
                                        </h6>
                                        <ul class="mb-0 mt-3">
                                            ${errorListHtml}
                                        </ul>
                                    </div>
                                    <div class="text-muted small">
                                        <i class="fas fa-info-circle me-1"></i>
                                        ข้อมูลที่คุณกรอกไว้จะไม่หายไป กรุณาแก้ไขตามรายการข้างบนแล้วลองใหม่อีกครั้ง
                                    </div>
                                </div>
                                <div class="modal-footer border-0">
                                    <button type="button" class="btn btn-primary" data-bs-dismiss="modal" id="fix-errors-btn">
                                        <i class="fas fa-edit me-2"></i>
                                        แก้ไขข้อมูล
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                `);
                
                $('#errorModal').remove();
                $('body').append(modal);
                $('#errorModal').modal('show');
                
                $('#errorModal').on('hidden.bs.modal', function() {
                    const firstErrorField = $('.is-invalid').first();
                    if (firstErrorField.length) {
                        $('html, body').animate({
                            scrollTop: firstErrorField.offset().top - 100
                        }, 500, function() {
                            firstErrorField.focus();
                        });
                    }
                    $(this).remove();
                });
                
                $('#fix-errors-btn').on('click', function() {
                    $('#errorModal').modal('hide');
                });
            }

            function showErrorModal(message, title = 'เกิดข้อผิดพลาด') {
                const modal = $(`
                    <div class="modal fade" id="generalErrorModal" tabindex="-1" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content error-modal">
                                <div class="modal-header border-0">
                                    <h5 class="modal-title text-danger">
                                        <i class="fas fa-exclamation-circle me-2"></i>
                                        ${title}
                                    </h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                </div>
                                <div class="modal-body text-center py-4">
                                    <div class="error-icon mb-3">
                                        <i class="fas fa-times-circle text-danger" style="font-size: 3rem;"></i>
                                    </div>
                                    <p class="mb-0">${message}</p>
                                    <div class="text-muted small mt-3">
                                        <i class="fas fa-info-circle me-1"></i>
                                        ข้อมูลที่คุณกรอกไว้ยังคงอยู่ กรุณาลองใหม่อีกครั้ง
                                    </div>
                                </div>
                                <div class="modal-footer border-0 justify-content-center">
                                    <button type="button" class="btn btn-primary" data-bs-dismiss="modal">
                                        <i class="fas fa-redo me-2"></i>
                                        ลองใหม่อีกครั้ง
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                `);
                
                $('#generalErrorModal').remove();
                $('body').append(modal);
                $('#generalErrorModal').modal('show');
                
                $('#generalErrorModal').on('hidden.bs.modal', function() {
                    $(this).remove();
                });
            }

            function showRegistrationLoading(show) {
                const submitBtn = $('.register-btn');
                
                if (show) {
                    submitBtn.prop('disabled', true);
                    submitBtn.html(`
                        <div class="d-flex align-items-center justify-content-center">
                            <div class="spinner-border spinner-border-sm me-2" role="status">
                                <span class="visually-hidden">Loading...</span>
                            </div>
                            กำลังสมัครสมาชิก...
                        </div>
                    `);
                } else {
                    submitBtn.prop('disabled', false);
                    submitBtn.html(`
                        <i class="fas fa-user-plus"></i>
                        สมัครสมาชิก
                    `);
                }
            }

            // ==========================================
            // REAL-TIME VALIDATION
            // ==========================================

            $('#mp_email').on('blur', function() {
                const email = $(this).val().trim();
                if (email && !isValidEmail(email)) {
                    $(this).addClass('is-invalid');
                    $(this).closest('.form-group').find('.invalid-feedback').text('รูปแบบอีเมลไม่ถูกต้อง');
                } else {
                    $(this).removeClass('is-invalid');
                    $(this).closest('.form-group').find('.invalid-feedback').text('');
                }
            });

            $('#mp_email').on('input', function() {
                const email = $(this).val().trim();
                const checkBtn = $('#check-email-btn');
                
                isEmailChecked = false;
                isEmailAvailable = false;
                $('#email-check-status').hide();
                
                if (email && isValidEmail(email) && emailCheckCount < maxEmailChecks) {
                    checkBtn.prop('disabled', false);
                } else {
                    checkBtn.prop('disabled', true);
                }
            });

            if (emailCheckCount > 0) {
                $('#check-count').text(emailCheckCount);
                $('#email-check-counter').show();
                
                if (emailCheckCount >= maxEmailChecks) {
                    $('#check-email-btn').prop('disabled', true);
                    showEmailStatus('คุณได้ตรวจสอบอีเมลครบ 5 ครั้งแล้ว', 'error');
                }
            }

            $('#mp_password, #confirmp_password').on('input', function() {
                const password = $('#mp_password').val();
                const confirmPassword = $('#confirmp_password').val();
                
                if (password && password.length < 6) {
                    $('#mp_password').addClass('is-invalid');
                    $('#mp_password').closest('.form-group').find('.invalid-feedback').text('รหัสผ่านต้องมีอย่างน้อย 6 ตัวอักษร');
                } else {
                    $('#mp_password').removeClass('is-invalid');
                    $('#mp_password').closest('.form-group').find('.invalid-feedback').text('');
                }
                
                if (confirmPassword && password !== confirmPassword) {
                    $('#confirmp_password').addClass('is-invalid');
                    $('#confirmp_password').closest('.form-group').find('.invalid-feedback').text('รหัสผ่านไม่ตรงกัน');
                } else {
                    $('#confirmp_password').removeClass('is-invalid');
                    $('#confirmp_password').closest('.form-group').find('.invalid-feedback').text('');
                }
            });

            $('#mp_number').on('input', function () {
                var value = $(this).val();
                var cleanedValue = value.replace(/\D/g, '');
                
                if (cleanedValue.length > 13) {
                    cleanedValue = cleanedValue.slice(0, 13);
                }
                
                $(this).val(cleanedValue);
                
                isIdChecked = false;
                isIdAvailable = false;
                $('#id-check-status').hide();
                
                const checkBtn = $('#check-id-btn');
                
                if (cleanedValue.length === 0) {
                    checkBtn.hide();
                    $(this).removeClass('is-invalid');
                    $(this).closest('.form-group').find('.invalid-feedback').text('');
                } else if (cleanedValue.length !== 13) {
                    checkBtn.hide();
                    $(this).addClass('is-invalid');
                    $(this).closest('.form-group').find('.invalid-feedback').text('เลขบัตรประชาชนต้องมี 13 หลัก');
                } else {
                    $(this).removeClass('is-invalid');
                    $(this).closest('.form-group').find('.invalid-feedback').text('');
                    
                    if (idCheckCount < maxIdChecks) {
                        checkBtn.show().prop('disabled', false);
                    } else {
                        checkBtn.show().prop('disabled', true);
                    }
                }
            });

            if (idCheckCount > 0) {
                $('#id-check-count').text(idCheckCount);
                $('#id-check-counter').show();
                
                if (idCheckCount >= maxIdChecks) {
                    $('#check-id-btn').prop('disabled', true);
                    showIdStatus('คุณได้ตรวจสอบเลขประจำตัวประชาชนครบ 3 ครั้งแล้ว', 'error');
                }
            }

            $('#mp_phone').on('input', function () {
                var value = $(this).val();
                var cleanedValue = value.replace(/\D/g, '');
                if (cleanedValue.length > 10) {
                    cleanedValue = cleanedValue.slice(0, 10);
                }
                $(this).val(cleanedValue);
                
                if (cleanedValue.length > 0 && cleanedValue.length !== 10) {
                    $(this).addClass('is-invalid');
                    $(this).closest('.form-group').find('.invalid-feedback').text('เบอร์โทรศัพท์ต้องมี 10 หลัก');
                } else {
                    $(this).removeClass('is-invalid');
                    $(this).closest('.form-group').find('.invalid-feedback').text('');
                }
            });

            // ตรวจสอบการสมัครสมาชิกสำเร็จผ่าน PHP
            <?php if ($this->session->flashdata('save_success')): ?>
                console.log('🎉 PHP indicates registration success');
                handleRegistrationSuccess();
            <?php endif; ?>

            // จัดการการเลือก Avatar
            $('.avatar-radio').change(function () {
                $('input[name="mp_img"]').val('');
            });

            $('input[name="mp_img"]').change(function () {
                if ($(this).val() !== '') {
                    $('.avatar-radio').prop('checked', false);
                }
            });

            createFloatingParticles();

            // ADDRESS FORM INITIALIZATION
            if (zipcodeField.length > 0) {
                initializeAddressForm();
            }

            function initializeAddressForm() {
                console.log('Initializing address form...');

                loadAllProvinces();

                zipcodeField.on('keypress', function (e) {
                    if (!/[0-9]/.test(e.key) && e.key !== 'Backspace' && e.key !== 'Delete' && e.key !== 'Tab') {
                        e.preventDefault();
                    }
                });

                zipcodeField.on('input', function () {
                    const zipcode = $(this).val().trim();
                    console.log('Zipcode input changed:', zipcode);

                    if (zipcode.length === 0) {
                        console.log('Zipcode is empty, loading all provinces...');
                        resetToProvinceSelection();
                    } else if (zipcode.length === 5 && /^\d{5}$/.test(zipcode)) {
                        console.log('Zipcode is complete, searching...');
                        searchByZipcode(zipcode);
                    } else {
                        clearDependentAddressFields();
                    }
                });

                $(document).on('change', '#province_field', function () {
                    const selectedProvinceCode = $(this).val();
                    console.log('Province changed to:', selectedProvinceCode);

                    clearDependentFields('province');

                    if (selectedProvinceCode) {
                        loadAmphoesByProvince(selectedProvinceCode);
                    }

                    updateAddressData();
                });

                $(document).on('change', '#amphoe_field', function () {
                    const selectedAmphoeCode = $(this).val();
                    console.log('Amphoe changed to:', selectedAmphoeCode);

                    if (selectedAmphoeCode) {
                        const currentZipcode = zipcodeField.val().trim();

                        if (currentZipcode.length === 5) {
                            filterDistrictsByAmphoe(selectedAmphoeCode);
                        } else {
                            loadDistrictsByAmphoe(selectedAmphoeCode);
                        }
                    } else {
                        districtField.html('<option value="">เลือกตำบล</option>').prop('disabled', true);
                    }

                    updateAddressData();
                });

                $(document).on('change', '#district_field', function () {
                    const selectedDistrictCode = $(this).val();
                    console.log('District changed to:', selectedDistrictCode);

                    if (selectedDistrictCode) {
                        const selectedDistrict = currentAddressData.find(item =>
                            (item.district_code || item.code) === selectedDistrictCode
                        );

                        if (selectedDistrict && selectedDistrict.zipcode) {
                            console.log('📮 Found zipcode:', selectedDistrict.zipcode);
                            zipcodeField.val(selectedDistrict.zipcode);
                        } else {
                            console.log('⚠️ No zipcode found for district:', selectedDistrictCode);
                            const currentZipcode = zipcodeField.val().trim();
                            if (!currentZipcode) {
                                loadZipcodeByDistrict(selectedDistrictCode);
                            }
                        }
                    } else {
                        const currentZipcode = zipcodeField.val().trim();
                        if (currentZipcode.length !== 5) {
                            zipcodeField.val('');
                        }
                    }

                    updateAddressData();
                });

                $('#mp_address_field').on('input', function () {
                    clearTimeout(this.updateTimeout);
                    this.updateTimeout = setTimeout(() => {
                        updateAddressData();
                    }, 300);
                });

                setTimeout(() => {
                    updateAddressData();
                }, 500);
            }

            // API FUNCTIONS
            async function loadAllProvinces() {
                console.log('Loading all provinces...');

                const provinces = [
                    { code: '10', name: 'กรุงเทพมหานคร' },
                    { code: '11', name: 'สมุทรปราการ' },
                    { code: '12', name: 'นนทบุรี' },
                    { code: '13', name: 'ปทุมธานี' },
                    { code: '14', name: 'พระนครศรีอยุธยา' },
                    { code: '15', name: 'อ่างทอง' },
                    { code: '16', name: 'ลพบุรี' },
                    { code: '17', name: 'สิงห์บุรี' },
                    { code: '18', name: 'ชัยนาท' },
                    { code: '19', name: 'สระบุรี' },
                    { code: '20', name: 'ชลบุรี' },
                    { code: '21', name: 'ระยอง' },
                    { code: '22', name: 'จันทบุรี' },
                    { code: '23', name: 'ตราด' },
                    { code: '24', name: 'ฉะเชิงเทรา' },
                    { code: '25', name: 'ปราจีนบุรี' },
                    { code: '26', name: 'นครนายก' },
                    { code: '27', name: 'สระแก้ว' },
                    { code: '30', name: 'นครราชสีมา' },
                    { code: '31', name: 'บุรีรัมย์' },
                    { code: '32', name: 'สุรินทร์' },
                    { code: '33', name: 'ศีสะเกษ' },
                    { code: '34', name: 'อุบลราชธานี' },
                    { code: '35', name: 'ยโสธร' },
                    { code: '36', name: 'ชัยภูมิ' },
                    { code: '37', name: 'อำนาจเจริญ' },
                    { code: '38', name: 'บึงกาฬ' },
                    { code: '39', name: 'หนองบัวลำภู' },
                    { code: '40', name: 'ขอนแก่น' },
                    { code: '41', name: 'อุดรธานี' },
                    { code: '42', name: 'เลย' },
                    { code: '43', name: 'หนองคาย' },
                    { code: '44', name: 'มหาสารคาม' },
                    { code: '45', name: 'ร้อยเอ็ด' },
                    { code: '46', name: 'กาฬสินธุ์' },
                    { code: '47', name: 'สกลนคร' },
                    { code: '48', name: 'นครพนม' },
                    { code: '49', name: 'มุกดาหาร' },
                    { code: '50', name: 'เชียงใหม่' },
                    { code: '51', name: 'ลำพูน' },
                    { code: '52', name: 'ลำปาง' },
                    { code: '53', name: 'อุตรดิตถ์' },
                    { code: '54', name: 'แพร่' },
                    { code: '55', name: 'น่าน' },
                    { code: '56', name: 'พะเยา' },
                    { code: '57', name: 'เชียงราย' },
                    { code: '58', name: 'แม่ฮ่องสอน' },
                    { code: '60', name: 'นครสวรรค์' },
                    { code: '61', name: 'อุทัยธานี' },
                    { code: '62', name: 'กำแพงเพชร' },
                    { code: '63', name: 'ตาก' },
                    { code: '64', name: 'สุโขทัย' },
                    { code: '65', name: 'พิษณุโลก' },
                    { code: '66', name: 'พิจิตร' },
                    { code: '67', name: 'เพชรบูรณ์' },
                    { code: '70', name: 'ราชบุรี' },
                    { code: '71', name: 'กาญจนบุรี' },
                    { code: '72', name: 'สุพรรณบุรี' },
                    { code: '73', name: 'นครปฐม' },
                    { code: '74', name: 'สมุทรสาคร' },
                    { code: '75', name: 'สมุทรสงคราม' },
                    { code: '76', name: 'เพชรบุรี' },
                    { code: '77', name: 'ประจวบคีรีขันธ์' },
                    { code: '80', name: 'นครศรีธรรมราช' },
                    { code: '81', name: 'กระบี่' },
                    { code: '82', name: 'พังงา' },
                    { code: '83', name: 'ภูเก็ต' },
                    { code: '84', name: 'สุราษฎร์ธานี' },
                    { code: '85', name: 'ระนอง' },
                    { code: '86', name: 'ชุมพร' },
                    { code: '90', name: 'สงขลา' },
                    { code: '91', name: 'สตูล' },
                    { code: '92', name: 'ตรัง' },
                    { code: '93', name: 'พัทลุง' },
                    { code: '94', name: 'ปัตตานี' },
                    { code: '95', name: 'ยะลา' },
                    { code: '96', name: 'นราธิวาส' }
                ];

                populateProvinceDropdown(provinces);
            }

            async function searchByZipcode(zipcode) {
                console.log('🔍 Searching by zipcode:', zipcode);
                showAddressLoading(true);

                try {
                    const response = await fetch(`${API_BASE_URL}/address/${zipcode}`);
                    const data = await response.json();

                    console.log('📦 API Response for zipcode:', data);

                    if (data.status === 'success' && data.data.length > 0) {
                        const dataWithZipcode = data.data.map(item => ({
                            ...item,
                            zipcode: zipcode,
                            searched_zipcode: zipcode
                        }));

                        console.log('✅ Enhanced data with zipcode:', dataWithZipcode);

                        currentAddressData = dataWithZipcode;
                        populateFieldsFromZipcode(dataWithZipcode);
                        updateAddressData();
                    } else {
                        showAddressError('ไม่พบข้อมูลสำหรับรหัสไปรษณีย์นี้');
                        resetToProvinceSelection();
                    }
                } catch (error) {
                    console.error('❌ Address API Error:', error);
                    showAddressError('เกิดข้อผิดพลาดในการค้นหาข้อมูล');
                    resetToProvinceSelection();
                } finally {
                    showAddressLoading(false);
                }
            }

            async function loadAmphoesByProvince(provinceCode) {
                console.log('Loading amphoes for province:', provinceCode);
                showAddressLoading(true, 'province');

                try {
                    const response = await fetch(`${API_BASE_URL}/amphoes/${provinceCode}`);
                    const data = await response.json();

                    if (data.status === 'success' && data.data && data.data.length > 0) {
                        const processedAmphoes = data.data.map(item => ({
                            code: item.amphoe_code || item.code || item.id,
                            name: item.amphoe_name || item.name || item.name_th || 'ไม่ระบุชื่อ',
                            name_en: item.amphoe_name_en || item.name_en || ''
                        }));

                        console.log('Processed amphoes:', processedAmphoes);
                        populateAmphoeDropdown(processedAmphoes);
                        amphoeField.prop('disabled', false);
                    } else {
                        console.error('Invalid amphoe response:', data);
                        amphoeField.html('<option value="">ไม่พบข้อมูลอำเภอ</option>').prop('disabled', true);
                    }
                } catch (error) {
                    console.error('Amphoe API Error:', error);
                    amphoeField.html('<option value="">ไม่สามารถโหลดข้อมูลอำเภอได้</option>').prop('disabled', true);
                } finally {
                    showAddressLoading(false);
                }
            }

            async function loadDistrictsByAmphoe(amphoeCode) {
                console.log('Loading districts for amphoe:', amphoeCode);
                showAddressLoading(true, 'amphoe');

                try {
                    const response = await fetch(`${API_BASE_URL}/districts/${amphoeCode}`);
                    const data = await response.json();

                    if (data.status === 'success' && data.data && data.data.length > 0) {
                        const processedDistricts = data.data.map(item => ({
                            code: item.district_code || item.code || item.id,
                            name: item.district_name || item.name || item.name_th || 'ไม่ระบุชื่อ',
                            name_en: item.district_name_en || item.name_en || '',
                            amphoe_code: item.amphoe_code || amphoeCode
                        }));

                        console.log('Processed districts:', processedDistricts);
                        populateDistrictDropdown(processedDistricts);
                        districtField.prop('disabled', false);
                    } else {
                        console.error('Invalid district response:', data);
                        districtField.html('<option value="">ไม่พบข้อมูลตำบล</option>').prop('disabled', true);
                    }
                } catch (error) {
                    console.error('District API Error:', error);
                    districtField.html('<option value="">ไม่สามารถโหลดข้อมูลตำบลได้</option>').prop('disabled', true);
                } finally {
                    showAddressLoading(false);
                }
            }

            async function loadZipcodeByDistrict(districtCode) {
                console.log('📡 Loading zipcode for district:', districtCode);

                try {
                    const response = await fetch(`${API_BASE_URL}/district/${districtCode}`);

                    if (!response.ok) {
                        throw new Error(`HTTP error! status: ${response.status}`);
                    }

                    const data = await response.json();
                    console.log('📦 District API Response:', data);

                    if (data.status === 'success' && data.data && data.data.length > 0) {
                        const districtData = data.data[0];
                        const zipcode = districtData.zipcode;

                        console.log('📮 Found zipcode from API:', zipcode);

                        if (zipcode) {
                            zipcodeField.val(zipcode);
                            console.log('✅ Zipcode field updated:', zipcodeField.val());
                        } else {
                            console.log('⚠️ No zipcode in district data');
                        }

                        updateAddressData();
                    } else {
                        console.log('❌ Invalid district API response:', data);
                    }
                } catch (error) {
                    console.error('❌ Zipcode API Error:', error);
                    console.error('❌ Error details:', error.message);
                }
            }

            // DATA POPULATION FUNCTIONS
            function populateFieldsFromZipcode(data) {
                if (data.length === 0) return;

                console.log('📝 Populating fields from zipcode data:', data);

                const searchedZipcode = zipcodeField.val().trim();

                const zipcodeGroups = data.reduce((groups, item) => {
                    const itemZipcode = item.zipcode || item.searched_zipcode || searchedZipcode;
                    if (!groups[itemZipcode]) {
                        groups[itemZipcode] = [];
                    }
                    groups[itemZipcode].push(item);
                    return groups;
                }, {});

                const relevantData = zipcodeGroups[searchedZipcode] || data;

                if (relevantData.length === 0) {
                    console.warn('⚠️ No data matches the searched zipcode');
                    showAddressError(`ไม่พบข้อมูลสำหรับรหัสไปรษณีย์ ${searchedZipcode}`);
                    return;
                }

                const firstItem = relevantData[0];
                convertToProvinceInput(firstItem.province_name);

                const amphoes = getUniqueAmphoes(relevantData);
                populateAmphoeDropdown(amphoes);

                const districts = relevantData.map(item => ({
                    code: item.district_code,
                    name: item.district_name,
                    name_en: item.district_name_en,
                    amphoe_code: item.amphoe_code,
                    zipcode: item.zipcode || item.searched_zipcode || searchedZipcode
                }));
                populateDistrictDropdown(districts);

                amphoeField.prop('disabled', false);
                districtField.prop('disabled', false);

                if (amphoes.length === 1) {
                    console.log('🎯 Auto-selecting single amphoe:', amphoes[0].name);
                    amphoeField.val(amphoes[0].code);
                    setTimeout(() => {
                        filterDistrictsByAmphoe(amphoes[0].code);

                        const visibleDistricts = districtField.find('option:visible').not(':first');
                        if (visibleDistricts.length === 1) {
                            console.log('🎯 Auto-selecting single district:', visibleDistricts.text());
                            districtField.val(visibleDistricts.val());
                            updateAddressData();
                        }
                    }, 100);
                }

                currentAddressData = relevantData;
            }

            function populateProvinceDropdown(provinces) {
                console.log('Populating province dropdown with', provinces.length, 'provinces');

                if (!$('#province_field').is('select')) {
                    convertToProvinceSelect();
                }

                provinceField = $('#province_field');

                provinceField.html('<option value="">เลือกจังหวัด</option>');

                provinces.forEach(province => {
                    if (province.code && province.name) {
                        provinceField.append(`<option value="${province.code}">${province.name}</option>`);
                    }
                });
            }

            function populateAmphoeDropdown(amphoes) {
                console.log('Populating amphoe dropdown with', amphoes.length, 'amphoes');

                amphoeField.html('<option value="">เลือกอำเภอ</option>');

                amphoes.forEach((amphoe, index) => {
                    console.log(`Amphoe ${index}:`, amphoe);

                    if (amphoe && amphoe.code && amphoe.name &&
                        amphoe.code !== 'undefined' && amphoe.name !== 'undefined') {
                        amphoeField.append(`<option value="${amphoe.code}">${amphoe.name}</option>`);
                    } else {
                        console.warn('Invalid amphoe data:', amphoe);
                    }
                });

                console.log('Amphoe dropdown populated successfully');
            }

            function populateDistrictDropdown(districts) {
                console.log('📝 Populating district dropdown with', districts.length, 'districts');

                districtField.html('<option value="">เลือกตำบล</option>');

                districts.forEach((district, index) => {
                    console.log(`District ${index}:`, {
                        code: district.code,
                        name: district.name,
                        amphoe_code: district.amphoe_code,
                        zipcode: district.zipcode
                    });

                    if (district && district.code && district.name &&
                        district.code !== 'undefined' && district.name !== 'undefined') {

                        districtField.append(`
                <option value="${district.code}" 
                        data-amphoe-code="${district.amphoe_code}"
                        data-zipcode="${district.zipcode || ''}">
                    ${district.name}
                </option>
            `);
                    } else {
                        console.warn('❌ Invalid district data:', district);
                    }
                });

                console.log('✅ District dropdown populated successfully');
            }

            function getUniqueAmphoes(data) {
                const uniqueAmphoes = [];
                const seenCodes = new Set();

                data.forEach(item => {
                    if (!seenCodes.has(item.amphoe_code)) {
                        seenCodes.add(item.amphoe_code);
                        uniqueAmphoes.push({
                            code: item.amphoe_code,
                            name: item.amphoe_name,
                            name_en: item.amphoe_name_en
                        });
                    }
                });

                return uniqueAmphoes;
            }

            function filterDistrictsByAmphoe(amphoeCode) {
                console.log('🔍 Filtering districts for amphoe:', amphoeCode);

                const searchedZipcode = zipcodeField.val().trim();
                const isZipcodeSearch = searchedZipcode.length === 5;

                let visibleCount = 0;

                districtField.find('option').each(function () {
                    const option = $(this);
                    const optionAmphoeCode = option.data('amphoe-code');
                    const optionZipcode = option.data('zipcode');

                    if (option.val() === '') {
                        option.show();
                        return;
                    }

                    const isAmphoeMatch = String(optionAmphoeCode) === String(amphoeCode);
                    const isZipcodeMatch = !isZipcodeSearch || String(optionZipcode) === String(searchedZipcode);

                    if (isAmphoeMatch && isZipcodeMatch) {
                        option.show();
                        visibleCount++;
                    } else {
                        option.hide();
                    }
                });

                console.log(`📊 Filtering result: ${visibleCount} districts visible`);

                const selectedDistrict = districtField.val();
                if (selectedDistrict) {
                    const selectedOption = districtField.find(`option[value="${selectedDistrict}"]`);
                    if (selectedOption.length && selectedOption.css('display') === 'none') {
                        console.log('🧹 Clearing invalid district selection');
                        districtField.val('');
                    }
                }

                updateAddressData();
            }

            // FIELD CONVERSION FUNCTIONS
            function convertToProvinceSelect() {
                if ($('#province_field').is('select')) return;

                console.log('Converting province to select...');
                const provinceWrapper = $('#province_field').parent();

                $('#province_field').remove();

                const selectHtml = `
      <select id="province_field" class="input-field">
        <option value="">เลือกจังหวัด</option>
      </select>
    `;

                provinceWrapper.append(selectHtml);
                provinceField = $('#province_field');
            }

            function convertToProvinceInput(value = '') {
                if ($('#province_field').is('input')) {
                    $('#province_field').val(value);
                    return;
                }

                console.log('Converting province to input...');
                const provinceWrapper = $('#province_field').parent();

                $('#province_field').remove();

                const inputHtml = `
      <input type="text" id="province_field" class="input-field" 
             placeholder="จังหวัด" readonly value="${value}">
    `;

                provinceWrapper.append(inputHtml);
                provinceField = $('#province_field');
            }

            // CLEAR FUNCTIONS
            function resetToProvinceSelection() {
                console.log('Resetting to province selection mode...');

                convertToProvinceSelect();
                loadAllProvinces();

                amphoeField.html('<option value="">เลือกอำเภอ</option>').prop('disabled', true);
                districtField.html('<option value="">เลือกตำบล</option>').prop('disabled', true);

                $('.address-error').remove();
                updateAddressData();
            }

            function clearDependentAddressFields() {
                console.log('Clearing dependent address fields...');

                if ($('#province_field').is('input')) {
                    $('#province_field').val('');
                }

                amphoeField.html('<option value="">เลือกอำเภอ</option>').prop('disabled', true);
                districtField.html('<option value="">เลือกตำบล</option>').prop('disabled', true);
                $('.address-error').remove();

                updateAddressData();
            }

            function clearDependentFields(fromLevel) {
                console.log('Clearing dependent fields from level:', fromLevel);

                switch (fromLevel) {
                    case 'zipcode':
                        if ($('#province_field').is('select')) {
                            $('#province_field').val('');
                        } else {
                            $('#province_field').val('');
                        }
                        amphoeField.html('<option value="">เลือกอำเภอ</option>').prop('disabled', true);
                        districtField.html('<option value="">เลือกตำบล</option>').prop('disabled', true);
                        break;
                    case 'province':
                        amphoeField.html('<option value="">เลือกอำเภอ</option>').prop('disabled', true);
                        districtField.html('<option value="">เลือกตำบล</option>').prop('disabled', true);
                        zipcodeField.val('');
                        break;
                    case 'amphoe':
                        districtField.html('<option value="">เลือกตำบล</option>').prop('disabled', true);
                        zipcodeField.val('');
                        break;
                    case 'district':
                        zipcodeField.val('');
                        break;
                }

                $('.address-error').remove();
                updateAddressData();
            }

            // ADDRESS MANAGEMENT
            window.updateAddressData = function () {
                if (!zipcodeField.length) return;

                const zipcode = zipcodeField.val();
                let province = '';

                const provinceElement = $('#province_field');
                if (provinceElement.is('select')) {
                    const selectedOption = provinceElement.find('option:selected');
                    province = selectedOption.text();
                    if (province === 'เลือกจังหวัด') province = '';
                } else {
                    province = provinceElement.val();
                }

                const amphoeSelected = amphoeField.find('option:selected');
                const amphoeText = amphoeSelected.text();

                const districtSelected = districtField.find('option:selected');
                const districtText = districtSelected.text();

                $('#province_hidden').val(province);
                $('#amphoe_hidden').val(amphoeText && amphoeText !== 'เลือกอำเภอ' ? amphoeText : '');
                $('#district_hidden').val(districtText && districtText !== 'เลือกตำบล' ? districtText : '');
                $('#zipcode_hidden').val(zipcode);

                console.log('Address data updated:', {
                    province: $('#province_hidden').val(),
                    amphoe: $('#amphoe_hidden').val(),
                    district: $('#district_hidden').val(),
                    zipcode: $('#zipcode_hidden').val()
                });
            };

            // UTILITY FUNCTIONS
            function showAddressLoading(show, context = 'zipcode') {
                if (show) {
                    $('.address-loading-icon').remove();
                    $('.loading-icon').remove();

                    const iconClass = `address-loading-icon-${context}`;
                    let targetField;

                    switch (context) {
                        case 'province':
                            targetField = $('#province_field');
                            break;
                        case 'amphoe':
                            targetField = amphoeField;
                            break;
                        case 'district':
                            targetField = districtField;
                            break;
                        default:
                            targetField = zipcodeField;
                    }

                    if (targetField.length) {
                        targetField.parent().append(`<i class="fas fa-spinner fa-spin ${iconClass} loading-icon"></i>`);
                        $(`.${iconClass}`).show();
                    }
                } else {
                    $('.address-loading-icon').remove();
                    $('.loading-icon').remove();
                    $('[class*="address-loading-icon"]').remove();
                    $('.fa-spinner').hide();
                }
            }

            function showAddressError(message) {
                $('.address-error').remove();
                zipcodeField.parent().append(`<small class="address-error text-danger form-text">${message}</small>`);

                setTimeout(() => {
                    $('.address-error').fadeOut();
                }, 5000);
            }

            // FLOATING PARTICLES
            function createFloatingParticles() {
                const particlesContainer = document.querySelector('.floating-particles');
                if (!particlesContainer) return;

                const numberOfParticles = 30;
                particlesContainer.innerHTML = '';

                for (let i = 0; i < numberOfParticles; i++) {
                    const particle = document.createElement('div');
                    particle.classList.add('particle');

                    const top = Math.random() * 100;
                    const left = Math.random() * 100;
                    const size = Math.random() * 6 + 2;
                    const duration = Math.random() * 20 + 15;
                    const opacity = Math.random() * 0.5 + 0.1;

                    particle.style.top = `${top}%`;
                    particle.style.left = `${left}%`;
                    particle.style.width = `${size}px`;
                    particle.style.height = `${size}px`;
                    particle.style.opacity = opacity;
                    particle.style.animationDuration = `${duration}s`;
                    particle.style.animationDelay = `${Math.random() * 10}s`;

                    particlesContainer.appendChild(particle);
                }
            }

            function onSubmit(token) {
                document.getElementById("registerForm").submit();
            }
        });

        // ==========================================
        // 🔥 GLOBAL FUNCTIONS สำหรับ 2FA MODALS (สำคัญมาก!)
        // ==========================================

        window.showPostRegistration2FAInvite = function() {
            console.log('🔒 showPostRegistration2FAInvite called');
            
            try {
                const modalElement = document.getElementById('postRegistration2FAInviteModal');
                if (modalElement) {
                    console.log('✅ 2FA modal element found, showing modal...');
                    
                    const modal = new bootstrap.Modal(modalElement, {
                        backdrop: 'static',
                        keyboard: false
                    });
                    
                    modal.show();
                    
                    console.log('✅ 2FA invitation modal shown successfully');
                } else {
                    console.error('❌ 2FA modal element not found!');
                    setTimeout(() => {
                        window.location.href = '<?php echo site_url("User"); ?>';
                    }, 1000);
                }
                
            } catch (error) {
                console.error('❌ Error showing 2FA invitation modal:', error);
                setTimeout(() => {
                    window.location.href = '<?php echo site_url("User"); ?>';
                }, 1000);
            }
        };

        window.startRegistration2FASetup = function() {
            console.log('🔒 startRegistration2FASetup called');
            
            try {
                const modalElement = document.getElementById('postRegistration2FAInviteModal');
                if (modalElement) {
                    const modal = bootstrap.Modal.getInstance(modalElement);
                    if (modal) {
                        modal.hide();
                    }
                }
                
                setTimeout(() => {
                    console.log('🚀 Starting 2FA setup directly...');
                    start2FASetupFlow();
                }, 500);
                
            } catch (error) {
                console.error('❌ Error in startRegistration2FASetup:', error);
                setTimeout(() => {
                    window.location.href = '<?php echo site_url("User"); ?>';
                }, 1000);
            }
        };

        window.skipRegistration2FA = function() {
            console.log('⏭️ skipRegistration2FA called');
            
            try {
                const modalElement = document.getElementById('postRegistration2FAInviteModal');
                if (modalElement) {
                    const modal = bootstrap.Modal.getInstance(modalElement);
                    if (modal) {
                        modal.hide();
                    }
                }
                
                setTimeout(() => {
                    window.location.href = '<?php echo site_url("User"); ?>';
                }, 500);
                
            } catch (error) {
                console.error('❌ Error in skipRegistration2FA:', error);
                window.location.href = '<?php echo site_url("User"); ?>';
            }
        };

        // ==========================================
        // 🔥 2FA SETUP FLOW FUNCTIONS
        // ==========================================

        window.start2FASetupFlow = function() {
            console.log('🔒 Starting 2FA setup flow...');
            
            const modalElement = document.getElementById('postRegistration2FAInviteModal');
            const modalContent = modalElement.querySelector('.modal-content');
            
            modalContent.innerHTML = `
                <div id="setup-step-1" class="2fa-setup-step">
                    <div class="modal-header bg-success text-white">
                        <h5 class="modal-title">
                            <i class="bi bi-1-circle"></i> ขั้นตอนที่ 1: ติดตั้งแอป Google Authenticator
                        </h5>
                        <button type="button" class="btn-close btn-close-white" onclick="skipRegistration2FA()"></button>
                    </div>
                    <div class="modal-body">
                        <div class="text-center mb-4">
                            <h6>ดาวน์โหลด Google Authenticator ฟรีจากร้านแอป</h6>
                            <p class="text-muted">เลือกระบบปฏิบัติการของคุณ</p>
                        </div>
                        
                        <div class="row text-center mb-4">
                            <div class="col-md-6 mb-3">
                                <div class="card h-100 shadow-sm">
                                    <div class="card-body">
                                        <i class="bi bi-apple" style="font-size: 3rem; color: #007aff;"></i>
                                        <h6 class="mt-3">iOS (iPhone/iPad)</h6>
                                        <a href="https://apps.apple.com/app/google-authenticator/id388497605" 
                                           target="_blank" class="btn btn-primary btn-sm">
                                            <i class="bi bi-download"></i> ดาวน์โหลด
                                        </a>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <div class="card h-100 shadow-sm">
                                    <div class="card-body">
                                        <i class="bi bi-google-play" style="font-size: 3rem; color: #34a853;"></i>
                                        <h6 class="mt-3">Android</h6>
                                        <a href="https://play.google.com/store/apps/details?id=com.google.android.apps.authenticator2" 
                                           target="_blank" class="btn btn-success btn-sm">
                                            <i class="bi bi-download"></i> ดาวน์โหลด
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <div class="alert alert-info">
                            <h6><i class="bi bi-info-circle"></i> วิธีการติดตั้ง:</h6>
                            <ol class="mb-0">
                                <li>คลิกลิงก์ตามระบบปฏิบัติการของคุณ</li>
                                <li>กดติดตั้งในร้านแอป</li>
                                <li>เปิดแอปหลังติดตั้งเสร็จ</li>
                            </ol>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-outline-secondary" onclick="skipRegistration2FA()">
                            <i class="bi bi-x-circle"></i> ข้ามไปก่อน
                        </button>
                        <button type="button" class="btn btn-success" onclick="go2FAStep(2)">
                            <i class="bi bi-check-circle"></i> ติดตั้งแล้ว ไปต่อ
                        </button>
                    </div>
                </div>
            `;
            
            console.log('✅ Changed to step 1');
        };

        window.go2FAStep = function(step) {
            console.log(`🔒 Going to 2FA step ${step}...`);
            
            const modalElement = document.getElementById('postRegistration2FAInviteModal');
            const modalContent = modalElement.querySelector('.modal-content');
            
            if (step === 2) {
                modalContent.innerHTML = `
                    <div id="setup-step-2" class="2fa-setup-step">
                        <div class="modal-header bg-primary text-white">
                            <h5 class="modal-title">
                                <i class="bi bi-2-circle"></i> ขั้นตอนที่ 2: สแกน QR Code
                            </h5>
                            <button type="button" class="btn-close btn-close-white" onclick="skipRegistration2FA()"></button>
                        </div>
                        <div class="modal-body">
                            <div class="text-center mb-3">
                                <div id="qr-code-container">
                                    <div class="text-center">
                                        <div class="spinner-border text-primary" role="status">
                                            <span class="visually-hidden">กำลังสร้าง QR Code...</span>
                                        </div>
                                        <p class="mt-2">กำลังสร้าง QR Code...</p>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="alert alert-info">
                                <h6><i class="bi bi-camera"></i> วิธีการสแกน:</h6>
                                <ol class="mb-0">
                                    <li>เปิดแอป Google Authenticator บนมือถือ</li>
                                    <li>แตะเครื่องหมาย <strong>+</strong> เพื่อเพิ่มบัญชี</li>
                                    <li>เลือก <strong>"สแกน QR Code"</strong></li>
                                    <li>ชี้กล้องไปที่ QR Code ด้านบน</li>
                                </ol>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-outline-secondary" onclick="go2FAStep(1)">
                                <i class="bi bi-arrow-left"></i> ย้อนกลับ
                            </button>
                            <button type="button" class="btn btn-primary" onclick="go2FAStep(3)">
                                <i class="bi bi-check-circle"></i> สแกนแล้ว ไปต่อ
                            </button>
                        </div>
                    </div>
                `;
                
                setTimeout(() => {
                    generate2FAQRCode();
                }, 500);
                
            } else if (step === 3) {
                modalContent.innerHTML = `
                    <div id="setup-step-3" class="2fa-setup-step">
                        <div class="modal-header bg-warning text-white">
                            <h5 class="modal-title">
                                <i class="bi bi-3-circle"></i> ขั้นตอนที่ 3: ยืนยันรหัส OTP
                            </h5>
                            <button type="button" class="btn-close btn-close-white" onclick="skipRegistration2FA()"></button>
                        </div>
                        <div class="modal-body">
                            <div class="alert alert-warning">
                                <h6><i class="bi bi-shield-check"></i> ขั้นตอนสุดท้าย!</h6>
                                <p class="mb-0">กรอกรหัส 6 หลักจากแอป Google Authenticator เพื่อยืนยันการตั้งค่า</p>
                            </div>
                            
                            <div class="row justify-content-center">
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label class="form-label text-center d-block">
                                            <strong>รหัส OTP (6 หลัก)</strong>
                                        </label>
                                        <input type="text" class="form-control form-control-lg text-center" 
                                               id="setup-otp-input" maxlength="6" pattern="\\d{6}" 
                                               placeholder="000000" autocomplete="off" 
                                               style="font-size: 1.5rem; letter-spacing: 0.3rem;">
                                        <small class="form-text text-muted text-center d-block mt-2">
                                            รหัสจะเปลี่ยนทุก 30 วินาที
                                        </small>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-outline-secondary" onclick="go2FAStep(2)">
                                <i class="bi bi-arrow-left"></i> ย้อนกลับ
                            </button>
                            <button type="button" class="btn btn-success" onclick="verify2FASetup()" id="verify-btn">
                                <i class="bi bi-shield-check"></i> ยืนยันและเปิดใช้งาน
                            </button>
                        </div>
                    </div>
                `;
                
                setTimeout(() => {
                    const otpInput = document.getElementById('setup-otp-input');
                    if (otpInput) {
                        otpInput.focus();
                        
                        otpInput.addEventListener('input', function(e) {
                            this.value = this.value.replace(/[^0-9]/g, '');
                            if (this.value.length > 6) {
                                this.value = this.value.substring(0, 6);
                            }
                        });
                        
                        otpInput.addEventListener('keypress', function(e) {
                            if (e.key === 'Enter' && this.value.length === 6) {
                                verify2FASetup();
                            }
                        });
                    }
                }, 100);
            }
        };

        window.generate2FAQRCode = function() {
            console.log('🔒 Generating 2FA QR Code...');
            
            const qrContainer = document.getElementById('qr-code-container');
            if (!qrContainer) {
                console.error('❌ QR container not found');
                return;
            }

            const possibleUrls = [
                `${window.location.protocol}//${window.location.host}/index.php/Auth_public_mem/setup_2fa_registration`,
                `${window.location.protocol}//${window.location.host}/Auth_public_mem/setup_2fa_registration`,
                window.base_url ? window.base_url + 'Auth_public_mem/setup_2fa_registration' : null,
                window.site_url ? window.site_url + 'Auth_public_mem/setup_2fa_registration' : null,
                './Auth_public_mem/setup_2fa_registration'
            ].filter(url => url !== null);

            console.log('🔒 Possible 2FA URLs:', possibleUrls);

            let urlIndex = 0;

            function tryGenerate() {
                if (urlIndex >= possibleUrls.length) {
                    console.error('❌ All 2FA URLs failed');
                    qrContainer.innerHTML = `
                        <div class="alert alert-danger">
                            <h6><i class="bi bi-exclamation-triangle"></i> เกิดข้อผิดพลาด</h6>
                            <p class="mb-2">ไม่สามารถสร้าง QR Code ได้ กรุณาลองใหม่อีกครั้ง</p>
                            <button class="btn btn-sm btn-outline-danger" onclick="generate2FAQRCode()">
                                <i class="bi bi-arrow-clockwise"></i> ลองใหม่
                            </button>
                        </div>
                    `;
                    return;
                }

                const url = possibleUrls[urlIndex];
                console.log(`🚀 Trying 2FA URL ${urlIndex + 1}: ${url}`);

                fetch(url, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/x-www-form-urlencoded',
                        'X-Requested-With': 'XMLHttpRequest'
                    },
                    body: 'action=setup_2fa_registration'
                })
                .then(response => {
                    if (!response.ok) {
                        throw new Error(`HTTP ${response.status}`);
                    }
                    return response.json();
                })
                .then(data => {
                    console.log('✅ 2FA QR response:', data);
                    
                    if (data.status === 'success' && data.qr_code_url && data.secret) {
                        qrContainer.innerHTML = `
                            <div class="text-center">
                                <img src="${data.qr_code_url}" alt="QR Code" class="img-fluid mb-3" 
                                     style="max-width: 200px; border: 2px dashed #dee2e6; padding: 10px; border-radius: 10px;">
                                <div class="alert alert-light">
                                    <small class="text-muted">หรือป้อนรหัสนี้ด้วยตนเอง:</small><br>
                                    <code class="text-primary" style="font-size: 0.9rem;">${data.secret}</code>
                                </div>
                            </div>
                        `;
                        
                        window.current2FASecret = data.secret;
                        console.log('🔒 2FA Secret stored:', data.secret);
                        
                    } else {
                        throw new Error(data.message || 'Invalid response from server');
                    }
                })
                .catch(error => {
                    console.error(`❌ 2FA URL ${urlIndex + 1} failed:`, error.message);
                    urlIndex++;
                    tryGenerate();
                });
            }

            tryGenerate();
        };

        window.verify2FASetup = function() {
            console.log('🔒 Verifying 2FA setup...');
            
            const otpInput = document.getElementById('setup-otp-input');
            const verifyBtn = document.getElementById('verify-btn');
            
            if (!otpInput) {
                console.error('❌ OTP input not found');
                return;
            }

            const otp = otpInput.value.trim();
            
            if (otp.length !== 6) {
                alert('กรุณากรอกรหัส OTP 6 หลัก');
                otpInput.focus();
                return;
            }

            if (!window.current2FASecret) {
                alert('เกิดข้อผิดพลาด: ไม่พบ Secret กรุณาเริ่มต้นใหม่');
                go2FAStep(2);
                return;
            }

            const originalBtnContent = verifyBtn.innerHTML;
            verifyBtn.innerHTML = '<i class="bi bi-hourglass-split"></i> กำลังตรวจสอบ...';
            verifyBtn.disabled = true;

            const possibleUrls = [
                `${window.location.protocol}//${window.location.host}/index.php/Auth_public_mem/verify_2fa_registration`,
                `${window.location.protocol}//${window.location.host}/Auth_public_mem/verify_2fa_registration`,
                window.base_url ? window.base_url + 'Auth_public_mem/verify_2fa_registration' : null,
                window.site_url ? window.site_url + 'Auth_public_mem/verify_2fa_registration' : null,
                './Auth_public_mem/verify_2fa_registration'
            ].filter(url => url !== null);

            let urlIndex = 0;

            function tryVerify() {
                if (urlIndex >= possibleUrls.length) {
                    console.error('❌ All verify URLs failed');
                    verifyBtn.innerHTML = originalBtnContent;
                    verifyBtn.disabled = false;
                    alert('เกิดข้อผิดพลาดในการเชื่อมต่อ กรุณาลองใหม่อีกครั้ง');
                    return;
                }

                const url = possibleUrls[urlIndex];
                console.log(`🚀 Trying verify URL ${urlIndex + 1}: ${url}`);

                const formData = new FormData();
                formData.append('action', 'verify_registration_2fa');
                formData.append('otp', otp);
                formData.append('secret', window.current2FASecret);

                fetch(url, {
                    method: 'POST',
                    headers: {
                        'X-Requested-With': 'XMLHttpRequest'
                    },
                    body: formData
                })
                .then(response => {
                    if (!response.ok) {
                        throw new Error(`HTTP ${response.status}`);
                    }
                    return response.json();
                })
                .then(data => {
                    console.log('✅ 2FA Verify response:', data);
                    
                    if (data.status === 'success') {
                        show2FASuccessModal();
                    } else {
                        verifyBtn.innerHTML = originalBtnContent;
                        verifyBtn.disabled = false;
                        alert(data.message || 'รหัส OTP ไม่ถูกต้อง กรุณาลองใหม่');
                        otpInput.value = '';
                        otpInput.focus();
                    }
                })
                .catch(error => {
                    console.error(`❌ Verify URL ${urlIndex + 1} failed:`, error.message);
                    urlIndex++;
                    tryVerify();
                });
            }

            tryVerify();
        };

        window.show2FASuccessModal = function() {
            console.log('🎉 Showing 2FA success modal...');
            
            const modalElement = document.getElementById('postRegistration2FAInviteModal');
            const modalContent = modalElement.querySelector('.modal-content');
            
            modalContent.innerHTML = `
                <div id="setup-success" class="2fa-setup-step">
                    <div class="modal-header bg-success text-white">
                        <h5 class="modal-title">
                            <i class="bi bi-check-circle-fill"></i> ตั้งค่า 2FA สำเร็จ!
                        </h5>
                    </div>
                    <div class="modal-body text-center py-5">
                        <div class="success-animation mb-4">
                            <i class="bi bi-shield-check" style="font-size: 4rem; color: #28a745;"></i>
                        </div>
                        <h4 class="text-success mb-3">เยี่ยมมาก!</h4>
                        <p class="text-muted mb-4">
                            บัญชีของคุณได้รับการปกป้องด้วยการยืนยันตัวตนแบบ 2 ขั้นตอนแล้ว<br>
                            ตอนนี้คุณสามารถเข้าสู่ระบบได้อย่างปลอดภัย
                        </p>
                        
                        <div class="alert alert-info">
                            <h6><i class="bi bi-lightbulb"></i> เคล็ดลับ:</h6>
                            <ul class="mb-0 text-start">
                                <li>เก็บมือถือไว้ใกล้ตัวเมื่อต้องการเข้าสู่ระบบ</li>
                                <li>สามารถเพิ่มบัญชีเดียวกันในหลายอุปกรณ์ได้</li>
                                <li>รหัส OTP จะเปลี่ยนทุก 30 วินาที</li>
                            </ul>
                        </div>
                    </div>
                    <div class="modal-footer justify-content-center">
                        <button type="button" class="btn btn-success btn-lg px-5" onclick="finishRegistration()">
                            <i class="bi bi-box-arrow-in-right"></i> ไปหน้าเข้าสู่ระบบ
                        </button>
                    </div>
                </div>
            `;
        };

        window.finishRegistration = function() {
            console.log('🎉 Finishing registration...');
            
            const modalElement = document.getElementById('postRegistration2FAInviteModal');
            if (modalElement) {
                const modal = bootstrap.Modal.getInstance(modalElement);
                if (modal) {
                    modal.hide();
                }
            }
            
            setTimeout(() => {
                window.location.href = '<?php echo site_url("User"); ?>';
            }, 500);
        };
		
		
		
		

      function validateThaiIDCard(idNumber) {
    // ตรวจสอบว่าเป็นตัวเลข 13 หลัก
    if (!/^\d{13}$/.test(idNumber)) {
        return false;
    }
    
    // คำนวณ checksum
    let sum = 0;
    for (let i = 0; i < 12; i++) {
        sum += parseInt(idNumber.charAt(i)) * (13 - i);
    }
    
    let checkDigit = (11 - (sum % 11)) % 10;
    if (checkDigit === 10) checkDigit = 0;
    
    return checkDigit === parseInt(idNumber.charAt(12));
}

    </script>

</body>

</html>