<div style="text-align: center">
    <div style="font-size:11px;font-weight: bold; font-family:Tahoma, Geneva, sans-serif;">
        Laporan Absen Ujian
    </div>
</div>
<br>
<table width="100%" class="table-data">
    <thead>
        <tr>
            <th width="50">No</th>
            <th><?= __("NPM") ?></th>
            <th><?= __("Nama") ?></th>
            <th><?= __("Pengawas") ?></th>
            <th><?= __("Mata Kuliah") ?></th>
            <th><?= __("Tanggal Ujian") ?></th>
            <th><?= __("Keterangan") ?></th>
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
                <td class = "text-center" colspan ="7">Tidak Ada Data</td>
            </tr>
            <?php
        } else {
            foreach ($data['rows'] as $item) {
                ?>
                <tr>
                    <td class="text-center"><?= $i ?></td>
                    <td><?= $item['ExamAbsent']['npm'] ?></td>
                    <td><?= $item['ExamAbsent']['name'] ?></td>
                    <td><?= trim($item['Pengawas']["Biodata"]["full_name"] . "," . @$item['Pengawas2']["Biodata"]["full_name"], ",") ?></td>
                    <td><?= $item['Course']['name'] ?></td>
                    <td><?= $this->Html->cvtTanggal($item['ExamAbsent']['d'], false) ?></td>
                    <td><?= $item['ExamAbsent']['keterangan'] ?></td>
                </tr>
                <?php
                $i++;
            }
        }
        ?>
    </tbody>
</table>