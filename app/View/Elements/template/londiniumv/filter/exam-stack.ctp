<form action="#" role="form" class="panel-filter">
    <div class="panel panel-default">
        <div class="panel-heading">
            <h6 class="panel-title">Filter Data</h6>
            <div class="panel-icons-group"> <a href="#" data-panel="collapse" class="btn btn-link btn-icon"><i class="icon-arrow-up9"></i></a></div>
        </div>
        <div class="panel-body">
            <div class="form-group">
                <div class="row">
                    <div class="col-md-6">
                        <label><?= __("NPM") ?></label>
                        <?= $this->Form->input(null, array("default" => isset($this->request->query['ExamStack_npm']) ? $this->request->query['ExamStack_npm'] : '', "name" => "ExamStack.npm", "div" => false, "label" => false, "class" => "form-control tip")) ?>
                    </div>
                    <div class="col-md-6">
                        <label><?= __("Nama Mahasiswa") ?></label>
                        <?= $this->Form->input(null, array("default" => isset($this->request->query['ExamStack_name']) ? $this->request->query['ExamStack_name'] : '', "name" => "ExamStack.name", "div" => false, "label" => false, "class" => "form-control tip")) ?>
                    </div>
                </div>
            </div>
            <div class="form-group">
                <div class="row">
                    <div class="col-md-6">
                        <label><?= __("Mata Kuliah 1") ?></label>
                        <?= $this->Form->input(null, array("options" => $courses, "default" => isset($this->request->query['select_ExamStack_course1_id']) ? $this->request->query['select_ExamStack_course1_id'] : '', "name" => "select.ExamStack.course1_id", "div" => false, "label" => false, "class" => "select-full", "placeholder" => "-Semua-", "empty" => "")) ?>
                    </div>
                    <div class="col-md-6">
                        <label><?= __("Mata Kuliah 2") ?></label>
                        <?= $this->Form->input(null, array("options" => $courses, "default" => isset($this->request->query['select_ExamStack_course2_id']) ? $this->request->query['select_ExamStack_course2_id'] : '', "name" => "select.ExamStack.course2_id", "div" => false, "label" => false, "class" => "select-full", "placeholder" => "-Semua-", "empty" => "")) ?>
                    </div>
                </div>
            </div>
            <div class="form-group">
                <div class="row">
                    <div class="col-md-3">
                        <label><?= __("Periode Ujian") ?></label>
                        <?= $this->Form->input(null, array("default" => isset($this->request->query['awal_ExamStack_d']) ? $this->request->query['awal_ExamStack_d'] : '', "name" => "awal.ExamStack.d", "div" => false, "label" => false, "class" => "form-control datepicker","placeholder"=>"Awal Periode")) ?>
                    </div>
                    <div class="col-md-3">
                        <label>&nbsp;</label>
                        <?= $this->Form->input(null, array("default" => isset($this->request->query['akhir_ExamStack_d']) ? $this->request->query['akhir_ExamStack_d'] : '', "name" => "akhir.ExamStack.d", "div" => false, "label" => false, "class" => "form-control datepicker","placeholder"=>"Awal Periode")) ?>
                    </div>
                </div>
            </div>
            <div class="form-actions text-center">
                <input type="button" value="<?= __("Reset") ?>" class="btn btn-danger btn-filter-reset">
                <input type="button" value="<?= __("Cari") ?>" class="btn btn-info btn-filter">
            </div>
        </div>
    </div>
</form>
<script>
    filterReload();
</script>
