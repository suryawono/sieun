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
                        <label><?= __("Tahun Ajaran") ?></label>
                        <?= $this->Form->input(null, array("options" => $examAcademicYears, "default" => isset($this->request->query['select_ExamMakeup_exam_academic_year_id']) ? $this->request->query['select_ExamMakeup_exam_academic_year_id'] : '', "name" => "select.ExamMakeup.exam_academic_year_id", "div" => false, "label" => false, "class" => "select-full", "placeholder" => "-Semua-", "empty" => "")) ?>
                    </div>
                    <div class="col-md-6">
                        <label><?= __("Semester") ?></label>
                        <?= $this->Form->input(null, array("options" => $examAcademicCategories, "default" => isset($this->request->query['select_ExamMakeup_exam_academic_category_id']) ? $this->request->query['select_ExamMakeup_exam_academic_category_id'] : '', "name" => "select.ExamMakeup.exam_academic_category_id", "div" => false, "label" => false, "class" => "select-full", "placeholder" => "-Semua-", "empty" => "")) ?>
                    </div>
                </div>
            </div>
            <div class="form-group">
                <div class="row">
                    <div class="col-md-6">
                        <label><?= __("Kategori Ujian") ?></label>
                        <?= $this->Form->input(null, array("options" => $examCategories, "default" => isset($this->request->query['select_ExamMakeup_exam_category_id']) ? $this->request->query['select_ExamMakeup_exam_category_id'] : '', "name" => "select.ExamMakeup.exam_category_id", "div" => false, "label" => false, "class" => "select-full", "placeholder" => "-Semua-", "empty" => "")) ?>
                    </div>
                    <div class="col-md-6">
                        <label><?= __("Mata Kuliah") ?></label>
                        <?= $this->Form->input(null, array("options" => $courses, "default" => isset($this->request->query['select_ExamMakeup_course_id']) ? $this->request->query['select_ExamMakeup_course_id'] : '', "name" => "select.ExamMakeup.course_id", "div" => false, "label" => false, "class" => "select-full", "placeholder" => "-Semua-", "empty" => "")) ?>
                    </div>
                </div>
            </div>
            <div class="form-group">
                <div class="row">
                    <div class="col-md-6">
                        <label><?= __("NPM") ?></label>
                        <?= $this->Form->input(null, array("default" => isset($this->request->query['ExamMakeup_npm']) ? $this->request->query['ExamMakeup_npm'] : '', "name" => "ExamMakeup.npm", "div" => false, "label" => false, "class" => "form-control tip")) ?>
                    </div>
                    <div class="col-md-6">
                        <label><?= __("Nama Mahasiswa") ?></label>
                        <?= $this->Form->input(null, array("default" => isset($this->request->query['ExamMakeup_name']) ? $this->request->query['ExamMakeup_name'] : '', "name" => "ExamMakeup.name", "div" => false, "label" => false, "class" => "form-control tip")) ?>
                    </div>
                </div>
            </div>
            <div class="form-group">
                <div class="row">
                    <div class="col-md-6">
                        <label><?= __("Status") ?></label>
                        <?= $this->Form->input(null, array("options" => $examMakeupStatuses, "default" => isset($this->request->query['select_ExamMakeup_exam_makeup_status_id']) ? $this->request->query['select_ExamMakeup_exam_makeup_status_id'] : '', "name" => "select.ExamMakeup.exam_makeup_status_id", "div" => false, "label" => false, "class" => "select-full", "placeholder" => "-Semua-", "empty" => "")) ?>
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
