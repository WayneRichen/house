<?php
if (!empty($_POST)) {
    echo $_POST['name1'] . ' 同學本次小考考 ' . $_POST['score1'] . ' 分<br>';
    echo $_POST['name2'] . ' 同學本次小考考 ' . $_POST['score2'] . ' 分<br>';
    echo '全班平均為 ' . $_POST['avg'] . ' 分<br>';
    if ($_POST['score1'] > $_POST['score2']) {
        echo $_POST['name1'] . ' 同學分數較高,比 ' . $_POST['name2'] . ' 同學高' . (string)($_POST['score1'] - $_POST['score2']) . '分!!<br>';
    } else {
        echo $_POST['name2'] . ' 同學分數較高,比 ' . $_POST['name1'] . ' 同學高' . (string)($_POST['score2'] - $_POST['score1']) . '分!!<br>';
    }
    if ($_POST['score1'] > $_POST['avg']) {
        echo $_POST['name1'] . ' 同學分數高於平均分數' . (string)($_POST['score1'] - $_POST['avg']) . '分!!<br>';
    } else {
        echo $_POST['name2'] . ' 同學分數高於平均分數' . (string)($_POST['score2'] - $_POST['avg']) . '分!!<br>';
    }
}