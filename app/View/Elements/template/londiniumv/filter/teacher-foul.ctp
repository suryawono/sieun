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
                        <?= $this->Form->input(null, array("options" => $examAcademicYears, "default" => isset($this->request->query['select_TeacherFoul_exam_academic_year_id']) ? $this->request->query['select_TeacherFoul_exam_academic_year_id'] : '', "name" => "select.TeacherFoul.exam_academic_year_id", "div" => false, "label" => false, "class" => "select-full", "placeholder" => "-Semua-", "empty" => "")) ?>
                    </div>
                    <div class="col-md-6">
                        <label><?= __("Semester") ?></label>
                        <?= $this->Form->input(null, array("options" => $examAcademicCategories, "default" => isset($this->request->query['select_TeacherFoul_exam_academic_category_id']) ? $this->request->query['select_TeacherFoul_exam_academic_category_id'] : '', "name" => "select.TeacherFoul.exam_academic_category_id", "div" => false, "label" => false, "class" => "select-full", "placeholder" => "-Semua-", "empty" => "")) ?>
                    </div>
                </div>
            </div>
            <div class="form-group">
                <div class="row">
                    <div class="col-md-6">
                        <label><?= __("Kategori Ujian") ?></label>
                        <?= $this->Form->input(null, array("options" => $examCategories, "default" => isset($this->request->query['select_TeacherFoul_exam_category_id']) ? $this->request->query['select_TeacherFoul_exam_category_id'] : '', "name" => "select.TeacherFoul.exam_category_id", "div" => false, "label" => false, "class" => "select-full", "placeholder" => "-Semua-", "empty" => "")) ?>
                    </div>
                    <div class="col-md-6">
                        <label><?= __("Mata Kuliah") ?></label>
                        <?= $this->Form->input(null, array("options" => $courses, "default" => isset($this->request->query['select_TeacherFoul_course_id']) ? $this->request->query['select_TeacherFoul_course_id'] : '', "name" => "select.TeacherFoul.course_id", "div" => false, "label" => false, "class" => "select-full", "placeholder" => "-Semua-", "empty" => "")) ?>
                    </div>
                </div>
            </div>
            <div class="form-group">
                <div class="row">
                    <div class="col-md-6">
                        <label><?= __("Pengawas") ?></label>
                        <?= $this->Form->input(null, array("options" => $accounts, "default" => isset($this->request->query['select_TeacherFoul_pengawas_id']) ? $this->request->query['select_TeacherFoul_pengawas_id'] : '', "name" => "select.TeacherFoul.pengawas_id", "div" => false, "label" => false, "class" => "select-full", "placeholder" => "-Semua-", "empty" => "")) ?>
                    </div>

                    <div class="col-md-6">
                        <label><?= __("Jenis Pelanggaran") ?></label>
                        <?= $this->Form->input(null, array("options" => $foulTypes, "default" => isset($this->request->query['select_TeacherFoul_foul_type_id']) ? $this->request->query['select_TeacherFoul_foul_type_id'] : '', "name" => "select.TeacherFoul.foul_type_id", "div" => false, "label" => false, "class" => "select-full", "placeholder" => "-Semua-", "empty" => "")) ?>
                    </div>
                </div>
            </div>
            <div class="form-group">
                <div class="row">
                    <div class="col-md-3">
                        <label><?= __("Periode Ujian") ?></label>
                        <?= $this->Form->input(null, array("default" => isset($this->request->query['awal_TeacherFoul_d']) ? $this->request->query['awal_TeacherFoul_d'] : '', "name" => "awal.TeacherFoul.d", "div" => false, "label" => false, "class" => "form-control datepicker", "placeholder" => "Awal Periode")) ?>
                    </div>
                    <div class="col-md-3">
                        <label>&nbsp;</label>
                        <?= $this->Form->input(null, array("default" => isset($this->request->query['akhir_TeacherFoul_d']) ? $this->request->query['akhir_TeacherFoul_d'] : '', "name" => "akhir.TeacherFoul.d", "div" => false, "label" => false, "class" => "form-control datepicker", "placeholder" => "Awal Periode")) ?>
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
