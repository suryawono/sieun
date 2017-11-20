<?php

class Biodata extends AppModel {

    public $validate = array(
        'first_name' => array(
            'rule' => 'notEmpty',
            'message' => 'Harus diisi'
        ),
        'identity_number' => array(
            "Harus Diisi" => "notEmpty",
            "Kode Sudah terdaftar" => "isUnique",
        ),
    );
    public $belongsTo = array(
        'State',
        'Country',
        'City',
        'Gender',
        "Religion",
        "Account",
        "IdentityType",
    );
    public $hasOne = array(
    );
    public $virtualFields = array(
        "full_name" => "trim(Trailing ',' from concat(identity_number,' - ',first_name,' ',last_name))",
    );

}
