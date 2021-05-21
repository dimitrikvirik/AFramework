<?php


class Util
{

    /**
     * @param $func
     * @param $attribute
     * @throws ReflectionException
     * გადაუვლის ყველა კლასს src დირექტორიაში და გამოიძახებს მაგაზე ფუნქციას
     */
    static function EachClass($func, $attribute){
        $di = new RecursiveDirectoryIterator('src/');
        //გადავუვლით ყველა ფაილებს ყველა ქვეპაპკაში
        foreach (new RecursiveIteratorIterator($di) as $filename => $file) {
            if (str_ends_with($file, ".php")) {
                $className = substr($file, 3, -4);
                $refClass = new ReflectionClass($className);
                foreach ($refClass->getAttributes() as &$atr){
                    if(str_contains($atr->getName(), $attribute)){
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



}