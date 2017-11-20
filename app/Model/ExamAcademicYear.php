<?php

class ExamAcademicYear extends AppModel {

    var $name = 'ExamAcademicYear';
    var $belongsTo = array(
    );
    var $hasOne = array(
    );
    var $hasMany = array(
    );
    var $validate = array(
        "start_year" => [
            [
                "rule" => "notEmpty",
                "message" => "Harus Diisi"
            ],
            [
                "rule" => "isUnique",
                "message" => "Sudah ada"
            ],
        ],
        "end_year" => [
            "rule" => "notEmpty",
            "message" => "Harus Diisi"
        ],
        "code" => [
            "Harus Diisi" => "notEmpty",
            "Kode Sudah terdaftar" => "isUnique",
        ],
    );
    var $virtualFields = array(
        "periode" => "concat(ExamAcademicYear.start_year, '/', ExamAcademicYear.end_year)"
    );

    function beforeValidate($options = array()) {
        
    }

    function deleteData($id = null) {
        return $this->delete($id);
    }

    function getList() {
        return $this->find("list", ["fields" => ["ExamAcademicYear.id", "ExamAcademicYear.periode"], "order" => "ExamAcademicYear.start_year desc"]);
    }

}

?>
