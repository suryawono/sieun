<?php echo $this->Form->create("Exam", array("class" => "form-horizontal form-separate", "action" => "edit", "id" => "formSubmit", "inputDefaults" => array("error" => array("attributes" => array("wrap" => "label", "class" => "error"))))) ?>
<div class="row">
    <div class="col-lg-12 col-md-12">
        <div class="panel panel-default">
            <div class="panel-body">
                <div class="block-inner text-danger">
                    <h6 class="heading-hr"><?= __("Ubah Jadwal Ujian") ?>
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
                                            echo $this->Form->label("Exam.course_id", __("Mata Kuliah"), array("class" => "col-md-4 control-label"));
                                            echo $this->Form->input("Exam.course_id", array("div" => array("class" => "col-md-8"), "label" => false, "class" => "select-full", 'empty' => "", "placeholder" => "- Pilih Mata Kuliah -"));
                                            ?>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <?php
                                            echo $this->Form->label("Exam.semester_id", __("Semester"), array("class" => "col-md-4 control-label"));
                                            echo $this->Form->input("Exam.semester_id", array("div" => array("class" => "col-md-8"), "label" => false, "class" => "select-full", 'empty' => "", 'placeholder' => "- Pilih Semester -"));
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
                                            echo $this->Form->label("Exam.exam_category_id", __("Tipe Ujian"), array("class" => "col-md-4 control-label"));
                                            echo $this->Form->input("Exam.exam_category_id", array("div" => array("class" => "col-md-8"), "label" => false, "class" => "select-full", 'empty' => "", 'placeholder' => "- Pilih Tipe Ujian -"));
                                            ?>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <?php
                                            echo $this->Form->label("Exam.exam_academic_category_id", __("Kategori Akademik Ujian"), array("class" => "col-md-4 control-label"));
                                            echo $this->Form->input("Exam.exam_academic_category_id", array("div" => array("class" => "col-md-8"), "label" => false, "class" => "select-full", 'empty' => "", 'placeholder' => "- Pilih Kategori Akademik Ujian -"));
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
                                            echo $this->Form->label("Exam.exam_academic_year_id", __("Tahun Ajaran Akademik"), array("class" => "col-md-4 control-label"));
                                            echo $this->Form->input("Exam.exam_academic_year_id", array("div" => array("class" => "col-md-8"), "label" => false, "class" => "select-full", 'empty' => "", 'placeholder' => "- Pilih Tahun Ajaran -"));
                                            ?>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <?php
                                            echo $this->Form->label("Exam.exam_date", __("Tanggal Ujian"), array("class" => "col-md-4 control-label"));
                                            echo $this->Form->input("Exam.exam_date", array("type" => "text", "div" => array("class" => "col-md-8"), "label" => false, "class" => "form-control datepicker"));
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
                                            $start_time = date("H:i", strtotime($this->data['Exam']['start_time']));
                                            echo $this->Form->label("Exam.start_time", __("Mulai"), array("class" => "col-md-4 control-label"));
                                            echo $this->Form->input("Exam.start_time", array("type" => "text", "div" => array("class" => "col-md-8"), "label" => false, "class" => "form-control timepicker", "value" => $start_time));
                                            ?>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <?php
                                            $end_time = date("H:i", strtotime($this->data['Exam']['end_time']));
                                            echo $this->Form->label("Exam.end_time", __("Selesai"), array("class" => "col-md-4 control-label"));
                                            echo $this->Form->input("Exam.end_time", array("div" => array("class" => "col-md-8"), "type" => "text", "label" => false, "class" => "form-control timepicker", 'value' => $end_time));
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