<?php

use Annotation\Controller;
use Annotation\Mapping\GetMapping;
use Annotation\Mapping\PostMapping;
use Annotation\Mapping\RequestMapping;
use Annotation\PathVariable;
use Annotation\RequestBody;
use Annotation\RequestParam;

#[Controller]
#[RequestMapping("/test")]
class PageController
{
    #[GetMapping]
    function home(): PageView
    {
        return new PageView(23, "Something");
    }
    #[PostMapping]
    function post(#[RequestBody] PageView $pageView){
        var_dump($pageView);
    }
    #[GetMapping("/param/{p}")]
    function param(#[RequestParam] string $a, #[PathVariable]string $p){
        echo $a." | ".$p;
    }
}