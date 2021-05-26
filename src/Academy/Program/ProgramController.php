<?php


namespace Academy\Program;

use Annotation\Controller;
use Annotation\Injection\AutoWired;
use Annotation\Mapping\GetMapping;
use Annotation\Mapping\PostMapping;
use Annotation\Mapping\RequestMapping;
use Annotation\Variable\PathVariable;
use Annotation\Variable\RequestBody;

#[Controller]
#[RequestMapping("/programs")]
class ProgramController
{
    #[AutoWired]
    static ProgramServe $programServe;

    #[GetMapping]
    function index(): array{
       return self::$programServe->get();
    }
    #[GetMapping("/{id}")]
    function get(#[PathVariable] int $id){
    echo   json_encode(self::$programServe->getById($id));

    }
    #[PostMapping]
    function create(#[RequestBody] ProgramView $programView){
        self::$programServe->add($programView);
    }
}