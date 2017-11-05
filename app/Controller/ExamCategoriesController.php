<?php

App::uses('AppController', 'Controller');

class ExamCategoriesController extends AppController {

    var $name = "ExamCategories";
    var $disabledAction = array(
    );
    var $contain = [
    ];

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
            "Unique Name",
            "Nama Kategori Ujian",
            "Order",
        ];
        $excelData = [];
        foreach ($rows as $n => $item) {
            $excelData[] = [
                $n + 1,
                $item["ExamCategory"]["uniq_name"],
                $item["ExamCategory"]["name"],
                $item["ExamCategory"]["order"],
            ];
        }
        $this->set(compact("titleRow", "excelData"));
    }

}
