<?php

App::uses('AppController', 'Controller');

class FoulTypesController extends AppController {

    var $name = "FoulTypes";
    var $disabledAction = array(
    );

    function beforeFilter() {
        parent::beforeFilter();
        $this->_setPageInfo("admin_index", "Data Jenis Pelanggaran");
        $this->_setPageInfo("admin_add", "");
        $this->_setPageInfo("admin_edit", "");
    }

    function admin_index() {
        $this->_activePrint(func_get_args(), "data_jenis_pelanggaran");
        parent::admin_index();
    }

    function _excelData($rows) {
        $titleRow = [
            "No",
            "Nama Jenis Pelanggaran",
        ];
        $excelData = [];
        foreach ($rows as $n => $item) {
            $excelData[] = [
                $n + 1,
                $item["FoulType"]["name"],
            ];
        }
        $this->set(compact("titleRow", "excelData"));
    }

    function admin_import_excel() {
        if ($this->request->is("post")) {
            $this->{ Inflector::classify($this->name) }->set($this->data);
            if ($this->{ Inflector::classify($this->name) }->saveAll($this->{ Inflector::classify($this->name) }->data, array('validate' => 'only', "deep" => true))) {
                $courseExcel = xlsToArray($this->FoulType->data["FoulType"]["excel"]["tmp_name"]);
                $countNewData = 0;
                if ($courseExcel != false) {
                    foreach ($courseExcel as $i => $rowData) {
                        if ($i < 4) {
                            continue;
                        }
                        $foulTypeName = $rowData[1];
                        if (!empty($foulTypeName)) {
                            $tuple = $this->FoulType->find("first", [
                                "conditions" => [
                                    "FoulType.name" => $foulTypeName,
                                ],
                                "recursive" => -1
                            ]);
                            if (empty($tuple)) {
                                $this->{ Inflector::classify($this->name) }->saveAll([
                                    "FoulType" => [
                                        "name" => $foulTypeName,
                                    ]
                                ]);
                                $countNewData++;
                            } else {
                                $this->{ Inflector::classify($this->name) }->saveAll([
                                    "FoulType" => [
                                        "id" => $tuple["FoulType"]["id"],
                                        "name" => $foulTypeName,
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

}
