<?php
if (!empty($_POST)) {
    $str = ($_POST['input'] >= 12) ? (($_POST['input'] > 12) ? (($_POST['input'] == 24) ? ' midnight' : ' PM') : ' noon') : ((($_POST['input'] > 0)) ? ' AM' : ' midnight');
    $hour = ($_POST['input'] > 12) ? ($_POST['input'] - 12) : (($_POST['input'] == 0) ? 12 : $_POST['input']);
    echo '24制的時為： ' . $_POST['input'] . '<br>';
    echo '目前時間為： ' . $hour . ' ' . $str;
}