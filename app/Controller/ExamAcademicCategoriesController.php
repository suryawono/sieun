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
        $this->_setPageInfo("admin_index", "");
        $this->_setPageInfo("admin_add", "");
        $this->_setPageInfo("admin_edit", "");
    }

    function _options() {
    }

    function beforeRender() {
        $this->_options();
        parent::beforeRender();
    }

}
