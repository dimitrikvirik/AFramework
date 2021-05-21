<?php


namespace Car;


use Annotation\Component;
use DB\DB;
use http\Header;
use Web\Page;

#[Component]
class CarServiceImp implements CarService
{

    public function name(string $a)
    {
        Page::$var["model"] = $a;
        Page::view("home", "Home Page");
    }

    public function getPrice(string $model)
    {
        //Example
       if($model == "Tesla") echo 100000;
    }

    public function add()
    {
        session_start();

            DB::Table("cars")->Insert($_POST);

    }
}