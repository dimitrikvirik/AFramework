<?php


namespace Program;


use Annotation\Component;
use Annotation\Mapping\PostMapping;
use DB\DB;
use Objects\NotFoundObject;
use Util;

#[Component]
class ProgramServeImp implements ProgramServe
{

    function get(): array
    {
        $programs =  DB::Table("programs")->select()->execute()->fetchAll();
        foreach ($programs as &$program){
            $program["teacher"]  = DB::Table("users")->select()->byId($program["teacher_id"])->execute()->fetch();
        }
        return $programs;

    }
    function getById(int $id)
    {
        $program =  DB::Table("programs")->select()->byId($id)->execute()->fetch();
        if($program){
                 $program["teacher"]  = DB::Table("users")->select()->byId($program["teacher_id"])->execute()->fetch();
        }
        return $program;
    }


    function edit(int $id, ProgramView $programView): void
    {
        if(!$_SESSION["user"]["is_admin"]){
            DB::Table("programs")->update((array) $programView, "id = $id")->execute();
        }
    }

    function delete(int $id): void
    {
        if(!$_SESSION["user"]["is_admin"]) {
            DB::Table("groups")->delete("where program_id = $id")->execute();
            DB::Table("programs")->delete("where id = $id")->execute();
        }
    }

    function addToUser(int $id): void
    {
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

    function delToUser(int $id)
    {
        $user_id = $_SESSION["user"]["id"];
        DB::Table("groups")->delete("where user_id = $user_id and program_id = $id")->execute();
    }

    function create($data)
    {
        if(!$_SESSION["user"]["is_admin"]) {
            $data["teacher_id"] = $_SESSION["user"]["id"];
            DB::Table("programs")->insert($data)->execute();
        }
    }
}