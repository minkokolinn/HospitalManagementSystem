<?php
    session_start();

    $_SESSION['genz']=array(
        array('Min','Ko'),
        array('Ko','Linn')
    );

    foreach ($_SESSION['genz'] as $val) {
        print_r($val);
    }
    echo "<br>";
    array_push($_SESSION['genz'],array('Loon','Htar'));

    foreach ($_SESSION['genz'] as $val) {
        print_r($val);
    }
    unset($_SESSION['genz']);
    foreach ($_SESSION['genz'] as $val) {
        print_r($val);
    }
?>