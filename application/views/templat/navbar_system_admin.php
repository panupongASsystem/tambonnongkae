<!-- Sidebar -->
<ul class="navbar-nav bg-gradient-custom sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="<?= base_url('Home'); ?>">
        <!-- <div class="sidebar-brand-icon rotate-n-15">
                    <i class="fas fa-laugh-wink"></i>
                </div> -->

        <div class="sidebar-brand-icon ">
            <img src="<?= base_url('docs/logo.png'); ?>" alt="" width="64px" height="64px">
        </div>

        <div class="sidebar-brand-text mx-2"><?php echo get_config_value('abbreviation'); ?><br><?php echo get_config_value('nname'); ?></div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    <!-- Nav Item - Dashboard -->
    <li class="nav-item">
        <a class="nav-link" href="<?php echo site_url('System_admin'); ?>">
            <img src="<?= base_url('docs/btn-bend1.png'); ?>">
            <span>หน้าหลัก</span></a>
    </li>
    
    
    <!--  
    <?php
    if ($this->session->userdata('m_level') == 1 || $this->session->userdata('m_level') == 2):
        ?>
        <li class="nav-item">
            <a class="nav-link" href="<?php echo site_url('Member_backend'); ?>">
                <img src="<?= base_url('docs/btn-bend2.png'); ?>">
                <span>จัดการสมาชิก</span>
            </a>
        </li>
    <?php endif; ?>

    -->

    <?php
    if ($this->session->userdata('m_level') == 1):
        ?>
                <li class="nav-item">
                    <a class="nav-link collapsed" data-toggle="collapse" aria-expanded="true" href="javascript:void(0);" onclick="toggleCollapse('collapseZero')">
                        <img src="<?= base_url('docs/btn-bend0.png'); ?>">
                        <span>สำหรับ admin ASsystem</span>
                    </a>
                    <div id="collapseZero" class="collapse" aria-labelledby="headingZero" data-parent="#accordionSidebar">
                        <div class="bg-white py-2 collapse-inner rounded">
                            <!-- <h6 class="collapse-header">Custom Components:</h6> -->

                            <a class="collapse-item" href="<?php echo site_url('Dynamic_position_backend'); ?>">จัดการโครงสร้างบุคลากร</a>
                            <a class="collapse-item" href="<?php echo site_url('User_log_backend'); ?>">Log login/logout</a>
                            <a class="collapse-item" href="<?php echo site_url('System_config_backend'); ?>">System Config</a>
                            <a class="collapse-item" href="<?php echo site_url('Chat_backend'); ?>">Chat Bot AI</a>
                            <!-- <a class="collapse-item" href="<?php echo site_url('System_config_backend/address'); ?>">Config กลุ่มที่อยู่</a>
                    <a class="collapse-item" href="<?php echo site_url('System_config_backend/link'); ?>">Config ลิงค์อื่นๆ</a>
                    <a class="collapse-item" href="<?php echo site_url('System_config_backend/key_token'); ?>">Config key&token</a> -->
                        </div>
                    </div>
                </li>
    <?php endif; ?>


    <!-- Divider -->
    <!-- <hr class="sidebar-divider"> -->

    <!-- Heading -->
    <!-- <div class="sidebar-heading">
                Interface
            </div> -->
    <!-- Nav Item - Pages Collapse Menu -->

    <?php
    $grant_user_ref_id = explode(',', $this->session->userdata('grant_user_ref_id'));
    $required_ids = [1, 3, 4, 5, 6, 7, 8, 9, 10];
    if (array_intersect($grant_user_ref_id, $required_ids)):
        ?>
                <li class="nav-item">
                    <a class="nav-link collapsed" data-toggle="collapse" aria-expanded="true" href="javascript:void(0);" onclick="toggleCollapse('collapseTwo')">
                        <img src="<?= base_url('docs/btn-bend3.png'); ?>">
                        <span>จัดการข้อมูล</span>
                    </a>
                    <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                        <div class="bg-white py-2 collapse-inner rounded">
                            <!-- <h6 class="collapse-header">Custom Components:</h6> -->
                            <?php
                            $grant_user_ref_id = explode(',', $this->session->userdata('grant_user_ref_id'));
                            $required_ids = [1, 3];
                            if (array_intersect($grant_user_ref_id, $required_ids)):
                                ?>
                 <!-- <a class="collapse-item" href="<?php echo site_url('Important_day_backend'); ?>">วันสำคัญ</a> -->
                            <?php endif; ?>

                            <?php
                            $grant_user_ref_id = explode(',', $this->session->userdata('grant_user_ref_id'));
                            $required_ids = [1, 4];
                            if (array_intersect($grant_user_ref_id, $required_ids)):
                                ?>
                                        <a class="collapse-item" href="<?php echo site_url('HotNews_backend'); ?>">ข่าวด่วน</a>
                            <?php endif; ?>

                            <?php
                            $grant_user_ref_id = explode(',', $this->session->userdata('grant_user_ref_id'));
                            $required_ids = [1, 5];
                            if (array_intersect($grant_user_ref_id, $required_ids)):
                                ?>
                                        <a class="collapse-item" href="<?php echo site_url('Banner_backend'); ?>">แบนเนอร์</a>
                            <?php endif; ?>

                            <?php
                            $grant_user_ref_id = explode(',', $this->session->userdata('grant_user_ref_id'));
                            $required_ids = [1, 6];
                            if (array_intersect($grant_user_ref_id, $required_ids)):
                                ?>
                                        <a class="collapse-item" href="<?php echo site_url('background_personnel_backend'); ?>">แบนเนอร์บุคลากร</a>
                            <?php endif; ?>

                            <?php
                            $grant_user_ref_id = explode(',', $this->session->userdata('grant_user_ref_id'));
                            $required_ids = [1, 7];
                            if (array_intersect($grant_user_ref_id, $required_ids)):
                                ?>
                                        <a class="collapse-item" href="<?php echo site_url('Calender_backend'); ?>">ปฏิทินกิจกรรม</a>
                            <?php endif; ?>

                            <?php
                            $grant_user_ref_id = explode(',', $this->session->userdata('grant_user_ref_id'));
                            $required_ids = [1, 8];
                            if (array_intersect($grant_user_ref_id, $required_ids)):
                                ?>
                                        <a class="collapse-item" href="<?php echo site_url('Msg_pres_backend'); ?>">สารจากผู้บริหาร</a>
                            <?php endif; ?>

                            <?php
                            $grant_user_ref_id = explode(',', $this->session->userdata('grant_user_ref_id'));
                            $required_ids = [1, 9];
                            if (array_intersect($grant_user_ref_id, $required_ids)):
                                ?>
                                        <a class="collapse-item" href="<?php echo site_url('news_backend'); ?>">ข่าวประชาสัมพันธ์</a>
                            <?php endif; ?>

                            <?php
                            $grant_user_ref_id = explode(',', $this->session->userdata('grant_user_ref_id'));
                            $required_ids = [1, 10];
                            if (array_intersect($grant_user_ref_id, $required_ids)):
                                ?>
                                        <a class="collapse-item" href="<?php echo site_url('Publicize_ita_backend'); ?>">เปิด-ปิด การแสดงผล EIT</a>
                            <?php endif; ?>
                        </div>
                    </div>
                </li>
    <?php endif; ?>

    <?php
    $grant_user_ref_id = explode(',', $this->session->userdata('grant_user_ref_id'));
    $required_ids = [1, 11, 12, 13, 14, 15, 16, 17, 18, 19, 20, 21, 22, 23, 24];
    if (array_intersect($grant_user_ref_id, $required_ids)):
        ?>
                <li class="nav-item">
                    <a class="nav-link collapsed" data-toggle="collapse" aria-expanded="true" href="javascript:void(0);" onclick="toggleCollapse('collapseOne')">
                        <img src="<?= base_url('docs/btn-bend4.png'); ?>">
                        <span>ข้อมูลทั่วไป</span>
                    </a>
                    <div id="collapseOne" class="collapse" aria-labelledby="headingOne" data-parent="#accordionSidebar">
                        <div class="bg-white py-2 collapse-inner rounded">
                            <!-- <h6 class="collapse-header">Custom Components:</h6> -->
                            <?php
                            $grant_user_ref_id = explode(',', $this->session->userdata('grant_user_ref_id'));
                            $required_ids = [1, 11];
                            if (array_intersect($grant_user_ref_id, $required_ids)):
                                ?>
                                        <a class="collapse-item" href="<?php echo site_url('History_backend'); ?>">ประวัติความเป็นมา</a>
                            <?php endif; ?>

                            <?php
                            $grant_user_ref_id = explode(',', $this->session->userdata('grant_user_ref_id'));
                            $required_ids = [1, 12];
                            if (array_intersect($grant_user_ref_id, $required_ids)):
                                ?>
                                        <a class="collapse-item" href="<?php echo site_url('Ci_backend'); ?>">ข้อมูลชุมชน</a>
                            <?php endif; ?>

                            <?php
                            $grant_user_ref_id = explode(',', $this->session->userdata('grant_user_ref_id'));
                            $required_ids = [1, 13];
                            if (array_intersect($grant_user_ref_id, $required_ids)):
                                ?>
                                        <a class="collapse-item" href="<?php echo site_url('Gci_backend'); ?>">ข้อมูลสภาพทั่วไป</a>
                            <?php endif; ?>

                            <?php
                            $grant_user_ref_id = explode(',', $this->session->userdata('grant_user_ref_id'));
                            $required_ids = [1, 14];
                            if (array_intersect($grant_user_ref_id, $required_ids)):
                                ?>
                                        <a class="collapse-item" href="<?php echo site_url('Mission_backend'); ?>">ภารกิจและความรับผิดชอบ</a>
                            <?php endif; ?>

                            <?php
                            $grant_user_ref_id = explode(',', $this->session->userdata('grant_user_ref_id'));
                            $required_ids = [1, 15];
                            if (array_intersect($grant_user_ref_id, $required_ids)):
                                ?>
                                        <a class="collapse-item" href="<?php echo site_url('Si_backend'); ?>">ยุทธศาสตร์การพัฒนา<br>และแนวทางการพัฒนา</a>
                            <?php endif; ?>

                            <?php
                            $grant_user_ref_id = explode(',', $this->session->userdata('grant_user_ref_id'));
                            $required_ids = [1, 16];
                            if (array_intersect($grant_user_ref_id, $required_ids)):
                                ?>
                                        <a class="collapse-item" href="<?php echo site_url('Authority_backend'); ?>">ข้อมูลอำนาจหน้าที่</a>
                            <?php endif; ?>

                            <?php
                            $grant_user_ref_id = explode(',', $this->session->userdata('grant_user_ref_id'));
                            $required_ids = [1, 17];
                            if (array_intersect($grant_user_ref_id, $required_ids)):
                                ?>
                                        <a class="collapse-item" href="<?php echo site_url('Vision_backend'); ?>">วิสัยทัศน์และพันธกิจ</a>
                            <?php endif; ?>

                            <?php
                            $grant_user_ref_id = explode(',', $this->session->userdata('grant_user_ref_id'));
                            $required_ids = [1, 18];
                            if (array_intersect($grant_user_ref_id, $required_ids)):
                                ?>
                                        <a class="collapse-item" href="<?php echo site_url('Video_backend'); ?>">วิดีทัศน์</a>
                            <?php endif; ?>

                            <?php
                            $grant_user_ref_id = explode(',', $this->session->userdata('grant_user_ref_id'));
                            $required_ids = [1, 19];
                            if (array_intersect($grant_user_ref_id, $required_ids)):
                                ?>
                                        <a class="collapse-item" href="<?php echo site_url('Motto_backend'); ?>">คำขวัญ</a>
                            <?php endif; ?>

                            <?php
                            $grant_user_ref_id = explode(',', $this->session->userdata('grant_user_ref_id'));
                            $required_ids = [1, 20];
                            if (array_intersect($grant_user_ref_id, $required_ids)):
                                ?>
                                        <a class="collapse-item" href="<?php echo site_url('Executivepolicy_backend'); ?>">นโยบายผู้บริหาร</a>
                            <?php endif; ?>

                            <?php
                            $grant_user_ref_id = explode(',', $this->session->userdata('grant_user_ref_id'));
                            $required_ids = [1, 21];
                            if (array_intersect($grant_user_ref_id, $required_ids)):
                                ?>
                                        <a class="collapse-item" href="<?php echo site_url('Activity_backend'); ?>">ข่าวสาร / กิจกรรม</a>
                            <?php endif; ?>

                            <?php
                            $grant_user_ref_id = explode(',', $this->session->userdata('grant_user_ref_id'));
                            $required_ids = [1, 22];
                            if (array_intersect($grant_user_ref_id, $required_ids)):
                                ?>
                                        <a class="collapse-item" href="<?php echo site_url('travel_backend'); ?>">สถานที่สำคัญ-ท่องเที่ยว</a>
                            <?php endif; ?>

                            <?php
                            $grant_user_ref_id = explode(',', $this->session->userdata('grant_user_ref_id'));
                            $required_ids = [1, 23];
                            if (array_intersect($grant_user_ref_id, $required_ids)):
                                ?>
                                        <a class="collapse-item" href="<?php echo site_url('Otop_backend'); ?>">ผลิตภัณฑ์ชุมชน (OTOP)</a>
                            <?php endif; ?>

                            <?php
                            $grant_user_ref_id = explode(',', $this->session->userdata('grant_user_ref_id'));
                            $required_ids = [1, 24];
                            if (array_intersect($grant_user_ref_id, $required_ids)):
                                ?>
                                        <a class="collapse-item" href="<?php echo site_url('Newsletter_backend'); ?>">จดหมายข่าว</a>
                            <?php endif; ?>
                    
                            <?php
                            $grant_user_ref_id = explode(',', $this->session->userdata('grant_user_ref_id'));
                            $required_ids = [1, 133];
                            if (array_intersect($grant_user_ref_id, $required_ids)):
                                ?>
                                        <a class="collapse-item" href="<?php echo site_url('E_mags_backend'); ?>">e-book วารสารออนไลน์</a>
                            <?php endif; ?>
                        </div>
                    </div>
                </li>
    <?php endif; ?>

    <?php
    $grant_user_ref_id = explode(',', $this->session->userdata('grant_user_ref_id'));
    $required_ids = [1, 25, 26, 27, 28, 29, 30, 31, 32, 33, 34, 35, 36, 37, 38];
    if (array_intersect($grant_user_ref_id, $required_ids)):
        ?>
                <li class="nav-item">
                    <a class="nav-link collapsed" data-toggle="collapse" aria-expanded="true" href="javascript:void(0);" onclick="toggleCollapse('collapsethree')">
                        <img src="<?= base_url('docs/btn-bend5.png'); ?>">
                        <span>โครงสร้างบุคลากร</span>
                    </a>
                    <div id="collapsethree" class="collapse" aria-labelledby="headingsix" data-parent="#accordionSidebar">
                        <div class="bg-white py-2 collapse-inner rounded">
                            <!-- <h6 class="collapse-header">Custom Components:</h6> -->
                             <?php
                             $grant_user_ref_id = explode(',', $this->session->userdata('grant_user_ref_id'));
                             $required_ids = [1, 25];
                             if (array_intersect($grant_user_ref_id, $required_ids)):
                                 ?>
                                        <a class="collapse-item" href="<?php echo site_url('Site_map_backend'); ?>">แผนผังโครงสร้างภาพรวม</a>
                            <?php endif; ?>
                    
                            <?php
                            $position_types = get_position_types();
                            ?>
                            <?php foreach ($position_types as $type): ?>
                                        <?php if ($type->pstatus === 'show'): ?>
                                                    <?php
                                                    // ตรวจสอบว่าเป็น sub item หรือไม่
                                                    $is_sub_item = isset($type->psub) && $type->psub == 1;
                                                    $item_class = $is_sub_item ? 'collapse-item collapse-sub-item' : 'collapse-item';
                                                    ?>
                                                    <a class="<?= $item_class ?>" href="<?= site_url('dynamic_position_backend/manage/' . $type->peng) ?>">
                                                        <?php if ($is_sub_item): ?>
                                                                    <span class="sidebar-sub-indent"></span>
                                                        <?php endif; ?>
                                                        <?= $type->pname ?>
                                                    </a>
                                        <?php endif; ?>
                            <?php endforeach; ?>
                        </div>
                    </div>
                </li>
    <?php endif; ?>

    <?php
    $grant_user_ref_id = explode(',', $this->session->userdata('grant_user_ref_id'));
    $required_ids = [1, 39, 40, 41, 42, 43, 44, 45, 46, 47, 48, 49, 50, 51, 52, 53, 54, 55];
    if (array_intersect($grant_user_ref_id, $required_ids)):
        ?>
                <li class="nav-item">
                    <a class="nav-link collapsed" data-toggle="collapse" aria-expanded="true" href="javascript:void(0);" onclick="toggleCollapse('collapsesix')">
                        <img src="<?= base_url('docs/btn-bend8.png'); ?>">
                        <span>บริการประชาชน</span>
                    </a>
                    <div id="collapsesix" class="collapse" aria-labelledby="headingsix" data-parent="#accordionSidebar">
                        <div class="bg-white py-2 collapse-inner rounded">
                            <!-- <h6 class="collapse-header">Custom Components:</h6> -->

                            <?php
                            $grant_user_ref_id = explode(',', $this->session->userdata('grant_user_ref_id'));
                            $required_ids = [1, 39];
                            if (array_intersect($grant_user_ref_id, $required_ids)):
                                ?>
                                        <a class="collapse-item" href="<?php echo site_url('Pbsv_utilities_backend'); ?>">สาธารณูปโภค</a>
                            <?php endif; ?>

                            <?php
                            $grant_user_ref_id = explode(',', $this->session->userdata('grant_user_ref_id'));
                            $required_ids = [1, 40];
                            if (array_intersect($grant_user_ref_id, $required_ids)):
                                ?>
                                        <a class="collapse-item" href="<?php echo site_url('Pbsv_cjc_backend'); ?>">ศูนย์ยุติธรรมชุมชน</a>
                            <?php endif; ?>

                            <?php
                            $grant_user_ref_id = explode(',', $this->session->userdata('grant_user_ref_id'));
                            $required_ids = [1, 41];
                            if (array_intersect($grant_user_ref_id, $required_ids)):
                                ?>
                                        <a class="collapse-item" href="<?php echo site_url('Pbsv_cac_backend'); ?>">ศูนย์ช่วยเหลือประชาชน</a>
                            <?php endif; ?>

                            <?php
                            $grant_user_ref_id = explode(',', $this->session->userdata('grant_user_ref_id'));
                            $required_ids = [1, 42];
                            if (array_intersect($grant_user_ref_id, $required_ids)):
                                ?>
                                        <a class="collapse-item" href="<?php echo site_url('Pbsv_cig_backend'); ?>">ศูนย์ข้อมูลข่าวสารทางราชการ</a>
                            <?php endif; ?>

                            <?php
                            $grant_user_ref_id = explode(',', $this->session->userdata('grant_user_ref_id'));
                            $required_ids = [1, 43];
                            if (array_intersect($grant_user_ref_id, $required_ids)):
                                ?>
                                        <a class="collapse-item" href="<?php echo site_url('Pbsv_ahs_backend'); ?>">หลักประกันสุขภาพ</a>
                            <?php endif; ?>

                            <?php
                            $grant_user_ref_id = explode(',', $this->session->userdata('grant_user_ref_id'));
                            $required_ids = [1, 44];
                            if (array_intersect($grant_user_ref_id, $required_ids)):
                                ?>
                                        <a class="collapse-item" href="<?php echo site_url('Pbsv_gup_backend'); ?>">คู่มือสำหรับประชาชน</a>
                            <?php endif; ?>

                            <?php
                            $grant_user_ref_id = explode(',', $this->session->userdata('grant_user_ref_id'));
                            $required_ids = [1, 45];
                            if (array_intersect($grant_user_ref_id, $required_ids)):
                                ?>
                                        <a class="collapse-item" href="<?php echo site_url('Pbsv_sags_backend'); ?>">คู่มือและ<br>มาตราฐานการให้บริการ</a>
                            <?php endif; ?>

                            <?php
                            $grant_user_ref_id = explode(',', $this->session->userdata('grant_user_ref_id'));
                            $required_ids = [1, 46];
                            if (array_intersect($grant_user_ref_id, $required_ids)):
                                ?>
                                        <a class="collapse-item" href="<?php echo site_url('Pbsv_ems_backend'); ?>">งานกู้ชีพ/บริการ<br>การแพทย์ฉุกเฉิน(EMS)</a>
                            <?php endif; ?>

                            <?php
                            $grant_user_ref_id = explode(',', $this->session->userdata('grant_user_ref_id'));
                            $required_ids = [1, 47];
                            if (array_intersect($grant_user_ref_id, $required_ids)):
                                ?>
                                        <a class="collapse-item" href="<?php echo site_url('Pbsv_oppr_backend'); ?>">งานอาสาป้องกันภัย<br>ฝ่ายพลเรือน(อปพร.)</a>
                            <?php endif; ?>

                            <?php
                            $grant_user_ref_id = explode(',', $this->session->userdata('grant_user_ref_id'));
                            $required_ids = [1, 48];
                            if (array_intersect($grant_user_ref_id, $required_ids)):
                                ?>
                                        <a class="collapse-item" href="<?php echo site_url('Pbsv_e_book_backend'); ?>">ดาวโหลดแบบฟอร์ม E-book</a>
                            <?php endif; ?>

                    
                             <!-- 
                    <?php
                    $grant_user_ref_id = explode(',', $this->session->userdata('grant_user_ref_id'));
                    $required_ids = [1, 49];
                    if (array_intersect($grant_user_ref_id, $required_ids)):
                        ?>
                        <a class="collapse-item" href="<?php echo site_url('Elderly_aw_form_backend'); ?>">เอกสารเบี้ยผู้สูงอายุ/ผู้พิการ</a>
                    <?php endif; ?>
                    
                    
                    

                    <?php
                    $grant_user_ref_id = explode(',', $this->session->userdata('grant_user_ref_id'));
                    $required_ids = [1, 50];
                    if (array_intersect($grant_user_ref_id, $required_ids)):
                        ?>
                        <a class="collapse-item" href="<?php echo site_url('Elderly_aw_ods_backend'); ?>">คำร้องเบี้ยผู้สูงอายุ/ผู้พิการ</a>
                    <?php endif; ?>

                    <?php
                    $grant_user_ref_id = explode(',', $this->session->userdata('grant_user_ref_id'));
                    $required_ids = [1, 51];
                    if (array_intersect($grant_user_ref_id, $required_ids)):
                        ?>
                        <a class="collapse-item" href="<?php echo site_url('Elderly_aw_backend'); ?>">ตรวจสอบเบี้ยผู้สูงอายุ/ผู้พิการ</a>
                    <?php endif; ?>
                    
                    
                    
                

                    <?php
                    $grant_user_ref_id = explode(',', $this->session->userdata('grant_user_ref_id'));
                    $required_ids = [1, 52];
                    if (array_intersect($grant_user_ref_id, $required_ids)):
                        ?>
                        <a class="collapse-item" href="<?php echo site_url('Kid_aw_form_backend'); ?>">เอกสารเงินอุดหนุนเด็กแรกเกิด</a>
                    <?php endif; ?>

                    <?php
                    $grant_user_ref_id = explode(',', $this->session->userdata('grant_user_ref_id'));
                    $required_ids = [1, 53];
                    if (array_intersect($grant_user_ref_id, $required_ids)):
                        ?>
                        <a class="collapse-item" href="<?php echo site_url('Kid_aw_ods_backend'); ?>">คำร้องเงินอุดหนุนเด็กแรกเกิด</a>
                    <?php endif; ?>

                    <?php
                    $grant_user_ref_id = explode(',', $this->session->userdata('grant_user_ref_id'));
                    $required_ids = [1, 54];
                    if (array_intersect($grant_user_ref_id, $required_ids)):
                        ?>
                        <a class="collapse-item" href="<?php echo site_url('kid_aw_backend'); ?>">ตรวจสอบเงินอุดหนุนเด็ก<br>แรกเกิด</a>
                    <?php endif; ?>

                    -->

                            <?php
                            $grant_user_ref_id = explode(',', $this->session->userdata('grant_user_ref_id'));
                            $required_ids = [1, 55];
                            if (array_intersect($grant_user_ref_id, $required_ids)):
                                ?>
                                        <a class="collapse-item" href="<?php echo site_url('Odata_backend'); ?>">ฐานข้อมูลเปิดภาครัฐ<br>(Open Data)</a>
                            <?php endif; ?>
                    
                                                <?php
                                                $grant_user_ref_id = explode(',', $this->session->userdata('grant_user_ref_id'));
                                                $required_ids = [1, 127];
                                                if (array_intersect($grant_user_ref_id, $required_ids)):
                                                    ?>
                                        <a class="collapse-item" href="<?php echo site_url('Pbsv_statistics_backend'); ?>">ข้อมูลสถิติการให้บริการ</a>
                            <?php endif; ?>

                        </div>
                    </div>
                </li>
    <?php endif; ?>

    <?php
    $grant_user_ref_id = explode(',', $this->session->userdata('grant_user_ref_id'));
    $required_ids = [1, 56, 57, 58, 59, 60, 61, 62, 63, 64, 65, 66];
    if (array_intersect($grant_user_ref_id, $required_ids)):
        ?>
                <li class="nav-item">
                    <a class="nav-link collapsed" data-toggle="collapse" aria-expanded="true" href="javascript:void(0);" onclick="toggleCollapse('collapsefour')">
                        <img src="<?= base_url('docs/btn-bend6.png'); ?>">
                        <span>แผนงาน</span>
                    </a>
                    <div id="collapsefour" class="collapse" aria-labelledby="headingfour" data-parent="#accordionSidebar">
                        <div class="bg-white py-2 collapse-inner rounded">
                            <!-- <h6 class="collapse-header">Custom Components:</h6> -->
                            <?php
                            $grant_user_ref_id = explode(',', $this->session->userdata('grant_user_ref_id'));
                            $required_ids = [1, 56];
                            if (array_intersect($grant_user_ref_id, $required_ids)):
                                ?>
                                        <a class="collapse-item" href="<?php echo site_url('Plan_pdl_backend'); ?>">แผนพัฒนาท้องถิ่น</a>
                            <?php endif; ?>

                            <?php
                            $grant_user_ref_id = explode(',', $this->session->userdata('grant_user_ref_id'));
                            $required_ids = [1, 57];
                            if (array_intersect($grant_user_ref_id, $required_ids)):
                                ?>
                                        <a class="collapse-item" href="<?php echo site_url('Plan_psi_backend'); ?>">แผนแม่บทสารสนเทศ</a>
                            <?php endif; ?>

                            <?php
                            $grant_user_ref_id = explode(',', $this->session->userdata('grant_user_ref_id'));
                            $required_ids = [1, 58];
                            if (array_intersect($grant_user_ref_id, $required_ids)):
                                ?>
                                        <a class="collapse-item" href="<?php echo site_url('Plan_pop_backend'); ?>">แผนปฏิบัติการจัดซื้อจัดจ้าง</a>
                            <?php endif; ?>

                            <?php
                            $grant_user_ref_id = explode(',', $this->session->userdata('grant_user_ref_id'));
                            $required_ids = [1, 59];
                            if (array_intersect($grant_user_ref_id, $required_ids)):
                                ?>
                                        <a class="collapse-item" href="<?php echo site_url('Plan_paca_backend'); ?>">แผนปฏิบัติการป้องกัน<br>การทุจริต</a>
                            <?php endif; ?>

                            <?php
                            $grant_user_ref_id = explode(',', $this->session->userdata('grant_user_ref_id'));
                            $required_ids = [1, 60];
                            if (array_intersect($grant_user_ref_id, $required_ids)):
                                ?>
                                        <a class="collapse-item" href="<?php echo site_url('Plan_pmda_backend'); ?>">แผนป้องกันและบรรเทา<br>สาธารณภัยประจำปี</a>
                            <?php endif; ?>

                            <?php
                            $grant_user_ref_id = explode(',', $this->session->userdata('grant_user_ref_id'));
                            $required_ids = [1, 61];
                            if (array_intersect($grant_user_ref_id, $required_ids)):
                                ?>
                                        <a class="collapse-item" href="<?php echo site_url('Plan_dpy_backend'); ?>">แผนการบริหารและ<br>พัฒนาทรัพยากรบุคคลประจำปี</a>

                            <?php endif; ?>

                            <?php
                            $grant_user_ref_id = explode(',', $this->session->userdata('grant_user_ref_id'));
                            $required_ids = [1, 62];
                            if (array_intersect($grant_user_ref_id, $required_ids)):
                                ?>
                                        <a class="collapse-item" href="<?php echo site_url('Plan_pc3y_backend'); ?>">แผนอัตรากำลัง 3 ปี</a>
                            <?php endif; ?>

                            <?php
                            $grant_user_ref_id = explode(',', $this->session->userdata('grant_user_ref_id'));
                            $required_ids = [1, 63];
                            if (array_intersect($grant_user_ref_id, $required_ids)):
                                ?>
                                        <a class="collapse-item" href="<?php echo site_url('Plan_pds3y_backend'); ?>">แผนพัฒนาบุคลากร 3 ปี</a>
                            <?php endif; ?>

                            <?php
                            $grant_user_ref_id = explode(',', $this->session->userdata('grant_user_ref_id'));
                            $required_ids = [1, 64];
                            if (array_intersect($grant_user_ref_id, $required_ids)):
                                ?>
                                        <a class="collapse-item" href="<?php echo site_url('Plan_poa_backend'); ?>">แผนการดำเนินงานประจำปี</a>
                            <?php endif; ?>

                            <?php
                            $grant_user_ref_id = explode(',', $this->session->userdata('grant_user_ref_id'));
                            $required_ids = [1, 65];
                            if (array_intersect($grant_user_ref_id, $required_ids)):
                                ?>
                                        <a class="collapse-item" href="<?php echo site_url('Plan_pdpa_backend'); ?>">แผนพัฒนาบุคลากรประจำปี</a>
                            <?php endif; ?>

                            <?php
                            $grant_user_ref_id = explode(',', $this->session->userdata('grant_user_ref_id'));
                            $required_ids = [1, 66];
                            if (array_intersect($grant_user_ref_id, $required_ids)):
                                ?>
                                        <a class="collapse-item" href="<?php echo site_url('Plan_pcra_backend'); ?>">แผนเก็บรายได้ประจำปี</a>
                            <?php endif; ?>
                    
                                                <?php
                                                $grant_user_ref_id = explode(',', $this->session->userdata('grant_user_ref_id'));
                                                $required_ids = [1, 129];
                                                if (array_intersect($grant_user_ref_id, $required_ids)):
                                                    ?>
                                        <a class="collapse-item" href="<?php echo site_url('Plan_progress_backend'); ?>">แผนและความก้าวหน้าในการดำเนินงานและการใช้งบประมาณ</a>
                            <?php endif; ?>
                            <!-- <a class="collapse-item" href="<?php echo site_url('Plan_pdm_backend'); ?>">แผนพัฒนา</a> -->
                        </div>
                    </div>
                </li>
    <?php endif; ?>

    <?php
    $grant_user_ref_id = explode(',', $this->session->userdata('grant_user_ref_id'));
    $required_ids = [1, 67, 68, 69, 70, 71, 72, 73, 74, 75, 76, 77, 78, 79, 80, 81, 82, 83, 84, 85, 86, 87, 88, 89, 90];
    if (array_intersect($grant_user_ref_id, $required_ids)):
        ?>
                <li class="nav-item">
                    <a class="nav-link collapsed" data-toggle="collapse" aria-expanded="true" href="javascript:void(0);" onclick="toggleCollapse('collapseseven')">
                        <img src="<?= base_url('docs/btn-bend9.png'); ?>">
                        <span>การดำเนินงาน</span>
                    </a>
                    <div id="collapseseven" class="collapse" aria-labelledby="headingseven" data-parent="#accordionSidebar">
                        <div class="bg-white py-2 collapse-inner rounded">
                            <!-- <h6 class="collapse-header">Custom Components:</h6> -->
                            <?php
                            $grant_user_ref_id = explode(',', $this->session->userdata('grant_user_ref_id'));
                            $required_ids = [1, 67];
                            if (array_intersect($grant_user_ref_id, $required_ids)):
                                ?>
                                        <a class="collapse-item" href="<?php echo site_url('Operation_aca_backend'); ?>">การปฏิบัติการป้องกัน<br>การทุจริต</a>
                            <?php endif; ?>
                    
                    
                    
                            <?php
                            $grant_user_ref_id = explode(',', $this->session->userdata('grant_user_ref_id'));
                            $required_ids = [1, 68];
                            if (array_intersect($grant_user_ref_id, $required_ids)):
                                ?>
                                        <a class="collapse-item" href="<?php echo site_url('Operation_mcc_backend'); ?>">การจัดการเรื่องร้องเรียน<br>การทุจริต</a>
                            <?php endif; ?>
                    
                    
                    

                            <?php
                            $grant_user_ref_id = explode(',', $this->session->userdata('grant_user_ref_id'));
                            $required_ids = [1, 69];
                            if (array_intersect($grant_user_ref_id, $required_ids)):
                                ?>
                                        <a class="collapse-item" href="<?php echo site_url('Operation_sap_backend'); ?>">การปฏิบัติงานและการให้บริการ</a>
                            <?php endif; ?>

                            <?php
                            $grant_user_ref_id = explode(',', $this->session->userdata('grant_user_ref_id'));
                            $required_ids = [1, 70];
                            if (array_intersect($grant_user_ref_id, $required_ids)):
                                ?>
                                        <a class="collapse-item" href="<?php echo site_url('Operation_pgn_backend'); ?>">นโยบายไม่รับของขวัญ<br>no gift policy</a>
                            <?php endif; ?>

                            <?php
                            $grant_user_ref_id = explode(',', $this->session->userdata('grant_user_ref_id'));
                            $required_ids = [1, 71];
                            if (array_intersect($grant_user_ref_id, $required_ids)):
                                ?>
                                        <a class="collapse-item" href="<?php echo site_url('Operation_po_backend'); ?>">การเปิดโอกาสให้มีส่วนร่วม</a>
                            <?php endif; ?>

                            <?php
                            $grant_user_ref_id = explode(',', $this->session->userdata('grant_user_ref_id'));
                            $required_ids = [1, 72];
                            if (array_intersect($grant_user_ref_id, $required_ids)):
                                ?>
                                        <a class="collapse-item" href="<?php echo site_url('Operation_pm_backend'); ?>">การมีส่วนร่วมของผู้บริหาร</a>
                            <?php endif; ?>

                            <?php
                            $grant_user_ref_id = explode(',', $this->session->userdata('grant_user_ref_id'));
                            $required_ids = [1, 73];
                            if (array_intersect($grant_user_ref_id, $required_ids)):
                                ?>
                                        <a class="collapse-item" href="<?php echo site_url('Operation_eco_backend'); ?>">การเสริมสร้าง<br>วัฒนธรรมองค์กร</a>
                            <?php endif; ?>

                            <?php
                            $grant_user_ref_id = explode(',', $this->session->userdata('grant_user_ref_id'));
                            $required_ids = [1, 74];
                            if (array_intersect($grant_user_ref_id, $required_ids)):
                                ?>
                                        <a class="collapse-item" href="<?php echo site_url('Operation_mr_backend'); ?>">การจัดการความเสี่ยง</a>
                            <?php endif; ?>

                            <?php
                            $grant_user_ref_id = explode(',', $this->session->userdata('grant_user_ref_id'));
                            $required_ids = [1, 75];
                            if (array_intersect($grant_user_ref_id, $required_ids)):
                                ?>
                                        <a class="collapse-item" href="<?php echo site_url('Ita_year_backend'); ?>">ITA ประจำปี</a>
                            <?php endif; ?>

                            <?php
                            $grant_user_ref_id = explode(',', $this->session->userdata('grant_user_ref_id'));
                            $required_ids = [1, 76];
                            if (array_intersect($grant_user_ref_id, $required_ids)):
                                ?>
                                        <a class="collapse-item" href="<?php echo site_url('Ita_backend'); ?>">การประเมินคุณธรรม<br>ของหน่วยงานภาครัฐ ITA</a>
                            <?php endif; ?>

                            <?php
                            $grant_user_ref_id = explode(',', $this->session->userdata('grant_user_ref_id'));
                            $required_ids = [1, 77];
                            if (array_intersect($grant_user_ref_id, $required_ids)):
                                ?>
                                        <a class="collapse-item" href="<?php echo site_url('Lpa_backend'); ?>">LPA การประเมินประสิทธิภาพ<br>ขององค์กร</a>
                            <?php endif; ?>

                            <?php
                            $grant_user_ref_id = explode(',', $this->session->userdata('grant_user_ref_id'));
                            $required_ids = [1, 78];
                            if (array_intersect($grant_user_ref_id, $required_ids)):
                                ?>
                                        <a class="collapse-item" href="<?php echo site_url('Operation_policy_hr_backend'); ?>">นโยบายบริหารทรัพยากรบุคคล</a>
                            <?php endif; ?>

                            <?php
                            $grant_user_ref_id = explode(',', $this->session->userdata('grant_user_ref_id'));
                            $required_ids = [1, 79];
                            if (array_intersect($grant_user_ref_id, $required_ids)):
                                ?>
                                        <a class="collapse-item" href="<?php echo site_url('Operation_am_hr_backend'); ?>">การดำเนินการบริหาร<br>ทรัพยากรบุคคล</a>
                            <?php endif; ?>

                            <?php
                            $grant_user_ref_id = explode(',', $this->session->userdata('grant_user_ref_id'));
                            $required_ids = [1, 80];
                            if (array_intersect($grant_user_ref_id, $required_ids)):
                                ?>
                                        <a class="collapse-item" href="<?php echo site_url('Operation_cdm_backend'); ?>">หลักเกณฑ์การบริหาร<br>และพัฒนา</a>
                            <?php endif; ?>

                            <?php
                            $grant_user_ref_id = explode(',', $this->session->userdata('grant_user_ref_id'));
                            $required_ids = [1, 81];
                            if (array_intersect($grant_user_ref_id, $required_ids)):
                                ?>
                                        <a class="collapse-item" href="<?php echo site_url('Operation_rdam_hr_backend'); ?>">รายงานผลการบริหาร<br>และพัฒนาทรัพยากรบุคคล</a>
                            <?php endif; ?>

                            <?php
                            $grant_user_ref_id = explode(',', $this->session->userdata('grant_user_ref_id'));
                            $required_ids = [1, 82];
                            if (array_intersect($grant_user_ref_id, $required_ids)):
                                ?>
                                        <a class="collapse-item" href="<?php echo site_url('Operation_aa_backend'); ?>">กิจการสภา</a>
                            <?php endif; ?>

                            <?php
                            $grant_user_ref_id = explode(',', $this->session->userdata('grant_user_ref_id'));
                            $required_ids = [1, 83];
                            if (array_intersect($grant_user_ref_id, $required_ids)):
                                ?>
                                        <a class="collapse-item" href="<?php echo site_url('Operation_aditn_backend'); ?>">ตรวจสอบภายใน</a>
                            <?php endif; ?>

                            <?php
                            $grant_user_ref_id = explode(',', $this->session->userdata('grant_user_ref_id'));
                            $required_ids = [1, 84];
                            if (array_intersect($grant_user_ref_id, $required_ids)):
                                ?>
                                        <a class="collapse-item" href="<?php echo site_url('Operation_reauf_backend'); ?>">รายงานติดตามและ<br>ะประเมินผลการดำเนินงาน</a>
                            <?php endif; ?>

                            <?php
                            $grant_user_ref_id = explode(',', $this->session->userdata('grant_user_ref_id'));
                            $required_ids = [1, 85];
                            if (array_intersect($grant_user_ref_id, $required_ids)):
                                ?>
                                        <a class="collapse-item" href="<?php echo site_url('Procurement_backend'); ?>">ประกาศจัดซื้อจัดจ้าง</a>
                            <?php endif; ?>
                    
                            <?php
                            $grant_user_ref_id = explode(',', $this->session->userdata('grant_user_ref_id'));
                            $required_ids = [1, 130];
                            if (array_intersect($grant_user_ref_id, $required_ids)):
                                ?>
                                        <a class="collapse-item" href="<?php echo site_url('Announce_oap_backend'); ?>">ประกาศราคากลาง</a>
                            <?php endif; ?>

                            <?php
                            $grant_user_ref_id = explode(',', $this->session->userdata('grant_user_ref_id'));
                            $required_ids = [1, 131];
                            if (array_intersect($grant_user_ref_id, $required_ids)):
                                ?>
                                        <a class="collapse-item" href="<?php echo site_url('Announce_win_backend'); ?>">ประกาศผู้ชนะราคา</a>
                            <?php endif; ?>

                            <?php
                            $grant_user_ref_id = explode(',', $this->session->userdata('grant_user_ref_id'));
                            $required_ids = [1, 86];
                            if (array_intersect($grant_user_ref_id, $required_ids)):
                                ?>
                                        <a class="collapse-item" href="<?php echo site_url('P_rpobuy_backend'); ?>">รายการจัดซื้อจัดจ้าง /<br>จัดหาพัสดุประจำปี</a>
                            <?php endif; ?>

                            <?php
                            $grant_user_ref_id = explode(',', $this->session->userdata('grant_user_ref_id'));
                            $required_ids = [1, 87];
                            if (array_intersect($grant_user_ref_id, $required_ids)):
                                ?>
                                        <a class="collapse-item" href="<?php echo site_url('P_sopopaortsr_backend'); ?>">รายงานสรุปผล<br>การจัดซื้อจัดจ้าง<br>หรือการจัดหาพัสดุ</a>
                            <?php endif; ?>

                            <?php
                            $grant_user_ref_id = explode(',', $this->session->userdata('grant_user_ref_id'));
                            $required_ids = [1, 88];
                            if (array_intersect($grant_user_ref_id, $required_ids)):
                                ?>
                                        <a class="collapse-item" href="<?php echo site_url('P_sopopip_backend'); ?>">รายงานความก้าวหน้าการ<br>จัดซื้อจัดจ้างหรือจัดหาพัสดุ</a>
                            <?php endif; ?>

                            <?php
                            $grant_user_ref_id = explode(',', $this->session->userdata('grant_user_ref_id'));
                            $required_ids = [1, 89];
                            if (array_intersect($grant_user_ref_id, $required_ids)):
                                ?>
                                        <a class="collapse-item" href="<?php echo site_url('P_rpo_backend'); ?>">รายงานผลการดำเนินงาน<br>จัดซื้อจัดจ้าง</a>
                            <?php endif; ?>

                            <?php
                            $grant_user_ref_id = explode(',', $this->session->userdata('grant_user_ref_id'));
                            $required_ids = [1, 90];
                            if (array_intersect($grant_user_ref_id, $required_ids)):
                                ?>
                                        <a class="collapse-item" href="<?php echo site_url('P_reb_backend'); ?>">รายงานใช้จ่ายงบประมาณ<br>จัดซื้อจัดจ้าง</a>
                            <?php endif; ?>

                            <?php
                            $grant_user_ref_id = explode(',', $this->session->userdata('grant_user_ref_id'));
                            $required_ids = [1, 116];
                            if (array_intersect($grant_user_ref_id, $required_ids)):
                                ?>
                                        <a class="collapse-item" href="<?php echo site_url('Operation_meeting_backend'); ?>">รายงานการประชุมสภา</a>
                            <?php endif; ?>

                            <?php
                            $grant_user_ref_id = explode(',', $this->session->userdata('grant_user_ref_id'));
                            $required_ids = [1, 117];
                            if (array_intersect($grant_user_ref_id, $required_ids)):
                                ?>
                                        <a class="collapse-item" href="<?php echo site_url('Operation_report_backend'); ?>">รายงานผลการดำเนินงาน<?php echo get_config_value('abbreviation'); ?></a>
                            <?php endif; ?>

                        </div>
                    </div>
                </li>
    <?php endif; ?>

    <?php
    $grant_user_ref_id = explode(',', $this->session->userdata('grant_user_ref_id'));
    $required_ids = [1, 91, 92, 93, 94, 95, 96, 97];
    if (array_intersect($grant_user_ref_id, $required_ids)):
        ?>
                <li class="nav-item">
                    <a class="nav-link collapsed" data-toggle="collapse" aria-expanded="true" href="javascript:void(0);" onclick="toggleCollapse('collapseeleven')">
                        <img src="<?= base_url('docs/btn-bend10.png'); ?>">
                        <span>มาตรการภายใน</span>
                    </a>
                    <div id="collapseeleven" class="collapse" aria-labelledby="headingeleven" data-parent="#accordionSidebar">
                        <div class="bg-white py-2 collapse-inner rounded">
                            <!-- <h6 class="collapse-header">Custom Components:</h6> -->
                            <?php
                            $grant_user_ref_id = explode(',', $this->session->userdata('grant_user_ref_id'));
                            $required_ids = [1, 91];
                            if (array_intersect($grant_user_ref_id, $required_ids)):
                                ?>
                                        <a class="collapse-item" href="<?php echo site_url('Order_backend'); ?>">คำสั่ง</a>
                            <?php endif; ?>

                            <?php
                            $grant_user_ref_id = explode(',', $this->session->userdata('grant_user_ref_id'));
                            $required_ids = [1, 92];
                            if (array_intersect($grant_user_ref_id, $required_ids)):
                                ?>
                                        <a class="collapse-item" href="<?php echo site_url('Announce_backend'); ?>">ประกาศ</a>
                            <?php endif; ?>

                            <?php
                            $grant_user_ref_id = explode(',', $this->session->userdata('grant_user_ref_id'));
                            $required_ids = [1, 93];
                            if (array_intersect($grant_user_ref_id, $required_ids)):
                                ?>
                                        <a class="collapse-item" href="<?php echo site_url('Mui_backend'); ?>">มาตราการภายในหน่วยงาน</a>
                            <?php endif; ?>

                            <?php
                            $grant_user_ref_id = explode(',', $this->session->userdata('grant_user_ref_id'));
                            $required_ids = [1, 94];
                            if (array_intersect($grant_user_ref_id, $required_ids)):
                                ?>
                                        <a class="collapse-item" href="<?php echo site_url('Guide_work_backend'); ?>">คู่มือการปฏิบัติงาน</a>
                            <?php endif; ?>

                            <?php
                            $grant_user_ref_id = explode(',', $this->session->userdata('grant_user_ref_id'));
                            $required_ids = [1, 95];
                            if (array_intersect($grant_user_ref_id, $required_ids)):
                                ?>
                                        <a class="collapse-item" href="<?php echo site_url('Loadform_backend'); ?>">ดาวน์โหลดแบบฟอร์ม</a>
                            <?php endif; ?>

                            <?php
                            $grant_user_ref_id = explode(',', $this->session->userdata('grant_user_ref_id'));
                            $required_ids = [1, 96];
                            if (array_intersect($grant_user_ref_id, $required_ids)):
                                ?>
                                        <a class="collapse-item" href="<?php echo site_url('Pppw_backend'); ?>">พรบ./พรก ที่ใช้การปฏิบัติงาน</a>
                            <?php endif; ?>

                            <?php
                            $grant_user_ref_id = explode(',', $this->session->userdata('grant_user_ref_id'));
                            $required_ids = [1, 97];
                            if (array_intersect($grant_user_ref_id, $required_ids)):
                                ?>
                                        <a class="collapse-item" href="<?php echo site_url('Km_backend'); ?>">การจัดการความรู้ท้องถิ่น KM</a>
                            <?php endif; ?>

                            <?php
                            $grant_user_ref_id = explode(',', $this->session->userdata('grant_user_ref_id'));
                            $required_ids = [1, 118];
                            if (array_intersect($grant_user_ref_id, $required_ids)):
                                ?>
                                        <a class="collapse-item" href="<?php echo site_url('Finance_backend'); ?>">งานการเงินและการบัญชี</a>
                            <?php endif; ?>

                            <?php
                            $grant_user_ref_id = explode(',', $this->session->userdata('grant_user_ref_id'));
                            $required_ids = [1, 119];
                            if (array_intersect($grant_user_ref_id, $required_ids)):
                                ?>
                                        <a class="collapse-item" href="<?php echo site_url('Taepts_backend'); ?>">มาตรฐานการส่งเสริมคุณธรรม<br>และความโปร่งใส</a>
                            <?php endif; ?>

                            <?php
                            $grant_user_ref_id = explode(',', $this->session->userdata('grant_user_ref_id'));
                            $required_ids = [1, 124];
                            if (array_intersect($grant_user_ref_id, $required_ids)):
                                ?>
                                        <a class="collapse-item" href="<?php echo site_url('Arevenuec_backend'); ?>">การเร่งรัดจัดเก็บรายได้</a>
                            <?php endif; ?>
                    
                                                               <?php
                                                               $grant_user_ref_id = explode(',', $this->session->userdata('grant_user_ref_id'));
                                                               $required_ids = [1, 128];
                                                               if (array_intersect($grant_user_ref_id, $required_ids)):
                                                                   ?>
                                        <a class="collapse-item" href="<?php echo site_url('Ethics_strategy_backend'); ?>">ประมวลผลจริยธรรมและการขับเคลื่อนจริยธรรม</a>
                            <?php endif; ?>
                        </div>
                    </div>
                </li>
    <?php endif; ?>

    <?php
    $grant_user_ref_id = explode(',', $this->session->userdata('grant_user_ref_id'));
    $required_ids = [1, 98, 99, 100, 101, 102, 103, 104];
    if (array_intersect($grant_user_ref_id, $required_ids)):
        ?>
                <li class="nav-item">
                    <a class="nav-link collapsed" data-toggle="collapse" aria-expanded="true" href="javascript:void(0);" onclick="toggleCollapse('collapsefive')">
                        <img src="<?= base_url('docs/btn-bend7.png'); ?>">
                        <span>ข้อมูลบัญญัติ</span>
                    </a>
                    <div id="collapsefive" class="collapse" aria-labelledby="headingfive" data-parent="#accordionSidebar">
                        <div class="bg-white py-2 collapse-inner rounded">
                            <!-- <h6 class="collapse-header">Custom Components:</h6> -->
                            <?php
                            $grant_user_ref_id = explode(',', $this->session->userdata('grant_user_ref_id'));
                            $required_ids = [1, 98];
                            if (array_intersect($grant_user_ref_id, $required_ids)):
                                ?>
                                        <a class="collapse-item" href="<?php echo site_url('Canon_bgps_backend'); ?>"><?php
                                           $abbreviation = get_config_value('abbreviation');
                                           $canon = ($abbreviation == 'อบต.') ? 'ข้อบัญญัติ' : 'เทศบัญญัติ';
                                           echo $canon;
                                           ?>งบประมาณ</a>
                            <?php endif; ?>

                            <?php
                            $grant_user_ref_id = explode(',', $this->session->userdata('grant_user_ref_id'));
                            $required_ids = [1, 99];
                            if (array_intersect($grant_user_ref_id, $required_ids)):
                                ?>
                                        <a class="collapse-item" href="<?php echo site_url('Canon_chh_backend'); ?>"><?php
                                           $abbreviation = get_config_value('abbreviation');
                                           $canon = ($abbreviation == 'อบต.') ? 'ข้อบัญญัติ' : 'เทศบัญญัติ';
                                           echo $canon;
                                           ?>การควบคุมกิจการที่<br>เป็นอันตรายต่อสุขภาพ</a>
                            <?php endif; ?>

                            <?php
                            $grant_user_ref_id = explode(',', $this->session->userdata('grant_user_ref_id'));
                            $required_ids = [1, 100];
                            if (array_intersect($grant_user_ref_id, $required_ids)):
                                ?>
                                        <a class="collapse-item" href="<?php echo site_url('Canon_ritw_backend'); ?>"><?php
                                           $abbreviation = get_config_value('abbreviation');
                                           $canon = ($abbreviation == 'อบต.') ? 'ข้อบัญญัติ' : 'เทศบัญญัติ';
                                           echo $canon;
                                           ?>การติดตั้ง<br>ระบบบำบัดน้ำเสียในอาคาร</a>
                            <?php endif; ?>

                            <?php
                            $grant_user_ref_id = explode(',', $this->session->userdata('grant_user_ref_id'));
                            $required_ids = [1, 101];
                            if (array_intersect($grant_user_ref_id, $required_ids)):
                                ?>
                                        <a class="collapse-item" href="<?php echo site_url('Canon_market_backend'); ?>"><?php
                                           $abbreviation = get_config_value('abbreviation');
                                           $canon = ($abbreviation == 'อบต.') ? 'ข้อบัญญัติ' : 'เทศบัญญัติ';
                                           echo $canon;
                                           ?>ตลาด</a>
                            <?php endif; ?>

                            <?php
                            $grant_user_ref_id = explode(',', $this->session->userdata('grant_user_ref_id'));
                            $required_ids = [1, 102];
                            if (array_intersect($grant_user_ref_id, $required_ids)):
                                ?>
                                        <a class="collapse-item" href="<?php echo site_url('Canon_rmwp_backend'); ?>"><?php
                                           $abbreviation = get_config_value('abbreviation');
                                           $canon = ($abbreviation == 'อบต.') ? 'ข้อบัญญัติ' : 'เทศบัญญัติ';
                                           echo $canon;
                                           ?>การจัดการ<br>สิ่งปฏิกูลและมูลฝอย</a>
                            <?php endif; ?>

                            <?php
                            $grant_user_ref_id = explode(',', $this->session->userdata('grant_user_ref_id'));
                            $required_ids = [1, 103];
                            if (array_intersect($grant_user_ref_id, $required_ids)):
                                ?>
                                        <a class="collapse-item" href="<?php echo site_url('Canon_rcsp_backend'); ?>"><?php
                                           $abbreviation = get_config_value('abbreviation');
                                           $canon = ($abbreviation == 'อบต.') ? 'ข้อบัญญัติ' : 'เทศบัญญัติ';
                                           echo $canon;
                                           ?>หลักเกณฑ์การ<br>คัดขยะมูลฝอย</a>
                            <?php endif; ?>

                            <?php
                            $grant_user_ref_id = explode(',', $this->session->userdata('grant_user_ref_id'));
                            $required_ids = [1, 104];
                            if (array_intersect($grant_user_ref_id, $required_ids)):
                                ?>
                                        <a class="collapse-item" href="<?php echo site_url('Canon_rcp_backend'); ?>"><?php
                                           $abbreviation = get_config_value('abbreviation');
                                           $canon = ($abbreviation == 'อบต.') ? 'ข้อบัญญัติ' : 'เทศบัญญัติ';
                                           echo $canon;
                                           ?>การควบคุมการ<br>เลี้ยงหรือปล่อยสุนัขและแมว</a>
                            <?php endif; ?>

                        </div>
                    </div>
                </li>
    <?php endif; ?>

    <?php
    $grant_user_ref_id = explode(',', $this->session->userdata('grant_user_ref_id'));
    $required_ids = [1, 105, 106, 107, 108, 109, 110, 111, 112, 113, 114];
    if (array_intersect($grant_user_ref_id, $required_ids)):
        ?>
                <li class="nav-item">
                    <a class="nav-link collapsed" data-toggle="collapse" aria-expanded="true" href="javascript:void(0);" onclick="toggleCollapse('collapseeight')">
                        <img src="<?= base_url('docs/btn-bend10v2.png'); ?>">
                        <span>e-Service</span>
                    </a>
                    <div id="collapseeight" class="collapse" aria-labelledby="headingeight" data-parent="#accordionSidebar">
                        <div class="bg-white py-2 collapse-inner rounded">
                            <!-- <h6 class="collapse-header">Custom Components:</h6> -->
                            <?php
                            $grant_user_ref_id = explode(',', $this->session->userdata('grant_user_ref_id'));
                            $required_ids = [1, 105];
                            if (array_intersect($grant_user_ref_id, $required_ids)):
                                ?>
                                        <a class="collapse-item" href="<?php echo site_url('Line_backend'); ?>">Line oa แจ้งเตือน</a>
                            <?php endif; ?>

                    
                            <!--  
                    <?php
                    $grant_user_ref_id = explode(',', $this->session->userdata('grant_user_ref_id'));
                    $required_ids = [1, 00];
                    if (array_intersect($grant_user_ref_id, $required_ids)):
                        ?>
                        <a class="collapse-item" href="<?php echo site_url('Complain_backend'); ?>">ร้องเรียน/ร้องทุกข์</a>
                    <?php endif; ?>

                    <?php
                    $grant_user_ref_id = explode(',', $this->session->userdata('grant_user_ref_id'));
                    $required_ids = [1, 106];
                    if (array_intersect($grant_user_ref_id, $required_ids)):
                        ?>
                        <a class="collapse-item" href="<?php echo site_url('Queue_backend'); ?>">จองคิวติดต่อราชการออนไลน์</a>
                    <?php endif; ?>

                   


                    <?php
                    $grant_user_ref_id = explode(',', $this->session->userdata('grant_user_ref_id'));
                    $required_ids = [1, 107];
                    if (array_intersect($grant_user_ref_id, $required_ids)):
                        ?>
                        <a class="collapse-item" href="<?php echo site_url('Corruption_backend'); ?>">แจ้งเรื่องร้องเรียนการทุจริต<br>และประพฤติมิชอบ</a>
                    <?php endif; ?>
                      -->
                    
                    
                            <!--

                    <?php
                    $grant_user_ref_id = explode(',', $this->session->userdata('grant_user_ref_id'));
                    $required_ids = [1, 108];
                    if (array_intersect($grant_user_ref_id, $required_ids)):
                        ?>
                        <a class="collapse-item" href="<?php echo site_url('Suggestions_backend'); ?>">รับฟังความคิดเห็น<br>และข้อเสนอแนะ</a>
                    <?php endif; ?>
                    
                    
                    

                    <?php
                    $grant_user_ref_id = explode(',', $this->session->userdata('grant_user_ref_id'));
                    $required_ids = [1, 109];
                    if (array_intersect($grant_user_ref_id, $required_ids)):
                        ?>
                        <a class="collapse-item" href="<?php echo site_url('Esv_ods_backend'); ?>">ยื่นเอกสารออนไลน์</a>
                    <?php endif; ?>
                    
                    
                

                    <?php
                    $grant_user_ref_id = explode(',', $this->session->userdata('grant_user_ref_id'));
                    $required_ids = [1, 110];
                    if (array_intersect($grant_user_ref_id, $required_ids)):
                        ?>
                        <a class="collapse-item" href="<?php echo site_url('Q_a_backend'); ?>">กระทู้ถาม-ตอบ</a>
                    <?php endif; ?>
                    
                    -->

                            <?php
                            $grant_user_ref_id = explode(',', $this->session->userdata('grant_user_ref_id'));
                            $required_ids = [1, 111];
                            if (array_intersect($grant_user_ref_id, $required_ids)):
                                ?>
                                        <a class="collapse-item" href="<?php echo site_url('Questions_backend'); ?>">คำถามที่พบบ่อย</a>
                            <?php endif; ?>
                    
                    
                            <!--

                    <?php
                    $grant_user_ref_id = explode(',', $this->session->userdata('grant_user_ref_id'));
                    $required_ids = [1, 112];
                    if (array_intersect($grant_user_ref_id, $required_ids)):
                        ?>
                        <a class="collapse-item" href="<?php echo site_url('Form_esv_backend'); ?>">แบบฟอร์มออนไลน์</a>
                    <?php endif; ?>
                    
                    -->

                            <?php
                            $grant_user_ref_id = explode(',', $this->session->userdata('grant_user_ref_id'));
                            $required_ids = [1, 113];
                            if (array_intersect($grant_user_ref_id, $required_ids)):
                                ?>
                                        <a class="collapse-item" href="<?php echo site_url('Vulgar_backend'); ?>">จัดการข้อมูลกรองคำหยาบ</a>
                            <?php endif; ?>

                            <?php
                            $grant_user_ref_id = explode(',', $this->session->userdata('grant_user_ref_id'));
                            $required_ids = [1, 114];
                            if (array_intersect($grant_user_ref_id, $required_ids)):
                                ?>
                                        <a class="collapse-item" href="<?php echo site_url('Manual_esv_backend'); ?>">คู่มือการใช้งาน e-Service</a>
                            <?php endif; ?>
                        </div>
                    </div>
                </li>
    <?php endif; ?>

    <?php
    $grant_user_ref_id = explode(',', $this->session->userdata('grant_user_ref_id'));
    $required_ids = [1, 115];
    if (array_intersect($grant_user_ref_id, $required_ids)):
        ?>
                <li class="nav-item">
                    <a class="nav-link" href="<?php echo site_url('Laws_backend'); ?>">
                        <img src="<?= base_url('docs/btn-bend13.png'); ?>">
                        <span>กฎหมาย</span></a>
                </li>
    <?php endif; ?>
	
<?php
    $grant_user_ref_id = explode(',', $this->session->userdata('grant_user_ref_id'));
    $required_ids = [1, 134];
    if (array_intersect($grant_user_ref_id, $required_ids)) :
    ?>
    <li class="nav-item">
            <a class="nav-link" href="<?php echo site_url('Manual_admin_backend'); ?>">
                <img src="<?= base_url('docs/btn-bend13.png'); ?>">
                <span>คู่มือการใช้งานเว็บไซต์<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;สำหรับแอดมิน</span>
                </a>
        </li>
    <?php endif; ?>

 <?php if ($_SESSION['m_level'] == 1 || $_SESSION['m_level'] == 2): ?>
                <li class="nav-item">
                    <a class="nav-link" href="<?php echo site_url('Theme_backend'); ?>">
                        <i class="fas fa-palette" style="color: white; font-size: 20px; margin-right: 8px;"></i>
                        <span>จัดการธีม</span>
                    </a>
                </li>
<?php endif; ?>
    
        
 <?php if ($_SESSION['m_level'] == 1 || $_SESSION['m_level'] == 2): ?>
                <li class="nav-item">
                    <a class="nav-link" href="<?php echo site_url('Logs_controller'); ?>">
                        <i class="fas fa-database" style="color: white; font-size: 20px; margin-right: 8px;"></i>
                        <span>บันทึกการใช้งานระบบทั้งหมด</span>
                    </a>
                </li>
<?php endif; ?>

    
<!-- 	
<li class="nav-item">
        <a class="nav-link" href="<?php echo site_url('system_admin/profile'); ?>">
            <i class="fas fa-user-circle" style="color: white; font-size: 20px; margin-right: 8px;"></i>
            <span>โปรไฟล์</span>
        </a>
    </li>


-->

    <!-- เมนูกลับสู่เมนูหลัก (ไม่เช็ค grant_user) -->
    <li class="nav-item">
        <a class="nav-link" href="<?php echo site_url('User/choice'); ?>">
            <i class="fas fa-home" style="color: white; font-size: 20px; margin-right: 8px;"></i>
            <span>กลับสู่สมาร์ทออฟฟิต</span>
        </a>
    </li>



    <!-- <li class="nav-item">
                <a class="nav-link collapsed"  data-toggle="collapse" aria-expanded="true" href="javascript:void(0);" onclick="toggleCollapse('collapseten')">
                    <img src="<?= base_url('docs/btn-bend12.png'); ?>">
                    <span>กฏหมาย</span>
                </a>
                <div id="collapseten" class="collapse" aria-labelledby="headingnine" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">Custom Components:</h6>
                        <a class="collapse-item" href="<?php echo site_url('Laws_ral_backend'); ?>">กฏหมายและระเบียบที่เกี่ยวข้อง</a>
                        <a class="collapse-item" href="<?php echo site_url('Laws_rl_folder_backend'); ?>">กฏหมายที่เกี่ยวข้อง<br>แบบโฟลเดอร์</a>
                        <a class="collapse-item" href="<?php echo site_url('Laws_rl_file_backend'); ?>">กฏหมายที่เกี่ยวข้อง<br>แบบไฟล์</a>
                        <a class="collapse-item" href="<?php echo site_url('Laws_rm_backend'); ?>">กฏกระทรวง</a>
                        <a class="collapse-item" href="<?php echo site_url('Laws_act_backend'); ?>">พระราชบัญญัติ</a>
                        <a class="collapse-item" href="<?php echo site_url('Laws_ec_backend'); ?>">กฎหมายที่ประเมินกรณี<br> รมว.มท.รักษาการร่วม</a>
                        <a class="collapse-item" href="<?php echo site_url('Laws_la_backend'); ?>">กฏหมายเพิ่มเติม</a>

                    </div>
                </div>
            </li> -->
    <!-- <li class="nav-item">
                <a class="nav-link collapsed"  data-toggle="collapse" aria-expanded="true" href="javascript:void(0);" onclick="toggleCollapse('collapsenine')">
                    <img src="<?= base_url('docs/btn-bend13.png'); ?>">
                    <span>รายงาน</span>
                </a>
                <div id="collapsenine" class="collapse" aria-labelledby="headingnine" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded"> -->
    <!-- <h6 class="collapse-header">Custom Components:</h6> -->
    <!-- <a class="collapse-item" href="<?php echo site_url('report_backend'); ?>">รายงานภาพรวม</a>
                        <a class="collapse-item" href="<?php echo site_url('report/report_user_backend'); ?>">แยกตามผู้ใช้งาน</a>
                        <a class="collapse-item" href="<?php echo site_url('report/report_date_backend'); ?>">แยกตามวัน/เดือน/ปี</a>
                    </div>
                </div>
            </li> -->

    <!-- Nav Item - Utilities Collapse Menu -->
    <!-- <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseUtilities" aria-expanded="true" aria-controls="collapseUtilities">
                    <i class="fas fa-fw fa-wrench"></i>
                    <span>Utilities</span>
                </a>
                <div id="collapseUtilities" class="collapse" aria-labelledby="headingUtilities" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">Custom Utilities:</h6>
                        <a class="collapse-item" href="utilities-color.html">Colors</a>
                        <a class="collapse-item" href="utilities-border.html">Borders</a>
                        <a class="collapse-item" href="utilities-animation.html">Animations</a>
                        <a class="collapse-item" href="utilities-other.html">Other</a>
                    </div>
                </div>
            </li> -->

    <!-- Divider -->
    <!-- <hr class="sidebar-divider"> -->

    <!-- Heading -->
    <!-- <div class="sidebar-heading">
                Addons
            </div> -->

    <!-- Nav Item - Pages Collapse Menu -->
    <!-- <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePages" aria-expanded="true" aria-controls="collapsePages">
                    <i class="fas fa-fw fa-folder"></i>
                    <span>Pages</span>
                </a>
                <div id="collapsePages" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">Login Screens:</h6>
                        <a class="collapse-item" href="login.html">Login</a>
                        <a class="collapse-item" href="register.html">Register</a>
                        <a class="collapse-item" href="forgot-password.html">Forgot Password</a>
                        <div class="collapse-divider"></div>
                        <h6 class="collapse-header">Other Pages:</h6>
                        <a class="collapse-item" href="404.html">404 Page</a>
                        <a class="collapse-item" href="blank.html">Blank Page</a>
                    </div>
                </div>
            </li> -->

    <!-- Nav Item - Charts -->
    <!-- <li class="nav-item">
                <a class="nav-link" href="charts.html">
                    <i class="fas fa-fw fa-chart-area"></i>
                    <span>Charts</span></a>
            </li> -->

    <!-- Nav Item - Tables -->
    <!-- <li class="nav-item">
                <a class="nav-link" href="tables.html">
                    <i class="fas fa-fw fa-table"></i>
                    <span>Tables</span></a>
            </li> -->

    <!-- Divider -->
    <!-- <hr class="sidebar-divider d-none d-md-block"> -->

    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>

</ul>
<!-- End of Sidebar -->

<!-- Content Wrapper -->
<div id="content-wrapper" class="d-flex flex-column">

    <!-- Main Content -->
    <div id="content">

        <!-- Topbar -->
        <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

            <!-- Sidebar Toggle (Topbar) -->
            <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                <i class="fa fa-bars"></i>
            </button>

            <!-- Topbar Search -->
            <form class="d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search">
                <div class="input-group search-box">
                    <input id="searchInput" type="text" class="form-control bg-light border-0 small" placeholder="ค้นหาข้อมูล" aria-label="Search" aria-describedby="basic-addon2" oninput="search()">
                    <div class="input-group-append">
                        <button class="btn btn-custom" type="button">
                            <i class="fas fa-search fa-sm white"></i>
                        </button>
                    </div>
                </div>
            </form>

            <!-- Topbar Navbar -->
            <ul class="navbar-nav ml-auto">

                <!-- Nav Item - Search Dropdown (Visible Only XS) -->
                <li class="nav-item dropdown no-arrow d-sm-none">
                    <a class="nav-link dropdown-toggle" href="#" id="searchDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="fas fa-search fa-fw"></i>
                    </a>
                    <!-- Dropdown - Messages -->
                    <div class="dropdown-menu dropdown-menu-right p-3 shadow animated--grow-in" aria-labelledby="searchDropdown">
                        <form class="form-inline mr-auto w-100 navbar-search">
                            <div class="input-group">
                                <input type="text" class="form-control bg-light border-0 small" placeholder="Search for..." aria-label="Search" aria-describedby="basic-addon2">
                                <div class="input-group-append">
                                    <button class="btn btn-primary" type="button">
                                        <i class="fas fa-search fa-sm"></i>
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </li>

                <!-- Nav Item - Alerts -->
                <li class="nav-item dropdown no-arrow mx-1">
                    <!-- <a class="nav-link dropdown-toggle" href="#" id="alertsDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-bell fa-fw"></i> -->
                    <!-- Counter - Alerts แจ้งเตือน -->
                    <!-- <span class="badge badge-danger badge-counter">3+</span>
                            </a> -->
                    <!-- Dropdown - Alerts -->
                    <div class="dropdown-list dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="alertsDropdown">
                        <h6 class="dropdown-header">
                            Alerts Center
                        </h6>
                        <a class="dropdown-item d-flex align-items-center" href="#">
                            <div class="mr-3">
                                <div class="icon-circle bg-primary">
                                    <i class="fas fa-file-alt text-white"></i>
                                </div>
                            </div>
                            <div>
                                <div class="small text-gray-500">December 12, 2019</div>
                                <span class="font-weight-bold">A new monthly report is ready to download!</span>
                            </div>
                        </a>
                        <a class="dropdown-item d-flex align-items-center" href="#">
                            <div class="mr-3">
                                <div class="icon-circle bg-success">
                                    <i class="fas fa-donate text-white"></i>
                                </div>
                            </div>
                            <div>
                                <div class="small text-gray-500">December 7, 2019</div>
                                $290.29 has been deposited into your account!
                            </div>
                        </a>
                        <a class="dropdown-item d-flex align-items-center" href="#">
                            <div class="mr-3">
                                <div class="icon-circle bg-warning">
                                    <i class="fas fa-exclamation-triangle text-white"></i>
                                </div>
                            </div>
                            <div>
                                <div class="small text-gray-500">December 2, 2019</div>
                                Spending Alert: We've noticed unusually high spending for your account.
                            </div>
                        </a>
                        <a class="dropdown-item text-center small text-gray-500" href="#">Show All Alerts</a>
                    </div>
                </li>

                <!-- Nav Item - Messages -->
                <!-- <li class="nav-item dropdown no-arrow mx-1">
                            <a class="nav-link dropdown-toggle" href="#" id="messagesDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-envelope fa-fw"></i> -->
                <!-- Counter - Messages -->
                <!-- <span class="badge badge-danger badge-counter">7</span>
                            </a> -->
                <!-- Dropdown - Messages -->
                <div class="dropdown-list dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="messagesDropdown">
                    <h6 class="dropdown-header">
                        Message Center
                    </h6>
                    <a class="dropdown-item d-flex align-items-center" href="#">
                        <div class="dropdown-list-image mr-3">
                            <img class="rounded-circle" src="img/undraw_profile_1.svg" alt="...">
                            <div class="status-indicator bg-success"></div>
                        </div>
                        <div class="font-weight-bold">
                            <div class="text-truncate">Hi there! I am wondering if you can help me with a
                                problem I've been having.</div>
                            <div class="small text-gray-500">Emily Fowler · 58m</div>
                        </div>
                    </a>
                    <a class="dropdown-item d-flex align-items-center" href="#">
                        <div class="dropdown-list-image mr-3">
                            <img class="rounded-circle" src="img/undraw_profile_2.svg" alt="...">
                            <div class="status-indicator"></div>
                        </div>
                        <div>
                            <div class="text-truncate">I have the photos that you ordered last month, how
                                would you like them sent to you?</div>
                            <div class="small text-gray-500">Jae Chun · 1d</div>
                        </div>
                    </a>
                    <a class="dropdown-item d-flex align-items-center" href="#">
                        <div class="dropdown-list-image mr-3">
                            <img class="rounded-circle" src="img/undraw_profile_3.svg" alt="...">
                            <div class="status-indicator bg-warning"></div>
                        </div>
                        <div>
                            <div class="text-truncate">Last month's report looks great, I am very happy with
                                the progress so far, keep up the good work!</div>
                            <div class="small text-gray-500">Morgan Alvarez · 2d</div>
                        </div>
                    </a>
                    <a class="dropdown-item d-flex align-items-center" href="#">
                        <div class="dropdown-list-image mr-3">
                            <img class="rounded-circle" src="https://source.unsplash.com/Mv9hjnEUHR4/60x60" alt="...">
                            <div class="status-indicator bg-success"></div>
                        </div>
                        <div>
                            <div class="text-truncate">Am I a good boy? The reason I ask is because someone
                                told me that people say this to all dogs, even if they aren't good...</div>
                            <div class="small text-gray-500">Chicken the Dog · 2w</div>
                        </div>
                    </a>
                    <a class="dropdown-item text-center small text-gray-500" href="#">Read More Messages</a>
                </div>
                </li>

                <div class="topbar-divider d-none d-sm-block"></div>

                <!-- Nav Item - User Information -->
                <li class="nav-item dropdown no-arrow">
                    <?php
                    $user_img = $this->session->userdata('m_img');
                    $img_src = base_url('docs/img/' . (!empty($user_img) ? $user_img : 'default_user.png'));
                    ?>

                    <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <span class="mr-2 d-none d-lg-inline text-gray-600 small"><?php echo $this->session->userdata('m_fname'); ?></span>
                        <img class="img-profile rounded-circle" src="<?php echo $img_src; ?>">
                    </a>
                    <!-- Dropdown - User Information -->
                    <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
                        <a class="dropdown-item" href="<?php echo site_url('system_admin/profile'); ?>">
                            <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                            Profile
                        </a>
                        <!-- <a class="dropdown-item" href="#">
                                    <i class="fas fa-cogs fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Settings
                                </a>
                                <a class="dropdown-item" href="#">
                                    <i class="fas fa-list fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Activity Log
                                </a> -->
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="<?php echo site_url('user/logout'); ?>">
                            <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                            Logout
                        </a>
                    </div>
                </li>

            </ul>

        </nav>
        <!-- End of Topbar -->

        <!-- Begin Page Content -->
        <div class="container-fluid">

            <div id="searchResults"></div>
            <ul id="menuList" style="display: none;"></ul>