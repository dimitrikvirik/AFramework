<?php


namespace Handler;

use ReflectionClass;
use ReflectionException;
class AnnotationHandler
{

    /**
     * @throws ReflectionException
     */
    public static function handler(ReflectionClass $ref)
    {
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


       // call_user_func([\Car\CarController::class, "name"], "BMW");
    }
}



