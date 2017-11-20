<?php

class TeacherFoul extends AppModel {

    var $name = 'TeacherFoul';
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
        "d" => [
            "Harus diisi" => "notEmpty",
        ],
        "exam_academic_category_id"=>[
            "Harus dipilih" => "notEmpty",
        ],
        "exam_academic_year_id"=>[
            "Harus dipilih" => "notEmpty",
        ],
        "exam_category_id"=>[
            "Harus dipilih" => "notEmpty",
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
