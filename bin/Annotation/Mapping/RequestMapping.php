<?php


namespace Annotation\Mapping;



#[\Attribute]
class RequestMapping extends \Bean
{
    public function __construct(
        public string $value = "",
        public string $method = "GET"
    ){}
    public function run(\ReflectionMethod $classMethod, string $withPath){

        \Route::add($withPath.$this->value,$classMethod , $this->method);
    }

}