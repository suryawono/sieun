<?php

App::uses('AppController', 'Controller');

class NoteExamsController extends AppController {

    var $name = "NoteExams";
    var $disabledAction=array(
    );
    var $contain=[
        "Pengawas"=>[
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
        $this->set("courses", $this->NoteExam->Course->find("list", ["fields" => ["Course.id", "Course.name"]]));
        $this->set("accounts", ClassRegistry::init("Account")->getListWithFullname());
    }

    function beforeRender() {
        $this->_options();
        parent::beforeRender();
    }
}
