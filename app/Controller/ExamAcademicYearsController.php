<?php

App::uses('AppController', 'Controller');

class ExamAcademicYearsController extends AppController {

    var $name = "ExamAcademicYears";
    var $disabledAction = array(
    );
    var $contain = [
    ];
    var $order = "ExamAcademicYear.start_year desc";

    function beforeFilter() {
        parent::beforeFilter();
        $this->_setPageInfo("admin_index", "Tahun Ajaran Akademik");
        $this->_setPageInfo("admin_add", "");
        $this->_setPageInfo("admin_edit", "");
    }

    function _options() {
        
    }

    function beforeRender() {
        $this->_options();
        parent::beforeRender();
    }

    function admin_index() {
        $this->_activePrint(func_get_args(), "data_tahun_ajaran_akademik");
        parent::admin_index();
    }

    function _excelData($rows) {
        $titleRow = [
            "No",
            "Kode",
            "Tahun Ajaran",
        ];
        $excelData = [];
        foreach ($rows as $n => $item) {
            $excelData[] = [
                $n + 1,
                $item["ExamAcademicYear"]["code"],
                $item["ExamAcademicYear"]["periode"],
            ];
        }
        $this->set(compact("titleRow", "excelData"));
    }

    function admin_import_excel() {
        if ($this->request->is("post")) {
            $this->{ Inflector::classify($this->name) }->set($this->data);
            if ($this->{ Inflector::classify($this->name) }->saveAll($this->{ Inflector::classify($this->name) }->data, array('validate' => 'only', "deep" => true))) {
                $courseExcel = xlsToArray($this->ExamAcademicYear->data["ExamAcademicYear"]["excel"]["tmp_name"]);
                $countNewData = 0;
                if ($courseExcel != false) {
                    foreach ($courseExcel as $i => $rowData) {
                        if ($i < 4) {
                            continue;
                        }
                        $examAcademicYearCode = $rowData[1];
                        $examAcademicYearPeriod = $rowData[2];
                        $explodedYear = explode("/", $examAcademicYearPeriod);
                        if (empty($explodedYear) or count($explodedYear) != 2) {
                            continue;
                        }
                        $startYear = $explodedYear[0];
                        $endYear = $explodedYear[1];
                        if (!empty($examAcademicYearCode)) {
                            $tuple = $this->ExamAcademicYear->find("first", [
                                "conditions" => [
                                    "ExamAcademicYear.code" => $examAcademicYearCode,
                                ],
                                "recursive" => -1
                            ]);
                            if (empty($tuple)) {
                                $this->{ Inflector::classify($this->name) }->saveAll([
                                    "ExamAcademicYear" => [
                                        "code" => $examAcademicYearCode,
                                        "start_year" => $startYear,
                                        "end_year" => $endYear,
                                    ]
                                ]);
                                $countNewData++;
                            } else {
                                $this->{ Inflector::classify($this->name) }->saveAll([
                                    "ExamAcademicYear" => [
                                        "id" => $tuple["ExamAcademicYear"]["id"],
                                        "start_year" => $startYear,
                                        "end_year" => $endYear,
                                    ]
                                ]);
                            }
                        }
                    }
                    $this->Session->setFlash(__("Data berhasil diperbaharui. $countNewData data baru ditambahkan"), 'default', array(), 'success');
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

}
