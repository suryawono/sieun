<?php

App::uses('AppController', 'Controller');

class ExamAbsentsController extends AppController {

    var $name = "ExamAbsents";
    var $disabledAction = array(
    );
    var $contain = [
        "Pengawas" => [
            "Biodata",
        ],
        "Pengawas2" => [
            "Biodata",
        ],
        "Course",
    ];

    function beforeFilter() {
        parent::beforeFilter();
        $this->_setPageInfo("admin_index", "");
        $this->_setPageInfo("admin_add", "");
        $this->_setPageInfo("admin_edit", "");
    }

    function _options() {
        $this->set("courses", $this->ExamAbsent->Course->find("list", ["fields" => ["Course.id", "Course.name"]]));
        $this->set("accounts", ClassRegistry::init("Account")->getListWithFullname());
    }

    function beforeRender() {
        $this->_options();
        parent::beforeRender();
    }
    
    function admin_index() {
        $this->_activePrint(func_get_args(), "laporan_absen_ujian");
        parent::admin_index();
    }
}
