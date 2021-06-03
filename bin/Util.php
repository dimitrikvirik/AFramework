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
    static function PrintError($key){
        if(isset( $_SESSION[$key."Err"])) {
            echo $_SESSION[$key . "Err"];
            unset($_SESSION[$key . "Err"]);
        }
    }
    static function PrintSuc($key){
        if(isset( $_SESSION[$key."Suc"])) {
            echo $_SESSION[$key . "Suc"];
            unset($_SESSION[$key . "Suc"]);
        }
    }
    static function goBack(){
        echo "<script>document.location.replace('".$_SERVER['HTTP_REFERER']."')</script>";
    }


}