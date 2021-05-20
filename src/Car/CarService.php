<?php
namespace Car;
use Annotation;

interface CarService
{

    public function name(string $a);

    public function getPrice(string $model);
}