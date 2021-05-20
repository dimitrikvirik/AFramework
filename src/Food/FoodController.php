<?php


namespace Food;
use Annotation\Controller;
use Annotation\Injection\AutoWired;
use Annotation\Mapping\GetMapping;

#[Controller]
class FoodController
{
    #[AutoWired]
    public static FoodService $foodService;

    #[GetMapping("/food")]
    public static function getFood(){
        echo "More Food!";
    }
}