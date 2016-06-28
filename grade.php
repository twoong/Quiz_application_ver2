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
    <h1>나의 영어 레벨 테스트 결과</h1>
    <?php

    $num_total_question = 12;   //총 문제수
    $num_total_level = 12;      //레벨 수
    $num_sub_sample = 5;        //레벨당 문제샘플수
    $num_sub_question = 1;      //레벨당 문제수
    $num_choice = 5;            //보기
    $score_list = array(4, 5, 5, 6, 7, 8, 9, 10, 10.5, 11, 11.5, 13);       //레벨별 점수

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

        if (1) {
            $sql[$level_idx] = "SELECT * FROM elevel_" . ($level_idx + 1);
        } else {
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

        for ($sub_idx = 0; $sub_idx < $num_sub_sample; $sub_idx++) {
            $row[$level_idx][$sub_idx] = mysql_fetch_assoc($result[$level_idx]);
            $right_answer[$level_idx][$sub_idx] = $row[$level_idx][$sub_idx]['good'];
        }
    }

    $rand_question = $_POST['rand_order'];
    $totalCorrect = 0;
    $totalScore = 0;

    for ($level_idx = 0; $level_idx < $num_total_level; $level_idx++) {
        //var_dump($level_idx); echo"</br>";

        for ($sub_question_idx = 0; $sub_question_idx < $num_sub_question; $sub_question_idx++) {
            $sql_score[($level_idx * $num_sub_question) + $sub_question_idx] = "UPDATE elevel_" . ($level_idx + 1) . " SET total = total+1 WHERE id =  " . $rand_question[$level_idx][$sub_question_idx];

            $sql_result[$level_idx] = mysql_query($sql_score[($level_idx * $num_sub_question) + $sub_question_idx]);

            if ($level_idx < ($num_total_level - 1)) {
                $cur_answer = ($_POST['answers'] / pow(10, $level_idx)) % 10;
            } else {
                $cur_answer = ($_POST['question-' . $num_total_level . '-answers']);
            }

            if ($cur_answer == $right_answer[$level_idx][$rand_question[$level_idx][$sub_question_idx] - 1]) {
                $totalCorrect++;
                $totalScore = $totalScore + $score_list[$level_idx];
                $sql_correct = "UPDATE elevel_" . ($level_idx + 1) . " SET correct = correct+1 WHERE id =  " . $rand_question[$level_idx][$sub_question_idx];
                $sql_cor_result = mysql_query($sql_correct);
            }
        }
    }
    echo "<h2> 여러분은 11억 개의 단어의 분석을 통해 만들어지고 700만 권의 책을 통해 검증된 빅데이터 기반 우선순위 단어장 BIGVOCA를 통해 시험을 보셨습니다. BIGVOCA의 표제어 8000개를 습득하면 원어민 어휘사용빈도의 90%을 알게됩니다. </h2>";
    ?>

    <img src="graph.jpg" width="500" height="292">

    <form action='score.php' method='post'>
        <div id='button'>
            <input type='submit' value='점수 확인'/>
        </div>


    <?php echo "<input type='hidden' name='finalscore' value=" . $totalScore . ">"; ?>
    </form>
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