<?php

App::uses('AppController', 'Controller');

class ExamMakeupsController extends AppController {

    var $name = "ExamMakeups";
    var $disabledAction = array(
    );
    var $contain = [
        "Course",
        "ExamMakeupStatus",
        "ExamCategory",
        "ExamAcademicYear",
        "ExamAcademicCategory",
    ];

    function beforeFilter() {
        parent::beforeFilter();
        $this->_setPageInfo("admin_index", "Data Permohonan Ujian Susulan");
        $this->_setPageInfo("admin_add", "");
        $this->_setPageInfo("admin_edit", "");
    }

    function _options() {
        $this->set("courses", $this->ExamMakeup->Course->getList());
        $this->set("examCategories", $this->ExamMakeup->ExamCategory->getList());
        $this->set("examAcademicYears", $this->ExamMakeup->ExamAcademicYear->getList());
        $this->set("examAcademicCategories", $this->ExamMakeup->ExamAcademicCategory->getList());
        $this->set("examMakeupStatuses", $this->ExamMakeup->ExamMakeupStatus->find("list", ["fields" => ["ExamMakeupStatus.id", "ExamMakeupStatus.name"]]));
    }

    function beforeRender() {
        $this->_options();
        parent::beforeRender();
    }

    function admin_change_status() {
        $this->autoRender = false;
        if ($this->request->is("PUT")) {
            $this->ExamMakeup->id = $this->request->data['id'];
            $this->ExamMakeup->save(array("ExamMakeup" => array("exam_makeup_status_id" => $this->request->data['status'])));
            $data = $this->ExamMakeup->find("first", array("conditions" => array("ExamMakeup.id" => $this->request->data['id']), "recursive" => 1));
            echo json_encode($this->_generateStatusCode(207, null, array("status_label" => $data['ExamMakeupStatus']['name'])));
        } else {
            echo json_encode($this->_generateStatusCode(400));
        }
    }

    function admin_index() {
        $this->_activePrint(func_get_args(), "laporan_permohonan_ujian_susulan");
        parent::admin_index();
    }

    function admin_import_excel() {
        if ($this->request->is("post")) {
            $this->{ Inflector::classify($this->name) }->set($this->data);
            if ($this->{ Inflector::classify($this->name) }->saveAll($this->{ Inflector::classify($this->name) }->data, array('validate' => 'only', "deep" => true))) {

                $dataExcel = xlsToArray($this->ExamMakeup->data["ExamMakeup"]["excel"]["tmp_name"]);
                $countNewData = 0;
                $countFailData = 0;
                $countUpdate = 0;
                $countData = 0;
                $failDataLabel = "";
                if ($dataExcel != false) {
                    foreach ($dataExcel as $i => $rowData) {
                        if ($i < 4) {
                            continue;
                        }
                        $countData++;
                        $tahunAjaran = $rowData[1];
                        $semester = $rowData[2];
                        $kategoriUjian = $rowData[3];
                        $mataKuliah = $rowData[4];
                        $npm = $rowData[5];
                        $namaMahasiswa = $rowData[6];
                        $alasan = $rowData[7];
                        $statusPermohonan = $rowData[8];
                        $prosesKeterangan = $rowData[9];

                        $courseUIDs = explode("-", $mataKuliah);
                        if (!empty($courseUIDs)) {
                            $courseUID = trim($courseUIDs[0]);
                        } else {
                            $courseUID = $mataKuliah;
                        }

                        $tahunAjaranUIDs = explode("/", $tahunAjaran);
                        if (count($tahunAjaranUIDs) >= 1) {
                            $tahunAjaranUID = $tahunAjaranUIDs[0];
                        } else {
                            $tahunAjaranUID = $tahunAjaran;
                        }
                        //start of lookup id for dynamic data

                        $requiredDynamicIds = [
                            "course_id" => $courseUID,
                            "exam_category_id" => $kategoriUjian,
                            "exam_academic_year_id" => $tahunAjaranUID,
                            "exam_academic_category_id" => $semester,
                            "exam_makeup_status_id" => $statusPermohonan,
                        ];

                        $foundDynamicIds = [];

                        $searchRequiredDynamicIds = $this->_searchRequiredDynamicId($requiredDynamicIds, $foundDynamicIds);
                        if (!$searchRequiredDynamicIds["allFound"]) {
                            $countFailData++;
                            $failDataLabel .= "- Data no {$rowData[0]} error. " . $searchRequiredDynamicIds["warningLabel"] . "<br/>";
                            continue;
                        }
                        //end of lookup id
                        $condsMakeup = array_flip(array_flip($foundDynamicIds));
                        unset($condsMakeup["exam_makeup_status_id"]);
                        if (!empty($foundDynamicIds)) {
                            $tuple = $this->ExamMakeup->find("first", [
                                "conditions" => [
                                    $condsMakeup,
                                    "ExamMakeup.npm" => $npm,
                                ],
                                "recursive" => -1
                            ]);
                            if (empty($tuple)) {
                                $this->{ Inflector::classify($this->name) }->saveAll([
                                    "ExamMakeup" => am([
                                        "npm" => $npm,
                                        "name" => $namaMahasiswa,
                                        "alasan" => $alasan,
                                        "proses_keterangan" => $prosesKeterangan,
                                            ], $foundDynamicIds),
                                ]);
                                $countNewData++;
                            } else {
                                $countUpdate++;
                                $this->{ Inflector::classify($this->name) }->saveAll([
                                    "ExamMakeup" => [
                                        "id" => $tuple["ExamMakeup"]["id"],
                                        "name" => $namaMahasiswa,
                                        "alasan" => $alasan,
                                        "proses_keterangan" => $prosesKeterangan,
                                        "exam_makeup_status_id"=>$foundDynamicIds["exam_makeup_status_id"],
                                    ]
                                ]);
                            }
                        }
                    }
                    if ($countFailData == 0 && $countUpdate == 0) {
                        $this->Session->setFlash(__("Data berhasil diperbaharui/disimpan. $countNewData data baru ditambahkan."), 'default', array(), 'success');
                    } else {
                        $this->Session->setFlash(__("Sebagian data berhasil diperbaharui/disimpan. $countData data diunggah. $countNewData data baru ditambahkan. $countUpdate data diperbaharui. $countFailData data yang gagal ditambahkan.<br/>" . $failDataLabel), 'default', array(), 'warning');
                    }
                    $this->redirect(array('action' => 'admin_index'));
                } else {
                    $this->Session->setFlash(__("Terjadi kesalahan dalam membaca file."), 'default', array(), 'danger');
                }
            } else {
                $this->validationErrors = $this->{ Inflector::classify($this->name) }->validationErrors;
                $this->Session->setFlash(__("Harap mengecek kembali kesalahan dibawah."), 'default', array(), 'danger');
            }
        }
    }

    function _excelData($rows) {
        $titleRow = [
            "No",
            "Tahun Ajaran",
            "Semester",
            "Kategori Ujian",
            "Mata Kuliah",
            "NPM",
            "Nama Mahasiswa",
            "Alasan Tidak Hadir",
            "Status",
            "Alasan Disetujui/Ditolak",
        ];
        $excelData = [];
        foreach ($rows as $n => $item) {
            $excelData[] = [
                $n + 1,
                $item["ExamAcademicYear"]["periode"],
                $item["ExamAcademicCategory"]["name"],
                $item["ExamCategory"]["code"],
                $item["Course"]["full_label"],
                $item["ExamMakeup"]["npm"],
                $item["ExamMakeup"]["name"],
                $item["ExamMakeup"]["alasan"],
                $item["ExamMakeupStatus"]["name"],
                $item["ExamMakeup"]["proses_keterangan"],
            ];
        }
        $this->set(compact("titleRow", "excelData"));
    }

}
