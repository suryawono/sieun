<?php

App::uses('AppController', 'Controller');

class CoursesController extends AppController {

    var $name = "Courses";
    var $disabledAction = array(
    );
    var $order = "Course.code asc";

    function beforeFilter() {
        parent::beforeFilter();
        $this->_setPageInfo("admin_index", "");
        $this->_setPageInfo("admin_add", "");
        $this->_setPageInfo("admin_edit", "");
    }

    function admin_index() {
        $this->_activePrint(func_get_args(), "data_mata_kuliah");
        parent::admin_index();
    }

    function _excelData($rows) {
        $titleRow = [
            "No",
            "Kode Mata Kuliah",
            "Nama Mata Kuliah",
        ];
        $excelData=[];
        foreach ($rows as $n => $item) {
            $excelData[] = [
                $n+1,
                $item["Course"]["code"],
                $item["Course"]["name"],
            ];
        }
        $this->set(compact("titleRow", "excelData"));
    }

}
