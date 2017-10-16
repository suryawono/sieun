<?php

App::uses('AppController', 'Controller');

class FoulsController extends AppController {

    var $name = "Fouls";
    var $disabledAction = array(
    );
    var $contain=[
        "Pengawas"=>[
            "Biodata",
        ],
        "FoulType",
        "Course",
    ];

    function beforeFilter() {
        parent::beforeFilter();
        $this->_setPageInfo("admin_index", "");
        $this->_setPageInfo("admin_add", "");
        $this->_setPageInfo("admin_edit", "");
    }

    function _options() {
        $this->set("foulTypes", $this->Foul->FoulType->find("list", ["fields" => ["FoulType.id", "FoulType.name"]]));
        $this->set("courses", $this->Foul->Course->find("list", ["fields" => ["Course.id", "Course.name"]]));
        $this->set("accounts", ClassRegistry::init("Account")->getListWithFullname());
    }

    function beforeRender() {
        $this->_options();
        parent::beforeRender();
    }
    
    function admin_index() {
        $this->_activePrint(func_get_args(), "laporan_pelanggaran_ujian");
        parent::admin_index();
    }
}
