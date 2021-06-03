<?php
namespace Web;

use ReflectionClass;
use Util;

class Controller
{
    /**
     * @param ReflectionClass $ref
     * კონტროლერების დამუშავება
     */
    static function ControllerHandler(ReflectionClass $ref){
        $withPath = "";

        //Class
        foreach ($ref->getAttributes() as &$attribute){
            if($attribute->getName() == "Annotation\Mapping\RequestMapping") $withPath .= $attribute->getArguments()[0];
        }
        //Methods მეთოდების ატრიბუტებს გადაუვლის და გამოიძახებს ატრიბუტ კლასში Annotation/Mapping
        foreach ($ref->getMethods() as &$method){
            foreach ($method->getAttributes() as &$attribute){
                $attribute->newInstance()->add($method, $withPath);
            }
        }
    }


    /**
     * @throws \ReflectionException
     * კონტროლერების ჩატვირთვა
     */
    static function run(){
        Util::EachClass([Controller::class, "ControllerHandler"], "Controller");
    }
}