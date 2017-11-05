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

}
