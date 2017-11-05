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
            "Tahun Ajaran",
        ];
        $excelData = [];
        foreach ($rows as $n => $item) {
            $excelData[] = [
                $n + 1,
                $item["ExamAcademicYear"]["periode"],
            ];
        }
        $this->set(compact("titleRow", "excelData"));
    }

}
