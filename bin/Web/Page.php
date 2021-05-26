<?php

namespace Web;
/**
 * Class Page
 * გვერდებთან მუშაობასთან კლასი
 */
class Page{
     static array $sections = array(); // output-ის შენახვა
     static string $name;// დრობითი სახელის შენახვა
     static array $conf = array(); // კონფიგი config.json-დან
     static string $title = "";
     static array $var = array();
    //სექციის ჩამატება
     static function yield(string $name){
         if(isset(self::$sections[$name])){
             echo self::$sections[$name];
         }
         else{
             echo "sections {$name} not exist!";
         }
    }
    /**
     * @param string $name
     * საექციის გახსნა. სანამ გახნილია ინახავს output-ს
     */
     static function section(){
        ob_start([Page::class, "callback"]);
    }
    /**
     * სექციის დახურვა
     */
     static  function  endsection($name){
        self::$sections[$name] =  ob_get_contents();
        ob_end_clean();
    }
    /**
     * @param $file
     * გვერდის გაფართოვება. იწერება ფაილის ქვემოდ
     */
     static function extend(string $file, bool $isLayout = true){
         $file = ($isLayout)? "/layouts/".$file: "/templates/".$file;
        require_once "./resources/{$file}.php";
    }

    /**
     * @param $name
     * გვერდის სახელის დამატება
     */
     static function title($name){
        self::$title = $name;
    }

    /**
     * @param $name
     * ამატებს js ფაილს მისი სახელის მიხედვით.
     */
     static function addJs($name){
        array_push(self::$conf["js"], $name);
    }
    /**
     * @param $name
     * ამატებს css ფაილს მისი სახელის მიხედვით.
     */
     static function addCss($name){
        array_push(self::$conf["css"], $name);
    }

    /**
     * @param $name
     * ტვირტავს სურათს
     */
    static function asset($url): string
    {
       return '/resources/static/'.$url;
    }
    /**
     * @param ...$args
     * გვერდის ცვალადების დამატება
     */
     static function vars(array $arr){
       self::$var += $arr;
    }
     static function view($file, $title = "", $use_layout = true){
        if($use_layout) {
            self::title($title);
            self::section();
            require_once $_SERVER['DOCUMENT_ROOT'] . "/resources/templates/{$file}.php";
            self::endsection("content");
            require_once $_SERVER['DOCUMENT_ROOT'] . "/resources/layouts/layout.php";
        }else   require_once $_SERVER['DOCUMENT_ROOT'] . "/resources/{$file}.php";
    }
    /**
     * config.json-დან პარამეტრების დაიმპორტება
     */
     static function run(){
       self::$conf = \Util::ReadConf("page");
    }

    /**
     * @param $buffer
     * output-ის შენახვა
     */
     static function callback($buffer){

    }
    static function printError($key): string{
        session_start();
        $msg = "";
        if(isset($_SESSION[$key])){
            $msg = $_SESSION[$key];
            unset($_SESSION[$key]);
        }
        return $msg;
    }

}