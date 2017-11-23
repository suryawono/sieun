<?php echo $this->Form->create("ExamAbsent", array("class" => "form-horizontal form-separate", "action" => "edit", "id" => "formSubmit", "inputDefaults" => array("error" => array("attributes" => array("wrap" => "label", "class" => "error"))))) ?>
<div class="row">
    <div class="col-lg-12 col-md-12">
        <div class="panel panel-default">
            <div class="panel-body">
                <div class="block-inner text-danger">
                    <h6 class="heading-hr"><?= __("Ubah Absen Ujian") ?>
                    </h6>
                </div>
                <div class="table-responsive">
                    <table width="100%" class="table">
                        <div class="panel-heading" style="background:#2179cc">
                            <h6 class="panel-title" style=" color:#fff"><i class="icon-menu2"></i><?= __("Data Ujian") ?></h6>
                        </div>
                        <tr>
                            <td>
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <?php
                                            echo $this->Form->label("ExamAbsent.exam_academic_year_id", __("Tahun Ajaran"), array("class" => "col-md-4 control-label"));
                                            echo $this->Form->input("ExamAbsent.exam_academic_year_id", array("options" => $examAcademicYears, "div" => array("class" => "col-md-8"), "label" => false, "class" => "select-full"));
                                            ?>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <?php
                                            echo $this->Form->label("ExamAbsent.exam_academic_category_id", __("Semester"), array("class" => "col-md-4 control-label"));
                                            echo $this->Form->input("ExamAbsent.exam_academic_category_id", array("options" => $examAcademicCategories, "div" => array("class" => "col-md-8"), "label" => false, "class" => "select-full"));
                                            ?>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <?php
                                            echo $this->Form->label("ExamAbsent.exam_category_id", __("Kategori Ujian"), array("class" => "col-md-4 control-label"));
                                            echo $this->Form->input("ExamAbsent.exam_category_id", array("options" => $examCategories, "div" => array("class" => "col-md-8"), "label" => false, "class" => "select-full"));
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
                                            echo $this->Form->label("ExamAbsent.course_id", __("Mata Kuliah"), array("class" => "col-md-4 control-label"));
                                            echo $this->Form->input("ExamAbsent.course_id", array("options" => $courses, "div" => array("class" => "col-md-8"), "label" => false, "class" => "select-full", "placeholder" => "-Pilih Mata Kuliah-", "empty" => ""));
                                            ?>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <?php
                                            echo $this->Form->label("ExamAbsent.d", __("Tanggal Ujian"), array("class" => "col-md-4 control-label"));
                                            echo $this->Form->input("ExamAbsent.d", array("div" => array("class" => "col-md-8"), "label" => false, "class" => "form-control datepicker", "type" => "text"));
                                            ?>
                                        </div>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    </table>
                </div>

                <div class="table-responsive">
                    <table width="100%" class="table">
                        <div class="panel-heading" style="background:#2179cc">
                            <h6 class="panel-title" style=" color:#fff"><i class="icon-menu2"></i><?= __("Data Absen") ?></h6>
                        </div>
                        <tr>
                            <td>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <?php
                                            echo $this->Form->label("ExamAbsent.npm", __("NPM"), array("class" => "col-md-4 control-label"));
                                            echo $this->Form->input("ExamAbsent.npm", array("div" => array("class" => "col-md-8"), "label" => false, "class" => "form-control"));
                                            ?>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <?php
                                            echo $this->Form->label("ExamAbsent.name", __("Nama Mahasiswa"), array("class" => "col-md-4 control-label"));
                                            echo $this->Form->input("ExamAbsent.name", array("div" => array("class" => "col-md-8"), "label" => false, "class" => "form-control"));
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
                                            echo $this->Form->label("ExamAbsent.pengawas_id", __("Pengawas"), array("class" => "col-md-4 control-label"));
                                            echo $this->Form->input("ExamAbsent.pengawas_id", array("options" => $accounts, "div" => array("class" => "col-md-8"), "label" => false, "class" => "select-full", "placeholder" => "-Pilih Pengawas-", "empty" => ""));
                                            ?>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <?php
                                            echo $this->Form->label("ExamAbsent.keterangan", __("Keterangan"), array("class" => "col-md-4 control-label"));
                                            echo $this->Form->input("ExamAbsent.keterangan", array("div" => array("class" => "col-md-8"), "label" => false, "class" => "form-control"));
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