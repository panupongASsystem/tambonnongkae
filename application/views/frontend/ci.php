<div class="text-center pages-head" >
    <span class="font-pages-head">ข้อมูลชุมชน</span>
</div>
<div class="text-center" style="padding-top: 50px">
    <img src="<?php echo base_url('docs/logo.png'); ?>" width="174px" height="174px">
</div>
</div>
<img src="<?php echo base_url('docs/welcome-btm-light-other.png'); ?>">

<div class="bg-pages " style="margin-top: 20px;">
    <div class="container-pages-detail">
        <div class="pages-content break-word text-center">
            <span class="font-pages-content-head">ตารางแสดงจำนวนประชากรในเขต<?php echo get_config_value('fname'); ?></span><br>
            <table class="table table-bordered mt-5">
                <thead>
                    <tr>
                        <th><b>ชื่อหมู่บ้าน</b></th>
                        <th><b>จำนวนประชากรรวม</b></th>
                        <th><b>จำนวนประชากรชาย</b></th>
                        <th><b>จำนวนประชากรหญิง</b></th>
                        <th><b>จำนวนครัวเรือน</b></th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($qCi as $rs) { ?>
                        <tr>
                            <td><?= $rs->ci_name; ?></td>
                            <td><?= $rs->ci_total; ?></td>
                            <td><?= $rs->ci_man; ?></td>
                            <td><?= $rs->ci_woman; ?></td>
                            <td><?= $rs->ci_home; ?></td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
            <!-- <p>ที่มา : </p> -->
        </div>
    </div>
</div><br><br><br>