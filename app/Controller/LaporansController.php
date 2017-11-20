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

    function admin_fouls_yoy() {
        $foulsYoY = ClassRegistry::init("Foul")->find("all", [
            "recursive" => -1,
            "fields" => "count(Foul.id) JumlahPelanggaran,Foul.exam_academic_year_id,Foul.foul_type_id",
            "group" => "Foul.exam_academic_year_id,Foul.foul_type_id",
        ]);
        $currentYear = date("Y");
        $result = [];
        $foulTypes = ClassRegistry::init("FoulType")->find("list", ["fields" => ["FoulType.id", "FoulType.name"]]);
        $examAcademicYears = ClassRegistry::init("ExamAcademicYear")->getList();
        foreach ($foulTypes as $k => $v) {
            $result[$k] = [];
            for ($shiftYear = $currentYear - 10; $shiftYear <= $currentYear; $shiftYear++) {
                $examAcademicYear = ClassRegistry::init("ExamAcademicYear")->find("first", [
                    "conditions" => [
                        "ExamAcademicYear.start_year" => $shiftYear,
                    ],
                ]);
                if (!empty($examAcademicYear)) {
                    $result[$k][$examAcademicYear["ExamAcademicYear"]["id"]] = 0;
                }
            }
        }

        foreach ($foulsYoY as $item) {
            $result[$item["Foul"]["foul_type_id"]][$item["Foul"]["exam_academic_year_id"]] = $item[0]["JumlahPelanggaran"];
        }
        $buildGraph = [];
        foreach ($result as $foul_type_id => $d) {
            $n = new stdClass();
            $n->label = $foulTypes[$foul_type_id];
            $n->data = [];
            $i = 1;
            foreach ($d as $exam_academic_year_id => $v) {
                $n->data[] = [$i++, intval($v)];
            }
            $buildGraph[] = $n;
        }
        $xaxis = [];
        $i = 1;
        for ($shiftYear = $currentYear - 10; $shiftYear <= $currentYear; $shiftYear++) {
            $examAcademicYear = ClassRegistry::init("ExamAcademicYear")->find("first", [
                "conditions" => [
                    "ExamAcademicYear.start_year" => $shiftYear,
                ],
            ]);
            if (!empty($examAcademicYear)) {
                $xaxis[] = [$i++, $examAcademicYear["ExamAcademicYear"]["periode"]];
            }
        }
        $this->set(compact("result", "foulTypes", "examAcademicYears", "buildGraph", "xaxis"));
    }

    function admin_exam_absents_yoy() {
        $examAbsenstYoY = ClassRegistry::init("ExamAbsent")->find("all", [
            "recursive" => -1,
            "fields" => "count(ExamAbsent.id) JumlahAbsen,ExamAbsent.exam_academic_year_id",
            "group" => "ExamAbsent.exam_academic_year_id",
        ]);
        $currentYear = date("Y");
        $result = [];
        $examAcademicYears = ClassRegistry::init("ExamAcademicYear")->getList();
        for ($shiftYear = $currentYear - 10; $shiftYear <= $currentYear; $shiftYear++) {
            $examAcademicYear = ClassRegistry::init("ExamAcademicYear")->find("first", [
                "conditions" => [
                    "ExamAcademicYear.start_year" => $shiftYear,
                ],
            ]);
            if (!empty($examAcademicYear)) {
                $result[$examAcademicYear["ExamAcademicYear"]["id"]] = 0;
            }
        }

        foreach ($examAbsenstYoY as $item) {
            $result[$item["ExamAbsent"]["exam_academic_year_id"]] = $item[0]["JumlahAbsen"];
        }
        $buildGraph = [];
        $n = new stdClass();
        $n->label = "Absen Ujian";
        $n->data = [];
        $i = 1;
        foreach ($result as $exam_academic_year_id => $v) {
            $n->data[] = [$i++, intval($v)];
        }
        $buildGraph[] = $n;
        $xaxis = [];
        $i = 1;
        for ($shiftYear = $currentYear - 10; $shiftYear <= $currentYear; $shiftYear++) {
            $examAcademicYear = ClassRegistry::init("ExamAcademicYear")->find("first", [
                "conditions" => [
                    "ExamAcademicYear.start_year" => $shiftYear,
                ],
            ]);
            if (!empty($examAcademicYear)) {
                $xaxis[] = [$i++, $examAcademicYear["ExamAcademicYear"]["periode"]];
            }
        }
        $this->set(compact("result", "examAcademicYears", "buildGraph", "xaxis"));
    }

}
