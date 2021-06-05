<?php


namespace Web;
use Annotation\Controller;
use RecursiveDirectoryIterator;
use RecursiveIteratorIterator;
use RecursiveRegexIterator;
use ReflectionClass;
use ReflectionException;
use ReflectionMethod;
use RegexIterator;
use Util;

class Route{
    static bool $success = false;
    /**
     * @throws ReflectionException
     */
    static function run()
    {

        $dir = "src/";
        $di = new RecursiveDirectoryIterator($dir); //გადაურბენს ყველა დირეკტორიას
        $Iterator = new RecursiveIteratorIterator($di);
            // გადაურბენს თითო ფაილს დირექტორიაში
            $Regex = new RegexIterator($Iterator, '/^.+\.php$/i'); // გადაირბენს ფაილს regex-ის შეამოწმით
            foreach ($Regex as $regex){
                $className = substr($regex, strlen($dir), -strlen('.php')); // კლასის სახელი
                $refClass = new ReflectionClass($className);
                echo $refClass->getName();
                array_map(function ($atr) use ($refClass)
                {$atr->newInstance()->call($refClass); }// კლასს გამოუძახებს თითო ატრიბუტ კლასს
                    ,$refClass->getAttributes());
                $Iterator->next();

        }




        if(!self::$success){
            Page::view("404", "Page Not Found!");
        }
    }

    /**
     * @throws ReflectionException
     */
    static  function  add(string $path,   $func, string $method = "GET")
    {
        $method = strtoupper($method);
        if($_SERVER["REQUEST_METHOD"] == $method) {
            $reUrl = $_SERVER["REDIRECT_URL"] ?? "und";
            $params = array();
            $pathParams = array();
            //ვამოწმებთ თუ მთავარ გვერდზე არ გადადის
            foreach ( $func->getAttributes() as &$atr){
                $pathParams = $atr->newInstance()->returnValue($atr, ["reUrl" => $reUrl,"path" => $path]);
            }
            if (self::$success) {
                $object = new $func->class();
                foreach ($func->getParameters() as &$parameter) {
                    foreach ($parameter->getAttributes() as &$attribute) {
                        $attribute->newInstance()->get($parameter->getType(), $parameter->getName(), $pathParams);



                        $obj = match ($attribute->getName()) {
                            "Annotation\Variable\RequestParam" => $attribute->newInstance()->get($parameter->getType(), $parameter->getName()),
                            "Annotation\Variable\PathVariable" => $attribute->newInstance()->get($parameter->getType(), $parameter->getName(), $pathParams),
                            "Annotation\Variable\RequestBody" => $attribute->newInstance()->get($parameter->getType())
                        };
                        array_push($params, $obj);
                    }
                }
                $func->invokeArgs($object, $params);

                //დავბრუნდეთ უკან თუ არაა გეთი
                if ($method != "GET" && isset($_SERVER['HTTP_REFERER'])) \Util::goBack();

                exit; // სხვა add-ებს აღარ შეხედავს
            }
        }
    }






}
