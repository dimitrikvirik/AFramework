<?php


namespace Web;
use ReflectionMethod;

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
    public static  function  add(string $path,  ReflectionMethod $func, string $method = "GET")
    {

        $reurl = $_SERVER["REDIRECT_URL"] ?? "und";

        $method = strtoupper($method);
        $condition = false;
        $params = array();
        $pathParams = array();
        //ვამოწმებთ თუ მთავარ გვერდზე არ გადადის

        if ($reurl !== "und") {
            $arr_url = explode("/", $reurl);
            $arr_path = explode("/", $path);
            //ვამოწმებთ თუ ემთხვევა რაოდენობრივად

            if (sizeof($arr_url) === sizeof($arr_path)) {

                for($i = 0; $i < sizeof($arr_path); $i++){
                    if(str_starts_with($arr_path[$i], '{') && str_ends_with($arr_path[$i], '}')){
                        $pathParams[substr($arr_path[$i], 1, -1)] = $arr_url[$i];
                        $condition = true;
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
                       foreach ($func->getParameters() as &$parameter){
                           foreach ($parameter->getAttributes() as &$attribute){
                               $obj = match ($attribute->getName()) {
                                   "Annotation\RequestParam" => $attribute->newInstance()->get($parameter->getType(), $parameter->getName()),
                                   "Annotation\PathVariable" => $attribute->newInstance()->get($parameter->getType(), $parameter->getName(),  $pathParams),
                                   "Annotation\RequestBody" =>$attribute->newInstance()->get($parameter->getType())
                               };

                                array_push($params,  $obj);
                           }
                       }
                       $userFunc = call_user_func_array($closure, $params);
                        if($userFunc) echo json_encode($userFunc);

            if($method != "GET" && isset($_SESSION['HTTP_REFERER'])){
            echo "<script>document.location.replace('".$_SERVER['HTTP_REFERER']."')</script>";
            }
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
