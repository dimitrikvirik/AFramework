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
        // TODO: Implement edit() method.
    }

    function delete(int $id): void
    {
        // TODO: Implement delete() method.
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
        // TODO: Implement delToUser() method.
    }

    function create($data)
    {
        // TODO: Implement create() method.
    }
}