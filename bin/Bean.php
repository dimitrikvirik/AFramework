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
    public static function makeCache(): void{
        $out = fopen(self::$cacheFile, 'w');
        $di = new RecursiveDirectoryIterator('src/');
        //გადავუვლით ყველა ფაილებს ყველა ქვეპაპკაში
        foreach (new RecursiveIteratorIterator($di) as $filename => $file) {
            if (str_ends_with($file, ".php")) {
                $className = substr($file, 3, -4);
                $refClass = new ReflectionClass($className);
                foreach ($refClass->getAttributes() as &$atr){
                   if(str_contains($atr->getName(), "Component")){
                       $arr = $refClass->getInterfaceNames();
                       array_push($arr, $refClass->getName());
                       fputcsv($out,$arr);
                   }
                }
            }
        }
        fclose($out);
    }

    /**
     * @throws ReflectionException
     */
    public static  function find(string $interface): array{
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

}