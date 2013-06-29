<?php

include __DIR__ . '/../app/AppBootstrap.php';
use \Phalcon\DI\FactoryDefault;

try {

    $di = new FactoryDefault();
    $bootstrap = new AppBootstrap($di);
    $bootstrap->main();

    echo $bootstrap->handle()->getContent();
} catch (Phalcon\Exception $e) {
    echo $e->getMessage() . '<br />';
    echo $e->getTraceAsString();
} catch (PDOException $e) {
    echo $e->getMessage();
}