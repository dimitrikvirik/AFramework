<?php


/**
 * Class Bean
 */
class Bean
{
    private static string $cacheFile = "resources/cache/beans.csv";

    /**
     * @return array
     * @throws ReflectionException
     * პოულობს დამოკიდებულებებს (კლასებს, რომელიც აიმპლემენტირებს ინტერფესის) და ინახავს კეშ ფაილში
     * beans.csv
     */
     static private function makeCache(): void{
        $out = fopen(self::$cacheFile, 'w');
        //Components
        Util::EachClass(function ($refClass) use ($out) {
             $arr = $refClass->getInterfaceNames();
                 array_push($arr, $refClass->getName());
                fputcsv($out,$arr);
        }, "Component");

        fclose($out);
    }

    /**
     * @throws ReflectionException
     * მოძებნის ინტერფეისის იმპლიმენტირის ფაილებს კეშში,
     * თუ ვერ მოძებნის, მაშინ შექმნის კეშ ფაილს
     */
     static  function find(string $interface): array{
        $arr = [];
        if(!file_exists(self::$cacheFile)){
            self::makeCache();
        }
        if (($handle = fopen(self::$cacheFile, "r")) !== FALSE) {
            while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
                $num = count($data);
                for ($c=0; $c < $num; $c++) {
                    if($data[$c] == $interface){
                        array_push($arr, $data[$num-1]);
                    }
                }
            }
            fclose($handle);
        }
        return  $arr;
    }

    /**
     * @throws ReflectionException
     * ჩაამატებს ყველა დამოკიდებულებს
     */
    static function run(){
        Util::EachClass(function($ref){
            foreach ($ref->getProperties() as &$property) {
                foreach ($property->getAttributes() as &$attribute) {
                    $arr = \Bean::find($property->getType());
                    $attribute->newInstance()->inject($property, $arr);
                }
            }
        }, "ANY");
    }
}