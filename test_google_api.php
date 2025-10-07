<?php
/**
 * Google API System Checker
 * Path: httpdocs/test_google_api.php
 * 
 * ใช้ทดสอบระบบ Google API Client หลังจากแก้ไข autoloader
 */

// ตั้งค่า error reporting
error_reporting(E_ALL);
ini_set('display_errors', 1);

// จำลอง CodeIgniter environment
define('ENVIRONMENT', 'development');
define('BASEPATH', realpath(dirname(__FILE__)) . '/');
define('APPPATH', BASEPATH . 'application/');

// ฟังก์ชันช่วยเหลือ
function log_message($level, $message) {
    echo "<div class='log-$level'>[" . strtoupper($level) . "] $message</div>";
}

?>
<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Google API System Checker</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            margin: 0;
            padding: 20px;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
        }
        
        .container {
            max-width: 1200px;
            margin: 0 auto;
            background: rgba(255, 255, 255, 0.95);
            border-radius: 20px;
            padding: 30px;
            box-shadow: 0 20px 40px rgba(0,0,0,0.1);
            backdrop-filter: blur(20px);
        }
        
        .header {
            text-align: center;
            margin-bottom: 30px;
            padding-bottom: 20px;
            border-bottom: 2px solid #eee;
        }
        
        .header h1 {
            color: #333;
            margin: 0;
            font-size: 2.5em;
            background: linear-gradient(45deg, #667eea, #764ba2);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }
        
        .section {
            margin: 20px 0;
            padding: 20px;
            border-radius: 10px;
            border-left: 4px solid #667eea;
            background: #f8f9fa;
        }
        
        .section h2 {
            margin-top: 0;
            color: #333;
            font-size: 1.3em;
        }
        
        .check-item {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 10px;
            margin: 5px 0;
            border-radius: 8px;
            background: white;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        }
        
        .check-label {
            font-weight: 500;
            color: #555;
        }
        
        .status {
            padding: 4px 12px;
            border-radius: 20px;
            font-size: 0.9em;
            font-weight: bold;
        }
        
        .status-success {
            background: #d1fae5;
            color: #065f46;
        }
        
        .status-error {
            background: #fef2f2;
            color: #991b1b;
        }
        
        .status-warning {
            background: #fef3c7;
            color: #92400e;
        }
        
        .log-info {
            color: #0369a1;
            font-size: 0.9em;
            margin: 2px 0;
        }
        
        .log-error {
            color: #dc2626;
            font-weight: bold;
            margin: 2px 0;
        }
        
        .log-warning {
            color: #d97706;
            margin: 2px 0;
        }
        
        .details {
            background: #f1f5f9;
            padding: 15px;
            border-radius: 8px;
            margin: 10px 0;
            font-family: 'Courier New', monospace;
            font-size: 0.9em;
            overflow-x: auto;
        }
        
        .class-list {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 10px;
            margin: 10px 0;
        }
        
        .class-item {
            padding: 8px 12px;
            background: white;
            border-radius: 6px;
            border-left: 3px solid #10b981;
            font-family: 'Courier New', monospace;
            font-size: 0.9em;
        }
        
        .test-results {
            margin-top: 30px;
        }
        
        .button {
            background: linear-gradient(45deg, #667eea, #764ba2);
            color: white;
            border: none;
            padding: 12px 24px;
            border-radius: 8px;
            cursor: pointer;
            font-size: 1em;
            font-weight: bold;
            transition: transform 0.2s;
        }
        
        .button:hover {
            transform: translateY(-2px);
        }
        
        .alert {
            padding: 15px;
            border-radius: 8px;
            margin: 15px 0;
        }
        
        .alert-success {
            background: #d1fae5;
            border: 1px solid #a7f3d0;
            color: #065f46;
        }
        
        .alert-danger {
            background: #fef2f2;
            border: 1px solid #fecaca;
            color: #991b1b;
        }
        
        .progress-bar {
            width: 100%;
            height: 20px;
            background: #e5e7eb;
            border-radius: 10px;
            overflow: hidden;
            margin: 10px 0;
        }
        
        .progress-fill {
            height: 100%;
            background: linear-gradient(45deg, #10b981, #34d399);
            transition: width 0.3s ease;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>🔍 Google API System Checker</h1>
            <p style="color: #666; margin: 10px 0;">ตรวจสอบระบบ Google API Client v2.15.1</p>
            <p style="color: #999; font-size: 0.9em;">เวลา: <?php echo date('Y-m-d H:i:s'); ?></p>
        </div>

        <?php
        $totalChecks = 0;
        $passedChecks = 0;
        
        // 1. ตรวจสอบโครงสร้างไฟล์
        ?>
        <div class="section">
            <h2>📁 File System Check</h2>
            
            <?php
            $fileChecks = [
                'APPPATH' => APPPATH,
                'third_party' => APPPATH . 'third_party/',
                'google-api-php-client' => APPPATH . 'third_party/google-api-php-client/',
                'autoload.php' => APPPATH . 'third_party/google-api-php-client/autoload.php',
                'src folder' => APPPATH . 'third_party/google-api-php-client/src/',
                'Client.php' => APPPATH . 'third_party/google-api-php-client/src/Client.php',
                'Service.php' => APPPATH . 'third_party/google-api-php-client/src/Service.php',
                'Model.php' => APPPATH . 'third_party/google-api-php-client/src/Model.php'
            ];
            
            echo '<table style="width: 100%; border-collapse: collapse;">';
            echo '<tr style="background: #f3f4f6;"><th style="padding: 10px; text-align: left;">Path</th><th style="padding: 10px; text-align: left;">Status</th><th style="padding: 10px; text-align: left;">Full Path</th></tr>';
            
            foreach ($fileChecks as $name => $path) {
                $totalChecks++;
                $exists = (is_file($path) || is_dir($path));
                if ($exists) $passedChecks++;
                
                $statusClass = $exists ? 'status-success' : 'status-error';
                $statusText = $exists ? '✅ ' . (is_file($path) ? 'File' : 'Directory') : '❌ Not Found';
                
                echo "<tr>";
                echo "<td style='padding: 8px; border-bottom: 1px solid #eee;'><strong>$name</strong></td>";
                echo "<td style='padding: 8px; border-bottom: 1px solid #eee;'><span class='status $statusClass'>$statusText</span></td>";
                echo "<td style='padding: 8px; border-bottom: 1px solid #eee; font-family: monospace; font-size: 0.8em; color: #666;'>$path</td>";
                echo "</tr>";
            }
            echo '</table>';
            ?>
        </div>

        <!-- 2. ทดสอบการโหลด Library -->
        <div class="section">
            <h2>📚 Library Loading Test</h2>
            
            <?php
            $totalChecks++;
            
            // ทดสอบโหลด google_client_loader.php
            $loaderPath = APPPATH . 'third_party/google_client_loader.php';
            $loaderExists = file_exists($loaderPath);
            
            echo '<div class="check-item">';
            echo '<span class="check-label"><strong>google_client_loader.php:</strong></span>';
            if ($loaderExists) {
                echo '<span class="status status-success">✅ Found</span>';
                $passedChecks++;
            } else {
                echo '<span class="status status-error">❌ Not Found</span>';
            }
            echo '</div>';
            
            if ($loaderExists) {
                $totalChecks++;
                try {
                    require_once $loaderPath;
                    echo '<div class="log-info">✅ google_client_loader.php loaded successfully</div>';
                    $passedChecks++;
                } catch (Exception $e) {
                    echo '<div class="log-error">❌ Error loading google_client_loader.php: ' . $e->getMessage() . '</div>';
                }
            }
            
            // ทดสอบโหลด autoload.php โดยตรง
            $autoloadPath = APPPATH . 'third_party/google-api-php-client/autoload.php';
            if (file_exists($autoloadPath)) {
                $totalChecks++;
                try {
                    $result = require_once $autoloadPath;
                    if ($result) {
                        echo '<div class="log-info">✅ Direct autoload.php loaded successfully</div>';
                        $passedChecks++;
                    } else {
                        echo '<div class="log-warning">⚠️ autoload.php loaded but returned false</div>';
                    }
                } catch (Exception $e) {
                    echo '<div class="log-error">❌ Error loading autoload.php: ' . $e->getMessage() . '</div>';
                }
            }
            ?>
        </div>

        <!-- 3. ตรวจสอบ Class Availability -->
        <div class="section">
            <h2>🧪 Class Availability</h2>
            
            <?php
            $requiredClasses = [
                'Google\Client',
                'Google_Client',
                'Google\Service\Drive',
                'Google_Service_Drive',
                'Google_Client_Loader'
            ];
            
            $loadedClasses = [];
            
            foreach ($requiredClasses as $className) {
                $totalChecks++;
                $exists = class_exists($className);
                
                echo '<div class="check-item">';
                echo '<span class="check-label">' . htmlspecialchars($className) . '</span>';
                
                if ($exists) {
                    echo '<span class="status status-success">✅ Available</span>';
                    $loadedClasses[] = $className;
                    $passedChecks++;
                } else {
                    echo '<span class="status status-error">❌ Missing</span>';
                }
                echo '</div>';
            }
            
            if (!empty($loadedClasses)) {
                echo '<div class="class-list">';
                foreach ($loadedClasses as $class) {
                    echo '<div class="class-item">✅ ' . htmlspecialchars($class) . '</div>';
                }
                echo '</div>';
            }
            ?>
        </div>

        <!-- 4. Directory Contents -->
        <div class="section">
            <h2>📂 Google API Client Directory Contents</h2>
            
            <?php
            $clientDir = APPPATH . 'third_party/google-api-php-client/';
            if (is_dir($clientDir)) {
                $items = scandir($clientDir);
                $items = array_filter($items, function($item) {
                    return $item !== '.' && $item !== '..';
                });
                
                echo '<div style="columns: 2; column-gap: 20px;">';
                foreach ($items as $item) {
                    $fullPath = $clientDir . $item;
                    $type = is_dir($fullPath) ? 'DIR' : 'FILE';
                    $icon = is_dir($fullPath) ? '📁' : '📄';
                    
                    echo "<div style='break-inside: avoid; margin: 2px 0;'>$icon <strong>[$type]</strong> $item</div>";
                }
                echo '</div>';
                
                // แสดงเนื้อหาใน src/ ถ้ามี
                $srcDir = $clientDir . 'src/';
                if (is_dir($srcDir)) {
                    echo '<h3>📁 src/ directory contents:</h3>';
                    $srcItems = scandir($srcDir);
                    $srcItems = array_filter($srcItems, function($item) {
                        return $item !== '.' && $item !== '..';
                    });
                    
                    echo '<div style="columns: 3; column-gap: 15px; font-family: monospace; font-size: 0.9em;">';
                    foreach ($srcItems as $item) {
                        $fullPath = $srcDir . $item;
                        $type = is_dir($fullPath) ? 'DIR' : 'FILE';
                        $icon = is_dir($fullPath) ? '📁' : '📄';
                        
                        echo "<div style='break-inside: avoid; margin: 1px 0;'>$icon $item</div>";
                    }
                    echo '</div>';
                }
            } else {
                echo '<div class="alert alert-danger">❌ Google API Client directory not found!</div>';
            }
            ?>
        </div>

        <!-- 5. Test Client Creation -->
        <div class="section">
            <h2>🛠️ Client Creation Test</h2>
            
            <?php
            $totalChecks++;
            
            if (class_exists('Google_Client_Loader')) {
                try {
                    // ทดสอบการสร้าง client
                    $testResult = Google_Client_Loader::test();
                    
                    echo '<div class="details">';
                    echo '<h3>Test Results:</h3>';
                    foreach ($testResult as $key => $value) {
                        if ($key === 'error_message' && $value) {
                            echo "<div class='log-error'>❌ $key: $value</div>";
                        } else if (is_bool($value)) {
                            $status = $value ? '✅ PASS' : '❌ FAIL';
                            echo "<div>$key: $status</div>";
                        } else {
                            echo "<div>$key: " . htmlspecialchars($value) . "</div>";
                        }
                    }
                    echo '</div>';
                    
                    // ทดสอบการสร้าง client จริง
                    if ($testResult['client_creation']) {
                        $passedChecks++;
                        echo '<div class="alert alert-success">✅ Google Client สามารถสร้างได้สำเร็จ!</div>';
                        
                        // ทดสอบเพิ่มเติม
                        try {
                            $client = Google_Client_Loader::create_client();
                            if ($client && method_exists($client, 'setApplicationName')) {
                                echo '<div class="log-info">✅ Client methods available</div>';
                            }
                        } catch (Exception $e) {
                            echo '<div class="log-error">❌ Client creation error: ' . $e->getMessage() . '</div>';
                        }
                    } else {
                        echo '<div class="alert alert-danger">❌ ไม่สามารถสร้าง Google Client ได้</div>';
                    }
                    
                } catch (Exception $e) {
                    echo '<div class="log-error">❌ Error in client test: ' . $e->getMessage() . '</div>';
                }
            } else {
                echo '<div class="alert alert-danger">❌ Google_Client_Loader class not available</div>';
            }
            ?>
        </div>

        <!-- 6. Progress Summary -->
        <div class="section">
            <h2>📊 Overall Status</h2>
            
            <?php
            $percentage = $totalChecks > 0 ? round(($passedChecks / $totalChecks) * 100) : 0;
            $statusClass = $percentage >= 80 ? 'alert-success' : 'alert-danger';
            $statusIcon = $percentage >= 80 ? '✅' : '❌';
            ?>
            
            <div class="progress-bar">
                <div class="progress-fill" style="width: <?php echo $percentage; ?>%;"></div>
            </div>
            
            <div class="alert <?php echo $statusClass; ?>">
                <?php echo $statusIcon; ?> <strong><?php echo $passedChecks; ?> / <?php echo $totalChecks; ?> tests passed (<?php echo $percentage; ?>%)</strong>
            </div>
            
            <?php if ($percentage >= 80): ?>
                <div class="alert alert-success">
                    🎉 <strong>ระบบพร้อมใช้งาน!</strong> Google API Client โหลดสำเร็จ
                </div>
            <?php else: ?>
                <div class="alert alert-danger">
                    ⚠️ <strong>ระบบยังไม่พร้อม</strong> กรุณาแก้ไขปัญหาตามขั้นตอนด้านล่าง
                </div>
            <?php endif; ?>
        </div>

        <!-- 7. Troubleshooting -->
        <?php if ($percentage < 80): ?>
        <div class="section">
            <h2>🛠️ Troubleshooting Steps</h2>
            
            <ol style="line-height: 1.8;">
                <li><strong>ดาวน์โหลด Google API PHP Client:</strong> 
                    <a href="https://github.com/googleapis/google-api-php-client/archive/v2.15.1.zip" target="_blank" class="button" style="display: inline-block; padding: 4px 8px; font-size: 0.8em; text-decoration: none;">📥 ดาวน์โหลด v2.15.1</a>
                </li>
                <li><strong>อัปโหลดไฟล์ผ่าน Plesk File Manager</strong></li>
                <li><strong>แตกไฟล์ใน:</strong> <code>httpdocs/application/third_party/</code></li>
                <li><strong>เปลี่ยนชื่อโฟลเดอร์เป็น:</strong> <code>google-api-php-client</code></li>
                <li><strong>สร้างไฟล์:</strong> <code>google-api-php-client/autoload.php</code> (ใช้โค้ดจาก artifact ที่สร้างไว้)</li>
                <li><strong>สร้างไฟล์:</strong> <code>application/third_party/google_client_loader.php</code></li>
                <li><strong>ตรวจสอบ permissions:</strong> ไฟล์ต้องสามารถอ่านได้โดย PHP</li>
            </ol>
        </div>
        <?php endif; ?>

        <!-- 8. Quick Links -->
        <div class="section">
            <h2>🔗 Quick Links</h2>
            
            <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap: 10px;">
                <button onclick="location.reload()" class="button">🔄 Refresh Test</button>
                <button onclick="window.open('<?php echo dirname($_SERVER['PHP_SELF']); ?>/application/logs/log-<?php echo date('Y-m-d'); ?>.php', '_blank')" class="button">📋 View Logs</button>
                <button onclick="showPhpInfo()" class="button">ℹ️ PHP Info</button>
                <button onclick="window.open('https://github.com/googleapis/google-api-php-client', '_blank')" class="button">📚 Documentation</button>
            </div>
        </div>
    </div>

    <script>
        function showPhpInfo() {
            const phpInfo = window.open('', '_blank');
            phpInfo.document.write('<h1>PHP Information</h1>');
            phpInfo.document.write('<p><strong>PHP Version:</strong> <?php echo phpversion(); ?></p>');
            phpInfo.document.write('<p><strong>Server:</strong> <?php echo $_SERVER['SERVER_SOFTWARE'] ?? 'Unknown'; ?></p>');
            phpInfo.document.write('<p><strong>Document Root:</strong> <?php echo $_SERVER['DOCUMENT_ROOT'] ?? 'Unknown'; ?></p>');
            phpInfo.document.write('<p><strong>Include Path:</strong> <?php echo get_include_path(); ?></p>');
            phpInfo.document.write('<h2>Loaded Extensions:</h2>');
            phpInfo.document.write('<ul>');
            <?php foreach (get_loaded_extensions() as $ext): ?>
            phpInfo.document.write('<li><?php echo $ext; ?></li>');
            <?php endforeach; ?>
            phpInfo.document.write('</ul>');
        }
        
        // Auto refresh every 30 seconds if not ready
        <?php if ($percentage < 80): ?>
        setTimeout(() => {
            if (confirm('ระบบยังไม่พร้อม ต้องการรีเฟรชอัตโนมัติหรือไม่?')) {
                location.reload();
            }
        }, 30000);
        <?php endif; ?>
    </script>
</body>
</html>