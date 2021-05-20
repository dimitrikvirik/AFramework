<?php


namespace Car\imp;

use Annotation\Component;
use Car\CarService;

#[Component]
class CarServiceFileImp implements CarService
{

    public function name(string $a)
    {
       echo "ITS other..";
    }

    public function getPrice(string $model)
    {
        // TODO: Implement getPrice() method.
    }
}