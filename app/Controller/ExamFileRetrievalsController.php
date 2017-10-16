<?php

App::uses('AppController', 'Controller');

class ExamFileRetrievalsController extends AppController {

    var $name = "ExamFileRetrievals";
    var $disabledAction = array(
    );
    var $contain = [
        "Pengawas" => [
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
        $this->set("courses", $this->ExamFileRetrieval->Course->find("list", ["fields" => ["Course.id", "Course.name"]]));
        $this->set("accounts", ClassRegistry::init("Account")->getListWithFullname());
    }

    function beforeRender() {
        $this->_options();
        parent::beforeRender();
    }
    
    function admin_index() {
        $this->_activePrint(func_get_args(), "laporan_pengambilan_berkas_kurang_dari_20_menit");
        parent::admin_index();
    }
}
