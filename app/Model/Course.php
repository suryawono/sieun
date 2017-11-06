<?php

class Course extends AppModel {

    var $name = 'Course';
    var $belongsTo = array(
    );
    var $hasOne = array(
    );
    var $hasMany = array(
    );
    var $validate = array(
        "name" => [
            "rule" => "notEmpty",
            "message" => "Harus Diisi"
        ],
        "code" => [
            "rule" => "notEmpty",
            "message" => "Harus Diisi"
        ]
    );
    var $virtualFields = array(
        "full_label" => "concat(Course.code,' - ', Course.name)"
    );

    function beforeValidate($options = array()) {
        
    }

    function deleteData($id = null) {
        return $this->delete($id);
    }
    
    function getList(){
        return $this->find("list",["fields" => ["Course.id", "Course.full_label"],"order"=>"Course.code asc"]);
    }

}

?>
