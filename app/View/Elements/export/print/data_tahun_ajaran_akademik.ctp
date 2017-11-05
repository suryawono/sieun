<div style="text-align: center">
    <div style="font-size:11px;font-weight: bold; font-family:Tahoma, Geneva, sans-serif;">
        Daftar Mata Kuliah
    </div>
</div>
<br>
<table width="100%" class="table-data">
    <thead>
        <tr>
            <th width="50">No</th>
            <th><?= __("Tahun Ajaran") ?></th>
        </tr>
    </thead>
    <tbody>
        <?php
        $i = 1;
        if (empty($data['rows'])) {
            ?>
            <tr>
                <td class = "text-center" colspan ="2">Tidak Ada Data</td>
            </tr>
            <?php
        } else {
            foreach ($data['rows'] as $item) {
                ?>
                <tr>
                    <td class="text-center"><?= $i ?></td>
                    <td class="text-center"><?= $item['ExamAcademicYear']['periode'] ?></td>
                </tr>
                <?php
                $i++;
            }
        }
        ?>
    </tbody>
</table>