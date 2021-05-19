<?php
namespace Car;
use Annotation;
#[Annotation("service")]
interface CarService
{

    public function name(string $a);

    public function getPrice(string $model);
}