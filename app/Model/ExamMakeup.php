<?php

class ExamMakeup extends AppModel {

    var $name = 'ExamMakeup';
    var $belongsTo = array(
        "Course",
        "ExamMakeupStatus",
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
