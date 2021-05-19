<?php


namespace Car;

use Annotation\AutoWired;
use Annotation\Mapping\DeleteMapping;
use Annotation\Mapping\GetMapping;
use Annotation\Mapping\RequestMapping;

#[RequestMapping("/car")]
class CarController
{
    #[AutoWired]
    public static CarService $carService;

    #[GetMapping("/{p1:any}")]
    public static function name($args){

      self::$carService->name($args[0]);
    }
    #[DeleteMapping]
    public static function getPrice(){
       echo "DELETE MAPPING!";
    }
}