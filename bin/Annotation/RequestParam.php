<?php


namespace Annotation;


#[\Attribute] class RequestParam
{
    public function __construct(public string $paramKey = "")
    {
    }

    function get(string|null $type, string $typeName): mixed{

        $var = ($this->paramKey == "")? $_GET[$typeName]: $_GET[$this->paramKey];
        if($type) settype($var, $type);
        return $var;
    }
}