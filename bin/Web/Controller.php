<?php
namespace Web;

use Handler\AnnotationHandler;
use Util;

class Controller
{
     static function run(){
        Util::EachClass([AnnotationHandler::class, "handler"], "Controller");
    }
}