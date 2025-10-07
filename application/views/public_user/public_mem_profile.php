<!DOCTYPE html>
<html lang="th">

<head>
    <meta charset="UTF-8">
    <link rel="icon" href="<?php echo base_url("docs/logo.png"); ?>" type="image/x-icon">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $this->session->userdata('tenant_name'); ?> - โปรไฟล์ผู้ใช้</title>

    <!-- Fonts -->
    <link href='https://fonts.googleapis.com/css?family=Kanit:300,400,500,600' rel='stylesheet'>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        :root {
            --primary: #4A90E2;
            --primary-dark: #357ABD;
            --secondary: #50C878;
            --accent: #F39C12;
            --danger: #E74C3C;
            --warning: #F1C40F;
            --info: #3498DB;
            --success: #28A745;
            --light: #F8F9FA;
            --dark: #2C3E50;
            --border-color: #E9ECEF;
            --shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
            --border-radius: 12px;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Kanit', sans-serif;
            min-height: 100vh;
            color: #1e293b;
            line-height: 1.5;
            padding: 20px 0;
        }

        .container {
            max-width: 1200px;
        }

        /* Modal z-index fixes */
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
            border: none;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.3);
        }

        .profile-card {
            background: white;
            border-radius: var(--border-radius);
            box-shadow: var(--shadow);
            overflow: hidden;
            margin-bottom: 30px;
        }

        .profile-header {
            background: linear-gradient(135deg, var(--primary) 0%, var(--primary-dark) 100%);
            color: white;
            padding: 30px;
            text-align: center;
            position: relative;
        }

        .profile-header::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100"><circle cx="20" cy="20" r="2" fill="rgba(255,255,255,0.1)"/><circle cx="80" cy="40" r="1.5" fill="rgba(255,255,255,0.1)"/><circle cx="40" cy="80" r="1" fill="rgba(255,255,255,0.1)"/></svg>');
            opacity: 0.5;
        }

        .profile-title {
            font-size: 2rem;
            font-weight: 600;
            margin-bottom: 5px;
            position: relative;
            z-index: 2;
        }

        .profile-subtitle {
            opacity: 0.9;
            font-size: 1.1rem;
            position: relative;
            z-index: 2;
        }

        .section-card {
            background: var(--light);
            border-radius: var(--border-radius);
            padding: 30px;
            margin-bottom: 25px;
            border: 1px solid var(--border-color);
            transition: all 0.3s ease;
        }

        .section-card:hover {
            box-shadow: var(--shadow);
            transform: translateY(-2px);
        }

        .section-title {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 25px;
            font-size: 1.3rem;
            font-weight: 600;
            color: var(--dark);
        }

        .section-title .title-left {
            display: flex;
            align-items: center;
        }

        .section-title i {
            background: linear-gradient(135deg, var(--primary), var(--primary-dark));
            color: white;
            width: 45px;
            height: 45px;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-right: 15px;
            font-size: 1.2rem;
        }

        .form-group {
            margin-bottom: 25px;
        }

        .form-label {
            font-weight: 500;
            color: var(--dark);
            margin-bottom: 8px;
            display: flex;
            align-items: center;
            font-size: 1rem;
        }

        .form-label i {
            margin-right: 8px;
            color: var(--primary);
            width: 16px;
        }

        .form-control {
            border: 2px solid var(--border-color);
            border-radius: 8px;
            padding: 12px 15px;
            font-size: 16px;
            transition: all 0.3s ease;
            background: white;
        }

        .form-control:focus {
            border-color: var(--primary);
            box-shadow: 0 0 0 3px rgba(74, 144, 226, 0.1);
            background: white;
        }

        .input-group {
            position: relative;
        }

        .password-toggle {
            position: absolute;
            right: 15px;
            top: 50%;
            transform: translateY(-50%);
            background: none;
            border: none;
            color: var(--primary);
            cursor: pointer;
            z-index: 3;
            padding: 5px;
        }

        .profile-image-section {
            text-align: center;
            margin-bottom: 25px;
        }

        .current-image {
            width: 180px;
            height: 180px;
            border-radius: 15px;
            object-fit: cover;
            border: 4px solid var(--border-color);
            margin-bottom: 15px;
            box-shadow: var(--shadow);
            transition: all 0.3s ease;
        }

        .current-image:hover {
            transform: scale(1.05);
        }

        .file-input-wrapper {
            position: relative;
            display: inline-block;
            cursor: pointer;
            overflow: hidden;
            border-radius: 8px;
            background: var(--primary);
            color: white;
            padding: 12px 24px;
            transition: all 0.3s ease;
            font-weight: 500;
        }

        .file-input-wrapper:hover {
            background: var(--primary-dark);
            transform: translateY(-2px);
            box-shadow: var(--shadow);
        }

        .file-input-wrapper input[type=file] {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            opacity: 0;
            cursor: pointer;
        }

        .btn-modern {
            padding: 12px 30px;
            border-radius: 8px;
            font-weight: 500;
            border: none;
            transition: all 0.3s ease;
            font-size: 16px;
            display: inline-flex;
            align-items: center;
            gap: 8px;
        }

        .btn-modern:hover {
            transform: translateY(-2px);
            box-shadow: var(--shadow);
        }

        .btn-success-modern {
            background: linear-gradient(135deg, var(--success), #1e7e34);
            color: white;
        }

        .btn-danger-modern {
            background: linear-gradient(135deg, var(--danger), #c82333);
            color: white;
        }

        .btn-primary-modern {
            background: linear-gradient(135deg, var(--primary), var(--primary-dark));
            color: white;
        }

        .btn-secondary-modern {
            background: linear-gradient(135deg, #6c757d, #5a6268);
            color: white;
        }

        .btn-warning-modern {
            background: linear-gradient(135deg, var(--warning), #e0a800);
            color: white;
        }

        /* Toggle Edit Mode */
        .edit-toggle-btn {
            background: var(--primary);
            color: white;
            border: none;
            padding: 8px 16px;
            border-radius: 6px;
            font-size: 14px;
            transition: all 0.3s ease;
        }

        .edit-toggle-btn:hover {
            background: var(--primary-dark);
            transform: translateY(-1px);
        }

        /* 2FA Styles */
        .twofa-status {
            padding: 20px;
            border-radius: 10px;
            margin-bottom: 20px;
            border: 2px solid;
        }

        .twofa-enabled {
            background: rgba(40, 167, 69, 0.1);
            border-color: var(--success);
            color: var(--success);
        }

        .twofa-disabled {
            background: rgba(255, 193, 7, 0.1);
            border-color: var(--warning);
            color: #856404;
        }

        .twofa-buttons {
            display: flex;
            gap: 15px;
            flex-wrap: wrap;
            margin-top: 15px;
        }

        .btn-2fa {
            padding: 10px 20px;
            border-radius: 6px;
            border: none;
            font-weight: 500;
            cursor: pointer;
            transition: all 0.3s ease;
            display: inline-flex;
            align-items: center;
            gap: 8px;
        }

        .btn-enable-2fa {
            background: var(--success);
            color: white;
        }

        .btn-regenerate-2fa {
            background: var(--warning);
            color: white;
        }

        .btn-disable-2fa {
            background: var(--danger);
            color: white;
        }

        .btn-backup-codes {
            background: var(--info);
            color: white;
        }

        .btn-add-device {
            background: var(--secondary);
            color: white;
        }

        .btn-info {
            background: var(--info);
            color: white;
        }

        .btn-2fa:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
        }

        .info-item {
            margin-bottom: 20px;
            padding: 15px;
            background: white;
            border-radius: 8px;
            border: 1px solid var(--border-color);
        }

        .info-label {
            font-weight: 600;
            color: var(--dark);
            margin-bottom: 8px;
            display: flex;
            align-items: center;
            font-size: 0.9rem;
        }

        .info-label i {
            margin-right: 8px;
            color: var(--primary);
            width: 16px;
        }

        .info-value {
            color: #495057;
            font-size: 1rem;
            margin-left: 24px;
        }

        .status-badge {
            padding: 6px 16px;
            border-radius: 20px;
            font-size: 0.85rem;
            font-weight: 500;
            display: inline-flex;
            align-items: center;
            gap: 6px;
        }

        .status-active {
            background-color: #d1fae5;
            color: #065f46;
            border: 1px solid #10b981;
        }

        .status-inactive {
            background-color: #fef3c7;
            color: #92400e;
            border: 1px solid #f59e0b;
        }

        /* Edit Mode Styles */
        .edit-mode {
            display: none;
        }

        .view-mode {
            display: block;
        }

        .is-editing .edit-mode {
            display: block;
        }

        .is-editing .view-mode {
            display: none;
        }

        /* Device count badge */
        .device-count-badge {
            background: linear-gradient(135deg, var(--info), #2980b9);
            color: white;
            padding: 8px 16px;
            border-radius: 20px;
            font-size: 14px;
            font-weight: 500;
            display: inline-flex;
            align-items: center;
            gap: 6px;
            margin-bottom: 15px;
            transition: all 0.3s ease;
            cursor: pointer;
        }

        .device-count-badge:hover {
            background: linear-gradient(135deg, #2980b9, var(--info));
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(52, 152, 219, 0.3);
        }

        .alert {
            border-radius: 8px;
            border: none;
            margin-bottom: 20px;
        }

        .alert-success {
            background: rgba(40, 167, 69, 0.1);
            color: var(--success);
            border-left: 4px solid var(--success);
        }

        .alert-danger {
            background: rgba(220, 53, 69, 0.1);
            color: var(--danger);
            border-left: 4px solid var(--danger);
        }

        .alert-warning {
            background: rgba(255, 193, 7, 0.1);
            color: #856404;
            border-left: 4px solid var(--warning);
        }

        .alert-info {
            background: rgba(52, 152, 219, 0.1);
            color: var(--info);
            border-left: 4px solid var(--info);
        }

        /* Back button styles */
        .back-button {
            position: fixed;
            top: 20px;
            left: 20px;
            z-index: 1000;
            background: white;
            border: 1px solid var(--border-color);
            border-radius: 50px;
            padding: 8px 20px;
            color: var(--dark);
            text-decoration: none;
            font-weight: 500;
            box-shadow: var(--shadow);
            transition: all 0.3s ease;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .back-button:hover {
            background: var(--primary);
            color: white;
            transform: translateY(-2px);
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.15);
        }

        .qr-code-container {
            text-align: center;
            padding: 20px;
            background: white;
            border-radius: 10px;
            border: 2px dashed var(--border-color);
            margin: 20px 0;
        }

        /* Device list styles */
        .device-item {
            background: white;
            border: 1px solid var(--border-color);
            border-radius: 8px;
            padding: 15px;
            margin-bottom: 10px;
            transition: all 0.3s ease;
        }

        .device-item:hover {
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
            border-color: var(--primary);
        }

        .device-info {
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        .device-details h6 {
            margin: 0 0 5px 0;
            color: var(--dark);
            font-weight: 600;
        }

        .device-details p {
            margin: 0;
            font-size: 13px;
            color: #666;
        }

        .device-icon {
            width: 40px;
            height: 40px;
            border-radius: 8px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.2rem;
            margin-right: 15px;
        }

        .device-desktop {
            background: linear-gradient(135deg, #3498db, #2980b9);
            color: white;
        }

        .device-mobile {
            background: linear-gradient(135deg, #2ecc71, #27ae60);
            color: white;
        }

        .device-tablet {
            background: linear-gradient(135deg, #f39c12, #e67e22);
            color: white;
        }

        .device-unknown {
            background: linear-gradient(135deg, #95a5a6, #7f8c8d);
            color: white;
        }

        .btn-remove-device {
            background: none;
            border: 1px solid var(--danger);
            color: var(--danger);
            padding: 5px 12px;
            border-radius: 5px;
            font-size: 12px;
            transition: all 0.3s ease;
        }

        .btn-remove-device:hover {
            background: var(--danger);
            color: white;
        }

        /* QR Code Countdown Styles */
        .countdown-display {
            font-family: 'Courier New', monospace;
        }

        .progress {
            transition: all 0.3s ease;
        }

        .progress-bar {
            transition: all 0.3s ease;
        }

        #qrCountdownAlert {
            border-left: 4px solid #ffc107;
            background: linear-gradient(135deg, #fff3cd 0%, #fef5e7 100%);
        }

        @keyframes pulse {
            0% {
                opacity: 1;
            }

            50% {
                opacity: 0.5;
            }

            100% {
                opacity: 1;
            }
        }

        .badge.bg-danger {
            animation: pulse 1s infinite;
        }

        /* Invite 2FA Modal Styles */
        #invite2FAModal .modal-content {
            border: none;
            border-radius: 15px;
            box-shadow: 0 15px 35px rgba(0, 0, 0, 0.1);
        }

        #invite2FAModal .modal-header {
            border-radius: 15px 15px 0 0;
            border-bottom: none;
            padding: 25px 30px;
        }

        #invite2FAModal .modal-body {
            padding: 30px;
        }

        #invite2FAModal .modal-footer {
            border-top: 1px solid #f0f0f0;
            padding: 20px 30px;
            border-radius: 0 0 15px 15px;
        }

        #invite2FAModal .btn-success {
            background: linear-gradient(135deg, var(--success), #1e7e34);
            border: none;
            padding: 12px 30px;
            font-weight: 600;
            box-shadow: 0 4px 15px rgba(40, 167, 69, 0.3);
            transition: all 0.3s ease;
        }

        #invite2FAModal .btn-success:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(40, 167, 69, 0.4);
        }

        #invite2FAModal .btn-light {
            border: 2px solid #e9ecef;
            padding: 10px 20px;
            font-weight: 500;
            transition: all 0.3s ease;
        }

        #invite2FAModal .btn-light:hover {
            background: #f8f9fa;
            border-color: #dee2e6;
            transform: translateY(-1px);
        }

        #invite2FAModal .alert-warning {
            border: none;
            background: linear-gradient(135deg, #fff3cd 0%, #fef5e7 100%);
            border-left: 4px solid #ffc107;
        }

        #invite2FAModal .bg-light {
            background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%) !important;
        }

        /* Benefits animation */
        #invite2FAModal .d-flex.align-items-start {
            animation: slideInLeft 0.6s ease-out;
            animation-fill-mode: both;
        }

        #invite2FAModal .d-flex.align-items-start:nth-child(1) {
            animation-delay: 0.1s;
        }

        #invite2FAModal .d-flex.align-items-start:nth-child(2) {
            animation-delay: 0.2s;
        }

        @keyframes slideInLeft {
            from {
                opacity: 0;
                transform: translateX(-30px);
            }

            to {
                opacity: 1;
                transform: translateX(0);
            }
        }

        /* Steps animation */
        #invite2FAModal .badge.bg-primary {
            animation: bounceIn 0.8s ease-out;
            animation-fill-mode: both;
        }

        #invite2FAModal .col-4:nth-child(1) .badge {
            animation-delay: 0.3s;
        }

        #invite2FAModal .col-4:nth-child(2) .badge {
            animation-delay: 0.4s;
        }

        #invite2FAModal .col-4:nth-child(3) .badge {
            animation-delay: 0.5s;
        }

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

        /* Setup step styles */
        .setup-step {
            min-height: 300px;
        }

        .setup-step .card {
            transition: all 0.3s ease;
            cursor: pointer;
        }

        .setup-step .card:hover {
            transform: translateY(-5px);
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
        }

        /* Responsive */
        @media (max-width: 768px) {
            .section-card {
                padding: 20px;
            }

            .twofa-buttons {
                flex-direction: column;
            }

            .btn-2fa {
                width: 100%;
                justify-content: center;
            }

            .back-button {
                position: relative;
                top: auto;
                left: auto;
                margin-bottom: 20px;
                align-self: flex-start;
            }

            .section-title {
                flex-direction: column;
                align-items: flex-start;
                gap: 10px;
            }
        }

        /* Loading states */
        .loading {
            opacity: 0.6;
            pointer-events: none;
        }

        .spinner-border-sm {
            width: 1rem;
            height: 1rem;
        }




        /* แก้ไขปัญหา form fields เพี้ยนใน edit mode */
        .edit-mode .form-control {
            width: 100% !important;
            max-width: 100% !important;
            box-sizing: border-box !important;
            font-size: 16px !important;
            line-height: 1.5 !important;
            padding: 12px 15px !important;
            margin-bottom: 0 !important;
        }

        .edit-mode .form-group {
            margin-bottom: 20px !important;
        }

        .edit-mode .form-label {
            margin-bottom: 8px !important;
            font-weight: 500 !important;
            font-size: 1rem !important;
            white-space: nowrap !important;
            overflow: visible !important;
        }

        /* แก้ไข readonly fields ให้ดูดี */
        .form-control[readonly] {
            background-color: #f8f9fa !important;
            opacity: 0.8 !important;
            cursor: not-allowed !important;
        }

        /* ปุ่มลบบัญชี */
        .btn-delete-account {
            background: linear-gradient(135deg, #dc3545, #c82333);
            color: white;
            border: none;
            padding: 12px 30px;
            border-radius: 8px;
            font-weight: 600;
            font-size: 16px;
            display: inline-flex;
            align-items: center;
            gap: 8px;
            transition: all 0.3s ease;
            box-shadow: 0 4px 15px rgba(220, 53, 69, 0.3);
        }

        .btn-delete-account:hover {
            background: linear-gradient(135deg, #c82333, #bd2130);
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(220, 53, 69, 0.4);
        }

        /* Account Management Section */
        .account-management-section {
            background: #fff5f5;
            border: 2px solid #fed7d7;
            border-radius: var(--border-radius);
            padding: 25px;
            margin-top: 30px;
        }

        .account-management-section .section-title {
            color: #c53030;
            border-bottom: 2px solid #fed7d7;
            padding-bottom: 15px;
            margin-bottom: 20px;
        }

        .account-management-section .section-title i {
            background: linear-gradient(135deg, #dc3545, #c82333);
        }

        /* Modal ลบบัญชี */
        #deleteAccountModal .modal-content {
            border: none;
            border-radius: 15px;
            box-shadow: 0 15px 35px rgba(0, 0, 0, 0.1);
        }

        #deleteAccountModal .modal-header {
            background: linear-gradient(135deg, #dc3545, #c82333);
            color: white;
            border-radius: 15px 15px 0 0;
            border-bottom: none;
            padding: 25px 30px;
        }

        #deleteAccountModal .modal-body {
            padding: 30px;
        }

        #deleteAccountModal .modal-footer {
            border-top: 1px solid #f0f0f0;
            padding: 20px 30px;
            border-radius: 0 0 15px 15px;
        }

        #deleteAccountModal .btn-danger {
            background: linear-gradient(135deg, #dc3545, #c82333);
            border: none;
            padding: 12px 30px;
            font-weight: 600;
            box-shadow: 0 4px 15px rgba(220, 53, 69, 0.3);
            transition: all 0.3s ease;
        }

        #deleteAccountModal .btn-danger:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(220, 53, 69, 0.4);
        }

        #deleteAccountModal .alert-danger {
            border: none;
            background: linear-gradient(135deg, #fed7d7 0%, #feb2b2 100%);
            border-left: 4px solid #dc3545;
            color: #c53030;
        }

        /* ID Number validation feedback */
        .id-number-feedback {
            font-size: 13px;
            margin-top: 5px;
            padding: 8px 12px;
            border-radius: 6px;
            display: none;
        }

        .id-number-feedback.valid {
            background: #d1fae5;
            color: #065f46;
            border: 1px solid #10b981;
            display: block;
        }

        .id-number-feedback.invalid,
        .id-number-feedback.duplicate {
            background: #fef2f2;
            color: #dc2626;
            border: 1px solid #ef4444;
            display: block;
        }

        .id-number-feedback.checking {
            background: #fffbeb;
            color: #d97706;
            border: 1px solid #f59e0b;
            display: block;
        }

        /* Loading state สำหรับ ID number check */
        .id-number-loading {
            display: none;
            color: #6b7280;
            font-size: 13px;
            margin-top: 5px;
        }

        .id-number-loading.show {
            display: block;
        }

        /* ปรับ responsive สำหรับมือถือ */
        @media (max-width: 768px) {
            .account-management-section {
                padding: 20px 15px;
            }

            .btn-delete-account {
                width: 100%;
                justify-content: center;
                padding: 15px;
                font-size: 18px;
            }

            #deleteAccountModal .modal-body {
                padding: 20px;
            }
        }
    </style>
</head>

<body>

    <!-- Back Button -->
    <a href="<?php echo site_url('Pages/service_systems'); ?>" class="back-button">
        <i class="bi bi-arrow-left"></i>
        กลับไปหน้าหลัก
    </a>

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-12">
                <!-- Profile Header -->
                <div class="profile-card">
                    <div class="profile-header">
                        <h1 class="profile-title">
                            <i class="bi bi-person-circle me-2"></i>
                            ข้อมูลโปรไฟล์
                        </h1>
                        <p class="profile-subtitle">ดูและจัดการข้อมูลส่วนตัวและการรักษาความปลอดภัย</p>
                    </div>

                    <div class="p-4">
                        <!-- Alert Messages -->
                        <div id="alertContainer"></div>

                        <!-- Profile Image Section -->
                        <div class="section-card">
                            <div class="section-title">
                                <div class="title-left">
                                    <i class="bi bi-image"></i>
                                    รูปโปรไฟล์
                                </div>
                                <button type="button" class="edit-toggle-btn" onclick="toggleEditMode('image')"
                                    id="imageEditBtn">
                                    <i class="bi bi-pencil"></i> แก้ไข
                                </button>
                            </div>

                            <!-- View Mode -->
                            <div class="view-mode" id="imageViewMode">
                                <div class="profile-image-section">
                                    <?php $img_path = !empty($user_data->mp_img) ? 'docs/img/avatar/' . $user_data->mp_img : 'docs/img/User.png'; ?>
                                    <img src="<?= base_url($img_path); ?>" class="current-image"
                                        alt="รูปโปรไฟล์ปัจจุบัน" id="currentImageDisplay">

                                    <?php if (!empty($user_data->mp_img)): ?>
                                        <div class="mt-2">
                                            <!--  <small class="text-muted">
                    <i class="bi bi-info-circle"></i> 
                    รูปภาพถูกบีบและปรับขนาดอัตโนมัติเพื่อประหยัดพื้นที่
                </small>  -->
                                        </div>
                                    <?php endif; ?>
                                </div>
                            </div>

                            <!-- Edit Mode -->
                            <div class="edit-mode" id="imageEditMode" style="display: none;">
                                <form id="imageForm" enctype="multipart/form-data">
                                    <div class="profile-image-section">
                                        <img src="<?= base_url($img_path); ?>" class="current-image"
                                            alt="รูปโปรไฟล์ปัจจุบัน" id="previewImage">
                                        <br>
                                        <div class="file-input-wrapper">
                                            <i class="bi bi-upload"></i>
                                            เลือกรูปภาพใหม่
                                            <input type="file" name="mp_img" id="mp_img" accept="image/*"
                                                onchange="previewImageFile(this)">
                                        </div>

                                        <!-- ข้อมูลไฟล์ -->
                                        <div id="fileInfo" style="display: none;"></div>

                                        <!-- คำแนะนำ -->
                                        <div class="mt-3">
                                            <div class="alert alert-info">
                                                <h6><i class="bi bi-lightbulb"></i> ข้อมูลที่ควรทราบ:</h6>
                                                <ul class="mb-0 small">
                                                    <li>📁 รองรับไฟล์: JPG, PNG, GIF (ขนาดไม่เกิน 5MB)</li>
                                                    <li>🗜️ ระบบจะบีบและปรับขนาดภาพอัตโนมัติ</li>
                                                    <li>💾 ประหยัดพื้นที่เก็บข้อมูลโดยรักษาคุณภาพภาพ</li>
                                                    <li>🔄 รูปภาพจะถูกแปลงเป็น JPG เพื่อการบีบที่ดีที่สุด</li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="text-center">
                                        <button type="button" class="btn-modern btn-success-modern me-2"
                                            onclick="saveImage()">
                                            <i class="bi bi-check-circle"></i>
                                            <span class="btn-text">บันทึก</span>
                                        </button>
                                        <button type="button" class="btn-modern btn-secondary-modern"
                                            onclick="cancelEdit('image')">
                                            <i class="bi bi-x-circle"></i>
                                            ยกเลิก
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>

                        <!-- Basic Information Section -->
                        <div class="section-card">
                            <div class="section-title">
                                <div class="title-left">
                                    <i class="bi bi-person-lines-fill"></i>
                                    ข้อมูลพื้นฐาน
                                </div>
                                <button type="button" class="edit-toggle-btn" onclick="toggleEditMode('basic')"
                                    id="basicEditBtn">
                                    <i class="bi bi-pencil"></i> แก้ไข
                                </button>
                            </div>

                            <!-- View Mode -->
                            <div class="view-mode" id="basicViewMode">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="info-item">
                                            <div class="info-label">
                                                <i class="bi bi-envelope"></i>
                                                อีเมล
                                            </div>
                                            <div class="info-value" id="display_email">
                                                <?php echo $user_data->mp_email; ?>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="info-item">
                                            <div class="info-label">
                                                <i class="bi bi-person-vcard"></i>
                                                คำนำหน้า
                                            </div>
                                            <div class="info-value" id="display_prefix">
                                                <?php echo $user_data->mp_prefix; ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="info-item">
                                            <div class="info-label">
                                                <i class="bi bi-person-badge"></i>
                                                ชื่อ
                                            </div>
                                            <div class="info-value" id="display_fname">
                                                <?php echo $user_data->mp_fname; ?>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="info-item">
                                            <div class="info-label">
                                                <i class="bi bi-person-badge-fill"></i>
                                                นามสกุล
                                            </div>
                                            <div class="info-value" id="display_lname">
                                                <?php echo $user_data->mp_lname; ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="info-item">
                                            <div class="info-label">
                                                <i class="bi bi-phone"></i>
                                                เบอร์มือถือ
                                            </div>
                                            <div class="info-value" id="display_phone">
                                                <?php echo !empty($user_data->mp_phone) ? $user_data->mp_phone : '-'; ?>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="info-item">
                                            <div class="info-label">
                                                <i class="bi bi-credit-card"></i>
                                                เลขบัตรประชาชน
                                            </div>
                                            <div class="info-value" id="display_number">
                                                <?php echo !empty($user_data->mp_number) ? $user_data->mp_number : '-'; ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- ส่วนที่อยู่ (แบบใหม่) -->
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="info-item">
                                            <div class="info-label">
                                                <i class="bi bi-house"></i>
                                                บ้านเลขที่ / ที่อยู่
                                            </div>
                                            <div class="info-value" id="display_address">
                                                <?php echo !empty($user_data->mp_address) ? $user_data->mp_address : '-'; ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="info-item">
                                            <div class="info-label">
                                                <i class="bi bi-pin-map"></i>
                                                ตำบล
                                            </div>
                                            <div class="info-value" id="display_district">
                                                <?php echo !empty($user_data->mp_district) ? $user_data->mp_district : '-'; ?>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="info-item">
                                            <div class="info-label">
                                                <i class="bi bi-building"></i>
                                                อำเภอ
                                            </div>
                                            <div class="info-value" id="display_amphoe">
                                                <?php echo !empty($user_data->mp_amphoe) ? $user_data->mp_amphoe : '-'; ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="info-item">
                                            <div class="info-label">
                                                <i class="bi bi-map"></i>
                                                จังหวัด
                                            </div>
                                            <div class="info-value" id="display_province">
                                                <?php echo !empty($user_data->mp_province) ? $user_data->mp_province : '-'; ?>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="info-item">
                                            <div class="info-label">
                                                <i class="bi bi-mailbox"></i>
                                                รหัสไปรษณีย์
                                            </div>
                                            <div class="info-value" id="display_zipcode">
                                                <?php echo !empty($user_data->mp_zipcode) ? $user_data->mp_zipcode : '-'; ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>



                            </div>




                            <!-- Edit Mode -->
                            <div class="edit-mode" id="basicEditMode" style="display: none;">
                                <form id="basicInfoForm">
                                    <input type="hidden" name="mp_id" value="<?php echo $user_data->mp_id; ?>">

                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="form-label">
                                                    <i class="bi bi-envelope"></i>
                                                    อีเมล
                                                </label>
                                                <input type="email" class="form-control bg-light" name="mp_email"
                                                    id="edit_email" value="<?php echo $user_data->mp_email; ?>"
                                                    readonly>
                                                <small class="text-muted">ไม่สามารถแก้ไขอีเมลได้</small>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="form-label">
                                                    <i class="bi bi-person-vcard"></i>
                                                    คำนำหน้า
                                                </label>
                                                <select class="form-control" name="mp_prefix" id="edit_prefix" required>
                                                    <option value="">เลือกคำนำหน้า...</option>
                                                    <option value="นาย" <?php echo ($user_data->mp_prefix == 'นาย') ? 'selected' : ''; ?>>นาย</option>
                                                    <option value="นาง" <?php echo ($user_data->mp_prefix == 'นาง') ? 'selected' : ''; ?>>นาง</option>
                                                    <option value="นางสาว" <?php echo ($user_data->mp_prefix == 'นางสาว') ? 'selected' : ''; ?>>นางสาว</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="form-label">
                                                    <i class="bi bi-person-badge"></i>
                                                    ชื่อ
                                                </label>
                                                <input type="text" class="form-control" name="mp_fname" id="edit_fname"
                                                    value="<?php echo $user_data->mp_fname; ?>" required>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="form-label">
                                                    <i class="bi bi-person-badge-fill"></i>
                                                    นามสกุล
                                                </label>
                                                <input type="text" class="form-control" name="mp_lname" id="edit_lname"
                                                    value="<?php echo $user_data->mp_lname; ?>" required>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="form-label">
                                                    <i class="bi bi-phone"></i>
                                                    เบอร์มือถือ
                                                </label>
                                                <input type="tel" class="form-control" name="mp_phone" id="edit_phone"
                                                    value="<?php echo $user_data->mp_phone; ?>" maxlength="10"
                                                    pattern="[0-9]{10}">
                                            </div>
                                        </div>
                                        <div class="col-md-6">

                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label class="form-label">
                                                    <i class="bi bi-credit-card"></i>
                                                    เลขบัตรประชาชน
                                                </label>
                                                <input type="text" class="form-control" name="mp_number"
                                                    id="edit_number" value="<?php echo $user_data->mp_number; ?>"
                                                    maxlength="13" pattern="[0-9]{13}"
                                                    placeholder="กรอกเลขบัตรประชาชน 13 หลัก">

                                                <!-- Loading indicator -->
                                                <div id="id_number_loading" class="id-number-loading">
                                                    <i class="fas fa-spinner fa-spin"></i> กำลังตรวจสอบ...
                                                </div>

                                                <!-- Feedback message -->
                                                <div id="id_number_feedback" class="id-number-feedback"></div>

                                                <small class="text-muted">ต้องใช้กรณีใช้งานระบบจ่ายภาษี
                                                    และระบบอื่นๆ</small>
                                            </div>

                                        </div>
                                    </div>



                                    <!-- ส่วนที่อยู่แบบใหม่ -->
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label class="form-label">
                                                    <i class="bi bi-house"></i>
                                                    บ้านเลขที่ / ที่อยู่
                                                </label>
                                                <textarea class="form-control" name="mp_address" id="edit_address"
                                                    rows="1" required
                                                    placeholder="เช่น 123/45 หมู่ 6 ซอยสุขุมวิท 71"><?php echo $user_data->mp_address; ?></textarea>
                                                <small class="text-muted">กรอกบ้านเลขที่ ซอย ถนน หมู่บ้าน</small>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- รหัสไปรษณีย์และการค้นหา -->
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="form-label">
                                                    <i class="bi bi-mailbox"></i>
                                                    รหัสไปรษณีย์
                                                </label>
                                                <input type="text" class="form-control" id="edit_zipcode" maxlength="5"
                                                    placeholder="กรอกรหัสไปรษณีย์ 5 หลัก" pattern="[0-9]{5}"
                                                    value="<?php echo !empty($user_data->mp_zipcode) ? $user_data->mp_zipcode : ''; ?>">
                                                <small
                                                    class="text-muted">กรอกรหัสไปรษณีย์เพื่อเติมข้อมูลอัตโนมัติ</small>

                                                <!-- Loading & Error indicators -->
                                                <div id="zipcode_loading" class="text-center mt-1"
                                                    style="display: none;">
                                                    <small class="text-primary">
                                                        <i class="fas fa-spinner fa-spin"></i> กำลังค้นหา...
                                                    </small>
                                                </div>
                                                <div id="zipcode_error" class="mt-1" style="display: none;">
                                                    <small class="text-danger"></small>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- จังหวัด และ อำเภอ -->
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="form-label">
                                                    <i class="bi bi-map"></i>
                                                    จังหวัด
                                                </label>
                                                <input type="text" class="form-control" id="edit_province_field"
                                                    placeholder="จังหวัด" readonly
                                                    value="<?php echo !empty($user_data->mp_province) ? $user_data->mp_province : ''; ?>">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="form-label">
                                                    <i class="bi bi-building"></i>
                                                    อำเภอ
                                                </label>
                                                <select class="form-control" id="edit_amphoe_field" disabled>
                                                    <option value="">เลือกอำเภอ</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- ตำบล -->
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="form-label">
                                                    <i class="bi bi-pin-map"></i>
                                                    ตำบล <span class="text-danger">*</span>
                                                </label>
                                                <select class="form-control" id="edit_district_field" disabled required>
                                                    <option value="">เลือกตำบล</option>
                                                </select>
                                                <small class="text-muted">กรุณาเลือกตำบลที่อยู่</small>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Hidden fields สำหรับส่งข้อมูลแยกย่อย - แก้ไขชื่อฟิลด์ -->
                                    <input type="hidden" name="mp_province" id="edit_province_hidden"
                                        value="<?php echo !empty($user_data->mp_province) ? $user_data->mp_province : ''; ?>">
                                    <input type="hidden" name="mp_amphoe" id="edit_amphoe_hidden"
                                        value="<?php echo !empty($user_data->mp_amphoe) ? $user_data->mp_amphoe : ''; ?>">
                                    <input type="hidden" name="mp_district" id="edit_district_hidden"
                                        value="<?php echo !empty($user_data->mp_district) ? $user_data->mp_district : ''; ?>">
                                    <input type="hidden" name="mp_zipcode" id="edit_zipcode_hidden"
                                        value="<?php echo !empty($user_data->mp_zipcode) ? $user_data->mp_zipcode : ''; ?>">


                                    <div class="text-center">
                                        <button type="button" class="btn-modern btn-success-modern me-2"
                                            onclick="saveBasicInfo()">
                                            <i class="bi bi-check-circle"></i>
                                            <span class="btn-text">บันทึก</span>
                                        </button>
                                        <button type="button" class="btn-modern btn-secondary-modern"
                                            onclick="cancelEdit('basic')">
                                            <i class="bi bi-x-circle"></i>
                                            ยกเลิก
                                        </button>
                                    </div>
                                </form>
                            </div>



                        </div>

                        <!-- Password Section -->
                        <div class="section-card">
                            <div class="section-title">
                                <div class="title-left">
                                    <i class="bi bi-key"></i>
                                    เปลี่ยนรหัสผ่าน
                                </div>
                                <button type="button" class="edit-toggle-btn" onclick="toggleEditMode('password')"
                                    id="passwordEditBtn">
                                    <i class="bi bi-pencil"></i> เปลี่ยนรหัสผ่าน
                                </button>
                            </div>

                            <!-- View Mode -->
                            <div class="view-mode" id="passwordViewMode">
                                <div class="info-item">
                                    <div class="info-label">
                                        <i class="bi bi-shield-lock"></i>
                                        รหัสผ่าน
                                    </div>
                                    <div class="info-value">••••••••••••</div>
                                </div>
                            </div>

                            <!-- Edit Mode -->
                            <div class="edit-mode" id="passwordEditMode" style="display: none;">
                                <form id="passwordForm">
                                    <input type="hidden" name="mp_id" value="<?php echo $user_data->mp_id; ?>">

                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="form-label">
                                                    <i class="bi bi-lock"></i>
                                                    รหัสผ่านใหม่
                                                </label>
                                                <div class="input-group">
                                                    <input type="password" class="form-control" name="new_password"
                                                        id="new_password" placeholder="กรอกรหัสผ่านใหม่" minlength="6">
                                                    <button type="button" class="password-toggle"
                                                        onclick="togglePassword('new_password')">
                                                        <i class="bi bi-eye" id="toggleIcon_new_password"></i>
                                                    </button>
                                                </div>
                                                <small class="text-muted">รหัสผ่านต้องมีอย่างน้อย 6 ตัวอักษร</small>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="form-label">
                                                    <i class="bi bi-lock-fill"></i>
                                                    ยืนยันรหัสผ่าน
                                                </label>
                                                <div class="input-group">
                                                    <input type="password" class="form-control" name="confirm_password"
                                                        id="confirm_password" placeholder="ยืนยันรหัสผ่านใหม่"
                                                        minlength="6">
                                                    <button type="button" class="password-toggle"
                                                        onclick="togglePassword('confirm_password')">
                                                        <i class="bi bi-eye" id="toggleIcon_confirm_password"></i>
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="text-center">
                                        <button type="button" class="btn-modern btn-success-modern me-2"
                                            onclick="savePassword()">
                                            <i class="bi bi-check-circle"></i>
                                            <span class="btn-text">เปลี่ยนรหัสผ่าน</span>
                                        </button>
                                        <button type="button" class="btn-modern btn-secondary-modern"
                                            onclick="cancelEdit('password')">
                                            <i class="bi bi-x-circle"></i>
                                            ยกเลิก
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>

                        <!-- Account Status Section -->
                        <div class="section-card">
                            <div class="section-title">
                                <div class="title-left">
                                    <i class="bi bi-shield-check"></i>
                                    สถานะบัญชี
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="info-item">
                                        <div class="info-label">
                                            <i class="bi bi-toggle-on"></i>
                                            สถานะการใช้งาน
                                        </div>
                                        <div class="info-value">
                                            <?php if ($user_data->mp_status == 1): ?>
                                                <span class="status-badge status-active">
                                                    <i class="bi bi-check-circle"></i>ใช้งานได้
                                                </span>
                                            <?php else: ?>
                                                <span class="status-badge status-inactive">
                                                    <i class="bi bi-x-circle"></i>ระงับการใช้งาน
                                                </span>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="info-item">
                                        <div class="info-label">
                                            <i class="bi bi-calendar-plus"></i>
                                            วันที่สมัครสมาชิก
                                        </div>
                                        <div class="info-value">
                                            <?php
                                            if (!empty($user_data->mp_registered_date)) {
                                                echo date('d/m/Y H:i', strtotime($user_data->mp_registered_date));
                                            } else {
                                                echo '-';
                                            }
                                            ?>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="info-item">
                                        <div class="info-label">
                                            <i class="bi bi-shield-lock"></i>
                                            การยืนยันตัวตน 2FA
                                        </div>
                                        <div class="info-value">
                                            <?php if (isset($user_2fa_info) && $user_2fa_info && !empty($user_2fa_info->google2fa_secret) && $user_2fa_info->google2fa_enabled == 1): ?>
                                                <span class="status-badge status-active">
                                                    <i class="bi bi-shield-check"></i>เปิดใช้งาน
                                                </span>
                                            <?php else: ?>
                                                <span class="status-badge status-inactive">
                                                    <i class="bi bi-shield-x"></i>ปิดใช้งาน
                                                </span>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="info-item">
                                        <div class="info-label">
                                            <i class="bi bi-clock-history"></i>
                                            อัพเดทล่าสุด
                                        </div>
                                        <div class="info-value">
                                            <?php
                                            if (!empty($user_data->mp_updated_at)) {
                                                echo date('d/m/Y H:i', strtotime($user_data->mp_updated_at));
                                            } else {
                                                echo 'ไม่มีข้อมูล';
                                            }
                                            ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Google Authenticator (2FA) Section -->
                        <div class="section-card" id="security-section">
                            <div class="section-title">
                                <div class="title-left">
                                    <i class="bi bi-shield-check"></i>
                                    การยืนยันตัวตนแบบ 2 ขั้นตอน (Google Authenticator)
                                </div>
                            </div>

                            <?php if (!isset($user_2fa_info) || !$user_2fa_info || empty($user_2fa_info->google2fa_secret) || $user_2fa_info->google2fa_enabled == 0): ?>
                                <!-- 2FA Not Enabled -->
                                <div class="twofa-status twofa-disabled">
                                    <div class="d-flex align-items-center mb-3">
                                        <i class="bi bi-exclamation-triangle-fill me-3" style="font-size: 1.5rem;"></i>
                                        <div>
                                            <h5 class="mb-1">ยังไม่ได้เปิดใช้งาน 2FA</h5>
                                            <p class="mb-0">การยืนยันตัวตนแบบ 2
                                                ขั้นตอนจะช่วยเพิ่มความปลอดภัยให้กับบัญชีของคุณ</p>
                                        </div>
                                    </div>
                                    <div class="twofa-buttons">
                                        <button type="button" class="btn-2fa btn-enable-2fa" onclick="setup2FA()">
                                            <i class="bi bi-plus-circle"></i>
                                            เปิดใช้งาน 2FA
                                        </button>
                                        <button type="button" class="btn-2fa btn-info" onclick="show2FAInvitationAgain()"
                                            style="background: var(--info); color: white;">
                                            <i class="bi bi-info-circle"></i>
                                            ทำไมควรใช้ 2FA?
                                        </button>
                                    </div>
                                </div>
                            <?php else: ?>
                                <!-- 2FA Enabled -->
                                <div class="twofa-status twofa-enabled">
                                    <div class="d-flex align-items-center mb-3">
                                        <i class="bi bi-shield-check-fill me-3" style="font-size: 1.5rem;"></i>
                                        <div>
                                            <h5 class="mb-1">เปิดใช้งาน 2FA แล้ว</h5>
                                            <p class="mb-0">บัญชีของคุณได้รับการปกป้องด้วยการยืนยันตัวตนแบบ 2 ขั้นตอน</p>
                                            <?php if ($user_2fa_info->google2fa_setup_date): ?>
                                                <small class="text-muted">เปิดใช้งานเมื่อ:
                                                    <?php echo date('d/m/Y H:i', strtotime($user_2fa_info->google2fa_setup_date)); ?></small>
                                            <?php endif; ?>
                                        </div>
                                    </div>

                                    <div class="twofa-buttons">
                                        <button type="button" class="btn-2fa btn-regenerate-2fa" onclick="regenerate2FA()">
                                            <i class="bi bi-arrow-clockwise"></i>
                                            สร้างรหัสใหม่
                                        </button>
                                        <button type="button" class="btn-2fa btn-disable-2fa" onclick="disable2FA()">
                                            <i class="bi bi-x-circle"></i>
                                            ปิดใช้งาน 2FA
                                        </button>
                                    </div>
                                </div>
                            <?php endif; ?>

                            <!-- 2FA Info Box -->
                            <div class="alert alert-info mt-3" role="alert">
                                <h6 class="alert-heading">
                                    <i class="bi bi-info-circle me-2"></i>
                                    เกี่ยวกับ Google Authenticator
                                </h6>
                                <p class="mb-2">
                                    Google Authenticator เป็นแอปพลิเคชันที่ช่วยเพิ่มความปลอดภัยให้กับบัญชีของคุณ
                                    โดยสร้างรหัสยืนยัน 6 หลักที่เปลี่ยนแปลงทุก 30 วินาที ทำให้แม้จะมีคนรู้รหัสผ่านของคุณ
                                    ก็ไม่สามารถเข้าใช้งานได้หากไม่มีรหัสจากมือถือของคุณ
                                </p>
                                <p class="mb-0">
                                    <strong>💡 เทคนิค:</strong> คุณสามารถเพิ่มบัญชีเดียวกันในหลายอุปกรณ์ได้ เพื่อเป็น
                                    backup กรณีมือถือหลักสูญหาย
                                </p>
                            </div>
                        </div>



                        <!-- Account Management Section - เพิ่มหลังจาก 2FA Section -->
                        <div class="account-management-section">
                            <div class="section-title">
                                <div class="title-left">
                                    <i class="bi bi-shield-exclamation"></i>
                                    การจัดการบัญชี
                                </div>
                            </div>

                            <div class="alert alert-warning">
                                <h6 class="alert-heading">
                                    <i class="bi bi-exclamation-triangle me-2"></i>
                                    การลบบัญชีผู้ใช้
                                </h6>
                                <p class="mb-2">
                                    การลบบัญชีเป็นการกระทำที่ไม่สามารถย้อนกลับได้ ข้อมูลทั้งหมดจะถูกลบออกจากระบบถาวร
                                </p>
                                <ul class="mb-3">
                                    <li>ข้อมูลส่วนตัวทั้งหมดจะถูกลบ</li>
                                    <li>ประวัติการใช้งานจะถูกลบ</li>
                                    <li>ไม่สามารถกู้คืนข้อมูลได้</li>
                                    <?php if (isset($user_2fa_info) && $user_2fa_info && !empty($user_2fa_info->google2fa_secret) && $user_2fa_info->google2fa_enabled == 1): ?>
                                        <li><strong>จำเป็นต้องใช้รหัส 2FA เพื่อยืนยันการลบ</strong></li>
                                    <?php endif; ?>
                                </ul>
                                <p class="mb-0">
                                    <strong>หากคุณแน่ใจที่จะลบบัญชี กรุณาคลิกปุ่มด้านล่าง</strong>
                                </p>
                            </div>

                            <div class="text-center">
                                <button type="button" class="btn-delete-account" onclick="confirmDeleteAccount()">
                                    <i class="bi bi-trash3"></i>
                                    ลบบัญชีผู้ใช้ถาวร
                                </button>
                            </div>
                        </div>

                        <!-- Modal ยืนยันการลบบัญชี -->
                        <div class="modal fade" id="deleteAccountModal" tabindex="-1"
                            aria-labelledby="deleteAccountModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-lg">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="deleteAccountModalLabel">
                                            <i class="bi bi-exclamation-triangle"></i> ยืนยันการลบบัญชีผู้ใช้
                                        </h5>
                                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="alert alert-danger">
                                            <h6><strong>⚠️ คำเตือนสำคัญ!</strong></h6>
                                            <p class="mb-0">การลบบัญชีเป็นการกระทำที่ไม่สามารถย้อนกลับได้
                                                ข้อมูลทั้งหมดจะถูกลบออกจากระบบถาวร</p>
                                        </div>

                                        <h6>ข้อมูลที่จะถูกลบ:</h6>
                                        <ul class="mb-3">
                                            <li>ข้อมูลส่วนตัว:
                                                <?php echo $user_data->mp_prefix . ' ' . $user_data->mp_fname . ' ' . $user_data->mp_lname; ?>
                                            </li>
                                            <li>อีเมล: <?php echo $user_data->mp_email; ?></li>
                                            <li>เบอร์โทรศัพท์: <?php echo $user_data->mp_phone; ?></li>
                                            <?php if ($user_data->mp_number): ?>
                                                <li>เลขบัตรประชาชน: <?php echo $user_data->mp_number; ?></li>
                                            <?php endif; ?>
                                            <li>ประวัติการใช้งานทั้งหมด</li>
                                            <li>การตั้งค่า 2FA (หากมี)</li>
                                        </ul>

                                        <div class="mb-3">
                                            <label for="deletion_reason" class="form-label">เหตุผลในการลบบัญชี
                                                (ไม่บังคับ)</label>
                                            <textarea class="form-control" id="deletion_reason" rows="3"
                                                placeholder="กรุณาระบุเหตุผลในการลบบัญชี..."></textarea>
                                        </div>

                                        <?php if (isset($user_2fa_info) && $user_2fa_info && !empty($user_2fa_info->google2fa_secret) && $user_2fa_info->google2fa_enabled == 1): ?>
                                            <!-- ถ้าเปิด 2FA ให้ใส่รหัส -->
                                            <div class="alert alert-info">
                                                <h6><i class="bi bi-shield-check"></i> ยืนยันตัวตนด้วย 2FA</h6>
                                                <p class="mb-2">เนื่องจากคุณเปิดใช้งาน 2FA กรุณาใส่รหัส OTP
                                                    เพื่อยืนยันการลบบัญชี</p>
                                            </div>

                                            <div class="mb-3">
                                                <label for="delete_otp_code" class="form-label">รหัส OTP จาก Google
                                                    Authenticator</label>
                                                <input type="text" class="form-control form-control-lg text-center"
                                                    id="delete_otp_code" maxlength="6" placeholder="000000"
                                                    style="font-size: 1.5rem; letter-spacing: 0.3rem;" required>
                                                <small class="text-muted">กรอกรหัส 6 หลักจากแอป Google Authenticator</small>
                                            </div>
                                        <?php endif; ?>

                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" id="confirmDeletion"
                                                required>
                                            <label class="form-check-label" for="confirmDeletion">
                                                <strong>ฉันเข้าใจและยอมรับว่าการลบบัญชีนี้ไม่สามารถย้อนกลับได้</strong>
                                            </label>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                                            <i class="bi bi-x-circle"></i> ยกเลิก
                                        </button>
                                        <button type="button" class="btn btn-danger" id="confirmDeleteBtn"
                                            onclick="executeDeleteAccount()">
                                            <i class="bi bi-trash3"></i> ยืนยันการลบบัญชี
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>


                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal แจ้งเตือนเชิญชวนให้เปิดใช้งาน 2FA -->
    <div class="modal fade" id="invite2FAModal" tabindex="-1" aria-labelledby="invite2FAModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header bg-gradient text-white"
                    style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);">
                    <h5 class="modal-title" id="invite2FAModalLabel">
                        <i class="bi bi-shield-plus"></i> เพิ่มความปลอดภัยให้บัญชีของคุณ
                    </h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"
                        aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <!-- Hero Section -->
                    <div class="text-center mb-4">
                        <div class="d-inline-flex align-items-center justify-content-center bg-light rounded-circle"
                            style="width: 80px; height: 80px; margin-bottom: 20px;">
                            <i class="bi bi-shield-check" style="font-size: 2.5rem; color: var(--success);"></i>
                        </div>
                        <h4 class="text-dark mb-2">ยืนยันตัวตนปกป้องบัญชีของคุณด้วย 2FA</h4>
                        <p class="text-muted">การยืนยันตัวตนแบบ 2 ขั้นตอนเป็นชั้นความปลอดภัยเพิ่มเติมที่สำคัญมาก</p>
                    </div>

                    <!-- Benefits -->
                    <div class="row mb-4">
                        <div class="col-md-6">
                            <div class="d-flex align-items-start mb-3">
                                <div class="flex-shrink-0">
                                    <i class="bi bi-check-circle-fill text-success me-3" style="font-size: 1.5rem;"></i>
                                </div>
                                <div>
                                    <h6 class="mb-1">ความปลอดภัยสูงสุด</h6>
                                    <small class="text-muted">แม้มีคนรู้รหัสผ่าน
                                        ก็ไม่สามารถเข้าใช้งานได้หากไม่มีมือถือของคุณ</small>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="d-flex align-items-start mb-3">
                                <div class="flex-shrink-0">
                                    <i class="bi bi-clock-fill text-primary me-3" style="font-size: 1.5rem;"></i>
                                </div>
                                <div>
                                    <h6 class="mb-1">ใช้งานง่าย</h6>
                                    <small class="text-muted">แค่สแกน QR Code ครั้งเดียว ก็ใช้งานได้ทันที</small>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row mb-4">
                        <div class="col-md-6">
                            <div class="d-flex align-items-start mb-3">
                                <div class="flex-shrink-0">
                                    <i class="bi bi-phone-fill text-info me-3" style="font-size: 1.5rem;"></i>
                                </div>
                                <div>
                                    <h6 class="mb-1">ทำงานแบบออฟไลน์</h6>
                                    <small class="text-muted">ไม่ต้องการอินเทอร์เน็ต รหัสสร้างขึ้นในมือถือของคุณ</small>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="d-flex align-items-start mb-3">
                                <div class="flex-shrink-0">
                                    <i class="bi bi-key-fill text-warning me-3" style="font-size: 1.5rem;"></i>
                                </div>
                                <div>
                                    <h6 class="mb-1">มีรหัสสำรอง</h6>
                                    <small class="text-muted">กรณีมือถือหาย ยังมีรหัสสำรองให้ใช้งาน</small>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Warning Section -->
                    <div class="alert alert-warning">
                        <div class="d-flex align-items-center">
                            <i class="bi bi-exclamation-triangle-fill me-2"></i>
                            <div>
                                <strong>คุณรู้หรือไม่?</strong>
                                <p class="mb-0 mt-1">บัญชีที่ไม่มี 2FA มีความเสี่ยงสูงที่จะถูกแฮคกว่า <strong>สูงกว่า
                                        99% </strong> บัญชีท่านควรที่เปิดใช้งาน 2FA</p>
                            </div>
                        </div>
                    </div>

                    <!-- Steps Preview -->
                    <div class="bg-light rounded p-3 mb-4">
                        <h6 class="mb-3"><i class="bi bi-list-ol me-2"></i>ขั้นตอนการตั้งค่า (ใช้เวลาแค่ 2 นาที)</h6>
                        <div class="row">
                            <div class="col-4 text-center">
                                <div class="badge bg-primary rounded-circle mb-2"
                                    style="width: 30px; height: 30px; line-height: 18px;">1</div>
                                <small class="d-block">ติดตั้งแอป</small>
                            </div>
                            <div class="col-4 text-center">
                                <div class="badge bg-primary rounded-circle mb-2"
                                    style="width: 30px; height: 30px; line-height: 18px;">2</div>
                                <small class="d-block">สแกน QR Code</small>
                            </div>
                            <div class="col-4 text-center">
                                <div class="badge bg-primary rounded-circle mb-2"
                                    style="width: 30px; height: 30px; line-height: 18px;">3</div>
                                <small class="d-block">ยืนยันรหัส</small>
                            </div>
                        </div>
                    </div>

                    <!-- Don't show again option -->
                    <!-- <div class="form-check mb-3">
                    <input class="form-check-input" type="checkbox" id="dontShowAgain">
                    <label class="form-check-label text-muted" for="dontShowAgain">
                        ไม่ต้องแสดงข้อความนี้อีก (สามารถเปิดใช้งานได้ในภายหลัง)
                    </label>
                </div> -->
                </div>
                <div class="modal-footer justify-content-center">
                    <button type="button" class="btn btn-light me-3" data-bs-dismiss="modal"
                        onclick="handleDontShowAgain()">
                        <i class="bi bi-x-circle me-1"></i>ข้ามไปก่อน
                    </button>
                    <button type="button" class="btn btn-success btn-lg" onclick="startSetup2FAFromInvite()">
                        <i class="bi bi-shield-plus me-2"></i>เปิดใช้งาน 2FA เลย
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal สำหรับสร้างรหัส 2FA ใหม่ -->
    <div class="modal fade" id="regenerate2FAModal" tabindex="-1" aria-labelledby="regenerate2FAModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header bg-warning">
                    <h5 class="modal-title" id="regenerate2FAModalLabel">
                        <i class="bi bi-arrow-clockwise"></i> สร้างรหัส 2FA ใหม่
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="alert alert-warning">
                        <strong>คำเตือน!</strong> การสร้างรหัส 2FA ใหม่จะทำให้รหัสเก่าไม่สามารถใช้ได้อีกต่อไป
                    </div>
                    <p>คุณต้องการสร้างรหัส 2FA ใหม่หรือไม่? ซึ่งจะต้อง:</p>
                    <ul>
                        <li>ลบบัญชีเก่าออกจาก Google Authenticator ในทุกอุปกรณ์</li>
                        <li>สแกน QR Code ใหม่ในทุกอุปกรณ์</li>
                        <li>ยืนยันรหัส OTP ใหม่</li>
                    </ul>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">ยกเลิก</button>
                    <button type="button" class="btn btn-warning" onclick="confirmRegenerate2FA()">
                        <i class="bi bi-arrow-clockwise"></i> สร้างรหัสใหม่
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal สำหรับปิดใช้งาน 2FA -->
    <div class="modal fade" id="disable2FAModal" tabindex="-1" aria-labelledby="disable2FAModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header bg-danger text-white">
                    <h5 class="modal-title" id="disable2FAModalLabel">
                        <i class="bi bi-x-circle"></i> ปิดใช้งาน 2FA
                    </h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"
                        aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="alert alert-danger">
                        <strong>คำเตือน!</strong> การปิดใช้งาน 2FA จะลดระดับความปลอดภัยของบัญชีของคุณ
                    </div>
                    <p>เพื่อยืนยันการปิดใช้งาน กรุณาป้อนรหัส OTP จากแอป Google Authenticator</p>
                    <form id="disable2FAForm">
                        <div class="mb-3">
                            <label for="disable_otp_code" class="form-label">รหัส OTP</label>
                            <input type="text" class="form-control form-control-lg text-center" id="disable_otp_code"
                                name="otp" maxlength="6" placeholder="000000"
                                style="font-size: 1.5rem; letter-spacing: 0.3rem;" required>
                        </div>
                        <div class="d-grid gap-2">
                            <button type="submit" class="btn btn-danger btn-lg">
                                <i class="bi bi-shield-x me-2"></i>ปิดใช้งาน 2FA
                            </button>
                            <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
                                <i class="bi bi-x-circle me-2"></i>ยกเลิก
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

    </div>








    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        // Global variables
        let currentEditMode = null;
        let originalData = {};
        let invitationShown = false;

        // โหลดข้อมูลเมื่อหน้าโหลดเสร็จ
        document.addEventListener('DOMContentLoaded', function () {
            console.log('Document ready, initializing...');

            <?php if (!isset($user_2fa_info) || !$user_2fa_info || empty($user_2fa_info->google2fa_secret) || $user_2fa_info->google2fa_enabled == 0): ?>
                // แสดง modal เชิญชวนให้เปิด 2FA สำหรับผู้ใช้ที่ยังไม่เปิด
                setTimeout(function () {
                    show2FAInvitation();
                }, 1000);
            <?php endif; ?>

            // เพิ่ม event listener สำหรับ preview image
            const imageInput = document.getElementById('mp_img');
            if (imageInput) {
                imageInput.addEventListener('change', function () {
                    const fileInfo = document.getElementById('fileInfo');
                    if (this.files.length > 0) {
                        fileInfo.style.display = 'block';
                        fileInfo.innerHTML = `
                        <small class="text-info">
                            <i class="bi bi-file-image"></i> 
                            ไฟล์: ${this.files[0].name} (${formatFileSize(this.files[0].size)})
                        </small>
                    `;
                    } else {
                        fileInfo.style.display = 'none';
                    }
                });
            }
        });

        // ฟังก์ชันสำหรับ preview รูปภาพ
        function previewImageFile(input) {
            if (input.files && input.files[0]) {
                const reader = new FileReader();

                reader.onload = function (e) {
                    const previewImage = document.getElementById('previewImage');
                    if (previewImage) {
                        previewImage.src = e.target.result;
                    }
                }

                reader.readAsDataURL(input.files[0]);
            }
        }

        // ฟังก์ชันสร้าง Modal HTML ด้วย JavaScript
        function createInviteModal() {
            // ตรวจสอบว่ามี modal อยู่แล้วหรือไม่
            if (document.getElementById('invite2FAModal')) {
                console.log('Modal already exists');
                return true;
            }

            console.log('Modal already exists in HTML');
            return true;
        }

        // ฟังก์ชันแสดง modal เชิญชวนใช้ 2FA
        function show2FAInvitation() {
            try {
                // ตรวจสอบ Bootstrap
                if (typeof bootstrap === 'undefined') {
                    console.log('Bootstrap not loaded');
                    return;
                }

                // ตรวจสอบว่า user เคยเลือก "ไม่แสดงอีก" หรือไม่
                const dontShow = localStorage.getItem('2fa_invite_dont_show_<?php echo $user_data->mp_id; ?>');
                if (dontShow === 'true') {
                    console.log('User chose not to show invite again');
                    return;
                }

                // ตรวจสอบว่าเคยแสดงใน session นี้แล้วหรือไม่
                if (invitationShown) {
                    console.log('Invitation already shown in this session');
                    return;
                }

                // หา modal element
                const modalElement = document.getElementById('invite2FAModal');
                if (!modalElement) {
                    console.log('Modal element not found');
                    return;
                }

                try {
                    // สร้าง Bootstrap modal instance
                    const modal = new bootstrap.Modal(modalElement, {
                        backdrop: 'static',
                        keyboard: false
                    });

                    // แสดง modal
                    modal.show();
                    invitationShown = true;
                    console.log('2FA invitation modal shown');

                } catch (modalError) {
                    console.error('Error creating Bootstrap modal:', modalError);
                }

            } catch (error) {
                console.error('Error showing 2FA invitation:', error);
            }
        }

        function handleDontShowAgain() {
            try {
                const checkbox = document.getElementById('dontShowAgain');

                if (checkbox && checkbox.checked) {
                    // บันทึกการตั้งค่าใน localStorage
                    localStorage.setItem('2fa_invite_dont_show_<?php echo $user_data->mp_id; ?>', 'true');
                }

                // ปิด modal
                const modalElement = document.getElementById('invite2FAModal');
                if (modalElement) {
                    const modal = bootstrap.Modal.getInstance(modalElement);
                    if (modal) {
                        modal.hide();
                    }
                }
            } catch (error) {
                console.error('Error in handleDontShowAgain:', error);
            }
        }

        // ฟังก์ชันเริ่มต้นการตั้งค่า 2FA จาก modal เชิญชวน
        function startSetup2FAFromInvite() {
            try {
                // ปิด modal เชิญชวน
                const modalElement = document.getElementById('invite2FAModal');
                if (modalElement) {
                    const inviteModal = bootstrap.Modal.getInstance(modalElement);
                    if (inviteModal) {
                        inviteModal.hide();
                    }
                }

                // เริ่มต้นการตั้งค่า 2FA
                setTimeout(() => {
                    setup2FA();
                }, 500);

            } catch (error) {
                console.error('Error in startSetup2FAFromInvite:', error);
            }
        }

        // เพิ่มปุ่มใน section 2FA disabled เพื่อแสดง modal เชิญชวนอีกครั้ง
        function show2FAInvitationAgain() {
            try {
                invitationShown = false;
                show2FAInvitation();
            } catch (error) {
                console.error('Error in show2FAInvitationAgain:', error);
            }
        }

        // ฟังก์ชันสำหรับโหลดข้อมูลที่อยู่เดิมเมื่อเข้า Edit Mode
        function loadExistingAddressData() {
            console.log('Loading existing address data...');

            // ดึงข้อมูลเดิมจาก hidden fields
            const existingZipcode = document.getElementById('edit_zipcode_hidden')?.value || '';
            const existingProvince = document.getElementById('edit_province_hidden')?.value || '';
            const existingAmphoe = document.getElementById('edit_amphoe_hidden')?.value || '';
            const existingDistrict = document.getElementById('edit_district_hidden')?.value || '';

            console.log('Existing address data:', {
                zipcode: existingZipcode,
                province: existingProvince,
                amphoe: existingAmphoe,
                district: existingDistrict
            });

            // ถ้ามีรหัสไปรษณีย์ ให้ค้นหาข้อมูลจาก API
            if (existingZipcode && existingZipcode.length === 5) {
                document.getElementById('edit_zipcode').value = existingZipcode;
                searchByZipcodeAndSetExisting(existingZipcode, existingProvince, existingAmphoe, existingDistrict);
            }
            // ถ้าไม่มีรหัสไปรษณีย์ แต่มีข้อมูลที่อยู่ ให้ใส่แบบ manual
            else if (existingProvince || existingAmphoe || existingDistrict) {
                loadAllProvinces();
                setTimeout(() => {
                    setManualAddressData(existingProvince, existingAmphoe, existingDistrict);
                }, 500);
            }
            // ถ้าไม่มีข้อมูลเลย ให้โหลด provinces ปกติ
            else {
                loadAllProvinces();
            }
        }

        // ฟังก์ชันค้นหาจากรหัสไปรษณีย์และ set ข้อมูลที่มีอยู่
        async function searchByZipcodeAndSetExisting(zipcode, existingProvince, existingAmphoe, existingDistrict) {
            console.log('Searching by zipcode and setting existing data...');
            showAddressLoading(true);

            try {
                const response = await fetch(`${API_BASE_URL}/address/${zipcode}`);
                const data = await response.json();

                if (data.status === 'success' && data.data.length > 0) {
                    const dataWithZipcode = data.data.map(item => ({
                        ...item,
                        zipcode: zipcode,
                        searched_zipcode: zipcode
                    }));

                    currentAddressData = dataWithZipcode;
                    populateFieldsFromZipcode(dataWithZipcode);

                    // รอให้ populate เสร็จแล้วค่อย set ค่าเดิม
                    setTimeout(() => {
                        setExistingSelections(existingAmphoe, existingDistrict);
                    }, 300);

                } else {
                    // ถ้าไม่พบจากรหัสไปรษณีย์ ให้ใส่แบบ manual
                    console.log('Zipcode not found in API, setting manual data...');
                    loadAllProvinces();
                    setTimeout(() => {
                        setManualAddressData(existingProvince, existingAmphoe, existingDistrict);
                    }, 500);
                }
            } catch (error) {
                console.error('Error searching zipcode:', error);
                // ถ้า error ให้ใส่แบบ manual
                loadAllProvinces();
                setTimeout(() => {
                    setManualAddressData(existingProvince, existingAmphoe, existingDistrict);
                }, 500);
            } finally {
                showAddressLoading(false);
            }
        }

        // ฟังก์ชันสำหรับ set ข้อมูลที่อยู่แบบ manual (กรณีไม่มีรหัสไปรษณีย์หรือไม่พบใน API)
        function setManualAddressData(province, amphoe, district) {
            console.log('Setting manual address data:', { province, amphoe, district });

            // Set จังหวัด
            if (province) {
                convertToProvinceInput(province);
            }

            // ถ้ามีอำเภอและตำบล ให้สร้าง option แบบ manual
            if (amphoe && district) {
                const amphoeField = document.getElementById('edit_amphoe_field');
                const districtField = document.getElementById('edit_district_field');

                if (amphoeField && districtField) {
                    // สร้าง option สำหรับอำเภอ
                    amphoeField.innerHTML = `
                <option value="">เลือกอำเภอ</option>
                <option value="existing_amphoe" selected>${amphoe}</option>
            `;
                    amphoeField.disabled = false;

                    // สร้าง option สำหรับตำบล
                    districtField.innerHTML = `
                <option value="">เลือกตำบล</option>
                <option value="existing_district" selected>${district}</option>
            `;
                    districtField.disabled = false;

                    console.log('Manual address data set successfully');
                }
            }

            updateAddressData();
        }

        // ฟังก์ชันสำหรับ set ค่าที่เลือกไว้เดิม (กรณีพบจาก API)
        function setExistingSelections(existingAmphoe, existingDistrict) {
            console.log('Setting existing selections:', { existingAmphoe, existingDistrict });

            const amphoeField = document.getElementById('edit_amphoe_field');
            const districtField = document.getElementById('edit_district_field');

            // หา option ที่ตรงกับอำเภอเดิม
            if (existingAmphoe && amphoeField) {
                const amphoeOptions = amphoeField.querySelectorAll('option');
                for (let option of amphoeOptions) {
                    if (option.textContent.trim() === existingAmphoe.trim()) {
                        amphoeField.value = option.value;
                        console.log('Found matching amphoe:', existingAmphoe);

                        // Trigger change event เพื่อโหลดตำบล
                        amphoeField.dispatchEvent(new Event('change'));
                        break;
                    }
                }
            }

            // รอให้ตำบลโหลดเสร็จแล้วค่อย set
            setTimeout(() => {
                if (existingDistrict && districtField) {
                    const districtOptions = districtField.querySelectorAll('option');
                    for (let option of districtOptions) {
                        if (option.textContent.trim() === existingDistrict.trim()) {
                            districtField.value = option.value;
                            console.log('Found matching district:', existingDistrict);

                            // Trigger change event
                            districtField.dispatchEvent(new Event('change'));
                            break;
                        }
                    }
                }
            }, 500);
        }

        // แก้ไขฟังก์ชัน toggleEditMode เพื่อโหลดข้อมูลเดิม
        function toggleEditMode(section) {
            console.log('Toggling edit mode for section:', section);

            if (currentEditMode && currentEditMode !== section) {
                showAlert('กรุณาบันทึกหรือยกเลิกการแก้ไขส่วนปัจจุบันก่อน', 'warning');
                return;
            }

            if (currentEditMode === section) {
                cancelEdit(section);
                return;
            }

            // เก็บข้อมูลเดิมไว้
            storeOriginalData(section);

            // เปลี่ยนเป็นโหมดแก้ไข
            const viewMode = document.getElementById(section + 'ViewMode');
            const editMode = document.getElementById(section + 'EditMode');
            const editBtn = document.getElementById(section + 'EditBtn');

            if (viewMode && editMode && editBtn) {
                viewMode.style.display = 'none';
                editMode.style.display = 'block';
                editBtn.innerHTML = '<i class="bi bi-x"></i> ยกเลิก';

                currentEditMode = section;

                // *** เพิ่มการโหลดข้อมูลที่อยู่เดิมสำหรับ basic section ***
                if (section === 'basic') {
                    console.log('Loading existing address data for basic edit mode...');
                    setTimeout(() => {
                        loadExistingAddressData();
                    }, 100);
                }

                console.log('Edit mode activated for:', section);
            } else {
                console.error('Required elements not found for section:', section);
            }
        }

        function cancelEdit(section) {
            console.log('Cancelling edit for section:', section);

            // คืนข้อมูลเดิม
            restoreOriginalData(section);

            // เปลี่ยนกลับเป็นโหมดดู
            const viewMode = document.getElementById(section + 'ViewMode');
            const editMode = document.getElementById(section + 'EditMode');
            const editBtn = document.getElementById(section + 'EditBtn');

            if (viewMode && editMode && editBtn) {
                viewMode.style.display = 'block';
                editMode.style.display = 'none';
                editBtn.innerHTML = '<i class="bi bi-pencil"></i> แก้ไข';
            }

            currentEditMode = null;

            // รีเซ็ตฟอร์ม
            if (section === 'password') {
                const passwordForm = document.getElementById('passwordForm');
                if (passwordForm) {
                    passwordForm.reset();
                }
            } else if (section === 'image') {
                // รีเซ็ตรูปภาพ preview
                const previewImg = document.getElementById('previewImage');
                const currentImg = document.getElementById('currentImageDisplay');
                if (previewImg && currentImg) {
                    previewImg.src = currentImg.src;
                }
                const imageForm = document.getElementById('imageForm');
                if (imageForm) {
                    imageForm.reset();
                }
            }
        }

        function storeOriginalData(section) {
            if (section === 'basic') {
                const emailEl = document.getElementById('display_email');
                const prefixEl = document.getElementById('display_prefix');
                const fnameEl = document.getElementById('display_fname');
                const lnameEl = document.getElementById('display_lname');
                const phoneEl = document.getElementById('display_phone');
                const numberEl = document.getElementById('display_number');
                const addressEl = document.getElementById('display_address');

                if (emailEl && prefixEl && fnameEl && lnameEl && phoneEl && numberEl && addressEl) {
                    originalData.basic = {
                        email: emailEl.textContent,
                        prefix: prefixEl.textContent,
                        fname: fnameEl.textContent,
                        lname: lnameEl.textContent,
                        phone: phoneEl.textContent,
                        number: numberEl.textContent,
                        address: addressEl.textContent
                    };
                }
            } else if (section === 'image') {
                const currentImg = document.getElementById('currentImageDisplay');
                if (currentImg) {
                    originalData.image = {
                        src: currentImg.src
                    };
                }
            }
        }

        function restoreOriginalData(section) {
            if (section === 'basic' && originalData.basic) {
                const editEmail = document.getElementById('edit_email');
                const editPrefix = document.getElementById('edit_prefix');
                const editFname = document.getElementById('edit_fname');
                const editLname = document.getElementById('edit_lname');
                const editPhone = document.getElementById('edit_phone');
                const editNumber = document.getElementById('edit_number');
                const editAddress = document.getElementById('edit_address');

                if (editEmail) editEmail.value = originalData.basic.email;
                if (editPrefix) editPrefix.value = originalData.basic.prefix;
                if (editFname) editFname.value = originalData.basic.fname;
                if (editLname) editLname.value = originalData.basic.lname;
                if (editPhone) editPhone.value = originalData.basic.phone;
                if (editNumber) editNumber.value = originalData.basic.number;
                if (editAddress) editAddress.value = originalData.basic.address;
            } else if (section === 'image' && originalData.image) {
                const previewImg = document.getElementById('previewImage');
                if (previewImg) {
                    previewImg.src = originalData.image.src;
                }
            }
        }

        // ฟังก์ชันสำหรับแสดง alert
        function showAlert(message, type = 'info', timeout = 5000) {
            const alertContainer = document.getElementById('alertContainer');
            if (!alertContainer) {
                console.error('Alert container not found');
                return;
            }

            const alertId = 'alert_' + Date.now();

            const alertHTML = `
            <div class="alert alert-${type} alert-dismissible fade show" id="${alertId}" role="alert">
                <i class="bi bi-${getAlertIcon(type)} me-2"></i>
                <div class="alert-content">
                    ${message}
                </div>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        `;

            alertContainer.insertAdjacentHTML('beforeend', alertHTML);

            if (timeout > 0) {
                setTimeout(() => {
                    const alert = document.getElementById(alertId);
                    if (alert) {
                        const bsAlert = new bootstrap.Alert(alert);
                        bsAlert.close();
                    }
                }, timeout);
            }
        }

        function getAlertIcon(type) {
            switch (type) {
                case 'success': return 'check-circle-fill';
                case 'danger': return 'exclamation-triangle-fill';
                case 'warning': return 'exclamation-triangle-fill';
                case 'info': return 'info-circle-fill';
                default: return 'info-circle-fill';
            }
        }

        // ฟังก์ชันสำหรับจัดการ loading state
        function setLoading(button, isLoading) {
            const btnText = button.querySelector('.btn-text');
            const btnIcon = button.querySelector('i');

            if (isLoading) {
                button.disabled = true;
                button.classList.add('loading');
                if (btnText) btnText.textContent = 'กำลังบันทึก...';
                if (btnIcon) {
                    btnIcon.className = 'spinner-border spinner-border-sm';
                }
            } else {
                button.disabled = false;
                button.classList.remove('loading');
                if (btnText) btnText.textContent = btnText.getAttribute('data-original') || 'บันทึก';
                if (btnIcon) {
                    btnIcon.className = 'bi bi-check-circle';
                }
            }
        }

        // ฟังก์ชันสำหรับบันทึกรูปภาพ
        function saveImage() {
            console.log('Saving image...');

            const button = event.target.closest('.btn-modern');
            const formData = new FormData();
            const fileInput = document.getElementById('mp_img');

            if (!fileInput || !fileInput.files[0]) {
                showAlert('กรุณาเลือกรูปภาพก่อน', 'warning');
                return;
            }

            // ตรวจสอบขนาดไฟล์ (5MB)
            if (fileInput.files[0].size > 5 * 1024 * 1024) {
                showAlert('ไฟล์รูปภาพต้องมีขนาดไม่เกิน 5MB', 'danger');
                return;
            }

            formData.append('mp_img', fileInput.files[0]);
            formData.append('mp_id', '<?php echo $user_data->mp_id; ?>');

            setLoading(button, true);

            fetch('<?php echo site_url("Auth_public_mem/profile"); ?>', {
                method: 'POST',
                headers: {
                    'X-Requested-With': 'XMLHttpRequest'
                },
                body: formData
            })
                .then(response => {
                    if (!response.ok) {
                        throw new Error('Network response was not ok');
                    }
                    return response.json();
                })
                .then(data => {
                    setLoading(button, false);

                    if (data.success) {
                        // อัพเดทรูปภาพใน UI ด้วย path ใหม่
                        if (data.profile && data.profile.mp_img) {
                            const imageUrl = '<?php echo base_url("docs/img/avatar/"); ?>' + data.profile.mp_img + '?t=' + Date.now();
                            document.getElementById('currentImageDisplay').src = imageUrl;

                            // อัปเดตรูป preview ด้วย
                            const previewImg = document.getElementById('previewImage');
                            if (previewImg) {
                                previewImg.src = imageUrl;
                            }
                        }

                        showAlert('อัพเดทรูปภาพสำเร็จ!', 'success');
                        cancelEdit('image');
                    } else {
                        showAlert('เกิดข้อผิดพลาด: ' + (data.message || 'ไม่สามารถอัพเดทรูปภาพได้'), 'danger');
                    }
                })



                .catch(error => {
                    setLoading(button, false);
                    console.error('Error:', error);
                    showAlert('เกิดข้อผิดพลาดในการเชื่อมต่อ: ' + error.message, 'danger');
                });
        }

        // ฟังก์ชันแปลงขนาดไฟล์เป็นรูปแบบที่อ่านง่าย
        function formatFileSize(bytes) {
            if (bytes === 0) return '0 Bytes';

            const k = 1024;
            const sizes = ['Bytes', 'KB', 'MB', 'GB'];
            const i = Math.floor(Math.log(bytes) / Math.log(k));

            return parseFloat((bytes / Math.pow(k, i)).toFixed(2)) + ' ' + sizes[i];
        }

        // ฟังก์ชันสำหรับบันทึกข้อมูลพื้นฐาน
        function saveBasicInfo() {
            console.log('Saving basic info...');

            const button = event.target.closest('.btn-modern');
            const form = document.getElementById('basicInfoForm');

            if (!form) {
                showAlert('ไม่พบฟอร์มข้อมูลพื้นฐาน', 'danger');
                return;
            }

            const formData = new FormData(form);

            // Validation
            const requiredFields = ['mp_prefix', 'mp_fname', 'mp_lname', 'mp_address'];
            for (let field of requiredFields) {
                if (!formData.get(field)) {
                    showAlert('กรุณากรอกข้อมูลให้ครบถ้วน', 'warning');
                    return;
                }
            }

            // Phone validation
            const phone = formData.get('mp_phone');
            if (phone && phone.length !== 10) {
                showAlert('เบอร์โทรศัพท์ต้องมี 10 หลัก', 'warning');
                return;
            }

            setLoading(button, true);

            fetch('<?php echo site_url("Auth_public_mem/profile"); ?>', {
                method: 'POST',
                headers: {
                    'X-Requested-With': 'XMLHttpRequest'
                },
                body: formData
            })
                .then(response => {
                    if (!response.ok) {
                        throw new Error('Network response was not ok');
                    }
                    return response.json();
                })
                .then(data => {
                    setLoading(button, false);

                    if (data.success) {
                        // อัพเดทข้อมูลใน UI
                        const displayEmail = document.getElementById('display_email');
                        const displayPrefix = document.getElementById('display_prefix');
                        const displayFname = document.getElementById('display_fname');
                        const displayLname = document.getElementById('display_lname');
                        const displayPhone = document.getElementById('display_phone');
                        const displayNumber = document.getElementById('display_number');
                        const displayAddress = document.getElementById('display_address');

                        if (displayEmail) displayEmail.textContent = data.profile.mp_email;
                        if (displayPrefix) displayPrefix.textContent = data.profile.mp_prefix;
                        if (displayFname) displayFname.textContent = data.profile.mp_fname;
                        if (displayLname) displayLname.textContent = data.profile.mp_lname;
                        if (displayPhone) displayPhone.textContent = data.profile.mp_phone || '-';
                        if (displayNumber) displayNumber.textContent = data.profile.mp_number || '-';
                        if (displayAddress) displayAddress.textContent = data.profile.mp_address || '-';

                        showAlert('อัพเดทข้อมูลสำเร็จ!', 'success');
                        cancelEdit('basic');
                    } else {
                        showAlert('เกิดข้อผิดพลาด: ' + (data.message || 'ไม่สามารถอัพเดทข้อมูลได้'), 'danger');
                    }
                })
                .catch(error => {
                    setLoading(button, false);
                    console.error('Error:', error);
                    showAlert('เกิดข้อผิดพลาดในการเชื่อมต่อ: ' + error.message, 'danger');
                });
        }

        // ฟังก์ชันสำหรับเปลี่ยนรหัสผ่าน
        function savePassword() {
            console.log('Saving password...');

            const button = event.target.closest('.btn-modern');
            const newPassword = document.getElementById('new_password').value;
            const confirmPassword = document.getElementById('confirm_password').value;

            // Validation
            if (!newPassword || !confirmPassword) {
                showAlert('กรุณากรอกรหัสผ่านให้ครบถ้วน', 'warning');
                return;
            }

            if (newPassword.length < 6) {
                showAlert('รหัสผ่านต้องมีอย่างน้อย 6 ตัวอักษร', 'warning');
                return;
            }

            if (newPassword !== confirmPassword) {
                showAlert('รหัสผ่านไม่ตรงกัน', 'warning');
                return;
            }

            const formData = new FormData();
            formData.append('mp_id', '<?php echo $user_data->mp_id; ?>');
            formData.append('mp_password', newPassword);
            formData.append('confirmp_password', confirmPassword);

            setLoading(button, true);

            fetch('<?php echo site_url("Auth_public_mem/profile"); ?>', {
                method: 'POST',
                headers: {
                    'X-Requested-With': 'XMLHttpRequest'
                },
                body: formData
            })
                .then(response => {
                    if (!response.ok) {
                        throw new Error('Network response was not ok');
                    }
                    return response.json();
                })
                .then(data => {
                    setLoading(button, false);

                    if (data.success) {
                        showAlert('เปลี่ยนรหัสผ่านสำเร็จ!', 'success');
                        cancelEdit('password');
                    } else {
                        showAlert('เกิดข้อผิดพลาด: ' + (data.message || 'ไม่สามารถเปลี่ยนรหัสผ่านได้'), 'danger');
                    }
                })
                .catch(error => {
                    setLoading(button, false);
                    console.error('Error:', error);
                    showAlert('เกิดข้อผิดพลาดในการเชื่อมต่อ: ' + error.message, 'danger');
                });
        }

        // ฟังก์ชันสำหรับ toggle รหัสผ่าน
        function togglePassword(fieldId) {
            const field = document.getElementById(fieldId);
            const icon = document.getElementById('toggleIcon_' + fieldId);

            if (field && icon) {
                if (field.type === 'password') {
                    field.type = 'text';
                    icon.className = 'bi bi-eye-slash';
                } else {
                    field.type = 'password';
                    icon.className = 'bi bi-eye';
                }
            }
        }

        // ฟังก์ชัน 2FA - Setup
        function setup2FA() {
            console.log('Starting 2FA setup...');

            const existingModal = document.getElementById('setup2FAModal');
            if (existingModal) {
                existingModal.remove();
            }

            const modalHTML = `
        <div class="modal fade" id="setup2FAModal" tabindex="-1" style="z-index: 99999 !important;">
            <div class="modal-dialog modal-lg" style="z-index: 100000 !important;">
                <div class="modal-content" style="z-index: 100001 !important;">
                    <div class="modal-header bg-success text-white">
                        <h5 class="modal-title">
                            <i class="bi bi-shield-check"></i> ตั้งค่า Google Authenticator
                        </h5>
                        <button type="button" class="btn-close btn-close-white" onclick="closeModal()"></button>
                    </div>
                    <div class="modal-body">
                        <div id="step1" class="setup-step">
                            <h6><i class="bi bi-1-circle"></i> ขั้นตอนที่ 1: ติดตั้งแอป Google Authenticator</h6>
                            <div class="row text-center mb-3">
                                <div class="col-md-6">
                                    <div class="card h-100">
                                        <div class="card-body">
                                            <i class="bi bi-apple" style="font-size: 3rem; color: #007aff;"></i>
                                            <h6>iOS</h6>
                                            <a href="https://apps.apple.com/app/google-authenticator/id388497605" target="_blank" class="btn btn-primary btn-sm">Download</a>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="card h-100">
                                        <div class="card-body">
                                            <i class="bi bi-google-play" style="font-size: 3rem; color: #34a853;"></i>
                                            <h6>Android</h6>
                                            <a href="https://play.google.com/store/apps/details?id=com.google.android.apps.authenticator2" target="_blank" class="btn btn-success btn-sm">Download</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="text-center">
                                <button type="button" class="btn btn-primary" onclick="nextStep(2)">ติดตั้งแล้ว ไปขั้นตอนถัดไป</button>
                            </div>
                        </div>

                        <div id="step2" class="setup-step" style="display: none;">
                            <h6><i class="bi bi-2-circle"></i> ขั้นตอนที่ 2: สแกน QR Code</h6>
                            <div class="text-center mb-3">
                                <div id="qrCodeContainer">
                                    <div class="text-center">
                                        <div class="spinner-border text-primary" role="status">
                                            <span class="visually-hidden">กำลังโหลด...</span>
                                        </div>
                                        <p class="mt-2">กำลังสร้าง QR Code...</p>
                                    </div>
                                </div>
                            </div>
                            <div class="alert alert-info">
                                <strong>วิธีการ:</strong>
                                <ol>
                                    <li>เปิดแอป Google Authenticator</li>
                                    <li>แตะเครื่องหมาย + เพื่อเพิ่มบัญชี</li>
                                    <li>เลือก "สแกน QR Code"</li>
                                    <li>สแกน QR Code ด้านบน</li>
                                </ol>
                            </div>
                            <div class="text-center">
                                <button type="button" class="btn btn-secondary" onclick="nextStep(1)">ย้อนกลับ</button>
                                <button type="button" class="btn btn-primary" onclick="nextStep(3)">สแกนแล้ว ไปขั้นตอนถัดไป</button>
                            </div>
                        </div>

                        <div id="step3" class="setup-step" style="display: none;">
                            <h6><i class="bi bi-3-circle"></i> ขั้นตอนที่ 3: ยืนยันรหัส OTP</h6>
                            <div class="alert alert-warning">
                                กรอกรหัส 6 หลักจากแอป Google Authenticator เพื่อยืนยันการตั้งค่า
                            </div>
                            <div class="row justify-content-center">
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label class="form-label">รหัส OTP (6 หลัก)</label>
                                        <input type="text" class="form-control text-center" id="setupOTP" maxlength="6" pattern="\\d{6}" placeholder="000000">
                                    </div>
                                </div>
                            </div>
                            <div class="text-center">
                                <button type="button" class="btn btn-secondary" onclick="nextStep(2)">ย้อนกลับ</button>
                                <button type="button" class="btn btn-success" onclick="verify2FASetup()">
                                    <i class="bi bi-check-circle"></i> ยืนยันและเปิดใช้งาน
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        `;

            document.body.insertAdjacentHTML('beforeend', modalHTML);

            const modal = new bootstrap.Modal(document.getElementById('setup2FAModal'), {
                backdrop: 'static',
                keyboard: false
            });
            modal.show();

            setTimeout(() => {
                nextStep(1);
                generateQRCode();
            }, 500);
        }

        function closeModal() {
            const modal = bootstrap.Modal.getInstance(document.getElementById('setup2FAModal'));
            if (modal) {
                modal.hide();
            }
            setTimeout(() => {
                const modalElement = document.getElementById('setup2FAModal');
                if (modalElement) {
                    modalElement.remove();
                }
            }, 300);
        }

        function generateQRCode() {
            const qrContainer = document.getElementById('qrCodeContainer');

            if (!qrContainer) {
                console.error('QR Container not found');
                return;
            }

            // แสดง loading
            qrContainer.innerHTML = `
        <div class="text-center">
            <div class="spinner-border text-primary" role="status">
                <span class="visually-hidden">กำลังโหลด...</span>
            </div>
            <p class="mt-2">กำลังสร้าง QR Code...</p>
        </div>
    `;

            console.log('Starting QR code generation...');

            fetch('<?php echo site_url("Auth_public_mem/setup_2fa"); ?>', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded',
                    'X-Requested-With': 'XMLHttpRequest'
                },
                body: 'action=enable_2fa'
            })
                .then(response => {
                    console.log('Response status:', response.status);

                    // ตรวจสอบ Content-Type
                    const contentType = response.headers.get('content-type');
                    console.log('Content-Type:', contentType);

                    if (!response.ok) {
                        throw new Error(`HTTP error! status: ${response.status}`);
                    }

                    // ตรวจสอบว่าเป็น JSON จริงหรือไม่
                    if (contentType && contentType.includes('application/json')) {
                        return response.json();
                    } else {
                        // ถ้าไม่ใช่ JSON ให้ดู response text
                        return response.text().then(text => {
                            console.error('Expected JSON but got:', text.substring(0, 500));
                            throw new Error('Server ส่งข้อมูลที่ไม่ใช่ JSON กลับมา กรุณาตรวจสอบ PHP errors');
                        });
                    }
                })
                .then(data => {
                    console.log('Parsed response data:', data);

                    if (data.status === 'success') {
                        qrContainer.innerHTML = `
                <div class="text-center">
                    <img src="${data.qr_code_url}" alt="QR Code" class="img-fluid" style="max-width: 200px;" />
                    <p class="mt-2">
                        <small class="text-muted">หรือใส่รหัสนี้ด้วยตนเอง:</small><br>
                        <strong class="text-primary">${data.secret}</strong>
                    </p>
                    <!-- เพิ่ม hidden input เพื่อเก็บ secret -->
                    <input type="hidden" id="hiddenSecret" value="${data.secret}">
                </div>
            `;

                        // เก็บ secret สำหรับใช้ในการ verify (2 วิธี เพื่อความแน่ใจ)
                        window.tempSecret = data.secret;

                        console.log('Secret stored:', data.secret);

                    } else {
                        throw new Error(data.message || 'เกิดข้อผิดพลาดที่ไม่ทราบสาเหตุ');
                    }
                })
                .catch(error => {
                    console.error('Error in generateQRCode:', error);

                    qrContainer.innerHTML = `
            <div class="alert alert-danger">
                <h6><i class="bi bi-exclamation-triangle"></i> เกิดข้อผิดพลาด</h6>
                <p class="mb-2">${error.message}</p>
                <button class="btn btn-sm btn-outline-danger mt-2" onclick="generateQRCode()">
                    <i class="bi bi-arrow-clockwise"></i> ลองใหม่อีกครั้ง
                </button>
            </div>
        `;

                    // แสดง error alert ด้วย
                    if (typeof showAlert === 'function') {
                        showAlert('เกิดข้อผิดพลาดในการสร้าง QR Code: ' + error.message, 'danger');
                    }
                });
        }

        function nextStep(step) {
            document.querySelectorAll('.setup-step').forEach(el => el.style.display = 'none');
            const targetStep = document.getElementById('step' + step);
            if (targetStep) {
                targetStep.style.display = 'block';
            }
        }

        function verify2FASetup() {
            const otp = document.getElementById('setupOTP').value;

            if (otp.length !== 6) {
                showAlert('กรุณากรอกรหัส OTP 6 หลัก', 'warning');
                return;
            }

            // ตรวจสอบ secret (ลองหลายวิธี)
            let secret = window.tempSecret;

            // ถ้าไม่มีใน window.tempSecret ให้ลองหาจาก hidden input
            if (!secret) {
                const hiddenSecret = document.getElementById('hiddenSecret');
                if (hiddenSecret) {
                    secret = hiddenSecret.value;
                }
            }

            if (!secret) {
                showAlert('เกิดข้อผิดพลาด: ไม่พบ secret กรุณาเริ่มต้นใหม่', 'danger');
                console.error('Secret not found! window.tempSecret:', window.tempSecret);
                return;
            }

            console.log('Verifying OTP with secret:', secret);

            // แสดงสถานะกำลังประมวลผล
            const submitBtn = event.target;
            const originalText = submitBtn.innerHTML;
            submitBtn.innerHTML = '<i class="bi bi-hourglass-split me-2"></i>กำลังตรวจสอบ...';
            submitBtn.disabled = true;

            // เตรียมข้อมูลที่จะส่ง
            const formData = new FormData();
            formData.append('action', 'verify_setup');
            formData.append('otp', otp);
            formData.append('secret', secret);  // *** สำคัญ: ส่ง secret ไปด้วย ***

            fetch('<?php echo site_url("Auth_public_mem/setup_2fa"); ?>', {
                method: 'POST',
                headers: {
                    'X-Requested-With': 'XMLHttpRequest'
                },
                body: formData  // ใช้ FormData แทนการ encode manual
            })
                .then(response => {
                    if (!response.ok) {
                        throw new Error(`HTTP error! status: ${response.status}`);
                    }
                    return response.json();
                })
                .then(data => {
                    console.log('Verification response:', data);

                    if (data.status === 'success') {
                        showAlert('เปิดใช้งาน 2FA สำเร็จ!', 'success');
                        closeModal();
                        setTimeout(() => {
                            location.reload();
                        }, 1500);
                    } else {
                        showAlert(data.message || 'รหัส OTP ไม่ถูกต้อง กรุณาลองใหม่', 'danger');

                        // คืนค่าปุ่มกลับสู่สถานะเดิม
                        submitBtn.innerHTML = originalText;
                        submitBtn.disabled = false;

                        // เลือกข้อความใน input OTP เพื่อให้ผู้ใช้พิมพ์ใหม่ได้ง่าย
                        document.getElementById('setupOTP').select();
                    }
                })
                .catch(error => {
                    console.error('Verify error:', error);
                    showAlert('เกิดข้อผิดพลาดในการเชื่อมต่อ: ' + error.message, 'danger');

                    // คืนค่าปุ่มกลับสู่สถานะเดิม
                    submitBtn.innerHTML = originalText;
                    submitBtn.disabled = false;
                });
        }

        // ===== เพิ่มฟังก์ชันช่วยสำหรับ debug =====
        function debugSecret() {
            console.log('=== Debug Secret Information ===');
            console.log('window.tempSecret:', window.tempSecret);

            const hiddenSecret = document.getElementById('hiddenSecret');
            console.log('Hidden input secret:', hiddenSecret ? hiddenSecret.value : 'not found');

            const qrContainer = document.getElementById('qrCodeContainer');
            if (qrContainer) {
                console.log('QR Container HTML:', qrContainer.innerHTML.substring(0, 200) + '...');
            }
            console.log('=================================');
        }

        // ===== เพิ่มการจัดการ Input OTP (รับเฉพาะตัวเลข และ auto-submit เมื่อครบ 6 หลัก) =====
        document.addEventListener('DOMContentLoaded', function () {
            // รอให้ modal ถูกสร้างแล้วค่อยเพิ่ม event listener
            setTimeout(function () {
                const setupOTPInput = document.getElementById('setupOTP');

                if (setupOTPInput) {
                    setupOTPInput.addEventListener('input', function (e) {
                        // อนุญาตเฉพาะตัวเลข
                        this.value = this.value.replace(/[^0-9]/g, '');

                        // จำกัดไม่เกิน 6 หลัก
                        if (this.value.length > 6) {
                            this.value = this.value.substring(0, 6);
                        }

                        // Auto submit เมื่อครบ 6 หลัก (optional)
                        // if (this.value.length === 6) {
                        //     setTimeout(() => verify2FASetup(), 500);
                        // }
                    });

                    // เพิ่ม Enter key support
                    setupOTPInput.addEventListener('keypress', function (e) {
                        if (e.key === 'Enter' && this.value.length === 6) {
                            verify2FASetup();
                        }
                    });
                }
            }, 1000);
        });
        // ฟังก์ชัน 2FA - Regenerate
        function regenerate2FA() {
            const modal = new bootstrap.Modal(document.getElementById('regenerate2FAModal'));
            modal.show();
        }

        function confirmRegenerate2FA() {
            const modal = bootstrap.Modal.getInstance(document.getElementById('regenerate2FAModal'));
            modal.hide();

            setTimeout(() => {
                setup2FA();
            }, 300);
        }

        // ฟังก์ชัน 2FA - Disable
        function disable2FA() {
            const modal = new bootstrap.Modal(document.getElementById('disable2FAModal'));
            modal.show();

            // จัดการฟอร์มปิดใช้งาน 2FA
            document.getElementById('disable2FAForm').addEventListener('submit', function (e) {
                e.preventDefault();

                const otp = document.getElementById('disable_otp_code').value;

                if (!otp || otp.length !== 6) {
                    showAlert('กรุณาป้อนรหัส OTP 6 หลัก', 'warning');
                    return;
                }

                // แสดงสถานะกำลังประมวลผล
                const submitBtn = this.querySelector('button[type="submit"]');
                const originalText = submitBtn.innerHTML;
                submitBtn.innerHTML = '<i class="bi bi-hourglass-split me-2"></i>กำลังตรวจสอบ...';
                submitBtn.disabled = true;

                // ส่งข้อมูลไปปิดใช้งาน
                fetch('<?php echo site_url("Auth_public_mem/setup_2fa"); ?>', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/x-www-form-urlencoded',
                        'X-Requested-With': 'XMLHttpRequest'
                    },
                    body: 'action=disable_2fa&otp=' + encodeURIComponent(otp)
                })
                    .then(response => response.json())
                    .then(data => {
                        if (data.status === 'success') {
                            // สำเร็จ - รีโหลดหน้า
                            showAlert('ปิดใช้งาน 2FA สำเร็จ!', 'success');
                            modal.hide();
                            setTimeout(() => {
                                location.reload();
                            }, 1500);
                        } else {
                            // ล้มเหลว
                            showAlert('รหัส OTP ไม่ถูกต้อง กรุณาลองใหม่อีกครั้ง', 'danger');
                            submitBtn.innerHTML = originalText;
                            submitBtn.disabled = false;
                            document.getElementById('disable_otp_code').focus();
                        }
                    })
                    .catch(error => {
                        console.error('Error:', error);
                        showAlert('เกิดข้อผิดพลาดในการติดต่อเซิร์ฟเวอร์', 'danger');
                        submitBtn.innerHTML = originalText;
                        submitBtn.disabled = false;
                    });
            });
        }

        // จัดการ input OTP (อนุญาตเฉพาะตัวเลข)
        document.addEventListener('change', function (e) {
            if (e.target.id === 'disable_otp_code') {
                e.target.value = e.target.value.replace(/[^0-9]/g, '');
            }
        });
    </script>



    <script>
        // ตัวแปรสำหรับจัดการที่อยู่
        let currentAddressData = [];
        const API_BASE_URL = 'https://addr.assystem.co.th/index.php/zip_api';

        // เพิ่มใน document ready
        document.addEventListener('DOMContentLoaded', function () {
            console.log('Initializing address functionality...');
            initializeAddressForm();
        });

        function initializeAddressForm() {
            const zipcodeField = document.getElementById('edit_zipcode');
            const provinceField = document.getElementById('edit_province_field');
            const amphoeField = document.getElementById('edit_amphoe_field');
            const districtField = document.getElementById('edit_district_field');

            if (!zipcodeField) return;

            console.log('Address form elements found, setting up...');

            // *** ลบการโหลด provinces ทันที เพราะจะให้ loadExistingAddressData จัดการ ***
            // loadAllProvinces(); // ลบบรรทัดนี้

            // รหัสไปรษณีย์ event handlers
            zipcodeField.addEventListener('keypress', function (e) {
                if (!/[0-9]/.test(e.key) && e.key !== 'Backspace' && e.key !== 'Delete' && e.key !== 'Tab') {
                    e.preventDefault();
                }
            });

            zipcodeField.addEventListener('input', function () {
                const zipcode = this.value.trim();
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

            // Province change handler
            if (provinceField && provinceField.tagName === 'SELECT') {
                provinceField.addEventListener('change', function () {
                    const selectedProvinceCode = this.value;
                    console.log('Province changed to:', selectedProvinceCode);

                    clearDependentFields('province');

                    if (selectedProvinceCode) {
                        loadAmphoesByProvince(selectedProvinceCode);
                    }

                    updateAddressData();
                });
            }

            // Amphoe change handler
            amphoeField.addEventListener('change', function () {
                const selectedAmphoeCode = this.value;
                console.log('Amphoe changed to:', selectedAmphoeCode);

                if (selectedAmphoeCode && selectedAmphoeCode !== 'existing_amphoe') {
                    const currentZipcode = zipcodeField.value.trim();

                    if (currentZipcode.length === 5) {
                        filterDistrictsByAmphoe(selectedAmphoeCode);
                    } else {
                        loadDistrictsByAmphoe(selectedAmphoeCode);
                    }
                } else {
                    // ถ้าเป็น existing_amphoe ไม่ต้องทำอะไร
                    if (selectedAmphoeCode !== 'existing_amphoe') {
                        districtField.innerHTML = '<option value="">เลือกตำบล</option>';
                        districtField.disabled = true;
                    }
                }

                updateAddressData();
            });

            // District change handler
            districtField.addEventListener('change', function () {
                const selectedDistrictCode = this.value;
                console.log('District changed to:', selectedDistrictCode);

                if (selectedDistrictCode && selectedDistrictCode !== 'existing_district') {
                    const selectedDistrict = currentAddressData.find(item =>
                        (item.district_code || item.code) === selectedDistrictCode
                    );

                    if (selectedDistrict && selectedDistrict.zipcode) {
                        console.log('Found zipcode:', selectedDistrict.zipcode);
                        zipcodeField.value = selectedDistrict.zipcode;
                    }
                }

                updateAddressData();
            });

            // *** ลบการโหลดข้อมูลเดิมออกจากตรงนี้ เพราะจะให้ toggleEditMode จัดการ ***
            // setTimeout(() => {
            //     const existingZipcode = zipcodeField.value.trim();
            //     if (existingZipcode && existingZipcode.length === 5) {
            //         searchByZipcode(existingZipcode);
            //     }
            // }, 500);
        }

        // API Functions
        async function loadAllProvinces() {
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
            console.log('Searching by zipcode:', zipcode);
            showAddressLoading(true);

            try {
                const response = await fetch(`${API_BASE_URL}/address/${zipcode}`);
                const data = await response.json();

                console.log('API Response for zipcode:', data);

                if (data.status === 'success' && data.data.length > 0) {
                    const dataWithZipcode = data.data.map(item => ({
                        ...item,
                        zipcode: zipcode,
                        searched_zipcode: zipcode
                    }));

                    console.log('Enhanced data with zipcode:', dataWithZipcode);

                    currentAddressData = dataWithZipcode;
                    populateFieldsFromZipcode(dataWithZipcode);
                    updateAddressData();
                } else {
                    showAddressError('ไม่พบข้อมูลสำหรับรหัสไปรษณีย์นี้');
                    resetToProvinceSelection();
                }
            } catch (error) {
                console.error('Address API Error:', error);
                showAddressError('เกิดข้อผิดพลาดในการค้นหาข้อมูล');
                resetToProvinceSelection();
            } finally {
                showAddressLoading(false);
            }
        }

        function populateFieldsFromZipcode(data) {
            if (data.length === 0) return;

            console.log('Populating fields from zipcode data:', data);

            const firstItem = data[0];
            convertToProvinceInput(firstItem.province_name);

            const amphoes = getUniqueAmphoes(data);
            populateAmphoeDropdown(amphoes);

            const districts = data.map(item => ({
                code: item.district_code,
                name: item.district_name,
                name_en: item.district_name_en,
                amphoe_code: item.amphoe_code,
                zipcode: item.zipcode || item.searched_zipcode
            }));
            populateDistrictDropdown(districts);

            document.getElementById('edit_amphoe_field').disabled = false;
            document.getElementById('edit_district_field').disabled = false;

            if (amphoes.length === 1) {
                console.log('Auto-selecting single amphoe:', amphoes[0].name);
                document.getElementById('edit_amphoe_field').value = amphoes[0].code;
                setTimeout(() => {
                    filterDistrictsByAmphoe(amphoes[0].code);
                }, 100);
            }

            currentAddressData = data;
        }

        function populateAmphoeDropdown(amphoes) {
            const amphoeField = document.getElementById('edit_amphoe_field');
            amphoeField.innerHTML = '<option value="">เลือกอำเภอ</option>';

            amphoes.forEach(amphoe => {
                if (amphoe && amphoe.code && amphoe.name) {
                    amphoeField.innerHTML += `<option value="${amphoe.code}">${amphoe.name}</option>`;
                }
            });
        }

        function populateDistrictDropdown(districts) {
            const districtField = document.getElementById('edit_district_field');
            districtField.innerHTML = '<option value="">เลือกตำบล</option>';

            districts.forEach(district => {
                if (district && district.code && district.name) {
                    districtField.innerHTML += `
                <option value="${district.code}" 
                        data-amphoe-code="${district.amphoe_code}"
                        data-zipcode="${district.zipcode || ''}">
                    ${district.name}
                </option>
            `;
                }
            });
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
            console.log('Filtering districts for amphoe:', amphoeCode);

            const districtField = document.getElementById('edit_district_field');
            const searchedZipcode = document.getElementById('edit_zipcode').value.trim();
            const isZipcodeSearch = searchedZipcode.length === 5;

            let visibleCount = 0;

            districtField.querySelectorAll('option').forEach(option => {
                const optionAmphoeCode = option.dataset.amphoeCode;
                const optionZipcode = option.dataset.zipcode;

                if (option.value === '') {
                    option.style.display = 'block';
                    return;
                }

                const isAmphoeMatch = String(optionAmphoeCode) === String(amphoeCode);
                const isZipcodeMatch = !isZipcodeSearch || String(optionZipcode) === String(searchedZipcode);

                if (isAmphoeMatch && isZipcodeMatch) {
                    option.style.display = 'block';
                    visibleCount++;
                } else {
                    option.style.display = 'none';
                }
            });

            console.log(`Filtering result: ${visibleCount} districts visible`);
            updateAddressData();
        }

        function convertToProvinceInput(value = '') {
            const provinceField = document.getElementById('edit_province_field');
            if (provinceField) {
                provinceField.value = value;
            }
        }

        function resetToProvinceSelection() {
            console.log('Resetting to province selection mode...');

            const provinceField = document.getElementById('edit_province_field');
            const amphoeField = document.getElementById('edit_amphoe_field');
            const districtField = document.getElementById('edit_district_field');

            if (provinceField) provinceField.value = '';
            if (amphoeField) {
                amphoeField.innerHTML = '<option value="">เลือกอำเภอ</option>';
                amphoeField.disabled = true;
            }
            if (districtField) {
                districtField.innerHTML = '<option value="">เลือกตำบล</option>';
                districtField.disabled = true;
            }

            hideAddressError();
            updateAddressData();
        }

        function clearDependentAddressFields() {
            console.log('Clearing dependent address fields...');

            const provinceField = document.getElementById('edit_province_field');
            const amphoeField = document.getElementById('edit_amphoe_field');
            const districtField = document.getElementById('edit_district_field');

            if (provinceField) provinceField.value = '';
            if (amphoeField) {
                amphoeField.innerHTML = '<option value="">เลือกอำเภอ</option>';
                amphoeField.disabled = true;
            }
            if (districtField) {
                districtField.innerHTML = '<option value="">เลือกตำบล</option>';
                districtField.disabled = true;
            }

            hideAddressError();
            updateAddressData();
        }

        function clearDependentFields(fromLevel) {
            const amphoeField = document.getElementById('edit_amphoe_field');
            const districtField = document.getElementById('edit_district_field');
            const zipcodeField = document.getElementById('edit_zipcode');

            switch (fromLevel) {
                case 'province':
                    if (amphoeField) {
                        amphoeField.innerHTML = '<option value="">เลือกอำเภอ</option>';
                        amphoeField.disabled = true;
                    }
                    if (districtField) {
                        districtField.innerHTML = '<option value="">เลือกตำบล</option>';
                        districtField.disabled = true;
                    }
                    if (zipcodeField) zipcodeField.value = '';
                    break;
            }

            hideAddressError();
            updateAddressData();
        }

        function updateAddressData() {
            const zipcode = document.getElementById('edit_zipcode')?.value || '';
            const province = document.getElementById('edit_province_field')?.value || '';

            const amphoeField = document.getElementById('edit_amphoe_field');
            const amphoeSelected = amphoeField?.options[amphoeField.selectedIndex];
            const amphoeText = amphoeSelected?.text || '';

            const districtField = document.getElementById('edit_district_field');
            const districtSelected = districtField?.options[districtField.selectedIndex];
            const districtText = districtSelected?.text || '';

            // Update hidden fields - แก้ไขชื่อฟิลด์
            const provinceHidden = document.getElementById('edit_province_hidden');
            const amphoeHidden = document.getElementById('edit_amphoe_hidden');
            const districtHidden = document.getElementById('edit_district_hidden');
            const zipcodeHidden = document.getElementById('edit_zipcode_hidden');

            if (provinceHidden) provinceHidden.value = province;
            if (amphoeHidden) amphoeHidden.value = amphoeText && amphoeText !== 'เลือกอำเภอ' ? amphoeText : '';
            if (districtHidden) districtHidden.value = districtText && districtText !== 'เลือกตำบล' ? districtText : '';
            if (zipcodeHidden) zipcodeHidden.value = zipcode;

            console.log('Address data updated:', {
                province: province,
                amphoe: amphoeText,
                district: districtText,
                zipcode: zipcode
            });
        }

        function showAddressLoading(show) {
            const loadingEl = document.getElementById('zipcode_loading');
            if (loadingEl) {
                loadingEl.style.display = show ? 'block' : 'none';
            }
        }

        function showAddressError(message) {
            hideAddressError();
            const errorEl = document.getElementById('zipcode_error');
            if (errorEl) {
                errorEl.querySelector('small').textContent = message;
                errorEl.style.display = 'block';
            }

            setTimeout(() => {
                hideAddressError();
            }, 5000);
        }

        function hideAddressError() {
            const errorEl = document.getElementById('zipcode_error');
            if (errorEl) {
                errorEl.style.display = 'none';
            }
        }

        // อัปเดตฟังก์ชัน saveBasicInfo เพื่อรวมฟิลด์ใหม่
        function saveBasicInfo() {
            console.log('Saving basic info with address details...');

            const button = event.target.closest('.btn-modern');
            const form = document.getElementById('basicInfoForm');

            if (!form) {
                showAlert('ไม่พบฟอร์มข้อมูลพื้นฐาน', 'danger');
                return;
            }

            // Update address data before validation
            updateAddressData();

            const formData = new FormData(form);

            // Validation
            const requiredFields = ['mp_prefix', 'mp_fname', 'mp_lname', 'mp_address'];
            for (let field of requiredFields) {
                if (!formData.get(field)) {
                    showAlert('กรุณากรอกข้อมูลให้ครบถ้วน', 'warning');
                    return;
                }
            }

            // Address validation - แก้ไขชื่อฟิลด์
            const district = formData.get('mp_district');
            if (!district) {
                showAlert('กรุณาเลือกตำบลให้ครบถ้วน', 'warning');
                return;
            }

            // Phone validation
            const phone = formData.get('mp_phone');
            if (phone && phone.length !== 10) {
                showAlert('เบอร์โทรศัพท์ต้องมี 10 หลัก', 'warning');
                return;
            }

            setLoading(button, true);

            fetch('<?php echo site_url("Auth_public_mem/profile"); ?>', {
                method: 'POST',
                headers: {
                    'X-Requested-With': 'XMLHttpRequest'
                },
                body: formData
            })
                .then(response => {
                    if (!response.ok) {
                        throw new Error('Network response was not ok');
                    }
                    return response.json();
                })
                .then(data => {
                    setLoading(button, false);

                    if (data.success) {
                        // อัพเดทข้อมูลใน UI
                        updateDisplayData(data.profile);

                        showAlert('อัพเดทข้อมูลสำเร็จ!', 'success');
                        cancelEdit('basic');
                    } else {
                        showAlert('เกิดข้อผิดพลาด: ' + (data.message || 'ไม่สามารถอัพเดทข้อมูลได้'), 'danger');
                    }
                })
                .catch(error => {
                    setLoading(button, false);
                    console.error('Error:', error);
                    showAlert('เกิดข้อผิดพลาดในการเชื่อมต่อ: ' + error.message, 'danger');
                });
        }

        function updateDisplayData(profile) {
            // อัพเดทข้อมูลพื้นฐาน
            const displayEmail = document.getElementById('display_email');
            const displayPrefix = document.getElementById('display_prefix');
            const displayFname = document.getElementById('display_fname');
            const displayLname = document.getElementById('display_lname');
            const displayPhone = document.getElementById('display_phone');
            const displayNumber = document.getElementById('display_number');
            const displayAddress = document.getElementById('display_address');

            if (displayEmail) displayEmail.textContent = profile.mp_email;
            if (displayPrefix) displayPrefix.textContent = profile.mp_prefix;
            if (displayFname) displayFname.textContent = profile.mp_fname;
            if (displayLname) displayLname.textContent = profile.mp_lname;
            if (displayPhone) displayPhone.textContent = profile.mp_phone || '-';
            if (displayNumber) displayNumber.textContent = profile.mp_number || '-';
            if (displayAddress) displayAddress.textContent = profile.mp_address || '-';

            // อัพเดทข้อมูลที่อยู่ละเอียด - แก้ไขชื่อฟิลด์
            const displayDistrict = document.getElementById('display_district');
            const displayAmphoe = document.getElementById('display_amphoe');
            const displayProvince = document.getElementById('display_province');
            const displayZipcode = document.getElementById('display_zipcode');

            if (displayDistrict) displayDistrict.textContent = profile.mp_district || '-';
            if (displayAmphoe) displayAmphoe.textContent = profile.mp_amphoe || '-';
            if (displayProvince) displayProvince.textContent = profile.mp_province || '-';
            if (displayZipcode) displayZipcode.textContent = profile.mp_zipcode || '-';
        }


        // อัปเดตฟังก์ชัน storeOriginalData และ restoreOriginalData
        function storeOriginalData(section) {
            if (section === 'basic') {
                const emailEl = document.getElementById('display_email');
                const prefixEl = document.getElementById('display_prefix');
                const fnameEl = document.getElementById('display_fname');
                const lnameEl = document.getElementById('display_lname');
                const phoneEl = document.getElementById('display_phone');
                const numberEl = document.getElementById('display_number');
                const addressEl = document.getElementById('display_address');
                const districtEl = document.getElementById('display_district');
                const amphoeEl = document.getElementById('display_amphoe');
                const provinceEl = document.getElementById('display_province');
                const zipcodeEl = document.getElementById('display_zipcode');

                if (emailEl && prefixEl && fnameEl && lnameEl && phoneEl && numberEl && addressEl) {
                    originalData.basic = {
                        email: emailEl.textContent,
                        prefix: prefixEl.textContent,
                        fname: fnameEl.textContent,
                        lname: lnameEl.textContent,
                        phone: phoneEl.textContent,
                        number: numberEl.textContent,
                        address: addressEl.textContent,
                        district: districtEl?.textContent || '',
                        amphoe: amphoeEl?.textContent || '',
                        province: provinceEl?.textContent || '',
                        zipcode: zipcodeEl?.textContent || ''
                    };
                }
            } else if (section === 'image') {
                const currentImg = document.getElementById('currentImageDisplay');
                if (currentImg) {
                    originalData.image = {
                        src: currentImg.src
                    };
                }
            }
        }

        function restoreOriginalData(section) {
            if (section === 'basic' && originalData.basic) {
                const editEmail = document.getElementById('edit_email');
                const editPrefix = document.getElementById('edit_prefix');
                const editFname = document.getElementById('edit_fname');
                const editLname = document.getElementById('edit_lname');
                const editPhone = document.getElementById('edit_phone');
                const editNumber = document.getElementById('edit_number');
                const editAddress = document.getElementById('edit_address');
                const editZipcode = document.getElementById('edit_zipcode');
                const editProvince = document.getElementById('edit_province_field');

                if (editEmail) editEmail.value = originalData.basic.email;
                if (editPrefix) editPrefix.value = originalData.basic.prefix;
                if (editFname) editFname.value = originalData.basic.fname;
                if (editLname) editLname.value = originalData.basic.lname;
                if (editPhone) editPhone.value = originalData.basic.phone;
                if (editNumber) editNumber.value = originalData.basic.number;
                if (editAddress) editAddress.value = originalData.basic.address;
                if (editZipcode) editZipcode.value = originalData.basic.zipcode;
                if (editProvince) editProvince.value = originalData.basic.province;

                // Reset dropdown fields
                resetToProvinceSelection();
            } else if (section === 'image' && originalData.image) {
                const previewImg = document.getElementById('previewImage');
                if (previewImg) {
                    previewImg.src = originalData.image.src;
                }
            }
        }
    </script>



    <script>


        // เพิ่ม JavaScript ในส่วนท้ายของ <script> ที่มีอยู่

        // Global variables สำหรับ account deletion
        let isValidIdNumber = true;
        let isDeletionInProgress = false;

        // Initialize ID number validation when document is ready
        document.addEventListener('DOMContentLoaded', function () {
            // Setup ID number validation
            setupIdNumberValidation();

            // Setup deletion confirmation checkbox
            setupDeletionConfirmation();
        });


        /**
         * ตั้งค่า validation สำหรับเลขบัตรประชาชน พร้อม Console Debug และ Feedback Functions
         */
        function setupIdNumberValidation() {
            const idNumberInput = document.getElementById('edit_number');
            const loadingElement = document.getElementById('id_number_loading');
            const feedbackElement = document.getElementById('id_number_feedback');

            console.group('🔧 ID Number Validation Setup');
            console.log('🔍 Elements found:', {
                idNumberInput: !!idNumberInput,
                loadingElement: !!loadingElement,
                feedbackElement: !!feedbackElement
            });

            if (!idNumberInput) {
                console.warn('❌ ID Number input element not found!');
                console.groupEnd();
                return;
            }

            console.log('✅ ID Number validation initialized');
            console.groupEnd();

            let validationTimeout;

            /**
             * 📢 แสดง feedback message
             */
            function showFeedback(message, type) {
                console.log('📢 Showing feedback:', { message, type });

                if (!feedbackElement) {
                    console.warn('⚠️ Feedback element not found, creating one...');

                    // สร้าง feedback element ถ้าไม่มี
                    const newFeedback = document.createElement('div');
                    newFeedback.id = 'id_number_feedback';
                    newFeedback.className = 'feedback-message';

                    // แทรกหลัง input element
                    if (idNumberInput.parentNode) {
                        idNumberInput.parentNode.insertBefore(newFeedback, idNumberInput.nextSibling);
                        console.log('✅ Feedback element created and inserted');
                    }
                }

                const targetElement = feedbackElement || document.getElementById('id_number_feedback');

                if (targetElement) {
                    targetElement.textContent = message;
                    targetElement.className = `feedback-message feedback-${type}`;
                    targetElement.style.display = 'block';

                    // กำหนด CSS styles ตามประเภท
                    const styles = {
                        valid: {
                            color: '#28a745',
                            backgroundColor: '#d4edda',
                            borderColor: '#c3e6cb'
                        },
                        invalid: {
                            color: '#dc3545',
                            backgroundColor: '#f8d7da',
                            borderColor: '#f5c6cb'
                        },
                        duplicate: {
                            color: '#856404',
                            backgroundColor: '#fff3cd',
                            borderColor: '#ffeaa7'
                        }
                    };

                    const style = styles[type] || styles.invalid;
                    Object.assign(targetElement.style, {
                        padding: '8px 12px',
                        marginTop: '5px',
                        border: `1px solid ${style.borderColor}`,
                        borderRadius: '4px',
                        fontSize: '14px',
                        ...style
                    });

                    console.log('✅ Feedback displayed:', { message, type, element: targetElement });
                } else {
                    console.error('❌ Could not display feedback - no element available');
                }
            }

            /**
             * 🙈 ซ่อน feedback message
             */
            function hideFeedback() {
                console.log('🙈 Hiding feedback');

                const targetElement = feedbackElement || document.getElementById('id_number_feedback');

                if (targetElement) {
                    targetElement.style.display = 'none';
                    targetElement.textContent = '';
                    console.log('✅ Feedback hidden');
                } else {
                    console.log('ℹ️ No feedback element to hide');
                }
            }

            /**
             * ⏳ แสดง/ซ่อน loading indicator
             */
            function showLoading(show) {
                console.log('⏳ Loading state:', show);

                if (!loadingElement) {
                    console.warn('⚠️ Loading element not found, creating one...');

                    // สร้าง loading element ถ้าไม่มี
                    const newLoading = document.createElement('div');
                    newLoading.id = 'id_number_loading';
                    newLoading.innerHTML = '<span style="color: #007bff;">⏳ กำลังตรวจสอบ...</span>';
                    newLoading.style.display = 'none';

                    // แทรกหลัง input element
                    if (idNumberInput.parentNode) {
                        idNumberInput.parentNode.insertBefore(newLoading, idNumberInput.nextSibling);
                        console.log('✅ Loading element created and inserted');
                    }
                }

                const targetElement = loadingElement || document.getElementById('id_number_loading');

                if (targetElement) {
                    targetElement.style.display = show ? 'block' : 'none';
                    console.log('✅ Loading visibility:', show);
                } else {
                    console.error('❌ Could not control loading - no element available');
                }
            }

            // Event listener สำหรับการพิมพ์
            idNumberInput.addEventListener('input', function (e) {
                console.group('⌨️ Input Event Triggered');
                console.log('Original value:', e.target.value);

                // อนุญาตเฉพาะตัวเลข
                const originalValue = this.value;
                this.value = this.value.replace(/[^0-9]/g, '');

                if (originalValue !== this.value) {
                    console.log('🔄 Value filtered:', originalValue, '→', this.value);
                }

                // ล้าง timeout เก่า
                if (validationTimeout) {
                    console.log('⏰ Clearing previous timeout');
                    clearTimeout(validationTimeout);
                }

                // ซ่อน feedback เก่า
                hideFeedback();
                console.log('🙈 Previous feedback hidden');

                const idNumber = this.value.trim();
                console.log('📝 Processing ID number:', idNumber, '(length:', idNumber.length + ')');

                // ถ้าไม่มีการกรอก หรือ กรอกไม่ครบ 13 หลัก
                if (idNumber === '') {
                    console.log('✅ Empty input - allowing blank');
                    isValidIdNumber = true; // อนุญาตให้ว่าง
                    console.groupEnd();
                    return;
                }

                if (idNumber.length !== 13) {
                    console.log('⚠️ Invalid length:', idNumber.length, 'expected: 13');
                    showFeedback('กรอกเลขบัตรประชาชน 13 หลัก', 'invalid');
                    isValidIdNumber = false;
                    console.groupEnd();
                    return;
                }

                console.log('✅ Length validation passed - setting timeout for AJAX validation');

                // ตั้งเวลา delay สำหรับ validation
                validationTimeout = setTimeout(() => {
                    console.log('⏰ Timeout triggered - starting validation');
                    validateIdNumber(idNumber);
                }, 500);

                console.log('⏰ Validation timeout set (500ms)');
                console.groupEnd();
            });

            /**
             * ตรวจสอบความซ้ำของเลขบัตรประชาชน
             */
            function validateIdNumber(idNumber) {
                console.group('🌐 AJAX ID Validation');
                console.log('📤 Starting validation for:', idNumber);
                console.log('🕐 Timestamp:', new Date().toLocaleTimeString());

                showLoading(true);
                console.log('⏳ Loading indicator shown');

                const ajaxUrl = '<?php echo site_url("Auth_public_mem/validate_id_number_ajax"); ?>';
                const requestBody = 'id_number=' + encodeURIComponent(idNumber);

                console.log('🔗 AJAX URL:', ajaxUrl);
                console.log('📦 Request body:', requestBody);
                console.log('🏷️ Encoded ID:', encodeURIComponent(idNumber));

                const requestOptions = {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/x-www-form-urlencoded',
                        'X-Requested-With': 'XMLHttpRequest'
                    },
                    body: requestBody
                };

                console.log('⚙️ Request options:', requestOptions);

                fetch(ajaxUrl, requestOptions)
                    .then(response => {
                        console.group('📥 Response Received');
                        console.log('📊 Response status:', response.status);
                        console.log('📋 Response headers:', [...response.headers.entries()]);
                        console.log('✅ Response ok:', response.ok);
                        console.log('🔄 Converting to JSON...');

                        if (!response.ok) {
                            console.error('❌ HTTP Error:', response.status, response.statusText);
                        }

                        return response.json();
                    })
                    .then(data => {
                        console.log('📦 Raw JSON response:', data);
                        console.log('🏷️ Response type:', typeof data);
                        console.log('🔍 Response analysis:', {
                            status: data.status,
                            available: data.available,
                            message: data.message,
                            statusType: typeof data.status,
                            availableType: typeof data.available
                        });
                        console.groupEnd(); // End Response Received group

                        showLoading(false);
                        console.log('⏳ Loading indicator hidden');

                        console.group('🎯 Response Processing');

                        // Main validation logic with detailed logging
                        if (data.status === 'valid' && data.available) {
                            console.log('✅ Validation SUCCESS:', {
                                status: data.status,
                                available: data.available,
                                condition: 'status === "valid" && available === true'
                            });
                            showFeedback('✅ เลขบัตรประชาชนสามารถใช้งานได้', 'valid');
                            isValidIdNumber = true;
                            console.log('🎊 isValidIdNumber set to:', isValidIdNumber);

                        } else if (data.status === 'duplicate' || !data.available) {
                            console.log('❌ Validation DUPLICATE:', {
                                status: data.status,
                                available: data.available,
                                condition: 'status === "duplicate" || available === false'
                            });
                            showFeedback('❌ ' + data.message, 'duplicate');
                            isValidIdNumber = false;
                            console.log('🚫 isValidIdNumber set to:', isValidIdNumber);

                        } else {
                            console.log('❌ Validation INVALID:', {
                                status: data.status,
                                available: data.available,
                                condition: 'other cases'
                            });
                            showFeedback('❌ ' + data.message, 'invalid');
                            isValidIdNumber = false;
                            console.log('🚫 isValidIdNumber set to:', isValidIdNumber);
                        }

                        console.log('📝 Final validation state:', {
                            isValidIdNumber: isValidIdNumber,
                            globalVariableType: typeof isValidIdNumber
                        });

                        console.groupEnd(); // End Response Processing group
                    })
                    .catch(error => {
                        console.group('💥 AJAX Error');
                        console.error('❌ Fetch error occurred:', error);
                        console.error('🔍 Error details:', {
                            name: error.name,
                            message: error.message,
                            stack: error.stack
                        });
                        console.error('🌐 Network state:', {
                            online: navigator.onLine,
                            userAgent: navigator.userAgent
                        });
                        console.groupEnd(); // End AJAX Error group

                        showLoading(false);
                        console.log('⏳ Loading indicator hidden (error case)');

                        showFeedback('เกิดข้อผิดพลาดในการตรวจสอบ', 'invalid');
                        isValidIdNumber = false;

                        console.log('🚫 Error - isValidIdNumber set to:', isValidIdNumber);
                    })
                    .finally(() => {
                        console.log('🏁 AJAX request completed');
                        console.log('⏰ End time:', new Date().toLocaleTimeString());
                        console.groupEnd(); // End AJAX ID Validation group
                    });
            }

            // เพิ่ม helper functions สำหรับ debug
            function debugCurrentState() {
                console.group('🔍 Current Validation State');
                console.log('Input value:', idNumberInput?.value || 'N/A');
                console.log('isValidIdNumber:', typeof isValidIdNumber !== 'undefined' ? isValidIdNumber : 'undefined');
                console.log('Feedback element:', feedbackElement?.textContent || 'N/A');
                console.log('Loading element visible:', loadingElement?.style.display !== 'none');
                console.groupEnd();
            }

            // เพิ่ม event listener สำหรับ debug
            idNumberInput.addEventListener('focus', function () {
                console.log('🎯 ID Number input focused');
                debugCurrentState();
            });

            idNumberInput.addEventListener('blur', function () {
                console.log('👋 ID Number input blurred');
                debugCurrentState();
            });

            // Export debug function to global scope
            window.debugIdValidation = debugCurrentState;
            window.testShowFeedback = function (message, type) {
                console.log('🧪 Testing feedback:', message, type);
                showFeedback(message, type);
            };
            window.testHideFeedback = function () {
                console.log('🧪 Testing hide feedback');
                hideFeedback();
            };

            console.log('🎮 Debug helpers added:');
            console.log('  - debugIdValidation() - show current state');
            console.log('  - testShowFeedback(message, type) - test feedback display');
            console.log('  - testHideFeedback() - test feedback hiding');
        }

        /**
         * ตั้งค่า checkbox ยืนยันการลบ
         */
        function setupDeletionConfirmation() {
            const confirmCheckbox = document.getElementById('confirmDeletion');
            const deleteBtn = document.getElementById('confirmDeleteBtn');

            if (confirmCheckbox && deleteBtn) {
                confirmCheckbox.addEventListener('change', function () {
                    deleteBtn.disabled = !this.checked;
                });

                // เริ่มต้นให้ปุ่มปิด
                deleteBtn.disabled = true;
            }
        }

        /**
         * แก้ไข saveBasicInfo เดิมให้รวม ID number validation
         */
        function saveBasicInfo() {
            console.log('Saving basic info with ID validation...');

            const button = event.target.closest('.btn-modern');
            const form = document.getElementById('basicInfoForm');

            if (!form) {
                showAlert('ไม่พบฟอร์มข้อมูลพื้นฐาน', 'danger');
                return;
            }

            // ตรวจสอบ ID number validity
            const idNumberInput = document.getElementById('edit_number');
            if (idNumberInput && idNumberInput.value.trim() !== '') {
                if (!isValidIdNumber) {
                    showAlert('กรุณาตรวจสอบเลขบัตรประชาชนให้ถูกต้อง', 'warning');
                    idNumberInput.focus();
                    return;
                }
            }

            const formData = new FormData(form);

            // Validation เดิม
            const requiredFields = ['mp_prefix', 'mp_fname', 'mp_lname', 'mp_address'];
            for (let field of requiredFields) {
                if (!formData.get(field)) {
                    showAlert('กรุณากรอกข้อมูลให้ครบถ้วน', 'warning');
                    return;
                }
            }

            // Address validation
            const district = formData.get('mp_district');
            if (!district) {
                showAlert('กรุณาเลือกตำบลให้ครบถ้วน', 'warning');
                return;
            }

            // Phone validation
            const phone = formData.get('mp_phone');
            if (phone && phone.length !== 10) {
                showAlert('เบอร์โทรศัพท์ต้องมี 10 หลัก', 'warning');
                return;
            }

            setLoading(button, true);

            fetch('<?php echo site_url("Auth_public_mem/profile"); ?>', {
                method: 'POST',
                headers: {
                    'X-Requested-With': 'XMLHttpRequest'
                },
                body: formData
            })
                .then(response => {
                    if (!response.ok) {
                        throw new Error('Network response was not ok');
                    }
                    return response.json();
                })
                .then(data => {
                    setLoading(button, false);

                    if (data.success) {
                        // อัพเดทข้อมูลใน UI
                        updateDisplayData(data.profile);

                        showAlert('อัพเดทข้อมูลสำเร็จ!', 'success');
                        cancelEdit('basic');
                    } else {
                        showAlert('เกิดข้อผิดพลาด: ' + (data.message || 'ไม่สามารถอัพเดทข้อมูลได้'), 'danger');
                    }
                })
                .catch(error => {
                    setLoading(button, false);
                    console.error('Error:', error);
                    showAlert('เกิดข้อผิดพลาดในการเชื่อมต่อ: ' + error.message, 'danger');
                });
        }

        /**
         * แสดง modal ยืนยันการลบบัญชี
         */
        function confirmDeleteAccount() {
            // ตรวจสอบว่า modal element มีอยู่
            const modalElement = document.getElementById('deleteAccountModal');
            if (!modalElement) {
                console.error('Delete account modal not found');
                return;
            }

            // รีเซ็ตฟอร์ม
            const form = modalElement.querySelector('form');
            if (form) {
                form.reset();
            }

            // รีเซ็ต checkbox
            const confirmCheckbox = document.getElementById('confirmDeletion');
            const deleteBtn = document.getElementById('confirmDeleteBtn');

            if (confirmCheckbox) confirmCheckbox.checked = false;
            if (deleteBtn) deleteBtn.disabled = true;

            // รีเซ็ต OTP field ถ้ามี
            const otpField = document.getElementById('delete_otp_code');
            if (otpField) otpField.value = '';

            // แสดง modal
            const modal = new bootstrap.Modal(modalElement, {
                backdrop: 'static',
                keyboard: false
            });
            modal.show();
        }

        /**
         * ดำเนินการลบบัญชี
         */
        function executeDeleteAccount() {
            if (isDeletionInProgress) {
                return;
            }

            try {
                // ตรวจสอบ checkbox ยืนยัน
                const confirmCheckbox = document.getElementById('confirmDeletion');
                if (!confirmCheckbox || !confirmCheckbox.checked) {
                    showAlert('กรุณายืนยันการลบบัญชีก่อน', 'warning');
                    return;
                }

                const deleteBtn = document.getElementById('confirmDeleteBtn');
                const originalText = deleteBtn.innerHTML;

                // ตรวจสอบ 2FA ถ้าจำเป็น
                const otpField = document.getElementById('delete_otp_code');
                let otp = '';

                <?php if (isset($user_2fa_info) && $user_2fa_info && !empty($user_2fa_info->google2fa_secret) && $user_2fa_info->google2fa_enabled == 1): ?>
                    if (!otpField || !otpField.value || otpField.value.length !== 6) {
                        showAlert('กรุณากรอกรหัส OTP 6 หลัก', 'warning');
                        if (otpField) otpField.focus();
                        return;
                    }
                    otp = otpField.value;
                <?php endif; ?>

                // เตรียมข้อมูลสำหรับส่ง
                const formData = new FormData();
                formData.append('action', 'delete_account');
                formData.append('deletion_reason', document.getElementById('deletion_reason').value);

                <?php if (isset($user_2fa_info) && $user_2fa_info && !empty($user_2fa_info->google2fa_secret) && $user_2fa_info->google2fa_enabled == 1): ?>
                    formData.append('otp', otp);
                    formData.append('requires_2fa', '1');
                <?php endif; ?>

                // แสดงสถานะกำลังประมวลผล
                isDeletionInProgress = true;
                deleteBtn.innerHTML = '<i class="bi bi-hourglass-split me-2"></i>กำลังลบบัญชี...';
                deleteBtn.disabled = true;

                fetch('<?php echo site_url("Auth_public_mem/delete_account"); ?>', {
                    method: 'POST',
                    headers: {
                        'X-Requested-With': 'XMLHttpRequest'
                    },
                    body: formData
                })
                    .then(response => response.json())
                    .then(data => {
                        if (data.status === 'success') {
                            // แสดงข้อความสำเร็จ
                            showAlert('ลบบัญชีสำเร็จ กำลังออกจากระบบ...', 'success');

                            // ปิด modal
                            const modal = bootstrap.Modal.getInstance(document.getElementById('deleteAccountModal'));
                            if (modal) {
                                modal.hide();
                            }

                            // รอ 2 วินาทีแล้ว redirect
                            setTimeout(() => {
                                window.location.href = data.redirect || '<?php echo site_url("Home"); ?>';
                            }, 2000);

                        } else {
                            // แสดงข้อผิดพลาด
                            showAlert(data.message || 'เกิดข้อผิดพลาดในการลบบัญชี', 'danger');

                            // คืนค่าปุ่มกลับ
                            isDeletionInProgress = false;
                            deleteBtn.innerHTML = originalText;
                            deleteBtn.disabled = false;

                            // Focus OTP field ถ้าผิด
                            if (data.error_type === 'invalid_otp' && otpField) {
                                otpField.select();
                            }
                        }
                    })
                    .catch(error => {
                        console.error('Delete account error:', error);
                        showAlert('เกิดข้อผิดพลาดในการเชื่อมต่อ', 'danger');

                        // คืนค่าปุ่มกลับ
                        isDeletionInProgress = false;
                        deleteBtn.innerHTML = originalText;
                        deleteBtn.disabled = false;
                    });

            } catch (error) {
                console.error('Error in executeDeleteAccount:', error);
                showAlert('เกิดข้อผิดพลาดในระบบ', 'danger');

                isDeletionInProgress = false;
                const deleteBtn = document.getElementById('confirmDeleteBtn');
                if (deleteBtn) {
                    deleteBtn.disabled = false;
                }
            }
        }

        /**
         * อัพเดท updateDisplayData เดิมให้รวม ID number
         */
        function updateDisplayData(profile) {
            // อัพเดทข้อมูลพื้นฐาน
            const displayEmail = document.getElementById('display_email');
            const displayPrefix = document.getElementById('display_prefix');
            const displayFname = document.getElementById('display_fname');
            const displayLname = document.getElementById('display_lname');
            const displayPhone = document.getElementById('display_phone');
            const displayNumber = document.getElementById('display_number');
            const displayAddress = document.getElementById('display_address');

            if (displayEmail) displayEmail.textContent = profile.mp_email;
            if (displayPrefix) displayPrefix.textContent = profile.mp_prefix;
            if (displayFname) displayFname.textContent = profile.mp_fname;
            if (displayLname) displayLname.textContent = profile.mp_lname;
            if (displayPhone) displayPhone.textContent = profile.mp_phone || '-';
            if (displayNumber) displayNumber.textContent = profile.mp_number || '-';
            if (displayAddress) displayAddress.textContent = profile.mp_address || '-';

            // อัพเดทข้อมูลที่อยู่ละเอียด
            const displayDistrict = document.getElementById('display_district');
            const displayAmphoe = document.getElementById('display_amphoe');
            const displayProvince = document.getElementById('display_province');
            const displayZipcode = document.getElementById('display_zipcode');

            if (displayDistrict) displayDistrict.textContent = profile.mp_district || '-';
            if (displayAmphoe) displayAmphoe.textContent = profile.mp_amphoe || '-';
            if (displayProvince) displayProvince.textContent = profile.mp_province || '-';
            if (displayZipcode) displayZipcode.textContent = profile.mp_zipcode || '-';
        }

    </script>


</body>

</html>