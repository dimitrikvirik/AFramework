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
    public function add(\ReflectionMethod $classMethod, string $withPath){
        Route::add($withPath.$this->value,$classMethod , $this->method);
    }


}