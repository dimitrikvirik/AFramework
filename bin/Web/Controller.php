<?php
namespace Web;

use ReflectionClass;
use Util;

class Controller
{
    static function ControllerHandler(ReflectionClass $ref){
        $withPath = "";

        //Class
        foreach ($ref->getAttributes() as &$attribute){
            if($attribute->getName() == "Annotation\Mapping\RequestMapping") $withPath .= $attribute->getArguments()[0];

        }
        //Methods
        foreach ($ref->getMethods() as &$method){
            foreach ($method->getAttributes() as &$attribute){
                $attribute->newInstance()->add($method, $withPath);
            }
        }
    }



     static function run(){
        Util::EachClass([Controller::class, "ControllerHandler"], "Controller");
    }
}