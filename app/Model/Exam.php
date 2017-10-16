<?php

class Exam extends AppModel {

    var $name = 'Exam';
    var $belongsTo = array(
        "Semester",
        "Course",
        "ExamCategory",
        "ExamAcademicCategory",
        "ExamAcademicYear"
    );
    var $hasOne = array(
    );
    var $hasMany = array(
    );
    var $validate = array(
        "semester_id" => [
            "rule" => "notEmpty",
            "message" => "Harus Diisi"
        ],
        "course_id" => [
            "rule" => "notEmpty",
            "message" => "Harus Diisi"
        ],
        "exam_category_id" => [
            "rule" => "notEmpty",
            "message" => "Harus Diisi"
        ],
        "exam_academic_category_id" => [
            "rule" => "notEmpty",
            "message" => "Harus Diisi"
        ],
        "exam_academic_year_id" => [
            "rule" => "notEmpty",
            "message" => "Harus Diisi"
        ],
        "exam_date" => [
            "rule" => "notEmpty",
            "message" => "Harus Diisi"
        ],
        "start_time" => [
            "rule" => "notEmpty",
            "message" => "Harus Diisi"
        ],
        "end_time" => [
            "rule" => "notEmpty",
            "message" => "Harus Diisi"
        ]
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
