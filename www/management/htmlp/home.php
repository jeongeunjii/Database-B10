<?php
    session_start();
    function removez($str) {
        if ($str[0] === '0') {
            $result = $str[1];
        }else{
            $result = $str;
        }
        return $result;
    }

    try {
                    
        $db = new PDO("mysql:dbname=movie; host=52.78.148.203; port=3306", "root", "1234");
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $db->query("set session character_set_connection=utf8;");
        $db->query("set session character_set_results=utf8;");
        $db->query("set session character_set_client=utf8;");

        #상세정보 배열
        $rows = $db->query("SELECT * FROM 직원관리");
        $idset = array( array() );
        $index=0;
        $arrive=0;
        $late=0;
        
        foreach ($rows as $row) {
            $idset[$index][0] = $row['사번'];
            $idset[$index][1] = $row['이름'];
            $index = $index+1;
        }

        for ($i=0; $i < count($idset); $i++) {
            $num = $idset[$i][0];
            $num = $db->quote($num);
            $lines = $db->query("SELECT * FROM 근태관리 WHERE 사번=$num");
            foreach($lines as $line) {
                if ($line['출근'] !== NULL){
                    $hour = removez(substr($line['출근'], 0, 2));
                    if ($hour < 9) {
                        $arrive = $arrive + 1;
                    }else {
                        $late = $late + 1;
                    }
                }
            }
            $idset[$i][2] = $arrive;
            $idset[$i][3] = $late;
            $arrive = 0;
            $late = 0;
        }
        

        for ($i=0; $i < count($idset); $i++) {
            $num = $idset[$i][0];
            $num = $db->quote($num);
            $lines = $db->query("SELECT * FROM 직원관리 WHERE 사번=$num");
            $lines = $lines->fetchAll();
            foreach ($lines as $line){
                if ($lines[0]['부서'] == "플로어") {
                    $floors = $db->query("SELECT * FROM floor업무관리 NATURAL JOIN 시설물 WHERE 사번=$num");
                    $floors = $floors->fetchAll();
                    if (count($floors) == 0) {
                        $idset[$i][4] = "할당된 업무가 없습니다.";
                    }else {
                        $idset[$i][4] = $floors[0]['시설물명']." 청소중";
                    }
                }else if ($lines[0]['부서'] == "기술지원") {
                    $techs = $db->query("SELECT * FROM 기술지원 NATURAL JOIN 시설물 WHERE 사번=$num");
                    $techs = $techs->fetchAll();
                    if (count($techs) == 0) {
                        $idset[$i][4] = "할당된 업무가 없습니다.";
                    }else {
                        $idset[$i][4] = $techs[0]['시설물명']." 수리중";
                    }
                } else {
                    $idset[$i][4] = "청소, 기술업무 사원이 아닙니다.";
                }
            }
        }
        echo "<pre>";
        var_dump($idset);
        // var_dump(count($idset));
        echo "</pre>";
    } catch (PDOException $ex) {
        ?>
            <p>Sorry, a database error occurred. Please try again later.</p>
            <p>(Error details: <?= $ex->getMessage() ?>)</p>
        <?php
            }
        ?>		
