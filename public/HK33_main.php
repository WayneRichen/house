<?php
if (!empty($_POST)) {
    $bmi = round($_POST['weight'] / pow(round($_POST['height'] / 100, 2), 2), 2);
    echo $_POST['name'] . ' 的身高為 ' . $_POST['height'] . ' 公分、體重 ' . $_POST['weight'] . ' 公斤，BMI為： ' . $bmi . '<br>';
    if ($bmi < 18.5) {
        $result = '體重過輕';
    } elseif ($bmi < 24) {
        $result = '正常範圍';
    } elseif ($bmi < 27) {
        $result = '過 重';
    } elseif ($bmi < 30) {
        $result = '輕度肥胖';
    } elseif ($bmi < 35) {
        $result = '中度肥胖';
    } else {
        $result = '重度肥胖';
    }
    echo $_POST['name'] . ' BMI的座落範圍為【' . $result . '】<br>';
    switch ($result) {
        case '體重過輕':
            echo '您的BMI小於18.5,體重過輕,多吃點!!<br>';
            break;
        case '正常範圍':
            echo '您的BMI介於18.5~24,屬於正常範圍,請繼續保持!!<br>';
            break;
        case '過 重':
            echo '您的BMI介於24~27,有點過重,要注意囉!!<br>';
            break;
        case '輕度肥胖':
            echo '您的BMI介於27~30,屬輕度肥胖,需適當運動與注意飲食!!<br>';
            break;
        case '中度肥胖':
            echo '您的BMI介於30~35,屬中度肥胖,需規律運動與注意飲食!!<br>';
            break;
        case '重度肥胖':
            echo '您的BMI超過35,屬於重度肥胖!!請找醫師諮詢!!<br>';
            break;
        default:
            break;
    }
}