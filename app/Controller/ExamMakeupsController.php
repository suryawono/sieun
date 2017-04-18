<?php

App::uses('AppController', 'Controller');

class ExamMakeupsController extends AppController {

    var $name = "ExamMakeups";
    var $disabledAction = array(
    );
    var $contain=[
        "Course",
        "ExamMakeupStatus"
    ];

    function beforeFilter() {
        parent::beforeFilter();
        $this->_setPageInfo("admin_index", "");
        $this->_setPageInfo("admin_add", "");
        $this->_setPageInfo("admin_edit", "");
    }

    function _options() {
        $this->set("courses", $this->ExamMakeup->Course->find("list", ["fields" => ["Course.id", "Course.name"]]));
        $this->set("examMakeupStatuses", $this->ExamMakeup->ExamMakeupStatus->find("list", ["fields" => ["ExamMakeupStatus.id", "ExamMakeupStatus.name"]]));
    }

    function beforeRender() {
        $this->_options();
        parent::beforeRender();
    }

    function admin_change_status() {
        $this->autoRender = false;
        if ($this->request->is("PUT")) {
            $this->ExamMakeup->id = $this->request->data['id'];
            $this->ExamMakeup->save(array("ExamMakeup" => array("exam_makeup_status_id" => $this->request->data['status'])));
            $data = $this->ExamMakeup->find("first", array("conditions" => array("ExamMakeup.id" => $this->request->data['id']), "recursive" => 1));
            echo json_encode($this->_generateStatusCode(207, null, array("status_label" => $data['ExamMakeupStatus']['name'])));
        } else {
            echo json_encode($this->_generateStatusCode(400));
        }
    }
}
