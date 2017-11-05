<?php

App::uses('AppController', 'Controller');

class CoursesController extends AppController {

    var $name = "Courses";
    var $disabledAction = array(
    );
    var $order = "Course.code asc";

    function beforeFilter() {
        parent::beforeFilter();
        $this->_setPageInfo("admin_index", "Data Mata Kuliah");
        $this->_setPageInfo("admin_add", "");
        $this->_setPageInfo("admin_edit", "");
    }

    function admin_index() {
        $this->_activePrint(func_get_args(), "data_mata_kuliah");
        parent::admin_index();
    }

    function admin_import_excel() {
        if ($this->request->is("post")) {
            $this->{ Inflector::classify($this->name) }->set($this->data);
            if ($this->{ Inflector::classify($this->name) }->saveAll($this->{ Inflector::classify($this->name) }->data, array('validate' => 'only', "deep" => true))) {

                $courseExcel = xlsToArray($this->Course->data["Course"]["excel"]["tmp_name"]);
                $countNewData=0;
                if ($courseExcel != false) {
                    foreach ($courseExcel as $i => $rowData) {
                        if ($i < 4) {
                            continue;
                        }
                        $courseCode = $rowData[1];
                        $courseName = $rowData[2];
                        if (!empty($courseCode)) {
                            $tuple = $this->Course->find("first", [
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
                }
                $this->Session->setFlash(__("Data berhasil diperbaharui. $countNewData data baru ditambahkan"), 'default', array(), 'success');
//                $this->redirect(array('action' => 'admin_index'));
            } else {
                $this->validationErrors = $this->{ Inflector::classify($this->name) }->validationErrors;
                $this->Session->setFlash(__("Harap mengecek kembali kesalahan dibawah."), 'default', array(), 'danger');
            }
        }
    }

    function _excelData($rows) {
        $titleRow = [
            "No",
            "Kode Mata Kuliah",
            "Nama Mata Kuliah",
        ];
        $excelData = [];
        foreach ($rows as $n => $item) {
            $excelData[] = [
                $n + 1,
                $item["Course"]["code"],
                $item["Course"]["name"],
            ];
        }
        $this->set(compact("titleRow", "excelData"));
    }

}
