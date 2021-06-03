<?php


namespace Program;

use Annotation\Controller;
use Annotation\Injection\AutoWired;
use Annotation\Mapping\DeleteMapping;
use Annotation\Mapping\GetMapping;
use Annotation\Mapping\PostMapping;
use Annotation\Mapping\PutMapping;
use Annotation\Mapping\RequestMapping;
use Annotation\Variable\PathVariable;
use Annotation\Variable\RequestBody;
use DB\DB;
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
    #[GetMapping("/create")]
    function createPostForm(){
        Page::view("programs/create", "Create New Post");
    }
    #[PostMapping("/create")]
    function createPost(){
        self::$programServe->create($_POST);
    }
    #[PostMapping("/rem/{id}")]
    function rem(#[PathVariable] int $id){
        self::$programServe->delete($id);
    }
    #[GetMapping("/add/{id}")]
    function add(#[PathVariable] int $id){
         self::$programServe->addToUser($id);
    }
    #[DeleteMapping("/del/{id}")]
    function del(#[PathVariable] int $id){
         self::$programServe->delete($id);
    }
    #[PutMapping("/edit/{id}")]
    function edit(#[PathVariable] int $id, #[RequestBody]  ProgramView $programView){
        self::$programServe->edit($id, $programView);
    }
    #[GetMapping("/list/{id}")]
    function studentList(#[PathVariable] int $id){
       Page::$var["groups"] =   DB::Table("groups")->select()->where("program_id = $id")->execute()->fetchAll();
        Page::view("programs/students", "Students List");
    }
}