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



}