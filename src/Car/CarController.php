<?php


namespace Car;


use Annotation\Controller;
use Annotation\Injection\AutoWired;
use Annotation\Injection\Qualifier;
use Annotation\Mapping\DeleteMapping;
use Annotation\Mapping\GetMapping;
use Annotation\Mapping\PostMapping;
use Annotation\Mapping\RequestMapping;

#[RequestMapping("/car")]
#[Controller]
class CarController
{
    #[Qualifier("CarServiceImp")]
    public static CarService $carService;

    #[GetMapping]
    public function home(){
        self::$carService->name("BMW");

    }
    #[PostMapping]
    public function test(){
      self::$carService->add();

    }
    #[DeleteMapping]
    public function getPrice(){
       echo "DELETE MAPPING!";
    }
}