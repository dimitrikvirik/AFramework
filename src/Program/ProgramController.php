<?php


namespace Program;

use Annotation\Controller;
use Annotation\Mapping\DeleteMapping;
use Annotation\Mapping\GetMapping;
use Annotation\Mapping\PostMapping;
use Annotation\Mapping\PutMapping;
use Annotation\Mapping\RequestMapping;
use Annotation\Variable\PathVariable;
use Annotation\Variable\RequestBody;
use DB\DB;
use Util;
use Web\Page;

#[Controller]
#[RequestMapping("/programs")]
class ProgramController
{


    #[GetMapping]
    function index(){
        $programs =  DB::Table("programs")->select()->execute()->fetchAll();
        foreach ($programs as &$program){
            $program["teacher"]  = DB::Table("users")->select()->byId($program["teacher_id"])->execute()->fetch();
        }
        Page::$var["programs"] = $programs;
        Page::view("programs/all", "Programs List");
    }
    #[GetMapping("/create")]
    function createPostForm(){
        Page::view("programs/create", "Create New Post");
    }
    #[PostMapping("/create")]
    function createPost(){
        if(!$_SESSION["user"]["is_admin"]) {
            $data["teacher_id"] = $_SESSION["user"]["id"];
            DB::Table("programs")->insert($data)->execute();
        }
    }
    #[GetMapping("/rem/{id}")]
    function rem(#[PathVariable] int $id){
        $user_id = $_SESSION["user"]["id"];
        DB::Table("groups")->delete("where user_id = $user_id and program_id = $id")->execute();
    }
    #[GetMapping("/add/{id}")]
    function add(#[PathVariable] int $id){
        $user_id = $_SESSION["user"]["id"];

        $check = DB::Table("groups")->select()->where("program_id = $id AND user_id = $user_id")->execute()->fetchAll();
        if(!$check) {
            $data = ["program_id" => $id, "user_id" => $user_id];
            DB::Table("groups")->insert($data)->execute();
            $_SESSION["valSuc"] = "You have been added to the program!";
        }
        else{
            $_SESSION["valErr"] = "You already registered in this program!";
        }
        Util::goBack();
    }
    #[DeleteMapping("/del/{id}")]
    function del(#[PathVariable] int $id){
        if(!$_SESSION["user"]["is_admin"]) {
            DB::Table("groups")->delete("where program_id = $id")->execute();
            DB::Table("programs")->delete("where id = $id")->execute();
        }
    }
    #[PutMapping("/edit/{id}")]
    function edit(#[PathVariable] int $id, #[RequestBody]  ProgramView $programView){
        if(!$_SESSION["user"]["is_admin"]){
            DB::Table("programs")->update((array) $programView, "id = $id")->execute();
        }
    }
    #[GetMapping("/list/{id}")]
    function studentList(#[PathVariable] int $id){
       Page::$var["groups"] =   DB::Table("groups")->select()->where("program_id = $id")->execute()->fetchAll();
        Page::view("programs/students", "Students List");
    }
}