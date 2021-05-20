<?php
namespace Annotation\Injection;
use Attribute;

#[Attribute] final class Qualifier
{
    public function __construct(public string $impClass)
    {}

    public function inject( \ReflectionProperty $property,   array $list){
        for ($i = 0; $i < sizeof($list); $i++){
            if(str_ends_with($list[$i], $this->impClass)){
                $property->setValue( new ($list[$i]));
            }
        }
    }
}