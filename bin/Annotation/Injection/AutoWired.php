<?php

namespace Annotation\Injection;

#[\Attribute] final class AutoWired
{
    public function inject( \ReflectionProperty $property,  array $list){
           $property->setValue( new ($list[0]));
    }

}