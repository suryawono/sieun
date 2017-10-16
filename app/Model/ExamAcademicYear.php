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
            "rule" => "notEmpty",
            "message" => "Harus Diisi"
        ],
        "end_year" => [
            "rule" => "notEmpty",
            "message" => "Harus Diisi"
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
