<form action="#" role="form" class="panel-filter">
    <div class="panel panel-default">
        <div class="panel-heading">
            <h6 class="panel-title">Filter Data</h6>
            <div class="panel-icons-group"> <a href="#" data-panel="collapse" class="btn btn-link btn-icon"><i class="icon-arrow-up9"></i></a></div>
        </div>
        <div class="panel-body">
            <div class="form-group">
                <div class="row">
                    <div class="col-md-3">
                        <label><?= __("Periode Tahun") ?></label>
                        <?= $this->Form->input(null, array("default" => isset($this->request->query['ExamAcademicYear_start_year']) ? $this->request->query['ExamAcademicYear_start_year'] : '', "name" => "ExamAcademicYear.start_year", "div" => false, "label" => false, "class" => "form-control", 'maxlength' => 4, 'type' => 'number')) ?>
                    </div>
                    <div class="col-md-3">
                        <label><?= __("&nbsp;") ?></label>
                        <?= $this->Form->input(null, array("default" => isset($this->request->query['ExamAcademicYear_end_year']) ? $this->request->query['ExamAcademicYear_end_year'] : '', "name" => "ExamAcademicYear.end_year", "div" => false, "label" => false, "class" => "form-control", 'maxlength' => 4, 'type' => "number")) ?>
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
