<?php


namespace Annotation\Mapping;

use Annotation\Annotation;

#[\Attribute]
class RequestMapping extends Annotation
{
    public function __construct(
        public string $value = "",
        public string $method = "GET"
    ){}
    public function run(\ReflectionMethod $classMethod, string $withPath){

        \Route::add($withPath.$this->value,$classMethod , $this->method);
    }

}