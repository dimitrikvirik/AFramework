<?php


namespace Annotation\Mapping;


#[\Attribute] class DeleteMapping extends RequestMapping
{
    public function __construct(public string $value = "")
    {
        parent::__construct($this->value, "DELETE");
    }
}