<?php echo $this->Form->create("ExamMakeup", array("class" => "form-horizontal form-separate", "action" => "edit", "id" => "formSubmit", "inputDefaults" => array("error" => array("attributes" => array("wrap" => "label", "class" => "error"))))) ?>
<div class="row">
    <div class="col-lg-12 col-md-12">
        <div class="panel panel-default">
            <div class="panel-body">
                <div class="block-inner text-danger">
                    <h6 class="heading-hr"><?= __("Ubah Permohonan Ujian Susulan") ?>
                    </h6>
                </div>
                <div class="table-responsive">
                    <table width="100%" class="table">
                        <tr>
                            <td>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <?php
                                            echo $this->Form->label("ExamMakeup.npm", __("NPM"), array("class" => "col-md-4 control-label"));
                                            echo $this->Form->input("ExamMakeup.npm", array("div" => array("class" => "col-md-8"), "label" => false, "class" => "form-control"));
                                            ?>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <?php
                                            echo $this->Form->label("ExamMakeup.name", __("Nama Mahasiswa"), array("class" => "col-md-4 control-label"));
                                            echo $this->Form->input("ExamMakeup.name", array("div" => array("class" => "col-md-8"), "label" => false, "class" => "form-control"));
                                            ?>
                                        </div>
                                    </div>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <?php
                                            echo $this->Form->label("ExamMakeup.course_id", __("Mata Kuliah"), array("class" => "col-md-4 control-label"));
                                            echo $this->Form->input("ExamMakeup.course_id", array("options" => $courses, "div" => array("class" => "col-md-8"), "label" => false, "class" => "select-full", "placeholder" => "-Pilih Mata Kuliah-", "empty" => ""));
                                            ?>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <?php
                                            echo $this->Form->label("ExamMakeup.alasan", __("Alasan Tidak Hadir"), array("class" => "col-md-4 control-label"));
                                            echo $this->Form->input("ExamMakeup.alasan", array("div" => array("class" => "col-md-8"), "label" => false, "class" => "form-control"));
                                            ?>
                                        </div>
                                    </div>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <div class="form-actions text-right">
                                    <input name="Button" type="button" onclick="history.go(-1);" class="btn btn-success" value="<?= __("Kembali") ?>">
                                    <input type="reset" value="Reset" class="btn btn-info">
                                    <input type="submit" value="<?= __("Simpan") ?>" class="btn btn-danger">
                                </div>
                            </td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<?php echo $this->Form->end() ?>