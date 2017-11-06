<?php

App::uses('AppController', 'Controller');

class FoulsController extends AppController {

    var $name = "Fouls";
    var $disabledAction = array(
    );
    var $contain = [
        "Pengawas" => [
            "Biodata",
        ],
        "FoulType",
        "Course",
        "ExamCategory",
        "ExamAcademicYear",
        "ExamAcademicCategory",
    ];

    function beforeFilter() {
        parent::beforeFilter();
        $this->_setPageInfo("admin_index", "Data Pelanggaran");
        $this->_setPageInfo("admin_add", "");
        $this->_setPageInfo("admin_edit", "");
    }

    function _options() {
        $this->set("foulTypes", $this->Foul->FoulType->find("list", ["fields" => ["FoulType.id", "FoulType.name"]]));
        $this->set("courses", $this->Foul->Course->getList());
        $this->set("examCategories", $this->Foul->ExamCategory->getList());
        $this->set("examAcademicYears", $this->Foul->ExamAcademicYear->getList());
        $this->set("examAcademicCategories", $this->Foul->ExamAcademicCategory->getList());
        $this->set("accounts", ClassRegistry::init("Account")->getListWithFullname());
    }

    function beforeRender() {
        $this->_options();
        parent::beforeRender();
    }

    function admin_index() {
        $this->_activePrint(func_get_args(), "data_pelanggaran_ujian");
        parent::admin_index();
    }

    function admin_import_excel() {
        if ($this->request->is("post")) {
            $this->{ Inflector::classify($this->name) }->set($this->data);
            if ($this->{ Inflector::classify($this->name) }->saveAll($this->{ Inflector::classify($this->name) }->data, array('validate' => 'only', "deep" => true))) {

                $dataExcel = xlsToArray($this->Foul->data["Foul"]["excel"]["tmp_name"]);
                $countNewData = 0;
                if ($dataExcel != false) {
                    foreach ($dataExcel as $i => $rowData) {
                        if ($i < 4) {
                            continue;
                        }
                        $tahunAjaran = $rowData[1];
                        $semester = $rowData[2];
                        $kategoriUjian = $rowData[3];
                        $mataKuliah = $rowData[4];
                        $npm = $rowData[5];
                        $namaMahasiswa = $rowData[6];
                        $pengawas = $rowData[7];
                        $jenisPelanggaran = $rowData[8];
                        $tanggalUjian = $rowData[9];
                        $keterangan = $rowData[10];
                        if (!empty($courseCode)) {
                            $tuple = $this->Foul->find("first", [
                                "conditions" => [
                                    "Course.code" => $courseCode,
                                ],
                                "recursive" => -1
                            ]);
                            if (empty($tuple)) {
                                $this->{ Inflector::classify($this->name) }->saveAll([
                                    "Course" => [
                                        "code" => $courseCode,
                                        "name" => $courseName,
                                    ]
                                ]);
                                $countNewData++;
                            } else {
                                $this->{ Inflector::classify($this->name) }->saveAll([
                                    "Course" => [
                                        "id" => $tuple["Course"]["id"],
                                        "name" => $courseName,
                                    ]
                                ]);
                            }
                        }
                    }
                    $this->Session->setFlash(__("Data berhasil diperbaharui. $countNewData data baru ditambahkan"), 'default', array(), 'success');
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
            "Pengawas",
            "Jenis Pelanggaran",
            "Tanggal Ujian",
            "Keterangan",
        ];
        $excelData = [];
        foreach ($rows as $n => $item) {
            $excelData[] = [
                $n + 1,
                $item["ExamAcademicYear"]["periode"],
                $item["ExamAcademicCategory"]["name"],
                $item["ExamCategory"]["uniq_name"],
                $item["Course"]["full_label"],
                $item["Foul"]["npm"],
                $item["Foul"]["name"],
                $item["Pengawas"]["Biodata"]["full_name"],
                $item["FoulType"]["name"],
                $item["Foul"]["d"],
                $item["Foul"]["keterangan"],
            ];
        }
        $this->set(compact("titleRow", "excelData"));
    }

}
