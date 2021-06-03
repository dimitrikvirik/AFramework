<?php

use DB\Connection;
use DB\DB;
use Web\Controller;
use Web\Page;
use Web\Route;

//ჩატვირთავს ყველა კლასებს
spl_autoload_register(function($className){
    $fileName =   str_replace('\\', "/", $className). '.php';
     if(file_exists("src/".$fileName)) require_once "src/".$fileName;
     elseif(file_exists("bin/".$fileName)) require_once "bin/".$fileName;
});
DB::run();
Page::run();
Bean::run();
Controller::run();
Route::run(false);


