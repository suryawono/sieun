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
            <th><?= __("Unique Name") ?></th>
            <th><?= __("Name") ?></th>
            <th width="50"><?= __("Order") ?></th>
        </tr>
    </thead>
    <tbody>
        <?php
        $i = 1;
        if (empty($data['rows'])) {
            ?>
            <tr>
                <td class = "text-center" colspan ="4">Tidak Ada Data</td>
            </tr>
            <?php
        } else {
            foreach ($data['rows'] as $item) {
                ?>
                <tr>
                    <td class="text-center"><?= $i ?></td>
                    <td><?= $item['ExamCategory']['uniq_name'] ?></td>
                    <td><?= $item['ExamCategory']['name'] ?></td>
                    <td><?= $item['ExamCategory']['order'] ?></td>
                </tr>
                <?php
                $i++;
            }
        }
        ?>
    </tbody>
</table>