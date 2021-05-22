<?php


namespace Annotation;


#[\Attribute] class PathVariable
{
    function  get(string|null $type, string $typeName, array $args): string
    {
        $var  = $args[$typeName];
        if($type) settype($var, $type);
        return $var;
    }
}