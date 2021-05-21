<?php

use Annotation\Controller;
use Annotation\Mapping\GetMapping;
use Annotation\Mapping\PostMapping;
use Annotation\RequestBody;

#[Controller]
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
}