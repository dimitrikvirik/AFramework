<?php


namespace User;


use Annotation\Controller;
use Annotation\Injection\AutoWired;
use Annotation\Mapping\GetMapping;
use Annotation\Mapping\PostMapping;
use Annotation\Mapping\RequestMapping;
use Web\Page;

#[RequestMapping("/user")]
#[Controller]
class UserController
{
    #[AutoWired]
    static UserService $userService;

    #[GetMapping("/login")]
    function login(){
        Page::view("user/login", "Login");
    }
    #[PostMapping("/login")]
    function loginForm(){
        self::$userService->login($_POST);
        header("Location: /");
    }
    #[GetMapping("/reg")]
    function reg(){
        Page::view("user/reg", "Registration");
    }
    #[PostMapping("/reg")]
    function regForm(){
        self::$userService->create($_POST);
    }
    #[PostMapping("/logout")]
    function logout(){
        self::$userService->logout();
    }
    #[GetMapping("/recover")]
    function recover(){
        Page::view("user/recover", "Recover Account");
    }
    #[PostMapping("/recover")]
    function recoverForm(){
        self::$userService->recover();
    }
}