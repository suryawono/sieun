<?php echo $this->Form->create("ExamAcademicYear", array("class" => "form-horizontal form-separate", "action" => "add", "id" => "formSubmit", "inputDefaults" => array("error" => array("attributes" => array("wrap" => "label", "class" => "error"))))) ?>
<div class="row">
    <div class="col-lg-12 col-md-12">
        <div class="panel panel-default">
            <div class="panel-body">
                <div class="block-inner text-danger">
                    <h6 class="heading-hr"><?= __("Tambah Kategori Ujian") ?>
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
                                            echo $this->Form->label("ExamAcademicYear.start_year", __("Start Year"), array("class" => "col-md-4 control-label"));
                                            echo $this->Form->input("ExamAcademicYear.start_year", array("div" => array("class" => "col-md-8"), "label" => false, "class" => "form-control", 'id' => "startYear", "maxlength" => 4));
                                            ?>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <?php
                                            echo $this->Form->label("ExamAcademicYear.end_year", __("End Year"), array("class" => "col-md-4 control-label"));
                                            echo $this->Form->input("ExamAcademicYear.end_year", array("div" => array("class" => "col-md-8"), "label" => false, "class" => "form-control", 'readonly', 'id' => "endYear"));
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
                                            echo $this->Form->label("ExamAcademicYear.order", __("Order"), array("class" => "col-md-4 control-label"));
                                            echo $this->Form->input("ExamAcademicYear.order", array("div" => array("class" => "col-md-8"), "label" => false, "class" => "form-control"));
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
<script>
    $(document).ready(function() {
        $("#startYear").on("keyup", function() {
            var start_year = parseInt($(this).val());
            var end_year = start_year + 1;
            $("#endYear").val(end_year);
        });
    });
</script>