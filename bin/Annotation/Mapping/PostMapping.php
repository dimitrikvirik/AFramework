<?php


namespace Annotation\Mapping;


#[\Attribute] class PostMapping extends RequestMapping
{
    public function __construct(public string $value = "")
    {
        parent::__construct($this->value, "POST");
    }
}