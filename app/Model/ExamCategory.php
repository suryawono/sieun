<?php

class ExamCategory extends AppModel {

    var $name = 'ExamCategory';
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
        "uniq_name" => [
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
        return $this->find("list", ["fields" => ["ExamCategory.id", "ExamCategory.name"], "order" => "ExamCategory.order asc"]);
    }

}

?>
