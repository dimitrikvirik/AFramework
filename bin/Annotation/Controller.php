<?php


namespace Annotation;


use ReflectionClass;

#[\Attribute(\Attribute::TARGET_CLASS)] class Controller
{

     function call(ReflectionClass $ref){

         $atr = $ref->getAttributes();
         array_walk($atr, function ($atr) use (&$args)
         {$args[$atr->getName()] = $atr->getArguments();}); //ამოიღებს ყველა ატრიბუტის მნიშვნელობას ასოციაციურად


         foreach ($ref->getMethods() as &$method){
             foreach ($method->getAttributes() as &$attribute){
                 $attribute->newInstance()->call($method, $args); // თითო მეთოდის ატრიბუტს გამოიძახებს

             }
         }

    }

}