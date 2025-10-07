/**
 * Session Manager - แยก Keep Alive กับ User Activity สำหรับ CodeIgniter 3
 * Keep Alive = ป้องกัน network timeout
 * User Activity = นับ timeout จริง
 * Warning System = แจ้งเตือน 2 ระดับ (5 นาที และ 1 นาที)
 * แก้ไข: JSON parsing error handling + เพิ่ม updateUserActivity function
 * เพิ่ม: PublicSessionManager สำหรับประชาชน
 * อัปเดต: เปลี่ยน logout URL ไปที่ User/logout
 * 🆕 เพิ่ม: Auto close modal เมื่อมีการเคลื่อนไหว + Toast notifications
 * 🔧 เพิ่ม: Admin Session Management Functions
 * 🔄 แก้ไข: Cross-Tab Activity Sync - sync user activity ระหว่าง tabs
 */

// ✅ ป้องกันการโหลดซ้ำของ core functions
if (typeof window.SessionManagerLoaded !== 'undefined') {
    console.warn('⚠️ session-manager.js core already loaded, skipping...');
} else {
    window.SessionManagerLoaded = true;
    console.log('📚 Loading complete session-manager.js...');

    // 🆕 Toast Notification System
    window.showToast = function(message, type = 'info', timeout = 3000) {
        try {
            // สร้าง toast element
            const toastId = 'toast_' + Date.now();
            const toastHTML = `
                <div id="${toastId}" class="toast align-items-center text-white bg-${type} border-0 position-fixed" 
                     style="top: 20px; right: 20px; z-index: 99999; min-width: 300px; border-radius: 12px; box-shadow: 0 8px 32px rgba(0,0,0,0.1);" 
                     role="alert" aria-live="assertive" aria-atomic="true">
                    <div class="d-flex">
                        <div class="toast-body">
                            <i class="bi bi-${getToastIcon(type)} me-2"></i>
                            ${message}
                        </div>
                        <button type="button" class="btn-close btn-close-white me-2 m-auto" 
                                data-bs-dismiss="toast" aria-label="Close"></button>
                    </div>
                </div>
            `;
            
            document.body.insertAdjacentHTML('beforeend', toastHTML);
            
            // Initialize Bootstrap toast หรือ fallback
            const toastElement = document.getElementById(toastId);
            if (typeof bootstrap !== 'undefined' && bootstrap.Toast) {
                const toast = new bootstrap.Toast(toastElement, { delay: timeout });
                toast.show();
                
                // Auto remove element after hide
                toastElement.addEventListener('hidden.bs.toast', () => {
                    toastElement.remove();
                });
            } else {
                // Fallback: แสดงแล้วซ่อนเอง
                setTimeout(() => {
                    toastElement.style.animation = 'slideOutRight 0.3s ease-in forwards';
                    setTimeout(() => toastElement.remove(), 300);
                }, timeout);
            }
            
            return toastElement;
        } catch (error) {
            console.error('❌ Error showing toast:', error);
            // Ultimate fallback
            console.log(`📢 ${message}`);
        }
    };

    function getToastIcon(type) {
        switch(type) {
            case 'success': return 'check-circle-fill';
            case 'danger': return 'exclamation-triangle-fill';
            case 'warning': return 'exclamation-triangle-fill';
            case 'info': return 'info-circle-fill';
            default: return 'info-circle-fill';
        }
    }

    // 🆕 Toast CSS (เพิ่มเฉพาะถ้ายังไม่มี)
    if (!document.getElementById('toast-animations-css')) {
        const toastCSS = `
            <style id="toast-animations-css">
                @keyframes slideInRight {
                    from { transform: translateX(100%); opacity: 0; }
                    to { transform: translateX(0); opacity: 1; }
                }
                @keyframes slideOutRight {
                    from { transform: translateX(0); opacity: 1; }
                    to { transform: translateX(100%); opacity: 0; }
                }
                .toast {
                    animation: slideInRight 0.3s ease-out !important;
                }
                .toast.bg-success { background: linear-gradient(135deg, #88d8c0, #6bb6ff) !important; }
                .toast.bg-warning { background: linear-gradient(135deg, #ffeaa7, #fab1a0) !important; }
                .toast.bg-danger { background: linear-gradient(135deg, #fd79a8, #fdcb6e) !important; }
                .toast.bg-info { background: linear-gradient(135deg, #74b9ff, #0984e3) !important; }
            </style>
        `;
        document.head.insertAdjacentHTML('beforeend', toastCSS);
    }

    // 🔧 Admin Session Manager (เดิม + แก้ไข Cross-Tab Sync)
    window.SessionManager = (function() {
        'use strict';
        
        let config = {
            sessionTimeout: 30 * 60 * 1000,      // 30 นาที 
            warningTime5Min: 5 * 60 * 1000,     // แจ้งเตือนเหลือ 5 นาที
            warningTime1Min: 1 * 60 * 1000,     // แจ้งเตือนเหลือ 1 นาที
            keepAliveInterval: 1 * 60 * 1000,   // keep alive ทุก 1 นาที
            maxIdleTime: 30 * 60 * 1000,         // idle สูงสุด 30 นาที
            debugMode: true,                    // เปิด debug
            keepAliveRetries: 3                 // จำนวนครั้งที่ลองใหม่
        };
        
        let timers = {
            logout: null,
            warning5Min: null,
            warning1Min: null,
            keepAlive: null
        };
        
        let state = {
            lastUserActivity: Date.now(),        // 🔑 เวลา activity จริงจากผู้ใช้
            lastKeepAlive: Date.now(),          // เวลา keep alive ล่าสุด
            warning5MinShown: false,
            warning1MinShown: false,
            isInitialized: false,
            userIsActive: true,
            keepAliveFailCount: 0,               // นับจำนวนครั้งที่ keep alive ล้มเหลว
            tabId: null                         // 🆕 ID ของ tab นี้
        };
        
        let callbacks = {
            onWarning5Min: null,
            onWarning1Min: null,
            onLogout: null,
            onError: null
        };
        
        function log(message, level = 'info') {
            if (config.debugMode) {
                const timestamp = new Date().toLocaleTimeString();
                console[level](`[AdminSessionManager ${timestamp}] ${message}`);
            }
        }
        
        function clearAllTimers() {
            Object.keys(timers).forEach(key => {
                if (timers[key]) {
                    if (key === 'keepAlive') {
                        clearInterval(timers[key]);
                    } else {
                        clearTimeout(timers[key]);
                    }
                    timers[key] = null;
                }
            });
        }

        // 🆕 สร้าง Tab ID
        function getTabId() {
            if (!state.tabId) {
                state.tabId = 'admin_tab_' + Math.random().toString(36).substr(2, 9) + '_' + Date.now();
            }
            return state.tabId;
        }

        // 🆕 Broadcast activity ไปยัง tabs อื่น
        function broadcastActivity(activityTime = null) {
            const now = activityTime || Date.now();
            const message = {
                type: 'user_activity',
                timestamp: now,
                tabId: getTabId(),
                userType: 'admin',
                lastActivity: now
            };
            
            try {
                // ใช้ CrossTabSync ถ้ามี
                if (window.CrossTabSync && typeof window.CrossTabSync.broadcast === 'function') {
                    window.CrossTabSync.broadcast(message);
                    log(`📡 Broadcasted admin activity to other tabs (time: ${new Date(now).toLocaleTimeString()})`);
                } else {
                    // Fallback: ใช้ localStorage
                    localStorage.setItem('admin_session_activity', JSON.stringify(message));
                    log(`📦 Stored admin activity in localStorage (fallback)`);
                }
            } catch (error) {
                log(`❌ Error broadcasting admin activity: ${error.message}`, 'warn');
            }
        }

        // 🆕 รับ activity จาก tabs อื่น
        function handleRemoteActivity(data) {
            if (!data || data.tabId === getTabId() || data.userType !== 'admin') {
                return; // ข้ามถ้าเป็น message จาก tab นี้เองหรือไม่ใช่ admin
            }
            
            const now = Date.now();
            const remoteActivityTime = data.lastActivity || data.timestamp;
            
            // ตรวจสอบว่า remote activity ใหม่กว่า local activity หรือไม่
            if (remoteActivityTime > state.lastUserActivity) {
                log(`🔄 Syncing admin activity from another tab (${new Date(remoteActivityTime).toLocaleTimeString()})`);
                
                // อัปเดต local activity โดยไม่ broadcast ซ้ำ
                state.lastUserActivity = remoteActivityTime;
                state.userIsActive = true;
                
                // ปิด modal ที่แสดงอยู่
                closeActiveSessionModals();
                
                // รีเซ็ต timers
                resetActivityTimers();
                
                // แสดงการแจ้งเตือน
                if (typeof window.showToast === 'function') {
                    window.showToast('🔄 Session ถูกต่ออายุจาก Tab อื่น', 'info', 2000);
                }
                
                log(`✅ Admin session synced from remote tab successfully`);
            }
        }

        // 🆕 ปิด modal ที่แสดงอยู่เมื่อมีการเคลื่อนไหว
        function closeActiveSessionModals() {
            const modalsToClose = ['sessionWarning5Min', 'sessionWarning1Min'];
            let modalClosed = false;
            
            modalsToClose.forEach(modalId => {
                const modalElement = document.getElementById(modalId);
                if (modalElement && modalElement.classList.contains('show')) {
                    try {
                        // ใช้ Bootstrap API ปิด modal
                        const modalInstance = bootstrap.Modal.getInstance(modalElement);
                        if (modalInstance) {
                            modalInstance.hide();
                            log(`📴 Auto-closed modal: ${modalId} due to user activity`);
                            modalClosed = true;
                        } else {
                            // Fallback: สร้าง instance ใหม่แล้วปิด
                            const newModalInstance = new bootstrap.Modal(modalElement);
                            newModalInstance.hide();
                            log(`📴 Auto-closed modal: ${modalId} via new instance`);
                            modalClosed = true;
                        }
                    } catch (error) {
                        log(`⚠️ Error auto-closing modal ${modalId}: ${error.message}`, 'warn');
                        
                        // Ultimate fallback: ซ่อนด้วย CSS
                        modalElement.style.display = 'none';
                        modalElement.classList.remove('show');
                        modalElement.setAttribute('aria-hidden', 'true');
                        modalElement.removeAttribute('aria-modal');
                        
                        // ล้าง backdrop
                        const backdrops = document.querySelectorAll('.modal-backdrop');
                        backdrops.forEach(backdrop => backdrop.remove());
                        document.body.classList.remove('modal-open');
                        document.body.style.removeProperty('padding-right');
                        
                        modalClosed = true;
                    }
                }
            });
            
            if (modalClosed) {
                // รีเซ็ต warning flags
                state.warning5MinShown = false;
                state.warning1MinShown = false;
                
                // แสดงข้อความแจ้งเตือนเบาๆ
                showAutoExtendNotification();
            }
        }

        // 🆕 แสดงการแจ้งเตือนเบาๆ ว่าต่ออายุแล้ว
        function showAutoExtendNotification() {
            if (typeof window.showToast === 'function') {
                window.showToast('✅ ต่ออายุ Session อัตโนมัติ (Admin)', 'success', 2000);
            } else {
                log('✅ Session extended automatically by user activity');
            }
        }
        
        // 🔄 แก้ไข: เพิ่ม broadcast เมื่อมี user activity
        function updateUserActivity() {
            const now = Date.now();
            state.lastUserActivity = now;
            state.userIsActive = true;
            
            log(`👤 Admin user activity updated at ${new Date(now).toLocaleTimeString()}`);
            
            // 🆕 Broadcast activity ไปยัง tabs อื่น
            broadcastActivity(now);
            
            // 🆕 ปิด modal ที่กำลังแสดงอยู่เมื่อมีการเคลื่อนไหว
            closeActiveSessionModals();
            
            resetActivityTimers();
        }

        function updateUserActivityManual() {
            if (!window.base_url) {
                console.error('base_url not defined');
                return;
            }
            
            $.ajax({
                url: base_url + 'System_admin/update_user_activity',
                type: 'POST',
                dataType: 'json',
                timeout: 5000,
                success: function(response) {
                    if (response.success) {
                        log('✅ Admin user activity updated manually via server');
                        updateUserActivity();
                    }
                },
                error: function(xhr, status, error) {
                    log('⚠️ Failed to update admin user activity on server: ' + error, 'warn');
                    updateUserActivity();
                }
            });
        }
        
        function resetActivityTimers() {
            if (timers.warning5Min) clearTimeout(timers.warning5Min);
            if (timers.warning1Min) clearTimeout(timers.warning1Min);
            if (timers.logout) clearTimeout(timers.logout);
            
            state.warning5MinShown = false;
            state.warning1MinShown = false;
            
            const timeSinceActivity = Date.now() - state.lastUserActivity;
            const warning5MinTimeLeft = Math.max(0, (config.sessionTimeout - config.warningTime5Min) - timeSinceActivity);
            const warning1MinTimeLeft = Math.max(0, (config.sessionTimeout - config.warningTime1Min) - timeSinceActivity);
            const logoutTimeLeft = Math.max(0, config.sessionTimeout - timeSinceActivity);
            
            timers.warning5Min = setTimeout(() => {
                show5MinWarning();
            }, warning5MinTimeLeft);
            
            timers.warning1Min = setTimeout(() => {
                show1MinWarning();
            }, warning1MinTimeLeft);
            
            timers.logout = setTimeout(() => {
                forceLogout('Admin user inactivity timeout');
            }, logoutTimeLeft);
            
            log(`⏰ Admin activity timers reset - 5Min warning in ${Math.round(warning5MinTimeLeft/1000)}s, 1Min warning in ${Math.round(warning1MinTimeLeft/1000)}s, Logout in ${Math.round(logoutTimeLeft/1000)}s`);
        }
        
        function startKeepAlive() {
            sendKeepAlive();
            timers.keepAlive = setInterval(() => {
                sendKeepAlive();
            }, config.keepAliveInterval);
            log('🔄 Admin keep alive started (every 1 minute)');
        }
        
        async function sendKeepAlive() {
            try {
                const now = Date.now();
                const timeSinceUserActivity = now - state.lastUserActivity;
                
                log(`🔄 Sending admin keep alive request...`);
                
                const response = await fetch(base_url + 'System_admin/keep_alive', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-Requested-With': 'XMLHttpRequest'
                    },
                    body: JSON.stringify({
                        last_user_activity: state.lastUserActivity,
                        time_since_activity: timeSinceUserActivity,
                        max_idle_time: config.maxIdleTime
                    }),
                    cache: 'no-cache'
                });
                
                if (!response.ok) {
                    throw new Error(`HTTP ${response.status}: ${response.statusText}`);
                }
                
                const result = await response.json();
                state.keepAliveFailCount = 0;
                state.lastKeepAlive = now;
                
                if (result.status === 'expired') {
                    log('❌ Admin session expired from server', 'warn');
                    forceLogout('Admin session expired on server');
                    return;
                }
                
                log(`✅ Admin keep alive OK`);
                
            } catch (error) {
                state.keepAliveFailCount++;
                log(`⚠️ Admin keep alive failed (${state.keepAliveFailCount}/${config.keepAliveRetries}): ${error.message}`, 'warn');
                
                if (state.keepAliveFailCount >= config.keepAliveRetries) {
                    log('❌ Too many admin keep alive failures, forcing logout', 'error');
                    forceLogout('Multiple admin keep alive network failures');
                    return;
                }
            }
        }
        
        function show5MinWarning() {
            if (state.warning5MinShown) return;
            state.warning5MinShown = true;
            log(`⚠️ Showing admin 5-minute warning`);
            
            if (callbacks.onWarning5Min) {
                callbacks.onWarning5Min();
                return;
            }
        }
        
        function show1MinWarning() {
            if (state.warning1MinShown) return;
            state.warning1MinShown = true;
            state.userIsActive = false;
            log(`🚨 Showing admin 1-minute urgent warning`);
            
            if (callbacks.onWarning1Min) {
                callbacks.onWarning1Min();
                return;
            }
        }
        
        function extendSession() {
            log('🔄 Admin user manually extended session');
            updateUserActivity();
            
            if (typeof Swal !== 'undefined') {
                Swal.close();
            }
            
            state.warning5MinShown = false;
            state.warning1MinShown = false;
            log('✅ Admin session extended successfully');
        }
        
        function forceLogout(reason = 'Unknown') {
            log(`🚪 Admin force logout: ${reason}`, 'warn');
            
            if (callbacks.onLogout) {
                callbacks.onLogout(reason);
                return;
            }
            
            clearAllTimers();
            window.location.href = 'User/logout';
        }
        
        function bindActivityEvents() {
            const events = [
                'click', 'keydown', 'scroll', 'mousemove', 
                'touchstart', 'touchend', 'focus'
            ];
            
            const throttle = (func, limit) => {
                let inThrottle;
                return function() {
                    if (!inThrottle) {
                        func.apply(this, arguments);
                        inThrottle = true;
                        setTimeout(() => inThrottle = false, limit);
                    }
                }
            };
            
            const handleActivity = throttle(() => {
                updateUserActivity();
            }, 5000);
            
            events.forEach(event => {
                document.addEventListener(event, handleActivity, { 
                    passive: true 
                });
            });
            
            log('👂 Admin activity event listeners bound');
        }

        // 🆕 ตั้งค่า listener สำหรับ remote activity
        function setupCrossTabActivitySync() {
            // Listen to localStorage changes
            window.addEventListener('storage', (event) => {
                if (event.key === 'admin_session_activity' && event.newValue) {
                    try {
                        const data = JSON.parse(event.newValue);
                        if (data.type === 'user_activity') {
                            handleRemoteActivity(data);
                        }
                    } catch (error) {
                        log(`❌ Error parsing admin activity storage: ${error.message}`, 'warn');
                    }
                }
            });
            
            // Listen to CrossTabSync broadcasts if available
            if (window.CrossTabSync && window.CrossTabSync.broadcastChannel) {
                const originalHandler = window.CrossTabSync.handleBroadcastMessage;
                window.CrossTabSync.handleBroadcastMessage = function(data) {
                    // Call original handler first
                    if (originalHandler) {
                        originalHandler.call(this, data);
                    }
                    
                    // Handle user activity specifically
                    if (data && data.type === 'user_activity') {
                        handleRemoteActivity(data);
                    }
                };
            }
            
            log('🔗 Admin cross-tab activity sync setup complete');
        }
        
        // Public API for Admin
        return {
            init: function(options = {}) {
                if (state.isInitialized) {
                    log('Admin SessionManager already initialized', 'warn');
                    return this;
                }
                
                Object.assign(config, options);
                
                state.lastUserActivity = Date.now();
                state.keepAliveFailCount = 0;
                resetActivityTimers();
                startKeepAlive();
                bindActivityEvents();
                
                // 🆕 ตั้งค่า cross-tab sync
                setupCrossTabActivitySync();
                
                state.isInitialized = true;
                log('🚀 Admin SessionManager initialized');
                
                return this;
            },
            
            setCallbacks: function(newCallbacks) {
                Object.assign(callbacks, newCallbacks);
                return this;
            },
            
            configure: function(newConfig) {
                Object.assign(config, newConfig);
                if (state.isInitialized) {
                    this.restart();
                }
                return this;
            },
            
            recordActivity: function() {
                updateUserActivity();
                return this;
            },
            
            sendKeepAlive: function() {
                return sendKeepAlive();
            },
            
            extend: function() {
                extendSession();
                return this;
            },
            
            logout: function(reason = 'Manual logout') {
                forceLogout(reason);
                return this;
            },
            
            restart: function() {
                if (!state.isInitialized) return this;
                
                clearAllTimers();
                state.lastUserActivity = Date.now();
                state.warning5MinShown = false;
                state.warning1MinShown = false;
                state.keepAliveFailCount = 0;
                resetActivityTimers();
                startKeepAlive();
                
                log('🔄 Admin SessionManager restarted');
                return this;
            },
            
            destroy: function() {
                clearAllTimers();
                state.isInitialized = false;
                state.keepAliveFailCount = 0;
                log('💥 Admin SessionManager destroyed');
                return this;
            },

            // 🆕 เพิ่ม method สำหรับปิด modal จากภายนอก
            closeSessionModals: function() {
                closeActiveSessionModals();
                return this;
            },
            
            getState: function() {
                const now = Date.now();
                const timeSinceActivity = now - state.lastUserActivity;
                const timeSinceKeepAlive = now - state.lastKeepAlive;
                
                return {
                    lastUserActivity: state.lastUserActivity,
                    lastKeepAlive: state.lastKeepAlive,
                    timeSinceUserActivity: timeSinceActivity,
                    timeSinceKeepAlive: timeSinceKeepAlive,
                    remainingTime: Math.max(0, config.sessionTimeout - timeSinceActivity),
                    timeUntil5MinWarning: Math.max(0, (config.sessionTimeout - config.warningTime5Min) - timeSinceActivity),
                    timeUntil1MinWarning: Math.max(0, (config.sessionTimeout - config.warningTime1Min) - timeSinceActivity),
                    userIsActive: state.userIsActive,
                    warning5MinShown: state.warning5MinShown,
                    warning1MinShown: state.warning1MinShown,
                    isInitialized: state.isInitialized,
                    keepAliveFailCount: state.keepAliveFailCount,
                    userType: 'admin',
                    tabId: state.tabId
                };
            },
            
            setDebugMode: function(enabled) {
                config.debugMode = enabled;
                return this;
            },
            
            resetFailCounter: function() {
                state.keepAliveFailCount = 0;
                log('🔄 Admin keep alive fail counter reset');
                return this;
            },

            // 🆕 เพิ่ม method สำหรับ sync activity จาก external
            syncActivityFromRemote: function(activityTime) {
                if (activityTime > state.lastUserActivity) {
                    handleRemoteActivity({
                        type: 'user_activity',
                        lastActivity: activityTime,
                        userType: 'admin',
                        tabId: 'external'
                    });
                }
                return this;
            }
        };
    })();

    // 🔧 Public User Session Manager (ใหม่ + แก้ไข Cross-Tab Sync)
    window.PublicSessionManager = (function() {
        'use strict';
        
        let config = {
            sessionTimeout: 30 * 60 * 1000,      // 30 นาที (สำหรับประชาชน)
            warningTime5Min: 5 * 60 * 1000,     // แจ้งเตือนเหลือ 5 นาที
            warningTime1Min: 1 * 60 * 1000,     // แจ้งเตือนเหลือ 1 นาที
            keepAliveInterval: 1 * 60 * 1000,   // keep alive ทุก 2 นาที
            maxIdleTime: 30 * 60 * 1000,         // idle สูงสุด 30 นาที
            debugMode: true,                    // เปิด debug
            keepAliveRetries: 3,                // จำนวนครั้งที่ลองใหม่
            baseUrl: window.base_url || ''      // Base URL สำหรับประชาชน
        };
        
        let timers = {
            logout: null,
            warning5Min: null,
            warning1Min: null,
            keepAlive: null
        };
        
        let state = {
            lastUserActivity: Date.now(),
            lastKeepAlive: Date.now(),
            warning5MinShown: false,
            warning1MinShown: false,
            isInitialized: false,
            userIsActive: true,
            keepAliveFailCount: 0,
            tabId: null                         // 🆕 ID ของ tab นี้
        };
        
        let callbacks = {
            onWarning5Min: null,
            onWarning1Min: null,
            onLogout: null,
            onError: null
        };
        
        function log(message, level = 'info') {
            if (config.debugMode) {
                const timestamp = new Date().toLocaleTimeString();
                console[level](`[PublicSessionManager ${timestamp}] ${message}`);
            }
        }
        
        function clearAllTimers() {
            Object.keys(timers).forEach(key => {
                if (timers[key]) {
                    if (key === 'keepAlive') {
                        clearInterval(timers[key]);
                    } else {
                        clearTimeout(timers[key]);
                    }
                    timers[key] = null;
                }
            });
        }

        // 🆕 สร้าง Tab ID
        function getTabId() {
            if (!state.tabId) {
                state.tabId = 'public_tab_' + Math.random().toString(36).substr(2, 9) + '_' + Date.now();
            }
            return state.tabId;
        }

        // 🆕 Broadcast activity ไปยัง tabs อื่น
        function broadcastActivity(activityTime = null) {
            const now = activityTime || Date.now();
            const message = {
                type: 'user_activity',
                timestamp: now,
                tabId: getTabId(),
                userType: 'public',
                lastActivity: now
            };
            
            try {
                // ใช้ PublicCrossTabSync ถ้ามี
                if (window.PublicCrossTabSync && typeof window.PublicCrossTabSync.broadcast === 'function') {
                    window.PublicCrossTabSync.broadcast(message);
                    log(`📡 Broadcasted public activity to other tabs (time: ${new Date(now).toLocaleTimeString()})`);
                } else {
                    // Fallback: ใช้ localStorage
                    localStorage.setItem('public_session_activity', JSON.stringify(message));
                    log(`📦 Stored public activity in localStorage (fallback)`);
                }
            } catch (error) {
                log(`❌ Error broadcasting public activity: ${error.message}`, 'warn');
            }
        }

        // 🆕 รับ activity จาก tabs อื่น
        function handleRemoteActivity(data) {
            if (!data || data.tabId === getTabId() || data.userType !== 'public') {
                return; // ข้ามถ้าเป็น message จาก tab นี้เองหรือไม่ใช่ public
            }
            
            const now = Date.now();
            const remoteActivityTime = data.lastActivity || data.timestamp;
            
            // ตรวจสอบว่า remote activity ใหม่กว่า local activity หรือไม่
            if (remoteActivityTime > state.lastUserActivity) {
                log(`🔄 Syncing public activity from another tab (${new Date(remoteActivityTime).toLocaleTimeString()})`);
                
                // อัปเดต local activity โดยไม่ broadcast ซ้ำ
                state.lastUserActivity = remoteActivityTime;
                state.userIsActive = true;
                
                // ปิด modal ที่แสดงอยู่
                closeActiveSessionModals();
                
                // รีเซ็ต timers
                resetActivityTimers();
                
                // แสดงการแจ้งเตือน
                if (typeof window.showToast === 'function') {
                    window.showToast('🔄 Session ถูกต่ออายุจาก Tab อื่น', 'info', 2000);
                }
                
                log(`✅ Public session synced from remote tab successfully`);
            }
        }

        // 🆕 ปิด modal ที่แสดงอยู่เมื่อมีการเคลื่อนไหว - Public version
        function closeActiveSessionModals() {
            const modalsToClose = ['sessionWarning5Min', 'sessionWarning1Min'];
            let modalClosed = false;
            
            modalsToClose.forEach(modalId => {
                const modalElement = document.getElementById(modalId);
                if (modalElement && modalElement.classList.contains('show')) {
                    try {
                        // ใช้ Bootstrap API ปิด modal
                        const modalInstance = bootstrap.Modal.getInstance(modalElement);
                        if (modalInstance) {
                            modalInstance.hide();
                            log(`📴 Auto-closed PUBLIC modal: ${modalId} due to user activity`);
                            modalClosed = true;
                        } else {
                            // Fallback: สร้าง instance ใหม่แล้วปิด
                            const newModalInstance = new bootstrap.Modal(modalElement);
                            newModalInstance.hide();
                            log(`📴 Auto-closed PUBLIC modal: ${modalId} via new instance`);
                            modalClosed = true;
                        }
                    } catch (error) {
                        log(`⚠️ Error auto-closing PUBLIC modal ${modalId}: ${error.message}`, 'warn');
                        
                        // Ultimate fallback: ซ่อนด้วย CSS
                        modalElement.style.display = 'none';
                        modalElement.classList.remove('show');
                        modalElement.setAttribute('aria-hidden', 'true');
                        modalElement.removeAttribute('aria-modal');
                        
                        // ล้าง backdrop
                        const backdrops = document.querySelectorAll('.modal-backdrop');
                        backdrops.forEach(backdrop => backdrop.remove());
                        document.body.classList.remove('modal-open');
                        document.body.style.removeProperty('padding-right');
                        
                        modalClosed = true;
                    }
                }
            });
            
            if (modalClosed) {
                // รีเซ็ต warning flags
                state.warning5MinShown = false;
                state.warning1MinShown = false;
                
                // แสดงข้อความแจ้งเตือนเบาๆ
                showAutoExtendNotification();
            }
        }

        // 🆕 แสดงการแจ้งเตือนเบาๆ ว่าต่ออายุแล้ว - Public version
        function showAutoExtendNotification() {
            if (typeof window.showToast === 'function') {
                window.showToast('✅ ต่ออายุ Session อัตโนมัติ', 'success', 2000);
            } else {
                log('✅ Public session extended automatically by user activity');
            }
        }
        
        // 🔄 แก้ไข: เพิ่ม broadcast เมื่อมี user activity
        function updateUserActivity() {
            const now = Date.now();
            state.lastUserActivity = now;
            state.userIsActive = true;
            
            log(`👤 Public user activity updated at ${new Date(now).toLocaleTimeString()}`);
            
            // 🆕 Broadcast activity ไปยัง tabs อื่น
            broadcastActivity(now);
            
            // 🆕 ปิด modal ที่กำลังแสดงอยู่เมื่อมีการเคลื่อนไหว
            closeActiveSessionModals();
            
            resetActivityTimers();
        }

        function updateUserActivityManual() {
            if (!config.baseUrl) {
                console.error('base_url not defined for public users');
                return;
            }
            
            $.ajax({
                url: config.baseUrl + 'Auth_public_mem/update_user_activity',
                type: 'POST',
                dataType: 'json',
                timeout: 5000,
                success: function(response) {
                    if (response.success) {
                        log('✅ Public user activity updated manually via server');
                        updateUserActivity();
                    }
                },
                error: function(xhr, status, error) {
                    log('⚠️ Failed to update public user activity on server: ' + error, 'warn');
                    updateUserActivity();
                }
            });
        }
        
        function resetActivityTimers() {
            if (timers.warning5Min) clearTimeout(timers.warning5Min);
            if (timers.warning1Min) clearTimeout(timers.warning1Min);
            if (timers.logout) clearTimeout(timers.logout);
            
            state.warning5MinShown = false;
            state.warning1MinShown = false;
            
            const timeSinceActivity = Date.now() - state.lastUserActivity;
            const warning5MinTimeLeft = Math.max(0, (config.sessionTimeout - config.warningTime5Min) - timeSinceActivity);
            const warning1MinTimeLeft = Math.max(0, (config.sessionTimeout - config.warningTime1Min) - timeSinceActivity);
            const logoutTimeLeft = Math.max(0, config.sessionTimeout - timeSinceActivity);
            
            timers.warning5Min = setTimeout(() => {
                show5MinWarning();
            }, warning5MinTimeLeft);
            
            timers.warning1Min = setTimeout(() => {
                show1MinWarning();
            }, warning1MinTimeLeft);
            
            timers.logout = setTimeout(() => {
                forceLogout('Public user inactivity timeout');
            }, logoutTimeLeft);
            
            log(`⏰ Public activity timers reset - 5Min warning in ${Math.round(warning5MinTimeLeft/1000)}s, 1Min warning in ${Math.round(warning1MinTimeLeft/1000)}s, Logout in ${Math.round(logoutTimeLeft/1000)}s`);
        }
        
        function startKeepAlive() {
            sendKeepAlive();
            timers.keepAlive = setInterval(() => {
                sendKeepAlive();
            }, config.keepAliveInterval);
            log('🔄 Public keep alive started (every 2 minutes)');
        }
        
        async function parseJsonResponse(response) {
            try {
                const contentType = response.headers.get('content-type');
                if (!contentType || !contentType.includes('application/json')) {
                    log(`⚠️ Response is not JSON (content-type: ${contentType})`, 'warn');
                    const textResponse = await response.text();
                    log(`📄 Response text: ${textResponse.substring(0, 200)}...`, 'warn');
                    
                    return {
                        status: 'alive',
                        message: 'Non-JSON response received, assuming alive',
                        raw_response: textResponse
                    };
                }
                
                const responseText = await response.text();
                
                if (!responseText || responseText.trim().length === 0) {
                    log('⚠️ Empty response received', 'warn');
                    return {
                        status: 'alive',
                        message: 'Empty response received, assuming alive'
                    };
                }
                
                try {
                    const jsonData = JSON.parse(responseText);
                    log(`📋 JSON parsed successfully: ${JSON.stringify(jsonData)}`);
                    return jsonData;
                } catch (parseError) {
                    log(`❌ JSON parse error: ${parseError.message}`, 'error');
                    log(`📄 Raw response: ${responseText}`, 'error');
                    
                    return {
                        status: 'alive',
                        message: 'Invalid JSON response, assuming alive',
                        error: parseError.message,
                        raw_response: responseText
                    };
                }
            } catch (error) {
                log(`❌ Error processing response: ${error.message}`, 'error');
                return {
                    status: 'error',
                    message: 'Failed to process response',
                    error: error.message
                };
            }
        }
        
        async function sendKeepAlive() {
            try {
                const baseUrl = config.baseUrl || window.base_url || window.location.origin + window.location.pathname.split('/').slice(0, -1).join('/') + '/';
                
                if (!baseUrl) {
                    throw new Error('base_url is not defined and cannot be determined for public users');
                }
                
                const now = Date.now();
                const timeSinceUserActivity = now - state.lastUserActivity;
                
                log(`🔄 Sending public keep alive request to: ${baseUrl}Auth_public_mem/keep_alive`);
                
                const response = await fetch(baseUrl + 'Auth_public_mem/keep_alive', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-Requested-With': 'XMLHttpRequest'
                    },
                    body: JSON.stringify({
                        last_user_activity: state.lastUserActivity,
                        time_since_activity: timeSinceUserActivity,
                        max_idle_time: config.maxIdleTime,
                        user_type: 'public'
                    }),
                    cache: 'no-cache'
                });
                
                log(`📡 Public keep alive response status: ${response.status} ${response.statusText}`);
                
                if (!response.ok) {
                    throw new Error(`HTTP ${response.status}: ${response.statusText}`);
                }
                
                const result = await parseJsonResponse(response);
                
                state.keepAliveFailCount = 0;
                state.lastKeepAlive = now;
                
                if (result.status === 'expired') {
                    log('❌ Public session expired from server', 'warn');
                    forceLogout('Public session expired on server');
                    return;
                }
                
                if (result.status === 'idle_timeout') {
                    log('😴 Server detected public user idle timeout', 'warn');
                    forceLogout('Public server idle timeout');
                    return;
                }
                
                if (result.status === 'error') {
                    log(`⚠️ Server error: ${result.message}`, 'warn');
                    state.keepAliveFailCount++;
                    
                    if (state.keepAliveFailCount >= config.keepAliveRetries) {
                        log('❌ Too many keep alive failures, forcing public logout', 'error');
                        forceLogout('Multiple public keep alive failures');
                        return;
                    }
                }
                
                if (result.status === 'alive') {
                    log(`✅ Public keep alive OK (user idle: ${Math.round(timeSinceUserActivity/1000)}s)`);
                } else {
                    log(`ℹ️ Public keep alive response: ${result.status} - ${result.message || 'No message'}`);
                }
                
            } catch (error) {
                state.keepAliveFailCount++;
                log(`⚠️ Public keep alive failed (${state.keepAliveFailCount}/${config.keepAliveRetries}): ${error.message}`, 'warn');
                
                if (state.keepAliveFailCount >= config.keepAliveRetries) {
                    log('❌ Too many public keep alive failures, forcing logout', 'error');
                    forceLogout('Multiple public keep alive network failures');
                    return;
                }
                
                if (callbacks.onError) {
                    callbacks.onError('Public keep alive failed', error);
                }
            }
        }
        
        function show5MinWarning() {
            if (state.warning5MinShown) return;
            
            state.warning5MinShown = true;
            const timeSinceActivity = Date.now() - state.lastUserActivity;
            const minutesIdle = Math.round(timeSinceActivity / 60000);
            
            log(`⚠️ Showing 5-minute warning for public user (idle for ${minutesIdle} minutes)`);
            
            if (callbacks.onWarning5Min) {
                callbacks.onWarning5Min(minutesIdle);
                return;
            }
            
            showDefault5MinWarning();
        }
        
        function show1MinWarning() {
            if (state.warning1MinShown) return;
            
            state.warning1MinShown = true;
            state.userIsActive = false;
            
            const timeSinceActivity = Date.now() - state.lastUserActivity;
            const minutesIdle = Math.round(timeSinceActivity / 60000);
            
            log(`🚨 Showing 1-minute urgent warning for public user (idle for ${minutesIdle} minutes)`);
            
            if (callbacks.onWarning1Min) {
                callbacks.onWarning1Min(minutesIdle);
                return;
            }
            
            showDefault1MinWarning();
        }
        
        function showDefault5MinWarning() {
            if (document.getElementById('sessionWarning5Min')) {
                log('📱 Using custom Bootstrap modal for 5min warning (public)');
                return;
            }
            
            if (typeof Swal !== 'undefined') {
                Swal.fire({
                    title: '⚠️ แจ้งเตือนการหมดเวลา (ประชาชน)',
                    html: `
                        <div style="text-align: left;">
                            <p>🕐 ระบบจะหมดเวลาใช้งานในอีก <strong>5 นาที</strong></p>
                            <p>😴 ไม่มีการใช้งานมาเป็นเวลานาน</p>
                            <hr>
                            <p>💡 <strong>หมายเหตุ:</strong> การเคลื่อนไหวเมาส์หรือพิมพ์คีย์บอร์ดจะต่ออายุ Session อัตโนมัติ</p>
                        </div>
                    `,
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonText: '🖱️ ใช้งานต่อ',
                    cancelButtonText: '🚪 ออกจากระบบ',
                    confirmButtonColor: '#28a745',
                    cancelButtonColor: '#6c757d',
                    allowOutsideClick: true,
                    allowEscapeKey: true
                }).then((result) => {
                    if (result.isConfirmed) {
                        extendSession();
                    } else if (result.dismiss === Swal.DismissReason.cancel) {
                        forceLogout('Public user chose to logout from 5min warning');
                    }
                });
            }
        }
        
        function showDefault1MinWarning() {
            if (document.getElementById('sessionWarning1Min')) {
                log('📱 Using custom Bootstrap modal for 1min warning (public)');
                return;
            }
            
            if (typeof Swal !== 'undefined') {
                Swal.fire({
                    title: '🚨 แจ้งเตือนด่วน! (ประชาชน)',
                    html: `
                        <div style="text-align: left;">
                            <p style="color: #dc3545;"><strong>🕐 ระบบจะหมดเวลาใช้งานในอีก 1 นาที!</strong></p>
                            <p>⚠️ หากไม่กดปุ่ม "ใช้งานต่อ" ทันที ระบบจะออกจากระบบอัตโนมัติ</p>
                            <hr>
                            <p>💡 <strong>หมายเหตุ:</strong> การเคลื่อนไหวเมาส์หรือพิมพ์คีย์บอร์ดจะต่ออายุ Session อัตโนมัติ</p>
                        </div>
                    `,
                    icon: 'error',
                    showCancelButton: true,
                    confirmButtonText: '🖱️ ใช้งานต่อ',
                    cancelButtonText: '🚪 ออกจากระบบ',
                    confirmButtonColor: '#28a745',
                    cancelButtonColor: '#dc3545',
                    allowOutsideClick: false,
                    allowEscapeKey: true
                }).then((result) => {
                    if (result.isConfirmed || result.isDismissed) {
                        if (result.isConfirmed) {
                            extendSession();
                        } else {
                            forceLogout('Public user chose to logout from 1min warning');
                        }
                    } else {
                        forceLogout('Public 1-minute warning timeout');
                    }
                });
            }
        }
        
        function extendSession() {
            log('🔄 Public user manually extended session');
            updateUserActivity();
            
            if (typeof Swal !== 'undefined') {
                Swal.close();
            }
            
            const modals = ['sessionWarning5Min', 'sessionWarning1Min'];
            modals.forEach(modalId => {
                const modalElement = document.getElementById(modalId);
                if (modalElement && modalElement.classList.contains('show')) {
                    try {
                        const modalInstance = bootstrap.Modal.getInstance(modalElement);
                        if (modalInstance) {
                            modalInstance.hide();
                            log(`📴 Closed modal: ${modalId}`);
                        }
                    } catch (error) {
                        log(`❌ Error closing modal ${modalId}: ${error.message}`, 'warn');
                    }
                }
            });
            
            state.warning5MinShown = false;
            state.warning1MinShown = false;
            
            log('✅ Public session extended successfully');
        }
        
        function forceLogout(reason = 'Unknown') {
            log(`🚪 Force logout (public): ${reason}`, 'warn');
            
            if (callbacks.onLogout) {
                callbacks.onLogout(reason);
                return;
            }
            
            clearAllTimers();
            
            if (typeof Swal !== 'undefined') {
                Swal.close();
            }
            
            const allModals = ['sessionWarning5Min', 'sessionWarning1Min', 'sessionLogoutModal'];
            allModals.forEach(modalId => {
                const modalElement = document.getElementById(modalId);
                if (modalElement) {
                    try {
                        const modalInstance = bootstrap.Modal.getInstance(modalElement);
                        if (modalInstance) {
                            modalInstance.hide();
                        }
                        modalElement.classList.remove('show');
                        modalElement.style.display = 'none';
                    } catch (error) {
                        log(`❌ Error closing modal ${modalId}: ${error.message}`, 'warn');
                    }
                }
            });
            
            setTimeout(() => {
                const backdrops = document.querySelectorAll('.modal-backdrop');
                backdrops.forEach(backdrop => backdrop.remove());
                document.body.classList.remove('modal-open');
                document.body.style.removeProperty('padding-right');
            }, 100);
            
            window.location.href = config.baseUrl + 'User/logout';
        }
        
        function bindActivityEvents() {
            const events = [
                'click', 'keydown', 'scroll', 'mousemove', 
                'touchstart', 'touchend', 'focus'
            ];
            
            const throttle = (func, limit) => {
                let inThrottle;
                return function() {
                    if (!inThrottle) {
                        func.apply(this, arguments);
                        inThrottle = true;
                        setTimeout(() => inThrottle = false, limit);
                    }
                }
            };
            
            const handleActivity = throttle(() => {
                updateUserActivity();
            }, 5000);
            
            events.forEach(event => {
                document.addEventListener(event, handleActivity, { 
                    passive: true 
                });
            });
            
            document.addEventListener('visibilitychange', () => {
                if (!document.hidden) {
                    log('👁️ Public user tab became visible');
                    sendKeepAlive();
                }
            });
            
            window.addEventListener('beforeunload', () => {
                clearAllTimers();
            });
            
            log('👂 Public activity event listeners bound');
        }

        // 🆕 ตั้งค่า listener สำหรับ remote activity
        function setupCrossTabActivitySync() {
            // Listen to localStorage changes
            window.addEventListener('storage', (event) => {
                if (event.key === 'public_session_activity' && event.newValue) {
                    try {
                        const data = JSON.parse(event.newValue);
                        if (data.type === 'user_activity') {
                            handleRemoteActivity(data);
                        }
                    } catch (error) {
                        log(`❌ Error parsing public activity storage: ${error.message}`, 'warn');
                    }
                }
            });
            
            // Listen to PublicCrossTabSync broadcasts if available
            if (window.PublicCrossTabSync && window.PublicCrossTabSync.broadcastChannel) {
                const originalHandler = window.PublicCrossTabSync.handleBroadcastMessage;
                window.PublicCrossTabSync.handleBroadcastMessage = function(data) {
                    // Call original handler first
                    if (originalHandler) {
                        originalHandler.call(this, data);
                    }
                    
                    // Handle user activity specifically
                    if (data && data.type === 'user_activity') {
                        handleRemoteActivity(data);
                    }
                };
            }
            
            log('🔗 Public cross-tab activity sync setup complete');
        }
        
        // Public API for Public Users
        return {
            init: function(options = {}) {
                if (state.isInitialized) {
                    log('Public SessionManager already initialized', 'warn');
                    return this;
                }
                
                Object.assign(config, options);
                
                state.lastUserActivity = Date.now();
                state.keepAliveFailCount = 0;
                resetActivityTimers();
                startKeepAlive();
                bindActivityEvents();
                
                // 🆕 ตั้งค่า cross-tab sync
                setupCrossTabActivitySync();
                
                state.isInitialized = true;
                log('🚀 Public SessionManager initialized successfully');
                
                return this;
            },
            
            setCallbacks: function(newCallbacks) {
                Object.assign(callbacks, newCallbacks);
                return this;
            },
            
            configure: function(newConfig) {
                Object.assign(config, newConfig);
                if (state.isInitialized) {
                    this.restart();
                }
                return this;
            },
            
            recordActivity: function() {
                updateUserActivity();
                return this;
            },
            
            sendKeepAlive: function() {
                return sendKeepAlive();
            },
            
            extend: function() {
                extendSession();
                return this;
            },
            
            logout: function(reason = 'Manual logout') {
                forceLogout(reason);
                return this;
            },

            // 🆕 เพิ่ม method สำหรับปิด modal จากภายนอก
            closeSessionModals: function() {
                closeActiveSessionModals();
                return this;
            },
            
            restart: function() {
                if (!state.isInitialized) return this;
                
                clearAllTimers();
                state.lastUserActivity = Date.now();
                state.warning5MinShown = false;
                state.warning1MinShown = false;
                state.keepAliveFailCount = 0;
                resetActivityTimers();
                startKeepAlive();
                
                log('🔄 Public SessionManager restarted');
                return this;
            },
            
            destroy: function() {
                clearAllTimers();
                state.isInitialized = false;
                state.keepAliveFailCount = 0;
                log('💥 Public SessionManager destroyed');
                return this;
            },
            
            getState: function() {
                const now = Date.now();
                const timeSinceActivity = now - state.lastUserActivity;
                const timeSinceKeepAlive = now - state.lastKeepAlive;
                
                return {
                    lastUserActivity: state.lastUserActivity,
                    lastKeepAlive: state.lastKeepAlive,
                    timeSinceUserActivity: timeSinceActivity,
                    timeSinceKeepAlive: timeSinceKeepAlive,
                    remainingTime: Math.max(0, config.sessionTimeout - timeSinceActivity),
                    timeUntil5MinWarning: Math.max(0, (config.sessionTimeout - config.warningTime5Min) - timeSinceActivity),
                    timeUntil1MinWarning: Math.max(0, (config.sessionTimeout - config.warningTime1Min) - timeSinceActivity),
                    userIsActive: state.userIsActive,
                    warning5MinShown: state.warning5MinShown,
                    warning1MinShown: state.warning1MinShown,
                    isInitialized: state.isInitialized,
                    keepAliveFailCount: state.keepAliveFailCount,
                    userType: 'public',
                    tabId: state.tabId
                };
            },
            
            setDebugMode: function(enabled) {
                config.debugMode = enabled;
                return this;
            },
            
            resetFailCounter: function() {
                state.keepAliveFailCount = 0;
                log('🔄 Public keep alive fail counter reset');
                return this;
            },

            // 🆕 เพิ่ม method สำหรับ sync activity จาก external
            syncActivityFromRemote: function(activityTime) {
                if (activityTime > state.lastUserActivity) {
                    handleRemoteActivity({
                        type: 'user_activity',
                        lastActivity: activityTime,
                        userType: 'public',
                        tabId: 'external'
                    });
                }
                return this;
            }
        };
    })();

    // 🌟 Cross-Tab Session Manager (เดิม + แก้ไข Activity Sync)
    class CrossTabSessionManager {
        constructor() {
            this.storageKey = 'app_session_status';
            this.heartbeatKey = 'app_session_heartbeat';
            this.broadcastChannel = null;
            this.heartbeatInterval = null;
            this.sessionCheckInterval = null;
            this.isInitialized = false;
            this.currentSessionId = null;
            
            this.config = {
                heartbeatInterval: 5000,
                sessionCheckInterval: 2000,
                maxHeartbeatAge: 15000
            };
            
            this.init();
        }
        
        init() {
            if (this.isInitialized) return;
            
            console.log('🔄 Initializing Cross-Tab Session Manager');
            
            this.setupBroadcastChannel();
            this.setupStorageListener();
            this.startHeartbeat();
            this.startSessionCheck();
            this.updateSessionStatus();
            
            this.isInitialized = true;
            console.log('✅ Cross-Tab Session Manager initialized');
        }
        
        setupBroadcastChannel() {
            if ('BroadcastChannel' in window) {
                this.broadcastChannel = new BroadcastChannel('session_sync');
                
                this.broadcastChannel.addEventListener('message', (event) => {
                    console.log('📨 Received broadcast message:', event.data);
                    this.handleBroadcastMessage(event.data);
                });
                
                console.log('📡 BroadcastChannel setup complete');
            } else {
                console.log('⚠️ BroadcastChannel not supported, using LocalStorage fallback');
            }
        }
        
        setupStorageListener() {
            window.addEventListener('storage', (event) => {
                if (event.key === this.storageKey) {
                    console.log('📦 Storage change detected:', event.newValue);
                    this.handleStorageChange(event.newValue);
                }
            });
        }
        
        startHeartbeat() {
            this.heartbeatInterval = setInterval(() => {
                if (this.isLoggedIn()) {
                    this.sendHeartbeat();
                }
            }, this.config.heartbeatInterval);
        }
        
        startSessionCheck() {
            this.sessionCheckInterval = setInterval(() => {
                this.checkSessionStatus();
            }, this.config.sessionCheckInterval);
        }
        
        broadcast(message) {
            const data = {
                timestamp: Date.now(),
                tabId: this.getTabId(),
                ...message
            };
            
            if (this.broadcastChannel) {
                this.broadcastChannel.postMessage(data);
            }
            
            localStorage.setItem(this.storageKey, JSON.stringify(data));
            console.log('📤 Broadcast sent:', data);
        }
        
        handleBroadcastMessage(data) {
            if (!data || data.tabId === this.getTabId()) return;
            
            switch (data.type) {
                case 'logout':
                    this.handleRemoteLogout(data);
                    break;
                case 'login':
                    this.handleRemoteLogin(data);
                    break;
                case 'session_expired':
                    this.handleRemoteSessionExpired(data);
                    break;
                case 'heartbeat':
                    this.handleRemoteHeartbeat(data);
                    break;
                case 'user_activity':
                    this.handleRemoteUserActivity(data);
                    break;
            }
        }

        // 🆕 จัดการ user activity จาก tabs อื่น
        handleRemoteUserActivity(data) {
            if (!data || data.tabId === this.getTabId()) return;
            
            console.log('🔄 Remote user activity detected:', data);
            
            // Sync กับ SessionManager หรือ PublicSessionManager ตามประเภท
            if (data.userType === 'admin' && window.SessionManager && window.SessionManager.syncActivityFromRemote) {
                window.SessionManager.syncActivityFromRemote(data.lastActivity || data.timestamp);
            } else if (data.userType === 'public' && window.PublicSessionManager && window.PublicSessionManager.syncActivityFromRemote) {
                window.PublicSessionManager.syncActivityFromRemote(data.lastActivity || data.timestamp);
            }
        }
        
        handleStorageChange(newValue) {
            if (!newValue) return;
            
            try {
                const data = JSON.parse(newValue);
                this.handleBroadcastMessage(data);
            } catch (error) {
                console.error('Error parsing storage data:', error);
            }
        }
        
        handleRemoteLogout(data) {
            console.log('🚪 Remote logout detected');
            
            if (this.isLoggedIn()) {
                this.performLocalLogout();
                this.showLogoutNotification('คุณได้ออกจากระบบในแท็บอื่น');
            }
        }
        
        handleRemoteLogin(data) {
            console.log('🔐 Remote login detected');
            
            if (!this.isLoggedIn() && data.sessionId) {
                this.currentSessionId = data.sessionId;
                this.updateSessionStatus();
                
                setTimeout(() => {
                    window.location.reload();
                }, 1000);
            }
        }
        
        handleRemoteSessionExpired(data) {
            console.log('⏰ Remote session expired detected');
            
            if (this.isLoggedIn()) {
                this.performLocalLogout();
                this.showSessionExpiredNotification();
            }
        }
        
        handleRemoteHeartbeat(data) {
            localStorage.setItem(this.heartbeatKey, JSON.stringify({
                timestamp: data.timestamp,
                tabId: data.tabId
            }));
        }
        
        checkSessionStatus() {
            const lastHeartbeat = this.getLastHeartbeat();
            const now = Date.now();
            
            if (lastHeartbeat && (now - lastHeartbeat.timestamp) > this.config.maxHeartbeatAge) {
                console.log('💀 No heartbeat from other tabs, checking server session');
                this.verifyServerSession();
            }
        }
        
        async verifyServerSession() {
            try {
                const response = await fetch(window.base_url + 'User/verify_session', {
                    method: 'POST',
                    headers: {
                        'X-Requested-With': 'XMLHttpRequest',
                        'Content-Type': 'application/json'
                    },
                    credentials: 'same-origin'
                });
                
                const result = await response.json();
                
                if (!result.valid) {
                    console.log('❌ Server session invalid');
                    this.broadcast({ type: 'session_expired' });
                    this.performLocalLogout();
                }
            } catch (error) {
                console.error('Error verifying session:', error);
            }
        }
        
        sendHeartbeat() {
            this.broadcast({ 
                type: 'heartbeat',
                sessionId: this.getCurrentSessionId()
            });
        }
        
        getTabId() {
            if (!this.tabId) {
                this.tabId = 'tab_' + Math.random().toString(36).substr(2, 9) + '_' + Date.now();
            }
            return this.tabId;
        }
        
        isLoggedIn() {
            return !!(document.cookie.includes('ci_session') || 
                     window.sessionStorage.getItem('user_logged_in') ||
                     this.currentSessionId);
        }
        
        getCurrentSessionId() {
            if (!this.currentSessionId) {
                const matches = document.cookie.match(/ci_session=([^;]+)/);
                this.currentSessionId = matches ? matches[1] : null;
            }
            return this.currentSessionId;
        }
        
        updateSessionStatus() {
            const status = {
                isLoggedIn: this.isLoggedIn(),
                sessionId: this.getCurrentSessionId(),
                timestamp: Date.now(),
                tabId: this.getTabId()
            };
            
            localStorage.setItem(this.storageKey, JSON.stringify(status));
        }
        
        getLastHeartbeat() {
            try {
                const data = localStorage.getItem(this.heartbeatKey);
                return data ? JSON.parse(data) : null;
            } catch (error) {
                return null;
            }
        }
        
        performLocalLogout() {
            console.log('🚪 Performing local logout');
            
            this.currentSessionId = null;
            localStorage.removeItem(this.storageKey);
            localStorage.removeItem(this.heartbeatKey);
            sessionStorage.clear();
            
            this.updateSessionStatus();
            
            if (this.heartbeatInterval) {
                clearInterval(this.heartbeatInterval);
            }
            
            setTimeout(() => {
                window.location.href = window.base_url + 'User/logout';
            }, 1500);
        }
        
        showLogoutNotification(message = 'คุณได้ออกจากระบบ') {
            if (typeof window.showToast === 'function') {
                window.showToast(message, 'info', 3000);
            } else if (typeof Swal !== 'undefined') {
                Swal.fire({
                    icon: 'info',
                    title: 'ออกจากระบบ',
                    text: message,
                    timer: 3000,
                    showConfirmButton: false,
                    position: 'top-end',
                    toast: true
                });
            } else {
                alert(message);
            }
        }
        
        showSessionExpiredNotification() {
            if (typeof window.showToast === 'function') {
                window.showToast('Session หมดอายุ กรุณาเข้าสู่ระบบใหม่', 'warning', 5000);
            } else if (typeof Swal !== 'undefined') {
                Swal.fire({
                    icon: 'warning',
                    title: 'Session หมดอายุ',
                    text: 'กรุณาเข้าสู่ระบบใหม่',
                    confirmButtonText: 'ตกลง',
                    allowOutsideClick: false
                }).then(() => {
                    window.location.href = window.base_url + 'User/logout';
                });
            } else {
                alert('Session หมดอายุ กรุณาเข้าสู่ระบบใหม่');
                window.location.href = window.base_url + 'User/logout';
            }
        }
        
        logout() {
            console.log('🚪 Logout initiated from this tab');
            
            this.broadcast({ 
                type: 'logout',
                sessionId: this.getCurrentSessionId()
            });
            
            this.performLocalLogout();
        }
        
        login(sessionId) {
            console.log('🔐 Login initiated from this tab');
            
            this.currentSessionId = sessionId;
            this.updateSessionStatus();
            
            this.broadcast({ 
                type: 'login',
                sessionId: sessionId
            });
        }
        
        destroy() {
            console.log('🛑 Destroying Cross-Tab Session Manager');
            
            if (this.heartbeatInterval) {
                clearInterval(this.heartbeatInterval);
            }
            
            if (this.sessionCheckInterval) {
                clearInterval(this.sessionCheckInterval);
            }
            
            if (this.broadcastChannel) {
                this.broadcastChannel.close();
            }
            
            this.isInitialized = false;
        }
    }

    // 🌟 สร้าง instance
    window.CrossTabSync = new CrossTabSessionManager();

    // 🔗 เชื่อมต่อกับ Session Manager
    if (window.SessionManager) {
        const originalLogout = window.SessionManager.logout;
        window.SessionManager.logout = function(reason) {
            console.log('SessionManager logout called, syncing to other tabs');
            window.CrossTabSync.logout();
            if (originalLogout) {
                originalLogout.call(this, reason);
            }
        };
        
        console.log('🔗 SessionManager integration complete');
    }

    // 🔧 Global functions
    window.syncLogout = function() {
        window.CrossTabSync.logout();
    };

    window.syncLogin = function(sessionId) {
        window.CrossTabSync.login(sessionId);
    };

    // 🧪 Enhanced Testing Functions (เพิ่ม cross-tab test)
    window.testAutoCloseModal = function() {
        console.log('🧪 Testing auto-close modal functionality...');
        
        // Test with PublicSessionManager if available
        if (typeof window.PublicSessionManager !== 'undefined' && window.PublicSessionManager.getState().isInitialized) {
            console.log('📱 Testing with PublicSessionManager...');
            
            // Trigger 5min warning
            if (window.PublicSessionManager.getState().warning5MinShown === false) {
                // Manually show warning by calling callback
                const callbacks = window.PublicSessionManager.setCallbacks({
                    onWarning5Min: function(minutesIdle) {
                        if (typeof showSessionWarning === 'function') {
                            showSessionWarning('5min');
                        }
                    }
                });
                
                // Force trigger warning (for testing)
                setTimeout(() => {
                    if (typeof showSessionWarning === 'function') {
                        showSessionWarning('5min');
                    }
                    
                    // Simulate mouse movement after 3 seconds
                    setTimeout(() => {
                        console.log('🎭 Simulating mouse movement...');
                        
                        const mouseEvent = new MouseEvent('mousemove', {
                            clientX: Math.random() * window.innerWidth,
                            clientY: Math.random() * window.innerHeight,
                            bubbles: true
                        });
                        
                        document.dispatchEvent(mouseEvent);
                        console.log('✅ Mouse event dispatched - modal should close automatically');
                    }, 3000);
                }, 1000);
            }
        } else {
            console.log('⚠️ PublicSessionManager not initialized - cannot test');
        }
    };

    // 🆕 ทดสอบ Cross-Tab Activity Sync
    window.testCrossTabActivitySync = function() {
        console.log('🧪 Testing Cross-Tab Activity Sync...');
        
        // Test Admin Session Manager
        if (window.SessionManager && window.SessionManager.getState().isInitialized) {
            console.log('📱 Broadcasting admin activity...');
            window.SessionManager.recordActivity();
            console.log('✅ Admin activity broadcasted - check other tabs');
        }
        
        // Test Public Session Manager
        if (window.PublicSessionManager && window.PublicSessionManager.getState().isInitialized) {
            console.log('📱 Broadcasting public activity...');
            window.PublicSessionManager.recordActivity();
            console.log('✅ Public activity broadcasted - check other tabs');
        }
        
        // Show current state
        setTimeout(() => {
            console.log('=== SESSION STATES ===');
            if (window.SessionManager) {
                console.log('Admin State:', window.SessionManager.getState());
            }
            if (window.PublicSessionManager) {
                console.log('Public State:', window.PublicSessionManager.getState());
            }
            console.log('=== END STATES ===');
        }, 1000);
    };

    window.testToastNotification = function() {
        if (typeof window.showToast === 'function') {
            window.showToast('🧪 ทดสอบ Toast Notification', 'success', 5000);
        } else {
            console.log('❌ showToast function not available');
        }
    };

    console.log('✅ Complete Session Management System loaded with Cross-Tab Activity Sync');
    console.log('🎯 Test functions: testAutoCloseModal(), testCrossTabActivitySync(), testToastNotification()');
}

// 🚀 ADMIN FUNCTIONS - โหลดทุกครั้ง (นอก condition)
if (typeof window.initializeAdminSessionManager === 'undefined') {
    console.log('📚 Loading Admin Session Management functions...');
    
    /**
     * ฟังก์ชันเริ่มต้น ADMIN Session Manager
     */
    window.initializeAdminSessionManager = function(hasAdminSession = false) {
        if (!hasAdminSession) {
            console.log('ℹ️ Admin user not logged in, SessionManager not initialized');
            return;
        }

        if (typeof window.SessionManager !== 'undefined') {
            window.SessionManager.init({
                sessionTimeout: 30 * 60 * 1000,      // 30 นาที (production)
                warningTime5Min: 5 * 60 * 1000,     // แจ้งเตือนเหลือ 5 นาที
                warningTime1Min: 1 * 60 * 1000,     // แจ้งเตือนเหลือ 1 นาที
                keepAliveInterval: 1 * 60 * 1000,   // keep alive ทุก 1 นาที
                maxIdleTime: 30 * 60 * 1000,         // idle สูงสุด 30 นาที
                debugMode: true
            }).setCallbacks({
                onWarning5Min: function(minutesIdle) {
                    console.log('📢 ADMIN: 5-minute warning triggered');
                    window.showAdminSessionWarning('5min');
                },
                onWarning1Min: function(minutesIdle) {
                    console.log('🚨 ADMIN: 1-minute warning triggered');
                    window.showAdminSessionWarning('1min');
                },
                onLogout: function(reason) {
                    console.log('🚪 ADMIN: Session logout reason:', reason);
                    window.showAdminLogoutModal();
                },
                onError: function(message, error) {
                    console.error('❌ ADMIN SessionManager error:', message, error);
                }
            });
            
            console.log('✅ Admin SessionManager initialized successfully');
            console.log('🌐 Base URL set to:', window.base_url);
        } else {
            console.error('❌ SessionManager not found! Using fallback...');
            window.startAdminFallbackSessionManager();
        }
    };

    /**
     * Fallback Session Manager สำหรับ Admin
     */
    window.startAdminFallbackSessionManager = function() {
        let sessionTimeout = 30 * 60 * 1000; // 130 นาที
        let warningTimeout5Min = 5 * 60 * 1000; // 5 นาที
        let warningTimeout1Min = 1 * 60 * 1000; // 1 นาที
        
        console.log('🔄 Starting admin fallback session manager');
        
        setTimeout(() => {
            window.showAdminSessionWarning('5min');
        }, sessionTimeout - warningTimeout5Min);
        
        setTimeout(() => {
            window.showAdminSessionWarning('1min');
        }, sessionTimeout - warningTimeout1Min);
        
        setTimeout(() => {
            window.location.href = window.base_url + 'User/logout';
        }, sessionTimeout);
    };

    /**
     * สร้าง Admin Session Modals ถ้ายังไม่มี
     */
    window.createAdminSessionModalsIfNeeded = function() {
        if (document.getElementById('sessionWarning5Min')) {
            console.log('ℹ️ Admin session modals already exist');
            return;
        }
        
        console.log('🏗️ Creating admin session modals dynamically...');
        
        const modalCSS = `
            <style id="admin-session-modal-css">
                @keyframes pulse {
                    0% { transform: scale(1); }
                    50% { transform: scale(1.1); }
                    100% { transform: scale(1); }
                }
                .admin-timeout-icon i, .admin-logout-icon i { animation: pulse 2s infinite; }
                .admin-timeout-title, .admin-logout-title { font-weight: 600; margin-bottom: 15px; }
                .admin-timeout-message, .admin-logout-message { line-height: 1.6; color: #666; }
                .modal { z-index: 9999 !important; }
                .modal-backdrop { z-index: 9998 !important; }
                .modal-dialog { z-index: 10000 !important; position: relative; }
                .modal-content { position: relative; z-index: 10001 !important; border: none; box-shadow: 0 10px 30px rgba(0,0,0,0.3); }
            </style>
        `;
        
        // เพิ่ม CSS ถ้ายังไม่มี
        if (!document.getElementById('admin-session-modal-css')) {
            document.head.insertAdjacentHTML('beforeend', modalCSS);
        }
        
        const modalHTML = `
            <!-- Admin Session Warning Modals -->
            <div class="modal fade" id="sessionWarning5Min" tabindex="-1" data-bs-backdrop="static" data-bs-keyboard="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content" style="border-radius: 20px; border: none; box-shadow: 0 15px 50px rgba(0,0,0,0.2);">
                        <div class="modal-header" style="background: linear-gradient(135deg, #ffeaa7, #fab1a0); color: #2d3748; border-radius: 20px 20px 0 0; border-bottom: none;">
                            <h5 class="modal-title" style="font-weight: 600;">
                                <i class="fas fa-exclamation-triangle me-2"></i>
                                แจ้งเตือนการหมดเวลา (เจ้าหน้าที่)
                            </h5>
                        </div>
                        <div class="modal-body text-center py-4">
                            <div class="admin-timeout-icon mb-3">
                                <i class="fas fa-clock" style="font-size: 4rem; color: #ffeaa7;"></i>
                            </div>
                            <h4 class="admin-timeout-title font-weight-bold mb-3" style="color: #2d3748;">ระบบจะหมดเวลาใช้งานในอีก 5 นาที</h4>
                            <p class="admin-timeout-message mb-4" style="color: #4a5568; line-height: 1.6;">
                                ระบบตรวจพบว่าคุณไม่มีการใช้งานเป็นเวลานาน<br>
                                หากไม่มีการใช้งาน ระบบจะออกจากระบบอัตโนมัติ
                            </p>
                            <div class="alert alert-info" style="background: rgba(116, 185, 255, 0.1); border: 1px solid rgba(116, 185, 255, 0.3); border-radius: 12px; color: #2d3748;">
                                <i class="fas fa-info-circle me-2"></i>การเคลื่อนไหวเมาส์หรือพิมพ์คีย์บอร์ดจะต่ออายุ Session อัตโนมัติ
                            </div>
                        </div>
                        <div class="modal-footer justify-content-center border-0 pb-4">
                            <button type="button" class="btn btn-primary btn-lg me-3" id="extend5MinBtn" style="background: linear-gradient(135deg, #88d8c0, #6bb6ff); border: none; border-radius: 12px; padding: 12px 30px; font-weight: 500;">
                                <i class="fas fa-redo me-2"></i>ใช้งานต่อ
                            </button>
                            <button type="button" class="btn btn-outline-secondary" id="logout5MinBtn" style="border-radius: 12px; padding: 12px 30px; font-weight: 500;">
                                <i class="fas fa-sign-out-alt me-1"></i>ออกจากระบบ
                            </button>
                        </div>
                    </div>
                </div>
            </div>

            <div class="modal fade" id="sessionWarning1Min" tabindex="-1" data-bs-backdrop="static" data-bs-keyboard="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content" style="border-radius: 20px; border: none; box-shadow: 0 15px 50px rgba(0,0,0,0.2);">
                        <div class="modal-header" style="background: linear-gradient(135deg, #fd79a8, #fdcb6e); color: #fff; border-radius: 20px 20px 0 0; border-bottom: none;">
                            <h5 class="modal-title" style="font-weight: 600;">
                                <i class="fas fa-exclamation-triangle me-2"></i>
                                แจ้งเตือนด่วน! (เจ้าหน้าที่)
                            </h5>
                        </div>
                        <div class="modal-body text-center py-4">
                            <div class="admin-timeout-icon mb-3">
                                <i class="fas fa-clock" style="font-size: 4rem; color: #fd79a8;"></i>
                            </div>
                            <h4 class="admin-timeout-title font-weight-bold mb-3" style="color: #e53e3e;">ระบบจะหมดเวลาใช้งานในอีก 1 นาที!</h4>
                            <p class="admin-timeout-message mb-4" style="color: #4a5568; line-height: 1.6;">
                                <strong>คำเตือน:</strong> หากไม่กดปุ่ม "ใช้งานต่อ" ทันที<br>
                                ระบบจะออกจากระบบอัตโนมัติในอีกไม่ช้า
                            </p>
                            <div class="alert alert-danger" style="background: rgba(253, 121, 168, 0.1); border: 1px solid rgba(253, 121, 168, 0.3); border-radius: 12px; color: #e53e3e;">
                                <i class="fas fa-exclamation-triangle me-2"></i>การเคลื่อนไหวเมาส์หรือพิมพ์คีย์บอร์ดจะต่ออายุ Session อัตโนมัติ
                            </div>
                        </div>
                        <div class="modal-footer justify-content-center border-0 pb-4">
                            <button type="button" class="btn btn-success btn-lg me-3" id="extend1MinBtn" style="background: linear-gradient(135deg, #88d8c0, #6bb6ff); border: none; border-radius: 12px; padding: 12px 30px; font-weight: 500;">
                                <i class="fas fa-redo me-2"></i>ใช้งานต่อ
                            </button>
                            <button type="button" class="btn btn-outline-secondary" id="logout1MinBtn" style="border-radius: 12px; padding: 12px 30px; font-weight: 500;">
                                <i class="fas fa-sign-out-alt me-1"></i>ออกจากระบบ
                            </button>
                        </div>
                    </div>
                </div>
            </div>

            <div class="modal fade" id="sessionLogoutModal" tabindex="-1" data-bs-backdrop="static" data-bs-keyboard="false">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content" style="border-radius: 20px; border: none; box-shadow: 0 15px 50px rgba(0,0,0,0.2);">
                        <div class="modal-header" style="background: linear-gradient(135deg, #74b9ff, #0984e3); color: #fff; border-radius: 20px 20px 0 0; border-bottom: none;">
                            <h5 class="modal-title" style="font-weight: 600;">
                                <i class="fas fa-info-circle me-2"></i>
                                กำลังนำท่านกลับสู่ระบบล็อกอิน
                            </h5>
                        </div>
                        <div class="modal-body text-center py-4">
                            <div class="admin-logout-icon mb-3">
                                <i class="fas fa-sign-out-alt" style="font-size: 4rem; color: #74b9ff;"></i>
                            </div>
                            <h4 class="admin-logout-title font-weight-bold mb-3" style="color: #2d3748;">Session หมดอายุแล้ว</h4>
                            <p class="admin-logout-message mb-4" style="color: #4a5568; line-height: 1.6;">
                                เรากำลังนำท่านกลับไปสู่ระบบล็อกอินใหม่<br>
                                กรุณารอสักครู่...
                            </p>
                            <div class="progress mt-3 mb-3" style="height: 8px; border-radius: 12px; background: rgba(0,0,0,0.05);">
                                <div class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar" style="width: 100%; background: linear-gradient(135deg, #74b9ff, #0984e3); border-radius: 12px;"></div>
                            </div>
                            <small class="text-muted">หน้านี้จะถูกเปลี่ยนเส้นทางอัตโนมัติ</small>
                        </div>
                    </div>
                </div>
            </div>
        `;
        
        document.body.insertAdjacentHTML('beforeend', modalHTML);
        console.log('✅ Admin session modals created dynamically');
    };

    /**
     * ฟังก์ชันแสดง Admin Session Warning Modal
     */
    window.showAdminSessionWarning = function(type) {
        const modalId = type === '1min' ? 'sessionWarning1Min' : 'sessionWarning5Min';
        
        if (type === '1min') {
            window.closeAdminModal('sessionWarning5Min');
        }
        
        const modalElement = document.getElementById(modalId);
        if (modalElement) {
            try {
                if (!modalElement.classList.contains('show')) {
                    const modal = new bootstrap.Modal(modalElement, {
                        backdrop: 'static',
                        keyboard: true
                    });
                    modal.show();
                    console.log(`✅ ADMIN Session warning modal shown: ${type}`);
                }
            } catch (error) {
                console.error(`❌ Error showing admin modal ${modalId}:`, error);
                window.showAdminSweetAlertWarning(type);
            }
        } else {
            console.error(`❌ Admin modal element ${modalId} not found`);
            window.showAdminSweetAlertWarning(type);
        }
    };

    /**
     * แสดง Admin Logout Modal
     */
    window.showAdminLogoutModal = function() {
        window.closeAdminModal('sessionWarning5Min');
        window.closeAdminModal('sessionWarning1Min');
        
        const modalElement = document.getElementById('sessionLogoutModal');
        if (modalElement) {
            try {
                const modal = new bootstrap.Modal(modalElement, {
                    backdrop: 'static',
                    keyboard: false
                });
                modal.show();
                
                setTimeout(() => {
                    window.location.href = window.base_url + 'User/logout';
                }, 3000);
                
                console.log('✅ ADMIN Logout modal shown, redirecting in 3 seconds...');
            } catch (error) {
                console.error('❌ Error showing admin logout modal:', error);
                window.location.href = window.base_url + 'User/logout';
            }
        } else {
            console.error('❌ Admin logout modal element not found');
            window.location.href = window.base_url + 'User/logout';
        }
    };

    /**
     * ตั้งค่า Event Listeners สำหรับ Admin Modal Buttons
     */
    window.setupAdminModalEventListeners = function() {
        document.addEventListener('click', function(e) {
            const target = e.target;
            
            if (target.id === 'extend5MinBtn' || target.id === 'extend1MinBtn') {
                e.preventDefault();
                console.log(`${target.id} clicked (ADMIN)`);
                
                if (window.SessionManager) {
                    window.SessionManager.extend();
                }
                
                const modalId = target.id === 'extend5MinBtn' ? 'sessionWarning5Min' : 'sessionWarning1Min';
                window.closeAdminModal(modalId);
                window.showAdminAlert('✅ ต่ออายุ Session สำเร็จ', 'success');
            }
            
            if (target.id === 'logout5MinBtn' || target.id === 'logout1MinBtn') {
                e.preventDefault();
                console.log(`${target.id} clicked (ADMIN)`);
                
                if (window.SessionManager) {
                    window.SessionManager.logout('Admin user chose to logout from modal');
                } else {
                    window.location.href = window.base_url + 'User/logout';
                }
            }
        });
        
        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape') {
                const modal5Min = document.getElementById('sessionWarning5Min');
                const modal1Min = document.getElementById('sessionWarning1Min');
                
                if (modal5Min && modal5Min.classList.contains('show')) {
                    console.log('ESC pressed on admin 5min modal - extending session');
                    if (window.SessionManager) {
                        window.SessionManager.extend();
                    }
                    window.closeAdminModal('sessionWarning5Min');
                    window.showAdminAlert('✅ ต่ออายุ Session สำเร็จ', 'success');
                } else if (modal1Min && modal1Min.classList.contains('show')) {
                    console.log('ESC pressed on admin 1min modal - extending session');
                    if (window.SessionManager) {
                        window.SessionManager.extend();
                    }
                    window.closeAdminModal('sessionWarning1Min');
                    window.showAdminAlert('✅ ต่ออายุ Session สำเร็จ', 'success');
                }
            }
        });
        
        console.log('✅ ADMIN Modal event listeners setup complete');
    };

    /**
     * Helper Functions สำหรับ Admin
     */
    window.closeAdminModal = function(modalId) {
        const modalElement = document.getElementById(modalId);
        if (modalElement) {
            try {
                const modalInstance = bootstrap.Modal.getInstance(modalElement);
                if (modalInstance) {
                    modalInstance.hide();
                } else {
                    const newModalInstance = new bootstrap.Modal(modalElement);
                    newModalInstance.hide();
                }
                
                setTimeout(() => {
                    const backdrops = document.querySelectorAll('.modal-backdrop');
                    backdrops.forEach(backdrop => backdrop.remove());
                    document.body.classList.remove('modal-open');
                    document.body.style.removeProperty('padding-right');
                    document.body.style.removeProperty('overflow');
                }, 300);
            } catch (error) {
                console.error(`❌ Error closing admin modal ${modalId}:`, error);
            }
        }
    };

    window.showAdminAlert = function(message, type = 'info', timeout = 5000) {
        try {
            const alertId = 'alert_' + Date.now();
            const alertHTML = `
                <div class="alert alert-${type} alert-dismissible fade show position-fixed" 
                     id="${alertId}" 
                     style="top: 20px; right: 20px; z-index: 99999; min-width: 300px; max-width: 500px;" 
                     role="alert">
                    <i class="fas fa-${getAdminAlertIcon(type)} me-2"></i>
                    ${message}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            `;
            
            document.body.insertAdjacentHTML('beforeend', alertHTML);
            
            if (timeout > 0) {
                setTimeout(() => {
                    const alert = document.getElementById(alertId);
                    if (alert) {
                        const bsAlert = new bootstrap.Alert(alert);
                        bsAlert.close();
                    }
                }, timeout);
            }
        } catch (error) {
            console.error('❌ Error showing admin alert:', error);
            console.log(`📢 ${message}`);
        }
    };

    window.showAdminSweetAlertWarning = function(type) {
        if (typeof Swal === 'undefined') return;
        
        const config = type === '1min' ? {
            title: '🚨 แจ้งเตือนด่วน! (เจ้าหน้าที่)',
            text: 'ระบบจะหมดเวลาใช้งานในอีก 1 นาที!',
            icon: 'error'
        } : {
            title: '⚠️ แจ้งเตือนการหมดเวลา (เจ้าหน้าที่)',
            text: 'ระบบจะหมดเวลาใช้งานในอีก 5 นาที',
            icon: 'warning'
        };
        
        Swal.fire({
            ...config,
            showCancelButton: true,
            confirmButtonText: '🔄 ใช้งานต่อ',
            cancelButtonText: '🚪 ออกจากระบบ',
            allowOutsideClick: type !== '1min',
            allowEscapeKey: true
        }).then((result) => {
            if (result.isConfirmed || result.dismiss === Swal.DismissReason.esc) {
                window.showAdminAlert('✅ ต่ออายุ Session สำเร็จ', 'success');
            } else if (result.dismiss === Swal.DismissReason.cancel) {
                window.location.href = window.base_url + 'User/logout';
            }
        });
    };

    function getAdminAlertIcon(type) {
        switch(type) {
            case 'success': return 'check-circle';
            case 'danger': return 'exclamation-triangle';
            case 'warning': return 'exclamation-triangle';
            case 'info': return 'info-circle';
            default: return 'info-circle';
        }
    }

    console.log('🚀 Admin Session Management functions loaded');
}

// 🧪 Test functions (โหลดทุกครั้ง)
window.testAdminSessionWarning = function(type = '5min') {
    console.log(`🧪 Testing ADMIN ${type} warning...`);
    if (typeof window.showAdminSessionWarning === 'function') {
        window.showAdminSessionWarning(type);
    }
};

window.testAdminLogoutModal = function() {
    console.log('🧪 Testing ADMIN logout modal...');
    if (typeof window.showAdminLogoutModal === 'function') {
        window.showAdminLogoutModal();
    }
};

// 🔍 Debug function (โหลดทุกครั้ง)
window.debugSessionManager = function() {
    console.log('=== SESSION MANAGER DEBUG ===');
    console.log('SessionManager available:', typeof window.SessionManager !== 'undefined');
    console.log('PublicSessionManager available:', typeof window.PublicSessionManager !== 'undefined');
    console.log('Admin functions available:', typeof window.initializeAdminSessionManager !== 'undefined');
    console.log('CrossTabSync available:', typeof window.CrossTabSync !== 'undefined');
    console.log('Base URL:', window.base_url);
    
    if (window.SessionManager) {
        console.log('Admin SessionManager state:', window.SessionManager.getState());
    }
    if (window.PublicSessionManager) {
        console.log('Public SessionManager state:', window.PublicSessionManager.getState());
    }
    
    console.log('=== END DEBUG ===');
};

console.log('✅ Session Manager with Cross-Tab Activity Sync loaded completely');