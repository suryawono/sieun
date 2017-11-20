<?php

App::uses('AppController', 'Controller');

class ExamAcademicCategoriesController extends AppController {

    var $name = "ExamAcademicCategories";
    var $disabledAction = array(
    );
    var $contain = [
    ];

    function beforeFilter() {
        parent::beforeFilter();
        $this->_setPageInfo("admin_index", "Kategori Semester");
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
        $this->_activePrint(func_get_args(), "data_kategori_semester");
        parent::admin_index();
    }

    function _excelData($rows) {
        $titleRow = [
            "No",
            "Kode",
            "Nama Kategori Semester",
            "Order",
        ];
        $excelData = [];
        foreach ($rows as $n => $item) {
            $excelData[] = [
                $n + 1,
                $item["ExamAcademicCategory"]["code"],
                $item["ExamAcademicCategory"]["name"],
                $item["ExamAcademicCategory"]["order"],
            ];
        }
        $this->set(compact("titleRow", "excelData"));
    }

    function admin_import_excel() {
        if ($this->request->is("post")) {
            $this->{ Inflector::classify($this->name) }->set($this->data);
            if ($this->{ Inflector::classify($this->name) }->saveAll($this->{ Inflector::classify($this->name) }->data, array('validate' => 'only', "deep" => true))) {

                $courseExcel = xlsToArray($this->ExamAcademicCategory->data["ExamAcademicCategory"]["excel"]["tmp_name"]);
                $countNewData = 0;
                if ($courseExcel != false) {
                    foreach ($courseExcel as $i => $rowData) {
                        if ($i < 4) {
                            continue;
                        }
                        $examAcademicCode = $rowData[1];
                        $examAcademicName = $rowData[2];
                        $examAcademicOrder = $rowData[3];
                        if (!empty($examAcademicCode)) {
                            $tuple = $this->ExamAcademicCategory->find("first", [
                                "conditions" => [
                                    "ExamAcademicCategory.code" => $examAcademicCode,
                                ],
                                "recursive" => -1
                            ]);
                            if (empty($tuple)) {
                                $this->{ Inflector::classify($this->name) }->saveAll([
                                    "ExamAcademicCategory" => [
                                        "code" => $examAcademicCode,
                                        "name" => $examAcademicName,
                                        "order" => $examAcademicOrder,
                                    ]
                                ]);
                                $countNewData++;
                            } else {
                                $this->{ Inflector::classify($this->name) }->saveAll([
                                    "ExamAcademicCategory" => [
                                        "id" => $tuple["ExamAcademicCategory"]["id"],
                                        "name" => $examAcademicName,
                                        "order" => $examAcademicOrder,
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
