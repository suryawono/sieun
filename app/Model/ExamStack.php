<?php

class ExamStack extends AppModel {

    var $name = 'ExamStack';
    var $belongsTo = array(
        "Course1" => [
            "className" => "Course",
            "foreignKey" => "course1_id",
        ],
        "Course2" => [
            "className" => "Course",
            "foreignKey" => "course2_id",
        ],
    );
    var $hasOne = array(
    );
    var $hasMany = array(
    );
    var $validate = array(
        "course1_id" => [
            "Harus dipilih" => "notEmpty",
        ],
        "course2_id" => [
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
