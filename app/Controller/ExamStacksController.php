<?php

App::uses('AppController', 'Controller');

class ExamStacksController extends AppController {

    var $name = "ExamStacks";
    var $disabledAction = array(
    );
    var $contain = [
        "Course1",
        "Course2",
    ];

    function beforeFilter() {
        parent::beforeFilter();
        $this->_setPageInfo("admin_index", "");
        $this->_setPageInfo("admin_add", "");
        $this->_setPageInfo("admin_edit", "");
    }

    function _options() {
        $this->set("courses", ClassRegistry::init("Course")->find("list", ["fields" => ["Course.id", "Course.name"]]));
    }

    function beforeRender() {
        $this->_options();
        parent::beforeRender();
    }

}
