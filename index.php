<?php

require_once 'App.php';
require_once 'DataProvider.php';
require_once 'Config.php';
require_once 'Facade.php';
require_once 'ConfigFacade.php';


$app = new App();

$app->bind(DataProvider::class, function() {
    return new DataProvider();
});

$app->bind(Config::class, function() use ($app) {
    return new Config($app->make(DataProvider::class));
});

Facade::setFacadeApplication($app);

// Use the Facade to get data from the Config class
echo (ConfigFacade::get());



// Use ReflectionClass to analyze the ConfigFacade class
// $reflectionClass = new ReflectionClass('ConfigFacade');
// echo '<h2>Methods of ConfigFacade class:</h2>';
// foreach ($reflectionClass->getMethods() as $method) {
//     echo $method->getName() . '<br>';
// }