<?php
include 'system/app.php';

$app = new app;

$app->init();

$app->render('index.html',array('aa'=>'ssss'));

?>