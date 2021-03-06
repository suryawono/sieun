<?php
echo $this->element(_TEMPLATE_DIR . "/{$template}/filter/exam");
?>
<div class="panel panel-default">
    <div class="panel-body">
        <div class="block-inner text-danger">
            <h6 class="heading-hr"><?= __("Jadwal Ujian") ?>
                <div class="pull-right">
                    <button class="btn btn-xs btn-default" type="button" onclick="exp('print', '<?php echo Router::url("index/print?" . $_SERVER['QUERY_STRING'], true) ?>')">
                        <i class="icon-print2"></i> 
                        <?= __("Cetak") ?>
                    </button>&nbsp;
                    <?= $this->element(_TEMPLATE_DIR . "/{$template}/roleaccess/delete") ?>
                    <?= $this->element(_TEMPLATE_DIR . "/{$template}/roleaccess/add") ?>
                </div>
                <small class="display-block"><?= _APP_CORPORATE_FULL ?></small>
            </h6>
        </div>
        <div class="table-responsive pre-scrollable stn-table">
            <form id="checkboxForm" method="post" name="checkboxForm" action="<?php echo Router::url('/' . $this->params['prefix'] . '/' . $this->params['controller'] . '/multiple_delete', true); ?>">
                <table width="100%" class="table table-hover table-bordered">
                    <thead>
                        <tr>
                            <th width="50" rowspan="2"><input type="checkbox" class="styled checkall"/></th>
                            <th width="50" rowspan="2">No</th>
                            <th rowspan="2"><?= __("Tahun Ajaran") ?></th>
                            <th rowspan="2"><?= __("Kategori Akademik Ujian") ?></th>
                            <th rowspan="2"><?= __("Semester") ?></th>
                            <th rowspan="2"><?= __("Tipe Ujian") ?></th>
                            <th rowspan="2"><?= __("Kode/Mata Kuliah") ?></th>
                            <th colspan="2"><?= __("Jadwal Ujian") ?></th>
                            <th width="50" rowspan="2"><?= __("Aksi") ?></th>
                        </tr>
                        <tr>
                            <th><?= __("Tanggal") ?></th>
                            <th><?= __("Periode Jam") ?></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $limit = intval(isset($this->params['named']['limit']) ? $this->params['named']['limit'] : 10);
                        $page = intval(isset($this->params['named']['page']) ? $this->params['named']['page'] : 1);
                        $i = ($limit * $page) - ($limit - 1);
                        if (empty($data['rows'])) {
                            ?>
                            <tr>
                                <td class = "text-center" colspan ="10">Tidak Ada Data</td>
                            </tr>
                            <?php
                        } else {
                            foreach ($data['rows'] as $item) {
                                ?>
                                <tr id="row-<?= $i ?>" class="removeRow<?php echo $item[Inflector::classify($this->params['controller'])]['id']; ?>">
                                    <td class="text-center"><input type="checkbox" name="data[<?php echo Inflector::classify($this->params['controller']) ?>][checkbox][]" value="<?php echo $item[Inflector::classify($this->params['controller'])]['id']; ?>"  id="checkBoxRow" class="styled checkboxDeleteRow" /></td>
                                    <td class="text-center"><?= $i ?></td>
                                    <td class="text-center"><?= $item['ExamAcademicYear']['periode'] ?></td>
                                    <td class="text-center"><?= $item['ExamAcademicCategory']['name'] ?></td>
                                    <td class="text-center"><?= $item['Semester']['name'] ?></td>
                                    <td class="text-center"><?= $item['ExamCategory']['name'] ?></td>
                                    <td class="text-center"><?= $item['Course']['full_label'] ?></td>
                                    <td class="text-center"><?= $this->Html->cvtTanggal($item['Exam']['exam_date']) ?></td>
                                    <td class="text-center"><?= $this->Html->cvtJam($item['Exam']['start_time']) . " - " . $this->Html->cvtJam($item['Exam']['end_time']) ?></td>
                                    <td class="text-center">
                                        <?= $this->element(_TEMPLATE_DIR . "/{$template}/roleaccess/edit", ["editUrl" => Router::url("/admin/{$this->params['controller']}/edit/{$item[Inflector::classify($this->params['controller'])]['id']}")]) ?>
                                    </td>
                                </tr>
                                <?php
                                $i++;
                            }
                        }
                        ?>
                    </tbody>
                </table>
            </form>
        </div>
    </div>
    <?php echo $this->element(_TEMPLATE_DIR . "/{$template}/pagination") ?>
</div>

