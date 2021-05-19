<?php


namespace Annotation\Mapping;


#[\Attribute] class PutMapping extends RequestMapping
{
    public function __construct(public string $value = "")
    {
        parent::__construct($this->value, "PUT");
    }
}