<?php


namespace Car;


use Annotation\Controller;
use Annotation\Injection\AutoWired;
use Annotation\Injection\Qualifier;
use Annotation\Mapping\DeleteMapping;
use Annotation\Mapping\GetMapping;

#[Controller]
class CarController
{
    #[Qualifier("CarServiceFileImp")]
    public static CarService $carService;

    #[GetMapping]
    public function home(){
       self::$carService->name("BMW");

    }
    #[GetMapping("/test")]
    public function test(){
      echo "TEST";

    }
    #[DeleteMapping]
    public function getPrice(){
       echo "DELETE MAPPING!";
    }
}