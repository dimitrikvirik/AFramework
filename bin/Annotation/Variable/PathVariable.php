<?php


namespace Annotation\Variable;


use Exception;

#[\Attribute] class PathVariable
{
    /**
     * @throws Exception
     */
    function  get(string|null $type, string $typeName, array $args): string
    {

       if(isset($args[$typeName])){
           $var = $args[$typeName];
           if($type) settype($var, $type);
           return $var;
       }
       else{
           throw new Exception("Path Variable not Found!");
       }

    }
}