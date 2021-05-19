<?php


namespace Car;



class CarServiceImp implements CarService
{

    public function name(string $a)
    {
        \Page::$var["model"] = $a;
        view("/car", "Car Site");
    }

    public function getPrice(string $model)
    {
        //Example
       if($model == "Tesla") echo 100000;
    }
}