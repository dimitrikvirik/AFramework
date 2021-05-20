<?php

use Handler\AnnotationHandler;




spl_autoload_register(function($className){
    $fileName =   str_replace('\\', "/", $className). '.php';

     if(file_exists("src/".$fileName)) require_once "src/".$fileName;
     elseif(file_exists("bin/".$fileName)) require_once "bin/".$fileName;
});
//აბრუნებს config.json-იდან პარამეტრების საჭირო ნაწილს
function read_conf($key){
    $json =  json_decode(file_get_contents("resources/config.json"), true);
    return $json[$key];
}
//ამატებს resources php ფაილებს


Connection::importConf();
Page::run();
Helper::loadFromDir("src", "Controller",  [AnnotationHandler::class, "Controller"]);
Route::run();

