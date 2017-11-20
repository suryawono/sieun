<div style="text-align: center">
    <div style="font-size:11px;font-weight: bold; font-family:Tahoma, Geneva, sans-serif;">
        Laporan Permohonan Ujian Susulan
    </div>
</div>
<br>
<table width="100%" class="table-data">
    <thead>
        <tr>
            <th width="50">No</th>
            <th><?= __("Tahun Ajaran") ?></th>
            <th><?= __("Semester") ?></th>
            <th><?= __("Kategori Ujian") ?></th>
            <th><?= __("Mata Kuliah") ?></th>
            <th><?= __("NPM") ?></th>
            <th><?= __("Nama Mahasiswa") ?></th>
            <th><?= __("Alasan Tidak Hadir") ?></th>
            <th><?= __("Status") ?></th>
            <th><?= __("Alasan Disetujui/Ditolak") ?></th>
        </tr>
    </thead>
    <tbody>
        <?php
        $i = 1;
        if (empty($data['rows'])) {
            ?>
            <tr>
                <td class = "text-center" colspan ="6">Tidak Ada Data</td>
            </tr>
            <?php
        } else {
            foreach ($data['rows'] as $item) {
                ?>
                <tr>
                    <td class="text-center"><?= $i ?></td>
                    <td><?= $item['ExamAcademicYear']['periode'] ?></td>
                    <td><?= $item['ExamAcademicCategory']['name'] ?></td>
                    <td><?= $item['ExamCategory']['code'] ?></td>
                    <td><?= $item['Course']['full_label'] ?></td>
                    <td><?= $item['ExamMakeup']['npm'] ?></td>
                    <td><?= $item['ExamMakeup']['name'] ?></td>
                    <td><?= $item['ExamMakeup']['alasan'] ?></td>
                    <td><?= $item['ExamMakeupStatus']['name'] ?></td>
                    <td><?= $item['ExamMakeup']['proses_keterangan'] ?></td>
                </tr>
                <?php
                $i++;
            }
        }
        ?>
    </tbody>
</table>