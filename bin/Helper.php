<?php


class Helper
{
   static function loadFromDir($dir, $what, $func = null){
        $list = scandir($dir);
        foreach($list as &$file){
            if(str_contains($file, $what) && str_ends_with($file, ".php")){

                require_once $dir."/".$file;

               if($func != null) {
                     preg_match('/(?P<name>\w+).php/', $dir."\\".$file, $matches);

                     $file = $dir."/".str_replace(".php", "", $file);
                     $file = str_replace("src/", "", $file);
                     $file = str_replace("/", "\\", $file);
                    $func($file);
               }
            }
            elseif(!str_contains($file, ".")) self::loadFromDir($dir."/".$file, $what, $func);
        }
    }
    static function findBean($interface, array &$arr ,  $out, string $dir = "src/",){


    }

}