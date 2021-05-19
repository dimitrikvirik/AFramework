<?php

/**
 * Class Page
 * გვერდებთან მუშაობასთან კლასი
 */
class Page{
    public static array $sections = array(); // output-ის შენახვა
    public static string $name;// დრობითი სახელის შენახვა
    public static array $conf = array(); // კონფიგი config.json-დან
    public static string $title = "";
    public  static array $var = array();
    //სექციის ჩამატება
    public static function yield(string $name){
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
    public static function section(){
        ob_start([Page::class, "callback"]);
    }
    /**
     * სექციის დახურვა
     */
    public static  function  endsection($name){
        self::$sections[$name] =  ob_get_contents();
        ob_end_clean();
    }
    /**
     * @param $file
     * გვერდის გაფართოვება. იწერება ფაილის ქვემოდ
     */
    public static function extend($file){
        include_once "./view/{$file}.php";
    }

    /**
     * @param $name
     * გვერდის სახელის დამატება
     */
    public static function title($name){
        self::$title = $name;
    }

    /**
     * @param $name
     * ამატებს js ფაილს მისი სახელის მიხედვით.
     */
    public static function js($name){
        array_push(self::$conf["js"], $name);
    }
    /**
     * @param $name
     * ამატებს css ფაილს მისი სახელის მიხედვით.
     */
    public static function css($name){
        array_push(self::$conf["css"], $name);
    }

    /**
     * @param ...$args
     * გვერდის ცვალადების დამატება
     */
    public static function vars(array $arr){
       self::$var += $arr;
    }
    /**
     * config.json-დან პარამეტრების დაიმპორტება
     */
    public static function importConf(){
        self::$conf = read_conf("page");
    }

    /**
     * @param $buffer
     * output-ის შენახვა
     */
    private static function callback($buffer){

    }

}