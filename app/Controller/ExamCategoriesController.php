<?php

App::uses('AppController', 'Controller');

class ExamCategoriesController extends AppController {

    var $name = "ExamCategories";
    var $disabledAction = array(
    );
    var $contain = [
    ];
    var $order="ExamCategory.order";

    function beforeFilter() {
        parent::beforeFilter();
        $this->_setPageInfo("admin_index", "Kategori Ujian");
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
        $this->_activePrint(func_get_args(), "data_kategori_ujian");
        parent::admin_index();
    }

    function _excelData($rows) {
        $titleRow = [
            "No",
            "Kode",
            "Nama Kategori Ujian",
            "Order",
        ];
        $excelData = [];
        foreach ($rows as $n => $item) {
            $excelData[] = [
                $n + 1,
                $item["ExamCategory"]["code"],
                $item["ExamCategory"]["name"],
                $item["ExamCategory"]["order"],
            ];
        }
        $this->set(compact("titleRow", "excelData"));
    }

    function admin_import_excel() {
        if ($this->request->is("post")) {
            $this->{ Inflector::classify($this->name) }->set($this->data);
            if ($this->{ Inflector::classify($this->name) }->saveAll($this->{ Inflector::classify($this->name) }->data, array('validate' => 'only', "deep" => true))) {

                $courseExcel = xlsToArray($this->ExamCategory->data["ExamCategory"]["excel"]["tmp_name"]);
                $countNewData = 0;
                if ($courseExcel != false) {
                    foreach ($courseExcel as $i => $rowData) {
                        if ($i < 4) {
                            continue;
                        }
                        $examCategoryCode = $rowData[1];
                        $examCategoryName = $rowData[2];
                        $examCategoryOrder = $rowData[3];
                        if (!empty($examCategoryCode)) {
                            $tuple = $this->ExamCategory->find("first", [
                                "conditions" => [
                                    "ExamCategory.code" => $examCategoryCode,
                                ],
                                "recursive" => -1
                            ]);
                            if (empty($tuple)) {
                                $this->{ Inflector::classify($this->name) }->saveAll([
                                    "ExamCategory" => [
                                        "code" => $examCategoryCode,
                                        "name" => $examCategoryName,
                                        "order" => $examCategoryOrder,
                                    ]
                                ]);
                                $countNewData++;
                            } else {
                                $this->{ Inflector::classify($this->name) }->saveAll([
                                    "ExamCategory" => [
                                        "id" => $tuple["ExamCategory"]["id"],
                                        "name" => $examCategoryName,
                                        "order" => $examCategoryOrder,
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
