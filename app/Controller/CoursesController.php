<?php

App::uses('AppController', 'Controller');

class CoursesController extends AppController {

    var $name = "Courses";
    var $disabledAction=array(
    );
    var $order="Course.code asc";
    
    function beforeFilter() {
        parent::beforeFilter();
        $this->_setPageInfo("admin_index", "");
        $this->_setPageInfo("admin_add", "");
        $this->_setPageInfo("admin_edit", "");
    }
    
    function admin_index() {
        $this->_activePrint(func_get_args(), "export_mata_kuliah");
        parent::admin_index();
    }
}
