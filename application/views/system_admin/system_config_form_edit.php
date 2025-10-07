<div class="container">
    <div class="row">
        <div class="col-md-2"></div>
        <div class="col-md-7">
            <h4>แก้ไขข้อมูล System Config</h4>
            <form action="<?php echo site_url('system_config_backend/edit/' . $rsedit->id); ?> " method="post" class="form-horizontal">
                <br>
                <div class="form-group row">
                    <div class="col-sm-2 control-label">Keyword</div>
                    <div class="col-sm-10">
                        <input type="text" name="keyword" id="keyword" class="form-control" value="<?= $rsedit->keyword; ?>" readonly>
                    </div>
                </div>
                <br>
                <div class="form-group row">
                    <div class="col-sm-2 control-label">value</div>
                    <div class="col-sm-10">
                        <input type="text" name="value" id="value" class="form-control" value="<?= $rsedit->value; ?>">
                    </div>
                </div>
                <br>
                <div class="form-group row">
                    <div class="col-sm-2 control-label">description</div>
                    <div class="col-sm-10">
                        <input type="text" name="description" id="description" class="form-control" value="<?= $rsedit->description; ?>" readonly>
                    </div>
                </div>
                <br>
                <div class="form-group row">
                    <div class="col-sm-4 control-label"></div>
                    <div class="col-sm-8">
                        <button type="submit" class="btn btn-success">บันทึกข้อมูล</button>
                        <a class="btn btn-danger" href="<?= site_url('system_config_backend'); ?>" role="button">ยกเลิก</a>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>