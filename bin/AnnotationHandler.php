<?php




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
                $arr = $attribute->newInstance()->find($ref->getNamespaceName());
                $className = "\\".$arr[0];
                $impClass = new $className();
                $ref->setStaticPropertyValue($property->getName(), $impClass);
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



