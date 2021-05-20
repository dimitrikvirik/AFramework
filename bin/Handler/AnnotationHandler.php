<?php


namespace Handler;

use ReflectionClass;
use ReflectionException;
class AnnotationHandler
{

    /**
     * @throws ReflectionException
     */
    public static function controller($file)
    {

        $class = new ($file)();
        $ref = new ReflectionClass($class::class);
        $withPath = "";
        //Properties
        foreach ($ref->getProperties() as &$property) {
            foreach ($property->getAttributes() as &$attribute) {
                    $arr = \Bean::find($property->getType());
                    $attribute->newInstance()->inject($property, $arr);
            }
        }
        //Class
        foreach ($ref->getAttributes() as &$attribute){
           if($attribute->getName() == "Annotation\Mapping\RequestMapping") $withPath .= $attribute->getArguments()[0];

        }
        //Methods
        foreach ($ref->getMethods() as &$method){
            foreach ($method->getAttributes() as &$attribute){
                $attribute->newInstance()->run($method, $withPath);
            }
        }


       // call_user_func([\Car\CarController::class, "name"], "BMW");
    }
}



