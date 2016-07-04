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
    $finalScore = $_POST['finalscore'];
    $voca = round($finalScore * 75 + rand(1, 500));

    echo "<div id='results1'>최종 점수는 " . "<strong>".$finalScore."점</strong>" . " 입니다. </div></br>";
    echo "<div id='results1'>귀하는 8000개 표제어 중 " . "<strong>".$voca . "개</strong>"."를 아는 것으로 추정됩니다. </div></br>";

    if ($voca <= 4000) {
        echo "<div id='results2'>BIGVOCA CORE에서 ".(4000-$voca)."개만 외우시면 원어민 단어 사용빈도의 70% 수준까지 알게됩니다. 
그렇게 외운 단어만 적절하게 구사해도 의사소통에 전혀 지장이 없게 됩니다. 
만약 시험을 준비하고 계시면 성적이 크게 향상되실 것입니다. 
조금만 더 공부해보세요! 화이팅!</div>";
    } else {
        if ($finalScore == 100) {
            echo "<div id='results2'>원어민 수준의 어휘실력이십니다. 대단하세요!
BIGVOCA advanced 편에 모르는 단어가 없으시면 영어 어휘는 더이상 따로 하지 않으셔도 됩니다!  </div>";
        } else {
            echo "<div id='results2'>BIGVOCA Advanced에서 ". (8000 - $voca)."개만 더 외우시면 
TIME이나 CNN에 독해 시 단어 때문에 독해가 불가능한 경우는 발생하지 않게 됩니다. 
어휘력을 조금만 더 향상시키고 영어로 쓰인 많은 자료를 꾸준히 읽으시면 
영어로 정보습득을 하는데 문제가 전혀 없어지게 됩니다. 
만약 시험을 준비하고 계시면 토플, GRE도 응시 가능한 수준이십니다. 
완벽한 영어 어휘력을 완성해 보세요. 화이팅!</div>";
        }
    }
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