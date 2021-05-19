<?php
spl_autoload_register(function($className){
    $fileName =   str_replace('\\', "/", $className). '.php';

     if(file_exists("src/".$fileName)) include "src/".$fileName;
     elseif(file_exists("bin/".$fileName)) include "bin/".$fileName;
});
//აბრუნებს config.json-იდან პარამეტრების საჭირო ნაწილს
function read_conf($key){
    $json =  json_decode(file_get_contents("./config.json"), true);
    return $json[$key];
}
//ამატებს view php ფაილებს
function view($file, $title = "", $use_layout = true){
    if($use_layout) {
        Page::title($title);
        Page::section();
        include_once $_SERVER['DOCUMENT_ROOT'] . "/view{$file}.php";
        Page::endsection("content");
        include_once $_SERVER['DOCUMENT_ROOT'] . "/view/layouts/layout.php";
    }else   include_once $_SERVER['DOCUMENT_ROOT'] . "/view{$file}.php";
}

Connection::importConf();
Page::importConf();
Helper::loadFromDir("src", "Controller",  [AnnotationHandler::class, "Controller"]);
