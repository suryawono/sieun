<?php echo $this->Form->create("ExamAbsent", array("class" => "form-horizontal form-separate", "action" => "edit", "id" => "formSubmit", "inputDefaults" => array("error" => array("attributes" => array("wrap" => "label", "class" => "error"))))) ?>
<div class="row">
    <div class="col-lg-12 col-md-12">
        <div class="panel panel-default">
            <div class="panel-body">
                <div class="block-inner text-danger">
                    <h6 class="heading-hr"><?= __("Tambah Catatan Pengawas") ?>
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
                                            echo $this->Form->label("ExamCategory.code", __("Kode"), array("class" => "col-md-4 control-label"));
                                            echo $this->Form->input("ExamCategory.code", array("div" => array("class" => "col-md-8"), "label" => false, "class" => "form-control", 'maxlength' => 3));
                                            ?>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <?php
                                            echo $this->Form->label("ExamCategory.name", __("Nama"), array("class" => "col-md-4 control-label"));
                                            echo $this->Form->input("ExamCategory.name", array("div" => array("class" => "col-md-8"), "label" => false, "class" => "form-control"));
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
                                            echo $this->Form->label("ExamCategory.order", __("Order"), array("class" => "col-md-4 control-label"));
                                            echo $this->Form->input("ExamCategory.order", array("div" => array("class" => "col-md-8"), "label" => false, "class" => "form-control"));
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