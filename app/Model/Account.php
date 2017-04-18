<?php

class Account extends AppModel {

    public $validate = array(
    );
    public $belongsTo = array(
        'AccountStatus',
        'Employee',
        "PasswordReset",
    );
    public $hasOne = array(
        "User" => array(
            "dependent" => true
        ),
        "Biodata" => array(
            "dependent" => true
        ),
    );

    function getListWithFullname() {
        $data = $this->find("all", [
            "contain" => [
                "Biodata",
            ],
        ]);
        $result = [];
        foreach ($data as $tuple) {
            $result[$tuple["Account"]['id']] = $tuple['Biodata']['full_name'];
        }
        asort($result);
        return $result;
    }

}
