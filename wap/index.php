<?php

$config = dirname(__FILE__).'/../app/config/main.php';
include dirname(__FILE__).'/../system/app.php';

$app = new app;

$app->init($config);

$app->render('index.html',array('aa'=>'ssss'));

?>