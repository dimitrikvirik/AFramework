<?php


namespace Annotation;


#[\Attribute] class AutoWired extends Annotation
{
    public string $className;
    public function __construct(){
        $this->className = "Imp";
    }
}