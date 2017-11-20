<?php

class ExamMakeup extends AppModel {

    var $name = 'ExamMakeup';
    var $belongsTo = array(
        "Course",
        "ExamMakeupStatus",
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
        "npm" => [
            "Harus diisi" => "notEmpty",
        ],
        "name" => [
            "Harus diisi" => "notEmpty",
        ],
        "exam_academic_category_id" => [
            "Harus dipilih" => "notEmpty",
        ],
        "exam_academic_year_id" => [
            "Harus dipilih" => "notEmpty",
        ],
        "exam_category_id" => [
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
