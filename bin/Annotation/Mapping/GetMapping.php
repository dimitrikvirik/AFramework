<?php


namespace Annotation\Mapping;



#[\Attribute] class GetMapping extends RequestMapping
{
    public function __construct(public string $value = "" )
    {
       parent::__construct($this->value, "GET");
    }
}