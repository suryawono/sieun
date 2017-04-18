<?php

class NoteExam extends AppModel {

    var $name = 'NoteExam';
    var $belongsTo = array(
        "Course",
        "Pengawas" => [
            "className" => "Account",
            "foreignKey" => "pengawas_id",
        ],
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
