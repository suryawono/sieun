<?php

class NoteExam extends AppModel {

    var $name = 'NoteExam';
    var $belongsTo = array(
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
