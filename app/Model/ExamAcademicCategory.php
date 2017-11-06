<?php

class ExamAcademicCategory extends AppModel {

    var $name = 'ExamAcademicCategory';
    var $belongsTo = array(
    );
    var $hasOne = array(
    );
    var $hasMany = array(
    );
    var $validate = array(
        "order" => [
            "rule" => "notEmpty",
            "message" => "Harus Diisi"
        ],
        "name" => [
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
    
    function getList() {
        return $this->find("list", ["fields" => ["ExamAcademicCategory.id", "ExamAcademicCategory.name"], "order" => "ExamAcademicCategory.order asc"]);
    }

}

?>
