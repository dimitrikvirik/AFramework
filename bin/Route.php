<?php

use JetBrains\PhpStorm\Pure;

class Route{
    private static string $url;
    private static bool $success = false;
    private static bool $useLoader;


    /**
     * Route constructor.
     * @param string $url
     * @param bool $success
     */
    public function __construct($useLoader)
    {

    }
    public static  function  add(string $path, ReflectionMethod $func, string $method = "GET")
    {

        $reurl = $_SERVER["REDIRECT_URL"] ?? "und";

        $method = strtoupper($method);
        $condition = false;
        $params = array();
        //ვამოწმებთ თუ მთავარ გვერდზე არ გადადის

        if ($reurl !== "und") {
            $arr_url = explode("/", $reurl);
            $arr_path = explode("/", $path);
            //ვამოწმებთ თუ ემთხვევა რაოდენობრივად

            if (sizeof($arr_url) === sizeof($arr_path)) {
                $n = 1;
                foreach ($arr_path as $key => &$value) {
                    preg_match('/(?P<name>\w+):(?P<type>\w+)/', $value, $matches);
                    if (!empty($matches)) {
                        $n++;
                        if (isset($arr_url[$key])) {
                            if (
                                ($matches["type"] == "num" && is_numeric($arr_url[$key])) ||
                                ($matches["type"] == "str" && ctype_alpha($arr_url[$key])) ||
                                ($matches["type"] == "any")
                            ) {
                                $value = $arr_url[$key];
                                //ჩაამატოს პარამეტრებში
                                array_push($params, $value);
                            }
                        }
                    } else if ($value != $arr_url[$key]) {
                        break;
                    }
                }
                //თუ ყველა ელემენტები ერთმანეთს ემთხვევა
                if ($arr_path == $arr_url) {
                    $condition = true;
                }
            }
        } elseif ($path == "") $condition = true;

        if ($condition && $_SERVER["REQUEST_METHOD"] == $method) {
            self::$success = true;
            $object = new $func->class(); // ფუნქციის კლასი
            $closure =  $func->getClosure($object);
            call_user_func_array($closure, $params);
            exit; // სხვა add-ებს აღარ შეხედავს
        }

    }

    /**
     * ყველა resources ფაილების წვდომადის გახდება მისი სახელის მიხედვით.
     * @example resources/about-us.php -> localhost/about
     */
    public function importView(): static
    {
        $reurl  =   $_SERVER["REDIRECT_URL"];
        if($reurl == "/[NC,F]") $reurl = "/home";
        elseif (file_exists("./resources{$reurl}.php")){
            $this->success = true;
            include "./resources{$reurl}.php";

        }


        return  $this;
    }
    public static function run()
    {

        //თუ არც ერთი გვერდი არ ჩაიტვირთა
        if( self::$success === false){
            Page::$conf["useHeader"] = false;
            Page::$conf["useFooter"] = false;
            Page::view("404", "Page Not Found!");
        }
    }



}
