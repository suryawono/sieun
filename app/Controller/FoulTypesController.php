<?php

App::uses('AppController', 'Controller');

class FoulTypesController extends AppController {

    var $name = "FoulTypes";
    var $disabledAction=array(
    );
    
    function beforeFilter() {
        parent::beforeFilter();
        $this->_setPageInfo("admin_index", "");
        $this->_setPageInfo("admin_add", "");
        $this->_setPageInfo("admin_edit", "");
    }
}
