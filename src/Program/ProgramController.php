<?php


namespace Program;

use Annotation\Controller;
use Annotation\Injection\AutoWired;
use Annotation\Mapping\GetMapping;
use Annotation\Mapping\PostMapping;
use Annotation\Mapping\RequestMapping;
use Annotation\Variable\PathVariable;
use Annotation\Variable\RequestBody;
use Web\Page;

#[Controller]
#[RequestMapping("/programs")]
class ProgramController
{
    #[AutoWired]
    static ProgramServe $programServe;

    #[GetMapping]
    function index(){
        Page::$var["programs"] = self::$programServe->get();
        Page::view("programs/all", "Programs List");
    }
    #[GetMapping("/add/{id}")]
    function get(#[PathVariable] int $id){
         self::$programServe->addToUser($id);
    }


    #[PostMapping]
    function create(#[RequestBody] ProgramView $programView){
        self::$programServe->add($programView);
    }
}