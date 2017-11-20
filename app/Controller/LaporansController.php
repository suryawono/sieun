<?php

class LaporansController extends AppController {

    var $disabledAction = array(
        "admin_index",
        "admin_add",
        "admin_edit",
        "admin_delete",
        "admin_multiple_delete",
    );

    function admin_per_mahasiswa() {
        $this->_activePrint(func_get_args(), "laporan_per_mahasiswa");
        $data = [
            "render" => true,
        ];
        if (isset($this->request->query["npm"]) && !empty($this->request->query["npm"])) {
            $npm = $this->request->query["npm"];
            $data["fouls"] = ClassRegistry::init("Foul")->find("all", [
                "conditions" => [
                    "Foul.npm" => $npm
                ],
                "contain" => [
                    "Pengawas" => [
                        "Biodata",
                    ],
                    "FoulType",
                    "Course",
                    "ExamCategory",
                    "ExamAcademicYear",
                    "ExamAcademicCategory",
                ],
            ]);
            $data["exam_absents"] = ClassRegistry::init("ExamAbsent")->find("all", [
                "conditions" => [
                    "ExamAbsent.npm" => $npm
                ],
                "contain" => [
                    "Pengawas" => [
                        "Biodata",
                    ],
                    "Course",
                    "ExamCategory",
                    "ExamAcademicYear",
                    "ExamAcademicCategory",
                ],
            ]);
            $data["exam_makeups"] = ClassRegistry::init("ExamMakeup")->find("all", [
                "conditions" => [
                    "ExamMakeup.npm" => $npm
                ],
                "contain" => [
                    "Course",
                    "ExamMakeupStatus",
                    "ExamCategory",
                    "ExamAcademicYear",
                    "ExamAcademicCategory",
                ],
            ]);
        } else {
            $data["render"] = false;
        }
        $this->set(compact("data"));
    }

}
