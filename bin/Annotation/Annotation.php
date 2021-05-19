<?php


namespace Annotation;


abstract  class Annotation
{
    public  function find(string $namespace): array{
        $arr = [];
        \Helper::findByNamespace($namespace, $this->className, $arr);
        return $arr;
    }
}