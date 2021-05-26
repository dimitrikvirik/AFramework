<?php


class Util
{

    /**
     * @param $func
     * @param string $attribute
     * @throws ReflectionException
     * გადაუვლის ყველა კლასს src დირექტორიაში და გამოიძახებს მაგაზე ფუნქციას
     */
    static function EachClass($func, string $attribute = "ANY"){
        $di = new RecursiveDirectoryIterator('src/');
        //გადავუვლით ყველა ფაილებს ყველა ქვეპაპკაში
        if($attribute != "ANY") $attribute = "Annotation\\".$attribute;
        foreach (new RecursiveIteratorIterator($di) as $filename => $file) {
            if (str_ends_with($file, ".php")) {
                $className = substr($file, 3, -4);
                $refClass = new ReflectionClass($className);
                foreach ($refClass->getAttributes() as &$atr){
                    if( $atr->getName() ==  $attribute || $attribute == "ANY"){
                        call_user_func($func, $refClass);
                    }
                }
            }
        }
    }
    static function ReadConf($key){
        $json =  json_decode(file_get_contents("resources/config.json"), true);
        return $json[$key];
    }
    public static function toObject(array $array, $object)
    {
        $class = get_class($object);

        $methods = get_class_methods($class);

        foreach ($methods as $method) {

            preg_match(' /^(set)(.*?)$/i', $method, $results);

            $pre = $results[1]  ?? '';

            $k = $results[2]  ?? '';

            $k = strtolower(substr($k, 0, 1)) . substr($k, 1);

            If ($pre == 'set' && !empty($array[$k])) {

                $object->$method($array[$k]);
            }
        }
        return $object;
    }


}