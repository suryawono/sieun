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
                        <?= $this->Form->input(null, array("default" => isset($this->request->query['select_Exam_course_id']) ? $this->request->query['select_Exam_course_id'] : '', "name" => "select.Exam.course_id", "div" => false, "label" => false, "class" => "select-full", 'empty' => "", 'placeholder' => "- Pilih Mata Kuliah -", 'options' => $courses)) ?>
                    </div>
                    <div class="col-md-6">
                        <label><?= __("Semester") ?></label>
                        <?= $this->Form->input(null, array("default" => isset($this->request->query['select_Exam_semester_id']) ? $this->request->query['select_Exam_semester_id'] : '', "name" => "select.Exam.semester_id", "div" => false, "label" => false, "class" => "select-full", 'empty' => '', 'placeholder' => '- Pilih Semester -', 'options' => $semesters)) ?>
                    </div>
                </div>
            </div>
            <div class="form-group">
                <div class="row">
                    <div class="col-md-6">
                        <label><?= __("Tahun Ajaran") ?></label>
                        <?= $this->Form->input(null, array("default" => isset($this->request->query['select_Exam_exam_academic_year_id']) ? $this->request->query['select_Exam_exam_academic_year_id'] : '', "name" => "select.Exam.exam_academic_year_id", "div" => false, "label" => false, "class" => "select-full", 'empty' => "", 'placeholder' => "- Pilih Tahun Ajaran -", 'options' => $examAcademicYears)) ?>
                    </div>
                    <div class="col-md-6">
                        <label><?= __("Kategori Akademik Ujian") ?></label>
                        <?= $this->Form->input(null, array("default" => isset($this->request->query['select_Exam_exam_academic_category_id']) ? $this->request->query['select_Exam_exam_academic_category_id'] : '', "name" => "select.Exam.exam_academic_category_id", "div" => false, "label" => false, "class" => "select-full", 'empty' => '', 'placeholder' => '- Pilih Kategori Akademik Ujian -', 'options' => $examAcademicCategories)) ?>
                    </div>
                </div>
            </div>
            <div class="form-group">
                <div class="row">
                    <div class="col-md-6">
                        <label><?= __("Tanggal Ujian") ?></label>
                        <?= $this->Form->input(null, array("default" => isset($this->request->query['Exam_exam_date']) ? $this->request->query['Exam_exam_date'] : '', "name" => "Exam.exam_date", "div" => false, "label" => false, "class" => "form-control datepicker")) ?>
                    </div>
                    <div class="col-md-3">
                        <label><?= __("Jam Mulai") ?></label>
                        <?= $this->Form->input(null, array("default" => isset($this->request->query['Exam_start_time']) ? $this->request->query['Exam_start_time'] : '', "name" => "Exam.start_time", "div" => false, "label" => false, "class" => "form-control timepicker")) ?>
                    </div>
                    <div class="col-md-3">
                        <label><?= __("Jam Selesai") ?></label>
                        <?= $this->Form->input(null, array("default" => isset($this->request->query['Exam_end_time']) ? $this->request->query['Exam_end_time'] : '', "name" => "Exam.end_time", "div" => false, "label" => false, "class" => "form-control timepicker")) ?>
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
