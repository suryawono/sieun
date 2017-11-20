<div style="text-align: center">
    <div style="font-size:11px;font-weight: bold; font-family:Tahoma, Geneva, sans-serif;">
        Laporan Per Mahasiswa
    </div>
</div>
<br> 
<?php
if ($data["render"]) {
    ?>
    <div class="text-success text-center"><h4>NPM : <?= $this->request->query["npm"] ?></h4></div>
    <hr/>
    <div ><h4>Data Pelanggaran Ujian</h4></div> 
    <div class="table-responsive pre-scrollable stn-table">
        <table width="100%" class="table table-hover table-bordered">
            <thead>
                <tr>
                    <th width="50">No</th>
                    <th><?= __("Tahun Ajaran") ?></th>
                    <th><?= __("Semester") ?></th>
                    <th><?= __("Kategori Ujian") ?></th>
                    <th><?= __("Mata Kuliah") ?></th>
                    <th><?= __("NPM") ?></th>
                    <th><?= __("Nama Mahasiswa") ?></th>
                    <th><?= __("Pengawas") ?></th>
                    <th><?= __("Jenis Pelanggaran") ?></th>
                    <th><?= __("Tanggal Ujian") ?></th>
                    <th><?= __("Keterangan") ?></th>
                </tr>
            </thead>
            <tbody>
                <?php
                $i = 1;
                if (empty($data['fouls'])) {
                    ?>
                    <tr>
                        <td class = "text-center" colspan ="11">Tidak Ada Data</td>
                    </tr>
                    <?php
                } else {
                    foreach ($data['fouls'] as $item) {
                        ?>
                        <tr>
                            <td class="text-center"><?= $i ?></td>
                            <td><?= $item['ExamAcademicYear']['periode'] ?></td>
                            <td><?= $item['ExamAcademicCategory']['name'] ?></td>
                            <td><?= $item['ExamCategory']['code'] ?></td>
                            <td><?= $item['Course']['full_label'] ?></td>
                            <td><?= $item['Foul']['npm'] ?></td>
                            <td><?= $item['Foul']['name'] ?></td>
                            <td><?= $item['Pengawas']["Biodata"]["full_name"] ?></td>
                            <td><?= $item['FoulType']['name'] ?></td>
                            <td><?= $this->Html->cvtTanggal($item['Foul']['d'], false) ?></td>
                            <td><?= $item['Foul']['keterangan'] ?></td>
                        </tr>
                        <?php
                        $i++;
                    }
                }
                ?>
            </tbody>
        </table>
    </div>
    <hr/>
    <div ><h4>Data Absen Ujian</h4></div> 
    <div class="table-responsive pre-scrollable stn-table">
        <table width="100%" class="table table-hover table-bordered">
            <thead>
                <tr>
                    <th width="50">No</th>
                    <th><?= __("Tahun Ajaran") ?></th>
                    <th><?= __("Semester") ?></th>
                    <th><?= __("Kategori Ujian") ?></th>
                    <th><?= __("Mata Kuliah") ?></th>
                    <th><?= __("NPM") ?></th>
                    <th><?= __("Nama") ?></th>
                    <th><?= __("Pengawas") ?></th>
                    <th><?= __("Tanggal Ujian") ?></th>
                    <th><?= __("Keterangan") ?></th>
                </tr>
            </thead>
            <tbody>
                <?php
                $i = 1;
                if (empty($data['exam_absents'])) {
                    ?>
                    <tr>
                        <td class = "text-center" colspan ="10">Tidak Ada Data</td>
                    </tr>
                    <?php
                } else {
                    foreach ($data['exam_absents'] as $item) {
                        ?>
                        <tr>
                            <td class="text-center"><?= $i ?></td>
                            <td><?= $item['ExamAcademicYear']['periode'] ?></td>
                            <td><?= $item['ExamAcademicCategory']['name'] ?></td>
                            <td><?= $item['ExamCategory']['code'] ?></td>
                            <td><?= $item['Course']['full_label'] ?></td>
                            <td><?= $item['ExamAbsent']['npm'] ?></td>
                            <td><?= $item['ExamAbsent']['name'] ?></td>
                            <td><?= $item['Pengawas']["Biodata"]["full_name"] ?></td>
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
    </div>
    <hr/>
    <div ><h4>Data Permohonan Ujian Susulan</h4></div> 
    <div class="table-responsive pre-scrollable stn-table">
        <table width="100%" class="table table-hover table-bordered">
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
                if (empty($data['exam_makeups'])) {
                    ?>
                    <tr>
                        <td class = "text-center" colspan ="10">Tidak Ada Data</td>
                    </tr>
                    <?php
                } else {
                    foreach ($data['exam_makeups'] as $item) {
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
    </div>
    <?php
} else {
    ?>
    <div class="text-warning"><h3>Tidak ada. Silahkan filter NPM.</h3></div>
    <?php
}
?>