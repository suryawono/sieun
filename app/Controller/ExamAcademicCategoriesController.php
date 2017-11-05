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
            "Nama Kategori Semester",
            "Order",
        ];
        $excelData = [];
        foreach ($rows as $n => $item) {
            $excelData[] = [
                $n + 1,
                $item["ExamAcademicCategory"]["name"],
                $item["ExamAcademicCategory"]["order"],
            ];
        }
        $this->set(compact("titleRow", "excelData"));
    }

}
