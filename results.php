<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
    <title>영어 실력 테스트</title>
    <link rel="stylesheet" type="text/css" href="css/style.css"/>
    <meta name="viewport" content="width=device-width, initial-scale=0.7">
</head>
<body>
<div id="page-wrap">
    <h1>정답률 결과 확인</h1>
    <?php

    $num_total_question = 12;   //총 문제수
    $num_total_level = 12;      //레벨 수
    $num_sub_sample = 5;        //레벨당 문제샘플수
    $num_sub_question = 1;      //레벨당 문제수
    $num_choice = 5;            //보기

    if (1) {
        $conn = mysql_connect("localhost", "inspo82", "lifestudy82");
    } else {
        $conn = mysql_connect("localhost", "root", "");
    }
    mysql_query('SET NAMES utf8');

    if (!$conn) {
        echo "Unable to connect to DB: " . mysql_error();
        exit;
    }

    if (!mysql_select_db("inspo82")) {
        echo "Unable to select mydbname: " . mysql_error();
        exit;
    }

    for ($level_idx = 0; $level_idx < $num_total_level; $level_idx++) {
        if(1) {
            $sql[$level_idx] = "SELECT * FROM elevel_" . ($level_idx + 1);
        }else {
            $sql[$level_idx] = "SELECT * FROM level_" . ($level_idx + 1);
        }
        $result[$level_idx] = mysql_query($sql[$level_idx]);

        if (!$result[$level_idx]) {
            echo "Could not successfully run query ($sql) from DB: " . mysql_error();
            exit;
        }

        if (mysql_num_rows($result[$level_idx]) == 0) {
            echo "No rows found, nothing to print so am exiting";
            exit;
        }

        echo "<div id='results'> Level " . ($level_idx + 1) . "</div>";

        for ($num_subquestion = 0; $num_subquestion < $num_sub_sample; $num_subquestion++) {
            $row[$level_idx][$num_subquestion] = mysql_fetch_assoc($result[$level_idx]);
            $question[$level_idx][$num_subquestion] = $row[$level_idx][$num_subquestion]['question'];
            $total_cnt[$level_idx][$num_subquestion] = $row[$level_idx][$num_subquestion]['total'];
            $correct_cnt[$level_idx][$num_subquestion] = $row[$level_idx][$num_subquestion]['correct'];


            echo "<div id='results2'>" . $question[$level_idx][$num_subquestion]
                . " 정답률 " . $correct_cnt[$level_idx][$num_subquestion] . "/" . $total_cnt[$level_idx][$num_subquestion]
                . " (" . round($correct_cnt[$level_idx][$num_subquestion] / $total_cnt[$level_idx][$num_subquestion] * 100) . "%)</div>";

        }

        echo "<div id='results2'>" . round(100 * ($correct_cnt[$level_idx][0] + $correct_cnt[$level_idx][1] + $correct_cnt[$level_idx][2])
                / ($total_cnt[$level_idx][0] + $total_cnt[$level_idx][1] + $total_cnt[$level_idx][2])) . "%</div>";

        echo "</br>";
    }
    echo "<div id='results2'> 총 참석자수 " . ($total_cnt[0][0] + $total_cnt[0][1] + $total_cnt[0][2]) . "</div>";

    ?>

</div>

<script type="text/javascript">
    var gaJsHost = (("https:" == document.location.protocol) ? "https://ssl." : "http://www.");
    document.write(unescape("%3Cscript src='" + gaJsHost + "google-analytics.com/ga.js' type='text/javascript'%3E%3C/script%3E"));
</script>
<script type="text/javascript">
    var pageTracker = _gat._getTracker("UA-68528-29");
    pageTracker._initData();
    pageTracker._trackPageview();
</script>

</body>

</html>