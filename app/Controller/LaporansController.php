<?php

class LaporansController extends AppController {

    var $disabledAction = array(
        "admin_index",
        "admin_add",
        "admin_edit",
        "admin_delete",
        "admin_multiple_delete",
    );
    
    
    function _options() {
        $this->set("examYearAcademics", ClassRegistry::init("ExamAcademicYear")->find("list", ["fields" => ["ExamAcademicYear.id", "ExamAcademicYear.periode"]]));
    }
     function beforeRender() {
        $this->_options();
        parent::beforeRender();
    }
    
    
    
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
        
        $conds=[];
        
        if (isset($this->request->query) && !empty($this->request->query)) {  
            if (isset($this->request->query['select_tahun']) && !empty($this->request->query['select_tahun'])) {
                $tahun1 = ClassRegistry::init("ExamAcademicYear")->find("first",[
                    "conditions"=>[
                        "ExamAcademicYear.id" => $this->request->query['select_tahun'],
                    ]
                ]);
                
                $tahun2 = ClassRegistry::init("ExamAcademicYear")->find("first",[
                    "conditions"=>[
                        "ExamAcademicYear.id" => $this->request->query['select_tahunA'],
                    ]
                ]);
                
                $per1 = $tahun1['ExamAcademicYear']['start_year'];
                $per2 = $tahun2['ExamAcademicYear']['start_year'];
                
                
                $conds = [
                   "ExamAcademicYear.start_year >="  => $per1,
                   "ExamAcademicYear.start_year <="  => $per2,
                 ];
                 
            }
        }
//        debug($conds);
//        $foulsYoY = ClassRegistry::init("Foul")->find("all", [
//            "recursive" => -1,
//            "conditions" => $conds,
//            "fields" => "count(Foul.id) JumlahPelanggaran,Foul.exam_academic_year_id,Foul.exam_academic_category_id,Foul.foul_type_id",
//            "group" => "Foul.exam_academic_year_id,Foul.exam_academic_category_id,Foul.foul_type_id",
//        ]);
        
        
        $foulsYoY = ClassRegistry::init("Foul")->find("all", [
            "recursive" => -1,
            "conditions" => $conds,
            "contain" => [
                'ExamAcademicYear',
                'ExamAcademicCategory',
            ],
            "fields" => "count(Foul.id) JumlahPelanggaran,Foul.exam_academic_year_id,Foul.exam_academic_category_id,Foul.foul_type_id",
            "group" => "Foul.exam_academic_year_id,Foul.exam_academic_category_id,Foul.foul_type_id",
        ]);
//        debug($foulsYoY);
//        die;
        $currentYear = date("Y");
        $result = [];
        $foulTypes = ClassRegistry::init("FoulType")->find("list", ["fields" => ["FoulType.id", "FoulType.name"]]);
        $examAcademicYears = ClassRegistry::init("ExamAcademicYear")->getList();
        $semester = ClassRegistry::init("ExamAcademicCategory")->find("all");
        //debug($semester);
        
       
            if (isset($this->request->query['select_tahun']) && !empty($this->request->query['select_tahun'])) {
                foreach ($foulTypes as $k => $v) {
                    $result[$k] = [];
                    for ($shiftYear = $per1; $shiftYear <= $per2; $shiftYear++) {
                        $examAcademicYear = ClassRegistry::init("ExamAcademicYear")->find("first", [
                            "conditions" => [
                                "ExamAcademicYear.start_year" => $shiftYear,

                            ],
                        ]);
                        foreach($semester as $sms => $semes){
                            if (!empty($examAcademicYear)) {
                                $result[$k][$examAcademicYear["ExamAcademicYear"]["id"]][$semes['ExamAcademicCategory']['id']] = 0;
                            }
                        }
                    }
                    
                
            }
        }else{
        foreach ($foulTypes as $k => $v) {
            $result[$k] = [];
            for ($shiftYear = $currentYear - 3; $shiftYear <= $currentYear; $shiftYear++) {
                $examAcademicYear = ClassRegistry::init("ExamAcademicYear")->find("first", [
                    "conditions" => [
                        "ExamAcademicYear.start_year" => $shiftYear,
                        
                    ],
                ]);
                foreach($semester as $sms => $semes){
                    if (!empty($examAcademicYear)) {
                        $result[$k][$examAcademicYear["ExamAcademicYear"]["id"]][$semes['ExamAcademicCategory']['id']] = 0;
                    }
                }
                
            }
        }
        }
        foreach ($foulsYoY as $item) {
            $result[$item["Foul"]["foul_type_id"]][$item["Foul"]["exam_academic_year_id"]][$item["Foul"]["exam_academic_category_id"]] = $item[0]["JumlahPelanggaran"];
        }
//        debug($result);
//        die;
        $buildGraph = [];
        $k=1;
        foreach ($result as $foul_type_id => $d) {
            $n = new stdClass();
            $n->label = $foulTypes[$foul_type_id];
            $n->data = [];
            $i = 1;
            foreach ($d as $exam_academic_year_id => $v) {
                //debug($v);
                foreach($v as $valSe => $vals){
                    $n->data[] = [$i++, intval($vals)];
                }
                
            }
            $bars=new stdClass();
            $bars->show=true;
            $bars->barWidth=0.2;
            $bars->order=$k++;
            $n->bars=$bars;
            $buildGraph[] = $n;
        }
        
        //debug($n);
        //die;
        $xaxis = [];
        $i = 1;
        
       
        if (isset($this->request->query['select_tahun']) && !empty($this->request->query['select_tahun'])) {
           for ($shiftYear = $per1; $shiftYear <= $per2; $shiftYear++) {
            $examAcademicYear = ClassRegistry::init("ExamAcademicYear")->find("first", [
                "conditions" => [
                    "ExamAcademicYear.start_year" => $shiftYear,
                ],
            ]);
            foreach($semester as $sms => $semes){
                if (!empty($examAcademicYear)) {
                    $xaxis[] = [$i++, $semes['ExamAcademicCategory']['name']." ".$examAcademicYear["ExamAcademicYear"]["periode"]];
                }
           }

             
            }
        }else{
        for ($shiftYear = $currentYear - 3; $shiftYear <= $currentYear; $shiftYear++) {
            $examAcademicYear = ClassRegistry::init("ExamAcademicYear")->find("first", [
                "conditions" => [
                    "ExamAcademicYear.start_year" => $shiftYear,
                ],
            ]);
            foreach($semester as $sms => $semes){
                if (!empty($examAcademicYear)) {
                    $xaxis[] = [$i++, $semes['ExamAcademicCategory']['name']." ".$examAcademicYear["ExamAcademicYear"]["periode"]];
                }
           }
            
        }
        }
        $this->set(compact("result", "foulTypes", "examAcademicYears", "buildGraph", "xaxis"));
    }

    function admin_exam_absents_yoy() {
        
         $conds=[];
        
        if (isset($this->request->query) && !empty($this->request->query)) {  
            if (isset($this->request->query['select_tahun']) && !empty($this->request->query['select_tahun'])) {
                $tahun1 = ClassRegistry::init("ExamAcademicYear")->find("first",[
                    "conditions"=>[
                        "ExamAcademicYear.id" => $this->request->query['select_tahun'],
                    ]
                ]);
                
                $tahun2 = ClassRegistry::init("ExamAcademicYear")->find("first",[
                    "conditions"=>[
                        "ExamAcademicYear.id" => $this->request->query['select_tahunA'],
                    ]
                ]);
                
                $per1 = $tahun1['ExamAcademicYear']['start_year'];
                $per2 = $tahun2['ExamAcademicYear']['start_year'];
                
                
                $conds = [
                   "ExamAcademicYear.start_year >="  => $per1,
                   "ExamAcademicYear.start_year <="  => $per2,
                 ];
                 
            }
        }
        
//        $examAbsenstYoY = ClassRegistry::init("ExamAbsent")->find("all", [
//            "recursive" => -1,
//            "fields" => "count(ExamAbsent.id) JumlahAbsen,ExamAbsent.exam_academic_year_id,ExamAbsent.exam_academic_category_id",
//            "group" => "ExamAbsent.exam_academic_year_id","ExamAbsent.exam_academic_category_id",
//        ]);
//        
        $examAbsenstYoY = ClassRegistry::init("ExamAbsent")->find("all", [
            "recursive" => -1,
            "conditions" => $conds,
            "contain" => [
                'ExamAcademicYear',
                'ExamAcademicCategory',
            ],
            "fields" => "count(ExamAbsent.id) JumlahAbsen,ExamAbsent.exam_academic_year_id,ExamAbsent.exam_academic_category_id",
            "group" => "ExamAbsent.exam_academic_year_id","ExamAbsent.exam_academic_category_id",
        ]);
        
//        debug($examAbsenstYoY);
//        die;
        $semester = ClassRegistry::init("ExamAcademicCategory")->find("all");
        $currentYear = date("Y");
        $result = [];
        $examAcademicYears = ClassRegistry::init("ExamAcademicYear")->getList();
        
        
        if (isset($this->request->query['select_tahun']) && !empty($this->request->query['select_tahun'])) {
            for ($shiftYear = $per1; $shiftYear <= $per2; $shiftYear++) {
                $examAcademicYear = ClassRegistry::init("ExamAcademicYear")->find("first", [
                    "conditions" => [
                        "ExamAcademicYear.start_year" => $shiftYear,
                    ],
                ]);
                foreach($semester as $s => $smt){
                    if (!empty($examAcademicYear)) {
                        $result[$examAcademicYear["ExamAcademicYear"]["id"]][$smt["ExamAcademicCategory"]["id"]] = 0;
                    }
                }

            }
        }else{
          
            for ($shiftYear = $currentYear - 3; $shiftYear <= $currentYear; $shiftYear++) {
                $examAcademicYear = ClassRegistry::init("ExamAcademicYear")->find("first", [
                    "conditions" => [
                        "ExamAcademicYear.start_year" => $shiftYear,
                    ],
                ]);
                foreach($semester as $s => $smt){
                    if (!empty($examAcademicYear)) {
                        $result[$examAcademicYear["ExamAcademicYear"]["id"]][$smt["ExamAcademicCategory"]["id"]] = 0;
                    }
                }

            }
        }
      

        foreach ($examAbsenstYoY as $item) {
            $result[$item["ExamAbsent"]["exam_academic_year_id"]][$item["ExamAbsent"]["exam_academic_category_id"]] = $item[0]["JumlahAbsen"];
        }
        $buildGraph = [];
        $n = new stdClass();
        $n->label = "Absen Ujian";
        $n->data = [];
        $i = 1;
        foreach ($result as $exam_academic_year_id => $v) {
            foreach($v as $valSe => $vals){
                $n->data[] = [$i++, intval($vals)];
            }
        }
        $buildGraph[] = $n;
        $xaxis = [];
        $i = 1;
        
        if (isset($this->request->query['select_tahun']) && !empty($this->request->query['select_tahun'])) {
           for ($shiftYear = $per1; $shiftYear <= $per2; $shiftYear++) {
            $examAcademicYear = ClassRegistry::init("ExamAcademicYear")->find("first", [
                "conditions" => [
                    "ExamAcademicYear.start_year" => $shiftYear,
                ],
            ]);
            foreach($semester as $sms => $semes){
                if (!empty($examAcademicYear)) {
                    $xaxis[] = [$i++, $semes['ExamAcademicCategory']['name']."".$examAcademicYear["ExamAcademicYear"]["periode"]];
                }
           }

             
            }
        }else{
            for ($shiftYear = $currentYear - 3; $shiftYear <= $currentYear; $shiftYear++) {
                $examAcademicYear = ClassRegistry::init("ExamAcademicYear")->find("first", [
                    "conditions" => [
                        "ExamAcademicYear.start_year" => $shiftYear,
                    ],
                ]);
                foreach($semester as $sms => $semes){
                    if (!empty($examAcademicYear)) {
                        $xaxis[] = [$i++, $semes['ExamAcademicCategory']['name']."".$examAcademicYear["ExamAcademicYear"]["periode"]];
                    }
                }
            }
        }
        
        $this->set(compact("result", "examAcademicYears", "buildGraph", "xaxis"));
    }

    function admin_exam_makeups_yoy() {
        $conds=[];
        
        if (isset($this->request->query) && !empty($this->request->query)) {  
            if (isset($this->request->query['select_tahun']) && !empty($this->request->query['select_tahun'])) {
                $tahun1 = ClassRegistry::init("ExamAcademicYear")->find("first",[
                    "conditions"=>[
                        "ExamAcademicYear.id" => $this->request->query['select_tahun'],
                    ]
                ]);
                
                $tahun2 = ClassRegistry::init("ExamAcademicYear")->find("first",[
                    "conditions"=>[
                        "ExamAcademicYear.id" => $this->request->query['select_tahunA'],
                    ]
                ]);
                
                $per1 = $tahun1['ExamAcademicYear']['start_year'];
                $per2 = $tahun2['ExamAcademicYear']['start_year'];
                
                
                $conds = [
                   "ExamAcademicYear.start_year >="  => $per1,
                   "ExamAcademicYear.start_year <="  => $per2,
                 ];
                 
            }
        }
        
        
//        $examMakeupsYoY = ClassRegistry::init("ExamMakeup")->find("all", [
//            "recursive" => -1,
//            "fields" => "count(ExamMakeup.id) JumlahPermohonan,ExamMakeup.exam_academic_year_id,ExamMakeup.exam_makeup_status_id,ExamMakeup.exam_academic_category_id",
//            "group" => "ExamMakeup.exam_academic_year_id,ExamMakeup.exam_makeup_status_id,ExamMakeup.exam_academic_category_id",
//        ]);
//        $jumlahPermohonanYoY = ClassRegistry::init("ExamMakeup")->find("all", [
//            "recursive" => -1,
//            "fields" => "count(ExamMakeup.id) JumlahPermohonan,ExamMakeup.exam_academic_year_id,ExamMakeup.exam_academic_category_id",
//            "group" => "ExamMakeup.exam_academic_year_id,ExamMakeup.exam_academic_category_id",
//        ]);
        
        
        $examMakeupsYoY = ClassRegistry::init("ExamMakeup")->find("all", [
            "recursive" => -1,
            "conditions" => $conds,
            "contain" => [
                'ExamAcademicYear',
                'ExamAcademicCategory',
            ],
            "fields" => "count(ExamMakeup.id) JumlahPermohonan,ExamMakeup.exam_academic_year_id,ExamMakeup.exam_makeup_status_id,ExamMakeup.exam_academic_category_id",
            "group" => "ExamMakeup.exam_academic_year_id,ExamMakeup.exam_makeup_status_id,ExamMakeup.exam_academic_category_id",
        ]);
        
        
        $jumlahPermohonanYoY = ClassRegistry::init("ExamMakeup")->find("all", [
            "recursive" => -1,
            "conditions" => $conds,
            "contain" => [
                'ExamAcademicYear',
                'ExamAcademicCategory',
            ],
            "fields" => "count(ExamMakeup.id) JumlahPermohonan,ExamMakeup.exam_academic_year_id,ExamMakeup.exam_academic_category_id",
            "group" => "ExamMakeup.exam_academic_year_id,ExamMakeup.exam_academic_category_id",
        ]);
        
//        debug($examMakeupsYoY);
//        debug($jumlahPermohonanYoY);
        $currentYear = date("Y");
        $result = [];
        $examMakeupStatuses = ClassRegistry::init("ExamMakeupStatus")->find("list", ["fields" => ["ExamMakeupStatus.id", "ExamMakeupStatus.name"]]);
        $examAcademicYears = ClassRegistry::init("ExamAcademicYear")->getList();
        $semester = ClassRegistry::init("ExamAcademicCategory")->find("all"); 
        
        
        if (isset($this->request->query['select_tahun']) && !empty($this->request->query['select_tahun'])) {
            for ($shiftYear = $per1; $shiftYear <= $per2; $shiftYear++) {
                $examAcademicYear = ClassRegistry::init("ExamAcademicYear")->find("first", [
                    "conditions" => [
                        "ExamAcademicYear.start_year" => $shiftYear,
                    ],
                ]);
                foreach($semester as $s => $smt){
                    if (!empty($examAcademicYear)) {
                        $result[-1][$examAcademicYear["ExamAcademicYear"]["id"]][$smt["ExamAcademicCategory"]["id"]] = 0;
                    }
                }

            }
        }else{
          
            for ($shiftYear = $currentYear - 3; $shiftYear <= $currentYear; $shiftYear++) {
                $examAcademicYear = ClassRegistry::init("ExamAcademicYear")->find("first", [
                    "conditions" => [
                        "ExamAcademicYear.start_year" => $shiftYear,
                    ],
                ]);
                foreach($semester as $s => $smt){
                    if (!empty($examAcademicYear)) {
                        $result[-1][$examAcademicYear["ExamAcademicYear"]["id"]][$smt["ExamAcademicCategory"]["id"]] = 0;
                    }
                }
            }
        }
        
        
        if (isset($this->request->query['select_tahun']) && !empty($this->request->query['select_tahun'])) {
            foreach ($examMakeupStatuses as $k => $v) {
                $result[$k] = [];
                for ($shiftYear = $per1; $shiftYear <= $per2; $shiftYear++) {
                    $examAcademicYear = ClassRegistry::init("ExamAcademicYear")->find("first", [
                            "conditions" => [
                                "ExamAcademicYear.start_year" => $shiftYear,
                            ],
                        ]);
                        foreach($semester as $s => $smt){
                            if (!empty($examAcademicYear)) {
                                $result[$k][$examAcademicYear["ExamAcademicYear"]["id"]][$smt["ExamAcademicCategory"]["id"]] = 0;
                            }
                        }

                }
            }
        }else{
          
            foreach ($examMakeupStatuses as $k => $v) {
                $result[$k] = [];
                for ($shiftYear = $currentYear - 3; $shiftYear <= $currentYear; $shiftYear++) {
                    $examAcademicYear = ClassRegistry::init("ExamAcademicYear")->find("first", [
                        "conditions" => [
                            "ExamAcademicYear.start_year" => $shiftYear,
                        ],
                    ]);
                    foreach($semester as $s => $smt){
                        if (!empty($examAcademicYear)) {
                            $result[$k][$examAcademicYear["ExamAcademicYear"]["id"]][$smt["ExamAcademicCategory"]["id"]] = 0;
                        }
                    }
                }
            }
        }

        
//        debug($result[-1]);
        
        
        foreach ($examMakeupsYoY as $item) {
            $result[$item["ExamMakeup"]["exam_makeup_status_id"]][$item["ExamMakeup"]["exam_academic_year_id"]][$item["ExamMakeup"]["exam_academic_category_id"]] = $item[0]["JumlahPermohonan"];
        }
        foreach ($jumlahPermohonanYoY as $item) {
            $result[-1][$item["ExamMakeup"]["exam_academic_year_id"]][$item["ExamMakeup"]["exam_academic_category_id"]] = $item[0]["JumlahPermohonan"];
        }
        $buildGraph = [];
        $k=1;
//        debug($result);
//        die;
        foreach ($result as $exam_makeup_status_id => $d) {
            $n = new stdClass();
            if ($exam_makeup_status_id == -1) {
                $n->label="Jumlah Permohonan";
            } else {
                $n->label = $examMakeupStatuses[$exam_makeup_status_id];
            }
            $n->data = [];
            $i = 1;
            foreach ($d as $exam_academic_year_id => $v) {
                foreach($v as $valSe => $vals){
                    $n->data[] = [$i++, intval($vals)];
                }
            }
            $bars=new stdClass();
            $bars->show=true;
            $bars->barWidth=0.2;
            $bars->order=$k++;
            $n->bars=$bars;
            $buildGraph[] = $n;
        }
        $xaxis = [];
        $i = 1;
        
        if (isset($this->request->query['select_tahun']) && !empty($this->request->query['select_tahun'])) {
           for ($shiftYear = $per1; $shiftYear <= $per2; $shiftYear++) {
                $examAcademicYear = ClassRegistry::init("ExamAcademicYear")->find("first", [
                    "conditions" => [
                        "ExamAcademicYear.start_year" => $shiftYear,
                    ],
                ]);
                foreach($semester as $sms => $semes){
                    if (!empty($examAcademicYear)) {
                        $xaxis[] = [$i++, $semes['ExamAcademicCategory']['name']."".$examAcademicYear["ExamAcademicYear"]["periode"]];
                    }
                }

             
            }
        }else{
            for ($shiftYear = $currentYear - 3; $shiftYear <= $currentYear; $shiftYear++) {
                $examAcademicYear = ClassRegistry::init("ExamAcademicYear")->find("first", [
                    "conditions" => [
                        "ExamAcademicYear.start_year" => $shiftYear,
                    ],
                ]);
                foreach($semester as $sms => $semes){
                    if (!empty($examAcademicYear)) {
                        $xaxis[] = [$i++, $semes['ExamAcademicCategory']['name']."".$examAcademicYear["ExamAcademicYear"]["periode"]];
                    }
                }
            }
        }
        
        $this->set(compact("result", "examMakeupStatuses", "examAcademicYears", "buildGraph", "xaxis"));
    }

}
