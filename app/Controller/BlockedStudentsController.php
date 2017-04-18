<?php

App::uses('AppController', 'Controller');

class BlockedStudentsController extends AppController {

    var $name = "BlockedStudents";
    var $disabledAction=array(
    );
    
    function beforeFilter() {
        parent::beforeFilter();
        $this->_setPageInfo("admin_index", "");
        $this->_setPageInfo("admin_add", "");
        $this->_setPageInfo("admin_edit", "");
    }
}
