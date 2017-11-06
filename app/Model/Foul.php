<?php

class Foul extends AppModel {

    var $name = 'Foul';
    var $belongsTo = array(
        "FoulType",
        "Course",
        "Pengawas" => [
            "className" => "Account",
            "foreignKey" => "pengawas_id",
        ],
        "ExamCategory",
        "ExamAcademicYear",
        "ExamAcademicCategory",
    );
    var $hasOne = array(
    );
    var $hasMany = array(
    );
    var $validate = array(
        "course_id" => [
            "Harus dipilih" => "notEmpty",
        ],
        "pengawas_id" => [
            "Harus dipilih" => "notEmpty",
        ],
        "foul_type_id" => [
            "Harus dipilih" => "notEmpty",
        ],
        "npm" => [
            "Harus diisi" => "notEmpty",
        ],
        "name" => [
            "Harus diisi" => "notEmpty",
        ],
        "d" => [
            "Harus diisi" => "notEmpty",
        ],
    );
    var $virtualFields = array(
        
    );

    function beforeValidate($options = array()) {
        
    }

    function deleteData($id = null) {
        return $this->delete($id);
    }

}

?>
