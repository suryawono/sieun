<div style="text-align: center">
    <div style="font-size:11px;font-weight: bold; font-family:Tahoma, Geneva, sans-serif;">
        Laporan Jadwal Ujian
    </div>
</div>
<br>
<table width="100%" class="table-data">
    <thead>
        <tr>
            <th width="50" rowspan="2">No</th>
            <th rowspan="2"><?= __("Tahun Ajaran") ?></th>
            <th rowspan="2"><?= __("Kategori Akademik Ujian") ?></th>
            <th rowspan="2"><?= __("Semester") ?></th>
            <th rowspan="2"><?= __("Tipe Ujian") ?></th>
            <th rowspan="2"><?= __("Kode/Mata Kuliah") ?></th>
            <th colspan="2"><?= __("Jadwal Ujian") ?></th>
        </tr>
        <tr>
            <th><?= __("Tanggal") ?></th>
            <th><?= __("Periode Jam") ?></th>
        </tr>
    </thead>
    <tbody>
        <?php
        $i = 1;
        if (empty($data['rows'])) {
            ?>
            <tr>
                <td class = "text-center" colspan ="7">Tidak Ada Data</td>
            </tr>
            <?php
        } else {
            foreach ($data['rows'] as $item) {
                ?>
                <tr id="row-<?= $i ?>" class="removeRow<?php echo $item[Inflector::classify($this->params['controller'])]['id']; ?>">
                    <td class="text-center"><?= $i ?></td>
                    <td class="text-center"><?= $item['ExamAcademicYear']['periode'] ?></td>
                    <td class="text-center"><?= $item['ExamAcademicCategory']['name'] ?></td>
                    <td class="text-center"><?= $item['Semester']['name'] ?></td>
                    <td class="text-center"><?= $item['ExamCategory']['name'] ?></td>
                    <td class="text-center"><?= $item['Course']['full_label'] ?></td>
                    <td class="text-center"><?= $this->Html->cvtTanggal($item['Exam']['exam_date']) ?></td>
                    <td class="text-center"><?= $this->Html->cvtJam($item['Exam']['start_time']) . " - " . $this->Html->cvtJam($item['Exam']['end_time']) ?></td>
                </tr>
                <?php
                $i++;
            }
        }
        ?>
    </tbody>
</table>