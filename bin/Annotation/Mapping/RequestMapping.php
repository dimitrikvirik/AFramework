<?php


namespace Annotation\Mapping;



use Web\Route;

#[\Attribute]
class RequestMapping
{
    public function __construct(
        public string $value = "",
        public string $method = "GET"
    ){}

    /**
     * @throws \ReflectionException
     */
    function call($classMethod, array $args = []){

        if(isset($args["Annotation\Mapping\RequestMapping"]))
        $startPath =  $args["Annotation\Mapping\RequestMapping"][0];
        else $startPath = "";

        Route::add($startPath.$this->value,$classMethod, $this->method);
    }
    function returnValue(\ReflectionAttribute $attribute, array $given): array{

        $pathParams = [];
        if ($given["reUrl"] !== "und") {
            $arr_url = explode("/", $given["reUrl"]);
            $arr_path = explode("/", $given["path"]);
            //ვამოწმებთ თუ ემთხვევა რაოდენობრივად
            if (sizeof($arr_url) === sizeof($arr_path)) {

                for ($i = 0; $i < sizeof($arr_path); $i++) {
                    if (str_starts_with($arr_path[$i], '{') && str_ends_with($arr_path[$i], '}')) {
                        $pathParams[substr($arr_path[$i], 1, -1)] = $arr_url[$i];
                        $arr_path[$i] = $arr_url[$i];
                    }
                }
                //თუ ყველა ელემენტები ერთმანეთს ემთხვევა
                if ($arr_path == $arr_url) {

                    Route::$success = true;
                }
            }
        } elseif ($given["path"] == "")   Route::$success = true;
        return  $pathParams;
    }


}