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
                        <label><?= __("Mata Kuliah") ?></label>
                        <?= $this->Form->input(null, array("options" => $courses, "default" => isset($this->request->query['select_NoteExam_course_id']) ? $this->request->query['select_NoteExam_course_id'] : '', "name" => "select.NoteExam.course_id", "div" => false, "label" => false, "class" => "select-full", "placeholder" => "-Semua-", "empty" => "")) ?>
                    </div>
                    <div class="col-md-6">
                        <label><?= __("Pengawas") ?></label>
                        <?= $this->Form->input(null, array("options" => $accounts, "default" => isset($this->request->query['select_NoteExam_pengawas_id']) ? $this->request->query['select_NoteExam_pengawas_id'] : '', "name" => "select.NoteExam.pengawas_id", "div" => false, "label" => false, "class" => "select-full", "placeholder" => "-Semua-", "empty" => "")) ?>
                    </div>
                </div>
            </div>
            <div class="form-group">
                <div class="row">
                    <div class="col-md-3">
                        <label><?= __("Periode Ujian") ?></label>
                        <?= $this->Form->input(null, array("default" => isset($this->request->query['awal_NoteExam_d']) ? $this->request->query['awal_NoteExam_d'] : '', "name" => "awal.NoteExam.d", "div" => false, "label" => false, "class" => "form-control datepicker","placeholder"=>"Awal Periode")) ?>
                    </div>
                    <div class="col-md-3">
                        <label>&nbsp;</label>
                        <?= $this->Form->input(null, array("default" => isset($this->request->query['akhir_NoteExam_d']) ? $this->request->query['akhir_NoteExam_d'] : '', "name" => "akhir.NoteExam.d", "div" => false, "label" => false, "class" => "form-control datepicker","placeholder"=>"Awal Periode")) ?>
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
