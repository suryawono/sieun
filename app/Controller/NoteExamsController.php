<?php

App::uses('AppController', 'Controller');

class NoteExamsController extends AppController {

    var $name = "NoteExams";
    var $disabledAction=array(
    );
    var $contain=[
        "Pengawas"=>[
            "Biodata",
        ],
        "Course",
        "ExamCategory",
        "ExamAcademicYear",
        "ExamAcademicCategory",
    ];
    
    function beforeFilter() {
        parent::beforeFilter();
        $this->_setPageInfo("admin_index", "Catatan Pengawas");
        $this->_setPageInfo("admin_add", "");
        $this->_setPageInfo("admin_edit", "");
    }
    
    function _options() {
        $this->set("courses", $this->NoteExam->Course->getList());
        $this->set("examCategories", $this->{ Inflector::classify($this->name) }->ExamCategory->getList());
        $this->set("examAcademicYears", $this->{ Inflector::classify($this->name) }->ExamAcademicYear->getList());
        $this->set("examAcademicCategories", $this->{ Inflector::classify($this->name) }->ExamAcademicCategory->getList());
        $this->set("accounts", ClassRegistry::init("Account")->getListWithFullname());
    }

    function beforeRender() {
        $this->_options();
        parent::beforeRender();
    }
    
    function admin_index() {
        $this->_activePrint(func_get_args(), "laporan_catatan_pengawas");
        parent::admin_index();
    }
    
    function admin_import_excel() {
        if ($this->request->is("post")) {
            $this->{ Inflector::classify($this->name) }->set($this->data);
            if ($this->{ Inflector::classify($this->name) }->saveAll($this->{ Inflector::classify($this->name) }->data, array('validate' => 'only', "deep" => true))) {

                $dataExcel = xlsToArray($this->NoteExam->data["NoteExam"]["excel"]["tmp_name"]);
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
                        $pengawas = $rowData[5];
                        $tanggalUjian = date("Y-m-d", strtotime($rowData[6]));
                        $keterangan = $rowData[7];

                        $pengawasUIDs = explode("-", $pengawas);
                        if (!empty($pengawasUIDs)) {
                            $pengawasUID = trim($pengawasUIDs[0]);
                        } else {
                            $pengawasUID = $pengawas;
                        }

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
                            "pengawas_id" => $pengawasUID,
                            "exam_category_id" => $kategoriUjian,
                            "exam_academic_year_id" => $tahunAjaranUID,
                            "exam_academic_category_id" => $semester,
                        ];

                        $foundDynamicIds = [];

                        $searchRequiredDynamicIds = $this->_searchRequiredDynamicId($requiredDynamicIds, $foundDynamicIds);
                        if (!$searchRequiredDynamicIds["allFound"]) {
                            $countFailData++;
                            $failDataLabel .= "- Data no {$rowData[0]} error. " . $searchRequiredDynamicIds["warningLabel"] . "<br/>";
                            continue;
                        }
                        //*jenis pelanggaran
                        //end of lookup id

                        if (!empty($foundDynamicIds)) {
                            $tuple = $this->NoteExam->find("first", [
                                "conditions" => [
                                    $foundDynamicIds,
                                ],
                                "recursive" => -1
                            ]);
                            if (empty($tuple)) {
                                $this->{ Inflector::classify($this->name) }->saveAll([
                                    "NoteExam" => am([
                                        "d" => $tanggalUjian,
                                        "keterangan" => $keterangan,
                                            ], $foundDynamicIds),
                                ]);
                                $countNewData++;
                            } else {
                                $countUpdate++;
                                $this->{ Inflector::classify($this->name) }->saveAll([
                                    "NoteExam" => [
                                        "id" => $tuple["NoteExam"]["id"],
                                        "d" => $tanggalUjian,
                                        "keterangan" => $keterangan,
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
            "Pengawas",
            "Tanggal Ujian",
            "Keterangan",
        ];
        $excelData = [];
        foreach ($rows as $n => $item) {
            $excelData[] = [
                $n + 1,
                $item["ExamAcademicYear"]["periode"],
                $item["ExamAcademicCategory"]["name"],
                $item["ExamCategory"]["code"],
                $item["Course"]["full_label"],
                $item["Pengawas"]["Biodata"]["full_name"],
                $item["NoteExam"]["d"],
                $item["NoteExam"]["keterangan"],
            ];
        }
        $this->set(compact("titleRow", "excelData"));
    }
}
