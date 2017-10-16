<?php

App::uses('AppController', 'Controller');

class ExamsController extends AppController {

    var $name = "Exams";
    var $disabledAction = array(
    );
    var $contain = [
        "Semester",
        "Course",
        "ExamCategory",
        "ExamAcademicCategory",
        "ExamAcademicYear"
    ];

    function beforeFilter() {
        parent::beforeFilter();
        $this->_setPageInfo("admin_index", "");
        $this->_setPageInfo("admin_add", "");
        $this->_setPageInfo("admin_edit", "");
    }

    function _options() {
        $this->set("courses", ClassRegistry::init('Course')->find("list", ["fields" => ["Course.id", "Course.full_label"], 'order' => "Course.code"]));
        $this->set("accounts", ClassRegistry::init("Account")->getListWithFullname());
        $this->set("semesters", ClassRegistry::init("Semester")->find("list", ['fields' => ['Semester.id', 'Semester.name'], 'order' => "Semester.name"]));
        $this->set("examCategories", ClassRegistry::init("ExamCategory")->find("list", ['fields' => ['ExamCategory.id', 'ExamCategory.name']]));
        $this->set("examAcademicCategories", ClassRegistry::init("ExamAcademicCategory")->find("list", ['fields' => ['ExamAcademicCategory.id', 'ExamAcademicCategory.name']]));
        $this->set("examAcademicYears", ClassRegistry::init("ExamAcademicYear")->find("list", ['fields' => ['ExamAcademicYear.id', 'ExamAcademicYear.periode'], 'order' => "ExamAcademicYear.periode"]));
    }

    function beforeRender() {
        $this->_options();
        parent::beforeRender();
    }
    
    function admin_index() {
        $this->_activePrint(func_get_args(), "laporan_jadwal_ujian");
        parent::admin_index();
    }
}
