<?php

class FoulType extends AppModel {

    var $name = 'FoulType';
    var $belongsTo = array(
    );
    var $hasOne = array(
    );
    var $hasMany = array(
    );
    var $validate = array(
        "name" => [
            "Harus diisi" => "notEmpty",
        ],
        "code" => [
            "Harus Diisi" => "notEmpty",
            "Kode Sudah terdaftar" => "isUnique",
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
