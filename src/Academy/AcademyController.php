<?php


namespace Academy;


use Annotation\Controller;
use Annotation\Injection\AutoWired;
use Annotation\Injection\Qualifier;
use Annotation\Mapping\GetMapping;
use Web\Page;

#[Controller]
class AcademyController
{


    #[GetMapping]
    function home(){
        Page::view("home", "Home page");
    }
    #[GetMapping("/about-us")]
    function aboutUs(){
        Page::view("about-us", "About Us");
    }

    #[GetMapping("/holiday-camps")]
    function holidayCamps(){
        Page::view("holiday-camps", "Holiday Camps");
    }
    #[GetMapping("/contact")]
    function contact(){
        Page::view("contact", "Contact");
    }
}