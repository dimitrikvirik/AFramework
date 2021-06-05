<?php

use DB\DB;
use Web\Page;
use Web\Route;

//ჩატვირთავს ყველა კლასებს თუ იქნება სადმე გამოყენებული. (არ სჭირდება require, include)
spl_autoload_register(function($className){
    $fileName =   str_replace('\\', "/", $className). '.php';
     if(file_exists("src/".$fileName)) require_once "src/".$fileName;
     elseif(file_exists("bin/".$fileName)) require_once "bin/".$fileName;
});
DB::importConf(); // ბაზებთან დაკავშირება - კონფიგურაციის წამოღება resources/config.json-დან
Page::run(); //წამოიღებს გვერდის გლობალურ js, title, css config.json-დან
Route::run();  //გადაუვლის კონტროლერელბს და გამოიძახებს src Class-ების მეთოთებზე Route::add