<?php


namespace Annotation\Variable;


#[\Attribute] class RequestBody
{
    function get(string $className): object{
        $json = file_get_contents('php://input');
        $data = json_decode($json, true );

        $class = new $className();

        foreach ($data as $key => $value) $class->{$key} = $value;
        return $class;
    }
}