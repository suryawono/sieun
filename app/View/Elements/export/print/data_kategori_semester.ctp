<div style="text-align: center">
    <div style="font-size:11px;font-weight: bold; font-family:Tahoma, Geneva, sans-serif;">
        <?= $pageInfo["titlePage"] ?>
    </div>
</div>
<br>
<table width="100%" class="table-data">
    <thead>
        <tr>
            <th width="50">No</th>
            <th><?= __("Kode") ?></th>
            <th><?= __("Nama Semester") ?></th>
            <th width="50"><?= __("Order") ?></th>
        </tr>
    </thead>
    <tbody>
        <?php
        $i = 1;
        if (empty($data['rows'])) {
            ?>
            <tr>
                <td class = "text-center" colspan ="3">Tidak Ada Data</td>
            </tr>
            <?php
        } else {
            foreach ($data['rows'] as $item) {
                ?>
                <tr>
                    <td class="text-center"><?= $i ?></td>
                    <td><?= $item['ExamAcademicCategory']['code'] ?></td>
                    <td><?= $item['ExamAcademicCategory']['name'] ?></td>
                    <td><?= $item['ExamAcademicCategory']['order'] ?></td>
                </tr>
                <?php
                $i++;
            }
        }
        ?>
    </tbody>
</table>