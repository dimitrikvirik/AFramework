<?php


namespace Car;


use Annotation\Component;

#[Component]
class CarServiceImp implements CarService
{

    public function name(string $a)
    {
        \Page::$var["model"] = $a;
      echo $a;
    }

    public function getPrice(string $model)
    {
        //Example
       if($model == "Tesla") echo 100000;
    }
}