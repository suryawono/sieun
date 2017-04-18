<?php echo $this->Form->create("ExamFileRetrieval", array("class" => "form-horizontal form-separate", "action" => "add", "id" => "formSubmit", "inputDefaults" => array("error" => array("attributes" => array("wrap" => "label", "class" => "error"))))) ?>
<div class="row">
    <div class="col-lg-12 col-md-12">
        <div class="panel panel-default">
            <div class="panel-body">
                <div class="block-inner text-danger">
                    <h6 class="heading-hr"><?= __("Tambah Pengambilan Berkas < 20 Menit") ?>
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
                                            echo $this->Form->label("ExamFileRetrieval.pengawas_id", __("Pengawas"), array("class" => "col-md-4 control-label"));
                                            echo $this->Form->input("ExamFileRetrieval.pengawas_id", array("options" => $accounts, "div" => array("class" => "col-md-8"), "label" => false, "class" => "select-full", "placeholder" => "-Pilih Pengawas-", "empty" => ""));
                                            ?>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <?php
                                            echo $this->Form->label("ExamFileRetrieval.course_id", __("Mata Kuliah"), array("class" => "col-md-4 control-label"));
                                            echo $this->Form->input("ExamFileRetrieval.course_id", array("options" => $courses, "div" => array("class" => "col-md-8"), "label" => false, "class" => "select-full", "placeholder" => "-Pilih Mata Kuliah-", "empty" => ""));
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
                                            echo $this->Form->label("ExamFileRetrieval.d", __("Tanggal Ujian"), array("class" => "col-md-4 control-label"));
                                            echo $this->Form->input("ExamFileRetrieval.d", array("div" => array("class" => "col-md-8"), "label" => false, "class" => "form-control datepicker", "type" => "text"));
                                            ?>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <?php
                                            echo $this->Form->label("ExamFileRetrieval.ruang", __("Ruang"), array("class" => "col-md-4 control-label"));
                                            echo $this->Form->input("ExamFileRetrieval.ruang", array("div" => array("class" => "col-md-8"), "label" => false, "class" => "form-control"));
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
                                            echo $this->Form->label("ExamFileRetrieval.waktu_pengambilan", __("Waktu Pengambilan"), array("class" => "col-md-4 control-label"));
                                            echo $this->Form->input("ExamFileRetrieval.waktu_pengambilan", array("div" => array("class" => "col-md-8"), "label" => false, "class" => "form-control timepicker", "type" => "text"));
                                            ?>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <?php
                                            echo $this->Form->label("ExamFileRetrieval.waktu_ujian", __("Waktu Ujian"), array("class" => "col-md-4 control-label"));
                                            echo $this->Form->input("ExamFileRetrieval.waktu_ujian", array("div" => array("class" => "col-md-8"), "label" => false, "class" => "form-control timepicker", "type" => "text"));
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