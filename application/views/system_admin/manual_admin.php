<style>
    .manual-card {
        border: 1px solid #ddd;
        border-radius: 10px;
        padding: 15px;
        margin-bottom: 20px;
        box-shadow: 0px 2px 6px rgba(0, 0, 0, 0.1);
    }

    .manual-preview {
        width: 100%;
        height: 600px;
        border-radius: 6px;
        border: 1px solid #ccc;
    }
</style>

<div class="container mt-4">
    <h2 class="mb-4">คู่มือการใช้งานเว็บไซต์สำหรับแอดมิน</h2>

    <div class="row">
        <?php foreach ($manuals as $row): ?>
            <div class="col-md-12 col-lg-12">
                <div class="manual-card">
                    <h5 class="mb-3 text-center"><?php echo $row->manual_admin_name; ?></h5>

                    <?php if ($row->manual_admin_pdf): ?>
                        <!-- Preview PDF -->
                        <embed src="<?php echo base_url('docs/file/' . $row->manual_admin_pdf); ?>" type="application/pdf" class="manual-preview">

                        <!-- ปุ่มกด -->
                        <div class="d-flex justify-content-between align-items-center mt-3">
                            <a href="<?php echo site_url('manual_admin_backend/download/' . $row->manual_admin_id); ?>" class="btn btn-success btn-sm">
                                ดาวน์โหลด
                            </a>
                            <a href="<?php echo site_url('manual_admin_backend/edit/' . $row->manual_admin_id); ?>" class="btn btn-warning btn-sm">
                                แก้ไข
                            </a>
                        </div>
                        <small class="text-muted d-block mt-2">ดาวน์โหลดแล้ว: <?php echo $row->manual_admin_download; ?> ครั้ง</small>
                    <?php else: ?>
                        <p class="text-muted">ยังไม่มีไฟล์อัปโหลด</p>
                    <?php endif; ?>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</div>
