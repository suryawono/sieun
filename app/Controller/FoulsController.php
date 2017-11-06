<?php

App::uses('AppController', 'Controller');

class FoulsController extends AppController {

    var $name = "Fouls";
    var $disabledAction = array(
    );
    var $contain = [
        "Pengawas" => [
            "Biodata",
        ],
        "FoulType",
        "Course",
        "ExamCategory",
        "ExamAcademicYear",
        "ExamAcademicCategory",
    ];

    function beforeFilter() {
        parent::beforeFilter();
        $this->_setPageInfo("admin_index", "Data Pelanggaran");
        $this->_setPageInfo("admin_add", "");
        $this->_setPageInfo("admin_edit", "");
    }

    function _options() {
        $this->set("foulTypes", $this->Foul->FoulType->find("list", ["fields" => ["FoulType.id", "FoulType.name"]]));
        $this->set("courses", $this->Foul->Course->getList());
        $this->set("examCategories", $this->Foul->ExamCategory->getList());
        $this->set("examAcademicYears", $this->Foul->ExamAcademicYear->getList());
        $this->set("examAcademicCategories", $this->Foul->ExamAcademicCategory->getList());
        $this->set("accounts", ClassRegistry::init("Account")->getListWithFullname());
    }

    function beforeRender() {
        $this->_options();
        parent::beforeRender();
    }

    function admin_index() {
        $this->_activePrint(func_get_args(), "data_pelanggaran_ujian");
        parent::admin_index();
    }

    function _excelData($rows) {
        $titleRow = [
            "No",
            "Tahun Ajaran",
            "Semester",
            "Kategori Ujian",
            "Mata Kuliah",
            "NPM",
            "Nama Mahasiswa",
            "Pengawas",
            "Jenis Pelanggaran",
            "Tanggal Ujian",
            "Keterangan",
        ];
        $excelData = [];
        foreach ($rows as $n => $item) {
            $excelData[] = [
                $n + 1,
                $item["ExamAcademicYear"]["periode"],
                $item["ExamAcademicCategory"]["name"],
                $item["ExamCategory"]["uniq_name"],
                $item["Course"]["full_label"],
                $item["Foul"]["npm"],
                $item["Foul"]["name"],
                $item["Pengawas"]["Biodata"]["full_name"],
                $item["FoulType"]["name"],
                $item["Foul"]["d"],
                $item["Foul"]["keterangan"],
            ];
        }
        $this->set(compact("titleRow", "excelData"));
    }

}
